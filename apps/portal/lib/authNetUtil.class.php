<?php
class AuthNetUtil {
	public static function execute($ccNum='4007000000027', $ccExp='1003', $ccCCV='123', 
	               $firstName, $lastName, $street, $city, $state, $zip, $country, $email, $phone, $amount)
	{

		$loginID = sfConfig::get('app_authorize-net_api-login');
        $transactionKey = sfConfig::get('app_authorize-net_transaction-key');
		
		$a = new authorizenet_class;

		// You login using your login, login and tran_key, or login and password.  It
		// varies depending on how your account is setup.
		// I believe the currently reccomended method is to use a tran_key and not
		// your account password.  See the AIM documentation for additional information.

		$a->add_field('x_login', $loginID);
		$a->add_field('x_tran_key', $transactionKey);
		//$a->add_field('x_password', 'CHANGE THIS TO YOUR PASSWORD');

		$a->add_field('x_version', '3.1');
		$a->add_field('x_type', 'AUTH_CAPTURE');
		$a->add_field('x_test_request', 'TRUE');    // Just a test transaction
		$a->add_field('x_relay_response', 'FALSE');

		// You *MUST* specify '|' as the delim char due to the way I wrote the class.
		// I will change this in future versions should I have time.  But for now, just
		// make sure you include the following 3 lines of code when using this class.

		$a->add_field('x_delim_data', 'TRUE');
		$a->add_field('x_delim_char', '|');
		$a->add_field('x_encap_char', '');


		// Setup fields for customer information.  This would typically come from an
		// array of POST values froma secure HTTPS form.

		$a->add_field('x_first_name', $firstName);
		$a->add_field('x_last_name', $lastName);
		$a->add_field('x_address', $street);
		$a->add_field('x_city', $city);
		$a->add_field('x_state', $state);
		$a->add_field('x_zip', $zip);
		$a->add_field('x_country', $country);
		$a->add_field('x_email', $email);
		$a->add_field('x_phone', $phone);


		// Using credit card number '4007000000027' performs a successful test.  This
		// allows you to test the behavior of your script should the transaction be
		// successful.  If you want to test various failures, use '4222222222222' as
		// the credit card number and set the x_amount field to the value of the
		// Response Reason Code you want to test.
		//
		// For example, if you are checking for an invalid expiration date on the
		// card, you would have a condition such as:
		// if ($a->response['Response Reason Code'] == 7) ... (do something)
		//
		// Now in order to cause the gateway to induce that error, you would have to
		// set x_card_num = '4222222222222' and x_amount = '7.00'

		//  Setup fields for payment information
		$a->add_field('x_method', 'CC');
		$a->add_field('x_card_num', $ccNum);   // test successful visa
		//$a->add_field('x_card_num', '370000000000002');   // test successful american express
		//$a->add_field('x_card_num', '6011000000000012');  // test successful discover
		//$a->add_field('x_card_num', '5424000000000015');  // test successful mastercard
		// $a->add_field('x_card_num', '4222222222222');    // test failure card number
		$a->add_field('x_amount', $amount);
		$a->add_field('x_exp_date', $ccExp);    // march of 2008
		$a->add_field('x_card_code', $ccCCV);    // Card CAVV Security code

		return $a->process();
		
		
        /**DEBUG STUFF BELOW 
		// Process the payment and output the results
		switch ($a->process()) {

			case 1:  // Successs
				echo "<b>Success:</b><br>";
				echo $a->get_response_reason_text();
				echo "<br><br>Details of the transaction are shown below...<br><br>";
				break;

			case 2:  // Declined
				echo "<b>Payment Declined:</b><br>";
				echo $a->get_response_reason_text();
				echo "<br><br>Details of the transaction are shown below...<br><br>";
				break;

			case 3:  // Error
				echo "<b>Error with Transaction:</b><br>";
				echo $a->get_response_reason_text();
				echo "<br><br>Details of the transaction are shown below...<br><br>";
				break;
		}

		// The following two functions are for debugging and learning the behavior
		// of authorize.net's response codes.  They output nice tables containing
		// the data passed to and recieved from the gateway.

		$a->dump_fields();      // outputs all the fields that we set
		$a->dump_response();    // outputs the response from the payment gateway


		//print_r ($aNet->getTransactionData());

		*/
	}
}
?>