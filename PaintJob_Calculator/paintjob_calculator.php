<?php

/* 
 * Author: Nicole Amporn Binette
 * Date: January 26 2019
 */
 $hourly_rate = 20.00; // Hourly rate for workers is $20
 $price_per_gallon = filter_input(INPUT_POST, 'price_per_gallon');
 $wall_area = filter_input(INPUT_POST, 'wall_area');
 $required_gallons = 0;
 $required_hours = 0;
 $labor_charges = 0;
 $total_cost = 0;
 
 if (is_numeric($price_per_gallon) && is_numeric($wall_area) && $price_per_gallon > 0 && $wall_area > 0) {
     $base_hours = 8;
     $base_gallons = 1;
     $base_sqrfeet = 115;
     $paint_price = 0;
     if ($wall_area * $base_hours % $base_sqrfeet > 0) {
         $required_hours = $wall_area * $base_hours / $base_sqrfeet;
         $required_hours++;
         $required_hours_f = number_format($required_hours, 2);
         $labor_charges = $required_hours * $hourly_rate;
         $labor_charges_f = "$".number_format($labor_charges, 2);
     } else {
         $required_hours = $wall_area * $base_hours / $base_sqrfeet;
         $required_hours_f = number_format($required_hours, 2);
         $labor_charges = $required_hours * $hourly_rate;
         $labor_charges_f = "$".number_format($labor_charges, 2);
     }
     if ($wall_area * $base_gallons % $base_sqrfeet > 0) {
         $required_gallons = $wall_area / $base_sqrfeet;
         $required_gallons++;
         $required_gallons_f = number_format($required_gallons, 2);
         $paint_price = $required_gallons * $price_per_gallon;
         $paint_price_f = "$".number_format($paint_price, 2);
     } else {
         $required_gallons = $wall_area / $base_sqrfeet;
         $required_gallons_f = number_format($required_gallons, 2);
         $paint_price = $required_gallons * $price_per_gallon;
         $paint_price_f = "$".number_format($paint_price, 2);
     }
     $total_cost = $labor_charges + $paint_price;
     $total_cost_f = "$".number_format($total_cost, 2);
 }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Paint Job Calculator</title>
        <link href = "main.css" type = "text/css" rel = "stylesheet"/>
    </head>
    <body>
        <main>
            <h1> Paint Job Calculator </h1>
            <p> For every 115 square feet of wall space, one gallon of paint and eight hours of labor are required. </p>
            <div id = "data">
                <label> Number of Gallons Required </label>
                <span><?php echo $required_gallons_f; ?></span></br>
                <label> Hours of Labor Required </label>
                <span><?php echo $required_hours_f; ?></span></br>
                <label> Paint Cost </label>
                <span><?php echo htmlspecialchars($paint_price_f); ?></span></br>
                <label> Labor Charges </label>
                <span><?php echo htmlspecialchars($labor_charges_f); ?></span></br>
                <label> Total Cost of Paint Job </label>
                <span><?php echo htmlspecialchars($total_cost_f); ?></span></br>
            </div>
            <a href="index.html"> Return to Form </a>
        </main>
    </body>
</html>