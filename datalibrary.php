<?php
session_start();
include("server/db.php");
$sql = "SELECT COUNT(b_id) AS total FROM tb_book";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
  $row["total"];
} else {
    echo "ไม่พบข้อมูล";
}

$sql1 = "SELECT COUNT(m_user) AS total FROM tb_member";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
$row1["total"];
} else {
    echo "ไม่พบข้อมูล";
}

$sql2 = "SELECT COUNT(br_id) AS total FROM tb_borrow_book";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
$row2["total"];
} else {
    echo "ไม่พบข้อมูล";
}

$sql3 = "SELECT COUNT(br_date_br) AS total FROM tb_borrow_book WHERE br_date_rt = '0000-00-00'";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
    $row3 = $result3->fetch_assoc();
$row3["total"];
} else {
    echo "ไม่พบข้อมูล";
}

?>
<!doctype html>
<html lang="en">

<head>
  <title>ข้อมูลสถิติ</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>

<nav class="navbar navbar-expand navbar-light bg-faded">
        <div class="container">
            <a class="navbar-brand" href="#">ระบบงานห้องสมุด</a>
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">การตั้งค่า</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="index.php">หน้าแรก</a>
                        <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

  <div class="container">
    <h2 class="d-flex justify-content-center mt-5">ข้อมูลสถิติของห้องสมุด</h2>
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div><b>หนังสือทั้งหมด (เล่ม)</b></div>
            <h1 class="d-flex justify-content-center"><?php echo $row["total"] ?></h1>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div><b>การใช้บริการยืม-คืนหนังสือ (ครั้ง)</b></div>
            <h1 class="d-flex justify-content-center"><?php echo $row2["total"] ?></h1>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div><b>สมาชิกทั้งหมด (คน)</b></div>
            <h1 class="d-flex justify-content-center"><?php echo $row1["total"] ?></h1>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div><b>หนังสือค้างส่ง (เล่ม)</b></div>
            <h1 class="d-flex justify-content-center"><?php echo $row3["total"] ?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>