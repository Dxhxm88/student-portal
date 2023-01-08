<?php
include('../config/include.php');
include(asset('config/redirect.php'));
include(asset('teacher/controller/controller.php'));

$profile = getProfile();
$subjects = getSubjects();

if (isset($_POST['submit'])) {
    $_POST['photo'] = $_FILES['photo'];
    editProfile($_POST);
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
                    <h1 class="h2">Profile</h1>
                </div>

                <form method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header"><strong>Teacher</strong><small> Personal Details</small></div>
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="company" class=" form-control-label">Name</label>
                                        <input type="text" name="name" value="<?= $profile['name'] ?>" class="form-control" required="true">
                                    </div>

                                    <div class="form-group">
                                        <label for="company" class=" form-control-label">Photo</label> &nbsp;
                                        <img src="<?= route($profile['photo']) ?>" width="100" height="100" class="mt-2">
                                        <input type="file" name="photo" class="form-control mt-2">
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="street" class=" form-control-label">Email</label>
                                        <input type="text" name="email" value="<?= $profile['email'] ?>" class="form-control" required="true">
                                    </div>

                                    <div class="row form-group mb-2">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Phone</label>
                                                <input type="text" name="phone" value="<?= $profile['phone'] ?>" class="form-control" required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group mb-2">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Address</label>
                                                <textarea type="text" name="address" class="form-control" rows="3" cols="12" required="true"><?= $profile['address'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group mb-2">
                                        <div class="col-12">
                                            <div class="form-group"><label for="city" class=" form-control-label">Joining Date</label>
                                                <input type="date" name="created" id="joiningdate" value="<?= $profile['created'] ?>" class="form-control" required="true">
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
                                                <input type="text" name="qualification" value="<?= $profile['qualification'] ?>" class="form-control" required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Teaching Experience (in Years)</label>
                                                <input type="text" name="experience" value="<?= $profile['experience'] ?>" class="form-control" required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group"><label for="city" class=" form-control-label">Teaching Subjects</label>
                                                <select type="text" name="subject" class="form-control" required="true">
                                                    <?php foreach ($subjects as $subject) { ?>
                                                        <option value="<?= $subject['id'] ?>" <?= $profile['subject_id'] == $subject['id'] ? "selected" : "" ?>><?= $subject['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Description (if Any)</label>
                                                <textarea type="text" name="description" class="form-control" rows="3" cols="12" required="true"><?= $profile['description'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="city" class=" form-control-label">Profile Status <small style="color:red">(Public profile anybody can your details and not public only you can view)</small></label>
                                                <select type="text" name="status" class="form-control" required="true">
                                                    <option value="public" <?= $profile['status'] == "public" ? "selected" : "" ?>>Public</option>
                                                    <option value="not public" <?= $profile['status'] == "not public" ? "selected" : "" ?>>Not public</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-dot-circle-o"></i> Update</button></p>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>

</html>