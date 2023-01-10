<?php
require(asset('controller/controller.php'));

function register($data)
{
    $name = $data['name'];
    $email = $data['email'];
    $matric = $data['matric'];
    $birthday = $data['birthday'];
    $address = $data['address'];
    $phone = $data['phone'];
    $password = $data['password'];
    $gender = $data['gender'];

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

    $query = "INSERT INTO students (name,email, matric, photo, birthday, address, phone, password, gender) 
    VALUES ('$name', '$email', '$matric', '$path', '$birthday', '$address', '$phone', '$password', '$gender')";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Student register successfully.");
        redirect(route('student/login.php'));
    } else {
        alert("Error register student ");
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

function login($data)
{
    $email = $data['email'];
    $password = $data['password'];
    $query = "SELECT * FROM students WHERE email='$email' AND password='$password'";

    $result = mysqlj($query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        $name = $row['name'];
        // User exists, log in
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $row['id'];
        alert("Login successfully!");
        redirect(route('student/'));
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

function getSubjects()
{
    $results = array();

    $query = "SELECT subjects.*, teachers.name as teacher_name FROM subjects INNER JOIN teachers ON subjects.teacher_id=teachers.id";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function addSubject($data)
{
    $id = $_SESSION['id'];
    $subject = $data['subject'];

    $query = "INSERT INTO student_subjects (subject_id,student_id) VALUES ('$subject', '$id')";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Subject added successfully.");
        redirect(route('student/subject.php'));
    } else {
        alert("Error add subject");
    }
}

function getStudentSubjects()
{
    $results = array();
    $id = $_SESSION['id'];

    $query = "SELECT *, subjects.name as subject_name, subjects.code as subject_code FROM student_subjects INNER JOIN subjects ON student_subjects.subject_id=subjects.id WHERE student_id=$id";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function dropSubject($id)
{
    global $conn;
    $query = "DELETE FROM student_subjects WHERE id=$id";
    $result = mysqlj($query);

    // Check if the DELETE statement was successful
    if ($result) {
        alert("Subject was deleted successfully.");
        redirect(route('student/subject.php'));
    } else {
        $ms = "Error deleting subject: " . mysqli_error($conn);
        alert($ms);
    }
}

function getSessions()
{
    $results = array();

    $query = "SELECT * FROM sessions";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function getResultBySession($student_id, $session_id)
{
    $results = array();

    $query = "SELECT *, sessions.name as session_name, subjects.name as subject_name, CASE
    WHEN results.grade >= 90 THEN 'A+'
    WHEN results.grade >= 80 THEN 'A'
    WHEN results.grade >= 70 THEN 'B'
    WHEN results.grade >= 60 THEN 'C'
    ELSE 'D' END AS grade_mark FROM results INNER JOIN sessions ON results.session_id=sessions.id 
    INNER JOIN subjects ON results.subject_id=subjects.id WHERE student_id=$student_id AND session_id=$session_id";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }else{
        alert("No result yet");
        // redirect(route('admin/result-view.php?student_id=' . $student_id));
        return;
    }

    return $results;
}

function getTotalSubjects()
{
    $id = $_SESSION['id'];
    $query = "SELECT * FROM student_subjects WHERE student_id=$id";
    $result = mysqlj($query);

    return $result->num_rows;
}

function getProfile()
{
    $id = $_SESSION['id'];

    $query = "SELECT * FROM students WHERE id=$id";
    $result = mysqlj($query);

    return mysqli_fetch_assoc($result);
}

function updateProfile($data)
{
    $id = $_SESSION['id'];
    $name = $data['name'];
    $email = $data['email'];
    $matric = $data['matric'];
    $birthday = $data['birthday'];
    $address = $data['address'];
    $phone = $data['phone'];
    $gender = $data['gender'];

    $query = "UPDATE students SET name='$name', email='$email', matric='$matric', birthday='$birthday', address='$address', phone='$phone', gender='$gender' WHERE id = $id";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Profile updated successfully.");
        redirect(route('student/'));
    } else {
        alert("Error update profile");
    }
}
