<?php
session_start();
include('server/db.php');

// ตรวจสอบว่ามี session username หรือไม่

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search_term = $_POST['search_term'];
    $sql = "SELECT tb_borrow_book.*, tb_book.*, tb_member.*
            FROM tb_borrow_book
            INNER JOIN tb_book ON tb_borrow_book.b_id = tb_book.b_id
            INNER JOIN tb_member ON tb_borrow_book.m_user = tb_member.m_user
            WHERE tb_book.b_name LIKE '%$search_term%'
            OR tb_book.b_writer LIKE '%$search_term%'
            OR tb_member.m_name LIKE '%$search_term%'"; // Add conditions for tb_member as needed
} else {
    $sql = "SELECT tb_borrow_book.*, tb_book.*, tb_member.*
            FROM tb_borrow_book
            INNER JOIN tb_book ON tb_borrow_book.b_id = tb_book.b_id
            INNER JOIN tb_member ON tb_borrow_book.m_user = tb_member.m_user";
}

$dtbook = $conn->query($sql);
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
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
                        <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>




    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header text-center fs-2">
                        การจัดการข้อมูลการยืม-คืนหนังสือ
                    </div>
                    <div class="card-body text-center">
                        <form method="post">
                            <div>
                                <input class="me-2" type="text" name="search_term" placeholder="ค้นหา">
                                <button type="submit" class="btn btn-outline-dark ">ค้นหา</button>
                            </div>
                        </form>
                        <div class="table-responsive text-nowrap">
                            <div class="float-end">
                                <a href="borrowbook.php" type="button" class="btn btn-outline-success btn-lg">ยืมคืนหนังสือ</a>
                                <a href="datalibrary.php" type="button" class="btn btn-outline-primary btn-lg">ข้อมูลสถิติ</a>
                            </div>
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">รหัสหนังสือ</th>
                                        <th scope="col">ชื่อหนังสือ</th>
                                        <th scope="col">กู้ยืม-คืน</th>
                                        <th scope="col">วันที่ยืม</th>
                                        <th scope="col">วันที่คืน</th>
                                        <th scope="col">ค่าปรับ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $dtbook->fetch_object()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row->b_id ?></td>
                                            <td><?php echo $row->b_name ?></td>
                                            <td><?php echo $row->m_name ?></td>
                                            <td><?php echo $row->br_date_br ?></td>
                                            <td><?php echo $row->br_date_rt ?></td>
                                            <td><?php echo $row->br_fine ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>