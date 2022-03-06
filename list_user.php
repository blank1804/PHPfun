<?php

session_start();

require_once "config/db.php";

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM users_db WHERE user_id = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "ลบสมาชิกเรียบร้อยแล้ว!";
        header("refresh:1; url=list_user.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/styles.css" rel="stylesheet">
    <title>User List</title>
</head>
<?php require_once('nav_admin.php'); ?>

<body>
    <main>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['warning'])) { ?>
            <div class="alert alert-warning" role="alert">
                <?php
                echo $_SESSION['warning'];
                unset($_SESSION['warning']);
                ?>
            </div>
        <?php } ?>




        <div class="mc3">
            <div class="row">
                <form class="col-6 col-sm-2" action="search.php" method="post">
                    <button type="submit" name="submit" class="btn btn-primary mb-3 tx-size">ค้นหาสมาชิก</button>
                </form>
                <div class="col-6 col-sm-2">
                <button class="btn btn-primary mb-3 tx-size" onclick="document.location='add_user.php'">เพิ่มสมาชิก</button>
                </div>
            </div>

            <table class="table table-striped table-hover maintable caption-top">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">รหัสนักศึกษา</th>
                        <th scope="col">ชื่อผู้ใช้</th>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">นามสกุล</th>
                        <th scope="col">ที่อยู่</th>
                        <th scope="col">เบอร์โทร</th>
                        <th scope="col">อีเมล</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->query("SELECT * FROM users_db ");
                    $stmt->execute();
                    $users_db = $stmt->fetchAll();

                    if (!$users_db) {
                        echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                    } else {
                        foreach ($users_db as $user) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $user['user_id']; ?></th>
                                <td><?php echo $user['user_main_id']; ?></td>
                                <td><?php echo $user['user_name']; ?></td>
                                <td><?php echo $user['user_first_name']; ?></td>
                                <td><?php echo $user['user_last_name']; ?></td>
                                <td><?php echo $user['user_address']; ?></td>
                                <td><?php echo $user['user_call']; ?></td>
                                <td><?php echo $user['user_email']; ?></td>
                                <td>
                                    <a href="edit_user.php?user_id=<?php echo $user['user_id']; ?>" class="btn btn-warning">Edit</a>
                                    <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $user['user_id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
<footer>
    <p class="text-center">Copyright &copy; BLANK</p>
</footer>

</html>