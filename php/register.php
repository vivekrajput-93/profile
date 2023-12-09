<?php

// Check if it's an AJAX request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Assuming form fields are named 'username', 'email', 'password', 'age', 'dob', 'contact'
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';

    // Return the form data as JSON
    header('Content-Type: application/json');
    // echo json_encode(['message' => "Hello, $username, $password"]);
} else {
    // If it's not an AJAX request, return a default message
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Hello, PHP!']);
    exit; // Terminate script for non-AJAX requests
}

$server = "localhost";
$serverusername = "root";
$serverpassword = "viveksingh__1729";
$dbname = "vivek-auth";

$conn = new mysqli($server, $serverusername, $serverpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Hash the password
// $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if user already exists with the given email in SQL
$stmt = $conn->prepare("SELECT * FROM `users` WHERE `email` = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$existsInSQL = $result->num_rows > 0;

// Mongodb connection 
require_once  '../vendor/autoload.php';
$database = new MongoDB\Client('mongodb://localhost:27017');
$myDatabase = $database->profile;
$userCollection = $myDatabase->users;

// Check if user already exists with the given email in MongoDB
$userExistsInMongoDB = $userCollection->findOne(['email' => $email]);

// Combine results from SQL and MongoDB checks
if ($existsInSQL || $userExistsInMongoDB) {
    // User already exists in SQL or MongoDB, return a message
    echo json_encode(['message' => 'Already registered, please visit the login page']);
} else {
    // User doesn't exist in either database, proceed with insertion

    $data = array(
        "username" => $username,
        "email" => $email,
        "age" => $age,
        "dob" => $dob,
        "contact" => $contact
    );

    $insert = $userCollection->insertOne($data); // Insert into MongoDB

    if ($insert) {
        // Insert into SQL with hashed password
        $stmt = $conn->prepare("INSERT INTO `users` (`email`, `password`) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();

        echo json_encode(["message" => "successfull"]);
    } else {
        echo json_encode(["message" => "Unsuccessfull"]);
    }
}

$stmt->close();
$conn->close();
?>
