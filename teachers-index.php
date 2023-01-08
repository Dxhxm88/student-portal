<?php
include('config/include.php');

include(asset('teacher/controller/controller.php'));

$teachers = getTeachers();
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

        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                        <div class="text-center">
                            <h2 class="fw-bolder">Listed Teachers</h2>
                            <hr color="red" />
                        </div>
                    </div>
                </div>
                <div class="row gx-5">
                    <?php foreach ($teachers as $teacher) { ?>
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="<?= route($teacher['photo']) ?>" width="100" height="200" />
                                <div class="card-body p-4">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?= $teacher['subject_name'] ?></div>
                                    <a class="text-decoration-none link-dark stretched-link" href="<?= route('teacher-detail.php?teacher_id=' . $teacher['id']) ?>">
                                        <h5 class="card-title mb-3"><?= $teacher['name'] ?></h5>
                                    </a>
                                    <p class="card-text mb-0"><small>Registered Since <?= substr($teacher['created'], 0 ,4) ?></small></p>
                                </div>
    
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

    </main>

    <?php include('inc/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>