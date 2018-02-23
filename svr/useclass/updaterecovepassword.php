<?php 
include ('../verify/config.php');
$password1 = mysql_escape_string($_POST['password']);
$password2 = mysql_escape_string($_POST['repassword']);

$codeverify = $_POST['code'];
$email = $_POST['email'];
$sql = "SELECT * FROM _forgotpw where ver_code='$codeverify'";
$prepare = $DBcon->query($sql);
$row = $prepare->fetch_array();
$forid = $row['forid'];
$newid = $row['_id'];
$status = $row['status'];
$cid = $row['ver_code'];
$get = $prepare->num_rows;
$hash = password_hash($password1, PASSWORD_DEFAULT);
$newstat ='1';
if ($status === '0') {
	if($get == 1){
		if ($cid === $codeverify) {
			$newsql = "UPDATE _users SET pass_key = '{$hash}', cleartext = '{$password1}' WHERE _id = '{$forid}' and email='{$email}'";
			$newsql = "UPDATE _forgotpw SET status = '{$newstat}' WHERE forid = '{$newid}' AND ver_code = '{$codeverify}'";
			// query to update status
			if ($newsql) {	
				$DBcon->query($newsql);
				$do = $DBcon->query($newsql);
				$query = $DBcon->prepare($newsql);
				$done = $query->execute();
				if ($done) {
					echo "password reset successfull";
				}else{
					echo "error updateing password";
				}
			}else{
				echo "error submitting";
			}
		}else{
			echo "url currupted";
		}
	}else{
		echo "url corrupt";
	}
}elseif($status === '1'){
	echo "url expired";
}
else{
	echo "not a valid url";
}
?>