<?php 
	require("service.php");
	$object = new BlockIoServeice();
	
	try {
		// $address = $object->get_new_address(array('label' => 'shibetime1'));
		// print_r($address);
		$name = 'newa';
		$va = $object->get_new_address(array('label' => $name));
		print_r($va);

		echo "New Address: ".$va->data->address."\n";
		echo "error: ".$va->data->error_message."\n";
		// echo "Label: ".$address->data->label."\n";
		// echo "<br>";
	}catch (Exception $e) {
	    echo $e->getMessage() . "\n";
	}

	

	// try {
	//     echo "Getting address for Label='shibetime1'\n";
	//     $getAddressInfo = $object->get_address_by_label(array('label' => 'shibetime1'));
	//     echo "Status: ".$getAddressInfo->status."\n";
	// } catch (Exception $e) {
	//     echo $e->getMessage() . "\n";
	// }

	// echo "Label has Address: " . $object->get_address_by_label(array('label' => 'shibetime1'))->data->address . "\n";

	// echo "\n\n";
?>