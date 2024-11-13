<?php
session_start();
include('../dbcon.php');

// Retrieve the table name from the session or URL parameter
$tableName = $_SESSION['table'] ?? 'sign'; // Default to 'sign' if not set

// Fetch correct answers from the database
$correctAnswers = []; 
$sql = mysqli_query($conn, "SELECT QNo, Answer, Choice1, Choice2, Choice3, Choice4 FROM $tableName"); // Use the retrieved table name
while ($row = mysqli_fetch_assoc($sql)) {
    $correctAnswers[$row['QNo']] = [
        'correctAnswer' => $row['Answer'],
        'choices' => [
            1 => $row['Choice1'],
            2 => $row['Choice2'],
            3 => $row['Choice3'],
            4 => $row['Choice4']
        ]
    ];
}

$userAnswers = $_SESSION['answers'] ?? []; // Ensure this is initialized correctly
$score = 0;
$totalQuestions = count($correctAnswers);
$correctCount = 0;
$wrongCount = 0;

// Prepare to display answers
$answerDetails = [];

// Ensure user answers are being recorded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uid'])) {
    $_SESSION['answers'] = $_POST['uid']; // Store user answers in session
}
foreach ($correctAnswers as $qNo => $data) {
    $correctAnswer = $data['correctAnswer'];
    $choices = $data['choices'];

    // Get the user's answer
    $userAnswer = isset($userAnswers[$qNo]) ? (int)$userAnswers[$qNo] : null;
    $userAnswerValue = $userAnswer !== null ? $choices[$userAnswer] : 'Not answered';
    
    // Get the correct answer value
    $correctAnswerValue = $choices[$correctAnswer];

    // Compare user's answer with the correct answer
    if ($userAnswer === (int)$correctAnswer) { // Ensure both are integers
        $score++;
        $correctCount++;
        $answerDetails[$qNo] = [
            'userAnswer' => $userAnswerValue,
            'correctAnswer' => $correctAnswerValue,
            'result' => 'Correct'
        ];
    } else {
        $wrongCount++;
        $answerDetails[$qNo] = [
            'userAnswer' => $userAnswerValue,
            'correctAnswer' => $correctAnswerValue,
            'result' => 'Wrong'
        ];
    }
}

// Display the results
echo "<h1>Your Results</h1>";
echo "<p>Total Questions: $totalQuestions</p>";
echo "<p>Correct Answers: $correctCount</p>";
echo "<p>Wrong Answers: $wrongCount</p>";
echo "<p>Your Score: $score out of $totalQuestions</p>";

// Display each question's answer
echo "<h2>Answer Details</h2>";
echo "<table border='1'>
        <tr>
            <th>Question No</th>
            <th>Your Answer</th>
            <th>Correct Answer</th>
            <th>Result</th>
        </tr>";

foreach ($answerDetails as $qNo => $details) {
    echo "<tr>
            <td>{$qNo}</td>
            <td>{$details['userAnswer']}</td>
            <td>{$details['correctAnswer']}</td>
            <td>{$details['result']}</td>
          </tr>";
}

echo "</table>";

// Clear session data if needed
session_destroy();
?>
