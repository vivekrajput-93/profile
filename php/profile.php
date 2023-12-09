<?php
require_once '../vendor/autoload.php';

if(isset($_GET['email'])) {
    $user_email = $_GET['email'];

    $database = new MongoDB\Client('mongodb://localhost:27017');
    $myDatabase = $database->profile;
    $userCollection = $myDatabase->users;

    // Fetch user data based on the provided email
    $userData = $userCollection->findOne(['email' => $user_email]);

    // Pass the user data to the JavaScript file
    header('Content-Type: application/json');
    echo json_encode($userData);
} else {
    header('HTTP/1.1 400 Bad Request');
    exit('Bad request - Email not provided');
}
?>
