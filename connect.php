<!DOCTYPE html>
<html>
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Report Portal</title>
    <link rel="stylesheet" href="styles.css?v=1.1">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('img/connect.png')no-repeat center center/cover;
        }

        .message {
            width: 320px;
            padding: 10px;
            text-align: center;
            font-size: 30px;
        }

        .success-message {
            color: black;     
        }

        .error-message {
            color: black;  
        }

        h2 {
            margin-top: 0;
        }

    </style>
<body>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "medhub"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("INSERT INTO patients (name, dob, address, gender, contact, guardian, admission_date, doctor, notes, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ssssssssss", $name, $dob, $address, $gender, $contact, $guardian, $admission_date, $doctor, $notes, $photo_path);


$name = $_POST['name'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$contact = $_POST['contact'];
$guardian = $_POST['guardian'];
$admission_date = $_POST['admission_date'];
$doctor = $_POST['doctor'];
$notes = $_POST['notes'];


$photo_path = null; 
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
    $target_dir = "uploads/";
    
    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

   
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo_path = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "No file uploaded or there was an error uploading the file.";
}


if ($stmt->execute()) {
    $last_id = $stmt->insert_id;
    echo "<div class='message success-message'>";
    echo "<h2>Patient Added Successfully!</h2>";
    echo "<p>Your Patient ID is: " . $last_id . "</p>";
    echo "</div>";
} else {
    echo "<div class='message error-message'>";
    echo "<h2>Error</h2>";
    echo "<p>There was an error adding the patient: " . $stmt->error . "</p>";
}


$stmt->close();
$conn->close();
?>

</body>
</html>
