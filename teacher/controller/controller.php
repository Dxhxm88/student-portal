<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
    $query = "SELECT * FROM teachers WHERE email='$email' AND password='$password'";

    $result = mysqlj($query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        $name = $row['name'];
        // User exists, log in
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $row['id'];
        $_SESSION['status'] = $row['status'];
        alert("Login successfully!");
        redirect(route('teacher/'));
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

function getTotalQuery()
{
    $id = $_SESSION['id'];

    $query = "SELECT * FROM query WHERE teacher_id=$id";
    $result = mysqlj($query);

    return $result->num_rows;
}

function getQueries()
{
    $results = array();
    $id = $_SESSION['id'];

    $query = "SELECT * FROM query WHERE teacher_id=$id";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function getProfile()
{
    $results = array();
    $id = $_SESSION['id'];

    $query = "SELECT * FROM teachers WHERE id=$id";
    $result = mysqlj($query);

    return mysqli_fetch_assoc($result);
}

function getSubjects()
{
    $results = array();

    $query = "SELECT * FROM subjects";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function editProfile($data)
{
    $id = $_SESSION['id'];
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
        alert("Profile updated successfully.");
        redirect(route('teacher/'));
    } else {
        alert("Error updating profile");
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

function changepassword($data)
{
    $cpassword = $data['cpass'];
    $newpassword = $data['npass'];
    $id = $_SESSION['id'];

    $query = "select * from teachers where id='$id' and password='$cpassword'";
    $result = mysqlj($query);

    $row = mysqli_fetch_array($result);
    if ($row > 0) {
        $q2 = "update teachers set password='$newpassword' where id='$id'";
        $result2 = mysqlj($q2);

        // Check if the UPDATE statement was successful
        if ($result2) {
            alert("Password updated successfully.");
            redirect(route('teacher/'));
        } else {
            alert("Error updating password");
        }
    } else {
        alert("Your current password is wrong!");
    }
}

function register($data)
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
    $password = $data['password'];

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

    $query = "INSERT INTO teachers (name,email, phone, address, qualification, experience, subject_id, description, created, photo, password) VALUES 
    ('$name', '$email', '$phone', '$address', '$qualification', '$experience', '$subject', '$description', '$created', '$path', '$password')";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Teacher register successfully.");
        redirect(route('teacher/login.php'));
    } else {
        alert("Error register teacher");
    }
}

function getTeachers()
{
    $results = array();

    $query = "SELECT teachers.*, subjects.name as subject_name FROM teachers INNER JOIN subjects ON teachers.subject_id=subjects.id WHERE status='public'";
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

    $query = "SELECT teachers.*, subjects.name as subject_name FROM teachers INNER JOIN subjects ON teachers.subject_id=subjects.id WHERE teachers.id=$id";
    $result = mysqlj($query);

    return mysqli_fetch_assoc($result);
}

function addQuery($data, $id)
{
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $message = $data['message'];
    $created = date("Y-m-d");

    $query = "INSERT INTO query (name,email, phone, message, created, teacher_id) VALUES ('$name', '$email', '$phone', '$message', '$created', '$id')";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Message sent successfully.");
        redirect(route('teacher-detail.php?teacher_id=' . $id));
    } else {
        alert("Error add message");
    }
}