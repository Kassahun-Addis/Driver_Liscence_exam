<?php
include_once('dbcon.php');
if(isset($_REQUEST['confirm']))
{
    if(($_REQUEST["subject"]=="") || ($_REQUEST["email"]==""))
  {
    $msg="All field are require";
  }
  else
  {
   $name=$_REQUEST['rname'];
   $email=$_REQUEST['email'];
   $subject=$_REQUEST['subject'];
   $feedback=$_REQUEST['feedback'];
  $sql="insert into feedbacks values ('','$name','$email','$subject','$feedback',now())";
    if($conn->query($sql) == TRUE)
    {
    $msg="feedback submited successfully";
    }
    else{
        $msg="Unable to submit feedback";
        }
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/10.png" type="image/png" >
    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/design.css">
  <link rel="stylesheet" href="css/style.css">
    <title>Feedback</title>

    <style>
      body{
       overflow: hidden;
      }
      @media only screen and (min-width: 1080px){
   .back-image{
    background-image: url("image/bg.png");
    height: 100vh;
    background-size: cover;

   }
   .container{
    margin: 5%;
    padding-top: 5px;
    padding-bottom: 1px;
   }
    }
/*tablet view styling*/
    @media only screen and (max-width: 1080px){ 
      .back-image{
    background-image: url("image/bg.png");
   }
   .container{
    margin-right: 18%;
    margin-top: 12%;
    padding-top: 2px;
    padding-bottom: 1px;
   }
    }
@media only screen and (max-width: 400px){
    .back-image{
    background-image: url("image/feedbackphone.jpg");
    background-size: cover;
   }
   .container{
    margin: 2%;
    align-items: center;
   }
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md sticky-top " style="background-color: rgba(0, 0, 0, 0.6);" >
        <a href="#" class="navbar-brand" style="color: white; font-weight: bold; font-size: 25px;">Right Driving School</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse" style="background-color: #F1F0FF; border-radius: 10px; height: 30px;">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
          <a href="" class="closebtn" onclick="closeNav" style="color:rgba(0, 0, 0, 0);">X</a>
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link active"  style="color: white;">Home</a>
                
                <a href="aboutus.html" class="nav-item nav-link"  style="color: white;">About Us</a>
                <a href="feedback.php" class="nav-item nav-link active" tabindex="-1"  style="color: white;">Feedback</a>
            </div>
        </div>
    </nav>
    

     <header class="jumbotron back-image ">
        <div class="container mb-1">
            <div class="row">
              <div class="col-md-7 col-sm-6 offset-md-3 text-white" style="background-color: rgba(0, 0, 0, 0.2);">
                  <h2 class="text-center mt-3" style="color: white; font-weight: bold;">Feedback/Report a problem</h2>
                <form action="" method="POST" class="p-3" id="myForm">
                  <div class="form-group my-1">
                    <i class="fas fa-user mr-2"></i><label for="name" class="font-weight-bold">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="rname">
                  </div>
                  <div class="form-group my-1"> 
                    <label for="subject" class="font-weight-bold">Subject</label>
                    <input type="text" name="subject" class="form-control" placeholder="Enter Subject">
                  </div>
                  <div class="form-group my-1"> 
                    <label for="subject" class="font-weight-bold">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter your Email">
                  </div>
                  <div class="form-group my-1"> 
                    <label for="subject" class="font-weight-bold">Feedback</label>
                    <textarea name="feedback" id="feedback" rows="5" class="form-control" placeholder="Enter your feedback"></textarea>
                  </div>
                  <div class="submit" style="display: flex;">
                  <button class="btn btn-danger mt-2 p-1 font-weight-bold mr-4" name="confirm" >Submit</button>
                  <p class="alert p-0 my-2 font-weight-bold"><?php if(isset($msg)) echo $msg ?></p>
                  </div>
                </form>
            </div>
          </div>
      </div>
      <footer style="margin-left: -30px; width: 100%;margin-bottom: 0px;">
      <div style="height: 150px;  ">
        <b>Get in Touch</b><br>Through following links<br>
        <a href="#" class="fa fa-facebook" alt="solo93"></a>
      <a href="#" class="fa fa-linkedin" alt="solo93 linkedin"></a>
      <a href="#" class="fa fa-instagram" alt="solo93 instagram"></a><br>
      <span class="glyphicon glyphicon-copyright-mark"></span> 2024 93 Driving School<br> Developed by: Team 93
      </div>
    </footer>

      
     </header>
   
    
     
      <!--footer section-->

    
      
      <!--End footer section-->

<script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script>
  <script src="js/custom.js"></script>
</body>
</html>