<?php
//toptier/get_tips.php
header("Content-type: application/json");
date_default_timezone_set("Africa/Nairobi");

//convert data to json format
function write_game_tip_array($array){
    echo "{\n";
    echo '"tips":';
    echo "[\n";
    $comma = true;
    foreach ($array as $arr){
        if($comma){
            $comma = false;
        }else{
            echo ",\n";
        }
        echo json_encode($arr, JSON_PRETTY_PRINT);
    }
    echo "\n]\n";
    echo "}";
}
   
if ($_SERVER['REQUEST_METHOD'] =='GET') {
    // establish connection to data source
    $top_tier_conn = new PDO('mysql:host=localhost; dbname=mblogco1_top_tier', 'mblogco1_toptier', 'mainajoseph2407');

    //change the timezone
    date_default_timezone_set("Africa/Nairobi");
    $date = date("Y-m-d H:i:s");

    //check if the user is VIP and get
    //VIP tips
    //all matches activity
    if(isset($_GET['all_matches'])){
        $keyword = $_GET['keyword'];
        
        if(!empty($keyword)){
            if($keyword == 5){
                $keyword = 5;
                //creating sql query to get data
                $get_query = "SELECT * FROM top_tier_tips WHERE (vip_status='$keyword' AND match_time < '$date' ) ORDER BY match_time DESC";
                $execute = $top_tier_conn->query($get_query);
                $execute->setFetchMode(PDO::FETCH_ASSOC);

                write_game_tip_array($execute);

            }else if($keyword == 10){
                $keyword = 10;
                //creating sql query to get data
                $get_query = "SELECT * FROM top_tier_tips WHERE match_time < '$date' ORDER BY match_time DESC";
                $execute = $top_tier_conn->query($get_query);
                $execute->setFetchMode(PDO::FETCH_ASSOC);

                write_game_tip_array($execute);
            }

        }else{
            echo json_encode(array(
                "status_code"=>201,
                "message"=>"an error occurred",
            ));
        }
    // logic for the latest tips
    // grab the recent 5 tips depending on user status (vip & normal)
    }else if(isset($_GET['latest_matches'])){
        $keyword = $_GET['keyword'];

        if(!empty($keyword)){
            if($keyword == 5){
                $keyword = 5;
                //creating sql query to get data
                $get_query = "SELECT * FROM top_tier_tips WHERE (vip_status='$keyword' AND match_time > '$date') ORDER BY match_time LIMIT 5";
                $execute = $top_tier_conn->query($get_query);
                $execute->setFetchMode(PDO::FETCH_ASSOC);

                write_game_tip_array($execute);

            }else if($keyword == 10){
                $keyword = 10;
                //creating sql query to get data
                $get_query = "SELECT * FROM top_tier_tips WHERE match_time > '$date' ORDER BY match_time LIMIT 5";
                $execute = $top_tier_conn->query($get_query);
                $execute->setFetchMode(PDO::FETCH_ASSOC);

                write_game_tip_array($execute);
            }

        }else{
            echo json_encode(array(
                "status_code"=>201,
                "message"=>"an error occurred",
            ));
        }

    }else{
        echo json_encode(array(
            "status_code"=>201,
            "message"=>"an error occurred",
        ));
    }


}else{
    echo json_encode(array(
        "status_code"=>201,
        "message"=>"an error occurred",
    ));
}