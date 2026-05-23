<?php

$con = new mysqli("localhost", "root", "", "users");

if ($con->connect_error) {
    die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name       = trim($_POST['name'] ?? '');
    $id         = trim($_POST['id'] ?? '');
    $dob        = trim($_POST['DoB'] ?? '');
    $nationality= trim($_POST['nat'] ?? '');
    $mobile     = trim($_POST['mobile'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $password   = trim($_POST['password'] ?? '');

    if (
        empty($name) ||
        empty($id) ||
        empty($dob) ||
        empty($nationality) ||
        empty($mobile) ||
        empty($email) ||
        empty($password)
    ) {
        print("<script>alert('Please fill all required fields'); window.history.back();</script>");

    } else {

        $stmt = $con->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            print("<script>alert('This email already has an account'); window.history.back();</script>");

        } else {

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $con->prepare("INSERT INTO users (fullname, national_id, dob, nationality, mobile, email, password) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssss", $name, $id, $dob, $nationality, $mobile, $email, $hashed);

            if ($stmt->execute()) {
                print("<script>alert('Welcome " . htmlspecialchars($name) . "!'); window.location.href='Book_ticket.html';</script>");
            } else {
                print("<script>alert('Error: " . $con->error . "');</script>");
            }
        }
    }
}

mysqli_close($con);
?>