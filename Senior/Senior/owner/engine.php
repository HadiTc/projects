<?php 
$property_id='';
$country='';
$city='';
$estimated_price='';
$total_rooms='';
$bedroom='';
$living_room='';
$kitchen='';
$bathroom='';
$owner_id='';




include('../connection/connection.php');

if($db->connect_error){
	echo "Error connecting database";
}

if(isset($_POST['add_property'])){
	add_property();
}

if(isset($_POST['owner_update'])){
	owner_update();
}
if(isset($_POST['update_property'])){
	update_property();
}

function update_property(){
    global $db;

	$property_id=validate($_POST['property_id']);
	$country=validate($_POST['country']);
	$city=validate($_POST['city']);
	$estimated_price=validate($_POST['estimated_price']);
	$total_rooms=validate($_POST['total_rooms']);
	$bedroom=validate($_POST['bedroom']);
	$living_room=validate($_POST['living_room']);
	$kitchen=validate($_POST['kitchen']);
	$bathroom=validate($_POST['bathroom']);

    $sql = "UPDATE add_property SET 
	country='$country', 
	city='$city', 
	estimated_price='$estimated_price', 
	total_rooms='$total_rooms', 
	bedroom='$bedroom', 
	living_room='$living_room', 
	kitchen='$kitchen', 
	bathroom='$bathroom' 
	WHERE property_id='$property_id'";

    $stmt = mysqli_prepare($db, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($property_id, $country, $city, $estimated_price, $total_rooms, $bedroom, $living_room, $kitchen, $bathroom);


    } 
}

function add_property(){
	global $property_id,$country,$city,$estimated_price,$total_rooms,$bedroom,$living_room,$kitchen,$bathroom,$path,$p_photo,$property_photo_id,$owner_id,$db;
	
	$country=validate($_POST['country']);
	$city=validate($_POST['city']);
	$estimated_price=validate($_POST['estimated_price']);
	$total_rooms=validate($_POST['total_rooms']);
	$bedroom=validate($_POST['bedroom']);
	$living_room=validate($_POST['living_room']);
	$kitchen=validate($_POST['kitchen']);
	$bathroom=validate($_POST['bathroom']);
   	$u_email=$_SESSION['email'];
        $sql1="SELECT * from owner where email='$u_email'";
        $result1=mysqli_query($db,$sql1);

        if(mysqli_num_rows($result1)>0)
      {
          while($rowss=mysqli_fetch_assoc($result1)){
            $owner_id=$rowss['owner_id'];

   	$sql = "INSERT INTO add_property(country,city,estimated_price,total_rooms,bedroom,living_room,kitchen,bathroom,owner_id) VALUES('$country','$city'	,'$estimated_price','$total_rooms','$bedroom','$living_room','$kitchen','$bathroom','$owner_id')";
		$query=mysqli_query($db,$sql);

		$property_id = mysqli_insert_id($db);

		$countfiles = count($_FILES['p_photo']['name']);
	
	for($i=0;$i<$countfiles;$i++){
	$paths = $_FILES['p_photo']['tmp_name'][$i];
		  if($paths!="")
			{
		    	$path="product-photo/" . $_FILES['p_photo']['name'][$i];
				if(move_uploaded_file($paths, $path)) {
		        $sql2 = "INSERT INTO property_photo(p_photo,property_id) VALUES('$path','$property_id')";
				$query=mysqli_query($db,$sql2);

			}}
 
 }
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
  <center><strong>Your Product has been uploaded.</strong></center>
</div></div>


<?php
		}
		else{
			echo "error";
		}

}
}}

function owner_update(){
	global $owner_id,$full_name,$email,$password,$errors,$db;
	$owner_id=validate($_POST['owner_id']);
	$full_name=validate($_POST['full_name']);
	$email=validate($_POST['email']);
	$password = md5($password); 
		$sql = "UPDATE owner SET full_name='$full_name',email='$email' WHERE owner_id='$owner_id'";
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