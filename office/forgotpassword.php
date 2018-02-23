<!doctype html>
<!DOCTYPE html>
<html>
<head>
	<title>password recovery</title>
</head>
<body>
<?php 
$code = $_GET['code'];
$email = $_GET['email'];
?>
<form action="../useclass/updaterecovepassword.php" method="POST" accept-charset="utf-8">
	<input type="password" name="password"><br /><br>
	<input type="password" name="repassword"><br /><br/>
	<input type="submit" name="submit" value="submit">
	<input type="hidden" name="code" value="<?php echo $code?>"><br /><br/>
	<input type="hidden" name="email" value="<?php echo $email?>"><br /><br/>
</form>
</body>
</html>