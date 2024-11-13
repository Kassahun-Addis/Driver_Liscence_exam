<?php
session_start();
header('Content-Type: application/json'); // Set the content type to JSON

$response = []; // Initialize response array

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'uid' is set in the POST data
    if (isset($_POST['uid']) && is_array($_POST['uid'])) {
        $_SESSION['answers'] = $_POST['uid']; // Store user answers in session

        // Prepare a success response
        $response = [
            'status' => 'success',
            'message' => 'Your answers have been recorded.',
            'data' => $_SESSION['answers'] // Optionally return the recorded answers
        ];
    } else {
        // Prepare an error response if 'uid' is not set
        $response = [
            'status' => 'error',
            'message' => 'No answers were submitted.'
        ];
    }
} else {
    // Prepare an error response for invalid request method
    $response = [
        'status' => 'error',
        'message' => 'Invalid request method.'
    ];
}

// Return the response as JSON
echo json_encode($response);
?> 