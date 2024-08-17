<?php
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "medhub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department = $_POST['department'];
    $doctor = $_POST['doctor'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $sql = "INSERT INTO appointments (department, doctor, name, email, appointment_date, appointment_time) 
            VALUES ('$department', '$doctor', '$name', '$email', '$appointment_date', '$appointment_time')";

    if ($conn->query($sql) === TRUE) {
        echo "New appointment created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
