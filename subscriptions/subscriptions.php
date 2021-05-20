<?php
//toptier/subscriptions.php

header("Content-type: application/json");
date_default_timezone_set("Africa/Nairobi");

if ($_SERVER['REQUEST_METHOD'] =='POST') {
    
    if(isset($_POST['subscription_details'])){
        require_once '../config.php';
        
        $email = $_POST['email'];
        $purchase_token = $_POST['purchase_token'];
        $product_id = $_POST['product_id'];
        $purchase_time = $_POST['purchase_time'];
        
        if(!empty($email) && !empty($purchase_token) && !empty($product_id) && !empty($purchase_time)){
            //check if email exists
            $check_query = "SELECT * FROM top_tier_subscriptions WHERE email='$email' LIMIT 1";
            $check = mysqli_query($top_tier_conn, $check_query);
            $result = mysqli_fetch_assoc($check);
            
            if($result){
                if($result['email'] == $email){
                    echo "you are already subscribed";
                    
                }
                
            }else{
                $insert_query = "INSERT INTO top_tier_subscriptions (email, purchase_token, product_id, purchase_time, created_on) 
                            VALUES ('$email', '$purchase_token', '$product_id', '$purchase_time', now())";
                $execute = mysqli_query($top_tier_conn, $insert_query);
            
                if($execute){
                    //change the user status
                    $vip_status = 10;
                    $update_query = "UPDATE top_tier_users SET status='$vip_status' WHERE email='$email' ";
                    $update_user = mysqli_query($top_tier_conn, $update_query);
                        //   $msg = "Mysql error". mysqli_error($top_tier_conn);
                        //   echo $msg;
                    if($update_user){
                        echo "subscription saved successfully";
                    }else{
                        echo "subscription not saved";
                    }
                }else{
                    echo "an error occurred";
                }
            }
            
            
        }else{
            echo "Error: some data was empty";
        }
    }
    
}else{
    echo json_encode(array(
        "status_code"=>201,
        "message"=>"an error occurred",
    ));
}