<?php
session_start();
$userID = $_SESSION['id'];
$title =($_POST["title"]);
$Duration = ($_POST["Duration"]);
$totalQuestions = ($_POST["totalQuestions"]);
$RQMarks = ($_POST["RQMarks"]);
$WQMarks = ($_POST["WQMarks"]);
$scheduledDate = ($_POST["scheduledDate"]);
$currentDate = ($_POST["currentDate"]);
$newscheduledDate = explode("T",$scheduledDate);
$ScheduledDate =  $newscheduledDate[0]." ".$newscheduledDate[1];

$servername = "localhost";
$username = "root";
$password = "Harshit2053@";
$dbname = "examweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (empty($title)) {
    header("Location: dashboard.php?error=titleRequired");
    exit();
}
if (empty($Duration)) {
    header("Location: dashboard.php?error=DurationRequired");		
    exit();
}

if (empty($totalQuestions)) {
    header("Location: dashboard.php?error=totalQuestionsRequired");
    exit();
}
if (empty($RQMarks)) {
    header("Location: dashboard.php?error=RQMarksRequired");		
    exit();
}
if (empty($WQMarks) and $WQMarks!=0) {
    header("Location: dashboard.php?error=WQMarksRequired");		
    exit();
}
if (empty($scheduledDate )) {
    header("Location: dashboard.php?error=scheduledDateisrequired");		
    exit();
}

$sql = "INSERT INTO exams (title,duration,totalQuestions,correctMarks,wrongMarks,scheduledDate,creationDate,userID) VALUES ('$title','$Duration','$totalQuestions','$RQMarks','$WQMarks','$ScheduledDate','$currentDate','$userID')";

if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php?examAdded");
}
?>