<?php
session_start();
$userID = $_SESSION['id'];
$Question =($_POST["Question"]);
$Option1 = ($_POST["Option1"]);
$Option2 = ($_POST["Option2"]);
$Option3 = ($_POST["Option3"]);
$Option4 = ($_POST["Option4"]);
$Answer = ($_POST["Answer"]);
$exam_id = ($_POST["exam_id"]);
$questionNumber = ($_POST["questionNumber"]);
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

if (empty($Question)) {
    header("Location: dashboard.php?error=questionRequired");
    exit();
}
if (empty($Option1) AND $Option1!=0) {
    header("Location: dashboard.php?error=Option1Required");		
    exit();
}

if (empty($Option2) AND $Option2!=0) {
    header("Location: dashboard.php?error=Option2Required");		
    exit();
}
if (empty($Option3) AND $Option3!=0) {
    header("Location: dashboard.php?error=Option3Required");		
    exit();
}
if (empty($Option4) AND $Option4!=0) {
    header("Location: dashboard.php?error=Option4Required");		
    exit();
}
if (empty($Answer )) {
    header("Location: dashboard.php?error=AnswerRequired");		
    exit();
}

$sql = "INSERT INTO questions (question,questionNumber,option1,option2,option3,option4,answer,exam_id) VALUES ('$Question','$questionNumber','$Option1','$Option2','$Option3','$Option4','$Answer','$exam_id')";

if ($conn->query($sql) === TRUE) {
    header("Location: Questions-dashboard.php?ExamId=$exam_id");
}
else{
    header("Location: Questions-dashboard.php?ExamId=$exam_id?FailedToAddQuestion");
}
?>