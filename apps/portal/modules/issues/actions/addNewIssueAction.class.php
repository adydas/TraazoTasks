<?php

class addNewIssueAction extends kodaziAction{


	public function execute($request) {
		$uid = $this->getUser()->getGuardUser()->getId();


		$aid = $this->accountId;
		$account = self::getAccount($aid);

		$pid =  $request->getParameter('pid');
		$project = Doctrine::getTable('Project')->find($pid);
		$this->pid = $pid;

		$form = new NutshellIssueForm($project, $uid);

		if (!$this->getRequest()->isMethod('post')){
			$this->form = $form;
		}else{

			$form->bind ($request->getParameterHolder()->getAll (), $request->getFiles ());
			
			if (($this->success = $form->isValid ())) {
				$projectId = $request->getParameter (NutshellIssueForm::PROJECT_ID);
				$file = $form->getValue (NutshellIssueForm::FILE);
				$summary = $request->getParameter (NutshellIssueForm::SUMMARY);
				$description = $request->getParameter (NutshellIssueForm::DESCRIPTION);
				$tid =  $request->getParameter(NutshellIssueForm::TASK_ID);
				$repid =  $request->getParameter(NutshellIssueForm::REPORTER_ID);
				$assgnid =  $request->getParameter(NutshellIssueForm::ASSIGNED_TO_ID);
				$statusId = $request->getParameter(NutshellIssueForm::STATUS);
				


				$con = Doctrine_Manager::connection();

				try {
					$con->beginTransaction();

					$issue = new Issue();
					$issue->setStatus($statusId);
					$issue->setProjectId($projectId);
					$issue->setReportedBy($repid);
					$issue->setAssignedTo($assgnid);
					$issue->setSummary($summary);
					$issue->setDescription($description);
					$issue->setCreated($this->getCurrentTime());
					$issue->setUpdated($this->getCurrentTime());
					$issue->save($con);

					if ($tid){
						$it = new IssueTask();
						$it->setTaskId($tid);
						$it->setIssueId($issue->getIssueId());
						$it->save($con);
					}

					if ($file){
						$filez = kodaziFileUpload::createFile($projectId, $account, $this->userId, $file, $isNewVersion, $con);
						if ($filez){
							$fileIssue = new FileIssue();
							$fileIssue->setFileId($filez->getFileId());
							$fileIssue->setIssueId($issue->getIssueId());
							$fileIssue->save($con);
						}
					}
					
					
					$it = new IssueTracker();
					$it->setIssueId($issue->getIssueId());
					$it->setTrackInfo(serialize($issue->toArray(true)));
					$it->save($con);

					$con->commit();

				} catch (Doctrine_Exception $e) {
					$con->rollback();
					error_log ($e->getMessage());
				}

			}else{

			}

			
			$this->redirect('@issue_view?pid='.$projectId);
			
		}


	}

}
?>