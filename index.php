<?php 
include('config/include.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?= $_ENV['APP_NAME'] ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" type="text/css" href="<?= route('css/style.css') ?>">
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <?php include('inc/topbar.php') ?>

        <header class="bg-dark py-5">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-lg-8 col-xl-7 col-xxl-6">
                        <div class="my-5 text-center text-xl-start">
                            <h1 class="display-5 fw-bolder text-white mb-2"><?= $_ENV['APP_NAME'] ?></h1>

                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start" style="margin-top:5%;">
                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="<?= route('teacher/register.php') ?>">Teachers Signup/Registration</a>
                                <a class="btn btn-outline-light btn-lg px-4" href="<?= route('teacher/login.php') ?>">Teachers Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="<?= route('img/teacher.jpg') ?>" alt="..." /></div>
                </div>
            </div>
        </header>

    </main>

    <?php include('inc/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>