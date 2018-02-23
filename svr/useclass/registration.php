<?php 
    header('Content-type: text/plain');
	function autoInclude($class){
        include($class.".php");
    }
    autoInclude('../class/v1/IOhander');
    include ('../verify/config.php');
    require("../Block/service.php");
    $object = new BlockIoServeice();
    $app = new IOhandler;

    

    // $hash = bin2hex(random_bytes(16));
	$fullname = mysql_escape_string($_POST['fullname']);
	$email = mysql_escape_string($_POST['email']);
	$password = mysql_escape_string($_POST['pass']);
	$phone_number = mysql_escape_string($_POST['phone']);
	$random_hash = md5(uniqid(rand(), true));
	$koloid = md5(uniqid(rand(), true));
    $verificationLink = "http://localhost/bitty/office/activation.php?code=" . $random_hash;
    
 
    $htmlStr = "";
    $htmlStr .= "Hi " . $email . ",<br /><br />";

    $htmlStr .= "Please click the button below to verify your Account.<br /><br /><br />";
    $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";

    $htmlStr .= "Kind regards,<br />";
    $htmlStr .= "<a href='https://Globalcoin.com/' target='_blank'>Globalcoin</a><br />";


    $name = "The Global Coin Club";
    $email_sender = "no-reply@globalcoin.com";
    $subject = "Verification Link | Globalcoin | Acccount activation";
    $recipient_email = $email;

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: {$name} <{$email_sender}> \n";

    $body = $htmlStr;
    $created = date('Y-m-d H:i:s');
    $verified = "0";
    $IP = getHostByName(getHostName());
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $disable = "0";

    // send email using the mail function, you can also use php mailer library if you want
    if( mail($recipient_email, $subject, $body, $headers) ){

	$data = json_decode(file_get_contents("php://input")); 
	// echo json_encode($data);

    // $sth = $this->DBcon->prepare("SELECT * FROM $table where email = '$email' or phone = '$phone_number' or full_name = '$full_name'");
    // $sth->execute();
    // $row = $sth->fetch(PDO::FETCH_ASSOC);
    // $title = $row['phone'];
    // $full_name = $row['full_name'];
    // $email = $row['email'];

    // $stmt = $DBcon->prepare("SELECT count(*) FROM _users WHERE email = '$email'");
    // $result = $stmt->execute();
    // $result = $stmt->fetchAll();

    // block io api get new address

    // $va = $object->get_new_address(array('label' => $name));

    // echo "New Address: ".$va->data->address."\n";
    // echo "error: ".$va->data->error_message."\n";

    $sql = "SELECT full_name, email FROM _users WHERE email = '$email'";
    $result = $DBcon->query($sql);
    $count=$result->num_rows;
    if ($count != 0) {
        echo "Username already taken";
    }else { 
        $bitIoNewaddress = $object->get_new_address(array('label' => $fullname));
        $newaddress = $bitIoNewaddress->data->address;
        $app->insert('_users', $fields = array('full_name', 'email', 'bitaddress', 'pass_key','ever', 'ever_status', 'kolo_box_id', 'phone', 'ip_address', 'date_registered', 'cleartext', 'disable'), $values = array($fullname, $email, $newaddress, $hash, $verificationLink, $verified, $koloid, $phone_number, $IP, $created, $password, $disable));
        echo "ok";
            
    }

	}else{
		echo "error during registration";
	}


?>