<?php

/**
 * project actions.
 *
 * @package    protoglue_sym12
 * @subpackage project
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class projectActions extends kodaziActions
{


	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->forward('project', 'view');
	}

	public function executeView(sfWebRequest $request)
	{
		return sfView::SUCCESS;
	}

	public function executeHub(sfWebRequest $request)
	{
		$pid = $request->getParameter('pid');
		
		if ($pid == null){
			$this->redirect('@hub_route');
		}else{
			$this->getUser()->setAttribute('pid', $pid);
		}
		
		

		$this->projectAccount = Doctrine::getTable('ProjectAccount')->findOneByProjectId($pid);
		return sfView::SUCCESS;

	}

	public function executeDelete(sfWebRequest $request)
	{

		$this->pid = $request->getParameter('pid');

		if (!$this->getRequest()->isMethod('post')){
			$this->setTemplate("confirmProjectDelete");
			return sfView::SUCCESS;
		}else{
			$project = Doctrine::getTable('Project')->find($this->pid);
			$project->delete();
		}

		$this->redirect('@hub_route');

	}

	public function executeEdit(sfWebRequest $request)
	{

		$this->pid = $request->getParameter('pid');

		if (!$this->getRequest()->isMethod('post')){
			return $this->renderComponent('project', 'edit', array('pid' => $this->pid));
		}else{
				
			$name = $request->getParameter('projectName');
			$description = $request->getParameter('description');
			$status = $request->getParameter('status');
				
			$project = Doctrine::getTable('Project')->find($this->pid);

			$project->setName($name);
			$project->setDescription($description);
			$project->setStatus($status);
			$project->save($con);
			
			$this->renderText($name . " has been updated.");
			
			return sfView::NONE;
				
		}

		$this->redirect($this->getRequest()->getUri());

	}


	public function executeCreate(sfWebRequest $request)
	{
		$acctId = $this->accountId;

		if ($acctId == null){
			$this->redirect('@hub_route');
		}

		$this->account = Doctrine::getTable('Account')->find($acctId);
		//$this->projectAccounts = Doctrine::getTable('ProjectAccount')->findByAccountId($acctId);

		if (!$this->getRequest()->isMethod('post')){
			return sfView::SUCCESS;
		}else {

			//TODO: fix user perms
			/**
			if (!$user->hasPerm()){
			throw new Exception (sfConfig::get('app_error_permission'));
			}
			*/

			$name = $request->getParameter('projectName');
			$description = $request->getParameter('description');
			$startDate = $request->getParameter('startDate');
			$endDate = $request->getParameter('endDate');
			
			
			$user = $this->getUser( )->getGuardUser( );

			$con = Doctrine_Manager::connection();
			try {

				$con->beginTransaction();
					
				//save Project
				$project = new Project();
				$project->setId($this->account->getNewProjectId());
				$project->setAccountId($acctId);
				$project->setCreated(date("Y-m-d H:i:s"));
				$project->setCreatedBy($user->getId());
				$project->setName($name);
				$project->setDescription($description);
				$project->setStatus(sfConfig::get('app_project-status_active'));
				$project->save($con);
				
				//create empty group for orphaned tasks
				$group = new Group();
				$group->setAccountId($acctId);
				$group->setProjectId($project->getId());
				$group->setId(0);
				$group->setName('EMPTY');
				$group->save();
				

				//create default team
				$team = new Team();
				$team->setProjectId($project->getId());
				$team->setName("DEFAULT");
				$team->setCreated(date("Y-m-d H:i:s"));
				$team->save($con);
				
				$con->commit();


			} catch (Doctrine_Exception $e) {
				$con->rollback();
				error_log ($e->getMessage());
			}
				$this->renderText($name ." added Successfully");
				
		}
		
		return sfView::NONE;


	}
	
	
	public function executeViewProjects(sfWebRequest $request){
		return $this->renderComponent("project", "showProjects");
	}

	public function executeMilestoneView(sfWebRequest $request){

		$mid = $request->getParameter('mid');
		$this->mid = $mid;

		$this->milestone = Doctrine::getTable('Milestone')->find($mid);

		return sfView::SUCCESS;

	}

	public function executeMilestoneDelete(sfWebRequest $request){

		$mid = $request->getParameter('mid');

		if ($mid == null){
			$this->redirect('@hub_route');
		}

		$milestone = Doctrine::getTable('Milestone')->find($mid);
		$pid = $milestone->getProjectId();

		//delete all tasks
		$tasks = $milestone->getTask();
		foreach ($tasks as $task){
			$task->delete();
		}

		//delete Milestone
		$milestone->delete();

		$this->redirect('@project_hub?pid='.$pid);

	}


	public function executeMilestoneCreate(sfWebRequest $request){

		$pid = $request->getParameter('pid');
		$this->pid = $pid;

		if ($pid == null){
			$this->redirect('@hub_route');
		}

		//get accountId from session
		$accountId = $this->getUser()->getAttribute('aid');

		$this->project = Doctrine::getTable('Project')->find($pid);
		$projectAccounts = Doctrine::getTable('ProjectAccount')->findByAccountId($accountId);
		$project = array();
		foreach ($projectAccounts as $pa){
			$project[] = $pa->getProject();
		}
		$this->projects = $project;


		$projectUsers = Doctrine::getTable('ProjectUser')->findByProjectId($pid);
		$profiles = array();
		$ii = 0;
		foreach ($projectUsers as $pu){
			$profiles[$ii++] =  $pu->getUser()->getProfile();
		}

		$this->profiles = $profiles;

		if (!$this->getRequest()->isMethod('post')){
			return sfView::SUCCESS;
		}else {


			$milestoneName = $this->getRequestParameter("milestoneName");
			$targetDate = $this->getRequestParameter("targetDate");
			$projectId = $this->getRequestParameter("projectId");
			$taskId = $this->getRequestParameter("taskId");
			$priOwn = $this->getRequestParameter("priOwn");
			$secOwn = $this->getRequestParameter("secOwn");
			$description = $this->getRequestParameter("description");

			$con = Doctrine_Manager::connection();

			try {

				$con->beginTransaction();
				$milestone = new Milestone();
				$milestone->setCreatedBy($this->getUser()->getGuardUser()->getId());
				$milestone->setName($milestoneName);
				$milestone->setEndTime($targetDate);
				$milestone->setProjectId($projectId);
				$milestone->setPrimaryOwner($priOwn);
				$milestone->setSecOwner($secOwn);
				$milestone->setDescription($description);
				$milestone->setCreated(date("Y-m-d H:i:s"));
				$milestone->setStatus(1);
					
				$milestone->save($con);
					
			} catch (Doctrine_Exception $e) {
				$con->rollback();
				error_log ($e->getMessage());
			}
			$con->commit();

			$this->redirect("@project_hub?pid=".$pid);

		}
	}
	
	


	public function executeAddUsers(sfWebRequest $request){

		$userIds = $request->getParameter('userIds[]');
		$projectId = $request->getParameter('pid');


		//get team
		$team = Doctrine::getTable('Team')->findOneByProjectId($projectId);

		$con = Doctrine_Manager::connection();
		try {

			$con->beginTransaction();
				
			if (!$team){
				$team = new Team();
				$team->setProjectId($projectId);
				$team->setName("DEFAULT");
				$team->setCreated(date("Y-m-d H:i:s"));
				$team->save();
			}

			foreach ($userIds as $userId){
				$projectUser = new ProjectUser();
				$projectUser->setProjectId($projectId);
				$projectUser->setUserId($userId);
				$projectUser->setTeam($team->getTeamId());
				$projectUser->save();
			}
				
			$con->commit();
				
		}catch (Doctrine_Exception $e) {
			$con->rollback();
			error_log ($e->getMessage());
		}

		return sfView::SUCCESS;

	}
	

	
	
	public function executeProjectUsers(sfWebRequest $request){
		
		$projectId = $request->getParameter('pid');
		
		$output = array("title" => "My basic letter", "name" => "Mr Brown");
		return $this->returnJSON($output);
	}
	
	
	/**
	 * Enter description here...
	 *
	 * @param sfWebRequest $request
	 */
	public function executeGetProjectTabSeq(sfWebRequest $request){
		$userPref = Doctrine::getTable("UserPref")->find(array($this->accountId, $this->userId));
		$prefs = unserialize($userPref->prefs);
		if ($userPref){
			$prefs = unserialize($userPref->prefs);
			$project_tabs_seq = $prefs['projects_tabs_seq'];
			return $this->returnJSON($project_tabs_seq);
		}
		
		return null;
	}
	
	
	/**
	 * Parameter "p" must be of the form p[]=x&p[]=y&p[]=z
	 *
	 * @param sfWebRequest $request
	 */
	public function executeSaveProjectTabSeq(sfWebRequest $request){
		
		$pids = $request->getParameter('p[]');
		Util::userPrefOpenProjectTabSequence($this->accountId, $this->userId, $pids);
		return sfView::NONE;
	}
	

}
