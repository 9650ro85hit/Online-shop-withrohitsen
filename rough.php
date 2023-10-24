<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="home_page.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   
<style>
  p{
    color:yellow;
    font-size:15px;

  }
  h2{
    color:white;
  }
  h4{
    color:white;
    font-size:15px;
    
  }
  #redp{
    color:red;
  }
  a>span{
    color:blue;
    font-size:30px;
  }
  body {
    background-image: url('images/ecors.webp');
    height: 100vh;
    width: 100%;
    background-repeat: no-repeat;
    background-size: cover; /* Change to "cover" */
}
#navleft{
  float:right;
}
</style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="#"> <span>RS</span>shopie</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto"> <!-- Use ml-auto class here -->
                <a class="nav-link text-light">
                    <form action="home.php" method="POST">
                        <i class="bi bi-box-arrow-in-right"></i>Shop_User
                        <input type="submit">
                    </form>
                </a>
                <a class="nav-link text-light">
                    <form action="admin_loing.php" method="POST">
                        <i class="bi bi-box-arrow-in-right"></i>Admin Login
                        <input type="submit">
                    </form>
                </a>
            </div>
        </div>
    </div>
</nav>

      <div class="container text-center" style="padding-top:10px;">
  <div class="row" style="background-color:black;">
  <h2>Just an example to demo..</h2>
    <div class="col">
      <p id="redp">Admin Login</p>
      <p>username</p><h4>rohitsen</h4>
      <p>password</p><h4>123</h4>
    </div>
    <div class="col">
      <p id="redp">User Id</p>
      <p>gmail</p><h4>ajay@gmail.com</h4>
      <p>password</p><h4>098</h4>
    </div>
    
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>