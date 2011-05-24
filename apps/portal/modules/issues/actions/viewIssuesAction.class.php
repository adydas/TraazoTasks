<?php

class viewIssuesAction extends kodaziAction{


	public function execute($request) {
		$pid =  $request->getParameter('pid');
		$project = Doctrine::getTable('Project')->find($pid);
		$this->issues = $project->getIssue();
	}

}
?>