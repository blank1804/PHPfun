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
    <link href="css/styles.css" rel="stylesheet">
    <title>My Infomation</title>
</head>

<body>
<?php require_once 'nav_user.php'?>

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
    <script src="js/scripts.js"></script>

</body>
<footer>
  <p class="text-center">Copyright &copy; BLANK</p>
</footer>
</html>