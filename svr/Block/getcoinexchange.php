<?php
	require("service.php");

	$object = new BlockIoServeice();

	$getCurrency = $object->get_current_price(array());
    print_r($getCurrency);
	echo "<br>";
	
	$network = $object->get_balance()->data->network; // get our current network off Block.io

	$code = "alpha1alpha2alpha3alpha4";
	$passphrase = strToHex($code);
	$key = $object->initKey()->fromPassphrase($passphrase);

	echo "Current Network: " . $network . "\n";
	echo "Private Key: " . $key->toWif($network) . "\n"; // print out the private key for the given network
	exit;
?>