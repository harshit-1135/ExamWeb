<?php
session_start();
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
$exam_id = $_SESSION["exam_id"];
$sql3 = "SELECT * FROM exams WHERE exam_id='$exam_id'";
$result3 = mysqli_query($conn, $sql3);
$email_count3 = mysqli_num_rows($result3);
if($email_count3) {
    $email_pass = mysqli_fetch_assoc($result3);
    $_SESSION['duration'] = $email_pass['duration'];}
    // $_SESSION["scheduledDate"]=$email_pass["scheduledDate"];
if(!isset($_SESSION["end_time"])){
   if(isset($_SESSION["AttemptTime"])){
    $_SESSION["end_time"]=date("Y-m-d H:i:s",strtotime($_SESSION["AttemptTime"]."+$_SESSION[duration] minutes"));
    $time1 = gmdate("H:i:s",strtotime($_SESSION["end_time"])-strtotime(date("Y-m-d H:i:s")));
    if(strtotime($_SESSION["end_time"])<strtotime(date("Y-m-d H:i:s"))){?>
        <h1> 00:00:00 <h1>
    <?php }
    else{
       ?> <h1><?php echo $time1;?> </h1> <?php
    }
   }
}
else{
    $time1 = gmdate("H:i:s",strtotime($_SESSION["end_time"])-strtotime(date("Y-m-d H:i:s")));
    if(strtotime($_SESSION["end_time"])<strtotime(date("Y-m-d H:i:s"))){?>
        <h1> 00:00:00 <h1>
    <?php }
    else{
       ?> <h1><?php echo $time1;?> </h1> <?php
    }

}
?>