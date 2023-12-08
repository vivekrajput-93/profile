<?php
// Check if it's an AJAX request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {


    $user_email = isset($_POST['email']) ? $_POST['email'] : '';
    $user_password = isset($_POST['password']) ? $_POST['password'] : '';

} else {

    header('Content-Type: application/json');
    echo json_encode(['message' => 'Hello, PHP!']);
}

$server = "localhost";
$serverusername = "root";
$serverpassword = "viveksingh__1729";
$dbname = "vivek-auth";

$conn = new mysqli($server, $serverusername, $serverpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT `password` FROM `users` WHERE `email` = ?");
$stmt->bind_param("s", $user_email);


$stmt->execute();
$stmt->bind_result($stored_password);
$stmt->fetch();


if ($user_password === $stored_password) {
    // Password is correct

    header('Content-Type: application/json');
    echo json_encode([  "message"=> "successfull" ]);
} else {
    // Password is incorrect or user doesn't exist
    echo json_encode(["message"=> "unsuccessfull"]);
}





$stmt->close();
$conn->close();

?>