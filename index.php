<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="shortcut icon" href="image/10.png" type="image/png" >
    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Font Awesome CSS -->


  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style>
    body {
        background-color: darkslateblue; /* Gradient background */
        background-size: cover;
        padding: 0;
        margin: 0;
    }
    
    .btnn {
        background-color: #f1c40f; /* Button background color */
        color: #2c3e50; /* Button text color */
        border-radius: 20px; /* Rounded corners */
        padding: 10px 20px; /* Padding for buttons */
        transition: background-color 0.3s; /* Smooth transition for buttons */
    }
    .btnn:hover {
        background-color: #e67e22; /* Button hover color */
    }
  </style>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/design.css">
    <title></title>
</head>
<body>
    <div class="bs-example">
    <nav class="navbar navbar-expand-md sticky-top" style="background-color: rgba(0, 0, 0, 0.6);" >
        <a href="#" class="navbar-brand" style="color: white; font-weight: bold; font-size: 25px;">RIGHT DRIVING</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse" style="background-color: #F1F0FF; border-radius: 10px; height: 30px;">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
          <a href="" class="closebtn" onclick="closeNav" style="color:rgba(0, 0, 0, 0);">X</a>
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link active"  style="color: white;">Home</a>
               <!-- <a href="developer.html" class="nav-item nav-link"  style="color: white;">Developer</a> -->
                <a href="aboutus.html" class="nav-item nav-link"  style="color: white;">About Us</a>
                <a href="feedback.php" class="nav-item nav-link active" tabindex="-1"  style="color: white;">Feedback</a>
            </div>
        </div>
    </nav>

    <header >
     
    </header>
    <!--registration section  start-->
    <div id="registration" style="display: none;">
        <?php include('registration.php'); ?>
    </div>
     <!--registration section  end-->

    <!--login section  start-->
    <div id="login" style="display: block;">
        <?php
        include('dbcon.php');
       
        if(!isset($_SESSION['ruser'])) {
            if (isset($_REQUEST['rsignin'])) {
                $remail = mysqli_real_escape_string($conn, trim($_REQUEST['remail']));
                $rpassword = mysqli_real_escape_string($conn, trim($_REQUEST['rpassword']));
                $sql = "select email,password from user where email='".$remail."' and password='".$rpassword."' limit 1";
                $result = $conn->query($sql);
                if($result->num_rows == 1) {
                    $sql = "select name from user where email='".$remail."' and password='".$rpassword."' limit 1";
                    $result = $conn->query($sql);
                    $row = mysqli_fetch_assoc($result);
                    $name = $row['name']; 
                    $_SESSION['ruser'] = true;
                    $_SESSION['remail'] = $remail;
                    $_SESSION['name'] = $name;
                    echo "<script> location.href='user/slide.html'; </script>";
                    exit;
                } else {
                    $msg = "Enter valid email and password";
                }      
            }
        } else {
            echo "<script> location.href='user/slide.html'; </script>";
        }
        ?>
        <div class="text-center mt-5">
            <div style="color: white; font-weight: bold; font-size: 40px;">Login to Exam Portal</div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-sm-6 col-md-4 text-white" style="background-color: rgba(0, 0, 0, 0.6); border-radius: 10px;">
                    <form action="" class="p-4 shadow-lg" method="POST" id="myForm">
                        <div class="form-group">
                            <i class="fas fa-user mr-2"></i><label for="name" class="font-weight-bold">Email</label>
                            <input type="text" name="remail" placeholder="Enter email" class="form-control">
                        </div>
                        <div class="form-group">
                            <i class="fas fa-key mr-2"></i><label for="name" class="font-weight-bold">Password</label>
                            <input type="password" name="rpassword" placeholder="Enter password" class="form-control">
                        </div>
                        <div class="submit" style="display: flex;">
                            <button class="btn btn-outline-danger p-1 font-weight-bold mr-5" name="rsignin">Submit</button>
                            <div><a class="btn btn-outline-info ml-1" onclick="toggleRegistration()" >sign up</a></div>
                        </div>
                    </form>
                    <div class="alert"><?php if(isset($msg)) { echo $msg; } ?></div>
                </div>
            </div>
        </div>
    </div>
    <!--login section  end-->

    <!--footer section-->
    <div class="container-fluid">
      <footer class="row text-white" style="background-color: rgba(0, 0, 0, 0.5); margin-top: 330px; position: fixed; bottom: 0; width: 100%;" >
        <div class="col-sm-4 py-3">
          <span class="mr-5 text-center font-weight-bold">follow us:</span>
          <a href="#" target="_blank"><i class="fab fa-facebook-f fa-2x"></i></a>
          <a href="#" target="_blank"><i class="fab fa-linkedin fa-2x ml-2 text-secondary clr"></i></a>
          <a href="#" target="_blank"><i class="fab fa-instagram fa-2x ml-2 text-danger clr"></i></a>
          
        </div> <!--end first column-->
        <div class="col-sm-8 text-right my-3">
          <!-- <small class="text-uppercase font-weight-bold mr-3">design by &copy</small> -->
          <small class="ml-2"><a class="btn btn-light" href="admin/adminlogin.php">admin login</a></small>
        </div>
      </footer>
    </div>
    
    <!--End footer section-->
  
     <!-- Boostrap JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script>
  <script src="js/custom.js"></script>

  <script>
    function toggleRegistration() {
        var registrationSection = document.getElementById('registration');
        var loginSection = document.getElementById('login');
        if (registrationSection.style.display === "none") {
            registrationSection.style.display = "block";
            loginSection.style.display = "none";
             // Show the registration section
        } else {
            registrationSection.style.display = "none";
            loginSection.style.display = "none"; // Hide the registration section
        }
    }

    function toggleLogin() {
        var loginSection = document.getElementById('login');
        if (loginSection.style.display === "none") {
            loginSection.style.display = "block"; // Show the login section
        } else {
            loginSection.style.display = "none"; // Hide the login section
        }
    }
  </script>
</body>
</html>