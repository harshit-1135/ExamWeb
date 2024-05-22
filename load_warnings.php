<?php
session_start();
$student_id = $_SESSION["studentID"];
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

    $sql = "SELECT * from students where student_id='$student_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
   
    // output data of each row
    while($row = $result->fetch_assoc()) { 
        $warnings = $row["warnings"];
    }}
        if($warnings=='1'){
            ?><h1>You have got one warning</h1>
            <script>ShowChat();</script>
            <?php
        }
        else if($warnings==2){
            ?><h2>You have got two warnings</h2>
            <p>Your exam will be canceled if you misbehave again</p>
            <script>document.getElementById("chat").style.display="block";</script>
            <?php
        }
       else if($warnings==3)
       {
        echo '3';
       }




?>