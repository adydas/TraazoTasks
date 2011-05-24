<?php

/**
 * messages actions.
 *
 * @package    protoglue_sym12
 * @subpackage messages
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class messagesActions extends kodaziActions
{
	
	public function executeViewRecentProjectMessgs(sfWebRequest $request)
	{
		//getprojectId from session 
		$this->pid = $this->getRequestParameter( 'pid' );
		
		$q = Doctrine_Query::create()
			->select('m.*')
			->from('Message m')
			->where('m.project_id = ?', $this->pid)
			->andWhere('m.messg_sub_id is null')
			->orderBy('m.created desc');
			
		$this->messages = $q->execute();
		
		return sfView::SUCCESS;
	}
	
	public function executeDelete(sfWebRequest $request)
	{
		$mgid = $this->getRequestParameter( 'mgid' );
		$mgsid = $this->getRequestParameter( 'mgsid' );
		$pid = $this->getRequestParameter( 'pid' );
		
		
		$message = Doctrine::getTable('Message')->find($mgid);
		$message->delete();
		
		return $this->redirect('@view_recent_project_messages?pid='.$pid);
	}

}
