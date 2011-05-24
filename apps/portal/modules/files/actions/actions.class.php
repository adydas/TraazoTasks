<?php

/**
 * files actions.
 *
 * @package    protoglue_sym12
 * @subpackage files
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class filesActions extends kodaziActions
{


	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeUpload(sfWebRequest $request)
	{
		$c = 0;
		$aid = $this->accountId;
		$account = self::getAccount($aid);

		$pid =  $request->getParameter('pid');
		$project = Doctrine::getTable('Project')->find($pid);
		$this->pid = $pid;

		$form = new NutshellUploadForm($project);

		$files = Util::getFiles(sfConfig::get('app_account-files_location').'/'.$account->getId().'/');

		$filez = array();
		foreach ($files as $f){
			$filez[$c++] = str_replace(sfConfig::get('app_account-files_location').'/'.$account->getId(), "", $f);

		}

		
		$this->location = sfConfig::get('app_account-files_location').'/'.$account->getId();
		
		
		
		if (!$this->getRequest()->isMethod('post')){
			$this->form = $form;
		}else{
				
				
				
			$form->bind ($request->getParameterHolder ()->getAll (), $request->getFiles ());
			
			print_r ($request->getParameterHolder ()->getAll ());
			
				
			if (($this->success = $form->isValid ())) {
				$projectId = $request->getParameter (NutshellUploadForm::PROJECT_ID);
				$file = $form->getValue (NutshellUploadForm::FILE);
				
				$description = $form->getValue (NutshellUploadForm::DESCRIPTION);
				$dir = $request->getParameter(NutshellUploadForm::FOLDER);
				$isNewVersion = $request->getParameter(NutshellUploadForm::NEW_VERSION);
				$tid =  $request->getParameter(NutshellUploadForm::TASK_ID);

				$con = Doctrine_Manager::connection();
				try {
					$con->beginTransaction();
					
					$filez = kodaziFileUpload::createFile($projectId, $account, $this->userId, $file, $isNewVersion, $con);

					if ($tid && $filez){

						$fileTask = Doctrine::getTable('FileTask')
								->createQuery('ft')
								->where('ft.file_id = ?', $filez->getFileId())
								->addWhere('ft.task_id = ?', $tid)
								->fetchOne();
						
						if (!$fileTask){
							$fileTask = new FileTask();
							$fileTask->setFileId($filez->getFileId());
							$fileTask->setTaskId($tid);
							$fileTask->save($con);
						}
					}

					$con->commit();

				} catch (Doctrine_Exception $e) {
					$con->rollback();
					error_log ($e->getMessage());
				}


				$this->redirect("@project_files?pid=".$projectId);

					
			}else{

			}
				
		}



	}







	/**
	 * Utility function to handle file upload
	 *
	 * @param unknown_type $fieldName
	 * @return unknown
	 */
	private function uploadFile($fieldName){
		//Uploaded file info
		$ARK_EXT = '.rba';

		//get File from Form Post
		$file = $_FILES[$fieldName];

		$fname=$_FILES[$fieldName]['name'];
		$ftmp=$_FILES[$fieldName]['tmp_name'];
		$ftype=$_FILES[$fieldName]['type'];

		//Check file upload error START
		switch($_FILES[$fieldName]['error']){
			case 0:
				$submitSuccess = true;
				$error = 'Succesful upload';
				break;
			case 1:
				$submitError = true;
				$error = 'Image exceeds the php.ini maximum size of '. ini_get('upload_max_filesize');
				break;
			case 2:
				$submitError = true;
				$error = 'Size too large';
				break;
			case 3:
				$submitError = true;
				$error = 'The uploaded file was only partially uploaded';
				break;
			case 4:
				$submitError = true;
				$error = 'No file was uploaded<br />';
				break;
		}

		if ($submitError){
			error_log ("File save error - " . $error);
			$this->error = $error;
			return sfView::SUCCESS;

		}
		//Check file upload error END


		$file_ext = substr($fname, strripos($fname, '.'));

		if ($file_ext != $ARK_EXT){
			$this->error = 'File ' .$fname .' of type '. $file_ext .' uploaded. Must upload a Rockband archive file';
			return sfView::SUCCESS;
		}

		return array('tmp'=>$ftmp, 'name'=>$fname, 'type'=>$ftype);

	}


}
