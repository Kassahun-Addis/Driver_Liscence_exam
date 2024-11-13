<?php
session_start();
include('../dbcon.php');

// Ensure the user answers are being sent to the result page
if (isset($_SESSION['answers'])) {
    // Prepare to send answers to the result page
    $userAnswers = $_SESSION['answers'];
    // ... existing code to fetch questions ...
}

// ... existing code ...
?> 