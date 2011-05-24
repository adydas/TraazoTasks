<?php

class taskCreateAction extends kodaziAction{
	
	
	public function execute($request) {

		$gid = $request->getParameter('gid');
		$pid = $request->getParameter('pid');
		$pos = $request->getParameter('pos');
		
		$this->pos = $pos;
		
		if (!$gid){
			$gid = 0;
		}


		$this->project = Doctrine::getTable('Project')->find(array($this->accountId, $pid));
		if (!$this->project){
			return;
		}
		
		
		
		if ($gid){
			$this->group = Doctrine::getTable('Group')->find(array($this->accountId, $pid, $gid));
		}

		$accountUsers = Doctrine::getTable('AccountUser')->findByAccountId($this->accountId);
		
		
		
		$profiles = array();
		$ii = 0;
		foreach ($accountUsers as $au){
			$profiles[$ii++] =  $au->getUser()->getProfile();
		}
		$this->profiles = $profiles;

		if (!$this->getRequest()->isMethod('post')){
			return sfView::SUCCESS;
		}else {
			
			
			$taskName = $this->getRequestParameter("t_create_description");
			
			$own = $this->getRequestParameter("t_create_owner");
			$estimateUnits = $this->getRequestParameter("t_create_duration");
			$estimateType = $this->getRequestParameter("t_create_duration_unit");
			$tags = $this->getRequestParameter("t_create_tags");

			$con = Doctrine_Manager::connection();

			try {
	
		
				$con->beginTransaction();

				$task = new Task();
				$task->setProjectId($pid);
				$task->setAccountId($this->accountId);
				$task->setId($this->project->getNewTaskId($this->accountId));
				$gid?$task->setGroupId($gid):null;
				$task->setCreatedBy($this->getUser()->getGuardUser()->getId());
				$task->setName($taskName);
				$estimateType?$task->setEstimateType($estimateType):null;
				$estimateUnits?$task->setEstimateUnits($estimateUnits):null;
				//$task->setOwner($own);
				$task->setDescription($description);
				$task->setCreated(date("Y-m-d H:i:s"));
				$task->setStatus(1);
				$task->save($con);

				$con->commit();
				
				return $this->renderText(json_encode(array('task'=>$task->toArray(), 'pos'=>$pos)));
				
				
			} catch (Doctrine_Exception $e) {
				$con->rollback();
				error_log ($e->getMessage());
			}
		}
	}
	
}
?>