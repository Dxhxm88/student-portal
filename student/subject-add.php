<?php
include('../config/include.php');
include(asset('config/redirect.php'));
include(asset('controller/student-controller.php'));

$subjects = getSubjects();

if (isset($_POST['submit'])) {
    addSubject($_POST);
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
            <?php include(asset('student/inc/sidebar.php')) ?>

            <div class="col py-3">
                <div class="container">
                    <h1>Add Subject</h1>

                    <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <select name="subject" class="form-control" required>
                            <option value="">Please select subject</option>
                            <?php foreach ($subjects as $subject) { ?>
                                <option value="<?= $subject['id'] ?>"><?= $subject['name'] . " - "  . $subject['teacher_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>