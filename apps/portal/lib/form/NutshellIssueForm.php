<?php

class NutshellIssueForm extends sfForm {
	const PROJECT_ID = 'pid';
	const TASK_ID = 'task_id';
	const REPORTER_ID  = 'reporter_id';
	const ASSIGNED_TO_ID  = 'assigned_to';
	const SUMMARY = 'summary';
	const DESCRIPTION = 'description';
	const RELATED_TASK = 'tasks_rlated';
	const FILE = 'nutshell_file';
	const UPLOAD_ID = 'upload_id';
	const STATUS = 'status_id';

	private $project_id;
	private $tasks;
	private $accountUsers;
	private $reporterId;
	
   public function __construct ($project, $uid)
   {
    $this->project_id = $project->getProjectId();
    $this->tasks = $project->getTasks();
    $this->accountUsers = $project->getProjectAccount()->getAccount()->getAccountUser();
    $this->reporterId = $uid;
   	parent::__construct ();
   }

	public function configure ()
	{
		parent::configure ();
		
		$this->setDefaults();

		$this->setWidget    (self::FILE, new sfWidgetFormInputFile ());
		$this->setValidator (self::FILE, new sfValidatorFile(array(
      													'required'   => false)));
		
		$this->setWidget    (self::DESCRIPTION, new sfWidgetFormTextarea (array(), 
					array('rows' => 8, 'class' => 'autoExpand')));

		$this->upload_id = time () . '_' . mt_rand ();
		
		
		$this->setWidget    (self::UPLOAD_ID, new sfWidgetFormInputHidden (array ('default' => $this->upload_id)));
		
		$this->setWidget    (self::REPORTER_ID, new sfWidgetFormInputHidden (array ('default' => $this->reporterId)));
		

		$this->setWidget    (self::SUMMARY, new sfWidgetFormInput (array ()));
		
		$this->setWidget    (self::PROJECT_ID, new sfWidgetFormInputHidden (array ('default' => $this->project_id)));
	
		foreach ($this->tasks as $t){
			$tchoices[$t->getTaskId()] = $t->getName();
		}
		$this->setWidget    (self::TASK_ID, new sfWidgetFormChoice(array('choices' => $tchoices)));
		
		$statuses = sfConfig::get('app_issue-status');
		
		foreach ($statuses as $k=>$s){
			$status[$k] =  $s;
		}
		$this->setWidget    (self::STATUS, new sfWidgetFormChoice(array('choices' => $status)));
		
		foreach ($this->accountUsers as $au){
			$choices[$au->getUser()->getId()] =  $au->getUser()->getProfile()->getFirstName() . ' ' . $au->getUser()->getProfile()->getLastName();
		}
		$this->setWidget    (self::ASSIGNED_TO_ID, new sfWidgetFormChoice(array('choices' => $choices)));
		
		
		$this->validatorSchema->setOption ('allow_extra_fields', true);
	}

	public function getUploadID ()
	{
		return $this->upload_id;
	}
	
	public function setProjectId ()
	{
		return $this->project_id;
	}
}
