<?php
session_start();
include("server/db.php");

$nameUser = "";

if (isset($_SESSION['nameUser'])) {
    $nameUser = $_SESSION['nameUser'];
}

if (isset($_POST['search_term_user'])) {
    $resultSe = $_POST['search_term_user'];
    $sql = "SELECT * FROM tb_member WHERE m_name = '$resultSe'";
    $searchUser = $conn->query($sql);
    if ($searchUser->num_rows > 0) {
        $row = $searchUser->fetch_object();
        $nameUser = $row->m_name;
        $_SESSION['nameUser'] = $nameUser;
    } else {
        echo '<script>alert("ไม่พบข้อมูลสมาชิก หรือหนังสือ");</script>';
    }
}

$idBook = "";

if (isset($_POST['search_term_book'])) {
    $resultBook = $_POST['search_term_book'];
    $sql = "SELECT * FROM tb_book WHERE b_id = '$resultBook'";
    $searchidBook = $conn->query($sql);
    if ($searchidBook->num_rows > 0) {
        $row = $searchidBook->fetch_object();
        $idBook = $row->b_id;
        $_SESSION['idBook'] = $idBook;
        $_SESSION['nameBook'] = $row->b_name;
    } else {
        echo '<script>alert("ไม่พบข้อมูลสมาชิก หรือหนังสือ");</script>';
    }
}

$nameBook = "";

if (isset($_SESSION['nameBook'])) {
    $nameBook = $_SESSION['nameBook'];
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>ยืมคืนหนังสือ</title>
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
                                <h2 class="align-center d-flex justify-content-center">ยืมหนังสือ</h2>
                                <form method="post" action="borrowbook.php">
                                    <div>
                                        <p>ผู้ที่ต้องการยืม :
                                            <input class="me-2" type="text" name="search_term_user" placeholder="กรอกชื่อผู้ใช้">
                                            <button type="submit" class="btn btn-outline-dark ">ตกลง</button>
                                        </p>
                                    </div>
                                </form>
                                <form method="post">
                                    <div>
                                        <p>รหัสหนังสือ :
                                            <input class="me-2" type="text" name="search_term_book" placeholder="กรอกรหัสหนังสือ">
                                            <button type="submit" class="btn btn-outline-dark ">ตกลง</button>
                                            <!-- search_term_book -->
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped text-center">
                                    <form action="br_db.php" method="post">
                                        <tbody>
                                            <tr>
                                                <p class="me-4">ชื่อ-นามสกุลผู้ยืม :
                                                    <input name="m_user" value="<?php echo $nameUser ?>" placeholder="ชื่อ-นามสกุลผู้ยืม">
                                                </p>

                                                <p>รหัสหนังสือ :
                                                    <input name="b_id" value="<?php echo $idBook ?>" placeholder="รหัสหนังสือ">
                                                </p>

                                                <p>ชื่อหนังสือ :
                                                    <input name="b_name" value="<?php echo $nameBook ?>" placeholder="ชื่อหนังสือ">
                                                </p>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <button class="btn btn-success">ยืนยัน</button>
                                                    <a href="cancel.php" class="btn btn-danger">ยกเลิก</a>
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