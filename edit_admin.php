<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "config/db.php";

if (isset($_POST['update'])) {
    $admin_id = $_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $admin_lastname = $_POST['admin_lastname'];
    $admin_email = $_POST['admin_email'];
    $admin_phone = $_POST['admin_phone'];
    $admin_password = $_POST['admin_password'];



    $sql = $conn->prepare("UPDATE admin_db SET admin_name = :admin_name, admin_lastname = :admin_lastname, admin_email = :admin_email,
      admin_phone = :admin_phone, admin_password = :admin_password WHERE admin_id = $admin_id");
    $sql->bindParam(":admin_name", $admin_name);
    $sql->bindParam(":admin_lastname", $admin_lastname);
    $sql->bindParam(":admin_email", $admin_email);
    $sql->bindParam(":admin_phone", $admin_phone);
    $sql->bindParam(":admin_password", $admin_password);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "ระบบได้ทำการแก้ไขเรียบร้อยแล้ว";
        header("location: list_admin.php");
    } else {
        $_SESSION['error'] = "มีบางอย่างผิดพลาด";
        header("location: list_admin.php");
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
            <a class="navbar-brand" href="fix_main_admin.php" style="font-size: 26px;">ระบบลงทะเบียนศิษย์เก่า</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="main_admin">จัดการข่าวสาร</a>
                    <a class="nav-item nav-link" href="list_user.php">ข้อมูลสมาชิก</a>
                    <a class="nav-item nav-link" href="list_admin.php">ข้อมูลผู้ดูแลระบบ</a>
                    <a class="nav-item nav-link" href="user_allow.php">การอนุมัติสมาชิก</a>

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
                            <h1 class="formtitle">แก้ไขผู้ดูแล</h1>
                        </div>
                        <div class="card-body">
                            <form action="edit_admin.php" method="post">

                            <?php
                                if (isset($_GET['admin_id'])) {
                                    $admin_id = $_GET['admin_id'];
                                    $stmt = $conn->query("SELECT * FROM admin_db WHERE admin_id = $admin_id");
                                    $stmt->execute();
                                    $data = $stmt->fetch();
                                }
                                ?>

                                <div class="form-group row">
                                    <label for="admin_name" class="col-md-4 col-form-label text-md-right">ชื่อจริง</label>
                                    <div class="col-md-6">
                                        <input type="text" id="admin_name" value="<?php echo $data['admin_name']; ?>" class="form-control" name="admin_name" autofocus>
                                        <input type="text" hidden value="<?php echo $data['admin_id']; ?>" id="admin_id" class="form-control" name="admin_id" autofocus>
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="admin_lastname" class="col-md-4 col-form-label text-md-right">นามสกุล</label>
                                    <div class="col-md-6">
                                        <input type="text" id="admin_lastname" value="<?php echo $data['admin_lastname']; ?>" class="form-control" name="admin_lastname" autofocus>
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="admin_email" class="col-md-4 col-form-label text-md-right">อีเมล</label>
                                    <div class="col-md-6">
                                        <input type="text" id="admin_email" value="<?php echo $data['admin_email']; ?>" class="form-control" name="admin_email" autofocus>
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="admin_phone" class="col-md-4 col-form-label text-md-right">เบอร์โทร</label>
                                    <div class="col-md-6">
                                        <input type="text" id="admin_phone" value="<?php echo $data['admin_phone']; ?>" class="form-control" name="admin_phone">
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="admin_password" class="col-md-4 col-form-label text-md-right">รหัสผ่าน</label>
                                    <div class="col-md-6">
                                        <input type="password" id="admin_password" value="<?php echo $data['admin_password']; ?>" class="form-control" name="admin_password">
                                    </div>
                                </div>
                                </br>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" name="update" class="btn btn-primary">
                                        บันทึก
                                    </button>
                                    <a href="list_admin.php" class="btn btn-primary" role="button">ยกเลิก</a>

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