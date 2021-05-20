<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <link rel="shortcut icon" type="image/jpg" href="../favicon.ico"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>TopTier Odds | Login</title>
  </head>
  <body>
    <div class="container">

      <form class="mt-4 offset-md-3 col-md-6" method="post" action="" >
        <h2 class="text-info text-center">Login TopTier Odds</h2>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address/Username</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email/username" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" placeholder="Enter password" class="form-control" id="password">
            </div>
            
        <br>

        <div class="col-md-6 offset-md-3 d-grid">
          <input type="submit" disabled onclick="changeName()" id="login_button" value="Login" name="login" class="btn btn-info">
        </div>
       
      </form>
    </div>

    <script>
      const username = document.getElementById('email');
      const password = document.getElementById('password');
      const btn = document.getElementById('login_button');

      username.addEventListener('input', function () {
        password.addEventListener('input', function () {
          btn.disabled = (this.value === '');
        });
      });

      function changeName() {
        document.getElementById("login_button").value = "Logging you in...Please wait"
      }

      $(document).ready(function(){
          
          $(document).on('click','#login_button', function(e){
            e.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();
            
            if(email !="" && password !=""){

              $.ajax({
                url: 'login_admin.php',
                type: 'POST',
                data: {
                  'login_user':1,
                  'email': email,
                  'password': password,
                },
                success: function(response){
                  console.log(response);
                  if(response.status_code==200){
                    location.href = "../tips/post_ui.php";
                  }else if(response.status_code==201){
                    alert("Wrong email/username/password");
                    location.reload();
                  }
                },

                failure: function (response) {
                  console.log("something went wrong");
                }
              });
          }else{
            alert("please fill all the fields");
          }
          });
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