<?php
include("bridge/menu.php")
?>

<!--categories start-->
<div class="categories">
    <div class="container">
        <h1>Explore Foods</h1>
        <div class="category-listItem">
            <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $title = $row['title'];
                    $image_name = $row['image_name'];
            ?>
                    <a href="#" class="category-item">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image not Available</div>";
                        }
                        ?>
                        <img src="images/category/<?= $image_name ?>" alt="<?= $title ?>">
                        <span><?= $title ?></span>
                    </a>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!--categories end-->
<?php
include("bridge/footer.php")
?>