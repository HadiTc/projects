<?php 

$tenant_id='';
$full_name='';
$email='';
$password='';


$errors=array();

include('connection/connection.php');

if($db->connect_error){
	echo "Error connecting database";
}




if(isset($_POST['tenant_login'])){
	tenant_login();
}

if(isset($_POST['tenant_update'])){
	tenant_update();
}

function tenant_login(){
    

    


?>
<style>
.alert {
  padding: 20px;
  background-color: #DC143C;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}
.closebtn:hover {
  color: black;
}
</style>
<div class="container">
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Incorrect Email/Password or not registered.</strong> Click here to <a href="tenant-register.php" style="color: lightblue;"><b>Register</b></a>.
</div></div>
<?php
		}

function tenant_update(){
	global $owner_id,$full_name,$email,$password,$errors,$db;
	$tenant_id=validate($_POST['tenant_id']);
	$full_name=validate($_POST['full_name']);
	$email=validate($_POST['email']);
	$password = md5($password); 
		$sql = "UPDATE tenant SET full_name='$full_name',email='$email' WHERE tenant_id='$tenant_id'";
		$query=mysqli_query($db,$sql);
		if(!empty($query)){
			?>
<style>
.alert {
  padding: 20px;
  background-color: #DC143C;
  color: white;
}
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}
.closebtn:hover {
  color: black;
}
</style>
<script>
	window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>
<div class="container">
<div class="alert" role='alert'>
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <center><strong>Your Information has been updated.</strong></center>
</div></div>
<?php
	}
}


function validate($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
 ?>