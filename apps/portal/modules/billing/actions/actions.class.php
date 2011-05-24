<?php

/**
 * billing actions.
 *
 * @package    protoglue_sym12
 * @subpackage billing
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class billingActions extends kodaziActions
{

	public function executeSelectPlan(sfWebRequest $request)
	{

		$planId = $request->getParameter('plid');

		if ($planId == null){
			$this->redirect('@billing_plans_view');
		}

		//if FREE plan
		if ($planId == 1){
			$this->redirect('@account_create');
		}

		$this->plan = Doctrine::getTable('Plan')->find($planId);
		return sfView::SUCCESS;
	}


	public function executeViewPlans(sfWebRequest $request)
	{
		$q = Doctrine_Query::create()
		->from('PlanFeature pf');
		$this->planFeatures = $q->execute();

		return sfView::SUCCESS;
	}



	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		if (!$this->getRequest()->isMethod('post')){
			return sfView::SUCCESS;
		}else{

			$fname = $this->getRequestParameter("first_name");
			$lname = $this->getRequestParameter("last_name");

			$email = $this->getRequestParameter("email");

			$street = $this->getRequestParameter("street");
			$city = $this->getRequestParameter("city");;
			$state = $this->getRequestParameter("state");
			$zip = $this->getRequestParameter("zip");
			$country = $this->getRequestParameter("country");

			$phone = $this->getRequestParameter("phone");

			$amount = $this->getRequestParameter("amount");
			$card_number = $this->getRequestParameter("card_number");
			$card_ccv = $this->getRequestParameter("ccv");
			$card_exp = $this->getRequestParameter("exp_month").$this->getRequestParameter("exp_year");
			$card_type = $this->getRequestParameter("");



			//replace dollar symbol if it's there inadvertently
			$amount = str_replace("$", "", $amount);

			$response = AuthNetUtil::execute($card_number, $card_exp, $card_ccv,
			$fname, $lname, $street, $city, $state, $zip, $country, $email, $phone, $amount);


			switch ($response) {

				case 1:  // Successs
					$this->cardMessg = "<b>Payment was succesfully processed:</b><br>";
					$this->forward('account', 'create');

					/**
					 //send mail
					 $mailFrom = "conceirge@protoglue.com";
					 $mailTo = $email;

					 $mailBody = $this->getPartial('bill/paymentEmail',
					 array(  'amount' => $amount, 'name' => $fname." ".$lname)
					 );
					 $mailSubject = "Thank you for your payment";
					 // Create the mailer and message objects
					 $mailer = new Swift(new Swift_Connection_NativeMail());
					 $message = new Swift_Message($mailSubject, $mailBody, 'text/html');

					 // Send
					 $mailer->send($message, $mailTo, $mailFrom);
					 $mailer->disconnect();

					 */


					break;

				case 2:  // Declined
					$this->cardMessg = "<b>Payment Declined:</b><br>";
					$this->setTemplate('payResult');
					break;

				case 3:  // Error
					$this->cardMessg = "<b>Error with Transaction:</b><br>";
					$this->setTemplate('payResult');
					break;
			}


			return sfView::SUCCESS;

		}
	}

	public function executeRecurBill(){

		if (!$this->getRequest()->isMethod('post')){
			$this->redirect('@home');
			return sfView::SUCCESS;
		}else{


			$firstName = $this->getRequestParameter("first_name");
			$lastName = $this->getRequestParameter("last_name");
			$expMonth = $this->getRequestParameter("exp_month");
			$expYear = $this->getRequestParameter("exp_year");

			$address = $this->getRequestParameter("address");
			$city = $this->getRequestParameter("city");
			$state = $this->getRequestParameter("state");
			$zip = $this->getRequestParameter("billZIP");
			

			$amount = $this->getRequestParameter("amount");
			$card_number = $this->getRequestParameter("cardno");
//			$card_ccv = $this->getRequestParameter("ccv");
			$card_exp = $expMonth.$expYear;

			$login = sfConfig::get('app_authorize-net_api-login');
			$transKey = sfConfig::get('app_authorize-net_transaction-key');
			$test = true;

			$arb = new AuthnetARB($login, $transKey, $test);
			

			$arb->setParameter('interval_length', 1);
			$arb->setParameter('interval_unit', 'months');
			$arb->setParameter('startDate', date("Y-m-d"));
			$arb->setParameter('totalOccurrences', 9999);
			$arb->setParameter('trialOccurrences', 0);
			$arb->setParameter('trialAmount', 0.00);
			

			$arb->setParameter('amount', $amount);
			$arb->setParameter('refId', 15);
			$arb->setParameter('cardNumber', $card_number);
			$arb->setParameter('expirationDate', $card_exp);

			
			$arb->setParameter('firstName', $firstName);
			$arb->setParameter('lastName', $lastName);
//			$arb->setParameter('address', $address);
//			$arb->setParameter('city', $city);
//			$arb->setParameter('state', $state);
			$arb->setParameter('zip', $zip);
//			$arb->setParameter('country', 'US');

			$arb->setParameter('subscrName', 'Kodazi Account');
			
			
			$arb->createAccount();

			




			if ($arb->isSuccessful()) {

				$arbId = $arb->getSubscriberID();

				$con = Doctrine_Manager::connection();

				try {
					$con->beginTransaction();

					//do the account and user creation stuff
					$accountName = $this->getRequestParameter("accountName");
					$domainVal = $this->getRequestParameter("domain");
					$user = $this->getUser( )->getGuardUser( );
	

					if (!$user){

						//Create user
						$username = $this->getRequestParameter( 'username' );
						$password = $this->getRequestParameter( 'password' );
						$fname = $this->getRequestParameter( 'first_name' );
						$lname = $this->getRequestParameter( 'last_name' );
						$planId = $this->getRequestParameter( 'planId' );

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
						
						
						

					//Create pay
					$payCard = new PaymentCard();
					$payCard->setFirstName($firstName);
					$payCard->setLastName($lastName);
					$payCard->setCardNum($card_number);
					$payCard->setExpiryMonth($expMonth);
					$payCard->setExpiryYear($expYear);
					$payCard->setCreated(date("Y-m-d H:i:s"));
					$payCard->setStatus(1);
					$payCard->save();

					//create payment transaction
					$payTrans = new PaymentTransaction();
					$payTrans->setGatewayTransactionId($arbId);
					$payTrans->setAccountId($account->getId());
					$payTrans->setUserId($newUser->getId());
					$payTrans->setCreated(date("Y-m-d H:i:s"));
					$payTrans->setPaymentCardId($payCard->getPaymentCardId());
					$payTrans->setTotalValue($amount);
					$payTrans->setStatus(1);
					$payTrans->save();
						
						
					$con->commit();

				} catch (Exception $e) {
					$con->rollback();
					error_log ($e->getMessage());
					return sfView::ERROR;
				}
				
				// log this user in
				if ($signin){
					$this->getUser( )->signin( $newUser );
				}

				//go to hub
				$this->redirect("@account_hub?aid=" . $account->getId());


			} else {
				echo 'Error in payment <br />';
				echo 'Payment Error: ' .$arb->isError() . '<br />';
				echo 'getResponse: ' .$arb->getResponse() . '<br />';
				echo 'getResultCode:' .$arb->getResultCode() . '<br />';
				echo 'getString: ' .$arb->getString() . '<br />';
				echo 'getRawResponse: ' .$arb->getRawResponse() . '<br />';
				
				return sfView::ERROR;
			}

			

			
		}
	}
}
