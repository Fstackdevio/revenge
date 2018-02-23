<?php
$app->get('/getrans', function() use ($app){
	$r = json_decode($app->request->getbody());
	$response = array();
	$data = new IOhandler;
	$session = $data->getSessiondata();
	$response['sessid'] =  $session["userid"];
	$id = $response['sessid'];
	$getrance = $data->count_rows_of_foreign('_transac', '_exportid', $id);
	$response['transamount'] = $getrance;

	echoResponse(200, $response);
})
?>