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
        $warnings = $warnings + 1;
    $sql = "UPDATE students  SET warnings='$warnings' WHERE student_id='$student_id'";
    if ($conn->query($sql) === TRUE) {   
    }




?>