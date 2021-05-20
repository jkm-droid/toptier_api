<?php
//toptier/homedetails.php
date_default_timezone_set("Africa/Nairobi");
if ($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["get_details"])){
        require_once '../config.php';
        
        //change the timezone
        $date = date("Y-m-d H:i:s");

        $query_upcoming = "SELECT * FROM top_tier_tips WHERE match_time >= '$date'";
        $result_up = mysqli_query($top_tier_conn, $query_upcoming);

        $upcoming_matches = mysqli_num_rows($result_up);

        $query_all = "SELECT * FROM top_tier_tips";
        $result_all = mysqli_query($top_tier_conn, $query_all);

        $all_matches = mysqli_num_rows($result_all);
        
        $wl_status = "won";
        $query_correct = "SELECT * FROM top_tier_tips WHERE wl_status='$wl_status' ";
        $result_correct = mysqli_query($top_tier_conn, $query_correct);
        
        $correct_tips = mysqli_num_rows($result_correct);
        
        $members_query = "SELECT * FROM top_tier_users";
        $result_members = mysqli_query($top_tier_conn, $members_query);
        
        $exact_users = mysqli_num_rows($result_members);
        
        $members = $all_matches + $correct_tips + $exact_users + (100 * $correct_tips);
       
        echo json_encode(array(
            "upcoming_matches" => $upcoming_matches,
            "all_matches" => $all_matches,
            "correct_tips"=> $correct_tips,
            "all_members"=>$members,
        ));


    }else{
        echo json_encode(array(
            "status_code"=>201,
            'message' => 'An error occurred',
        ));
    }

}else{
    echo json_encode(array(
        "status_code"=>201,
        'message' => 'An error occurred',
    ));
}
?>