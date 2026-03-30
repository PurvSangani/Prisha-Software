<?php

// Show errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 1️⃣ Database connection
$host = "localhost";      // XAMPP default
$dbname = "prisha_software"; // your database name
$username = "root";       // XAMPP default
$password = "";           // XAMPP default has no password

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2️⃣ Check if form submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // 3️⃣ Get form data safely
    $name = htmlspecialchars($_POST['Name']);
    $email = ($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $education = htmlspecialchars($_POST['Education']);
    $skills = htmlspecialchars($_POST['Skills']);
    $technology = htmlspecialchars($_POST['technology']);
    $joining = htmlspecialchars($_POST['Joining']);

    // 4️⃣ Handle file upload
    $upload_dir = "uploads/";
    $uploaded_file = "";

    if(isset($_FILES['resume']) && $_FILES['resume']['error'] == 0){
        $file_name = basename($_FILES['resume']['name']);
        $file_tmp = $_FILES['resume']['tmp_name'];
        $target_file = $upload_dir . $file_name;

        // Only allow PDF/DOC/DOCX
        $allowed_types = ['pdf','doc','docx'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if(in_array($file_ext, $allowed_types)){
            if(move_uploaded_file($file_tmp, $target_file)){
                $uploaded_file = $file_name;
            } else {
                die("Error uploading file.");
            }
        } else {
            die("Invalid file type. Only PDF/DOC/DOCX allowed.");
        }
    }

    // 5️⃣ Insert data into database using prepared statement
    $stmt = $conn->prepare("INSERT INTO career_applications (name,email,phone,education,skills,technology,joining_as,resume) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $name, $email, $phone, $education, $skills, $technology, $joining, $uploaded_file);

    if($stmt->execute()){
        echo "<h2>Form Submitted Successfully!</h2>";
        echo "Name: $name<br>";
        echo "Email: $email<br>";
        echo "Phone: $phone<br>";
        echo "Education: $education<br>";
        echo "Skills: $skills<br>";
        echo "Technology: $technology<br>";
        echo "Joining As: $joining<br>";
        echo "Resume: $uploaded_file<br>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>