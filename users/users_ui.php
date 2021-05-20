<?php 
  session_start();

  if (!isset($_SESSION['email_username'])) {
  	header('location: login_ui.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email_username']);
  	header("location: login_ui.php");
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

    <title>TopTier Odds | Users</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="post_ui.php">TopTier Odds</a>
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
                <a class="nav-link text-info" href="/tips/all_tips_ui.php"><strong>All Tips</strong></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" href="/tips/post_ui.php"><strong>Recent Tips</strong></a>
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


    <div class="container-fluid ml-4 mr-4">

      <form class="mt-4" method="post" action="" id="form_submit" style="display: none;">
      <h4 class="text-center text-info">Edit User</h4>

       <p class="text-success" id="success_area"></p>

        <div class="row g-3">
          <div class="col-md-4">
            <label for="inputusername" class="form-label">Username</label>
            <input type="text" name="username" class="form-control"  id="inputusername" readonly>
            <div id="usernameHelp" class="form-text text-info"><b>*We'll never share your email with anyone else</b></div>
          </div>
          <div class="col-md-4">
            <label for="inputemail" class="form-label">Email</label>
            <input type="email" name="email" class="form-control"  id="inputemail" readonly>
            <div id="emailHelp" class="form-text text-info"><b>*We'll never share your email with anyone else</b></div>
          </div>
          <div class="col-md-4">
            <label for="inputphonenumber" class="form-label">Phone Number</label>
            <input type="number" name="phonenumber" class="form-control"  id="inputphonenumber" readonly>
            <input type="hidden" name="user_id" class="form-control" id="user_id">
          </div>
        </div>
        
        <div class="row g-3">
            <div class="mb-3 mt-3 form-check col-md-4">
                <input type="checkbox" class="form-check-input" id="vip_user">
                <label id="vip_user_label" class="form-check-label text-primary" for="vip_user"><strong>Check for VIP user</strong></label>
                <input type="hidden" name="vip_edit" class="form-control" id="vip_edit">
            </div>
            
            <div class="mb-3 mt-3 form-check col-md-4">
                <input type="checkbox" class="form-check-input" id="active_user">
                <label id="active_user_label" class="form-check-label text-primary" for="active_user"><strong>Activate user</strong></label>
                <input type="hidden" name="active_edit" class="form-control" id="active_edit">
            </div>
        </div>
        
        <br>

        <div class="col-md-6 offset-md-3 d-grid">
          <input type="submit" id="update_button" value="Update User" name="update_user" class="btn btn-primary" style="display:none;">
        </div>
       
      </form>
    
      <h4 class="text-center text-info">Current Registered Users</h4><hr>
      <div class="tips-table">
        <?php
            define('DBHOST', 'localhost');
            define('DBNAME', 'mblogco1_top_tier');
            define('DBUSER', 'mblogco1_toptier');
            define('DBPASS', 'mainajoseph2407');

          $top_tier_conn = mysqli_connect(DBHOST, DBUSER,DBPASS, DBNAME);

          $query = "SELECT * FROM top_tier_users ORDER BY created_at DESC"; 
          $data = mysqli_query($top_tier_conn, $query); ?>

          <?php if (mysqli_num_rows($data) > 0){ ?>
            <table class='table table-striped table-hover'>
              <tr>
                  <th>No.</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Phonenumber</th>
                  <th>VIP Status</th>
                  <th>Active</th>
                  <th>Created At</th>
                  <th class="">Action</th>
              </tr>
              <?php $i = 1; ?>
              <?php while($row = mysqli_fetch_array($data)){ ?>
              <tr>
                  <td> <?php echo $i++; ?></td>
                  <td> <?php echo $row['username'] ?> </td>
                  <td> <?php echo $row['email'] ?> </td>
                  <td> <?php echo $row['phonenumber'] ?> </td>
                  <td class=""> 
                    <?php if ($row['status'] == 5) { ?> 
                      <i class="fa fa-times-circle text-danger"></i>
                    <?php }else if($row['status'] == 10){ ?>
                    <i class="fa fa-check-circle text-success"></i>
                    <?php } ?>
                  </td>
                  
                  <td class=""> 
                    <?php if ($row['activated'] == "false") { ?> 
                      <i class="fa fa-times-circle text-danger"></i>
                    <?php }else if($row['activated'] == "true"){ ?>
                    <i class="fa fa-check-circle text-success"></i>
                    <?php } ?>
                  </td>
                  
                  <td> <?php echo $row['created_at'] ?> </td>
                  <td class="">
                    <button id="make_vip_btn" data-id="<?php echo $row['id'] ?>" class="btn btn-sm btn-info">Edit</button>
                  </td>

              </tr>
            <?php } ?>

            </table>

          <?php } else { ?>
            <div class="alert alert-info text-center">No registered users</div>
          <?php } ?>
      </div>
    </div>

    <script>
      // editing the user to VIP
      $(document).on('click', '#make_vip_btn', function(){
          var user_id = $(this).attr("data-id");
          
          if(confirm("Are you sure want to edit this user status?")){
            $(window).scrollTop(0);
            $.ajax({
              url:'users.php',
              type: 'GET',
              cache: false,
              data: {
                'edit_id':1,
                id:user_id,
              },

              success: function(response){
                if(response.status_code==200){

                  $('#inputusername').val(response.username);
                  $('#inputemail').val(response.email);
                  $('#inputphonenumber').val(response.phonenumber);
                  $('#vip_edit').val(response.vip_status);
                  $('#active_edit').val(response.activated);
                  $('#user_id').val(response.user_id);

                  if(response.vip_status == 10){
                    document.getElementById("usernameHelp").innerHTML = "*This user is VIP"
                    document.getElementById('usernameHelp').style.fontWeight = "bold";
                    
                    document.getElementById('vip_user_label').innerHTML = "Check for Normal user";
                    document.getElementById('vip_user_label').style.fontWeight = "bold";
                    
                  }else if(response.vip_status == 5){
                    document.getElementById("usernameHelp").innerHTML = "*This user is Normal"
                    document.getElementById('usernameHelp').style.fontWeight = "bold";
                  }
                  
                  if(response.activated === "true"){
                    document.getElementById("emailHelp").innerHTML = "*This user is Active"
                    document.getElementById('emailHelp').style.fontWeight = "bold";
                    
                    document.getElementById('active_user_label').innerHTML = "Deactivate user";
                    document.getElementById('active_user_label').style.fontWeight = "bold";
                    
                  }else if(response.activated === "false"){
                    document.getElementById("emailHelp").innerHTML = "*This user is Inactive"
                    document.getElementById('emailHelp').style.fontWeight = "bold";
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
      
      //updating the user
      $(document).on('click','#update_button', function(e){
          e.preventDefault();

          if($('#vip_user').is(':checked')){
              var vip_status = $('#vip_edit').val();
              if(vip_status == 10){
                  vip_status = 5;
              }else if(vip_status == 5){
                  vip_status = 10;
              }
          }else{
            var vip_status = $('#vip_edit').val();
          }
          
          if($('#active_user').is(':checked')){
              var active_status = $('#active_edit').val();
              if(active_status == "true"){
                  active_status = "false";
              }else if(active_status == "false"){
                  active_status = "true";
              }
          }else{
            var active_status = $('#active_edit').val();
          }
         
          var username = $('#inputusername').val();
          var email = $('#inputemail').val();
          var phonenumber = $('#inputphonenumber').val();
          var user_id = $('#user_id').val();

          if(username !="" && email !="" && phonenumber !=""){
              console.log(user_id);
              console.log(vip_status);
              console.log(active_status);
            $.ajax({
              url: 'users.php',
              type: 'POST',
              data: {
                'update_data':1,
                'user_id':user_id,
                'username': username,
                'email': email,
                'vip_status': vip_status,
                'active_status': active_status,
              },
              success: function(response){
                  console.log(response);
                if(response.status_code==200){                   
                  alert("User Updated successfully");
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

      // deleting the user
      $(document).on('click','#delete_btn', function(){

          var user_id = $(this).attr("data-id");
          
          if(confirm("Are you sure want to delete this user?")){
            
            $.ajax({
              url:'users.php',
              type: 'GET',
              cache: false,
              data: {
                'delete_id':1,
                id:user_id,
              },

              success: function(response){
                if(response.status_code==200){
                  alert("User deleted successfully");
                  location.reload();
                }else if(response.status_code==201){
                  alert("An error occurred");
                }
              },

              failure: function (response) {
              }

            });

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