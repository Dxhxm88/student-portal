<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// if(isset($_SESSION['email'])) {
//     $path = route('admin/');
//     header("Location: $path");
// }

$conn = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);

// Check for connection errors
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

function mysqlj($query)
{
    global $conn;
    return mysqli_query($conn, $query);
}

function alert($message, $color = "alert-primary")
{
    $_SESSION['alert'] = $message;
    $_SESSION['color'] = $color;
    echo "<script>alert('$message');</script>";
}

function redirect($path)
{
    echo "<script>setTimeout(function() {window.location.href = '$path';}, 0);</script>";
}

function login($data)
{
    $email = $data['email'];
    $password = $data['password'];
    $query = "SELECT * FROM admins WHERE email='$email' AND password='$password'";

    $result = mysqlj($query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        $name = $row['name'];
        // User exists, log in
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $row['id'];
        alert("Login successfully!");
        redirect(route('admin/'));
    } else {
        // User does not exist, display an error message
        alert("Invalid username or password");
    }
}

function logout()
{
    session_destroy();
    $path = route('');
    header("Location: $path");
}

function getTotalSubjects()
{
    $query = "SELECT * FROM subjects";
    $result = mysqlj($query);

    return $result->num_rows;
}

function getTotalTeachers()
{
    $query = "SELECT * FROM teachers";
    $result = mysqlj($query);

    return $result->num_rows;
}

function getTotalTeachersPublic()
{
    $query = "SELECT * FROM teachers WHERE status='public'";
    $result = mysqlj($query);

    return $result->num_rows;
}

function getTotalTeachersNotPublic()
{
    $query = "SELECT * FROM teachers WHERE status='not public'";
    $result = mysqlj($query);

    return $result->num_rows;
}

function getSubjects()
{
    $results = array();
    $id = $_SESSION['id'];

    $query = "SELECT * FROM subjects";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function getSubject($id)
{
    $query = "SELECT * FROM subjects WHERE id=$id";
    $result = mysqlj($query);

    return mysqli_fetch_assoc($result);
}

function updateSubject($data, $id)
{
    $name = $data['name'];
    $code = $data['code'];

    $query = "UPDATE subjects SET name='$name', code='$code' WHERE id = $id";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Subject updated successfully.");
        redirect(route('admin/subject.php'));
    } else {
        alert("Error updating subject");
    }
}

function addSubject($data)
{
    $name = $data['name'];
    $code = $data['code'];

    $query = "INSERT INTO subjects (name,code) VALUES ('$name', '$code')";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Subject added successfully.");
        redirect(route('admin/subject.php'));
    } else {
        alert("Error add subject");
    }
}

function getTeachers()
{
    $results = array();

    $query = "SELECT teachers.*, subjects.name as subject_name FROM teachers INNER JOIN subjects ON teachers.subject_id= subjects.id ORDER BY id  asc";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function getTeacher($id)
{
    $query = "SELECT * FROM teachers WHERE id=$id";
    $result = mysqlj($query);

    return mysqli_fetch_assoc($result);
}

function updateTeacher($data, $id)
{
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $address = $data['address'];
    $qualification = $data['qualification'];
    $experience = $data['experience'];
    $subject = $data['subject'];
    $description = $data['description'];
    $created = $data['created'];
    $hasImage = false;

    $image = $data['photo'];

    if ($image['name'] != null) {
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_type = $image['type'];
        if (checkImage($image_type)) {
            $path = uploadAndGetPath($image_tmp_name, $image_name);
            $hasImage = true;
        } else {
            alert("Please upload image type only");
            return;
        }
    }

    if ($hasImage) {
        $query = "UPDATE teachers SET name='$name', email='$email', phone='$phone', address='$address', qualification='$qualification', 
        experience='$experience', subject_id='$subject', description='$description', created='$created', photo='$path' WHERE id = $id";
    } else {
        $query = "UPDATE teachers SET name='$name', email='$email', phone='$phone', address='$address', qualification='$qualification', 
        experience='$experience', subject_id='$subject', description='$description', created='$created' WHERE id = $id";
    }
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Teacher updated successfully.");
        redirect(route('admin/teacher.php'));
    } else {
        alert("Error updating teacher");
    }
}

function checkImage($image_type)
{
    // check if the file is an image
    if (strpos($image_type, 'image') === 0) {
        return true;
    }

    return false;
}

function uploadAndGetPath($image_tmp_name, $image_name)
{
    // file is an image, process the upload
    $image_path = "img/" . $image_name;
    move_uploaded_file($image_tmp_name, asset($image_path));

    return $image_path;
}

function getTeacherQuery($id)
{
    $results = array();

    $query = "SELECT * FROM query WHERE teacher_id=$id";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function addTeacher($data)
{
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $address = $data['address'];
    $qualification = $data['qualification'];
    $experience = $data['experience'];
    $subject = $data['subject'];
    $description = $data['description'];
    $created = $data['created'];

    $image = $data['photo'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_type = $image['type'];
    if (checkImage($image_type)) {
        $path = uploadAndGetPath($image_tmp_name, $image_name);
    } else {
        alert("Please upload image type only");
        return;
    }

    $query = "INSERT INTO teachers (name,email, phone, address, qualification, experience, subject_id, description, created, photo) VALUES 
    ('$name', '$email', '$phone', '$address', '$qualification', '$experience', '$subject', '$description', '$created', '$path')";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Teacher added successfully.");
        redirect(route('admin/teacher.php'));
    } else {
        alert("Error add teacher");
    }
}

function deleteTeacher($id)
{
    global $conn;
    $query = "DELETE FROM teachers WHERE id=$id";
    $result = mysqlj($query);

    // Check if the DELETE statement was successful
    if ($result) {
        alert("Teacher was deleted successfully.");
        redirect(route('admin/teacher.php'));
    } else {
        $ms = "Error deleting teacher: " . mysqli_error($conn);
        alert($ms);
    }
}

function getClasses()
{
    $results = array();

    $query = "SELECT * FROM kelas";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function addClass($data)
{
    $name = $data['name'];
    $created = date("Y-m-d");

    $query = "INSERT INTO kelas (name,created) VALUES ('$name', '$created')";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Class added successfully.");
        redirect(route('admin/kelas.php'));
    } else {
        alert("Error add class");
    }
}

function getClass($id)
{
    $query = "SELECT * FROM kelas WHERE id=$id";
    $result = mysqlj($query);

    return mysqli_fetch_assoc($result);
}

function updateClass($data, $id)
{
    $name = $data['name'];

    $query = "UPDATE kelas SET name='$name' WHERE id = $id";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Class updated successfully.");
        redirect(route('admin/kelas.php'));
    } else {
        alert("Error updating class");
    }
}

function getClassTimetable($id)
{
    $results = array();

    $query = "SELECT timetables.*, subjects.name as subject_name FROM timetables INNER JOIN subjects ON timetables.subject_id=subjects.id WHERE class_id=$id";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function generateTimetable($data)
{
    $slot = array();
    $output =  "<table class='table table-bordered'>
    <thead>
        <tr>
            <th>Time</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
        </tr>
    </thead>
    <tbody>";

    foreach ($data as $t) {
        $slot[$t['time']][$t['day']] = $t['subject_name'];
    }

    // return $slot;

    for ($i=8; $i<18; $i++) {
        $output .= "<tr>";
        $time = $i . ":00";
        $as = isset($slot[$i]) ? $slot[$i] : null;
        $monday = isset($as['monday']) ? $as['monday'] : " ";
        $tuesday = isset($as['tuesday']) ? $as['tuesday'] : " ";
        $wednesday = isset($as['wednesday']) ? $as['wednesday'] : " ";
        $thursday = isset($as['thursday']) ? $as['thursday'] : " ";
        $friday = isset($as['friday']) ? $as['friday'] : " ";
        $output .= "
                    <td class='text-center fw-bold'>$time</td>
                    <td>$monday</td>
                    <td>$tuesday</td>
                    <td>$wednesday</td>
                    <td>$thursday</td>
                    <td>$friday</td>
                    ";

        $output .= "</tr>";
        
    }

    $output.= "</tbody></table>";
    return $output;
}

function addDataTimetable($data, $id)
{
    $time = $data['time'];
    $day = $data['day'];
    $subject = $data['subject'];

    if (checkSlot($data, $id)) {
        alert("Slot not available");
        return;
    }

    $query = "INSERT INTO timetables (time,day, subject_id, class_id) VALUES ('$time', '$day', '$subject', $id)";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Timetable added successfully.");
        redirect(route('admin/timetable-view.php?class_id=' . $id));
    } else {
        alert("Error add timetable");
    }
}

function deleteTimetable($data, $id)
{
    global $conn;
    $time = $data['time'];
    $day = $data['day'];

    if (!checkSlot($data, $id)) {
        alert("Slot not exist");
        return;
    }

    $query = "DELETE FROM timetables WHERE time='$time' AND day='$day' AND class_id=$id";
    $result = mysqlj($query);

    // Check if the DELETE statement was successful
    if ($result) {
        alert("Data was deleted successfully.");
        redirect(route('admin/timetable-view.php?class_id=' . $id));
    } else {
        $ms = "Error deleting data: " . mysqli_error($conn);
        alert($ms);
    }

}

function checkSlot($data, $id)
{
    $time = $data['time'];
    $day = $data['day'];

    $query = "SELECT * FROM timetables WHERE class_id=$id AND time='$time' AND day='$day'";
    $result = mysqlj($query);

    return $result->num_rows > 0 ? true: false;
}
