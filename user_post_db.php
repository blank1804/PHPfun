<?php

session_start();
require_once "config/db.php";

if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users_db WHERE user_id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $myid = $row['user_name'];
}

if (isset($_POST['submit'])) {
    $post_title = $_POST['post_title'];
    $post_detail = $_POST['post_detail'];
    $post_img = $_FILES['post_img'];
    $post_author = $myid;


    $allow = array('jpg', 'jpeg', 'png');
    $extension = explode('.', $post_img['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
    $filePath = 'uploads/' . $fileNew;

    if (in_array($fileActExt, $allow)) {
        if ($post_img['size'] > 0 && $post_img['error'] == 0) {
            if (move_uploaded_file($post_img['tmp_name'], $filePath)) {
                $sql = $conn->prepare("INSERT INTO post_db(post_title, post_detail,post_img,post_author) VALUES(:post_title, :post_detail, :post_img, :post_author)");
                $sql->bindParam(":post_title", $post_title);
                $sql->bindParam(":post_detail", $post_detail);
                $sql->bindParam(":post_author", $post_author);
                $sql->bindParam(":post_img", $fileNew);
                $sql->execute();

                if ($sql) {
                    $_SESSION['success'] = "เพิ่มข่าวสารเรียบร้อย";
                    header("location: main_user.php");
                } else {
                    $_SESSION['error'] = "Data has not been inserted successfully";
                    header("location: main_user.php");
                }
            }
        }
    }
}
