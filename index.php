<?php include('config/include.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_ENV['APP_NAME'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <?php include(asset('inc/navbar.php')) ?>

    <main class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center py-5 border-bottom my-5">
                    <h1 class="display-4">Welcome to <?= $_ENV['APP_NAME'] ?></h1>
                    <a href="<?= route('student/login.php') ?>" class="btn btn-primary btn-lg mx-3">Login</a>
                </div>
                <div class="col-12 text-center py-5 my-5">
                    <h1 class="display-4">Our mission</h1>
                    <p class="lead">To create a transformative educational experience for
                        students focused on deep disciplinary knowledge;
                        problem solving; leadership, communication, and
                        interpersonal skills; and personal health and well-being.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <?php include(asset('inc/footer.php')) ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>