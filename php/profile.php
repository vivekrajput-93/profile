<?php


// MySQL Connection
if (isset($_GET['userEmail'])) {
    $userEmail = $_GET['userEmail'];


    require_once '../vendor/autoload.php';
    $database = new MongoDB\Client('mongodb://localhost:27017');
    $myDatabase = $database->profile;
    $userCollection = $myDatabase->users;

    // Find user data based on the email from MySQL in MongoDB
    $userData = $userCollection->findOne(['email' => $userEmail]);

    if ($userData) {
        // Return user data as JSON
        header('Content-Type: application/json');
        echo json_encode(['message' => 'success', 'data' => $userData]);
    } else {
        // Return failure message if user data isn't found in MongoDB
        echo json_encode(['message' => $userEmail]);
    }
} else {
    // Return failure message if user email isn't found in MySQL
    echo json_encode(['message' => 'No user found in MySQL']);
}


?>
