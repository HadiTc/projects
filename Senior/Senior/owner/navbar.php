<!DOCTYPE html>
<html lang="en">
<head>
  <title>Construction management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" >
        <img src="../images/aaa.png" alt="New Logo">
      </a>
    </div>
  
    <ul class="nav navbar-nav">
      <li class="active"><a href="owner-index.php">Home</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="contactus.php
      ">Contact Us</a></li>    </ul>
    
    <ul class="nav navbar-nav navbar-right">
      <?php if(isset($_SESSION["email"]) && !empty($_SESSION['email'])) { ?>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="glyphicon glyphicon-user"></span> My Profile
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="owner-index.php">Profile</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </li>
      <?php } else { ?>
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="glyphicon glyphicon-log-in"></span> Login
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="tenant-login.php">Login user</a></li>
            <li><a href="owner-login.php">Login Owner</a></li>
          </ul>
        </li>
      <?php } ?>
    </ul>
  </div>
</nav>

</body>
</html>
 <style>
    .navbar-right .login-dropdown .dropdown-menu {
      right: 0;
      left: auto;
      min-width: 200px;
      border-radius: 4px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-right .login-dropdown .dropdown-menu > li > a {
      color: #333;
      padding: 10px 20px;
    }

    .navbar-right .login-dropdown .dropdown-menu > li > a:hover,
    .navbar-right .login-dropdown .dropdown-menu > li > a:focus {
      background-color: #f5f5f5;
    }

    .navbar-right .login-tenant a,
    .navbar-right .login-owner a {
      display: block;
      padding: 10px 20px;
      color: #333;
      text-decoration: none;
    }

  
    .navbar-right .login-owner a:hover {
      background-color: #f5f5f5;
    }
</style>