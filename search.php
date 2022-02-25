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
                    <a class="nav-item nav-link" href="main_admin.php">จัดการข่าวสาร</a>
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



    <main>

        <div class="mc3">

            <form class="row g-8" action="" method="get">
                <div class="col-auto">

                    <input type="text" href="search.php" class="form-control" id="search" name="q" placeholder="ค้นหา">
                </div>
                <div class="col-auto">
                    <button type="submit" name="submit" class="btn btn-primary mb-3">ค้นหา</button>
                </div>
            </form>


            <a href="add_user.php" hidden class="btn btn-success btn-lg btn-space tx-size" role="button">เพิ่มสมาชิก</a>

            <?php
            if (isset($_GET['q'])) {
                require_once 'config/db.php';
                $q = "%{$_GET['q']}%";
                $stmt = $conn->prepare("SELECT * FROM users_db WHERE user_first_name LIKE ?");
                $stmt->execute([$q]);
                $result = $stmt->fetchAll(); //แสดงข้อมูลทั้งหมด

                if ($stmt->rowCount() > 0) {
            ?>
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
                            <?php foreach ($result as $row) { ?>
                                <tr>
                                    <td><?= $row['user_id']; ?></td>
                                    <td><?= $row['user_main_id']; ?></td>
                                    <td><?= $row['user_name']; ?></td>
                                    <td><?= $row['user_first_name']; ?></td>
                                    <td><?= $row['user_last_name']; ?></td>
                                    <td><?= $row['user_address']; ?></td>
                                    <td><?= $row['user_call']; ?></td>
                                    <td><?= $row['user_email']; ?></td>
                                    <td>
                                    <a href="edit_user.php?user_id=<?php echo $user['user_id']; ?>" class="btn btn-warning">Edit</a>
                                    <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $user['user_id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
            <?php } // if ($stmt->rowCount() > 0) {
                else {
                    echo '<center> -ไม่พบข้อมูล !! </center>';
                }
            } //isset 
            ?>
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