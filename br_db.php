<?php

include('server/db.php');
$m_user = $_POST['m_user'];
$b_id = $_POST['b_id'];
$b_name = $_POST['b_name'];
$br_date_br = date("Y-m-d");
$br_date_rt = "0000-00-00";

$sqlU = "SELECT * FROM tb_member WHERE m_name = '$m_user'";
$qsql = $conn->query($sqlU);
$dataMemmer = $qsql->fetch_object();


$sql = "INSERT INTO tb_borrow_book (m_user,b_id,br_date_br,br_date_rt) VALUE ('$dataMemmer->m_user','$b_id','$br_date_br','$br_date_rt')";


$result = $conn->query($sql);


?>

<script>
    alert("ทำรายการสำเร็จ");
    window.location.href = 'borrowbook.php';
</script>