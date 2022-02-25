<?php 


session_start();
require_once "config/db.php";


if (isset($_GET['user_id'])) {
    $user_id = $_POST['user_id'];
    $user_rigth = $_POST['user_rigth'];
    $aaid = ['0'];

    $sql = $conn->prepare("UPDATE users_db SET user_rigth = :aaid WHERE user_id = $user_id");
    $sql->bindParam(":user_rigth", $user_rigth);
    $constmt->execute();

}

?>