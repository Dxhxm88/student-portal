<?php
include('../config/include.php');
include(asset('config/redirect.php'));
include(asset('teacher/controller/controller.php'));

if (isset($_POST['submit'])) {
    changepassword($_POST);
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

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Change Password</h1>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <form name="chngpwd" class="form-control" method="post" onsubmit="return valid()">
                            <div class="form-group">
                                <label for="company" class=" form-control-label">Current Password</label>
                                <input type="password" name="cpass" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="vat" class=" form-control-label">New Password</label>
                                <input type="password" name="npass" class="form-control" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="street" class=" form-control-label">Confirm Password</label>
                                <input type="password" name="cnpass" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" name="submit">Change</button>
                        </form>
                    </div>
                </div>

            </main>
        </div>
    </div>
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.cpass.value == "") {
                alert("Current Password Filed is Empty !!");
                document.chngpwd.cpass.focus();
                return false;
            } else if (document.chngpwd.npass.value == "") {
                alert("New Password Filed is Empty !!");
                document.chngpwd.npass.focus();
                return false;
            } else if (document.chngpwd.cnpass.value == "") {
                alert("Confirm Password Filed is Empty !!");
                document.chngpwd.cnpass.focus();
                return false;
            } else if (document.chngpwd.npass.value != document.chngpwd.cnpass.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.chngpwd.cnpass.focus();
                return false;
            }
            return true;
        }
    </script>
</body>

</html>