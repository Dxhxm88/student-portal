<?php
include('../config/include.php');
include(asset('config/redirect.php'));
include(asset('controller/admin-controller.php'));

$subject = getSubject($_GET['subject_id']);
$lecturers = getLecturers();

if (isset($_POST['submit'])) {
    updateSubject($_POST, $_GET['subject_id']);
}

?>
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


    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include(asset('admin/inc/sidebar.php')) ?>

            <div class="col py-3">
                <div class="container">
                    <h1>Edit Subject</h1>
                </div>

                <div class="mt-3 mb-3">
                    <a href="<?= route('admin/subject.php') ?>" class="btn btn-secondary">Back</a>
                </div>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Subject Name</label>
                        <input type="text" class="form-control" name="name" value="<?= $subject['name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" value="<?= $subject['code'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lecturer</label>
                        <select name="lecturer" class="form-control" required>
                            <?php foreach ($lecturers as $key => $lecturer) { ?>
                                <option value="<?= $lecturer['id'] ?>" <?= $lecturer['id'] == $subject['teacher_id'] ? 'selected' : '' ?>><?= $lecturer['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>