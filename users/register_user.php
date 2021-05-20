<?php
//golpredicts/register_user.php
date_default_timezone_set("Africa/Nairobi");
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
  if (isset($_POST['register_user'])) {

    require_once '../config.php';

    //grab the data from the app
    $username =  $_POST['username'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    

    //check for empty user inputs
    if (empty($username)) {
      echo "username cannot be empty";
    }
    if (empty($email)) { 
      echo "email cannot be empty";
    }
    if (empty($password)) { 
      echo "password cannot be empty";
    }
    
    //check if user already exists
    $user_check_query = "SELECT * FROM top_tier_users WHERE (username='$username' OR email='$email') LIMIT 1";
    $result = mysqli_query($top_tier_conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) { // if user exists
      if ($user['username'] === $username) {
        echo "username already exists";
      }

      elseif ($user['email'] === $email) {
        echo "email already exists";
      }

    }else{//register the user

      if(!empty($username) && !empty($email) && !empty($password)){

        $password = md5($password);

        $register_query = "INSERT INTO top_tier_users (username, email, phonenumber, password1, created_at) 
              VALUES('$username', '$email','$phonenumber', '$password', now())";
        $result = mysqli_query($top_tier_conn, $register_query);

        if($result){
          echo "registered successfully";
        }else{
          echo "an error occurred";
        }
      }
    }
  }
  
}else{
  echo json_encode(array(
    "status_code"=>201, 
    "message"=>"An error occurred->method probably not post"
  ));
}