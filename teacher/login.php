<?php 
include('../config/include.php');
include(asset('teacher/controller/controller.php'));

if (isset($_POST['submit'])) {
    print_r($_POST);
    login($_POST);
}
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
        <?php include(asset('inc/topbar.php')) ?>

        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6">
                        <div class="card bg-white">
                            <div class="card-body p-5">
                                <form class="mb-3 mt-md-4" method="post">
                                    <h2 class="fw-bold mb-2 text-uppercase ">Teacher Login</h2>
                                    <div class="mb-3">
                                        <label for="email" class="form-label ">Email address</label>
                                        <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label ">Password</label>
                                        <input type="password" class="form-control"name="password" placeholder="*******" required>
                                    </div>
                                    <!-- <p class="small"><a class="text-primary" href="#">Forgot password?</a></p> -->
                                    <div class="d-grid">
                                        <button class="btn btn-outline-dark" name="submit" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include(asset('inc/footer.php')) ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>