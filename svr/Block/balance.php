<?php
	require("service.php");

	$object = new BlockIoServeice();
	
	try {
		// $balance = $object->get_balance();
		// print_r($balance); 
		// // echo "!!! Using Network: ".$balance->data->network."\n";
		// echo "Available Amount: ".$balance->data->available_balance." ".$balance->data->network."\n";
		// echo "<br>";

		$getaddBal = $object->get_address_balance(array('addresses' => '2NBPU419tcyG2TVWCJwgxNmVhXgamqyhJTS '));
		print_r($getaddBal->data->available_balance);
		echo "<br>";
	}catch (Exception $e) {
	   echo $e->getMessage() . "\n";
	}
	echo "\n\n";
	
?>