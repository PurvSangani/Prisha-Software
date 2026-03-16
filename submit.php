<?php
// Get data from the form
$name = $_POST['Name'];
$email = $_POST['Email'];
$phone = $_POST['Phone'];
$education = $_POST['Education'];
$skills = $_POST['Skills'];
$technology = $_POST['Technology'];
$joining = $_POST['JoiningAs'];

// Handle file upload
if(isset($_FILES['Resume'])){
    $file_name = $_FILES['Resume']['name'];
    $file_tmp = $_FILES['Resume']['tmp_name'];
    $upload_dir = "uploads/"; // make sure this folder exists
    move_uploaded_file($file_tmp, $upload_dir.$file_name);
}

// Show submitted data
echo "<h2>Form Submitted Successfully</h2>";
echo "Name: ".$name."<br>";
echo "Email: ".$email."<br>";
echo "Phone: ".$phone."<br>";
echo "Education: ".$education."<br>";
echo "Skills: ".$skills."<br>";
echo "Technology: ".$technology."<br>";
echo "Joining As: ".$joining."<br>";
if(isset($file_name)){
    echo "Resume Uploaded: ".$file_name."<br>";
}
?>