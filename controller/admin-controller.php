<?php 
require(asset('controller/controller.php'));

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

function addSession($data)
{
    $name = $data['name'];
    $status = $data['status'];

    $query = "INSERT INTO sessions (name,status) VALUES ('$name', '$status')";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Session added successfully.");
        redirect(route('admin/session.php'));
    } else {
        alert("Error add session");
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

function getSession($id)
{
    $data = array();
    $query = "SELECT * FROM sessions WHERE id=$id";
    $result = mysqlj($query);

    return mysqli_fetch_assoc($result);
}

function deleteSession($id)
{
    global $conn;
    $query = "DELETE FROM sessions WHERE id=$id";
    $result = mysqlj($query);

    // Check if the DELETE statement was successful
    if ($result) {
        alert("Session was deleted successfully.");
        redirect(route('admin/session.php'));
    } else {
        $ms = "Error deleting session: " . mysqli_error($conn);
        alert($ms);
    }
}

function updateSession($data, $id)
{
    $name = $data['name'];
    $status = $data['status'];

    $query = "UPDATE sessions SET name='$name', status='$status' WHERE id = $id";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Session updated successfully.");
        redirect(route('admin/session.php'));
    } else {
        alert("Error update session");
    }
}

function getStudents()
{
    $results = array();

    $query = "SELECT * FROM students";
    $result = mysqlj($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }

    return $results;
}

function getLecturers()
{
    $results = array();

    $query = "SELECT * FROM teachers";
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
    $name = $data['name'];
    $code = $data['code'];
    $lecturer = $data['lecturer'];

    $query = "INSERT INTO subjects (name,code, teacher_id) VALUES ('$name', '$code', '$lecturer')";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Subject added successfully.");
        redirect(route('admin/subject.php'));
    } else {
        alert("Error add subject");
    }
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

function deleteSubject($id)
{
    global $conn;
    $query = "DELETE FROM subjects WHERE id=$id";
    $result = mysqlj($query);

    // Check if the DELETE statement was successful
    if ($result) {
        alert("Subject was deleted successfully.");
        redirect(route('admin/subject.php'));
    } else {
        $ms = "Error deleting subject: " . mysqli_error($conn);
        alert($ms);
    }
}

function getSubject($id)
{
    $data = array();
    $query = "SELECT * FROM subjects WHERE id=$id";
    $result = mysqlj($query);

    return mysqli_fetch_assoc($result);
}

function updateSubject($data, $id)
{
    $name = $data['name'];
    $code = $data['code'];
    $lecturer = $data['lecturer'];

    $query = "UPDATE subjects SET name='$name', code='$code', teacher_id='$lecturer' WHERE id = $id";
    $result = mysqlj($query);

    // Check if the UPDATE statement was successful
    if ($result) {
        alert("Subject updated successfully.");
        redirect(route('admin/subject.php'));
    } else {
        alert("Error update subject");
    }
}

function getProfile()
{
    $id = $_SESSION['id'];
    $query = "SELECT * FROM admins WHERE id=$id";
    $result = mysqlj($query);

    return mysqli_fetch_assoc($result);
}

function updateProfile($data)
{
    $id = $_SESSION['id'];
    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];
    $npassword = $data['npassword'];

    $r = "SELECT * FROM admins WHERE id=$id AND password='$password'";
    $f = mysqlj($r);

    if (mysqli_num_rows($f) > 0) {

        $query = "UPDATE admins SET name='$name', email='$email', password='$npassword' WHERE id = $id";
        $result = mysqlj($query);
    
        // Check if the UPDATE statement was successful
        if ($result) {
            alert("Profile updated successfully.");
            redirect(route('admin/profile.php'));
        } else {
            alert("Error update profile");
        }
    }else{
        alert("Password not match");
        redirect(route('admin/profile.php'));
    }
}

function getTotalStudents()
{
    $query = "SELECT * FROM students";
    $result = mysqlj($query);

    return $result->num_rows;
}
function getTotalLecturers()
{
    $query = "SELECT * FROM teachers";
    $result = mysqlj($query);

    return $result->num_rows;
}
function getTotalSubjects()
{
    $query = "SELECT * FROM subjects";
    $result = mysqlj($query);

    return $result->num_rows;
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