<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <?php
        if (isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <div class="top-c">
            <div class="col-4 text-center">
                <h1>5</h1>
                Category
            </div>
            <div class="col-4 text-center">
                <h1>5</h1>
                Category
            </div>
            <div class="col-4 text-center">
                <h1>5</h1>
                Category
            </div>
            <div class="col-4 text-center">
                <h1>5</h1>
                Category
            </div>
        </div>
        <div class="clear-fix"></div>
    </div>
</div>


<?php include('partials/footer.php') ?>