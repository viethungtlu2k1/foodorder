
 <?php ob_start(); include ('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br>


        <?php // lay data hien thi truoc khi chinh sua

            if(isset($_GET['id'])){
                $id_food = $_GET['id'];
                $sql = "SELECT * FROM tbl_food WHERE tbl_food.id = '$id_food'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $price = $row['price'];
                    $description = $row['description'];
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    $category_id = $row['category_id'];

                }else{
                    $_SESSION['no-food-found'] = "<div class=error>Food Not Found</div>";
            
                    header("location: manage-food.php");
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
                    <td>Description: </td>
                    <td>
                        <input type="text" name="description" value="<?= $description ?>">
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="text" name="price" value="<?= $price ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Current Image: 
                    </td>
                    <td>
                        <img src="../images/food/<?= $current_image?>" alt="" width="50px">
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
                    <td>Category:</td>
                    <td>
                        <select name="category_id" >
                            <?php
                                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'" ;

                                $res = mysqli_query($conn,$sql);
                                $count = mysqli_num_rows($res);

                                if ($count > 0){
                                    while ($row = mysqli_fetch_assoc($res)){
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                            <option value="<?=$id?>"><?=$title?></option>
                                        <?php
                                    
                                    }
                                }else{
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }

                            
                            ?>

                            
                        </select>
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
                        <input type="hidden" name="id" value="<?php echo $id_food?>">
                        <input type="submit" name="submit" value="Update Food" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

    if (isset($_POST['submit'])){
        // lay data tu form
        $id_food = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
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
            $save_path = "../images/food/".$image_name;

            $upload = move_uploaded_file($source_path, $save_path);
            if ($upload == false){
                $_SESSION['upload'] = "<div class='error'> Failed to Upload Image</div>";
                header("location: manage-food.php");
            }
        }else{
            $image_name = '';
        }

        // add to sq
        $sql ="UPDATE `tbl_food` SET 
        `title`='$title',
        `description`='$description',
        `price`='$price',
        `image_name`='$image_name',
        `category_id`='$category_id',
        `featured`='$featured',
        `active`='$active' 
        WHERE id = '$id_food'";

        $res = mysqli_query($conn, $sql);

        if ($res == true){
            $_SESSION['add'] = "<div class='success'> Food Added Successfully</div>";
            header("location: manage-food.php");
        }else{
            $_SESSION['add'] = "<div class='error'> Failed to Add Food</div>";
            header("location: manage-food.php");
        }
    }

?>

 <?php include ('partials/footer.php'); ?>

