<?php

/**
 * account actions.
 *
 * @package    protoglue_sym12
 * @subpackage account
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class accountActions extends kodaziActions
{
	
	public function executeTestEmail(sfWebRequest $request){
		$connection = new Swift_Connection_Sendmail();
		$mailer = new Swift($connection);

		$message = new Swift_Message('You are invited to join a Kodazi account');

		// Render message parts
		$mailContext = array('aid' => 123, 'username' => 'test', 'password' => 'test');
		$message->attach(new Swift_Message_Part($this->getPartial('email/inviteUserHtml', $mailContext), 'text/html'));
		$message->attach(new Swift_Message_Part($this->getPartial('email/inviteUserText', $mailContext), 'text/plain'));

		// Send
		$mailer->send($message, 'ady@hottiestats.com', "concierge@kodazi.com");
		$mailer->disconnect();
		
		echo "MAIL SENT";
		
		return sfView::NONE;
		
		
	}
	
	public function executeManage(sfWebRequest $request)
	{

		$acctId = $this->getUser()->getAttribute('aid');

		if ($acctId == null){
			$this->redirect('@hub_route');
		}

		$this->account = Doctrine::getTable('Account')->find($acctId);
		return sfView::SUCCESS;
	}
	
	public function executeViewBilling(sfWebRequest $request)
	{

		$acctId = $this->getUser()->getAttribute('aid');

		if ($acctId == null){
			$this->redirect('@hub_route');
		}

		$this->account = Doctrine::getTable('Account')->find($acctId);
		return sfView::SUCCESS;
	}


	public function executeChangeOwner(sfWebRequest $request){
		$acctId = $this->getUser()->getAttribute('aid');

		if ($acctId == null){
			$this->redirect('@hub_route');
		}

		$this->accountUsers = Doctrine::getTable('AccountUserRole')->findByAccountId($acctId);
		
		if (!$this->getRequest()->isMethod('post')){
			return sfView::SUCCESS;
		}else{
			
			$ownerId = $request->getParameter('owner');
			
			$q = new Doctrine_Query();
			$q->select('aur.*');
			$q->from('AccountUserRole aur');
			$q->where('aur.account_id = ? and aur.role_id = 1', $acctId);
			$aur = $q->fetchOne();
			
			$aur->setRoleId(sfConfig::get('app_account-role_user'));
			$aur->save();
			
			
			$q = new Doctrine_Query();
			$q->select('aur.*');
			$q->from('AccountUserRole aur');
			$q->where('aur.account_id = ? and aur.user_id = ?', array($acctId, $ownerId));
			$aur = $q->fetchOne();
			
			$aur->setRoleId(sfConfig::get('app_account-role_owner'));
			$aur->save();
			
			
			
			
			
		}

		return sfView::SUCCESS;
	}


	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->forward('account', 'hub');
	}

	public function executeHub(sfWebRequest $request)
	{
		
		
		$acctId = $request->getParameter('aid');
		
		//look for Account Id in session
		if ($acctId == null){
			$acctId = $this->getUser()->getAttribute('aid');
		}
		
		//Account Id still null - redir to Main Hub where they can choose an account
		if ($acctId == null){
			$this->redirect('@hub_route');
		}

		//save account/domain in user session
		$this->getUser()->setAttribute('aid', $acctId);

		$this->accountUsers = Doctrine::getTable('AccountUserRole')->findByAccountId($acctId);
		$this->account = Doctrine::getTable('Account')->find($acctId);
		$this->project = Doctrine::getTable('Project')->findByAccountId($acctId);

		return sfView::SUCCESS;
	}

	
	public function executeDelete(sfWebRequest $request)
	{
		
		$this->aid = $request->getParameter('aid');
		
		if (!$this->getRequest()->isMethod('post')){
			$this->setTemplate("confirmAccountDelete");
			return sfView::SUCCESS;
		}else{
			$account = Doctrine::getTable('Account')->find($this->aid); 
			$account->delete();
			
			$this->redirect("@hub");
		}

	}
	
	public function executeCreate(sfWebRequest $request)
	{
		if (!$this->getRequest()->isMethod('post')){
			return sfView::SUCCESS;
		}else{
			$accountName = $this->getRequestParameter("accountName");
			$domainVal = $this->getRequestParameter("domain");
			
			//The free plan
			$planId = 1;
			
			$user = $this->getUser( )->getGuardUser( );

			//save user data
			$con = Doctrine_Manager::connection();
			
			try {
				$con->beginTransaction();

				if (!$user){
					
					
					//Create user
					$username = $this->getRequestParameter( 'username' );
					$password = $this->getRequestParameter( 'password' );
					$fname = $this->getRequestParameter( 'first_name' );
					$lname = $this->getRequestParameter( 'last_name' );

					$newUser = $this->createNewUser($username, $password, $fname, $lname);

					//set this to true so that the user will be signed in later on in this action
					$signin = true;

				}else{

					//just assign the user to newUser for the sake of simplicity
					$newUser = $user;
				}

				$account = new Account();
				$account->setUserId($newUser->getId());
				$account->setName($accountName);
				$account->setDomainId($domainVal);
				$account->setPrimaryUser($newUser->getId());
				$account->setCreated(date("Y-m-d H:i:s"));
				$account->setPlanId($planId);
				$account->save();

				$accountUser = new AccountUser();
				$accountUser->setAccountId($account->getId());
				$accountUser->setUserId($newUser->getId());
				$accountUser->setCreated(date("Y-m-d H:i:s"));
				$accountUser->save();


				$aur = new AccountUserRole();
				$aur->setAccountId($account->getId());
				$aur->setRoleId(sfConfig::get('app_account-role_owner'));
				$aur->setUserId($newUser->getId());
				$aur->setCreated(date("Y-m-d H:i:s"));
				$aur->save();

				$con->commit();

			} catch (Doctrine_Exception $e) {
				error_log ($e->getMessage());
				$con->rollback();
				return sfView::ERROR;
			}


			// log this user in
			if ($signin){
				$this->getUser( )->signin( $newUser );
			}

			//go to hub
			$this->redirect("@account_hub?aid=" . $account->getId());
		}

	}

	public function executeRemoveUser(sfWebRequest $request){
		$uid = $request->getParameter('uid');

		
		if ($uid == null){
			$this->redirect('@hub_route');
		}
		
		if (!$this->getRequest()->isMethod('post')){
			$this->setTemplate("confirmUserDelete");
			return sfView::SUCCESS;
		}else{

			$acctId = $this->getUser()->getAttribute('aid');

			$aur = Doctrine::getTable('AccountUserRole')->find(array($acctId, 2, $uid));
			print_r ($aur);
			die;

			$aur->delete();
		}
		
		$this->redirect('@hub_route');
		
	}
	
	public function executeGetUsers(sfWebRequest $request){
		$this->setLayout(FALSE);
		return $this->renderComponent('user', 'accountUsers');
	}
	
	public function executeAddUsers(sfWebRequest $request){
		$user = $this->getUser( )->getGuardUser( );

		$acctId = $this->getUser()->getAttribute('aid');

		if ($acctId == null){
			$this->redirect('@hub_route');
		}


		if (!$this->getRequest()->isMethod('post')){
			return sfView::SUCCESS;
		}else{
			$inviteeEmails = $this->getRequestParameter("inviteeEmails[]");
			$inviteeFirstName = $this->getRequestParameter("inviteeFirstName[]");
			$inviteeLastName = $this->getRequestParameter("inviteeLastName[]");




			//save user data
			$con = Doctrine_Manager::connection();

			$c = 0;
			foreach ($inviteeEmails as $inviteeUsername){

				try {
					$con->beginTransaction();

					//Create user
					$username = $inviteeUsername;
					$fname = $inviteeFirstName[$c];
					$lname = $inviteeLastName[$c];


					//check to see if user exists
					$user = Doctrine::getTable('sfGuardUser')->findOneByUsername($username);
						
						
					//CREATE USER HERE
					if (!$user){
						$password = Util::generatePassword(8);
						$user = $this->createNewUser($username, $password, $fname, $lname, $acctId, sfConfig::get('app_account-role_user'));
							

						//send email
						// Create the mailer and message objects
						//$mailer = new Swift($connection);
						$connection = new Swift_Connection_Sendmail();
						$mailer = new Swift($connection);

						$message = new Swift_Message('You are invited to join a Kodazi account');

						// Render message parts
						$mailContext = array('aid' => $acctId, 'username' => $username, 'password' => $password);
						$message->attach(new Swift_Message_Part($this->getPartial('email/inviteUserHtml', $mailContext), 'text/html'));
						$message->attach(new Swift_Message_Part($this->getPartial('email/inviteUserText', $mailContext), 'text/plain'));

						// Send
						$mailer->send($message, $username, "concierge@kodazi.com");
						$mailer->disconnect();


						$con->commit();
					}else{
						
						//User allready exists so do something else
						
						//send email
						$connection = new Swift_Connection_Sendmail();
						
						//gmail conn settings
						//$connection->setUsername('ady@kodazi.com');
						//$connection->setPassword('kod@zi');
						
						
						$mailer = new Swift($connection);

						$message = new Swift_Message('You are invited to join a Kodazi account');

						// Render message parts
						$mailContext = array('aid' => $acctId, 'username' => $user->getUsername());
						$message->attach(new Swift_Message_Part($this->getPartial('email/inviteUserHtml', $mailContext), 'text/html'));
						$message->attach(new Swift_Message_Part($this->getPartial('email/inviteUserText', $mailContext), 'text/plain'));

						// Send
						$mailer->send($message, $user->getUsername(), "concierge@kodazi.com");
						$mailer->disconnect();
					}
					
					

					$c++;

				} catch (Doctrine_Exception $e) {
					$con->rollback();
					error_log ($e->getMessage());
				}
					
			}
		}
	}
}
