<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/result.css">
    <script src="https://kit.fontawesome.com/00ab3c0205.js" crossorigin="anonymous"></script>
    <title>Result</title>
</head>
<body>
   <?php session_start(); 
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
   $student_id = $_SESSION["studentID"];
   $exam_id = $_SESSION["exam_id"];
   $sql = "SELECT * FROM results WHERE student_id='$_SESSION[studentID]'";
   $result = mysqli_query($conn, $sql);
   $email_count3 = mysqli_num_rows($result);
   if($email_count3) {
       $row = mysqli_fetch_assoc($result);
       $start_time= $row["start_time"];
       $end_time=  $row["end_time"];
       $Duration =$row["duration"];
       $total_marks = $row["total_scores"];


    $sql2 = "SELECT * FROM exams WHERE exam_id='$exam_id'";
   $result2 = mysqli_query($conn, $sql2);
   $email_count2 = mysqli_num_rows($result2);
   if($email_count2) {
    $row2 = mysqli_fetch_assoc($result2);
    $scheduledDate=$row2["scheduledDate"];
    $title=$row2["title"];
    $totalQuestions=$row2["totalQuestions"]; 
    $totalQuestions=$row2["totalQuestions"];
    $correctMarks=$row2["correctMarks"];

    $sql3 = "SELECT * FROM students WHERE student_id='$_SESSION[studentID]'";
    $result3 = mysqli_query($conn, $sql3);
    $email_count3 = mysqli_num_rows($result3);
    if($email_count3) {
     $row3 = mysqli_fetch_assoc($result3);
     $photo=$row3["photo"];

   ?>
<div id="nav">
        <div id="logo">

        </div>
</div>
<div class="container">
    <div id="left-side">
        <div id="image">
            <img src="<?php echo $photo?>" alt="">
        </div>
    </div>
    <div id="right-side">
        <div id="Name">
            <h2><strong><?php echo $_SESSION["name"];?></strong> </h2>
        </div>
        <div class="row2">
            <div id="TestID">
            <h3><span>Test ID :</span>  #<?php echo $exam_id ;?></h3>
            </div>
            <div id="Mail">
                <h3><span class="fa-solid fa-envelope"></span><?php echo $_SESSION["email"];?><h3>
            </div>
        </div>
        <div id="TestDate">
            <h3><span>Test Date :</span> <?php echo $scheduledDate;?></h3>
            <h1></h1>
        </div>
    </div>
</div>
<div class="container2">
    <div id="title">
        <h1>Assessment Details</h1>
    </div>
    <div class="row2">
            <div id="TestID">
            <h3><span>Project Name / ID </span> : <?php echo $title;?></h3>
            </div>
            <div id="Mail">
                <h3><span> Total Questions </span> : <?php echo  $totalQuestions; ?><h3>
            </div>
        </div>
        <div  lass="row2">
            <div id="TestID">
            <h3><span>Start Date / Time </span> :  <?php echo $start_time;?></h3>
            </div>
            <div id="Mail">
                <h3><span>End Date / Time </span> : <?php echo $end_time;?><h3>
            </div>
        </div>
        <div class="row2">
            <div id="TestID">
            <h3><span>Total time </span>  : <?php echo $Duration." minutes";?></h3>
            </div>
  
        </div>
  
</div>
<div class="container2">
<div id="title">
        <h1><span>Total Scores</span> : <?php echo $total_marks;?>/<?php echo ($totalQuestions*$correctMarks);?> </h1>
        
    </div>
    <?php } } }?>
</div>
</body>
</html>