<?php
session_start();

$con = new mysqli("localhost", "root", "", "users");

if ($con->connect_error) {
    die("Connection failed");
}

if (isset($_POST['login'])) {

    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['pass'] ?? '');

    if (empty($email) || empty($password)) {
        print("<script>alert('Please enter email and password'); window.history.back();</script>");

    } else {

        $stmt = $con->prepare("SELECT fullname, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {

            print("<script>alert('No account found. Please create an account first'); window.location.href='create_account.html';</script>");

        } else {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {

                $_SESSION['fullName'] = $row['fullname'];

              print("<script>sessionStorage.setItem('userName', '" . $row['fullname'] . "'); alert('Welcome " . $row['fullname'] . "!'); window.location.href='Book_ticket.html';</script>");
            } else {
                print("<script>alert('Incorrect email or password'); window.history.back();</script>");
            }
        }
    }
}

mysqli_close($con);
?>