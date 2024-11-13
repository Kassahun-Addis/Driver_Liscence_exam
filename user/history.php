<?php
session_start();
define('page','history.php');
define('TITLE','history.php');
include('../dbcon.php');
include('includes/header.php');

if(isset($_SESSION['name']))
{
$user= $_SESSION['name'];
}

echo' <div class="col-sm-9 col-md-10 text-center" id="gob">
    <p class="p-2 text-white mt-5 " style="background-color: rgba(0, 0, 0, 0.6);">History of Marks Scored</p>';
    $user= $_SESSION['name'];
if(isset($user))
{
$sql="select * from history where user='$user'";
$result=$conn->query($sql);
if ($result->num_rows>0)
{
    echo '<table class="table" style="color:white; background-color: rgba(0, 0, 0, 0.4);">
    <tbody>
    <tr>
    <th>NO</th>
    <th>Title</th>
    <th>question</th>
    <th>Right</th>
    <th>Wrong</th>
    <th>Score 100%</th>
    </tr>
    
    ';
    $c=1;
    while($row=$result->fetch_assoc())
    {
        if (!isset($c)) {
            $c = 1;
        }
        
        $scoreValue = $row["score"];
        $bgColor = ($scoreValue >= 74) ? 'background-color: green;' : 'background-color: red;';

        echo '<tr>
        <th>'.$c.'</th>
        <td>'.$row["title"].'</td>
        <td>'.$row["totals"].'</td>
        <td>'.$row["correct"].'</td>
        <td>'.$row["wrong"].'</td>
        <td id="scoretext'.$c.'" style="'.$bgColor.'">'.$scoreValue."%".'</td>
        </tr>';
        
        $c++;
        $correctValue = $row["correct"];
    } 
    echo '<tbody>
    </table>
     '; 
  }
}

if(isset($_POST['clear_history'])) {
    $user = $_SESSION['name'];
    $sql = "DELETE FROM history WHERE user='$user'";
    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" id="alert-message">History cleared successfully.</div>';
    } else {
        echo '<div class="alert alert-danger" id="alert-message">Error clearing history: ' . $conn->error . '</div>';
    }

    // Add JavaScript to hide the alert after 5 seconds
    echo '<script>
        setTimeout(function() {
            var alertMessage = document.getElementById("alert-message");
            if (alertMessage) {
                alertMessage.style.display = "none";
            }
        }, 5000);
    </script>';
}

// Check if there are any records after deletion

// Add the Clear History button with confirmation
echo '<form method="post" class="text-center" onsubmit="return confirm(\'Are you sure you want to delete all data?\');">
    <button type="submit" name="clear_history" class="btn btn-danger">Clear History</button>
</form>';
?>

</div>
</div>
</div>



<?php
include('includes/footer.php')
?>