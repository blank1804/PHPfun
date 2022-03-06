<?php
session_start();
require_once 'config/db.php';

if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users_db WHERE user_id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $myid = $row['user_name'];
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM post_db WHERE post_id = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "ลบข่าวสารของคุณเรียบร้อยแล้ว!";
        header("refresh:1; url=user_feed.php");
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
    <title>User Feed</title>
</head>

<body>
    <?php require_once 'nav_user.php' ?>

    <header class="masthead bg-primary text-white text-center">

    </header>
    <main>
        <section class="page-section  mb-0">
            <div class="container">
                <div class="divider-custom">
                    <a href="user_post.php" class="btn btn-success btn-lg btn-space tx-size" role="button">เพิ่มข่าวสาร</a>
                    <a href="user_feed.php" class="btn btn-success btn-lg btn-space tx-size" role="button">ข่าวสารของฉัน</a>
                    <a href="main_user.php" class="btn btn-success btn-lg btn-space tx-size" role="button">ข่าวสารทั้งหมด</a>
                </div>
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table caption-top table-hover" table-responsive" style="text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 220px;">หัวข้อ</th>
                                <th scope="col" style="width: 220px;">รูป</th>
                                <th scope="col" style="width: 1000px;">รายละเอียด</th>
                                <th scope="col" style="width: 220px;">ผู้เขียน</th>
                                <th scope="col" style="width: 320px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $conn->query("SELECT * FROM post_db WHERE post_author = '$myid'");
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
                                        <td>
                                            <a href="main_post_user.php?post_id=<?php echo $post['post_id']; ?>" class="btn btn-success">อ่านต่อ</a>
                                            <a href="user_edit_feed.php?post_id=<?php echo $post['post_id']; ?>" class="btn btn-warning">แก้ไข</a>
                                            <a onclick="return confirm('ต้องการที่จะลบข่าวสารนี้ใช่ไหม?');" href="?delete=<?php echo $post['post_id']; ?>" class="btn btn-danger">ลบ</a>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>



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