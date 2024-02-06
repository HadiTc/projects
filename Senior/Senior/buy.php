<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("location:index.php");
    exit; 
}
include('connection/connection.php');

include('navbar.php');

$estimatedPrice = 0; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["estimated_price"])) {
        $estimatedPrice = $_POST["estimated_price"];
        $property_id = $_POST["property_id"];
        
        echo "Estimated Price: $" . $estimatedPrice . "<br>";
        echo "Property ID: " . $property_id . "<br>";
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
                            Property deleted successfully.
                        </div>
                    </div>';
                    header('location:index.php');
                    exit;
                } else {
                    echo '
                    <div class="container">
                        <div class="alert">
                            <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                            Failed to delete property.
                        </div>
                    </div>';
               
                }
            }
        }
    } else {
        echo "Estimated price not received.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Style Tile and House Color</title>
</head>
<body>
<h1>Choose Style Tile and House Color</h1>
    <h2>Select Style Tile</h2>
    <select id="tileColorSelect" class="js-example-basic-single" name="tile_color">
        <option data-image="images/default.jpg" value="">--Select--</option>
        <option value="5000" data-price="5" data-image="images/tile1.jpeg">Tile 1</option>
        <option value="6000" data-price="6" data-image="images/tile2.jpeg">Tile 2</option>
        <option value="7000" data-price="7" data-image="images/tile3.jpeg">Tile 3</option>
        <option value="8000" data-price="8" data-image="images/tile4.jpeg">Tile 4</option>
        <option value="10000" data-price="10" data-image="images/tile5.jpeg">Tile 5</option>
    </select>
    <h2>Choose paint Color</h2>
    <select id="houseColorSelect" class="js-example-basic-single" name="house_color">
        <option data-image="images/default.jpg" value="">--Select--</option>
        <option value="10000" data-price="10" data-image="images/black.png">Black</option>
        <option value="12000" data-price="12" data-image="images/white.webp">White</option>
        <option value="15000" data-price="15" data-image="images/yellow.jpeg">Yellow</option>
        <option value="20000" data-price="18" data-image="images/green.jpeg">Green</option>
        <option value="25000" data-price="20" data-image="images/purple.jpeg">Purple</option>
    </select>
    <div id="selectedOptions"></div>
    <form id="deleteForm" action="buy.php" method="POST">
        <input type="hidden" id="selectedTile" name="style_tile" value="">
        <input type="hidden" id="selectedHouseColor" name="house_color" value="">
        <input type="hidden" id="calculatedPrice" name="estimated_price" value="">
        <button type="button" id="calculatePriceButton">Calculate Price</button>
        <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">

        <input type="submit" class="btn btn-danger" name="delete_property" value="buy">
    </form>
    <div id="totalPrice"></div>
</body>
</html>

 <script>
    function updateSelectedOptions() {
        const tileSelect = document.getElementById('tileColorSelect');
        const houseSelect = document.getElementById('houseColorSelect');
        const selectedTile = tileSelect.options[tileSelect.selectedIndex];
        const selectedHouseColor = houseSelect.options[houseSelect.selectedIndex];
        
        const selectedTileValue = selectedTile ? selectedTile.value : 0; 
        const selectedHouseColorValue = selectedHouseColor ? selectedHouseColor.value : 0; 

        document.getElementById('selectedTile').value = selectedTileValue;
        document.getElementById('selectedHouseColor').value = selectedHouseColorValue;
        
        const selectedOptionsDiv = document.getElementById('selectedOptions');
        selectedOptionsDiv.innerHTML = '';
        
        if (selectedTile) {
            const tileImage = document.createElement('img');
            tileImage.src = selectedTile.getAttribute('data-image');
            selectedOptionsDiv.appendChild(tileImage);
        }

        if (selectedHouseColor) {
            const houseColorImage = document.createElement('img');
            houseColorImage.src = selectedHouseColor.getAttribute('data-image');
            selectedOptionsDiv.appendChild(houseColorImage);
        }
    }
    document.getElementById('calculatePriceButton').addEventListener('click', function() {
        const selectedTilePrice = parseInt(document.getElementById('tileColorSelect').value) || 0; 
        const selectedHouseColorPrice = parseInt(document.getElementById('houseColorSelect').value) || 0; 
        
        const estimatedPrice = parseInt('<?php echo $estimatedPrice; ?>');
        const totalPrice = estimatedPrice + selectedTilePrice + selectedHouseColorPrice;
        
        document.getElementById('calculatedPrice').value = totalPrice;
        document.getElementById('totalPrice').innerText = `Total Price: $${totalPrice}`;
    });
    document.getElementById('tileColorSelect').addEventListener('change', updateSelectedOptions);
    document.getElementById('houseColorSelect').addEventListener('change', updateSelectedOptions);

    updateSelectedOptions();
</script>


<style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h1, h2 {
            margin-bottom: 20px;
        }
        #selectedOptions {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        #selectedOptions img {
            max-width: 200px;
            max-height: 200px;
            margin: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        #totalPrice {
            font-weight: bold;
        }
</style>
