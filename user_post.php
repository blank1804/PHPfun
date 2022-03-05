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
    <title>New Post</title>
</head>
<?php require_once 'nav_user.php'?>

<body>

    <main>

        <div class="card-body">

            <div class="container" style="margin-top: 90px;">
                <form action="user_post_db.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label>หัวข้อ</label>
                            <input type="text" id="post_title" name="post_title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>รายละเอียด</label>
                            <textarea type="text" id="post_detail" name="post_detail" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="formFile" class="form-label">ภาพประกอบ</label>
                            <input type="file"  class="form-control" id="post_img" name="post_img" value="">
                            <img loading="lazy" width="150px" id="previewImg" alt="">
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
        </div>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    <script>
        let post_img = document.getElementById('post_img');
        let previewImg = document.getElementById('previewImg');

        post_img.onchange = evt => {
            const [file] = post_img.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }

    </script>
</body>
<footer>
  <p class="text-center">Copyright &copy; BLANK</p>
</footer>
</html>