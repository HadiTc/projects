<?php
include("navbar.php");

include('connection/connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

 
    $stmt = $db->prepare("SELECT * FROM tenant WHERE email=? AND password=? LIMIT 1");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        $logged_user = $data['email'];
        session_start();
        $_SESSION['email'] = $email;
        header('location:index.php');
        exit;
    } else {
     
        $sql = "SELECT * FROM owner WHERE email='$email' AND password='$password' LIMIT 1";
        $result = $db->query($sql);

        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            $logged_user = $data['email'];
            session_start();
            $_SESSION['email'] = $email;
            header('location:owner/owner-index.php'); 
            exit;
        } else {
           
            echo "<p>Login failed. Please check your Username Or password!.</p>";
        }
    }
}
?>


<div class="container">
  <div class="card">
    <h3> Login</h3>
    <form method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
      </div>
      <div class="form-group">
        <a href="">Lost your Password ? </a> 
      </div>
      <center><input type="submit" id="submit" name="tenant_login" class="btn btn-primary btn-block" value="Login"></center>
    </form>
  </div>
</div>
<style>
    .container{
        margin-top: 100px;
        
    }
    body {
      background-repeat: no-repeat;
      background-size: cover;
      font-family: Arial, sans-serif;
      background-color: #F0F0F0;
      margin: 0;
      display: block;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .card {
      background-color: #fff;
      width: 400px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 20px;
      text-align: left;
    }

    .card h3 {
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      color: #333;
    }

    .form-group input {
      width: calc(200% - 20px); 
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      box-sizing: border-box;
    }

    .btn {
      display: block;
      width: calc(100% - 20px); 
      padding: 10px;
      background-color: #1e90ff;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      text-align: center;
    }

    .btn:hover {
      background-color: #0000ff;
    }
</style>