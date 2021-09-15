<?php
    include('../config/constants.php');
    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_food WHERE id = $id";

    $res = mysqli_query($conn,$sql);

    if ($res === true){
        $_SESSION['delete'] ="<div class= 'success'>Food Deleted Successfully.</div>";

        //chuyen huong page
        header("location: manage-food.php");
    }else{
        $_SESSION['delete'] ="<div class='error'>Failed to Delete Food. Try Again Later.</div>";

        //chuyen huong page
        header("location: manage-food.php");
    }
?>