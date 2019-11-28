<?php

require_once 'config/CUFunction.php';
$UDF_call = new CUFunction();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['did']) && is_numeric($_GET['did'])){
        $delete_id = $_GET['did'];
        $ud_id['u_id'] = $delete_id;

        $delete = $UDF_call->delete('userdata',$ud_id);
        if($delete){
            header('Location:index.php');
        }
    }
    else{
        header('Location:index.php');
    }
}

?>