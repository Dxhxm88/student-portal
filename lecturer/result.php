<?php
include('../config/include.php');
include(asset('config/redirect.php'));
include(asset('controller/lecturer-controller.php'));

$students = getStudents();
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
            <?php include(asset('lecturer/inc/sidebar.php')) ?>

            <div class="col py-3">
                <div class="container">
                    <h1>Manage Result</h1>

                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Matric No</th>
                                <th scope="col">Email</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $key => $student) { ?>
                                <tr>
                                    <th scope="row"><?= $key+1 ?></th>
                                    <td>
                                        <img src="<?= route($student['photo']) ?>" width="100" height="100">
                                    </td>
                                    <td><?= $student['name'] ?></td>
                                    <td><?= $student['matric'] ?></td>
                                    <td><?= $student['email'] ?></td>
                                    <td>
                                        <a href="<?= route('lecturer/result-view.php?student_id=' . $student['id']) ?>" class="btn btn-primary">View Result</a>
                                        <a href="<?= route('lecturer/result-add.php?student_id=' . $student['id']) ?>" class="btn btn-info">Add Result</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>