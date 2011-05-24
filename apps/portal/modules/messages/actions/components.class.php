<?php

/**
 * Messages components
 *
 */
class messagesComponents extends sfComponents
{
	public function executeCreateMessage()
	{
		$this->pid = $this->getRequestParameter( 'pid' );
		$this->messgId = $this->getRequestParameter( 'mgid' );
		$this->messages = array();
		
	}
	
	public function executeViewMessages()
	{
		$accountId = $this->getUser()->getAttribute('aid');
		$this->messages = Doctrine::getTable('Messages')->findByAccountId($accountId);
		
	}
    
}
?>