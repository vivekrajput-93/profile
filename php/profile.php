<?php
require_once '../vendor/autoload.php';

$database = new MongoDB\Client('mongodb://localhost:27017');
$myDatabase = $database->profile;
$userCollection = $myDatabase->users;

$userData = $userCollection->findOne(['email' => '$userEmail']); // Replace with actual email or a method to identify user

header('Content-Type: application/json');
echo json_encode($userData);
?>
