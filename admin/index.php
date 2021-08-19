<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <?php
        if (isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        $sql = "SELECT COUNT(*) FROM tbl_category";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($res);
        $category_count = $row[0];


        $sql = "SELECT COUNT(*) FROM tbl_admin";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($res);
        $admin_count = $row[0];


        $sql = "SELECT COUNT(*) FROM tbl_food";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($res);
        $food_count = $row[0];


        $sql = "SELECT COUNT(*) FROM tb_order";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($res);
        $order_count = $row[0];
        ?>
        <div class="top-c">
            <div class="col-4 text-center">
                <h1><?=$admin_count?></h1>
                Admin
            </div>
            <div class="col-4 text-center">
                <h1><?=$category_count?></h1>
                Category
            </div>
            <div class="col-4 text-center">
                <h1><?=$food_count?></h1>
                Food
            </div>
            <div class="col-4 text-center">
                <h1><?=$order_count?></h1>
                Order
            </div>
        </div>
        <div class="clear-fix"></div>
    </div>
</div>


<?php include('partials/footer.php') ?>