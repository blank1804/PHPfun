<?php
session_start();
require_once 'config/db.php';

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $post_id = $conn->query("SELECT * FROM post_db WHERE post_id = $post_id");
    $post_id->execute();
    $row = $post_id->fetch(PDO::FETCH_ASSOC);
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
    <title>Read Post</title>
</head>
<?php require_once('nav_admin.php'); ?>
<body>
    <main>

        <div class="card" style="margin: 100px;">
            <div class="card-header">
                <?php echo $row['post_title']; ?>
            </div>
            <div class="imgnpost">
           <img class="rounded" display= "block" margin-left= "auto" margin-right= "auto" width = "500px" src="uploads/<?php echo $row['post_img']; ?>" alt="">
           </div>
            <div class="card-body" style="padding: 20px;">
                <blockquote class="blockquote mb-0">
                    <p> <?php echo $row['post_detail']; ?></p>
                    <footer class="blockquote-footer"> <?php echo $row['post_author']; ?> <cite title="Source Title"><?php echo $row['post_date']; ?></cite></footer>
                </blockquote>
            </div>
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