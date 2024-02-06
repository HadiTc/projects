<?php 

$db = new mysqli('localhost','root','','project');

if($db->connect_error){
	echo "Error connecting database";
}

 ?>


