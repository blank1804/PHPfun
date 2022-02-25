<?php

session_start();
require_once 'config/db.php';

if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users_db WHERE user_id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $myid = $row['user_id'];
}


if (isset($_POST['reset'])) {
    $user_password = $_POST['user_password'];
    $c_user_password = $_POST['c_user_password'];


    if (strlen($_POST['user_password']) > 20 || strlen($_POST['user_password']) < 5) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
        header("location: change_password.php");
    } else if (empty($c_user_password)) {
        $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
        header("location: change_password.php");
    } else if ($user_password != $c_user_password) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: change_password.php");
    } else {
        try {

            $sql = $conn->prepare("UPDATE users_db SET user_password = :user_password WHERE user_id = $myid");
            $sql->bindParam(":user_password", $user_password);
            $sql->execute();
            $_SESSION['success'] = "เปลี่ยนรหัสผ่านเรียบร้อยแล้ว! <a href='login_user.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
            $_SESSION['user_login'] = $row['user_id'];
            header("location: login_user.php");
            

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
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
    <title>main</title>
</head>

<body>


    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" style="font-size: 26px;">ระบบลงทะเบียนศิษย์เก่า</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                </div>
            </div>
            <form class="d-flex">
                <a href="user_register.php" class="btn btn-primary btn-lg btn-space tx-size" role="button">สมัครสมาชิก</a>
                <a href="login_user.php" class="btn btn-primary btn-lg btn-space tx-size" role="button">เข้าสู่ระบบ User</a>
                <a href="login_admin.php" class="btn btn-primary btn-lg btn-space tx-size" role="button">เข้าสู่ระบบ Admin</a>
            </form>
        </div>
    </nav>


    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                    <form action="change_password.php" method="post">
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
                        <div class="card-header">
                            <h1 class="formtitle">เปลี่ยนรหัสผ่านใหม่</h1>
                        </div>
                        <div class="card-body">



                                <div class="form-group row">
                                    <label for="user_password" class="col-md-4 col-form-label text-md-right">รหัสผ่านใหม่</label>
                                    <div class="col-md-6">
                                        <input type="password" id="user_password" class="form-control" name="user_password" autofocus>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="c_user_password" class="col-md-4 col-form-label text-md-right">ยืนยัน รหัสผ่านใหม่</label>
                                    <div class="col-md-6">
                                        <input type="password" id="c_user_password" class="form-control" name="c_user_password" autofocus>
                                    </div>
                                </div>
                                <br>
                                </br>


                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" name="reset" class="btn btn-primary">
                                        ปลี่ยนรหัสผ่าน
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
<footer>
  <p class="text-center">Copyright &copy; BLANK</p>
</footer>
</html>