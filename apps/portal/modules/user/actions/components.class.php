<?php

class userComponents extends sfComponents {


	public function executeAddUsers(sfWebRequest $request){
		 
		$accountId = $this->getUser()->getAttribute('aid');
		if ($accountId){
			
			//set all account users
			$this->accountUsers = Doctrine::getTable('AccountUser')->findByAccountId($accountId);
			
			$this->pid = $this->getRequestParameter( 'pid' );
			$this->projectUsers = Doctrine::getTable('ProjectUser')->findByProjectId($this->pid);
		}

	}
	
	
	public function executeAddAccountUsers(sfWebRequest $request){
		 
		$accountId = $this->getUser()->getAttribute('aid');
		if ($accountId){
			$this->aid = $accountId;
			$this->accountUsers = Doctrine::getTable('AccountUser')->findByAccountId($accountId);
		}

	}
	
	public function executeAccountUsers(sfWebRequest $request){
		 
		$accountId = $this->getUser()->getAttribute('aid');
		if ($accountId){
			$this->aid = $accountId;
			$this->accountUsers = Doctrine::getTable('AccountUser')->findByAccountId($accountId);
		}

	}


}
