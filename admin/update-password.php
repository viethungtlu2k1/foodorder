<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>
            Change Password
        </h1>
        <br>
        <form action="" method="POST">
            <table class="tlb-30 cds">
                <tr>
                    <td>Old Password: </td>
                    <td>
                        <input type="password" name="old_password" placeholder="Nhap mat khau CU">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="Nhap mat khau MOI">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Nhap lai mat khau moi">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name = "id" value="<?= $_GET['id']// get id tu url?>">
                        <input type="submit" name="submit" value="Change Password">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    //check submit
    if (isset($_POST['submit'])){
        $id = $_POST['id'];
        $old_password = md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM tbl_admin WHERE id = '$id' and password = '$old_password' ";

        $res = mysqli_query($conn, $sql);
        if ($res == true){
            $count = mysqli_num_rows($res);
            if ($count == 1){
                // nguoi dung ton tai co th thay doi mk
                if ($confirm_password == $new_password){
                    //update password
                    $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id = $id
                    ";
                    echo $new_password;
                    $res2 = mysqli_query($conn,$sql2);

                    if ($res2 == true){
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfuly.</div>";
                        header("location: manage-admin.php");
                    }else{
                        $_SESSION['change-pwd'] = "<div class='error'>Fail to Change Password.</div>";
                        header("location: manage-admin.php");
                    }
                }else{
                    $_SESSION['pwd-not-math'] = "<div class='error'>Password Not Math.</div>";
                    header("location: manage-admin.php");
                }
            
            }else{
                $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";
                header("location: manage-admin.php");
            }
        }
            
    }
?>

<?php include ('partials/footer.php'); ?>