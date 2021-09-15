<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Add Category</h1>
    <!--manage-category.php-->
    <?php
        
        if (isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
            <table class="tlb-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>
                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image_name" >
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">  Yes
                        <input type="radio" name="featured" value="No" >  No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">  Yes
                        <input type="radio" name="active" value="No" >  No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
    if (isset($_POST['submit'])){
        // lay data tu form
        $title = $_POST['title'];
        if (isset($_POST['featured'])){
            if ($_POST['featured'] === 'Yes'){
                $featured = 'Yes';
            }
            else{
                $featured = 'No';
            }
        }
        if (isset($_POST['active'])){
            if ($_POST['active'] === 'Yes'){
                $active = 'Yes';
            }
            else{
                $active = 'No';
            }
        }
        if(isset($_FILES['image_name']['name'])){
            $image_name = $_FILES['image_name']['name'];

            $source_path = $_FILES['image_name']['tmp_name'];
            $save_path = "../images/category/".$image_name;

            $upload = move_uploaded_file($source_path, $save_path);
            if ($upload == false){
                $_SESSION['upload'] = "<div class='error'> Failed to Upload Image</div>";
                header("location: add-category.php");
            }

        }else{
            $image_name = '';
        }

        // add to sql
        $sql = "INSERT INTO `tbl_category`(`id`, `title`, `image_name`, `featured`, `active`) 
        VALUES (NuLL,'$title','$image_name','$featured','$active')";
        
        $res = mysqli_query($conn, $sql);

        if ($res == true){
            $_SESSION['add'] = "<div class='success'> Category Added Successfully</div>";
            header("location: manage-category.php");
        }else{
            $_SESSION['add'] = "<div class='error'> Failed to Add Category</div>";
            header("location: manage-category.php");
        }
    }

?>


 <?php include ('partials/footer.php'); ?>