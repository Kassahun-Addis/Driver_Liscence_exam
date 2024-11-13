<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/10.png" type="image/png" >
    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="../css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/design.css">
    <title>Profile</title>
    <style>
        body{
    background-image: url("../img/93bgh.png");
   }
     .active {
         color: #3a3a5c;
         background-color:rgba(0, 0, 0, 0.6); ;
     }
    
        @media only screen and (min-width: 1080px){
   body{
    background-image: url("../image/4.png");
   }
    }
/*tablet view styling*/
    @media only screen and (max-width: 1080px){ 
      body{
    background-image: url("../image/tab2.jpg");
   }
    }
@media only screen and (max-width: 400px){
    body{
    background-image: url("../image/phone3.jpg");
   }
    }

    </style>

</head>
<body>
  <nav class="navbar navbar-expand-md sticky-top " style="background-color: rgba(0, 0, 0, 0.6);" >
        <a href="#" class="navbar-brand" style="color: white; font-weight: bold; font-size: 25px;">RIGHT DRIVING</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse" style="background-color: #F1F0FF; border-radius: 10px; height: 30px;">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
          <a href="" class="closebtn" onclick="closeNav" style="color:rgba(0, 0, 0, 0);">X</a>
            <div class="navbar-nav">
                <a href="../index.php" class="nav-item nav-link "  style="color: white;">Home</a>
                <a href="../aboutus.html" class="nav-item nav-link "  style="color: white;">About Us</a>
                <a href="../feedback.php" class="nav-item nav-link " tabindex="-1"  style="color: white;">Feedback</a>
            </div>
        </div>
        <div id="timer" style="color: white; font-size: 20px; display: none; margin-left: auto;">
            <img src="../image/time.gif" alt="Timer" style="width: 60px; height: 60px; vertical-align: middle;">
            <span id="time">00:00</span><span style="margin-left: 10px;">left</span>
        </div>
        <?php
       if (session_status() == PHP_SESSION_NONE) {
        session_start(); // Start session only if it hasn't been started yet
    }
        
        ?>
        <div id="user-name" style="color: white; font-size: 24px; padding-left: 20px; margin-left: -10px; position: relative;" onclick="toggleUserMenu()">
           👨‍💼 <!-- Display the user's name here -->
           <div id="user-menu" style="display: none; color: white; position: absolute; background-color: rgba(0, 0, 0, 0.8); padding: 10px; border-radius: 5px; z-index: 100;margin-left: -80px; width: 140px; font-size: 15px;">
               <ul style="list-style-type: none; padding: 0; margin-left: 0;">
                   <li style="margin: 5px 0;">
                       👨‍💼<span id="display-name"><?php echo $_SESSION['name']; ?></span> <!-- Replace with actual user name -->
                   </li>
                   <li style="margin: 5px 0;">
                       <a href="../logout.php" style="color: white; text-decoration: none;">
                           <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i> Logout
                       </a>
                   </li>
               </ul>
           </div>
        </div>
        <?php
 
        ?>
    </nav>
    <div id="timer" style="color: white; font-size: 20px; display: none;"> <span id="time">00:</span></div>
    <script>
    function toggleMenu() {
      var menuBox = document.getElementById('menu');    
      if(menuBox.style.display == "block") { // if is menuBox displayed, hide it
        menuBox.style.display = "none";
      }
      else { // if is menuBox hidden, display it
        menuBox.style.display = "block";
      }
    }

    function startQuiz() {
      document.getElementById('timer').style.display = 'block'; // Show the timer
      let timeLeft = 50 * 60; // Set timer for 50 minutes (3000 seconds)
      const timerElement = document.getElementById('time'); // Get the timer element

      const timer = setInterval(function() {
        if (timeLeft <= 0) {
          clearInterval(timer);
          alert("Time's up!");
          saveScore(); // Call saveScore when time is up
        } else {
          // Calculate minutes and seconds
          const minutes = Math.floor(timeLeft / 60);
          const seconds = timeLeft % 60;
          timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`; // Update the timer display
          timeLeft -= 1; // Decrease time left
        }
      }, 1000);
    }

    function toggleUserMenu() {
        var userMenu = document.getElementById('user-menu');
        userMenu.style.display = (userMenu.style.display === 'block') ? 'none' : 'block';
    }
    </script>
    
    
<!--start side-bar-->
    