<?php
    function autoInclude($class){
        include($class.".php");
    }
    autoInclude('../class/v1/IOhander');
    $app = new IOhandler;

    $user = mysql_escape_string($_POST['user_name']);
    $pass = mysql_escape_string($_POST['pass_word']);

 	$app->login('_users', $user, $pass);

?>