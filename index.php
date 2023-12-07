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