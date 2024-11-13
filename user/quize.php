<?php
// database.php - Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sign";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions, choices, answers, and image from the 'sign' table
$sql = "SELECT QNo, Question, Choice1, Choice2, Choice3, Choice4, Answer, Image FROM sign";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "QNo: " . $row["QNo"] . "<br>";
        echo "Question: " . $row["Question"] . "<br>";
        echo "Choices: <br>";
        echo "1. " . $row["Choice1"] . "<br>";
        echo "2. " . $row["Choice2"] . "<br>";
        echo "3. " . $row["Choice3"] . "<br>";
        echo "4. " . $row["Choice4"] . "<br>";
        echo "Answer: " . $row["Answer"] . "<br>";
        if (!empty($row["Image"])) {
            echo "<img src='" . $row["Image"] . "' alt='Question Image'><br>";
        }
        echo "<br>";
    }
} else {
    echo "0 results";
}
?>
