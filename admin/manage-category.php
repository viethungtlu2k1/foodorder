<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <?php
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        
        ?>
        <br>
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br><br>
        <table class="tbl-full cs">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            // select data
            $sql = "SELECT * FROM tbl_category";
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
                        <td><?= $title?></td>
                        <td class="img-ctr">
                            <?php
                                if($image_name !=""){
                                    ?>
                                    <img src="../images/category/<?= $image_name?>" alt="" width="50px">
                                    <?php
                                }else{
                                    echo "<div class='error'>Image not Added.</div>";
                                }
                            ?>
                        </td>
                        <td><?= $featured?></td>
                        <td><?= $active?></td>
                        <td>
                            <a href="update-category.php?id=<?=$id?>" class="btn-secondary">Update Category</a>
                            <a href="delete-category.php?id=<?=$id?>" class="btn-danger">Delete Category</a>
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