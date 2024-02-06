<?php 
  session_start();
  isset($_SESSION["email"]);
    ?>
<!DOCTYPE html>
<html>
<head>
   
   <style>
     #mapid { height: 180px; }
   </style>
</head>
<body>
 <?php 
include('connection/connection.php');
include('navbar.php');
?>
<?php
	$property_id=$_GET['property_id'];
    $sql="SELECT * from add_property where property_id='$property_id'";
	$query=mysqli_query($db,$sql);

	if(mysqli_num_rows($query)>0)
{
    while($rows=mysqli_fetch_assoc($query)){         
    $sql2="SELECT * FROM property_photo where property_id='$property_id'";
    $query2=mysqli_query($db,$sql2);
    $rowcount=mysqli_num_rows($query2);
?>                
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6">     
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
  <?php
  for($i=1;$i<=$rowcount;$i++)
  {
      $row=mysqli_fetch_array($query2);
      $photo=$row['p_photo']; 
  ?>
  <?php 
  if($i==1)
  {
  ?>
  <div class="item active">
      <img class="d-block img-fluid" src="owner/<?php echo $photo ?>" alt="First slide" width="100%" style="max-height: 600px; min-height: 600px;">
    </div>
  <?php 
  }
  else
{
    ?> 
    <div class="item">
      <img class="d-block img-fluid" src="owner/<?php echo $photo ?>" alt="First slide" width="100%" style="max-height: 600px; min-height: 600px;">
    </div>
 <?php
   }
  }
  ?>
  </div>
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
<div class="col-sm-6">
  <center><h2>watch</h2></center>
  <div class="row">
    <div class="col-sm-6">
      <div class="row">
      <div class="col-sm-6">
          <table>
            <tr>
              <td><h3>Country:</h3></td>
              <td><h4><?php echo $rows['country']; ?></h4></td>
            </tr>
            <tr>
              <td><h3>City:</h3></td>
              <td><h4><?php echo $rows['city']; ?></h4></td>
            </tr>
            <tr>
              <td><h3>Estimated Price:</h3></td>
              <td><h4>$.<?php echo $rows['estimated_price']; ?></h4></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <table>
            <tr>
              <td><h3>Total Rooms:</h3></td>
              <td><h4><?php echo $rows['total_rooms']; ?></h4></td>
            </tr>
            <tr>
              <td><h3>Bedrooms:</h3></td>
              <td><h4><?php echo $rows['bedroom']; ?></h4></td>
            </tr>
            <tr>
              <td><h3>Living Room:</h3></td>
              <td><h4><?php echo $rows['living_room']; ?></h4></td>
            </tr>
            <tr>
              <td><h3>Kitchen:</h3></td>
              <td><h4><?php echo $rows['kitchen']; ?></h4></td>
            </tr>
            <tr>
              <td><h3>Bathroom:</h3></td>
              <td><h4><?php echo $rows['bathroom']; ?></h4></td>
            </tr>      
          </table>
    </div>
  </div>
</div>
</div>
<br>
<?php
if (isset($_SESSION["email"]) && !empty($_SESSION['email'])) {
?>
    <form method="POST" action="buy.php">
        <div class="row">
            <div class="col-sm-6">
                <?php
                if (isset($_SESSION["email"]) && !empty($_SESSION["email"])) { ?>
                    <input type="hidden" name="property_id" value="<?php echo $rows['property_id']; ?>">
                    <input type="hidden" name="estimated_price" value="<?php echo $rows['estimated_price']; ?>">
                    <input type="submit" name="buy_now" value="Buy It Now">

                <?php } ?>
            </div>
        </div>
    </form>
    

<?php } else {
    echo "<center><h3>You should login to book the property.</h3></center>";
}
?>
<?php }} ?>
</div>
      <?php 
 ?>
<br><br>
</body>
</html>

<style>
  h3 {
    font-size: 20px;}
  
  h4  {
    font-size: 20px;
  }
  table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  }
  td, th {
  text-align: left;
  padding: 1px;
  }

   .animated {
    -webkit-transition: height 0.2s;
    -moz-transition: height 0.2s;
      transition: height 0.2s;
    }
  .stars
  {
    margin: 20px 0;
    font-size: 24px;
    color: #d17581;
  }
  
  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
  }

  .modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }

  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
 }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

  </style>