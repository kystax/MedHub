<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medhub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $patientId = $_GET['id'];

    $stmt = $conn->prepare("SELECT photo FROM patients WHERE id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $patientId);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $photo = $row['photo'];
        
        if ($photo) {
            header('Content-Type: image/jpeg');  
            echo $photo;
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    } else {
        header("HTTP/1.0 404 Not Found");
    }

    $stmt->close();
} else {
    header("HTTP/1.0 400 Bad Request");
}

$conn->close();
?>
