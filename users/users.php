<?php
//toptier/users.php
date_default_timezone_set("Africa/Nairobi");

if(isset($_GET['delete_id'])){
  session_start();

  require_once '../config.php';

  $user = $_GET['id'];
  // $verify = "SELECT teamA,teamB FROM top_tier_tips WHERE id=7";
  $del_query = "DELETE FROM top_tier_users WHERE id='$user' ";
  $delete = mysqli_query($top_tier_conn, $del_query) or die(mysqli_error($top_tier_conn));

  if($delete){
    // $_SESSION['delete-message'] = "Tip deleted successfully";
    // header('location: post_ui.php');
    // exit();
    echo json_encode(array("status_code"=>200));
  }else{
    echo json_encode(array("status_code"=>201));
  }

}


if(isset($_GET['edit_id'])){
    session_start();
  
    require_once '../config.php';
  
    $user = $_GET['id'];
  
    $edit_query = "SELECT * FROM top_tier_users WHERE id='$user' ";
    $edit = mysqli_query($top_tier_conn, $edit_query);
  
    if($edit){
      $data_users = mysqli_fetch_array($edit);
  
      $data_array = array(
        "status_code"=>200,
        "username"=> $data_users['username'],
        "email"=> $data_users['email'],
        "phonenumber"=> $data_users['phonenumber'],
        "vip_status"=>$data_users['status'],
        "activated"=>$data_users['activated'],
        "user_id"=>$data_users['id'],
      );
  
      echo json_encode($data_array);
  
    }else{
      echo json_encode(array("status_code"=>201));
    }
  }

if (isset($_POST['update_data'])) {
    //connect to db
    require_once '../config.php';

    // receive all input values from the form
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $vip_status =  $_POST['vip_status'];
    $active_status =  $_POST['active_status'];

    // validate data
    if (empty($vip_status)) { echo  "VIP status is required"; }
    if (empty($active_status)) { echo  "Active status is required"; }

    if(!empty($username) && !empty($email)){
        // update the user
        $user_query = "UPDATE top_tier_users SET  status='$vip_status', activated='$active_status' WHERE id='$user_id' ";

        $result = mysqli_query($top_tier_conn, $user_query) or die(mysqli_error($gol_predicts_conn));  

        if($result){
            echo json_encode(array("status_code"=>200));
        }else{
            echo json_encode(array("status_code"=>201));
        }
        
    }else{
        echo "error occurred";
    }

}
?>