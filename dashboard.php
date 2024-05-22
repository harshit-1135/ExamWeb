<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
   <script>
    var currentdate = new Date(); 
var datetime =  currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
   </script>
    <script src="https://kit.fontawesome.com/00ab3c0205.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php session_start(); 
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];

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
        $sql = "SELECT * FROM exams where userID='$id'";
        $result = $conn->query($sql);
    ?>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>Ex<span>amGround</span></h3>
        </div>
        

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="" class="active">
                            <span class="fas fa-th-large"></span>
                            <small>User Dashboard</small>
                        </a>
                    </li>
                    <li>
                       <a href="#Exams">
                            <span class="fa-solid fa-book"></span>
                            <small>My Exams</small>
                        </a>
                    </li>
                    <li>
                       <a href="profile.php">
                            <span class="fas fa-user"></span>
                            <small>My Profile</small>
                        </a>
                    </li>
                    <li>
                       <a href="">
                            <span class="fas fa-question"></span>
                            <small>Help</small>
                        </a>
                    </li>
                    <li>
                      
                            <span class="fas fa-sign-out-alt"></span>
                            <a href="logout.php">
                            <small>Logout</small>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                
                <div class="header-menu">
                    <label for="">
                        <span class="las la-search"></span>
                    </label>
                    
                    
                    <div class="user">
                        <div class="bg-img" style="background-image: url(image/1.jpeg)"></div>
                        
                        <span class="las la-power-off"></span>
                        <span>Logout</span>
                    </div>
                </div>
            </div>
        </header>
        
        
        <main>
            
            <div class="page-header">
                <h1>User Dashboard</h1>
                <small>Home / Dashboard</small>
            </div>
            
            <div class="page-content">
            
            <div class="modal hidden">
            <h2 id="closeModal" style="float: right"><i class="fa-solid fa-x"></i></h2>
            <form action="addExam.php" method="post">
                <input type="text" class="form-field animation a3" placeholder="Exam Title" id="title" name="title">
                <input type="text" class="form-field animation a3" placeholder="Duration in Minutes" id="Duration" name="Duration">
                <input type="text" class="form-field animation a4"id="totalQuestions" name="totalQuestions" placeholder="Total Questions">
                <input type="text" class="form-field animation a4"id="RQMarks" name="RQMarks" placeholder="Marks for correct answers">
                <input type="text" class="form-field animation a4"id="WQMarks" name="WQMarks" placeholder="Marks for incorrect answers">
                <label for="scheduledDate" ><h2 style="margin-top:2em">Attempt Date :</h2></label>
                <input type="datetime-local"class="form-field animation a3" id="scheduledDate" name="scheduledDate">
                <input type="hidden" name="currentDate" id="currentDate">
                <input type="submit" value="Add Exam" class="animation a6" id="Buttonn">
            </form>
            </div>
            <div class="overlay hidden"></div>


                <div class="records table-responsive">

                    <div class="record-header">
                        <div class="add">
                            <span>My Exams</span>
                            <h2 id="AddExam"><i class="fa-solid fa-plus"></i></h2>
                        </div>
                    </div>

                    <div id="Exams">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><span class="las la-sort"></span> Exam Title</th>
                                    <th><span class="las la-sort"></span> Duration</th>
                                    <th><span class="las la-sort"></span> DATE & TIME</th>
                                    <th><span class="las la-sort"></span> Number of questions</th>
                                    <th><span class="las la-sort"></span> ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody><?php
                            if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {    
	?>	
                                <tr>
                                    <td><?php echo $row['exam_id']?></td>
                                    <td>
                                        <div class="Exam-title">
                                
                                            <div class="Exam-title-info">
                                                <h4><?php echo $row['title']?></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $row['duration']?>
                                    </td>
                                    <td>
                                    <?php echo $row['scheduledDate']?>
                                    </td>
                                    <td>
                                    <?php echo $row['totalQuestions']?>
                                    </td>
                                    <td>
                                        <div class="actions">
                                        <a href="Student-list.php?ExamId=<?php echo $row['exam_id']?>"> <span class="fa-solid fa-person"></span></a>
                                           <a href="Questions-dashboard.php?ExamId=<?php echo $row['exam_id']?>"><span class="las la-eye"></span></a> 
                                           <a href="addinvigilator.php?ExamId=<?php echo $row['exam_id']?>"> <span class="fa-solid fa-user-secret"></span></a>
                                           <a href="deleteexam.php?exam_id=<?php echo $row['exam_id'];?>"><span class="fa-solid fa-trash"></span></a> 
                                        </div>
                                    </td>
                                </tr>
                                <?php	
		} 
	?>
                                
                            </tbody>
                        </table>
                        <?php	
	} else {
			echo "0 results";
	}

	
$conn->close();
?>
                    </div>
              </div>

            </div>
            
        </main>
        
    </div>

    <script>
        const modal = document.querySelector(".modal");
const overlay = document.querySelector(".overlay");
const openModalBtn = document.querySelector("#AddExam");
const openModal = function () {
  modal.classList.remove("hidden");
  overlay.classList.remove("hidden");
};
openModalBtn.addEventListener("click", openModal);
const closeModalBtn = document.querySelector("#closeModal");
const closeModal = function () {
  modal.classList.add("hidden");
  overlay.classList.add("hidden");
};
closeModalBtn.addEventListener("click", closeModal);

document.getElementById("currentDate").value=datetime;

    </script>
    <?php }
    else {
        header("Location: login.php");
    } ?>
</body>
</html>