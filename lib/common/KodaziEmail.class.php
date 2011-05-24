<?php

class KodaziEmail {

	public static function sendEmail($subject, $body, $userArray, $from = "conceirge@kodazi.com"){
		if ($_SERVER['SERVER_NAME'] == 'www.protoglue.com'){
				
			// Create the mailer and message objects
			$mailer = new Swift(new Swift_Connection_NativeMail());
			
		}else{
				
			$connection = new Swift_Connection_SMTP('smtp.gmail.com', 465, Swift_Connection_SMTP::ENC_SSL);
			$connection->setUsername('ady@kodazi.com');
			$connection->setPassword('kod@zi');
			$mailer = new Swift($connection);
		}

		foreach ($userArray as $user){
			// Send
			$message = new Swift_Message($subject, $body, 'text/html');

			// Send
			$mailer->send($message, $user->getEmail()->getEmail(), $from);
			
		}
		
		$mailer->disconnect();
	}


}