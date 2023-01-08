<?php
include('../config/include.php');
include(asset('teacher/controller/controller.php'));

$subjects = getSubjects();

if (isset($_POST['submit'])) {
    $_POST['photo'] = $_FILES['photo'];
    register($_POST);
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

    <?php include(asset('inc/topbar.php')) ?>

    <div class="container-fluid">
        <div class="row">


            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Register</h1>
                </div>

                <form method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header"><strong>Teacher</strong><small> Personal Details</small></div>
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="company" class=" form-control-label">Name</label>
                                        <input type="text" name="name" class="form-control" required="true">
                                    </div>

                                    <div class="form-group">
                                        <label for="company" class=" form-control-label">Photo</label> &nbsp;
                                        <input type="file" name="photo" class="form-control mt-2">
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="street" class=" form-control-label">Email</label>
                                        <input type="text" name="email" class="form-control" required="true">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="street" class=" form-control-label">Password</label>
                                        <input type="password" name="password" class="form-control" required="true">
                                    </div>

                                    <div class="row form-group mb-2">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Phone</label>
                                                <input type="text" name="phone" class="form-control" required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group mb-2">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Address</label>
                                                <textarea type="text" name="address" class="form-control" rows="3" cols="12" required="true"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group mb-2">
                                        <div class="col-12">
                                            <div class="form-group"><label for="city" class=" form-control-label">Joining Date</label>
                                                <input type="date" name="created" id="joiningdate" class="form-control" required="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header"><strong>Teacher</strong><small> Professional Details</small></div>
                                <div class="card-body card-block">
                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Qualifications</label>
                                                <input type="text" name="qualification" class="form-control" required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Teaching Experience (in Years)</label>
                                                <input type="text" name="experience" class="form-control" required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group"><label for="city" class=" form-control-label">Teaching Subjects</label>
                                                <select type="text" name="subject" class="form-control" required="true">
                                                    <?php foreach ($subjects as $subject) { ?>
                                                        <option value="<?= $subject['id'] ?>" ><?= $subject['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Description (if Any)</label>
                                                <textarea type="text" name="description" class="form-control" rows="3" cols="12" required="true"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit">Register</button></p>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>

</html>