console.log("100");
document.addEventListener("click", function() {
    document.querySelector(".card").focus(); 
    document.addEventListener("keydown", function(event) {
        switch(event.key) {
            case "1":
            case "2":
            case "3":
            case "4":
                const choiceId = "choice" + event.key; 
                document.getElementById(choiceId).checked = true;
                sendAnswer(currentQuestion, event.key, correctAnswer); 
                updateUserChoice(choiceId); 
                break;
        }
    });
});

function sendAnswer(questionNumber, userAnswer, correctAnswer) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "result.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            document.getElementById("correctAnswer").style.display = "block"; 
            if (!response.correct) {
                alert("Wrong answer!"); 
            } else {
                alert("Correct answer!"); 
            }
        }
    };
    xhr.send("uid[" + questionNumber + "]=" + userAnswer + "&tablename=" + encodeURIComponent(tableName) + "&correctAnswer=" + encodeURIComponent(correctAnswer)); 
    document.getElementById("correctAnswer").innerText = "Correct Answer: " + correctAnswer; 
}

function updateUserChoice(choice) {
    document.getElementById("selectedChoice").innerText = choice; 
}

