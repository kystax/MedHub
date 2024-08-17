<?php
header('Content-Type: application/json');

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

    $stmt = $conn->prepare("SELECT * FROM patients WHERE id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $patientId);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $photoPath = $row['photo'] ? $row['photo'] : null;

         
        error_log("Fetching data for patient ID: " . $patientId);
        error_log("Photo path: " . $photoPath);

        echo json_encode([
            "success" => true,
            "name" => $row['name'],
            "dob" => $row['dob'],
            "address" => $row['address'],
            "gender" => $row['gender'],
            "contact" => $row['contact'],
            "guardian" => $row['guardian'],
            "admission_date" => $row['admission_date'],
            "doctor" => $row['doctor'],
            "notes" => $row['notes'],
            "photo" => $photoPath
        ]);
    } else {
        echo json_encode(["success" => false]);
    }

    $stmt->close();
}

$conn->close();
?>
