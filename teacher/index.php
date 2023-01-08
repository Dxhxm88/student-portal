<?php
include('../config/include.php');
include(asset('config/redirect.php'));
include(asset('teacher/controller/controller.php'));

if (isset($_GET['logout'])) {
    logout();
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $_ENV['APP_NAME'] ?></title>

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" type="text/css" href="<?= route('css/style.css') ?>">
</head>

<body>

    <header class="navbar navbar-dark bg-dark flex-md-nowrap p-0 shadow p-2">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="<?= route('teacher/') ?>"><?= $_ENV['APP_NAME'] ?></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="<?= route('teacher/index.php?logout=1') ?>">Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">

            <?php include(asset('teacher/inc/sidebar.php')) ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <div class="mb-4 rounded-3 <?= $_SESSION['status'] == "public" ? 'bg-success text-light' : 'bg-warning' ?>">
                    <div class="container-fluid py-5">
                        <h4 class="fw-bold">Welcome back, <?= $_SESSION['name'] ?>!</h4>
                        <?php if ($_SESSION['status'] == 'public') { ?>
                            <p class="col-md-8">Your profile is public, student can see your profile</p>
                        <?php }else { ?>
                            <p class="col-md-8">Your profile not public, student cannot see your profile yet</p>
                        <?php } ?>
                    </div>
                </div>

                <div class="mb-4 rounded-3 bg-info">
                    <div class="container-fluid py-5">
                        <h4 class="fw-bold"><?= getTotalQuery() ?></h4>
                        <p class="col-md-8">Total query received</p>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
</body>

</html>