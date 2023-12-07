<?php
// index.php

// Check if it's an AJAX request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Assuming a form field named 'name'
    $name = isset($_POST['name']) ? $_POST['name'] : '';

    // Return the form data as JSON
    header('Content-Type: application/json');
    echo json_encode(['message' => "Hello, $name!"]);
} else {
    // If it's not an AJAX request, return a default message
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Hello, PHP!']);
}


$servername = "localhost";
$username = "root";
$password = "viveksingh__1729";
$dbname = "profile";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<?php
// index.php

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
    echo json_encode(['message' => "Hello, $username, $password"]);
} else {
    // If it's not an AJAX request, return a default message
    header('Content-Type: application/json');
    
}

// Mysql connection;

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "register";

// $conn =  new mysqli($servername, $username, $password, $dbname);


//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }
//     echo json_encode(['message' => "Successfully connected with db"]);


?>