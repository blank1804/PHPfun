<?php

session_start();
require_once 'config/db.php';

if (isset($_POST['insertA'])) {
    $admin_name = $_POST['admin_name'];
    $admin_lastname = $_POST['admin_lastname'];
    $admin_email = $_POST['admin_email'];
    $admin_phone = $_POST['admin_phone'];
    $admin_password = $_POST['admin_password'];

    if (empty($admin_name)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: add_admin.php");
    } else if (empty($admin_lastname)) {
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        header("location: add_admin.php");
    } else if (empty($admin_email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: add_admin.php");
    } else if (empty($admin_phone)) {
        $_SESSION['error'] = 'กรุณากรอกเบอร์โทร';
        header("location: add_admin.php");
    } else if (empty($admin_password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: add_admin.php");
    } else {
        try {

            $check_email = $conn->prepare("SELECT admin_email FROM admin_db WHERE admin_email = :admin_email");
            $check_email->bindParam(":admin_email", $admin_email);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);

            if ($row['admin_email'] == $admin_email) {
                $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว";
                header("location: add_admin.php");
            } else if (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO admin_db(admin_name, admin_lastname,admin_email,admin_phone,admin_password) 
                                            VALUES(:admin_name, :admin_lastname, :admin_email, :admin_phone, :admin_password)");
                $stmt->bindParam(":admin_name", $admin_name);
                $stmt->bindParam(":admin_lastname", $admin_lastname);
                $stmt->bindParam(":admin_email", $admin_email);
                $stmt->bindParam(":admin_phone", $admin_phone);
                $stmt->bindParam(":admin_password", $admin_password);
                $stmt->execute();
                $_SESSION['success'] = "เพิ่มผู้ดูแลเรียบร้อยแล้ว!";
                header("location: list_admin.php");
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                header("location: add_admin.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>