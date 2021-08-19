<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no-food-found'])) {
            echo $_SESSION['no-food-found'];
            unset($_SESSION['no-food-found']);
        }
        
        ?>
        <br>
        <a href="add-food.php" class="btn-primary">Add Food</a>
        <br />
        <table class="tbl-full cs">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn, $sql);
            $sn = 1;
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?=$sn++?> </td>
                        <td class="img-ctr"><?=$title?></td>
                        <td>
                            <img src="../images/food/<?=$image_name?>" alt="" width="70px">
                        </td>
                        <td><?=$featured?></td>
                        <td><?=$active?></td>
                        <td>
                            <a href="update-food.php?id=<?=$id?>" class="btn-secondary">Update Food</a>
                            <a href="delete-food.php?id=<?=$id?>" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>
            <?php
                }
            }
            
            ?>




        </table>

    </div>
</div>


<?php include('partials/footer.php') ?>