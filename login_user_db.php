<?php

session_start();
require_once 'config/db.php';

if (isset($_POST['ulogin'])) {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    if (empty($user_email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: login_user.php");
    } else if (empty($user_password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: login_user.php");
    } else if (strlen($_POST['user_password']) > 20 || strlen($_POST['user_password']) < 5) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
        header("location: login_user.php");
    } else {
        try {

            $check_data = $conn->prepare("SELECT * FROM users_db, admin_db WHERE user_email = :user_email OR admin_email = :user_email");
            $check_data->bindParam(":user_email", $user_email);
            $check_data->bindParam(":admin_email", $user_email);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);


            if ($check_data->rowCount() > 0) {

                if ($user_email == $row['user_email'] || $user_email == $row['admin_email']) {
                    if (($user_password == $row['user_password'])) {
                        $_SESSION['user_login'] = $row['user_id'];
                        header("location: main_user.php");
                    } elseif ($user_email == $row['admin_email']) {
                        if (($user_password == $row['admin_password'])) {
                            $_SESSION['admin_login'] = $row['admin_id'];
                            header("location: admin.php");
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านผิด';
                            header("location: login_user.php");
                        }
                    } else {
                        $_SESSION['error'] = 'รหัสผ่านผิด';
                        header("location: login_user.php");
                    }
                } else {
                    $_SESSION['error'] = 'อีเมลผิด';
                    header("location: login_user.php");
                }
            } else {
                $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                header("location: login_user.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
