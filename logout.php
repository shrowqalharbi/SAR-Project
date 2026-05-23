<?php

session_start();


session_destroy(); 


print("<script>alert('You have successfully logged out.'); window.location.href='MainPage.html';</script>");
?>