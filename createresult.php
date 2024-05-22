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
    $correct=0;
    $wrong=0;


    if(isset($_SESSION['answer'])){
        $sql = "UPDATE students  SET status='finished' WHERE student_id='$_SESSION[studentID]'";     
        if ($conn->query($sql) === TRUE) {   
        for($i=0;$i<=sizeof($_SESSION["answer"]);$i++){
            $answer="";
            $sql = "SELECT * FROM questions WHERE exam_id='$_SESSION[exam_id]' AND questionNumber='$i'";
            $result = mysqli_query($conn, $sql);
             while($row = $result->fetch_assoc()) {    
                $answer =$row["answer"];
             }
            if(isset($_SESSION["answer"][$i])){
                if($answer==$_SESSION["answer"][$i]){
                    $correct = $correct+1;
                }
                else{
                    $wrong=$wrong+1;
                }
            }
            else{
                $wrong=$wrong+1;
            }
            
            }}
            $sql = "SELECT * FROM exams WHERE exam_id='$_SESSION[exam_id]'";
            $result = mysqli_query($conn, $sql);
             while($row = $result->fetch_assoc()) {   
              $correctmarks=  $row["correctMarks"]*$correct;
              $wrongmarks = $row["wrongMarks"]*$wrong;
            $total_marks = $correctmarks + $wrongmarks;
            $_SESSION["scheduledDate"]=$row["scheduledDate"];
            $_SESSION["title"]=$row["title"];
            $_SESSION["totalQuestions"]=$row["totalQuestions"];
             }

             $exam_id = $_SESSION["exam_id"];
             $name = $_SESSION["name"];
             $email = $_SESSION["email"];
             $student_id=$_SESSION['studentID'];
             $start_time = $_SESSION["start_time"];
           
             $duration = strtotime("$_SESSION[duration] minutes");
            if(isset($_SESSION["exam_start"])){
                $date=date("Y-m-d H:i:s");
                $response_time=strtotime("$date-$start_time");
                $sql = "INSERT INTO results (name,email,start_time,end_time,duration,response_time,total_scores,exam_id,student_id) VALUES ('$name','$email','$start_time','$date','$_SESSION[duration]','$response_time','$total_marks','$exam_id','$student_id')";
                if ($conn->query($sql) === TRUE) {
                    header("Location: viewresult.php");
                  
            
        }
        else{
            header("Location: login.php");
        }
    }    }  
    ?>