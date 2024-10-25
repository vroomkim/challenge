<?php
// Set content type to application/json
header('Content-Type: application/json');

// Get the raw POST data
$requestBody = file_get_contents('php://input');

// Decode the JSON payload
$data = json_decode($requestBody, true);

// Check if the JSON decoding was successful
if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    // Invalid JSON payload
    http_response_code(400); // Bad request
    echo json_encode(["message" => "Invalid JSON"]);
    exit();
}

// Extract username and password
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

// Initialize the response array
$response = [];

// Add received cookies to the response
$response['cookies'] = $_COOKIE;

// Check if the credentials are correct
if ($username === 'admin' && $password === 'admin') {
    // Credentials are correct, return 200 OK
    http_response_code(200);
    $response['success'] = true;
} else {
    // Credentials are incorrect, return 401 Unauthorized
    http_response_code(401);
    $response['success'] = false;
}

// Output the response as JSON
echo json_encode($response);
?>
