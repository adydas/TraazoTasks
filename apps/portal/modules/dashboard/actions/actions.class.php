<?php

/**
 * dashboard actions.
 *
 * @package    protoglue_sym12
 * @subpackage dashboard
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class dashboardActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //get the account name from the sub-domain (set in index.php)
  	$accountName =  $this->getUser()->getAttribute('account_name');
  	
  	if ($accountName != "all"){
  		
  		$account = Doctrine_Query::create()
				->from ('Account a')
				->leftJoin('a.Domain d')
				->where ('a.name = ?', $accountName)
				->fetchOne();
		
		if ($account){
			$this->getUser()->setAttribute('aid', $account->getId());
		}
  		
		$this->redirect('@sf_guard_signin');
  	}
  	
  	return sfView::SUCCESS;
  }
}
