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
    <title>Dashboard</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg bg-dark sticky-top" id="mainNav">
        <div class="container-fluid">
            <a class="navbar-brand" href="user.php"">ระบบลงทะเบียนศิษย์เก่า</a>
                <button class=" navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
                </button>
                <form class="d-flex">
                    <a href="user_register.php" class="btn btn-primary btn-lg btn-space tx-size" role="button">สมัครสมาชิก</a>
                    <a href="login_user.php" class="btn btn-primary btn-lg btn-space tx-size" role="button">เข้าสู่ระบบ</a>
                </form>
        </div>
    </nav>


    <!-- <div class="card bg-dark  text-white mycard">
        <img class="card-img" src="https://i.imgur.com/R3i60VV.jpg" alt="Card image">
        <div class="card-img-overlay">
        </div>
    </div> -->

    <header class="masthead bg-primary text-white text-center">

    </header>
    <main>


        <section class="page-section  mb-0">
            <div class="container">
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

                            $order = 2;
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