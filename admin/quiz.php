<?php
ob_start();
define('TITLE','quiz.php');
define('page','quiz.php');
include_once('../dbcon.php');
session_start();
include('includes/header.php');
if(!isset($_SESSION['radmin']))
{
    header("location:adminlogin.php");
}

if(isset($_REQUEST['submit']))
{
    $title = $_REQUEST['Title'];
    $exam_type = $_REQUEST['exam_type'];
    $total = $_REQUEST['question'];
    $_SESSION['qns'] = $total;
    $correct = $_REQUEST['correct'];
    $_SESSION['right'] = $correct;
    $wrong = $_REQUEST['wrong'];
    $_SESSION['mistake'] = $wrong;
    $time = $_REQUEST['time'];
    $tabelname = $_REQUEST['tabelname']; // Retrieve the selected table name
    $eid = uniqid();
    $_SESSION['eid'] = $eid;
    if($title == '' || $time == '' || $tabelname == '') // Check if table name is selected
    {
        $msg = "All fields are required";
    }
    else {
        $sql = "INSERT INTO quiz (eid, examType, tabelname, title, total, correct, wrong, time) VALUES ('$eid', '$exam_type', '$tabelname', '$title', '$total', '$correct', '$wrong', '$time')";
        if($conn->query($sql) == TRUE)
        {
            $msg = "Done successfully";
        }
        else {
            $msg = "Unable to insert";
        }
    }
}
ob_end_flush();
?>

</script>
<div class="offset-md-1 offset-sm-2 col-sm-6 col-md-7" id="gob">
    <h2 class="text-center mr-5 pr-5" style="color: white; font-weight: bold;">Enter quiz detail</h2>
    <form action="" method="POST" class="text-center" id="myForm">
    <div class="form-group">
            <select class="form-control" name="exam_type" required>
                <option value="public">የህዝብ ፈተና</option>
                <option value="sign">የምልክት ፈተና</option>
                <option value="psychology">የሳይኮሎጅ ፈተና</option>
                <option value="safety">የደህንነት ፈተና</option>
                <option value="technich">የቴክኒክ ፈተና</option>
                <option value="system">የሲስተም ፈተና</option>

            </select>
        </div>
        <div class="form-group">
            <input type="text" placeholder="Enter quiz Title" class="form-control" name="Title" require>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" placeholder="Enter number of Question" name="question" require>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" placeholder="Enter mark on right" name="correct" require>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" placeholder="marks on wrong without sign" name="wrong" require>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" placeholder="Enter time limit" name="time"><br>
        </div>
        <div class="form-group">
            <select class="form-control" name="tabelname" required>
                <option value="">Select Table Name</option>
                <?php
                $sql_tables = "SHOW TABLES"; // Fetch all table names
                $result_tables = $conn->query($sql_tables);
                $table_options = "";
                if ($result_tables->num_rows > 0) {
                    while($row = $result_tables->fetch_array()) {
                        $table_name = $row[0];
                        $table_options .= "<option value='$table_name'>$table_name</option>";
                    }
                }
                echo $table_options;
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-light" name="submit" style="color: black;">submit</button>
        <p class="alert"><?php if(isset($msg)) echo $msg ?></p>
    </form>
</div>
<?php
include('includes/footer.php');
?>
<style>
    body{
        background-image: url(../image/93bgh.png);
        background-size: cover;
        background-position: center;
    }
</style>