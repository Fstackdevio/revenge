<?php
require_once 'service.php';
$apiKey = 'YOUR API KEY';
$pin = 'NONE'; // Not Needed
$version = 2; // the API version
$block_io = new BlockIo($apiKey, $pin, $version);
$from_address = 'FROM ADDRESS';
$to_address = 'TO ADDRESS';
$private_key = 'PRIVATE KEY OF FROM_ADDRESS IN WALLET IMPORT FORMAT';
// let's sweep the coins from the From Address to the To Address
try {

    // $makeTransfer = $object->withdraw(array('amounts' => 'AMOUNT', 'to_addresses' => 'ADDRESS'));
    // $transFee = $object->get_network_fee_estimate(array('amounts' => 'AMOUNT', 'to_addresses' => 'ADDRESS'));
    $sweepInfo = $block_io->sweep_from_address(array('from_address' => $from_address, 'to_address' => $to_address, 'private_key' => $private_key));
    echo "Status: ".$sweepInfo->status."\n";
    echo "Executed Transaction ID: ".$sweepInfo->data->txid."\n";
    echo "Network Fee Charged: ".$sweepInfo->data->network_fee." ".$sweepInfo->data->network."\n";
} catch (Exception $e) {
   echo $e->getMessage() . "\n";
}
?>