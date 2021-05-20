<?php
header("Content-type: application/json");
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
    $gol_predicts_conn = new PDO('mysql:host=localhost; dbname=mblogco1_gol_predicts', 'mblogco1_golpredicts', 'mainajoseph2407');

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
                $get_query = "SELECT * FROM gol_predicts_tips WHERE (vip_status='$keyword' AND match_time < '$date' ) ORDER BY match_time DESC";
                $execute = $gol_predicts_conn->query($get_query);
                $execute->setFetchMode(PDO::FETCH_ASSOC);

                write_game_tip_array($execute);

            }else if($keyword == 10){
                $keyword = 10;
                //creating sql query to get data
                $get_query = "SELECT * FROM gol_predicts_tips WHERE match_time < '$date' ORDER BY match_time DESC";
                $execute = $gol_predicts_conn->query($get_query);
                $execute->setFetchMode(PDO::FETCH_ASSOC);

                write_game_tip_array($execute);
                
            }else if($keyword == 2407){
                $status = "won";
                //creating sql query to get data
                $get_query = "SELECT * FROM gol_predicts_tips WHERE (wl_status='$status' AND match_time < '$date') ORDER BY RAND() LIMIT 3";
                $execute = $gol_predicts_conn->query($get_query);
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
                $get_query = "SELECT * FROM gol_predicts_tips WHERE (vip_status='$keyword' AND match_time > '$date') ORDER BY match_time LIMIT 5";
                $execute = $gol_predicts_conn->query($get_query);
                $execute->setFetchMode(PDO::FETCH_ASSOC);

                write_game_tip_array($execute);

            }else if($keyword == 10){
                $keyword = 10;
                //creating sql query to get data
                $get_query = "SELECT * FROM gol_predicts_tips WHERE match_time > '$date' ORDER BY match_time LIMIT 5";
                $execute = $gol_predicts_conn->query($get_query);
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