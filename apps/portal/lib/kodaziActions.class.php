<?php

class kodaziActions extends sfActions
{
	
	var $projectId = null;
	
	/**
	 * Checks
	 *
	 */
	public function preExecute() {
		
		
		
		//check unauthorized access
		$accountId = $this->getUser()->getAttribute('aid');
		if ($accountId){

			$userId = $this->getUser()->getGuardUser()->getId();

			$q = new Doctrine_Query();
			$q->select('aur.*');
			$q->from('AccountUserRole aur');
			$q->where('aur.account_id = ? and aur.user_id = ?', array($accountId, $userId));
			$aur = $q->fetchOne();

			//unauthorized access
			if (!$aur){
				$this->forward("error", "unauthorized");
			}
			
			$this->userId = $userId;
			$this->accountId = $accountId;
			
			
			$this->projectId = $this->getUser()->getAttribute('pid');
			
			$this->module  = $this->getContext()->getModuleName();
			$this->action  = $this->getContext()->getActionName();
			
		}


	}
	
	public function getProjectId(){
		return $this->projectId;
	}


	/**
	 * Return in JSON when requested via AJAX or as plain text when requested directly in debug mode
	 *
	 */
	public function returnJSON($data)
	{
		$json = json_encode($data);

		if (SF_DEBUG && !$this->getRequest()->isXmlHttpRequest()) {
			sfLoader::loadHelpers('Partial');
			$json = get_partial('includes/json', array('data' => $data));
		} else {
			$this->getResponse()->setHttpHeader('Content-type', 'application/json');
		}

		return $this->renderText($json);
	}


	public static function getAccount($accountId){

		if ($accountId){
			return Doctrine::getTable('Account')->find($accountId);
		}

		return null;
	}


	/**
	 * Utility function that creates a User
	 *
	 * @param unknown_type $username
	 * @param unknown_type $password
	 * @return unknown
	 */
	public function createNewUser($username, $password, $fname, $lname, $aid=null, $accountRole=2){

		//set this user type
		$userType = sfConfig::get('app_user-type_user');

		//TODO: fix user-type for domain

		$newUser = new sfGuardUser();
		$newUser->setUsername($username);
		$newUser->setPassword($password);
		$newUser->setCreatedAt(date("Y-m-d H:i:s"));
		$newUser->save();

		$guardUserGroup = new sfGuardUserGroup();
		$guardUserGroup->setGroupId($userType);
		$guardUserGroup->setUserId($newUser->getId());
		$guardUserGroup->save();

		$address = new Address();
		$address->setCreated(date("Y-m-d H:i:s"));
		$address->save();

		$userAddress = new UserAddress();
		$userAddress->setUserId($newUser->getId());
		$userAddress->setAddressId($address->getAddressId());
		$userAddress->setType('PRIMARY');
		$userAddress->setCreated(date("Y-m-d H:i:s"));
		$userAddress->save();

		$email = new Email();
		$email->setEmail($username);
		$email->setUserId($newUser->getId());
		$email->setCreated(date("Y-m-d H:i:s"));
		$email->save();


		$profile = new Profile( );
		$profile->setAddressId($userAddress->getAddressId());
		$profile->setUserId( $newUser->getId() );
		$profile->setFirstName($fname);
		$profile->setLastName($lname);
		$profile->setCreated(date("Y-m-d H:i:s"));
		$profile->save();

		if ($aid){
			$accountUser = new AccountUser();
			$accountUser->setAccountId($aid);
			$accountUser->setUserId($newUser->getId());
			$accountUser->setCreated(date("Y-m-d H:i:s"));
			$accountUser->save();


			$aur = new AccountUserRole();
			$aur->setAccountId($aid);
			$aur->setRoleId($accountRole); //sfConfig::get('app_account-role_owner')
			$aur->setUserId($newUser->getId());
			$aur->setCreated(date("Y-m-d H:i:s"));
			$aur->save();
		}

		return $newUser;
	}

}

?>