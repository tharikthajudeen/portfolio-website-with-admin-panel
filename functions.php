<?php
// Start the session
session_start();

// Database configuration
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
    if (isset($_POST["signup"])) {
        // Retrieve form data for insert
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the data into the database
        $sql = "INSERT INTO users (Username, Password)
                VALUES ('$username', '$hashedPassword')";

        if (mysqli_query($conn, $sql)) {
            // Redirect to the index page after successful signup
            header("Location: index.php");
            exit;
        } else {
            // Redirect back to the signup page with an error message
            header("Location: signup.php");
            $_SESSION['error_message'] = "Error inserting record: " . mysqli_error($conn);
        }
    } else if (isset($_POST["login"])) {
        // Get form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query to retrieve user data based on the provided username
        $sql = "SELECT Username, Password FROM users WHERE Username = '$username'";
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

                // Redirect to the home page after successful login
                header("Location: home.php");
                exit;
            } else {
                // Redirect back to the index page with an error message
                header("Location: index.php");
                $_SESSION['error_message'] = "Invalid username or password.";
            }
        } else {
            // Redirect back to the index page with an error message
            header("Location: index.php");
            $_SESSION['error_message'] = "Invalid username or password.";
        }
    }
}

mysqli_close($conn);
?>
