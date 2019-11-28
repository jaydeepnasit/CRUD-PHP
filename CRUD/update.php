<?php

require_once 'config/CUFunction.php';
$UDF_call = new CUFunction();
global $update_id, $skill;

$ue_error = $ug_error = $un_error = $us_error = $uc_error = $ub_error = $error_msg = "";


    if(isset($_GET['uid']) && is_numeric($_GET['uid'])){
        $update_id = $_GET['uid'];
        $uf_id['u_id'] = $update_id;
        $pre_rec = $UDF_call->select_assoc('userdata',$uf_id);

        // string to array
        $skill = explode(',',$pre_rec['u_skill']);

        if(!$pre_rec){
            header('Location:index.php');
        }
    }
    else{
        header('Location:index.php');
    }


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['update'])){

        $user_skill = (isset($_POST['userskill']))?($_POST['userskill']):'';
        if(!empty($user_skill)){
            $user_skill = implode(",",$_POST['userskill']);
        }

        $user_name = $UDF_call->validate($_POST['username']);
        $user_email = $UDF_call->validate($_POST['useremail']);
        $user_country = $UDF_call->validate($_POST['usercountry']);
        $user_bod = $_POST['userbod'];
        $user_gender = (isset($_POST['usergender']))?($UDF_call->validate($_POST['usergender'])):'';
        $user_skill = $UDF_call->validate($user_skill);

        $test_arr  = explode('-', $user_bod);
        if(!empty(trim($user_name)) && !empty(trim($user_email)) && !empty(trim($user_country)) && !empty(trim($user_gender)) && !empty(trim($user_skill)) && ((count($test_arr) == 3) && (checkdate($test_arr[1], $test_arr[2], $test_arr[0])))){

            $user_field['u_name'] = $user_name;
            $user_field['u_email'] = $user_email;
            $user_field['u_country'] = $user_country;
            $user_field['u_bod'] = $user_bod;
            $user_field['u_gender'] = $user_gender;
            $user_field['u_skill'] = $user_skill;        

            $uf_id2['u_id'] = $update_id;
            $update = $UDF_call->update('userdata',$user_field,$uf_id2);
            if($update){
               header('Location:index.php');
            }
            else{
                $error_msg = "User data is not updated";
            } 

        }
        else{
            if(empty(trim($user_name))){
                $un_error = "* Please Enter Your Username";
            }
            if(empty(trim($user_email))){
                $ue_error = "* Please Enter Your Email";
            }
            if(empty(trim($user_country))){
                $uc_error = "* Please Select Your Nation";
            }
            if(empty(trim($user_gender))){
                $ug_error = "* Please select Your Gender";
            }
            if(empty(trim($user_skill))){
                $us_error = "* Please select Your Skill";
            }
            if(count($test_arr) == 3){
                if(!checkdate($test_arr[1], $test_arr[2], $test_arr[0])){
                    $ub_error = "* Please Enter Your BOD"; 
                }   
            }
            else {
                $ub_error = "* Please Enter Your BOD"; 
            }
        }

    }
    else{
        $error_msg = "Invalid Request Not Allow";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="CSS/stylesheet.css">
</head>
<body>

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <h1 class="heading">Update Record</h1>
            </div>
            <div class="row justify-content-center">
                <a class="first-btn-sty btn-dark" href="index.php">View Record</a>
            </div>  
        </div>
        <div class="container">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <form method="POST">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                             </div>
                            <input name="username" class="form-control" placeholder="Full name" type="text" value="<?php echo $pre_rec['u_name']; ?>">
                        </div>
                        <span class="error-msg"><?php echo @$un_error; ?></span>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                             </div>
                            <input name="useremail" class="form-control" placeholder="Email address" type="email" value="<?php echo $pre_rec['u_email']; ?>">
                        </div> 
                        <span class="error-msg"><?php echo @$ue_error; ?></span>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fas fa-globe"></i> </span>
                            </div>
                            <select name="usercountry" class="form-control">
                                <option value="India" <?php if($pre_rec['u_country'] == 'India'){ echo "selected"; } ?>>India</option>
                                <option value="USA" <?php if($pre_rec['u_country'] == 'USA'){ echo "selected"; } ?>>USA</option>
                                <option value="Germany" <?php if($pre_rec['u_country'] == 'Germany'){ echo "selected"; } ?>>Germany</option>
                            </select>
                        </div> 
                        <span class="error-msg"><?php echo @$uc_error; ?></span>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fas fa-birthday-cake"></i> </span>
                            </div>
                            <input name="userbod" class="form-control" type="date" value="<?php echo $pre_rec['u_bod']; ?>">
                        </div>
                        <span class="error-msg"><?php echo @$ub_error; ?></span>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fas fa-venus-double"></i> </span>
                            </div>
                            <div class="form-control">
                                <input type="radio" value="Male" name="usergender" <?php if($pre_rec['u_gender'] == 'Male'){ echo "checked"; } ?>> Male
                                <input type="radio" value="Female" name="usergender" <?php if($pre_rec['u_gender'] == 'Female'){ echo "checked"; } ?>> Female 
                            </div>
                        </div>
                        <span class="error-msg"><?php echo @$ug_error; ?></span> 
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="far fa-hand-point-right"></i> </span>
                            </div>
                            <div class="form-control">
                                <input type="checkbox" value="Php" name="userskill[]" <?php if(in_array("Php",$skill)){ echo "checked"; } ?>> Php
                                <input type="checkbox" value="Nodejs" name="userskill[]" <?php if(in_array("Nodejs",$skill)){ echo "checked"; } ?>> Nodejs
                                <input type="checkbox" value="Typescript" name="userskill[]" <?php if(in_array("Typescript",$skill)){ echo "checked"; } ?>> Typescript 
                            </div>
                        </div>
                        <span class="error-msg"><?php echo @$us_error, @$error_msg; ?></span>                                    
                        <div class="form-group">
                            <input type="submit" name="update" value="Update Record" class="btn pm_btn_back btn-block">
                        </div> <!-- form-group// -->                                                                     
                    </form>
                </article>            
        </div>
    </div>
    
</body>
</html>