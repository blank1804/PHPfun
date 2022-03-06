<?php
session_start();
require_once 'config/db.php';


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
    <title>User Dashboard</title>
</head>

<body>
<?php require_once('nav_user.php'); ?>

    <header class="masthead bg-primary text-white text-center">

    </header>
    <main>
    <div>

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
                                        <td class="listimg"><img class="rounded b"  src="uploads/<?php echo $post['post_img']; ?>" alt=""></td>
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