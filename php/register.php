<?php


// Check if it's an AJAX request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Assuming a form field named 'name'
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
}

$server = "localhost";
$username = "root";
$password = "viveksingh__1729";
$dbname = "vivek-auth";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$stmt = $conn->prepare("INSERT INTO `users` (`email`, `password`) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $password);

$stmt->execute();

// if ($stmt->affected_rows > 0) {
//     echo json_encode(["message" => "Successfully inserted"]);
// } else {
//     echo json_encode(["message" => "Not inserted"]);
// }

$stmt->close();
$conn->close();

// Mongodb connection 

require_once  '../vendor/autoload.php';

$database = new MongoDB\Client('mongodb://localhost:27017');


$myDatabase = $database->profile;

$userCollection = $myDatabase->users;


// if($userCollection) {
//     echo json_encode(["message" => "Connected to the ".$userCollection." "]);
// } else {
//     echo json_encode(["message" => "Not connected to the database "]);
// }


$data = array(
    "username" => $username,
    "age" => $age,
    "dob" => $dob,
    "contact" => $contact
);

$insert = $userCollection->insertOne($data);


if($insert) {
    echo json_encode(["message" => "Connected to the ".$userCollection." "]);
} else {
    echo json_encode(["message" => "Not connected to the database "]);
}



?>