<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['alogin'])) {
        $admin_email = $_POST['admin_email'];
        $admin_password = $_POST['admin_password'];

      
        if (empty($admin_email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: login_admin.php");
        } else if (empty($admin_password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: login_admin.php");
        } else if (strlen($_POST['admin_password']) > 20 || strlen($_POST['admin_password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: login_admin.php");
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM admin_db WHERE admin_email = :admin_email");
                $check_data->bindParam(":admin_email", $admin_email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($admin_email == $row['admin_email']) {
                        if (($admin_password == $row['admin_password'])) {
                            $_SESSION['admin_login'] = $row['admin_id'];
                            header("location: admin.php");
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านผิด';
                            header("location: login_admin.php");
                        }
                    } else {
                        $_SESSION['error'] = 'อีเมลผิด';
                        header("location: login_admin.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: login_admin.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>