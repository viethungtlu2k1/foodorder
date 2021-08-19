<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <?php
            if (isset($_SESSION['up-img'])){
                echo $_SESSION['up-img'];
                unset($_SESSION['up-img']);
            }
            
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tlb-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Food Title">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description"  cols="30" rows="10" placeholder="Food Description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Price:
                    </td>
                    <td>
                        <input type="number" step="0.01" name="price" placeholder="Food Price">
                    </td>
                </tr>
                <tr>
                    <td>
                        Select Image:
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
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php
    if (isset($_POST['submit'])){
        $title = $_POST['title'];
        $desciption = $_POST['description'];
        $category_id = $_POST['category_id'];
        $price = $_POST['price'];
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
        if (isset($_FILES['image_name']['name'])){
            $image_name = $_FILES['image_name']['name'];

            $source_path = $_FILES['image_name']['tmp_name'];
            $save_path = "../images/food/".$image_name;

            $upload = move_uploaded_file($source_path, $save_path);
            if ($upload == false){
                $_SESSION['up-img'] = "<div class='error'> Failed to Upload Image</div>";
                header("location: add-food.php");
            }
        }else{
            $_SESSION['up-img'] = "<div class='error'> Failed to Upload Image</div>";
            header("location: add-food.php");
        }
        
        $sql = "INSERT INTO `tbl_food`(`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) 
        VALUES (NULL,'$title','$desciption','$price','$image_name','$category_id','$featured','$active')";

        $res = mysqli_query($conn, $sql);

        if ($res == true){
            $_SESSION['add'] = "<div class='success'> Food Added Successfully</div>";
            header("location: manage-food.php");
        }else{
            $_SESSION['add'] = "<div class='success'> Failed to Add Food</div>";
            header("location: manage-food.php");
        }
    }
?>

<?php include('partials/footer.php'); ?>