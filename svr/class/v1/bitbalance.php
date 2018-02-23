<?php 
$app->get('/balance', function() use ($app){
	$r = json_decode($app->request->getbody());
	$response = array();
	$data = new IOhandler;
	$object = new BlockIoServeice();
	$session = $data->getSessiondata();
	$response['sessid'] =  $session["userid"];
	$newid = $response['sessid'];
	$getparams = $data->getBy_id('_id', $newid, '_users');
	$response['bitaddress'] = $getparams['bitaddress'];
	$add = $response['bitaddress'];
	$getaddBal = $object->get_address_balance(array('addresses' => $add));
	$response['avail_bal'] = $getaddBal->data->available_balance;
	echoResponse(200, $response);
});
?>