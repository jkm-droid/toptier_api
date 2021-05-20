<?php 
  session_start();

  if (!isset($_SESSION['email_username'])) {
  	header('location: /users/login_ui.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email_username']);
  	header("location: /users/login_ui.php");
  }
 
?>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <link rel="shortcut icon" type="image/jpg" href="../favicon.ico"/>


    <!-- jquery and ajax -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- font-awesome icons link -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>TopTier Odds| All Tips</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="post_ui.php"><i class="far fa-futbol" aria-hidden="true"></i>TopTier Odds</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span> 
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
            <?php if(isset($_SESSION['email_username'])): ?>
              <ul class="nav navbar-nav navbar-right">
              <li class="nav-item">
                <a class="nav-link text-success" aria-current="page" href="#">Welcome, <strong><?php echo $_SESSION['email_username']; ?></strong></a>
              </li>
              <li class="nav-item">
                <?php if(isset($_SESSION['status']) && $_SESSION['status'] == 10): ?>
                  <i class="fa fa-check-circle text-info font-weight-bold"></i>
                <?php endif ?>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" href="/tips/post_ui.php"><strong>Recent Tips</strong></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" href="/users/users_ui.php"><strong>Users</strong></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" href="/subscriptions/subscriptions_ui.php"><strong>Subscriptions</strong></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-danger" href="/tips/post_ui.php?logout='1'"><strong>Logout</strong></a>
              </li>
              </ul>
            <?php endif ?>
         
        </div>
      </div>
    </nav>

    <div class="container-fluid">

      <form class="mt-4" method="post" action="" id="form_submit" style="display:none;">
      <h4 class="text-center text-info" id="title">Update Tip</h4>

       <p class="text-success" id="success_area"></p>

        <div class="row g-3">
          <div class="col-md-6">
            <label for="inputteamA" class="form-label">Team A</label>
            <input type="text" name="team_a" class="form-control" placeholder="enter team A" id="inputteamA" >
          </div>
          <div class="col-md-6">
            <label for="inputteamB" class="form-label">Team B</label>
            <input type="text" name="team_b" class="form-control" placeholder="enter team B" id="inputteamB" >
          </div>
        </div>

        <div class="row g-3">
          <div class="col-md-4">
            <label for="inputhomescore" class="form-label" id="label-home">Home Score</label>
            <input type="number" name="home_score" class="form-control" placeholder="enter home score" id="inputhomescore">
          </div>
          <div class="col-md-4">
            <label for="inputdrawscore" class="form-label" id="label-draw">Draw Score</label>
            <input type="number" name="draw_score" class="form-control" placeholder="enter draw score" id="inputdrawscore">
          </div>
          <div class="col-md-4">
            <label for="inputawayscore" class="form-label" id="label-away">Away Score</label>
            <input type="number" name="away_score" class="form-control" placeholder="enter away score" id="inputawayscore">
          </div>
        </div>

        <div class="row g-3">
          <div class="col-md-4 mt-3">
          <label for="inputcorrecttip" class="form-label" id="label-all">Correct Tip</label>
          <select name="correct_tip" id="correct_tip" class="form-select form-control" aria-label="Default select example">
            <option selected>Select correct tip</option>
            <option value="Home">Home</option>
            <option value="Draw">Draw</option>
            <option value="Away">Away</option>
            <option value="Over 1.5">Over 1.5</option>
            <option value="Over 2.5">Over 2.5</option>
            <option value="Under 2.5">Under 2.5</option>
            <option value="Under 3.5">Under 3.5</option>
            <option value="1or2">1or2</option>
            <option value="1orX">1orX</option>
            <option value="2orX">2orX</option>
          </select>
          </div>
          <div class="col-md-4">
            <label for="inputotherscore" class="form-label">Other Odd <small>(eg odd for 1or2,1orX,.. etc)</small></label>
            <input type="number" name="other_score" class="form-control" placeholder="enter other score" id="inputotherscore">
          </div>
          <div class="col-md-4">
            <label for="inputmatchtime" class="form-label" id="label-matchtime">Match Time</label>
            <input type="datetime-local" name="match_time" class="form-control" placeholder="enter match time" id="inputmatchtime">
            <input type="hidden" name="match_time" class="form-control" id="matchtime_edit">
          </div>
          <input type="hidden" name="tip_id" class="form-control" id="tip_id">
        </div>
        
        <div class="mb-3 mt-3 form-check">
            <input type="checkbox" class="form-check-input" id="vip_tips">
            <label id="vip_status_label" class="form-check-label text-primary" for="vip_status"><strong>Check for VIP tips</strong></label>
            <input type="hidden" name="vip_edit" class="form-control" id="vip_edit">
        </div>

        <br>

        <div class="col-md-6 offset-md-3 d-grid">
          <input type="submit" id="update_button" value="Update Tip" name="update_tips" class="btn btn-primary" style="display:none;">
        </div>
       
      </form>
      
      
      <form class="mt-4" method="post" action="" id="form_wl" style="display:none;">
        <h4 class="text-center text-info" id="title">Update Match Won/Lost Status</h4>
        
        <div class="row g-3">
          <div class="col-md-4">
            <label for="inputteamA" class="form-label">Team A</label>
            <input type="text" name="team_a" class="form-control" placeholder="enter team A" id="wl_inputteamA" >
          </div>
          
          <div class="col-md-4">
            <label for="inputteamB" class="form-label">Team B</label>
            <input type="text" name="team_b" class="form-control" placeholder="enter team B" id="wl_inputteamB" >
          </div>
          
        <div class="col-md-4">
            <label for="inputscore" class="form-label">Score</label>
            <input type="text" name="score" class="form-control" placeholder="enter score here" id="score">
        </div>
        
        </div>
        
        <input type="hidden" name="tip_id" class="form-control" id="wl_tip_id">
        
        <div class="mb-3 mt-3 form-check">
            <input type="checkbox" class="form-check-input" id="won_lost">
            <label id="wl_check_label" class="form-check-label text-primary" for="wl_status" id="check-box-label"><strong>Check for Lost match</strong></label>
            <input type="hidden" name="wl_edit" class="form-control" id="wl_edit">
        </div>
            
        <br>

        <div class="col-md-6 offset-md-3 d-grid">
          <input type="submit" id="update_wl_btn" value="Update Match Status" name="update_match" class="btn btn-primary">
        </div>
       
      </form>
      
      <h4 class="text-center text-info">All Betting Tips</h4><hr>
      <div class="tips-table">
        <?php  
        //   define('DBHOST', 'localhost');
        //   define('DBNAME', 'gol_predicts');
        //   define('DBUSER', 'root');
        //   define('DBPASS', '');

            define('DBHOST', 'localhost');
            define('DBNAME', 'mblogco1_top_tier');
            define('DBUSER', 'mblogco1_toptier');
            define('DBPASS', 'mainajoseph2407');
          
          $top_tier_conn = mysqli_connect(DBHOST, DBUSER,DBPASS, DBNAME);

          $query = "SELECT * FROM top_tier_tips ORDER BY match_time ASC"; //WHERE match_time >= DATE(NOW()) 
          $data = mysqli_query($top_tier_conn, $query); ?>

          <?php if (mysqli_num_rows($data) > 0){ ?>
            <table class='table table-striped table-hover'>
              <tr>
                  <th>No.</th>
                  <th>Team A</th>
                  <th>Team B</th>
                  <th>Home Score</th>
                  <th>Draw Score</th>
                  <th>Away Score</th>
                  <th>Other Score</th>
                  <th>Correct Tip</th>
                  <th>Match Time</th>
                  <th>W/L Status</th>
                  <th>Score</th>
                  <th>VIP Status</th>
                  <th class="text-center">Action</th>
              </tr>
              <?php $i = 1; ?>
              <?php while($row = mysqli_fetch_array($data)){ ?>
              <tr>
                 
                  <?php
                    //change the timezone
                    date_default_timezone_set("Africa/Nairobi");
                    $date = date("Y-m-d H:i:s");
                    if ($row['match_time'] < $date) { ?> 
                        <td class="text-secondary"> <?php echo $i++; ?></td>
                        <td class="text-secondary"> <?php echo $row['teamA'] ?> </td>
                        <td class="text-secondary"> <?php echo $row['teamB'] ?> </td>
                        <td class="text-secondary"> <?php echo $row['home'] ?> </td>
                        <td class="text-secondary"> <?php echo $row['draw'] ?> </td>
                        <td class="text-secondary"> <?php echo $row['away'] ?> </td>
                        <td class="text-secondary"> <?php echo $row['other'] ?> </td>
                        <td class="text-secondary"> <?php echo $row['correct_tip'] ?> </td>
                        <td class="text-secondary"> <?php echo $row['match_time'] ?> </td>
                  <?php } else {?>
                    <td> <?php echo $i++; ?></td>
                    <td> <?php echo $row['teamA'] ?> </td>
                    <td> <?php echo $row['teamB'] ?> </td>
                    <td> <?php echo $row['home'] ?> </td>
                    <td> <?php echo $row['draw'] ?> </td>
                    <td> <?php echo $row['away'] ?> </td>
                    <td> <?php echo $row['other'] ?> </td>
                    <td> <?php echo $row['correct_tip'] ?> </td>
                    <td> <?php echo $row['match_time'] ?> </td>
                  <?php } ?> 

                    <?php if ($row['wl_status'] == "won") { ?> 
                        <td class="text-success text-center"><?php echo $row['wl_status'] ?></td>
                    <?php }else if($row['wl_status'] == "lost"){ ?>
                        <td class="text-danger text-center"><?php echo $row['wl_status'] ?></td>
                    <?php } ?>               
                  <td><?php echo $row['score'] ?></td>
                  <td class="text-center"> 
                    <?php if ($row['vip_status'] == 5) { ?> 
                      <i class="fa fa-times-circle text-danger"></i>
                    <?php }else if($row['vip_status'] == 10){ ?>
                    <i class="fa fa-check-circle text-success"></i>
                    <?php } ?>
                  </td>
                  <td>
                    <button id="delete_btn" data-id="<?php echo $row['id'] ?>" class="btn btn-sm btn-danger">Delete</button>
                    <button  id="edit_btn" data-id="<?php echo $row['id'] ?>" class="btn btn-sm btn-info">Edit</button>
                    <button id="edit_wl_btn" data-id="<?php echo $row['id'] ?>" class="btn btn-sm btn-primary">W/L</button>
                    <!-- <a href="post_tips.php?id=<?php //echo $row['id']; ?>"><button class="btn btn-sm btn-danger">Delete</button></a> -->
                  </td>

              </tr>
            <?php } ?>

            </table>

          <?php } else { ?>
            <div class="alert alert-info text-center">no betting tips</div>
          <?php } ?>
      </div>
    </div>

    <script>
    // editing a tip
      $(document).on('click', '#edit_btn', function(){
          var tip_id = $(this).attr("data-id");
          
          if(confirm("Are you sure want to edit this tip?")){
            $(window).scrollTop(0);
            $.ajax({
              url:'post_tips.php',
              type: 'GET',
              cache: false,
              data: {
                'edit_id':1,
                id:tip_id,
              },

              success: function(response){
                if(response.status_code==200){
                  $('#form_wl').hide();
                  
                  $('#inputteamA').val(response.team_a);
                  $('#inputteamB').val(response.team_b);
                  $('#inputhomescore').val(response.home_score);
                  $('#inputdrawscore').val(response.draw_score);
                  $('#inputawayscore').val(response.away_score);
                  $('#inputotherscore').val(response.other_score);
                  $('#correct_tip').val(response.correct_tip);
                  $('#matchtime_edit').val(response.match_time);
                  $('#vip_edit').val(response.vip_status);
                  $('#tip_id').val(response.tip_id);
                  
                  if(response.vip_status == 10){
                      document.getElementById('vip_status_label').innerHTML = "Check for Normal tip";
                      document.getElementById('vip_status_label').style.fontWeight = "bold";
                  }

                  $('#form_submit').show();
                  $('#update_button').show();
                  
                }else if(response.status_code==201){
                  alert("An error occurred");
                }
              }

            });

          }

      });
          
      //updating tip
      $(document).on('click','#update_button', function(e){
          e.preventDefault();

          if($('#vip_tips').is(':checked')){
              var vip_status = $('#vip_edit').val();
              if(vip_status == 10){
                  vip_status = 5;
              }else if(vip_status == 5){
                  vip_status = 10;
              }
          }else{
            var vip_status = $('#vip_edit').val();
          }
         
          var team_a = $('#inputteamA').val();
          var team_b = $('#inputteamB').val();
          var home_score = $('#inputhomescore').val();
          var draw_score = $('#inputdrawscore').val();
          var away_score = $('#inputawayscore').val();
          var other_score = $('#inputotherscore').val();
          var correct_tip = $('#correct_tip').val();
          var match_time = $('#inputmatchtime').val();
          if(match_time == ''){
            match_time = $('#matchtime_edit').val();
          }
          var vip_tips = $('#vip_tips').val();
          var tip_id = $('#tip_id').val();

          if(team_a !="" && team_b !="" && home_score !="" && draw_score !="" && away_score !="" && correct_tip !="" && match_time != ""){
            $.ajax({
              url: 'post_tips.php',
              type: 'POST',
              data: {
                'update_data':1,
                'tip_id':tip_id,
                'team_a': team_a,
                'team_b': team_b,
                'home_score': home_score,
                'draw_score': draw_score,
                'away_score': away_score,
                'other_score': other_score,
                'correct_tip': correct_tip,
                'match_time': match_time,
                'vip_status': vip_status,
              },
              success: function(response){
                if(response.status_code==200){                   
                  alert("Tip Updated successfully");
                  location.reload();
                  
                }else if(response.status_code==201){
                  alert("An error occurred");
                }                  
              },

              failure: function (response) {
              }
            });
        }else{
          alert("please fill all the fields");
        }
      });

      //deleting a tip
      $(document).on('click','#delete_btn', function(){

      var tip_id = $(this).attr("data-id");

      if(confirm("Are you sure want to delete this tip?")){$('#inputhomescore').hide();
        
        $.ajax({
          url:'post_tips.php',
          type: 'GET',
          cache: false,
          data: {
            'delete_id':1,
            id:tip_id,
          },

          success: function(response){
            if(response.status_code==200){
            //   console.log(response.status_code);
              alert("Tip deleted successfully");
              location.reload();
            }else if(response.status_code==201){
            //   console.log(response.status_code);
              alert("An error occurred");
            }
          }

        });

      }

      });

      // edit won or lost status
      $(document).on('click', '#edit_wl_btn', function(){
          var tip_id = $(this).attr("data-id");
          
          if(confirm("Are you sure want to edit won/lost status of this tip?")){
            $(window).scrollTop(0);
            $.ajax({
              url:'post_tips.php',
              type: 'GET',
              cache: false,
              data: {
                'edit_id':1,
                id:tip_id,
              },

              success: function(response){
               console.log(response);
                if(response.status_code==200){
                  $('#form_submit').hide();
                  $('#form_wl').show();
                  $('update_wl_btn').show();
                  
                  $('#wl_inputteamA').val(response.team_a);
                  $('#wl_inputteamB').val(response.team_b);
                  $('#wl_edit').val(response.wl_status);
                  $('#wl_tip_id').val(response.tip_id);
                  
                  if(response.wl_status === "lost"){
                      document.getElementById('wl_check_label').innerHTML = "Check for Won match";
                      document.getElementById('wl_check_label').style.fontWeight = "bold";
                  }

                  document.getElementById("wl_inputteamA").readOnly = true;
                  document.getElementById("wl_inputteamB").readOnly = true;

                }else if(response.status_code==201){
                  alert("An error occurred");
                }
              }

            });

          }

      });

      //updating the won-lost status
      $(document).on('click','#update_wl_btn', function(e){
          e.preventDefault();

          if($('#won_lost').is(':checked')){
              var wl_status = $('#wl_edit').val();
              if(wl_status === "won"){
                  wl_status = "lost";
              }else if(wl_status == "lost"){
                  wl_status = "won";
              }
          }else{
            var wl_status = $('#wl_edit').val();
          }
         
          var team_a = $('#wl_inputteamA').val();
          var team_b = $('#wl_inputteamB').val();
          var score = $('#score').val();
          var tip_id = $('#wl_tip_id').val();

          console.log(score);

          if(team_a !="" && team_b !="" && score != ""){

            $.ajax({
              url: 'post_tips.php',
              type: 'POST',
              data: {
                'update_wl':1,
                'tip_id':tip_id,
                'team_a': team_a,
                'team_b': team_b,
                'score': score,
                'wl_status': wl_status,
              },
              success: function(response){
                //   console.log(response);
                if(response.status_code==200){                   
                  alert("Tip Updated successfully");
                  location.reload();
                  
                }else if(response.status_code==201){
                  alert("An error occurred");
                }                  
              },

              failure: function (response) {
              }
            });
        }else{
          alert("please fill all the fields");
        }
      });
      
    </script>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>