<?php
session_start();


$con = mysqli_connect("localhost", "root", "", "users");

if (!$con) {
    die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    extract($_POST); 
    

 $username = isset($_SESSION['fullName']) ? $_SESSION['fullName'] : 'Guest';

    if (empty($rating_number)) {
        print("<script>alert('Please select a rating number'); window.history.back();</script>");
    } else {

      
        $sql = "INSERT INTO ratings (username, rating_number, user_comment) 
                VALUES ('$username', '$rating_number', '$user_comment')";

        if (mysqli_query($con, $sql)) {
          if ($username == 'Guest') {
                print("<script>alert('Thank you for your feedback!'); window.location.href='rating.php';</script>");
            } else {
                print("<script>alert('Thank you for your feedback!'); window.location.href='rating_logged.php';</script>");
            }
        } else {
            print("<script>alert('Error: " . mysqli_error($con) . "'); window.history.back();</script>");
        }
    }
}

mysqli_close($con);
?>