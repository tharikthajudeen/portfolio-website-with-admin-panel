<?php
session_start(); // Start a session to store data between page loads
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login Page</title>
  
  <link rel="stylesheet" href="../Style/Form-Style.css"> <!-- Include external stylesheet -->
</head>
<body>
    <div class="container">
        <form action="functions.php" method="POST" class="admin-login">
            <h2>Admin Login Page</h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="admin-login">Log In</button><br>
            <a href="../home.php" style="text-decoration: none;">Login as User!</a><br>

            <?php
            // Check if there are any error messages in the session
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error-box">' . $_SESSION['error_message'] . '</div>';
                // Clear the error message after displaying it once
                unset($_SESSION['error_message']);
            }
            ?>

        </form>
    </div>
</body>
</html>
