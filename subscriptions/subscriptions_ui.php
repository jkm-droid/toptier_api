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

    <title>TopTier Odds | Subscriptions</title>
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
                <a class="nav-link text-info" href="/tips/post_ui.php"><strong>Recent Tips</strong></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" href="/users/users_ui.php"><strong>Users</strong></a>
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
      <h4 class="text-center text-info">Subscriptions</h4><hr>
      <div class="tips-table">
        <?php  
           define('DBHOST', 'localhost');
           define('DBNAME', 'mblogco1_top_tier');
           define('DBUSER', 'mblogco1_toptier');
           define('DBPASS', 'mainajoseph2407');
           
          $top_tier_conn = mysqli_connect(DBHOST, DBUSER,DBPASS, DBNAME);

          $query = "SELECT * FROM top_tier_subscriptions"; //WHERE match_time >= DATE(NOW()) 
          $data = mysqli_query($top_tier_conn, $query); ?>

          <?php if (mysqli_num_rows($data) > 0){ ?>
            <table class='table table-striped table-hover'>
              <tr>
                  <th>No.</th>
                  <th>Email</th>
                  <th>Purchase Token</th>
                  <th>Product Id</th>
                  <th>Purchase Time</th>
                  <th>Created On</th>
              </tr>
              <?php $i = 1; ?>
              <?php while($row = mysqli_fetch_array($data)){ ?>
              <tr>
                <td> <?php echo $i++; ?></td>
                <td> <?php echo $row['email'] ?> </td>
                <td> <?php echo $row['purchase_token'] ?> </td>
                <td> <?php echo $row['product_id'] ?> </td>
                <td> <?php echo $row['purchase_time'] ?> </td>
                <td> <?php echo $row['created_on'] ?> </td>
              </tr>
            <?php } ?>

            </table>

          <?php } else { ?>
            <div class="alert alert-info text-center">no subscriptions</div>
          <?php } ?>
      </div>
    </div>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>