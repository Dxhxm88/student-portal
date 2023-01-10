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
        <div class="container mt-5">
            <h1 class="display-4 font-weight-bold mb-5 text-center">Contact Us</h1>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fa fa-envelope fa-3x text-primary mb-3"></i>
                            <h4 class="card-title mb-4">Email</h4>
                            <p class="card-text">info@company.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fa fa-phone fa-3x text-primary mb-3"></i>
                            <h4 class="card-title mb-4">Phone</h4>
                            <p class="card-text">(123) 456-7890</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fa fa-map-marker fa-3x text-primary mb-3"></i>
                            <h4 class="card-title mb-4">Address</h4>
                            <p class="card-text">123 Main Street<br>Anytown, USA 12345</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php include(asset('inc/footer.php')) ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>