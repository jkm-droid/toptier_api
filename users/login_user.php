<?php
//golpredicts/login_user.php
date_default_timezone_set("Africa/Nairobi");
header("Content-type: application/json");


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
  /**
  *login user
  **/
  if (isset($_POST['login_user'])) {
      
    require_once '../config.php';

    //grab the data from the app
    $email_username =  $_POST['email_username'];
    $password = $_POST['password'];
    

    //check for empty user inputs
    if (empty($email_username)) {
      echo "email/username cannot be empty";
    }
    if (empty($password)) { 
      echo "password cannot be empty";
    }
    
    //login the user
    $password = md5($password);
    $user_login_query = "SELECT * FROM top_tier_users WHERE (username='$email_username' OR email='$email_username') AND password1='$password' AND activated='true' LIMIT 1";
    $result = mysqli_query($top_tier_conn, $user_login_query);
    // $msg = "Mysql error". mysqli_error($top_tier_conn);
    // echo $msg;
    if (mysqli_num_rows($result) == 1) {
      
      $user_details = mysqli_fetch_array($result);

      echo json_encode(array(
          "status_code"=>200, 
          "message"=>"login successful",
          "username"=>$user_details['username'],
          "email"=>$user_details['email'],
          "user_status"=>$user_details['status'],
      ));

    }else{
      echo "wrong username/email/password";
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