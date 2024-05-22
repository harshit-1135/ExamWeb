<?php
session_start();

$email = trim($_POST["email"]);
$pass = trim($_POST["pass"]);
$passwordd = password_hash($pass, PASSWORD_BCRYPT);

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

if (empty($email)) {
    header("Location: login.php?error=MailAddressrequired");
    exit();
}
if (empty($pass)) {
    header("Location: login.php?error=Passwordisrequired");		
    exit();
}

$sql = "SELECT * FROM online_exam_teacher WHERE email='$email' AND Activity='active'";
$result = mysqli_query($conn, $sql);
$email_count = mysqli_num_rows($result);

$sql2 = "SELECT * FROM invigilators WHERE userID='$email'";
$result2 = mysqli_query($conn, $sql2);
$email_count2 = mysqli_num_rows($result2);

$sql3 = "SELECT * FROM students WHERE userID='$email'";
$result3 = mysqli_query($conn, $sql3);
$email_count3 = mysqli_num_rows($result3);

if ($email_count) {
    $email_pass = mysqli_fetch_assoc($result);
    $db_pass = $email_pass['Passwordd'];

    if (password_verify($pass, $db_pass)) {
        $_SESSION['id'] = $email_pass['id'];
        $_SESSION['name'] = $email_pass['name'];
        header("Location: dashboard.php");	
        exit();
    } else {
        header("Location: login.php?error=IncorectMailAddressorpassword");			
        exit();
    }
} else if($email_count2) {
    $email_pass = mysqli_fetch_assoc($result2);
    if($email==$email_pass['userID'] and $pass==$email_pass['pass'] ){
        $_SESSION['invigilatorid'] = $email_pass['invigilator_id'];
        $_SESSION['name'] = $email_pass['name'];
        $_SESSION['exam_id'] = $email_pass['exam_id'];
        header("Location: invigilator.php");	
        exit();
    }
    
}
else if($email_count3) {
    $email_pass = mysqli_fetch_assoc($result3);
    if($email==$email_pass['userID'] and $pass==$email_pass['pass'] and $email_pass['status']==="no"){
        $_SESSION['studentID'] = $email_pass['student_id'];
        $_SESSION['name'] = $email_pass['name'];
        $_SESSION['email'] = $email_pass['email'];
        $_SESSION['exam_id'] = $email_pass['exam_id'];
        $sql3 = "SELECT * FROM exams WHERE exam_id='$_SESSION[exam_id]'";
$result4 = mysqli_query($conn, $sql3);
$email_count3 = mysqli_num_rows($result4);
if($email_count3) {
    $email_pass2 = mysqli_fetch_assoc($result4);
    $scheduledTime = $email_pass2["scheduledDate"];
    $time = date("Y-m-d H:i:s");
    if(strtotime($time)>strtotime($scheduledTime)){
       $_SESSION["difference"]=strtotime($time)-strtotime($scheduledTime);
        $sql = "UPDATE students  SET AttemptTime='$time' WHERE student_id='$_SESSION[studentID]'";
    if ($conn->query($sql) === TRUE) {   
        $sql = "UPDATE students  SET status='started' WHERE student_id='$_SESSION[studentID]'";     
        if ($conn->query($sql) === TRUE) {   
        header("Location: instructions.php");	
        exit();
   
    }}}
    else{
        header("Location: login.php?examnotstarted");	
    }
}} 
    else if($email_pass["status"]=="started"){
        $_SESSION['studentID'] = $email_pass['student_id'];
        $_SESSION['name'] = $email_pass['name'];
        $_SESSION['email'] = $email_pass['email'];
        $_SESSION['exam_id'] = $email_pass['exam_id'];
        $_SESSION['AttemptTime'] = $email_pass['AttemptTime'];
        $_SESSION['start_time'] = $_SESSION['AttemptTime'];
        $_SESSION["exam_start"]="yes";
        header("Location: exam.php");
    }
    else if($email_pass["status"]=="finished"){
        $_SESSION['studentID'] = $email_pass['student_id'];
        $_SESSION['name'] = $email_pass['name'];
        $_SESSION['email'] = $email_pass['email'];
        $_SESSION['exam_id'] = $email_pass['exam_id'];
        header("Location: viewresult.php");
    }

}

else{
    header("Location: login.php?error=IncorectMailAddressorpassword");			
    exit();
}
?>
