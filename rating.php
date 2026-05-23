<?php

$con = new mysqli("localhost", "root", "", "users");

if ($con->connect_error) {
    die("Connection failed");
}

$sql = "SELECT * FROM ratings ORDER BY id DESC";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Rating</title>
    <link rel="stylesheet" href="Style1.css">
    <meta http-equiv="refresh" content="43200">
    
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger intent="WELCOME" chat-title="SAR" agent-id="16ee76fc-1263-44cc-a00b-39bc383b907c" language-code="en"></df-messenger>
</head>
<body>

    <header>
        <div class="social">
            <a href="https://www.linkedin.com/company/sarsaudirailway/?trk=similar-companies_org_title"><img src="1.png" width="40px" height="40px"></a> 
            <a href="https://x.com/SARSaudiRailway"><img src="2.png" width="40px" height="40px"></a>
            <img src="3.png"> <br> customercare@sar.com.sa
            <img src="4.png"> <br> 8001262000
        </div>
        <div class="imam">
             <img src="vision-2030.png" width="80px" height="60px">
            <img src="Collage.png" width="60px" height="60px">
            <img src="Imam.png" width="40px" height="60px">
        </div>
    </header>


    <nav>
		<ul>
			<li><a href="MainPage.html">Home</a>
        <ul>
          <li><a href="travel.html">Travel with SAR</a></li>
        </ul>
        </li>
			<li><a href="Gallary.html">Gallery</a></li>
      <li><a href="About_Us.html">About Us</a></li>
       
			<li><a href="create_account.html">Create Account</a></li>
			<li><a href="Sign_in_Page.html">Sign in</a></li>
             <li><a href="rating.php">ِRating</a></li>
           
		</ul>
	</nav>

    <div class="container">
        <h2>Rate Your Experience with SAR </h2>
        <div class="input-box">
            <form action="submit_rating.php" method="POST" id="ratingForm">
                <label for="rating_number">Your Rating:</label>
                <select name="rating_number" id="rating_number" required>
                    <option value="">Select a rating</option>
                    <option value="5"> (5 - Excellent)</option>
                    <option value="4"> (4 - Very Good)</option>
                    <option value="3"> (3 - Good)</option>
                    <option value="2"> (2 - Fair)</option>
                    <option value="1"> (1 - Poor)</option>
                </select>

                <label>Your Feedback (Optional):</label>
                <textarea name="user_comment" id="user_comment" rows="4" placeholder="Tell us about your experience with SAR..."></textarea>

                <br>
                <input type="submit" value="Submit Rating">
            </form>
        </div>

        <hr style="margin: 40px 0; border: 1px solid rgba(106, 143, 255, 0.568);">
        
        <div>
            <h3>Previous Reviews</h3>
            <?php 
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    print("<div style='border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; background-color: #f9f9f9; color: #000;'>");
                    print("<strong>👤 " . htmlspecialchars($row['username']) . "</strong> | ⭐ Rating: " . $row['rating_number'] . "/5<br>");
                    print("<p style='margin: 5px 0 0 0;'>" . htmlspecialchars($row['user_comment']) . "</p>");
                    print("<p style='font-size=10pt'>  Date: " . $row['created_at']. "</p>");
                    print("</div>");
                }
            } else {
                print("<p>No reviews yet. Be the first to rate us!</p>");
            }
            $con->close();
            ?>
        </div>
    </div>

    <div class="footer">
        <p> &copy; 2nd-2025-26 / IMSIU / CCIS &trade;</p>
    </div>

</body>
</html>