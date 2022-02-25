<?php
session_start();
require_once 'config/db.php';
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM post_db WHERE post_id = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "ลบข่าวสารของคุณเรียบร้อยแล้ว!";
        header("refresh:1; url=main_admin.php");
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

  <div class="card bg-dark text-white mycard">
  <img class="card-img" src="https://i.imgur.com/R3i60VV.jpg" alt="Card image">
  <div class="card-img-overlay">
  </div>
</div>

    <main>
    <div>
            <div class="mecard card">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table caption-top table-responsive" style="text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 220px;">หัวข้อ</th>
                                <th scope="col" style="width: 220px;">รูป</th>
                                <th scope="col" style="width: 1200px;">รายละเอียด</th>
                                <th scope="col" style="width: 220px;">ผู้เขียน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $conn->query("SELECT * FROM post_db");
                            $stmt->execute();
                            $post_db = $stmt->fetchAll();

                            if (!$post_db) {
                                echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                            } else {
                                foreach ($post_db as $post) {
                            ?>
                                    <tr>
                                        <td><?php echo $post['post_title']; ?></td>
                                        <td width="250px"><img class="rounded" width="100%" src="uploads/<?php echo $post['post_img']; ?>" alt=""></td>
                                        <td> <?php echo substr($post['post_detail'], 0, 300) . ((strlen($post['post_detail']) > 300) ? '...' : ''); ?> </td>
                                        <td><?php echo $post['post_author']; ?></td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
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