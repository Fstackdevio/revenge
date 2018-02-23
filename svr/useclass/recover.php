<?php 
	include ('../verify/config.php');
	$default = '0';
	$email = mysql_escape_string($_POST['email']);
	$sql = "SELECT * from _users where email = '$email'";
	$q = $DBcon->query($sql);
	// $var = $q->execute();
	$row = $q->fetch_array();
	if ($row) {
		echo "worked";
	}else{
		echo "not nworked";
	}
	$mailgot = $row['email'];
	$id = $row['_id'];
	$random_hash = md5(uniqid(rand(), true));
	$verificationLink = "http://localhost/bitty/office/forgotpassword.php?code=$random_hash&email=$mailgot";



	$htmlStr = "";
    $htmlStr .= "Hi " . $email . ",<br /><br />";

    $htmlStr .= "Please click the button below to rest your Account Password.<br /><br /><br />";
    $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";

    $htmlStr .= "Kind regards,<br />";
    $htmlStr .= "<a href='https://Globalcoin.com/' target='_blank'>Globalcoin</a><br />";


    $name = "The Global Coin Club";
    $email_sender = "no-reply@globalcoin.com";
    $subject = "Verification Link | Globalcoin | Acccount activation";
    $recipient_email = $mailgot;

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: {$name} <{$email_sender}> \n";

    $body = $htmlStr;
    $created = date('Y-m-d H:i:s');
    $verified = "0";
    $disable = "0";

    // send email using the mail function, you can also use php mailer library if you want
    if( mail($recipient_email, $subject, $body, $headers) ){
    		$sql = "INSERT INTO _forgotpw(forid,ver_code,status) VALUES('$id', '$random_hash', '$default')";
			$q = $DBcon->prepare($sql);
			$q->execute();
	}else{
		echo "error resting password try again later";
	}
	header("location: ../office/page-confirm-mail.php?mail=$email");

?>