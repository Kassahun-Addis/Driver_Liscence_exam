<?php
include('../dbcon.php');

$currentQuestion = isset($_GET['q'] ) ? (int)$_GET['q'] : 1;
$totalQuestions = 50; 

if ($currentQuestion > $totalQuestions) {
    exit();
}

$tableName = isset($_REQUEST['tablename']) ? mysqli_real_escape_string($conn, $_REQUEST['tablename']) : 'exam1';

$sql = mysqli_query($conn, "SELECT QNo, Question, Choice1, Choice2, Choice3, Choice4, Answer, Image FROM $tableName WHERE QNo = $currentQuestion");

if (!$sql) {
    die("Database query failed: " . mysqli_error($conn));
}

if ($row = mysqli_fetch_array($sql)) {
    $correctAnswer = $row['Answer'];

    switch ($correctAnswer) {
        case 1:
            $correctAnswerText = $row['Choice1'];
            break;
        case 2:
            $correctAnswerText = $row['Choice2'];
            break;
        case 3:
            $correctAnswerText = $row['Choice3'];
            break;
        case 4:
            $correctAnswerText = $row['Choice4'];
            break;
    }

 

    if (!empty($row["Image"])) {
        $binaryData = hex2bin(substr($row['Image'], 2));
        $imageData = base64_encode($binaryData);
        echo "<div class='question-image'>
                <img src='data:image/png;base64," . $imageData . "' alt='Question Image' style='width: 100px; height: 100px;'><br>
              </div>";
    }

   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userAnswer = isset($_POST['userAnswer']) ? (int)$_POST['userAnswer'] : null;
        $canswer = mysqli_query($conn, "SELECT Answer FROM $tableName WHERE QNo = $currentQuestion");
        if (!$canswer) {
            die("Database query failed: " . mysqli_error($conn));
        }
        
        $correctAnswerRow = mysqli_fetch_assoc($canswer);
        $correctAnswer = (int)$correctAnswerRow['Answer'];

        if ($userAnswer === $correctAnswer) {
            echo '<div style="color: green;">Correct Answer!</div>';
        } else {
            echo '<div style="color: red;">Incorrect! Correct Answer: ' . htmlspecialchars($correctAnswerText) . '</div>';
        }
    }
} else {
    echo '<p>No question found for this number.</p>';
}

echo '<head>
    <style>
        .card {
            border: none;
            width: 100%;
            height: 500px;
            font-size: 24px; 
            padding: auto;
            color: darkblue;
            background: linear-gradient(rgba(255, 255, 255, 1) 70%, rgba(114, 103, 4, 0));
        }
        
        .custom-radio {
            position: relative;
            padding-left: 10px;
            cursor: pointer;
        }
        .custom-radio:before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border: 2px solid blue;
            border-radius: 50%;
            background-color: white;
        }
        input[type="radio"]:checked + .custom-radio:before {
            background-color: blue;
        }
        li {
            list-style-type: none;
        }
        .progress {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .progress-bar {
            height: 20px;
            background-color: green;
            transition: width 0.4s;
        }
    </style>
</head>';

echo '<div class="card" tabindex="0"> 
            <div class="card-header" style="font-size:45px">
                <h2>' . $row['QNo'] . ' . ' . htmlspecialchars($row['Question']) . '</h2>
            </div>
            <div class="card-body">
              <ul>
                <li>
                    <input type="radio" name="uid[' . $row['QNo'] . ']" value="1" id="choice1" 
                           onchange="sendUserChoice(' . $row['QNo'] . ', this.value, ' . $row['Answer'] . ');">
                    <label for="choice1" class="custom-radio">' . htmlspecialchars($row["Choice1"]) . '</label>
                </li>
                <li>
                    <input type="radio" name="uid[' . $row['QNo'] . ']" value="2" id="choice2" 
                           onchange="sendUserChoice(' . $row['QNo'] . ', this.value, ' . $row['Answer'] . ');">
                    <label for="choice2" class="custom-radio">' . htmlspecialchars($row["Choice2"]) . '</label>
                </li>
                <li>
                    <input type="radio" name="uid[' . $row['QNo'] . ']" value="3" id="choice3" 
                           onchange="sendUserChoice(' . $row['QNo'] . ', this.value, ' . $row['Answer'] . ');">
                    <label for="choice3" class="custom-radio">' . htmlspecialchars($row["Choice3"]) . '</label>
                </li>
                <li>
                    <input type="radio" name="uid[' . $row['QNo'] . ']" value="4" id="choice4" 
                           onchange="sendUserChoice(' . $row['QNo'] . ', this.value, ' . $row['Answer'] . ');">
                    <label for="choice4" class="custom-radio">' . htmlspecialchars($row["Choice4"]) . '</label>
                </li>
              </ul>
              
            </div>
        </div>'
        ;
        echo '<div class="progress">
        <div class="progress-bar" role="progressbar" style="width: ' . (($currentQuestion / $totalQuestions) * 100) . '%;" aria-valuenow="' . $currentQuestion . '" aria-valuemin="0" aria-valuemax="' . $totalQuestions . '"></div>
      </div>';

    echo '<script>
        document.querySelector(".card").focus(); 
        document.addEventListener("keydown", function(event) {
            if ("1234".includes(event.key)) {
                var choiceId = "choice" + event.key; 
                document.getElementById(choiceId).checked = true;
                sendUserChoice(' . $row['QNo'] . ', event.key, ' . $row['Answer'] . ')
            }
        });
        function checkAnswer(){
            console.log("Correct Answer: " . htmlspecialchars($correctAnswerText));
            console.log("solo93");
        }
        document.addEventListener("keydown", function(event) {
            const questionNo = ' . $row['QNo'] . ';
            const answer = ' . $row['Answer'] . ';
            let selectedValue;

            switch (event.key) {
                case "1":
                    selectedValue = "1";
                    sendUserChoice(' . $row['QNo'] . ', selectedValue, ' . $row['Answer'] . ');
                    break;
                case "2":
                    selectedValue = "2";
                    sendUserChoice(' . $row['QNo'] . ', selectedValue, ' . $row['Answer'] . ');
                    break;
                case "3":
                    selectedValue = "3";
                        sendUserChoice(' . $row['QNo'] . ', selectedValue, ' . $row['Answer'] . ');
                        
                    break;
                case "4":
                    selectedValue = "4";
                    sendUserChoice(' . $row['QNo'] . ', selectedValue, ' . $row['Answer'] . ');
                    console.log("selectedValue: " + selectedValue);
                    break;
                default:
                    return; // Exit if the key is not 1-4
            }

            // Check if the radio button exists and select it
            const radioButton = document.querySelector(`input[name="uid[${questionNo}]"][value="${selectedValue}"]`);
            if (radioButton) {
                radioButton.checked = true; // Check the radio button
                sendUserChoice(questionNo, selectedValue, answer); // Call the function
            }
        });
    </script>';

