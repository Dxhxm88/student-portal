<?php
require(asset('controller/controller.php'));

function register($data)
{
    $name = $data['name'];
    $email = $data['email'];
    $matric = $data['matric'];
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

    $query = "INSERT INTO teachers (name,email, lecturer_id, photo, address, phone, password, gender) 
    VALUES ('$name', '$email', '$matric', '$path', '$address', '$phone', '$password', '$gender')";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Lecturer register successfully.");
        redirect(route('lecturer/login.php'));
    } else {
        alert("Error register lecturer ");
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
    $query = "SELECT * FROM teachers WHERE email='$email' AND password='$password'";

    $result = mysqlj($query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        $name = $row['name'];
        // User exists, log in
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $row['id'];
        alert("Login successfully!");
        redirect(route('lecturer/'));
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

function getStudents()
{
    $results = array();
    $ids = getStudentSubject();
    $in = '(' . implode(',', $ids) . ')';

    $query = "SELECT * FROM students WHERE id IN $in";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function getStudentSubject()
{
    $results = array();
    $id = $_SESSION['id'];

    $query = "SELECT student_id FROM student_subjects WHERE subject_id IN (SELECT id FROM subjects WHERE teacher_id=$id)";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row['student_id'];
        }
    }

    return $results;
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

function getSubjects()
{
    $results = array();
    $id = $_SESSION['id'];

    $query = "SELECT * FROM subjects WHERE teacher_id=$id";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function addMark($data, $student_id)
{
    $grade = $data['grade'];
    $subject = $data['subject'];
    $session = $data['session'];

    $query = "INSERT INTO results (session_id,student_id, subject_id, grade) VALUES ('$session', '$student_id', '$subject', '$grade')";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Result added successfully.");
        redirect(route('lecturer/result.php'));
    } else {
        alert("Error add result");
    }
}

function getTotalSubjects()
{
    $id = $_SESSION['id'];
    $query = "SELECT * FROM subjects WHERE teacher_id=$id";
    $result = mysqlj($query);

    return $result->num_rows;
}

function getProfile()
{
    $id = $_SESSION['id'];
    $query = "SELECT * FROM teachers WHERE id=$id";
    $result = mysqlj($query);

    return  mysqli_fetch_assoc($result);

}

function updateProfile($data)
{
    $id = $_SESSION['id'];
    $name = $data['name'];
    $email = $data['email'];
    $matric = $data['matric'];
    $address = $data['address'];
    $phone = $data['phone'];
    $gender = $data['gender'];

    $query = "UPDATE teachers SET name='$name', email='$email', lecturer_id='$matric', address='$address', phone='$phone', gender='$gender' WHERE id = $id";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Profile updated successfully.");
        redirect(route('lecturer/'));
    } else {
        alert("Error update profile");
    }
}