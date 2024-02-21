<?php
session_start();
include("server/db.php");

$idBook = "";
if (isset($_SESSION['idBook'])) {
    $idBook = $_SESSION['idBook'];
}

if (isset($_POST['search_term_book'])) {
    $resultBook = $_POST['search_term_book'];
    $sql = "SELECT *
    FROM tb_borrow_book
    JOIN tb_book ON tb_borrow_book.b_id = tb_book.b_id
    JOIN tb_member ON tb_borrow_book.m_user = tb_member.m_user
    WHERE tb_borrow_book.b_id = '$resultBook'";
    $searchidBook = $conn->query($sql);
    if ($searchidBook->num_rows > 0) {
        $row = $searchidBook->fetch_object();
        $idBook = $row->b_id;
        $nameBook = $row->b_name;
        $m_name = $row->m_name;
        $dateReturn = $row->br_date_br;
        $_SESSION['idBook'] = $idBook;
        $_SESSION['nameBook'] = $nameBook;
        $_SESSION['m_name'] = $m_name;
        $_SESSION['dateReturn'] = $dateReturn;
    } else {
        echo '<script>alert("ไม่พบข้อมูลสมาชิก หรือหนังสือ");</script>';
    }
}

$nameBook = "";

if (isset($_SESSION['nameBook'])) {
    $nameBook = $_SESSION['nameBook'];
}

$m_name = "";

if (isset($_SESSION['m_name'])) {
    $m_name = $_SESSION['m_name'];
}


$dateReturn = "";
if (isset($_SESSION['dateReturn'])) {
    $dateReturn = $_SESSION['dateReturn'];
}


?>
<!doctype html>
<html lang="en">

<head>
    <title>คืนหนังสือ</title>
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
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-center">
                            <a href="borrowbook.php" class="btn btn-primary mr2">ยืมหนังสือ</a>
                            <a href="returnbook.php" class="btn btn-secondary mr2">คืนหนังสือ</a>
                        </div>

                        <div>
                            <div>
                                <h2 class="align-center d-flex justify-content-center">คืนหนังสือ</h2>
                                <form method="post">
                                    <div>
                                        <p>รหัสหนังสือที่ต้องการคืน :
                                            <input class="me-2" type="text" name="search_term_book" placeholder="กรอกรหัสหนังสือ">
                                            <button type="submit" class="btn btn-outline-dark ">ตกลง</button>

                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped text-center">
                                    <form action="rt_db.php" method="post">
                                        <tbody>
                                            <tr>
                                                <p class="">รหัสหนังสือ :
                                                    <input name="b_id" value="<?php echo $idBook ?>" placeholder="รหัสหนังสือ">
                                                </p>
                                                <p>ชื่อหนังสือ :
                                                    <input name="b_name" value="<?php echo $nameBook ?>" placeholder="ชื่อหนังสือ">
                                                </p>
                                                <p class="me-5">ผู้ยืม-คืนหนังสือ :
                                                    <input name="m_user" value="<?php echo $m_name ?>" placeholder="ผู้ยืม-คืนหนังสือ">
                                                </p>
                                                <p class="me-5">วันที่ยืมหนังสือ :
                                                    <input name="br_date_br" value="<?php echo $dateReturn ?>" placeholder="วันที่ยืมหนังสือ">
                                                </p>
                                                <p>ค่าปรับ :
                                                    <input name="br_fine" placeholder="ค่าปรับ">
                                                </p>

                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <button class="btn btn-success">ยืนยัน</button>
                                                    <a href="cancelRt.php" class="btn btn-danger">ยกเลิก</a>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>