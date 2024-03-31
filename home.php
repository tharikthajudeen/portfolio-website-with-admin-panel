<?php
// Start the session
session_start();

// Function to establish a database connection
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

// Function to retrieve projects from the database
function getProjects()
{
    $conn = connectDatabase();

    // Retrieve project data from the database
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

// Function to insert a contact into the database
function insertContact($name, $email, $message)
{
    $conn = connectDatabase();

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $message = mysqli_real_escape_string($conn, $message);

    $sql = "INSERT INTO contact (Name, Email, Message)
            VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    } else {
        echo "Error inserting record: " . mysqli_error($conn);
        mysqli_close($conn);
        return false;
    }
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($errors)) {
        if (isset($_POST["contact"])) {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $message = $_POST["message"];
            insertContact($name, $email, $message);
            header("Location: home.php");
            exit;
        }
    } else {
        // Display error messages to the user if there are any validation errors
        print_r($errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Tharik Thajudeen</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Style/Home-Styles.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="Script/script.js"></script>

    <style>
      .slider-container {
      width: 600px;
      height: 400px;
      overflow: hidden;
      position: relative;
    }
    
    .slider-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    </style>
</head>
<body>

<!-- Home Section start -->
<section id="home">
    <div class="all">
    <nav>
        <div class="logo-container">
            <img src="Image/logo.png" class="logo" alt="Company Logo">
            <h1 class="company-name"></h1>
        </div>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#education">Education</a></li>
            <li><a href="#project-achievements">Projects</a></li>
            <li><a href="#experience">Experience</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li>
                <form method="post" action="">
                    <input type="submit" name="logout" value="Admin">
                </form>
            </li>
        </ul>
    </nav>

        <!-- Logout functionality (optional) -->
        <?php
            if (isset($_POST["logout"])) {
                session_destroy();
                header("Location: Admin/admin-login.php");
                exit;
            }
        ?>


        <div class="details">
            <h1>Hey! I'm <span>Tharik Thajudeen</span></h1>
            <h4><span id="typing-effect">Software Engineer</span></h4>
            <p>An organized, intelligent, and hardworking software engineer with an <br>
            best educational record and technical background. I enjoy overcoming <br>
            challenges, and I have a genuine interest in software engineering and <br>
            making organizations successful. I am delivering unique and effective<br>
            content to develop rapid
            software.</p>

            <div class="skills">
                <h1 class="php">PHP</h1>
                <h1 class="sql">SQL</h1>
                <h1 class="react">REACT</h1>
                <h1 class="node">NODE</h1>
            </div>
            
        </div>
            
            <div class="images">
               <img src="Image/robo.png" class="boy">
            </div>
    </div>
    <div class="portfolio-item">
        <img src="Image/work.webp" alt="Portfolio Item">
        <div class="overlay">
            <h3>Now I'm Working on this type of projects</h3>
            <h1>Artificial Intelligence (AI)</h1>
            <p>Artificial Intelligence (AI) is a field of computer science that focuses on creating intelligent machines capable of performing tasks that typically require human intelligence. AI technology encompasses a wide range of techniques, algorithms, and methodologies that enable machines to perceive, reason, learn, and make decisions.</p>
        </div>
    </div>
</section>
<!-- Home Section End -->
 


<!----About Section start---->
    <section id="about">
    <section  class="about">
        <div class="main">
            <div class="about-me">
                <h2>About</h2>
                <div class="text">
                <p>Hi there! I'm Tharik, a Software Engineer with over 5 years of experience creating beautiful and functional websites for clients across a variety of industries.

                    I've always been passionate about design and technology, and my journey into web design started when I taught myself how to code in University. Since then, I've honed my skills through a combination of self-study and hands-on experience, working with clients to create custom websites that reflect their unique brand and vision.
                    
                    My strengths as a developer lie in my ability to understand a client's needs and translate those into a cohesive and visually stunning website. Whether it's a small business looking to establish an online presence, or a larger organization in need of a full website redesign, I take pride in creating websites that are both aesthetically pleasing and user-friendly.
                    
                    At the heart of my work is a commitment to collaboration and communication. I believe that the best websites are the result of a partnership between the client and the developer, and I work closely with my clients throughout the Development process to ensure that their goals and vision are fully realized.
                    
                    If you're interested in learning more about my work or discussing a potential project, please don't hesitate to get in touch. I'd love to hear from you!                    
                </p><br>
                </div>
            </div>
            
        </div>
    </section>
</section>
<!----About Section End---->


<!----Education Section start---->
<section id="education">
<div class="service">
    <div class="title">
    <h2>My Education & Skills </h2>
    </div>
    <div class="box">
        <div class="card">
            <i class="fa-solid fa-user-graduate"></i>
            <h5>Bachelor of ICT</h5>
            <div class="pra">
                    <p>RAJARATA UNIVERSITY OF 
                    SRI LANAKA
                        2014-2018
                        </p>
                    <p>Relevant Coursework: Data Structures and Algorithms, Web Development, Human-Computer Interaction</p>
            </div>
        </div>

        <div class="card">
            <i class="fa-solid fa-user-graduate"></i>
            <h5>Certificate in Graphic Design</h5>
            <div class="pra">
            <p>GATWICK COLLAGE OF BUSINESS AND TECHNOLOGY
                2021
                </p>
            <p>Relevant Skills : Adobe Photoshop, Illustrator, InDesign, and Sketch, Branding and Identity, User Interface</p>
            </div>
        </div>

        <div class="card">
            <i class="fa-solid fa-user-graduate"></i>
            <h5>Diploma in Network Security</h5>
            <div class="pra">
                <p>RAJARATA UNIVERSITY OF 
                    SRI LANAKA
                    2019
                    </p>
                <p>Relevant Skills : Cryptography, Cloud Security, Compliance, Risk Management, Cloud Computing, Computer Hardware</p>
            </div>
        </div>
    </div>  

</div>
</section>
<!----Education Section End---->



<!----Projrct Achievement Section start---->
<section id="project-achievements">
    <div class="pa">
    <h2>Project Achievements</h2><br><br>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
        </tr>
        
        <?php
        // Retrieve data from the "projects" table and display it in the table
        $projects = getProjects();
        foreach ($projects as $row) {
            echo "<tr>";
            echo "<td>{$row['Title']}</td>";
            echo "<td>{$row['Description']}</td>";
            echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" /></td>';
            echo "</tr>";
        }
        ?>
    </table>
    </div>
</section>
<!----Project Achievement Section End---->

  

<!---- Experience Section start ---->
<section id="experience">
    <div class="experience-section">
        <div class="experience-title">
            <h2>Work Experience</h2>
        </div>
        <div class="experience-box">
            <div class="experience-card">
                <i class="fas fa-briefcase"></i>
                <h5>Software Engineer</h5>
                <div class="experience-details">
                    <p>4 AXIS SOLUTIONS (PVT) LTD</p>
                    <p>2020-2022</p>
                </div>
            </div>

            <div class="experience-card">
                <i class="fas fa-briefcase"></i>
                <h5>Associate Software Engineer</h5>
                <div class="experience-details">
                    <p>99X TECHNOLOGY</p>
                    <p>2019-2020</p>
                </div>
            </div>

            <div class="experience-card">
                <i class="fas fa-briefcase"></i>
                <h5>Network Engineer</h5>
                <div class="experience-details">
                    <p>4 AXIS SOLUTIONS (PVT) LTD</p>
                    <p>2016-2019</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!---- Experience Section End ---->




<!----Gallery start---->
<section id="gallery">
<div class="gallery">
    <h2>Gallery</h2>
    
    <div class="slider-container"> 
        <img class="slider-image" src="Image/cyber.jpg" alt="Image 1">             
        <img class="slider-image" src="Image/network.jpg" alt="Image 2">  
        <img class="slider-image" src="Image/software.jpg" alt="Image 3">
    </div>
</div>
</section>
<!----Gallery End---->



<!----footer start---->
<section id="contact">
<footer>
  <div class="contact-info">
    <p>For more Web Development, Graphic Design, and Cyber Security, contact me</p>
    <p>E-Mail : tharikbinthajudeen65@gmail.com</p>
    <div class="social">
      <a href="home.php"><i class="fa-brands fa-facebook"></i></a>
      <a href="home.php"><i class="fa-brands fa-instagram"></i></a>
      <a href="home.php"><i class="fa-brands fa-linkedin"></i></a>
    </div>
  </div>
</footer>
</section>
<!----footer End---->


</body>
</html>
