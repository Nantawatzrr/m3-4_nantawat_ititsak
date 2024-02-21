<?php 
include('server/db.php');

$b_id = $_POST['b_id'];
$br_fine = $_POST['br_fine'];
$m_user = $_POST['m_user'];
$br_date_br = $_POST['br_date_br'];
$br_date_rt = date("Y-m-d");

$sqlM = "SELECT * FROM tb_member WHERE m_name = '$m_user'";
$Msql = $conn->query($sqlM);
$dataMemmer = $Msql->fetch_object();

$sql = "UPDATE tb_borrow_book SET m_user = '$dataMemmer->m_user' , br_fine = '$br_fine' , br_date_br = '$br_date_br' , br_date_rt = '$br_date_rt' WHERE b_id = '$b_id'";
$result = $conn->query($sql);
?>

<script>
    alert("ทำรายการสำเร็จ");
    window.location.href = 'index.php';
</script>