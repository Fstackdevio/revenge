<?php
function autoInclude($class){
        include($class.".php");
    }
    // autoInclude('../class/IOhander');
    include ('../verify/config.php');
    $url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
    $sql = "SELECT * FROM _users where ever = '{$url}'";
    $userRow = $DBcon->query($sql);
    if($userRow->num_rows > 0){
        if($result = $userRow->fetch_assoc()){
            if($result['ever_status'] == 1){
                echo "account already activated";
            } else{
                //echo "not yet activated";
                $id = $result['_id'];
                $usrEmail = $result['email'];

                $activQuery = "UPDATE _users SET ever_status = '1' WHERE _id = '{$id}' and email = '{$usrEmail}'";
                $activate = $DBcon->query($activQuery);

                if($activate == true){
                    echo "Successfully activated!";
                    header( "refresh:5;url=paage-login.php" );
                } else {
                    echo "Sorry an error occured while trying to activate!";
                }
            }
        }
    }
?>