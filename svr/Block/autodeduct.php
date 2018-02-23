<?php
	require("service.php");

	$object = new BlockIoServeice();

	try {
    echo "Getting address for Label='shibetime1'\n";
    $getAddressInfo = $object->get_address_by_label(array('label' => 'shibetime1'));
    echo "Status: ".$getAddressInfo->status."\n";
	} catch (Exception $e) {
	    echo $e->getMessage() . "\n";
	}

	echo "Label has Address: " . $object->get_address_by_label(array('label' => 'shibetime1'))->data->address . "\n";

	echo "\n\n";

	echo "***Send 1% of coins on my account to the address labeled 'shibetime1'\n";

	// Use high decimal precision for any math on coins. They can be 8 decimal places at most, or the system will reject them as invalid amounts.
	$sendAmount = bcmul($getBalanceInfo->data->available_balance, '0.01', 8); 

	echo "Available Amount: ".$getBalanceInfo->data->available_balance." ".$getBalanceInfo->data->network."\n";

	$estNetworkFee = $object->get_network_fee_estimate(array('to_address' => $getAddressInfo->data->address, 'amount' => $sendAmount));

	echo "Estimated Network Fee: " . $estNetworkFee->data->estimated_network_fee . " " . $estNetworkFee->data->network . "\n";

	echo "Withdrawing 1% of Available Amount: ".$sendAmount." ".$getBalanceInfo->data->network."\n";

	try {
	    $withdrawInfo = $object->withdraw(array('to_address' => $getAddressInfo->data->address, 'amount' => $sendAmount));
	    echo "Status: ".$withdrawInfo->status."\n";

	    echo "Executed Transaction ID: ".$withdrawInfo->data->txid."\n";
	    echo "Network Fee Charged: ".$withdrawInfo->data->network_fee." ".$withdrawInfo->data->network."\n";
	} catch (Exception $e) {
	   echo $e->getMessage() . "\n";
	}
?>