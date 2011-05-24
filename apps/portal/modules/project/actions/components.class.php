<?php

class projectComponents extends kodaziComponents {


	public function executeEdit(sfWebRequest $request){
		 
		$pid = $request->getParameter('pid');
		$this->project = Doctrine::getTable('Project')->find($pid);
	}
	

	public function executeShowProjects(sfWebRequest $request){
		$acctId = $this->getUser()->getAttribute('aid');
		$this->projects = Doctrine::getTable('Project')->findByAccountId($acctId);
	}
	

	public function executeShowAccountTasks(sfWebRequest $request){
		$acctId = $this->getUser()->getAttribute('aid');
		$this->tasks = Doctrine::getTable('Task')->getTasksByAccount($acctId);
	}

}
