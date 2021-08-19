<?php
    include("bridge/menu.php")
?>



    <!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        $sql = "SELECT * FROM tbl_category LIMIT 3";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="#">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image not Available</div>";
                        }
                        ?>
                        <img src="images/category/<?= $image_name ?>" alt="<?= $title ?>" class="img-responsive img-curve">

                        <h3 class="float-text text-white"><?= $title ?></h3>
                    </div>
                </a>
        <?php

            }
        }

        ?>

        <div class="clearfix"></div>
    </div>
</section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
<?php
    include("bridge/footer.php")
?>