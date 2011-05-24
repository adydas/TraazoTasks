<?php
require_once sfConfig::get('sf_plugins_dir').
    '/sfDoctrineGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php';

/**
 * Extend to use list schema formatter
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{

	/**
	 * If accountId is set ensure that logged in user is part of this account
	 *
	 */
	public function postExecute(){
		$user = $this->getUser();
		if ($user->isAuthenticated()){
			//get the account name from the sub-domain (set in index.php)
			$accountName =  $this->getUser()->getAttribute('account_name');
			 
			if ($accountName != "all"){

				$accountUser = Doctrine_Query::create()
				->from ('Account a')
				->leftJoin('a.Domain d')
				->leftJoin('a.AccountUser au')
				->where ('a.name = ?', $accountName)
				->andWhere('au.user_id = ?', $this->getUser()->getId())
				->fetchOne();

				if (!$accountUser){
					$this->getUser()->setAttribute('aid', null);
					$this->getUser()->setAttribute('account_name', null);
					
					parent::executeSignout($request);
					$this->redirect('@home');
				}
			}
		}
		 
	}


	public function executeSignout($request)
	{
		$this->getUser()->setAttribute('aid', null);
		parent::executeSignout($request);
	}


}
?>
