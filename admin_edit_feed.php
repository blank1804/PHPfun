<?php 

    session_start();

    require_once "config/db.php";

    if (isset($_POST['update'])) {
        $post_id = $_POST['post_id'];
        $post_title = $_POST['post_title'];
        $post_detail = $_POST['post_detail'];
        $post_img = $_FILES['post_img'];

        $img2 = $_POST['img2'];
        $upload = $_FILES['post_img']['name'];

        if ($upload != '') {
            $allow = array('jpg', 'jpeg', 'png');
            $extension = explode('.', $post_img['name']);
            $fileActExt = strtolower(end($extension));
            $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
            $filePath = 'uploads/'.$fileNew;

            if (in_array($fileActExt, $allow)) {
                if ($post_img['size'] > 0 && $post_img['error'] == 0) {
                   move_uploaded_file($post_img['tmp_name'], $filePath);
                }
            }

        } else {
            $fileNew = $img2;
        }

        $sql = $conn->prepare("UPDATE post_db SET post_title = :post_title, post_detail = :post_detail,  post_img = :post_img WHERE post_id = :post_id");
        $sql->bindParam(":post_id", $post_id);
        $sql->bindParam(":post_title", $post_title);
        $sql->bindParam(":post_detail", $post_detail);
        $sql->bindParam(":post_img", $fileNew);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "Data has been updated successfully";
            header("location: main_admin.php");
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
            header("location: main_admin.php");
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



    <main>

        <div class="card-body">

            <div class="container" style="margin-top: 90px;">
                <form action="admin_edit_feed.php" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($_GET['post_id'])) {
                        $post_id = $_GET['post_id'];
                        $post_id = $conn->query("SELECT * FROM post_db WHERE post_id = $post_id");
                        $post_id->execute();
                        $data = $post_id->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                    <fieldset>
                        <div class="form-group">
                            <label>หัวข้อ</label>
                            <input type="text" hidden value="<?php echo $data['post_id']; ?>" required class="form-control" name="post_id" >
                            <input type="text" value="<?php echo $data['post_title']; ?>" id="post_title" name="post_title" class="form-control">
                            <input type="hidden" value="<?php echo $data['post_img']; ?>" required class="form-control" name="img2" >

                        </div>
                        <div class="form-group">
                            <label>รายละเอียด</label>
                            <textarea type="text" id="post_detail" name="post_detail" class="form-control"> <?php echo $data['post_detail']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="formFile" class="form-label">ภาพประกอบ</label>
                            <input type="file" class="form-control" id="post_img" name="post_img" value="">
                            <img width="60%" src="uploads/<?php echo $data['post_img']; ?>" id="previewImg" alt="">

                        </div>

                        <button type="submit" class="btn btn-primary" name="update">บันทึก</button>
                    </fieldset>
                </form>
            </div>
        </div>
        </div>


    </main>
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file)
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
<footer>
  <p class="text-center">Copyright &copy; BLANK</p>
</footer>
</html>