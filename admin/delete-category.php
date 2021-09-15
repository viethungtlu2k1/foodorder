<?php
    include('../config/constants.php');
    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_category WHERE id = $id";

    $res = mysqli_query($conn,$sql);

    if ($res === true){
        $_SESSION['delete'] ="<div class= 'success'>Category Deleted Successfully.</div>";

        //chuyen huong page
        header("location: manage-category.php");
    }else{
        $_SESSION['delete'] ="<div class='error'>Failed to Delete Category. Try Again Later.</div>";

        //chuyen huong page
        header("location: manage-category.php");
    }
?>