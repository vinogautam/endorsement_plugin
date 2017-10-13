<?php

$sendgrid = new SendGrid('CE6Acf0xQ3WPVVU2VznTLA');
		$email = new SendGrid\Email();


		if(count($arr))
		{
			$email->setFrom('dhanavel237vino@gmil.com');
			$email->setFromName('dhanavel237vino';
		}
		else
		{
			$email->setFrom('neil@financialinsiders.ca');
			$email->setFromName('FinancialInsiders.ca');
		}
		
		$email->addTo('dhanavel237vino@gmil.com');
		$email->addTo('neil.personalconsult@gmail.com');
		$email->setHtml($message);

		                             

		$email->setSubject($subject);
		//$email->Body    = $message;

		try {
			$sendgrid->send($email);
		} catch(\SendGrid\Exception $e) {
			echo $e->getCode();
			foreach($e->getErrors() as $er) {
				echo $er;
			}
		}