<?php
include("bridge/menu.php")
?>
<!--search start-->
<div class="search">
    <div class="container text-ac">
        <form action="" class="form_search">
            <input type="search" placeholder="Search for Food..." class="inp-search">
            <input type="submit" value="Search" class="btn btn_submit">
        </form>
    </div>
</div>
<!--search end-->
<!--categories start-->
<div class="categories">
    <div class="container">
        <h1>Explore Foods</h1>
        <div class="category-listItem">
            <?php
            $sql = "SELECT * FROM tbl_category LIMIT 3";
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
<!--foods start-->
<div class="foods">
    <div class="container">
        <h1>Food Menu</h1>
        <div class="food_listItem">
            <?php
            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $price = $row['price'];
                    $description = $row['description'];
            ?>
                    <div class="food_item">
                        <img src="images/food/<?= $image_name ?>" alt="">
                        <div class="food_item_infor">
                            <h4 class="title">
                                <?= $title ?>
                            </h4>
                            <p class="food-price">
                                $<?= $price ?>
                            </p>
                            <p class="food-detail"><?= $description ?></p>
                            <br>
                            <a href="order.php?id=<?= $id ?>" class="btn btn_submit">Order Now</a>
                        </div>
                    </div>
            <?php

                }
            }

            ?>
        </div>
    </div>
    <p class="see-all">See All Foods</p>
</div>
<!--foods end-->
<?php
include("bridge/footer.php")
?>