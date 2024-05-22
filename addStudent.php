<?php
session_start();
$email = ($_POST["MailAddress"]);
$StudentName = ($_POST["StudentName"]);
$phone = ($_POST["Phone"]);
$exam_id = ($_POST["exam_id"]);
$servername = "localhost";
$username = "root";
$password = "Harshit2053@";
$dbname = "examweb";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM exams where exam_id = '$exam_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()){


if (empty($email)) {
    header("Location: dashboard.php?error=emailrequired");
    exit();
}
if (empty($StudentName)) {
    header("Location: dashboard.php?error=StudentNameRequired");		
    exit();
}

if (empty($phone)) {
    header("Location: dashboard.php?error=PhoneRequired");		
    exit();
}

$userid = uniqid();  
$userID = $email."_".$userid;
$password = bin2hex(random_bytes(8));  

$sql = "INSERT INTO students (name,email,phone,userID,pass,exam_id,status) VALUES ('$StudentName','$email','$phone','$userID','$password','$exam_id','no')";

if ($conn->query($sql) === TRUE) {
   
    $mail = new PHPMailer(true);
    $scheduledDate = $row['scheduledDate'];

    //Server settings
                        
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'harshitbakhshi83@gmail.com';                     
    $mail->Password   = 'beahqxvyacvarnkw';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;     
    
    $mail->setFrom('harshitbakshi83@gmail.com');

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject=("Login credentials");

    $mail->Body = "Hi, $StudentName Your Login credentials for the test to be held on $scheduledDate are : User ID =  $userID Password= $password ";

    $mail->send();
    header("Location: Student-list.php?ExamId=$exam_id");
}else{
    header("Location: Student-list.php.php?ExamId=$exam_id?FailedToAddStudent");
}
}
}
?>