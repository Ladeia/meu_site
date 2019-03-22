<?php

ini_set("sendmail_from", "do-not-reply@gmail.com");
include("include/settings.php");

$response = $_POST['g-recaptcha-response'];
$url = 'https://www.google.com/recaptcha/api/siteverify';

//$data = ['secret' => '6LdQWw8TAAAAANB_NXnCx24zTtQmcOeCGOVPVNax', 'response' => $response];

if($response){

	if(isset($_POST['name']) && isset($_POST['contactEmail']) && isset($_POST['message'])){
	    
	    $headers = "From: Contato pelo site <" . $to . "> \n";
	    $headers .= "Reply-To: " . $_POST['contactEmail'] . " \n";
	    $headers .= "Return-Path: " . $_POST['contactEmail'] .  " \n";
	    $headers .= "Content-type: text/html; charset=utf-8";
	
	    $name = $_POST['name'];
	    $from = $_POST['contactEmail'];
	    $message = $_POST['message'];
		
		$subject = "Mensagem de " . $name;
		
		if (mail($to, $subject, $message, $headers, "-f{$to}")) { 
			$response = array('sent' => 1);
			echo json_encode($response);
		} else { 
			$response = array('sent' => 0);
			echo json_encode($response);
		} 
	}
}
else
{
	$response = array('sent' => 0);
	echo json_encode($response);
}
?>