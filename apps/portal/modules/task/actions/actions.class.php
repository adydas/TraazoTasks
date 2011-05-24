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
		$this->getUser()->setFlash('pid', $pid);
		$this->redirect("@view_all_projects");

	}

	/**
	 * VIEW_ALL_PROJECTS REDIR FUNCTION
	 *
	 * @param sfWebRequest $request
	 */
	public function executeAllTasksRedirView(sfWebRequest $request){


		$pid = $this->getUser()->getFlash('pid');
		$this->project = Doctrine::getTable('Project')->find(array($this->accountId, $pid));
		$this->projects = Doctrine::getTable('Project')->findByAccountId($this->accountId);
		$this->openProjects = Util::userPrefOpenProjects($this->accountId, $this->userId, $pid);

		
		$this->setTemplate("allTasksView");

	}


	public function executeCloseProject(sfWebRequest $request){
		$pid = $request->getParameter('pid');
		$this->project = Doctrine::getTable('Project')->find(array($this->accountId, $pid));
		$this->openProjects = Util::userPrefOpenProjects($this->accountId, $this->userId, $pid);

		return sfView::NONE;
	}

	/**
	 * Open Project
	 *
	 * @param sfWebRequest $request
	 */
	public function executeOpenProject(sfWebRequest $request){
		$pid = $request->getParameter('pid');
		$this->project = Doctrine::getTable('Project')->find(array($this->accountId, $pid));
		$this->openProjects = Util::userPrefOpenProjects($this->accountId, $this->userId, $pid);
		return $this->renderPartial("openProject");
	}





}
