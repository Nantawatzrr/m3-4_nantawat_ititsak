<?php
session_start();
include("connectDB.php");

$sql = $sql = "SELECT * FROM tb_book";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Navbar Dropdown</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-dark bg-dark" aria-label="First navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ห้องสมุด</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container">
        <form action="#" id="searchForm" method="get">
            <input type="text" id="searchInput" placeholder="พิมพ์คำที่ต้องการค้นหา">
            <input type="submit" style="display:none">
        </form>
        <div class="row">
            <div class="col-12 ">
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">ทั้งหมด</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="b_id.php">รหัสหนังสือ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="b_name.php">ชื่อเรื่อง</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="b_write.php">นักเขียน</a>
                    </li>
                </ul>
                <?php
                echo '<div class="card-deck">';
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<p class= "card-text">รหัสหนังสือ: '.$row["b_id"].'</p>';
                        echo '<p class=" b_name card-text">ชื่อหนังสือ:' . $row["b_name"] . '</p>';
                        echo '<p class="card-text">ผู้แต่ง: ' . $row["b_writer"] . '</p>';
                        echo '<p class="card-text">หมวดหมู่: ' . $row["b_category"] . '</p>';
                        echo '<p class="card-text">ราคา: ' . $row["b_price"] . ' บาท</p>';
                        echo '</div>'; // ปิด div.card-body
                        echo '</div>'; // ปิด div.card
                    }
                } else {
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo '<p class="card-text">ไม่พบข้อมูลหนังสือ</p>';
                    echo '</div>'; // ปิด div.card-body
                    echo '</div>'; // ปิด div.card
                }
                echo '</div>'; // ปิด div.card-deck
                ?>
            </div>



            <!-- Bootstrap JS (optional) -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <!-- Popper.js (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script>
                document.getElementById("searchInput").addEventListener("keyup", function(event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        search();
                    }
                });

                function search() {
                    var searchInputValue = document.getElementById("searchInput").value;
                    var cards = document.getElementsByClassName("card");

                    for (var i = 0; i < cards.length; i++) {
                        var card = cards[i];
                        var bookCode = card.querySelector('.b_name').innerText; // เลือกข้อมูลรหัสหนังสือใน card

                        if (bookCode.includes(searchInputValue)) {
                            card.style.display = "block";
                        } else {
                            card.style.display = "none";
                        }
                    }
                    if(!found){
                        alert("ไม่พบข้อมูล")
                    }
                }
            </script>
</body>

</html>