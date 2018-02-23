<?php
	$app->post('/maketrans', function(), use ($app){
		$r = json_decode($app->request->getbody());
		$response = array();
		$data = new IOhandler;
		$object = new BlockIoServeice();
		// get bit user address
		$session = $data->getSessiondata();
		$response['sessid'] =  $session["userid"];
		$newid = $response['sessid'];
		$getparams = $data->getBy_id('_id', $newid, '_users');
		$toaddress = $r->sentto;
		$trasferAmount = $r->trasferAmount;
		$from_address = $getparams['bitaddress'];
		$to_address = $toaddress;
		$private_key = 'PRIVATE KEY OF FROM_ADDRESS';
		$my_add = "10293985395usis39483sksj102";
		$my_amount = "0.001";
		$fixed_amount = $block_io->withdraw(array('to_address' => $my_add, 'amount' => $my_add));
	    $sweepInfo = $block_io->sweep_from_address(array('from_address' => $from_address, 'to_address' => $to_address, 'private_key' => $private_key, 'amount' => $trasferAmount));
	   $response['Status'] = $sweepInfo->status;
	   $response['Executed Transaction ID:' = $sweepInfo->data->txid;
	   $response['network fee Charged'] = $sweepInfo->data->network_fee;
	   $response['netowrk fee charged 2'] = $sweepInfo->data->network;
?>