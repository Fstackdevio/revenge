<?php
	require("service.php");

	$object = new BlockIoServeice();

	$myaddress = $object->get_new_address(array('label' => 'shibetime1'));
	print_r($myaddress);
	echo "<br>";
	exit;
?>