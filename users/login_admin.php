<?php
//toptier/login_admin.php
date_default_timezone_set("Africa/Nairobi");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  require_once '../config.php';

  
  if (isset($_POST['login_user'])) {
    //grab the data from the app
    $email_username = $_POST['email'];
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
    $admin = "admin";
    $user_login_query = "SELECT * FROM top_tier_users WHERE (email='$email_username' or username='$email_username') AND password1='$password' AND admin_status='$admin' LIMIT 1";
    $result = mysqli_query($top_tier_conn, $user_login_query);

    if (mysqli_num_rows($result) == 1) {
    

        $user_details = mysqli_fetch_array($result);
        $_SESSION['email_username'] = $user_details['username'];
        $_SESSION['status'] = $user_details['status'];

        echo json_encode(array(
          "status_code"=>200,
        ));
        

    }else{
        echo json_encode(array("status_code"=>201));
    }

  }
}
?>