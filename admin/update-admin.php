
 <?php include ('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>


        <?php
            //get id
            $id = $_GET['id']; // get id tu url
            $sql  = "SELECT * FROM tbl_admin WHERE id = $id";
            $res = mysqli_query($conn,$sql);
            
            if ($res == true){
                $count = mysqli_num_rows(mysqli_query($conn,$sql));
                if ($count == 1){
                    $row = mysqli_fetch_assoc(mysqli_query($conn,$sql));
                    
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }else{
                    header('location:manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tlb-30 ">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?= $full_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        UserName: 
                    </td>
                    <td>
                        <input type="text" name="username" value="<?= $username ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?=$id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn_secondary">
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
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql = "UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username'
            WHERE id ='$id'
        ";
        $res = mysqli_query($conn, $sql);
        if ($res == true){
            $_SESSION['update'] = "<div class='success'> Admin Update Successfully.</div>";
            header("location: manage-admin.php");
        }else{
            $_SESSION['update'] = "<div class='error'>Fail to Delete Admin.</div>";
            header("location: manage-admin.php");
        }

    }
?>

 <?php include ('partials/footer.php'); ?>

