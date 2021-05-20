<?php
    //toptier/config.php
    date_default_timezone_set("Africa/Nairobi");
    header('Content-type: application/json');
    define('DBHOST', 'localhost');
    define('DBNAME', 'mblogco1_top_tier');
    define('DBUSER', 'mblogco1_toptier');
    define('DBPASS', 'mainajoseph2407');

    $top_tier_conn = mysqli_connect(DBHOST, DBUSER,DBPASS, DBNAME);

   if(!$top_tier_conn){
       $msg = "Mysql error". mysqli_error($top_tier_conn);
       $status = "false";

       $message = array(
           'message'=>$msg,
           'status'=>$status
       );

       echo json_encode($message, JSON_PRETTY_PRINT);
    }