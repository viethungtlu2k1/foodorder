<?php
include("bridge/menu.php")
?>
<!--order start-->
<div class="order">
    <div class="container">
        <h2 class="text-ac">
            Fill this form to confirm your order.
        </h2>
        <form action="" class="form-order">
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
                    <div class="food-order-infor">
                        <div class="food-order-img">
                            <img src="images/food/<?= $image_name ?>" alt="">
                        </div>
                        <div class="food-order-desc">
                            <h3><?= $title ?></h3>
                            <p class="food-price">$<?= $price ?></p>
                            <div class="quanlity">Quantity</div>
                            <input type="number" name="qty" value="1" required>
                        </div>
                    </div>
                <?php
                }
                ?>
            </fieldset>
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="customer_name" placeholder="E.g Nguyen Viet Hung" class="input-order">
                <div class="order-label">Phone Number</div>
                <input type="text" name="customer_contact" placeholder="E.g 0388xxxxxx" class="input-order">
                <div class="order-label">Email</div>
                <input type="email" name="customer_email" placeholder="E.g viethung@gmail.com" class="input-order">
                <div class="order-label">Address</div>
                <textarea name="customer_address" rows="10" type="text" placeholder="E.g Dong Da Ha Noi" class="input-order"></textarea>
                <input type="submit" name="submit" value="Confirm Order" class="btn btn_submit">
            </fieldset>
        </form>
    </div>
</div>
<!--order end-->
<?php
//$time = getdate();
//print_r(getdate());
if (isset($_POST['submit'])) {
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
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        echo '<script>';
        echo 'alert("successfully")';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("error")';
        echo '</script>';
    }
}
include("bridge/footer.php")
?>