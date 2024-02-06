<?php


if (isset($_POST['delete_property'])) {
 
  if (isset($_POST['property_id']) && !empty($_POST['property_id'])) {
      $property_id = $_POST['property_id'];

      
      $sql_delete_photos = "DELETE FROM property_photo WHERE property_id = '$property_id'";
      $query_delete_photos = mysqli_query($db, $sql_delete_photos);

    
      $sql_delete_property = "DELETE FROM add_property WHERE property_id = '$property_id'";
      $query_delete_property = mysqli_query($db, $sql_delete_property);

      if ($query_delete_photos && $query_delete_property) {
          
          echo '
          <div class="container">

          <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
            Property  deleted successfully.
          </div>
          </div>';
         
      } else {
          echo '
          <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
            Failed to delete property.
          </div>';
      }
  }
}
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
    var alerts = document.getElementsByClassName('alert');
    for (var i = 0; i < alerts.length; i++) {
      alerts[i].style.display = 'none';
    }
  }, 2000);
</script>