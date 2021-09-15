<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $link = "localhost/foododer";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "food-order";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);
    
    // Check connection
    
?>