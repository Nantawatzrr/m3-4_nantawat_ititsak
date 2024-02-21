<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>

    <section class="text-center">

        <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>

        <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
            .<div class="container">
                <div class="card-body py-5 px-md-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-4">
                            <h2 class="fw-bold mb-5">ระบบงานห้องสมุด</h2>
                            <form action="signin_db.php" method="post">
                                <div class="form-outline mb-4">
                                    <input type="text" id="m_user" name="m_user" class="form-control" placeholder="ชื่อผู้ใช้" required />
                                    <label class="form-label" for="form3Example3">ชื่อผู้ใช้งาน</label>
                                </div>


                                <div class="form-outline mb-4">
                                    <input type="password" id="m_pass" name="m_pass" class="form-control" placeholder="รหัสผ่าน" required />
                                    <label class="form-label" for="form3Example4">รหัสผ่าน</label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    เข้าสู่ระบบ
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

   
    </script>

</body>

</html>