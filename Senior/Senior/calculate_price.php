<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["estimated_price"])) {
        $estimatedPrice = $_POST["estimated_price"];
        
        $styleTile = $_POST["style_tile"] ?? "";
        $houseColor = $_POST["house_color"] ?? "";
        
        $finalPrice = calculateFinalPrice($estimatedPrice, $styleTile, $houseColor);
        
        echo "Estimated Price: $" . $estimatedPrice . "<br>";
        echo "Selected Style Tile: " . $styleTile . "<br>";
        echo "Selected House Color: " . $houseColor . "<br>";
        echo "Final Price: $" . $finalPrice;
        
    } else {
        echo "Error: Estimated price not received.";
    }
}

function calculateFinalPrice($estimatedPrice, $styleTile, $houseColor) {
   
    $additionalCost = 50; 
    $finalPrice = $estimatedPrice + $additionalCost;
    return $finalPrice;
}
?>
