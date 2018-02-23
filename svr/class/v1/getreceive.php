<?php
$app->get('/getreceive', function() use ($app){
	$r = json_decode($app->request->getbody());
	$response = array();
	$data = new IOhandler;
	$session = $data->getSessiondata();
	$response['sessid'] =  $session["userid"];
	$id = $response['sessid'];
	$check = $data->get_receive('_transac', $id);
	$response['value'] = $check;
	echoResponse(200, $response);
})
?>