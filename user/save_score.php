<?php
include('../dbcon.php'); // Include your database connection
session_start();
// Get the POST data
$total = $_POST['total'];
$correct = $_POST['correct'];
$wrong = $_POST['wrong'];
$user = $_SESSION['name'];
$title = $_POST['title'];
$score = ($correct * 2) . "%/100"; // Corrected score calculation
// Prepare and execute the SQL insert statement

$sql = "INSERT INTO history (user,title, totals, correct, wrong, score) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssss", $user, $title, $total, $correct, $wrong, $score);
if (!mysqli_stmt_execute($stmt)) {
    echo "Error inserting into history: " . mysqli_stmt_error($stmt); // Debugging output
}

// Check if the user exists in the ranks table
$user_check_sql = "SELECT COUNT(*) FROM ranks WHERE user=?";
$stmt = mysqli_prepare($conn, $user_check_sql);
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);

if ($row[0] > 0) { // User exists
    $sql2 = "UPDATE ranks SET score=? WHERE user=?";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "ss", $score, $user);
} else {
    $sql2 = "INSERT INTO ranks (user, score) VALUES (?, ?)";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "ss", $user, $score);
}

// Execute the prepared statement
mysqli_stmt_execute($stmt2);

mysqli_close($conn); // Close the database connection
?>
