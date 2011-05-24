<?php

/**
 * profile actions.
 *
 * @package    protoglue_sym12
 * @subpackage profile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class profileActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		return sfView::SUCCESS;
	}


	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeHub(sfWebRequest $request)
	{
		$user = $this->getUser( )->getGuardUser( );

		//remove account/domain from session if it was in there
		$this->getUser()->getAttributeHolder()->remove('aid');

		$accounts = Doctrine::getTable('Account')->findByUserId($user->getId());

		//if only 1 account exists go there directly
		if ( sizeof ($accounts) == 1 ){
			$this->redirect ("@account_hub?aid=" . $accounts[0]->getId());
		}
			
		//if multiple accounts exist then show all
		$this->accounts = $accounts;
		return sfView::SUCCESS;
	}

	public function executeEdit(sfWebRequest $request)
	{


		if (!$this->getRequest()->isMethod('post')){
			return sfView::SUCCESS;
		}else{
			$fname = $request->getParameter('firstName');
			$lname = $request->getParameter('lastName');
				
			$city = $request->getParameter('city');
			$street1 = $request->getParameter('street1');
			$street2 = $request->getParameter('street2');
			$zip = $request->getParameter('zip');
				
			$telephone = $request->getParameter('telephone');
				
			$password = $request->getParameter('password');
			$passwordRepeat = $request->getParameter('passwordRepeat');
				
			if (strlen (trim($password)) > 0){
				if ($password != $passwordRepeat){
					$this->error = "Passwords do not match";
					return sfView::SUCCESS;
				}
			}
				
			$con = Doctrine_Manager::connection();
			try {

				$con->beginTransaction();
				$user = $this->getUser( )->getGuardUser( );

				if (strlen (trim($password)) > 0){
					$userGuard = Doctrine::getTable('sfGuardUser')->find($user->getId());
					if (!$userGuard){
						return sfView::ERROR;
					}
					//save new password
					$userGuard->setPassword($password);
					$userGuard->save();
				}

				$profile = $user->getProfile();
				$profile->setFirstName($fname);
				$profile->setLastName($lname);
				$profile->save();

				$address = $profile->getAddress();
				$address->setStreet_1($street1);
				$address->setStreet_2($street2);
				$address->setCity($city);
				$address->setZip($zip);

				//TODO: Add diff types of phone
				$phone = $address->getPhone();
				$phone->setNumber($telephone);
				$phone->setCreated(date("Y-m-d H:i:s"));
				$phone->setType(1); //HOME
				$address->setPhone($phone);
				
				$address->save();

				

			} catch (Exception $e) {
				$con->rollback();
				error_log ($e->getMessage());
			}
			
			$con->commit();
				
		}

		return sfView::SUCCESS;

	}

}
