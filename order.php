<?php
include("bridge/menu.php");


?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="#" class="order" method="POST">
            <fieldset>
                <legend>Selected Food</legend>
                <?php
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_food WHERE id = '$id'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $image_name = $row['image_name'];
                    $title = $row['title'];
                    $price = $row['price'];
                ?>
                    <div class="food-menu-img">
                        <img src="images/<?=$image_name?>" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h3><?=$title?></h3>
                        <p class="food-price">$<?=$price?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>
                <?php
                }


                ?>


            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="customer_name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="customer_contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="customer_email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="customer_address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- social Section Starts Here -->
<section class="social">
    <div class="container text-center">
        <ul>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png" /></a>
            </li>
        </ul>
    </div>
</section>
<!-- social Section Ends Here -->

<?php
    //$time = getdate();
    //print_r(getdate());
    if (isset($_POST['submit'])){
        $food = $title;
        $qty = $_POST['qty'];
        $order_date = date('Y-m-d H:i:s');
        $status = "Chưa xử lí";
        $customer_name = $_POST['customer_name'];
        $customer_contact = $_POST['customer_contact'];
        $customer_email = $_POST['customer_email'];
        $customer_address = $_POST['customer_address'];
        

        $sql = "INSERT INTO `tb_order`
        (`id`, `food`, `price`, `qty`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) 
        VALUES (NULL,'$food','$price','$qty','$order_date','$status','$customer_name','$customer_contact','$customer_email','$customer_address')";
        $res = mysqli_query($conn,$sql);

        if ($res == true){
            
            echo '<script>';
            echo 'alert("successfully")';
            echo '</script>';
        }else{
            echo '<script>';
            echo 'alert("loi")';
            echo '</script>';
        }
    }
    
include("bridge/footer.php");

?>
