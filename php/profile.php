<?php
require_once '../vendor/autoload.php';

// MySQL Connection
$server = "localhost";
$serverusername = "root";
$serverpassword = "viveksingh__1729";
$dbname = "vivek-auth";

$conn = new mysqli($server, $serverusername, $serverpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming session has been started
session_start();

if (!isset($_SESSION['user_email'])) {
    echo json_encode(['message' => 'Unauthenticated']);
    exit;
}

$email = $_SESSION['user_email'];

// Retrieve user data based on email from MySQL
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Get the user's email
    $userEmail = $row['email'];




    // MongoDB Connection
    $database = new MongoDB\Client('mongodb://localhost:27017');
    $myDatabase = $database->profile;
    $userCollection = $myDatabase->users;

    // Find user data based on the email from MySQL in MongoDB
    $userData = $userCollection->findOne(['email' => $userEmail]);

    if ($userData) {
        // Return user data as JSON
        header('Content-Type: application/json');
        echo json_encode(['message' => 'successfull', 'data' => $userData]);
    } else {
        // Return failure message if user data isn't found in MongoDB
        echo json_encode(['message' => 'No user found in MongoDB']);
    }
} else {
    // Return failure message if user email isn't found in MySQL
    echo json_encode(['message' => 'No user found in MySQL']);
}

$conn->close();
?>
