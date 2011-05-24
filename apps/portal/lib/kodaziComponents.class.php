<?php

class kodaziComponents extends sfComponents {
	
	public $accountId;
	
	/**
	 * Get projectId from session
	 *
	 * @return unknown
	 */
	public function getProjectId(){
		return $this->getUser()->getAttribute('pid');
	}
	
	public function getAccountId(){
		$this->accountId = $this->getUser()->getAttribute('aid');
		return $this->accountId;
	}
	
	
	
}