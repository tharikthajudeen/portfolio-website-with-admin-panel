<!DOCTYPE html>
<html>
<head>
    <title>Form Processing</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Function to sanitize input data
        function sanitizeInput($data) {
            return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
        }

        // Function to validate name field
        function validateName($name) {
            return preg_match('/^[a-zA-Z\s]+$/', $name);
        }

        // Function to validate email field
        function validateEmail($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        // Function to sanitize and validate message field
        function sanitizeAndValidateMessage($message) {
            // Strip tags to remove any HTML tags from the message
            $sanitizedMessage = strip_tags($message);
            // You can add additional validation rules for the message field if needed
            return $sanitizedMessage;
        }

        // Get form data and sanitize/validate
        $name = sanitizeInput($_POST['name']);
        $email = sanitizeInput($_POST['email']);
        $message = sanitizeAndValidateMessage($_POST['msg']);

        // Perform validation and display appropriate error messages
        $errors = array();

        if (!validateName($name)) {
            $errors['name'] = "Name should contain only letters and spaces.";
        }

        if (!validateEmail($email)) {
            $errors['email'] = "Invalid email format.";
        }

        // Additional validation for message field can be added here if required.

        // If there are no errors, you can proceed with further actions (e.g., sending an email).
        if (empty($errors)) {
            // Perform any further actions with the validated and sanitized data.
            // For example, send an email with the form details.
            // Make sure to use a secure email library to prevent email injection attacks.

            // Display a success message or redirect the user to a thank-you page.
            echo "<h2>Thank you! Your form has been submitted successfully.</h2>";
        } else {
            // If there are errors, display them to the user.
            // You can customize the error messages and formatting as needed.
            echo "<h2>Error(s) encountered while processing the form:</h2>";
            foreach ($errors as $error) {
                echo "<p>- " . $error . "</p>";
            }
        }
    }
    ?>
</body>
</html>
