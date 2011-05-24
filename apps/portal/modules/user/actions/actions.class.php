<?php

/**
 * user actions.
 *
 * @package    protoglue_sym12
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class userActions extends sfActions
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


	public function executeRequestPassword(sfWebRequest $request)
	{
		if (!$this->getRequest()->isMethod('post')){
			return sfView::SUCCESS;
		}else{
			$email = $request->getParameter("email");
			$this->password = Util::generatePassword();
				
			$user = Doctrine::getTable('sfGuardUser')->findOneByUsername($email);
				
			if (!$user){
				return sfView::ERROR;
			}
				
				
			//save new password
			$user->setPassword($this->password);
			$user->save();

			// Create the mailer and message objects
			//$mailer = new Swift($connection);
			$connection = new Swift_Connection_Sendmail();
			$mailer = new Swift($connection);

			$message = new Swift_Message('Splash - new password request');

			// Render message parts
			$mailContext = array('username' => $email, 'password' => $this->password);
			$message->attach(new Swift_Message_Part($this->getPartial('email/requestPasswordHtml', $mailContext), 'text/html'));
			$message->attach(new Swift_Message_Part($this->getPartial('email/requestPasswordText', $mailContext), 'text/plain'));

			// Send
			$mailer->send($message, $email, "concierge@splashdesignltd.com");
			$mailer->disconnect();

		}

		$this->redirect("@hub_route");

	}
	
	public function executeLink(sfWebRequest $request)
	{
		//get accountId from session
		$accountId = $this->getUser()->getAttribute('aid');
		$this->aid = $accountId;

		//get project Id
		$projectId = $this->getRequestParameter( 'pid' );
		$userId = $this->getRequestParameter( 'uid' );
		
		if ($accountId == null){
			$this->redirect('@hub_route');
		}

		
		$pu = ProjectUser::getProjectUserByPidUid($userId, $projectId);
		
		if ($pu){
			$this->redirect("@account_hub?aid=" .$accountId);
		}
		
		
		$con = Doctrine_Manager::connection();

		try {

			$con->beginTransaction();
			
			//if there's a project associate it
			if ($projectId){
					
				//get team
				$team = Doctrine::getTable('Team')->findOneByProjectId($projectId);

				if (!$team){
					$team = new Team();
					$team->setProjectId($projectId);
					$team->setName("DEFAULT");
					$team->setCreated(date("Y-m-d H:i:s"));
					$team->save();
				}

				$projectUser = new ProjectUser();
				$projectUser->setProjectId($projectId);
				$projectUser->setUserId($userId);
				$projectUser->setTeamId($team->getTeamId());
				$projectUser->setCreated(date("Y-m-d H:i:s"));
				$projectUser->save();
					

			}
			
			$con->commit();

			// Create the mailer and message objects
			//$mailer = new Swift($connection);
			$connection = new Swift_Connection_SMTP('smtp.gmail.com', 465, Swift_Connection_SMTP::ENC_SSL);
			$connection->setUsername('ady@kodazi.com');
			$connection->setPassword('kod@zi');
			$mailer = new Swift($connection);

			$message = new Swift_Message('Kodazi - you have been invited to the project ' . $projectUser->getProject()->getName());

			// Render message parts
			$mailContext = array('username' => $projectUser->getUser()->getUsername(), 'password' => $this->password);
			$message->attach(new Swift_Message_Part($this->getPartial('email/newUserAccountHtml', $mailContext), 'text/html'));
			$message->attach(new Swift_Message_Part($this->getPartial('email/newUserAccountText', $mailContext), 'text/plain'));

			// Send
			$mailer->send($message, $projectUser->getUser()->getUsername(), "concierge@kodazi.com");
			$mailer->disconnect();


		} catch (Doctrine_Exception $e) {
			$con->rollback();
			error_log ($e->getMessage());
		}
		
		$this->redirect("@account_hub?aid=" .$accountId);

	}
	
	
	public function executeRemove(sfWebRequest $request)
	{
		//get accountId from session
		$accountId = $this->getUser()->getAttribute('aid');
		$this->aid = $accountId;

		//get project Id
		$projectId = $this->getRequestParameter( 'pid' );
		$userId = $this->getRequestParameter( 'uid' );
		
		if ($accountId == null){
			$this->redirect('@hub_route');
		}

		$pu = ProjectUser::getProjectUserByPidUid($userId, $projectId);
		
		if ($pu){
			$pu->delete();
		}
		
		$this->redirect("@project_hub");

	}


	public function executeAdd(sfWebRequest $request)
	{
		//get accountId from session
		$accountId = $this->getUser()->getAttribute('aid');
		$this->aid = $accountId;

		//get project Id
		$projectId = $this->getRequestParameter( 'pid' );



		if ($accountId == null){
			$this->redirect('@hub_route');
		}

		if (!$this->getRequest()->isMethod('post')){
			
			if ($projectId){
				return $this->renderComponent('user', 'addUsers', array('pid' => $projectId));
			}else{
				return $this->renderComponent('user', 'addAccountUsers');
			}
			
		}else {

			$this->password = Util::generatePassword();

			$username = $this->getRequestParameter( 'email' );
			$fname = $this->getRequestParameter( 'firstname' );
			$lname = $this->getRequestParameter( 'lastname' );

			//set this user type
			$userType = sfConfig::get('app_user-type_user');

			//TODO: fix user-type for domain
			//@see app.yml
			
			if (strlen(trim($username)) <= 0){
				return sfView::ERROR;
			}

			$con = Doctrine_Manager::connection();

			try {

				$con->beginTransaction();


				$newUser = new sfGuardUser();
				$newUser->setUsername($username);
				$newUser->setPassword($this->password);
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
				$profile->setAddressId($address->getAddressId());
				$profile->setUserId( $newUser->getId() );
				$profile->setFirstName($fname);
				$profile->setLastName($lname);
				$profile->setCreated(date("Y-m-d H:i:s"));
				$profile->save();

				$accountUser = new AccountUser();
				$accountUser->setAccountId($accountId);
				$accountUser->setUserId($newUser->getId());
				$accountUser->setCreated(date("Y-m-d H:i:s"));
				$accountUser->save();


				$accountUserRole = new AccountUserRole();
				$accountUserRole->setAccountId($accountId);
				$accountUserRole->setUserId($newUser->getId());
				$accountUserRole->setRoleId(2); //Normal user
				$accountUserRole->setCreated(date("Y-m-d H:i:s"));
				$accountUserRole->save();


				//if there's a project associate it
				if ($projectId){
					
					//get team
					$team = Doctrine::getTable('Team')->findOneByProjectId($projectId);

					if (!$team){
						$team = new Team();
						$team->setProjectId($projectId);
						$team->setName("DEFAULT");
						$team->setCreated(date("Y-m-d H:i:s"));
						$team->save();
					}

					$projectUser = new ProjectUser();
					$projectUser->setProjectId($projectId);
					$projectUser->setUserId($newUser->getId());
					$projectUser->setTeamId($team->getTeamId());
					$projectUser->setCreated(date("Y-m-d H:i:s"));
					$projectUser->save();
					

				}


				$con->commit();
				


				// Create the mailer and message objects
				//$mailer = new Swift($connection);
				$connection = new Swift_Connection_SMTP('smtp.gmail.com', 465, Swift_Connection_SMTP::ENC_SSL);
				$connection->setUsername('ady@kodazi.com');
				$connection->setPassword('kod@zi');
				$mailer = new Swift($connection);

				$message = new Swift_Message('Kodazi - new user account');

				// Render message parts
				$mailContext = array('username' => $username, 'password' => $this->password);
				$message->attach(new Swift_Message_Part($this->getPartial('email/newUserAccountHtml', $mailContext), 'text/html'));
				$message->attach(new Swift_Message_Part($this->getPartial('email/newUserAccountText', $mailContext), 'text/plain'));

				// Send
				$mailer->send($message, $username, "concierge@kodazi.com");
				$mailer->disconnect();


			} catch (Doctrine_Exception $e) {
				$con->rollback();
				error_log ($e->getMessage());
			}

		}

		$this->redirect($this->getRequest()->getUri());

	}
}
