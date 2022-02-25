<?php
session_start();
require_once 'config/db.php'


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
            <a onclick="return confirm('ต้องการที่จะออกจากระบบใช่หรือไม่?');" onclick="return confirm('ต้องการที่จะออกจากระบบใช่หรือไม่?');" href="logout.php" class="btn btn-danger btn-lg btn-space tx-size" role="button">Logout</a>
            </form>
        </div>
    </nav>

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
    <main>
    <div class="container">
        <?php

        if (isset($_SESSION['user_login'])) {
            $user_id = $_SESSION['user_login'];
            $stmt = $conn->query("SELECT * FROM users_db WHERE user_id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        ?>
        <h3 class="mt-4">Hello User!, <?php echo $row['user_first_name'] . ' ' . $row['user_last_name'] ?></h3>
        <a href="user_edit.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-warning">แก้ไขข้อมูลตนเอง</a>

    </div>

    <div class="mc3" style="text-align: center;">
    <table class="table table-striped">
  <thead>
  <tr>
      <th scope="col">ชื่อรหัสนักศึกษา</th>
      <th scope="col">ชื่อ</th>
      <th scope="col">นามสกุล</th>
      <th scope="col">ชื่อผู้ใช้</th>
      <th scope="col">เบอร์โทร</th>
      <th scope="col">อีเมล</th>
    </tr>
  </thead>
  <tbody>
  <tr>
      <td><?php echo $row['user_main_id']; ?></td>
      <td><?php echo $row['user_first_name']; ?></td>
      <td><?php echo $row['user_last_name']; ?></td>
      <td><?php echo $row['user_name']; ?></td>
      <td><?php echo $row['user_call']; ?></td>
      <td><?php echo $row['user_email']; ?></td>
    </tr>
    
  </tbody>
</table>
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