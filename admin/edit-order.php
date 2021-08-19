<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM tb_order WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $id =$row['id'];
            $food = $row['food'];
            $price = $row['price'];
            $qty = $row['qty'];
            $order_date = $row['order_date'];
            $status = $row['status'];
            $customer_name = $row['customer_name'];
            $customer_contact = $row['customer_contact'];
            $customer_email = $row['customer_email'];
            $customer_address = $row['customer_address'];
        ?>
            <form action="" method="POST">
                <table width=100%>
                    <tr>
                        <th colspan="2">Thông tin đơn hàng</th>
                        <th colspan="2"></th>
                    </tr>
                    <tr>
                        <td>Tên món ăn</td>
                        <td><?= $food ?></td>
                        <td>Đơn giá</td>
                        <td>$<?= $price ?></td>
                    </tr>
                    <tr>
                        <td>Ngày đặt hàng: </td>
                        <td><?= $order_date ?></td>
                        <td>Số lượng: </td>
                        <td><?= $qty ?></td>
                    </tr>
                    <tr>
                        <td>Tên khách hàng: </td>
                        <td><?= $customer_name ?></td>
                        <td>Tổng Tiền: </td>
                        <td><?= (int)$qty * $price; ?></td>
                    </tr>
                    <tr>
                        <td>Số điện thoại: </td>
                        <td><?= $customer_contact ?></td>
                        <td>Trạng Thái</td>
                        <td>
                            <select name="status">
                                <option value="Chưa xử lí" <?= $status == "Chưa xử lí" ? 'selected' : '' ?>>Chưa xử lí</option>
                                <option value="Đang xử lí" <?= $status == "Đang xử lí" ? 'selected' : '' ?>>Đang xử lí</option>
                                <option value="Đã giao" <?= $status == "Đã giao" ? 'selected' : '' ?>>Đã giao</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><?= $customer_email ?></td>
                        <td><input type="hidden" name="id" value="<?php echo $id?>"></td>
                        <td><input type="submit" name="submit" value="Update Order"></td>
                        
                    </td>
                    </tr>
                    <tr>
                        <td>Địa chỉ nhận hàng: </td>
                        <td><?= $customer_address ?></td>
                    </tr>


                </table>



            </form>
        <?php

        }



        ?>

    </div>
</div>

<?php 
    if (isset($_POST['submit'])){
        $status = $_POST['status'];
        $id = $_POST['id'];
        $sql = "UPDATE `tb_order` SET `status` = '$status' WHERE `tb_order`.`id` = $id";
        

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['update-order'] = "<div class='success'>Đơn hàng đã được chỉnh sửa</div>";
            header("location: manage-order.php");
        } else {
            $_SESSION['update-order'] = "<div class='error'>Lỗi khi chỉnh sửa đơn hàng</div>";
            header("location: manage-order.php");
    }


    }
include('partials/footer.php');
?>