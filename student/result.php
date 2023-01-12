<?php
include('../config/include.php');
include(asset('config/redirect.php'));
include(asset('controller/student-controller.php'));

$sessions = getSessions();

if (isset($_POST['submit'])) {
    $results = getResultBySession($_SESSION['id'], $_POST['session']);
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
                    <h1>View Result</h1>

                    <div class="mt-3">
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">Session</label>
                                <select name="session" class="form-control" required>
                                    <option value="">Please select session</option>
                                    <?php foreach ($sessions as $key => $session) { ?>
                                        <option value="<?= $session['id'] ?>"><?= $session['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Get Result</button>
                        </form>
                    </div>

                    
                    <?php if (isset($results)) { ?>
                        <div class="mt-3">
                            <button class="btn btn-secondary" onclick="printSection()">Print</button>
                        </div>
                        <div class="container mt-5" id="print">
                            <h1 class="display-4 font-weight-bold text-center mb-5">Exam Results</h1>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="print">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Marks</th>
                                            <th>Grade</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalGpa = 0.0;
                                        foreach ($results as $result) {
                                            $totalGpa = $totalGpa + $result['gpa'];
                                        ?>
                                            <tr>
                                                <td><?= $result['subject_name'] ?></td>
                                                <td><?= $result['grade'] ?></td>
                                                <td><?= $result['grade_mark'] ?></td>
                                                <td><?= $result['gpa'] ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">GPA</td>
                                            <td>
                                                <?= $totalGpa / count($results) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">CGPA</td>
                                            <td><?= getCGPA() ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printSection() {
            var section = document.getElementById('print');
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>Print</title></head><body>');
            printWindow.document.write(section.innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>