<?php 
	function autoInclude($class){
        include($class.".php");
    }
    autoInclude('../class/v1/IOhander');
    $app = new IOhandler;


	 $app->countRow('account_id', '_transac', 12);


?>