<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">

        <h1>
            Add Admin
        </h1>
        <br>
        <?php
        if (isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">
            <table class="tlb-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Nhap ten cua ban">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Nhap ten dang nhap">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Nhap mat khau">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>




<?php include('partials/footer.php') ?>

<?php
//xu li value nhap tu form va luu vao Database

if (isset($_POST["submit"])) {
    $fullname = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // ma hoa pass
    $sql = "INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) 
    VALUES (NULL, '$fullname', '$username', '$password');";

    $res = mysqli_query($conn, $sql);
    if ($res === true){
        //tao session
        $_SESSION['add'] ="<div class= 'success'>Admin Added successfully.</div>";

        //chuyen huong page
        header("location: manage-admin.php");
    }else{
        //tao session
        $_SESSION['add'] ="<div class='error'>failed to add admin.</div>";

        //chuyen huong page
        header("location: manage-admin.php");
    }

    $conn->close();
}

?>