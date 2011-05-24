<?php

class jsonAllTasksAction extends kodaziAction{
	
	
	public function execute($request) {
		$pid = $request->getParameter('pid');
		$zone = $request->getParameter('zone');
		
		$this->openProjects = Util::userPrefOpenProjects($this->accountId, $this->userId, $pid);
		
		$groups = Doctrine::getTable('Task')->getAllTasks($this->accountId,$pid);
		$groups = $this->cleanDate($groups->toArray(true));
		return $this->renderText(json_encode(array('groups'=>$groups, 'zone'=>$zone)));
	}
	
}
?>