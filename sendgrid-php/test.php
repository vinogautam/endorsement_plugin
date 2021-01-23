<?php
include 'sendgrid-php.php';

$email = new SendGrid\Email();
$email->setFrom("test@example.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("dhanavel237vino@gmail.com", "Example User");
$email->setHtml(
    "<strong>and easy to do anywhere, even with PHP2</strong>"
);
$sendgrid = new \SendGrid('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');
try {
			print_r($sendgrid->send($email));
		} catch(\SendGrid\Exception $e) {
			echo $e->getCode();
			foreach($e->getErrors() as $er) {
				echo $er;
			}
		}