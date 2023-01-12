<?php
include('../config/include.php');
include(asset('config/redirect.php'));
include(asset('controller/student-controller.php'));

$subjects = getStudentSubjects();

if (isset($_GET['delete'])) {
    dropSubject($_GET['delete']);
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
                    <h1>Subject</h1>

                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Subject Name</th>
                                <th scope="col">Code</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subjects as $key => $subject) { ?>
                                <tr>
                                    <th scope="row"><?= $key+1 ?></th>
                                    <td><?= $subject['subject_name'] ?></td>
                                    <td><?= $subject['subject_code'] ?></td>
                                    <td>
                                        <a href="<?= route('student/subject.php?delete='. $subject['idd']) ?>" class="btn btn-danger">Drop</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>