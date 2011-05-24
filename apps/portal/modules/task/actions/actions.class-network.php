<?php

/**
 * task actions.
 *
 * @package    protoglue_sym12
 * @subpackage task
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
 
class taskActions extends kodaziActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this-> forward('default', 'module');
  }
  
	public function executeChangeTaskUserView(sfWebRequest $request){
		return sfView::SUCCESS;
	}
	
	
	public function executeChangeTaskUser(sfWebRequest $request){

		$tid = $request->getParameter('tid');
		$uid = $request->getParameter('uid');
	}
	
	public function executeChangeTaskStatus(sfWebRequest $request){

		$tid = $request->getParameter('tid');
		$mode = $request->getParameter('mode');

		if ($tid == null){
			$this->redirect('@hub_route');
		}
		
		$task = Doctrine::getTable('Task')->find($tid);
		if ($mode){
			$task->setStatus(sfConfig::get('app_task-status_completed'));
		}else{
			$task->setStatus(sfConfig::get('app_task-status_active'));
		}
		$task->save();
		
		return $this->renderText("Status updated");
		
	
	}


	public function executeTaskDelete(sfWebRequest $request){

		$tid = $request->getParameter('tid');

		if ($tid == null){
			$this->redirect('@hub_route');
		}

		$task = Doctrine::getTable('Task')->find($tid);
		$mid = $task->getMilestoneId();
		$task->delete();

		if ($mid){
			$this->redirect("@milestone_view?mid=".$mid);
		}else{
			$this->redirect('@hub_route');
		}


	}


	public function executeTaskCreate(sfWebRequest $request){

		$mid = $request->getParameter('mid');
		$pid = $request->getParameter('pid');
		
		
		$this->project = Doctrine::getTable('Project')->find($pid);
		
		$this->mid = $mid;

		if ($mid == null){
			$this->redirect('@hub_route');
		}

		//get accountId from session
		$accountId = $this->getUser()->getAttribute('aid');

		if ($accountId == null){
			$this->redirect('@hub_route');
		}


		$this->milestone = Doctrine::getTable('Milestone')->find($mid);


		$accountUsers = Doctrine::getTable('AccountUser')->findByAccountId($accountId);
		$profiles = array();
		$ii = 0;
		foreach ($accountUsers as $au){
			$profiles[$ii++] =  $au->getUser()->getProfile();
		}

		$this->profiles = $profiles;


		if (!$this->getRequest()->isMethod('post')){
			return sfView::SUCCESS;
		}else {
			$taskName = $this->getRequestParameter("taskName");
			$targetDate = $this->getRequestParameter("targetDate");
			$startDate = $this->getRequestParameter("startDate");
			$projectId = $pid;
			$milestoneId = $mid;
			$own = $this->getRequestParameter("own");
			$description = $this->getRequestParameter("description");

			$estimateUnits = $this->getRequestParameter("estimateUnits");
			$estimateType = $this->getRequestParameter("estimateType");

			$con = Doctrine_Manager::connection();

			try {

				$con->beginTransaction();

				$task = new Task();
				$task->setCreatedBy($this->getUser()->getGuardUser()->getId());
				$task->setName($taskName);
				$startDate?$task->setStartDate($startDate):null;
				$targetDate?$task->setDueDate($targetDate):null;
				$estimateType?$task->setEstimateType($estimateType):null;
				$estimateUnits?$task->setEstimateUnits($estimateUnits):null;
				$task->setProjectId($projectId);
				$task->setOwner($own);
				$task->setDescription($description);
				$task->setCreated(date("Y-m-d H:i:s"));
				$task->setStatus(1);
				$task->setMilestoneId($milestoneId);
				$task->setProjectId($projectId);
					
				$task->save($con);

				$con->commit();
			} catch (Doctrine_Exception $e) {
				$con->rollback();
				error_log ($e->getMessage());

				//add to error object
				return sfView::SUCCESS;
			}


			$this->redirect("@milestone_view?mid=" . $mid);

		}


	}
	
	
	public function executeProjectTaskCreate(sfWebRequest $request){

		$pid = $request->getParameter('pid');
		$this->project = Doctrine::getTable('Project')->find($pid);
		
		if ($this->getRequest()->isMethod('post')){
		
		$taskName = $this->getRequestParameter("taskName");
		$targetDate = $this->getRequestParameter("targetDate");
		$startDate = $this->getRequestParameter("startDate");
		$projectId = $pid;
		$milestoneId =  $this->getRequestParameter("milestoneId");
		$own = $this->getRequestParameter("own");
		$description = $this->getRequestParameter("description");

		$estimateUnits = $this->getRequestParameter("estimateUnits");
		$estimateType = $this->getRequestParameter("estimateType");

		$con = Doctrine_Manager::connection();

		try {
			

			$con->beginTransaction();

				$task = new Task();
				$task->setCreatedBy($this->getUser()->getGuardUser()->getId());
				$task->setName($taskName);
				$startDate?$task->setStartDate($startDate):null;
				$targetDate?$task->setDueDate($targetDate):null;
				$estimateType?$task->setEstimateType($estimateType):null;
				$estimateUnits?$task->setEstimateUnits($estimateUnits):null;
				$task->setProjectId($projectId);
				$task->setOwner($own);
				$task->setDescription($description);
				$task->setCreated(date("Y-m-d H:i:s"));
				$task->setStatus(1);
				strlen($milestoneId)>0?$task->setMilestoneId($milestoneId):null;
				$task->setProjectId($projectId);
					
				$task->save($con);

			$con->commit();
		} catch (Doctrine_Exception $e) {
			$con->rollback();
			error_log ($e->getMessage());
				
		}
		
		
		$pid = $request->getParameter('pid');
		$milestones = Doctrine::getTable('Task')->getAllTasksWithMilestones($pid);
		$tasksSansMilestones = Doctrine::getTable('Task')->getTasksSansMilestones($pid);
		
		$preMilestones = $this->cleanDate($milestones->toArray(true));
		$preTasks = $this->cleanDate($tasksSansMilestones->toArray(true));
		
		return $this->renderText('taskCallback(' .json_encode(
									array(	'milestoneTasks'=>$preMilestones, 
											'sansMilestoneTasks'=>$preTasks)) .')');
		
	 }


	}


	public function executeTaskView(sfWebRequest $request){

		$tid = $request->getParameter('tid');

		$this->task = Doctrine::getTable('Task')->find($tid);

		return sfView::SUCCESS;

	}
	
	public function executeUserUpcomingTasks(sfWebRequest $request){
		return $this->renderComponent("task", "showUserTasks");
	}
	
	public function executeUserProjectTasks(sfWebRequest $request){
		return $this->renderComponent("task", "showUserProjectTasks");
	}
	
	
	public function executeAllTasks(sfWebRequest $request){
		return $this->renderComponent("task", "showAllTasks");
	}
	
	

	
	function preflight(&$item, $key){
   			if ($key == 'due_date'){
				$item = TimeUtil::distanceOfTimeInWords(time(), strtotime($item));
			}
		}

	function cleanDate($milestones){
		array_walk_recursive($milestones, array('self', 'preflight') );
		return $milestones;
	}
	
	public function executeJsonAllTasks(sfWebRequest $request){
		$pid = $request->getParameter('pid');
		
		
		$milestones = 	Doctrine::getTable('Task')->getAllTasksWithMilestones($pid);
		$tasksSansMilestones = Doctrine::getTable('Task')->getTasksSansMilestones($pid);
		
		$preMilestones = $this->cleanDate($milestones->toArray(true));
		$preTasks = $this->cleanDate($tasksSansMilestones->toArray(true));
		
		return $this->renderText('taskCallback(' .json_encode(
									array(	'milestoneTasks'=>$preMilestones, 
											'sansMilestoneTasks'=>$preTasks)) .')');
		
	}
	
	public function executeProjectAllTasks(sfWebRequest $request){
		return $this->renderComponent("task", "showProjectTasks");
	}
	
	
	public function executeTaskHistory(sfWebRequest $request){
		
		$taskId = $request->getParameter('tid');
		$task = Doctrine::getTable("Task")->find($taskId);
		
		$c = 0;
		$histArr = array();
		$hist = $task->getHistory();
		foreach ($hist as $h){
			$h = unserialize($h->getActionDetail());
			$histArr[$c++] = array($h->getName(), $h->getStatus(), $h->getEstimateUnits(), $h->getEstimateType(), $h->getOwner(), $h->getDueDate());
		}
		
		
	}
	
	
	public function executeAllTasksView(sfWebRequest $request){
		$pid = $request->getParameter('pid');
		$this->project = Doctrine::getTable('Project')->find(array($this->accountId, $pid));
		
		$userPref = Doctrine::getTable("UserPref")->find(array($this->accountId, $this->userId));
		if ($userPref){
			$prefs = unserialize($userPref->prefs);
			$openProjects = $prefs['open_projects'];
			
			$openProjects[] = $pid;
			
			$this->openProjects = array_unique($openProjects);
			$prefs = serialize(array('open_projects'=>$this->openProjects));
			
			$userPref->prefs = $prefs;
			$userPref->save();
			
		}else{
			$userPref = new UserPref();
			$userPref->account_id = $this->accountId;
			$userPref->user_id = $this->userId;
			
			$prefs = array();
			$openProjects = array($pid);
			$prefs = serialize(array('open_projects'=>$openProjects));
			
			$userPref->prefs = $prefs;
			$userPref->save();
		}
		
	}
	
  
}
