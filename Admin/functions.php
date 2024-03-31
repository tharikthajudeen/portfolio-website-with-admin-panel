<?php
// Start the session
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ict1920004";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which button was clicked based on the 'name' attribute
    if (isset($_POST["admin-login"])) {
        // Get form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query to retrieve user data based on the provided username
        $sql = "SELECT Username, Password FROM admin WHERE Username = '$username'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {

            // User exists, fetch the data
            $row = $result->fetch_assoc();

            $storedUsername = $row['Username'];
            $storedHashedPassword = $row['Password'];

            // Verify the entered password with the stored hashed password from the database
            if (password_verify($password, $storedHashedPassword)) {

                // Set session variable for logged-in user
                $_SESSION['username'] = $storedUsername;

                // Redirect to the admin panel
                header("Location: admin.php");
                exit;
            } else {
                // Password is incorrect
                $_SESSION['error_message'] = "Invalid username or password.";
                header("Location: admin-login.php");
            }

        } else {
            // User not found in the database
            $_SESSION['error_message'] = "Invalid username or password.";
            header("Location: admin-login.php");
        }
    }
}

mysqli_close($conn);
?>
