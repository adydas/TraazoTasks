<?php

class NutshellUploadForm extends sfForm {
	const FILE      = 'nutshell_file';
	const FOLDER      = 'nutshell_folder';
	const DESCRIPTION      = 'description';
	const UPLOAD_ID = 'upload_id';
	const PROJECT_ID = 'pid';
	const NEW_VERSION = 'new_version';
	const TASK_ID = 'task_id';

	private $upload_id;
	private $project_id;
	private $tasks;
	
   public function __construct ($project)
   {
    $this->project_id = $project->getProjectId();
    $this->tasks = $project->getTasks();
   	parent::__construct ();
   }

	public function configure ()
	{
		parent::configure ();
		
		$this->setDefaults();

		$this->setWidget    (self::FILE, new sfWidgetFormInputSWFUpload ());
		$this->setValidator (self::FILE, new sfValidatorFile ());
		
		$this->setWidget    (self::FOLDER, new sfWidgetFormInput ());
		$this->setWidget    (self::NEW_VERSION, new sfWidgetFormInputCheckbox ());
		$this->setWidget    (self::DESCRIPTION, new sfWidgetFormTextarea (array(), 
					array('rows' => 8, 'class' => 'autoExpand')));
		//$this->setValidator (self::DESCRIPTION, new sfValidatorString (array('max_length'=>1000)));

		$this->upload_id = time () . '_' . mt_rand ();

		$this->setWidget    (self::UPLOAD_ID, new sfWidgetFormInputHidden (array ('default' => $this->upload_id)));
		
		$this->setWidget    (self::PROJECT_ID, new sfWidgetFormInputHidden (array ('default' => $this->project_id)));
	
		foreach ($this->tasks as $t){
			$choices[$t->getTaskId()] = $t->getName();
		}
		$this->setWidget    (self::TASK_ID, new sfWidgetFormChoice(array('choices' => $choices)));
		
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
