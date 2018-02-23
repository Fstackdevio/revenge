<?php 
$app->get('/gettsession', function() use ($app){
	$r = json_decode($app->request->getbody());
	$response = array();
	$data = new IOhandler;
	$object = new BlockIoServeice();
	$session = $data->getSessiondata();
	$response['sessid'] =  $session["userid"];
	echoResponse(200, $response);
});
?>