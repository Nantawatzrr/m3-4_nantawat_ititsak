<?php 
    session_start();
    include ('server/db.php');

    $m_user = $_POST['m_user'];
    $m_pass = $_POST['m_pass'];
    
    // สร้างคำสั่ง SQL สำหรับตรวจสอบข้อมูล
    $sql = "SELECT * FROM tb_member WHERE m_user='$m_user' AND m_pass='$m_pass'";
    
    // ส่งคำสั่ง SQL ไปยังฐานข้อมูล
    $result = $conn->query($sql);
    
    // ตรวจสอบว่ามีผู้ใช้งานในระบบหรือไม่
    if ($result->num_rows > 0) {
        // เข้าสู่ระบบสำเร็จ
        $_SESSION['m_user'] = $m_user;
        echo "<script>
            alert('เข้าสู่ระบบสำเร็จ');
            window.location.href = 'index.php';
          </script>";

    } else {
        echo "<script>
            alert('เข้าสู่ระบบไม่สำเร็จ. กรุณาตรวจสอบชื่อผู้ใช้และรหัสผ่านของคุณ');
            window.location.href = 'login.php';
          </script>";
    }
    
?>