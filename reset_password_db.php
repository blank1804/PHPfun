<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['reset'])) {
        $user_email = $_POST['user_email'];
        $user_main_id = $_POST['user_main_id'];

        if (empty($user_email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: reset_password.php");
        }

       {
            try {

                $check_data = $conn->prepare("SELECT * FROM users_db WHERE user_email = :user_email");
                $check_data->bindParam(":user_email", $user_email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($user_email == $row['user_email']) {
                        if (($user_main_id == $row['user_main_id'])) {
                            $_SESSION['user_login'] = $row['user_id'];
                            $_SESSION['success'] = "ยืนยันเรียบร้อยแล้ว!! กรุณาเลือกรหัสใหม่";
                            header("location: change_password.php");
                        } else {
                            $_SESSION['error'] = 'อีเมลผิด';
                            header("location: reset_password.php");
                        }
                    } 
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: reset_password.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>