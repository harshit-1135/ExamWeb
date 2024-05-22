    
    <!-- <link rel="stylesheet" href="css/exam.css"> -->
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Harshit2053@";
$dbname = "examweb";
$student_id = $_SESSION['studentID'];
$exam_id = $_SESSION['exam_id'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$exam_id = $_SESSION['exam_id'];
$questionNo ="";
$question ="";
$opt1 ="";
$opt2 ="";
$opt3 ="";
$opt4 ="";

$answer="";
$ans="";

$queno = $_GET['questionNumber'];
if(isset($_SESSION["answer"][$queno])){
  $ans = $_SESSION["answer"][$queno];
}

$sql = "SELECT * from questions where exam_id='$exam_id' AND questionNumber='$queno'";
$result = $conn->query($sql);

$sql2 = "SELECT * from customizations where student_id='$student_id'";
$result2 = $conn->query($sql2);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {    

        $questionNo = $row['questionNumber'];
        $question = $row['question'];
        $opt1 = $row['option1'];
        $opt2 = $row['option2'];
        $opt3 = $row['option3'];
        $opt4 = $row['option4'];
    }
    if($result2->num_rows>0){
      while($row2=$result2->fetch_assoc() ){
        $fontsize=$row2["font_size"];
        $color=$row2["color"];
      }
    }
    ?>
   
                <h2 style="font-size:<?php echo $fontsize;?>em; color:<?php echo $color;?>" id="Question">Q<?php echo $questionNo.". ".$question;?></h2>
                <h3 style="font-size:<?php echo $fontsize;?>em; color:<?php echo $color;?>" class="options">A. <?php echo $opt1;?></h3>
                <h3 style="font-size:<?php echo $fontsize;?>em; color:<?php echo $color;?>" class="options">B. <?php echo $opt2;?></h3>
                <h3 style="font-size:<?php echo $fontsize;?>em; color:<?php echo $color;?>" class="options">C. <?php echo $opt3;?></h3>
                <h3 style="font-size:<?php echo $fontsize;?>em; color:<?php echo $color;?>" class="options">D. <?php echo $opt4;?></h3>

                <label style="font-size:<?php echo $fontsize;?>em; color:<?php echo $color;?>" class="form-container">A
  <input type="radio" name="radio" value="1" <?php if($ans=='1'){
    echo "checked";
  }?> onclick="radioclick(this.value,<?php echo $questionNo ?>);">
  <span class="checkmark"></span>
</label>
<label style="font-size:<?php echo $fontsize;?>em; color:<?php echo $color;?>" class="form-container">B
<input type="radio" name="radio" <?php if($ans=='2'){
    echo "checked";
  }?> value="2" onclick="radioclick(this.value,<?php echo $questionNo ?>);">
  <span class="checkmark"></span>
</label>
<label style="font-size:<?php echo $fontsize;?>em; color:<?php echo $color;?>" class="form-container">C
  <input type="radio" name="radio" <?php if($ans=='3'){
    echo "checked";
  }?> value="3" onclick="radioclick(this.value,<?php echo $questionNo ?>);">
  <span class="checkmark"></span>
</label>
<label style="font-size:<?php echo $fontsize;?>em; color:<?php echo $color;?>" class="form-container">D
  <input type="radio" name="radio" <?php if($ans=='4'){
    echo "checked";
  }?> value="4" onclick="radioclick(this.value,<?php echo $questionNo ?>);">
  <span class="checkmark"></span>
</label>

<?php }
else{?>
  <h1 style="font-size:<?php echo $fontsize;?>em; color:<?php echo $color;?>">Your exam is finished click next to submit the exam and check result.
    
  </h1>
 <a href="createresult.php"> <button  id="next-step">Next >></button>	</a>
<?php }

?>



