<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "config/db.php";

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $user_main_id = $_POST['user_main_id'];
    $user_name = $_POST['user_name'];
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_address = $_POST['user_address'];
    $user_call = $_POST['user_call'];
    $user_email = $_POST['user_email'];



    $sql = $conn->prepare("UPDATE users_db SET user_main_id = :user_main_id, user_name = :user_name, user_first_name = :user_first_name,
      user_last_name = :user_last_name, user_address = :user_address, user_call = :user_call, user_email = :user_email WHERE user_id = $user_id");
    $sql->bindParam(":user_main_id", $user_main_id);
    $sql->bindParam(":user_name", $user_name);
    $sql->bindParam(":user_first_name", $user_first_name);
    $sql->bindParam(":user_last_name", $user_last_name);
    $sql->bindParam(":user_address", $user_address);
    $sql->bindParam(":user_call", $user_call);
    $sql->bindParam(":user_email", $user_email);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "แก้ไขเรียบร้อยแล้ว";
        header("location: user_info.php");
    } else {
        $_SESSION['error'] = "แก้ไขเรียบร้อยแล้ว";
        header("location: user_info.php");
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
    <title>Document</title>
</head>

<body>

    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="main_user.php" style="font-size: 26px;">ระบบลงทะเบียนศิษย์เก่า</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="main_user.php">จัดการข่าวสาร</a>
                    <a class="nav-item nav-link" href="user_info.php">ข้อมูลส่วนตัว</a>
                </div>
            </div>
            <form class="d-flex">
                <a onclick="return confirm('ต้องการที่จะออกจากระบบใช่หรือไม่?');" href="logout.php" class="btn btn-danger btn-lg btn-space tx-size" role="button">Logout</a>
            </form>
        </div>
    </nav>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="formtitle">แก้ไขสมาชิก</h1>
                        </div>
                        <div class="card-body">
                            <form action="user_edit.php" method="post" enctype="multipart/form-data">
                                <?php
                                if (isset($_GET['user_id'])) {
                                    $user_id = $_GET['user_id'];
                                    $stmt = $conn->query("SELECT * FROM users_db WHERE user_id = $user_id");
                                    $stmt->execute();
                                    $data = $stmt->fetch();
                                }
                                ?>



                                <div class="form-group row">
                                    <label for="user_main_id" class="col-md-4 col-form-label text-md-right">รหัสนักเรียน</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_main_id" value="<?php echo $data['user_main_id']; ?>" class="form-control" name="user_main_id" autofocus>
                                        <input type="text" hidden value="<?php echo $data['user_id']; ?>" id="user_id" class="form-control" name="user_id" autofocus>
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">ชื่อผู้ใช้</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_name" value="<?php echo $data['user_name']; ?>" class="form-control" name="user_name" autofocus>
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="user_first_name" class="col-md-4 col-form-label text-md-right">ชื่อจริง</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_first_name" value="<?php echo $data['user_first_name']; ?>" class="form-control" name="user_first_name" autofocus>
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="user_last_name" class="col-md-4 col-form-label text-md-right">นามสกุล</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_last_name" value="<?php echo $data['user_last_name']; ?>" class="form-control" name="user_last_name">
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="user_email" class="col-md-4 col-form-label text-md-right">อีเมล</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_email" value="<?php echo $data['user_email']; ?>" class="form-control" name="user_email">
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="user_address" class="col-md-4 col-form-label text-md-right">ที่อยู่</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="user_address" id="user_address"><?php echo $data['user_address']; ?></textarea>
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="user_call" class="col-md-4 col-form-label text-md-right">เบอร์โทร</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_call" value="<?php echo $data['user_call']; ?>" class="form-control" name="user_call">
                                    </div>
                                </div>

                                </br>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" name="update" class="btn btn-primary">
                                        บันทึก
                                    </button>
                                    <a href="user_info.php" class="btn btn-primary" role="button">ยกเลิก</a>

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