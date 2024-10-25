<?php
// Set the content type to JSON to inform the client that the response is in JSON format
header('Content-Type: application/json');

// Create an associative array to simulate the data you want to send back
$response = array(
    "status" => "success",
    "message" => "Data fetched successfully",
    "data" => array(
        "id" => 123,
        "name" => "Stephen",
        "email" => "stephenkim@cloudflare.com"
    )
);

// Send a 200 HTTP status code (success)
http_response_code(200);

// Output the response in JSON format
echo json_encode($response);
?>

