<?php

class taskComponents extends kodaziComponents {


	public function executeProjectTabs(sfWebRequest $request){
  		$pid = $request->getParameter('pid');
		$this->pid = $pid;
		$this->projects = Doctrine::getTable('Project')->findByAccountId($this->getAccountId());
		$this->module  = $this->getContext()->getModuleName();
		$this->action  = $this->getContext()->getActionName();
  	}


	public function executeShowMilestoneTasks(sfWebRequest $request){
		$mid = $request->getParameter('mid');

		if ($mid == null){
			$this->redirect('@hub_route');
		}
		$this->milestone = Doctrine::getTable('Milestone')->find($mid);
	}
	
	
	public function executeShowAllTasks(sfWebRequest $request){
		$pid = $request->getParameter('pid');
		$project = Doctrine::getTable('Project')->find($pid, $this->getAccountId());
		$this->groups = $project->getGroups();
		
		$this->tasksSansMilestones = Doctrine::getTable('Task')->getTasksSansMilestones($pid);
	}
	
	public function executeShowProjectTasks(sfWebRequest $request){
		$pid = $request->getParameter('pid');
		$tasks = Doctrine::getTable('Task')->getTasksByProject($pid);
		
		$splitTimeTasks = $this->splitTasksByTime($tasks);
		$this->pastDue = $splitTimeTasks['past'];
		$this->todayDue = $splitTimeTasks['today'];
		$this->futureDue = $splitTimeTasks['future'];
		
	}
	
	public function executeShowUserTasks(sfWebRequest $request){
		$uid = $request->getParameter('uid');
		$acctId = $this->getUser()->getAttribute('aid');
		$this->tasks = Doctrine::getTable('Task')->getTasksByOwner($uid, $acctId);
	}
	
	
	public function executeShowUserProjectTasks(sfWebRequest $request){
		$pid = $request->getParameter('pid');
		$uid = $this->getUser()->getGuardUser()->getId();
		$tasks = Doctrine::getTable('Task')->getTasksByProjectUser($uid, $pid);
		
		$splitTimeTasks = $this->splitTasksByTime($tasks);
		$this->pastDue = $splitTimeTasks['past'];
		$this->todayDue = $splitTimeTasks['today'];
		$this->futureDue = $splitTimeTasks['future'];
	}
	
	
	public function executeShowAccountTasks(sfWebRequest $request){
		$acctId = $this->getUser()->getAttribute('aid');
		$this->tasks = Doctrine::getTable('Task')->getTasksByAccount($acctId);
	}
	
	public function executeProjectTaskCreate(sfWebRequest $request){

		$pid = $request->getParameter('pid');
		$project = Doctrine::getTable('Project')->find(array($this->getAccountId(), $pid));
		$this->groups = $project->getGroups();
		
		$accountUsers = Doctrine::getTable('AccountUser')->findByAccountId($this->accountId);
		$profiles = array();
		$ii = 0;
		foreach ($accountUsers as $au){
			$profiles[$ii++] =  $au->getUser()->getProfile();
		}

		$this->project = $project;
		$this->profiles = $profiles;

	}
	
	private function splitTasksByTime($tasks){
		$pastDue = array();
		$todayDue = array();
		$futureDue = array();
		
		$today = date( 'Y-m-d', time() );
		$c = 0;
		$cc = 0;
		$ccc = 0;
		
		foreach ($tasks as $t){
			if (date( 'Y-m-d', strtotime($t['due_date'])) == $today){
				$todayDue[$c++] = $t;
			}else if (date( 'Y-m-d', strtotime($t['due_date'])) > $today){
				$futureDue[$cc++] = $t;
			}else{
				$pastDue[$ccc++] = $t;
			}
		}
		
		return array('past'=>$pastDue, 'today'=>$todayDue, 'future'=>$futureDue);
	}

}
