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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auth";

$conn =  new mysqli($servername, $username, $password, $dbname);


$stmt = $conn->prepare("INSERT INTO `auth`.`users` (`email`, `password`) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $password);

// Set parameter values and execute the statement
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$stmt->execute();

if($stmt->affected_rows > 0) {
    echo json_encode(["message"=> "Successfully inserted"]);
} else {
    echo json_encode(["message"=> "Not inserted"]);
}


$stmt->close();
$conn->close();

// $mongoClient = new MongoDB\Client("mongodb://localhost:27017");

// Select your database
$mongoDB = $mongoClient->selectDatabase("myMongoDB");

// Select your collection
$usersCollection = $mongoDB->users;

// Create an array with the data to be inserted
$userData = [
    'username' => $username,
    'age' => $age,
    'dob' => $dob,
    'contact' => $contact
];

// Insert the data into the collection
$result = $usersCollection->insertOne($userData);

if ($result->getInsertedCount() > 0) {
    echo json_encode(["message"=> "Successfully inserted into MongoDB"]);
} else {
    echo json_encode(["message"=> "Not inserted into MongoDB"]);
}


?>


