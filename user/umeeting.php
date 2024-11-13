<?php
ob_start(); // Start output buffering

define('TITLE', 'umeeting.php');
define('page', 'umeeting.php');
include('includes/header.php');
include_once('../dbcon.php');

if (!isset($_SESSION['ruser'])) {
    header("location:login.php"); // Uncomment this line to redirect to login if not logged in
}

if (isset($_REQUEST['join'])) {
    if ($_REQUEST["link"] == "") {
        $msg = "Meeting link is required"; // Update message
    } else {
        $link = $_REQUEST['link']; // Get the meeting link
        // Redirect to the meeting link
        header("Location: $link");
        exit();
    }
}
?>

<div class="offset-md-1 offset-sm-2 col-sm-6 col-md-7" id="gob">
    <div class="col-md-7 col-sm-6 offset-md-3 text-white" style="background-color: rgba(0, 0, 0, 0.2); padding-top: 5px; padding-bottom: 9px;">
        <h2 class="text-center mt-3" style="color: white; font-weight: bold;">Join Meeting</h2>
        <form action="" method="POST" class="p-3" id="myForm">
            <div class="form-group">
                <label for="link" class="font-weight-bold">Meet Link</label>
                <input type="url" class="form-control" placeholder="Enter meet link" name="link" required>
            </div>
            <button type="submit" class="btn btn-danger mt-2 p-1 font-weight-bold mr-4" name="join" style="color: white;">Join Meeting</button>
            <p class="alert"><?php if (isset($msg)) echo $msg; ?></p>
        </form>
    </div>
</div>

<?php
include('includes/footer.php');
ob_end_flush(); // End output buffering and flush output
?>
