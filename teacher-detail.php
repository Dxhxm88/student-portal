<?php
include('config/include.php');
include(asset('teacher/controller/controller.php'));

$teacher = getTeacher($_GET['teacher_id']);

if (isset($_POST['submit'])) {
    addQuery($_POST, $_GET['teacher_id']);
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
        <?php include('inc/topbar.php') ?>

        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder"><?= $teacher['name'] ?>'s Details</h1>
                    <p class="lead fw-normal text-muted mb-0">Registered Since <?= substr($teacher['created'], 0 ,4) ?></p>
                </div>
                <div class="row gx-5">
                    <div class="col-xl-8">
                        <div class="accordion mb-5" id="accordionExample">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Personal Details</button></h3>
                                <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered">

                                            <tr>
                                                <th></th>
                                                <td><img src="<?= route($teacher['photo']) ?>" width="200"></td>
                                            </tr>
                                            <tr>
                                                <th>Teacher Name</th>
                                                <td><?= $teacher['name'] ?></td>
                                            </tr>

                                            <tr>
                                                <th>Teacher Email ID</th>
                                                <td><?= $teacher['email'] ?></td>
                                            </tr>

                                            <tr>
                                                <th>Teacher Mobile Number</th>
                                                <td><?= $teacher['phone'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Teacher Address</th>
                                                <td><?= $teacher['address'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Registered Since</th>
                                                <td><?= substr($teacher['created'], 0 ,4) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- FAQ Accordion 2-->

                        <div class="accordion mb-5 mb-xl-0" id="accordionExample2">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Professional Details</button></h3>
                                <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample2">
                                    <div class="accordion-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Teacher Qualifications</th>
                                                <td><?= $teacher['qualification'] ?></td>
                                            </tr>

                                            <tr>
                                                <th>Teaching Experience (in Years)</th>
                                                <td><?= $teacher['experience'] ?></td>
                                            </tr>

                                            <tr>
                                                <th>Teacher Subject</th>
                                                <td><?= $teacher['subject_name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Description (if Any)</th>
                                                <td><?= $teacher['description'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card border-0 bg-light mt-xl-5">
                            <div class="card-body p-4 py-lg-5">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <div class="h6 fw-bolder">Have more questions?</div>
                                        <p class="text-muted mb-4">
                                            Contact me at
                                            <br />
                                            <a href="#!"><?= $teacher['email'] ?></a>
                                        </p>
                                        <h5>OR</h5>
                                        <form method="post">
                                            <p> <input type="text" name="name" placeholder="Enter your fullname" class="form-control" required></p>
                                            <p><input type="email" name="email" placeholder="Enter your emaild" class="form-control" required></p>
                                            <p><input type="text" name="phone" placeholder="Enter your mobile no" class="form-control"  required></p>
                                            <p><textarea class="form-control" name="message" placeholder="Query / Message" required></textarea>
                                            </p>
                                            <input type="submit" class="btn btn-primary" name="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include('inc/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>