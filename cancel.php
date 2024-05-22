<?php
$student_id = $_GET["student_id"];
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

    $sql = "UPDATE students  SET warnings='3' WHERE student_id='$student_id'";
    if ($conn->query($sql) === TRUE) {   
        header("Location: invigilator.php");}




?>