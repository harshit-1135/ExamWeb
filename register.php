<?php

$name = val($_POST["name"]);  
$email = val($_POST["email"]); 
$pass = val($_POST["pass"]); 
$ConfirmPass = val($_POST["ConfirmPass"]);  


$passwordd = password_hash($pass,PASSWORD_BCRYPT);

$token = bin2hex(random_bytes(15));

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
function val($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';



    if(empty($name)){
        header("Location: signup.php?error=NameRequired");
        exit();}

if(empty($email)){
header("Location: signup.php?error=MailAddressrequired");
exit();
}

if(empty($pass)){
header("Location: signup.php?error=Passwordrequired");
exit();
}
if(empty($ConfirmPass)){
header("Location: signup.php?error=pleaseconfirmpassword");
exit();
}
if($pass != $ConfirmPass){
	header("Location: signup.php?error=notmatching");
exit();
} 

 $sql = "SELECT * FROM online_exam_teacher WHERE email='$email'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['email'] === $email ){
				
				   header("Location: signup.php?error=alreadyexists");
                

                exit();

		}
	
		
		}
else { 
    $sql = "INSERT INTO online_exam_teacher (name,email,Passwordd,token,Activity) VALUES ('$name','$email','$passwordd','$token','inactive')";
    if ($conn->query($sql) === TRUE) {
        $mail = new PHPMailer(true);


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
    
        $mail->Subject=("Email verification");
    
        $mail->Body = "Hi, $FirstName click here to activate your account http://localhost/4th_semester/ExamWebNew/verify.php?token=$token";

        $mail->send();
    
        header("Location: login.php?mailsent");}
        else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } 
    
    }
$conn->close();
?>