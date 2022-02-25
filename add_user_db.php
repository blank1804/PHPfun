<?php

session_start();
require_once 'config/db.php';

if (isset($_POST['insert'])) {
    $user_main_id = $_POST['user_main_id'];
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $c_user_password = $_POST['c_user_password'];
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_address = $_POST['user_address'];
    $user_call = $_POST['user_call'];
    $user_email = $_POST['user_email'];


    if (empty($user_main_id)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสนักเรียน';
        header("location: add_user.php");
    } else if (empty($user_name)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อผู้ใช้';
        header("location: add_user.php");
    } else if (empty($user_first_name)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อจริง';
        header("location: add_user.php");
    } else if (empty($user_last_name)) {
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        header("location: add_user.php");
    } else if (empty($user_email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: add_user.php");
    } else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: add_user.php");
    } else if (empty($user_address)) {
        $_SESSION['error'] = 'กรุณากรอกที่อยู่';
        header("location: add_user.php");
    } else if (empty($user_call)) {
        $_SESSION['error'] = 'กรุณากรอกเบอร์โทร';
        header("location: add_user.php");
    } else if (empty($user_password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: add_user.php");
    } else if (strlen($_POST['user_password']) > 20 || strlen($_POST['user_password']) < 5) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
        header("location: add_user.php");
    }  else {
        try {

            $check_email = $conn->prepare("SELECT user_email FROM users_db WHERE user_email = :user_email");
            $check_email->bindParam(":user_email", $user_email);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);

            if ($row['user_email'] == $user_email) {
                $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว";
                header("location: index.php");
            } else if (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users_db(user_main_id, user_name,user_password,user_first_name,user_last_name,user_address,user_call,user_email) 
                                            VALUES(:user_main_id, :user_name, :user_password, :user_first_name, :user_last_name, :user_address, :user_call, :user_email)");
                $stmt->bindParam(":user_main_id", $user_main_id);
                $stmt->bindParam(":user_name", $user_name);
                $stmt->bindParam(":user_password", $user_password);
                $stmt->bindParam(":user_first_name", $user_first_name);
                $stmt->bindParam(":user_last_name", $user_last_name);
                $stmt->bindParam(":user_address", $user_address);
                $stmt->bindParam(":user_call", $user_call);
                $stmt->bindParam(":user_email", $user_email);
                $stmt->execute();
                $_SESSION['success'] = "เพิ่มสมาชิกเรียบร้อยแล้ว!";
                header("location: list_user.php");
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                header("location: add_user.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>