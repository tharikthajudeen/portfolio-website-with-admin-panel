<?php
// Functions definition

// Function to validate form data
function validateForm()
{
    $errors = array();

    if (empty($_POST["title"])) {
        $errors[] = "Title field is required.";
    }

    if (empty($_POST["description"])) {
        $errors[] = "Description field is required.";
    }

    // Check if the Image field is empty
    if (empty($_FILES["image"]["tmp_name"])) {
        $errors[] = "Image field is required.";
    }

    return $errors;
}

// Function to connect to the database
function connectDatabase()
{
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

    return $conn;
}

// Function to insert a project into the database
function insertProject($title, $description, $image)
{
    $conn = connectDatabase();

    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $image = addslashes(file_get_contents($image));

    $sql = "INSERT INTO project (Title, Description, Image)
            VALUES ('$title', '$description', '$image')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    } else {
        echo "Error inserting record: " . mysqli_error($conn);
        mysqli_close($conn);
        return false;
    }
}

// Function to retrieve projects from the database
function getProjects()
{
    $conn = connectDatabase();

    $sql = "SELECT * FROM project";
    $result = mysqli_query($conn, $sql);
    $projects = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $projects[] = $row;
        }
    }

    mysqli_close($conn);
    return $projects;
}

// Function to update a project in the database
function updateProject($title, $description, $image)
{
    $conn = connectDatabase();

    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $image = addslashes(file_get_contents($image));

    $sql = "UPDATE project SET Description='$description', Image='$image' WHERE Title='$title'";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
        mysqli_close($conn);
        return false;
    }
}

// Function to delete a project from the database
function deleteProject($id)
{
    $conn = connectDatabase();

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM project WHERE ID=$id";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        mysqli_close($conn);
        return false;
    }
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check for validation errors
    $errors = array();
    if (empty($errors)) {
        if (isset($_POST["insert"])) {
            $errors = validateForm();

            $title = $_POST["title"];
            $description = $_POST["description"];
            $image = $_FILES["image"]["tmp_name"];
            insertProject($title, $description, $image);
            header("Location: admin.php");
            exit;
        } elseif (isset($_POST["update"])) {
            $errors = validateForm();
            
            $title = $_POST["title"];
            $description = $_POST["description"];
            $image = $_FILES["image"]["tmp_name"];
            updateProject($title, $description, $image);
            header("Location: admin.php");
            exit;
        } elseif (isset($_POST["delete"])) {
            $id = $_POST["delete_id"];
            deleteProject($id);
            header("Location: admin.php");
            exit;
        }
    } else {
        // Display error messages to the user if there are any validation errors
        print_r($errors);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tharik Thajudeen</title>
    <link rel='stylesheet' href="../Style/Admin-Style.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="../Image/dp.png" alt="Company Logo">
            <h1>Tharik Thajudeen</h1>
            <h6>Software Engineer</h6>
        </div>
        <a href="admin.php">Submit Project</a>
        <form method="post" action="">
            <div style="text-align: center; margin: 0px">
                <input type="submit" name="logout" value="Logout">
            </div>
        </form>
    </div>

    <?php
    // Logout functionality (optional)
    if (isset($_POST["logout"])) {
        // Destroy the session
        session_destroy();
        
        // Redirect to the login page or any other page after logout
        header("Location: admin-login.php");
        exit;
    }
    ?>

    <!-- Content -->
    <div class="content">
        <div id="submit-section">
            <h2>Submit Project</h2><br>
            <form action="admin.php" method="post" enctype="multipart/form-data">
                <!-- Title Field -->
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required><br><br>

                <!-- Description Field -->
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" required></textarea><br><br>

                <!-- Image Field -->
                <label for="image">Image:</label><br>
                <input type="file" name="image" id="image" accept="image/*"><br><br>

                <!-- Insert Button -->
                <input type="submit" name="insert" value="Insert">

                <!-- Update Button -->
                <input type="submit" name="update" value="Update">
            </form><br><br>
        </div>

        <div id="project-list">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php
                // Retrieve data from the "projects" table and display it in the table
                $projects = getProjects();
                foreach ($projects as $row) {
                    echo "<tr>";
                    echo "<td>{$row['ID']}</td>";
                    echo "<td>{$row['Title']}</td>";
                    echo "<td>{$row['Description']}</td>";
                    echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" /></td>';
                    echo "<td>";
                    echo "<form action=\"admin.php\" method=\"POST\" enctype=\"multipart/form-data\">";
                    echo "<input type=\"hidden\" name=\"delete_id\" value=\"" . $row['ID'] . "\">";
                    echo "<button type=\"submit\" name=\"delete\" onclick=\"return confirm('Are you sure you want to delete this project?')\">Delete</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
