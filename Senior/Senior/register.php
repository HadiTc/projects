<?php
include("navbar.php");

$registrationSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include('connection/connection.php'); 

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

   
    if ($role === 'tenant') {
        $sql = "INSERT INTO tenant (full_name, email, password) VALUES ('$full_name', '$email', '$password' )";
    } else if ($role === 'owner') {
        $sql = "INSERT INTO owner (full_name, email, password ) VALUES ('$full_name', '$email', '$password')";
    }

   
    if (mysqli_query($db, $sql)) {
        $registrationSuccess = true;
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }

    mysqli_close($db); 
}
?>

<html>
<head>
  <title>Registration Page</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
   body {
    background-image: url('images/bgr.png'); 
      background-repeat: no-repeat;
    background-size: cover;
  font-family: Arial, sans-serif;
}

h2 {
  text-align: center;
}

.card {
  background-color: #F5F5F5;

  width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 20px;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="tel"],
input[type="file"]
 {
  width: calc(200% - 20px);
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type="radio"] {
  margin-right: 5px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  width: 200%;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}


.file-input {
  display: none;
}




.file-label span {
  display: block;
}




  </style>
</head>
<body>
  <h2>Registration Form</h2>
  <div class="card">
  <form action="" method="POST" enctype="multipart/form-data">
            <label for="fullname">Full Name:</label>
            <input type="text" class="form-control" id="full_name" placeholder="Enter Full Name" name="full_name" required>

            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password1" placeholder="Enter Password" name="password" required>


            <label for="role">Role:</label>
<input type="radio" name="role" value="tenant" required checked> Tenant
<input type="radio" name="role" value="owner" required> Owner<br><br>

            <input type="submit" value="Register">
        </form>
  </div>
</body>
<script>
      
        <?php if ($registrationSuccess): ?>
        window.onload = function () {
            Swal.fire({
                icon: 'success',
                title: 'Registration successful!',
                showConfirmButton: false,
                timer: 2000 
            });
        }
        <?php endif; ?>
    </script>
