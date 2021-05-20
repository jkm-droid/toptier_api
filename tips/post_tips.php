<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // save tip
  if (isset($_POST['save_data'])) {
    //connect to db
    require_once '../config.php';

    // receive all input values from the form
    $teamA =  ucwords($_POST['team_a']);
    $teamB = ucwords($_POST['team_b']);
    $home =  $_POST['home_score'];
    $draw =  $_POST['draw_score'];
    $away =  $_POST['away_score'];
    $other =  $_POST['other_score'];
    $correct_tip =  $_POST['correct_tip'];
    $match_time =  $_POST['match_time'];
    $vip_status =  $_POST['vip_status'];

    // validate data
    if (empty($teamA)) { echo "Team A is required"; }
    if (empty($teamB)) { echo  "Team B is required"; }
    if (empty($home)) { echo  "Home is required"; }
    if (empty($draw)) { echo  "Draw is required"; }
    if (empty($away)) { echo  "Away is required"; }
    if (empty($correct_tip)) { echo  "Correct Tip is required"; }
    if (empty($match_time)) { echo  "Match Time is required"; }

    if(!empty($teamA) && !empty($teamB) && !empty($home) && !empty($away) && !empty($other) && !empty($draw) && !empty($correct_tip) && !empty($match_time)){
      // save the tip
      $tips_query = "INSERT INTO top_tier_tips (teamA, teamB, home, draw, away, other, correct_tip, match_time, vip_status, created_at) 
      VALUES('$teamA', '$teamB', '$home', '$draw', '$away','$other', '$correct_tip', '$match_time', '$vip_status', now())";
      $result = mysqli_query($top_tier_conn, $tips_query) or die(mysqli_error($top_tier_conn));  

      if($result){
        echo json_encode(array("status_code"=>200));
      }else{
        echo json_encode(array("status_code"=>201));
      }
      
    }else{
      echo "error occurred";
    }
    
  }
}

if(isset($_GET['delete_id'])){
  session_start();

  require_once '../config.php';

  $tip = $_GET['id'];
  // $verify = "SELECT teamA,teamB FROM top_tier_tips WHERE id=7";
  $del_query = "DELETE FROM top_tier_tips WHERE id='$tip' ";
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

  $tip = $_GET['id'];

  $edit_query = "SELECT * FROM top_tier_tips WHERE id='$tip' ";
  $edit = mysqli_query($top_tier_conn, $edit_query);

  if($edit){
    $data_tips = mysqli_fetch_array($edit);

    $data_array = array(
      "status_code"=>200,
      "team_a"=> $data_tips['teamA'],
      "team_b"=> $data_tips['teamB'],
      "home_score"=> $data_tips['home'],
      "draw_score"=> $data_tips['draw'],
      "away_score"=> $data_tips['away'],
      "other_score"=> $data_tips['other'],
      "correct_tip"=>  $data_tips['correct_tip'],
      "match_time"=> $data_tips['match_time'],
      "vip_status"=>$data_tips['vip_status'],
      "wl_status"=>$data_tips['wl_status'],
      "tip_id"=>$data_tips['id'],
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
  $tip_id = $_POST['tip_id'];
  $teamA =  ucwords($_POST['team_a']);
  $teamB = ucwords($_POST['team_b']);
  $home =  $_POST['home_score'];
  $draw =  $_POST['draw_score'];
  $away =  $_POST['away_score'];
  $other =  $_POST['other_score'];
  $correct_tip =  $_POST['correct_tip'];
  $match_time =  $_POST['match_time'];
  $vip_status =  $_POST['vip_status'];

  // validate data
  if (empty($teamA)) { echo "Team A is required"; }
  if (empty($teamB)) { echo  "Team B is required"; }
  if (empty($home)) { echo  "Home is required"; }
  if (empty($draw)) { echo  "Draw is required"; }
  if (empty($away)) { echo  "Away is required"; }
  if (empty($correct_tip)) { echo  "Correct Tip is required"; }
  if (empty($match_time)) { echo  "Match Time is required"; }

  if(!empty($teamA) && !empty($teamB) && !empty($home) && !empty($away) && !empty($draw) && !empty($other) && !empty($correct_tip) && !empty($match_time)){
    // update the tip
    $tips_query = "UPDATE top_tier_tips 
        SET teamA='$teamA', teamB='$teamB', home='$home', draw='$draw', away='$away', other='$other', correct_tip='$correct_tip', match_time='$match_time', vip_status='$vip_status', created_at=now() 
        WHERE id='$tip_id' ";

    $result = mysqli_query($top_tier_conn, $tips_query) or die(mysqli_error($top_tier_conn));  

    if($result){
      echo json_encode(array("status_code"=>200));
    }else{
      echo json_encode(array("status_code"=>201));
    }
    
  }else{
    echo "error occurred";
  }
  
}

if (isset($_POST['update_wl'])) {
  //connect to db
  require_once '../config.php';

  // receive all input values from the form
  $tip_id = $_POST['tip_id'];
  $teamA =  $_POST['team_a'];
  $teamB = $_POST['team_b'];
  $score = $_POST['score'];
  $wl_status =  $_POST['wl_status'];

  // validate data
  if (empty($teamA)) { echo "Team A is required"; }
  if (empty($teamB)) { echo  "Team B is required"; }
  if (empty($score)) { echo  "Score is required"; }


  if(!empty($teamA) && !empty($teamB)){
    // update the tip
    $tips_query = "UPDATE top_tier_tips SET wl_status='$wl_status', score='$score' WHERE id='$tip_id' ";

    $result = mysqli_query($top_tier_conn, $tips_query) or die(mysqli_error($top_tier_conn));  

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