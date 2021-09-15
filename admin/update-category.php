
 <?php include ('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>


        <?php // lay data hien thi truoc khi chinh sua
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_category WHERE id = '$id'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                }else{
                    $_SESSION['no-category-found'] = "<div class=error>Category Not Found</div>";
            
                    header("location: manage-category.php");
                }
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tlb-30 ">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?= $title ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Current Image: 
                    </td>
                    <td>
                        <img src="../images/category/<?= $current_image?>" alt="" width="50px">
                    </td>
                </tr>
                <tr>
                    <td>
                        New Image: 
                    </td>
                    <td>
                    <input type="file" name="image_name">
                    </td>
                </tr>
                <tr>
                    <td>
                        Featured: 
                    </td>
                    <td>
                    <input type="radio" name="featured" value="Yes" <?php echo $featured =="Yes"? "Checked" :''?>  >  Yes
                        <input type="radio" name="featured" value="No" <?php echo $featured =="No"? "Checked" :''?> >  No
                    </td>
                </tr>
                <tr>
                    <td>
                        Active: 
                    </td>
                    <td>
                    <input type="radio" name="active" value="Yes" <?php echo $active =="Yes"? "Checked" :''?>>  Yes
                        <input type="radio" name="active" value="No" <?php echo $active =="No"? "Checked" :''?>>  No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?=$id ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn_secondary">
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
        $id = $_POST['id'];
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
        $sql = "UPDATE `tbl_category` 
        SET `title`='$title',`image_name`='$image_name',`featured`='$featured',`active`='$active' 
        WHERE id = '$id'";
        
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

