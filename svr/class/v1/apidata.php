<?php
$app->get('/values', function() {
    $data = new IOhandler;
    $session = $data->getSessiondata();
    $response["userid"] = $session['userid'];
    $response["username"] = $session['username'];
    $response["email"] = $session['email'];
    $response["phone"] = $session['phone'];
    $response["bitaddress"] = $session['bitaddress'];
    $response["kilo_box"] = $session['kilo_box'];
 
    echoResponse(200, $session);
});
?>