<?php
//golpredicts/deactivate_account.php
date_default_timezone_set("Africa/Nairobi");

header("Content-type: application/json");


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
  /**
  *deactivate users account
  **/
  if (isset($_POST['deactivate_account'])) {
      
    require_once '../config.php';

    //grab the data from the app
    $email =  $_POST['email'];

    //check for empty user inputs
    if (empty($email)) {
      echo "email cannot be empty";
    }
    
    //attempt to deactivate account
    $deactivate_query = "SELECT * FROM top_tier_users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($top_tier_conn, $deactivate_query);
    // $msg = "Mysql error". mysqli_error($top_tier_conn);
    // echo $msg;
    if (mysqli_num_rows($result) == 1) {
        $update_user = "UPDATE top_tier_users SET activated='false', deactivated_on=now() WHERE email='$email'";
        $update_result = mysqli_query($top_tier_conn, $update_user);
        
        if($update_result){
          echo "Deactivated successfully";
        }else{
          echo "An error occurred";
        }
        
    }else{
      echo "An error occurred";
    }

  }else{
    echo json_encode(array(
        "status_code"=>201, 
        "message"=>"An error occurred",
    ));
  }
  
}else{
  echo json_encode(array(
    "status_code"=>201, 
    "message"=>"An error occurred",
  ));
}