<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title> Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://kit.fontawesome.com/00ab3c0205.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php session_start();
        $exam_id = $_GET['ExamId'];
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
            $sql = "SELECT * FROM students where exam_id='$exam_id'";
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
                       <a href="dashboard.php">
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
                <h1>Student details</h1>
                <small>Home / Dashboard / Student details</small>
            </div>
            
            <div class="page-content">
            
            <div class="modal hidden">
            <h2 id="closeModal" style="float: right"><i class="fa-solid fa-x"></i></h2>
            <form action="addStudent.php" method="post">
                <input type="text" class="form-field animation a3" placeholder="Student name" id="StudentName" name="StudentName">
                <input type="text" class="form-field animation a3" placeholder="Mail address" id="MailAddress" name="MailAddress">
                <input type="text" class="form-field animation a4"id="Phone" name="Phone" placeholder="Phone Number">
                <input type="hidden" name="exam_id" id="exam_id" value="<?php echo "$exam_id" ?>">

                <input type="submit" value="Add Details" class="animation a6" id="Buttonn">
            </form>
            </div>
            <div class="overlay hidden"></div>


                <div class="records table-responsive">

                    <div class="record-header">
                        <div class="add">
                            <span>Student List</span>
                            <h2 id="AddExam"><i class="fa-solid fa-plus"></i></h2>
                        </div>
                    </div>

                    <div id="Exams">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><span class="las la-sort"></span> Name</th>
                                    <th><span class="las la-sort"></span> Mail Address</th>
                                    <th><span class="las la-sort"></span> Phone Number</th>
                                    <th><span class="las la-sort"></span> User ID</th>
                                    <th><span class="las la-sort"></span> Marks</th>
                                    <th><span class="las la-sort"></span> Actions</th>
                                </tr>
                            </thead>
                            <tbody><?php
                            if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {    
            $sql = "SELECT * FROM results where student_id='$row[student_id]'";
            $result2 = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row2 = $result2->fetch_assoc()) {  
	?>
                                <tr>
                                    <td><?php echo $row['student_id']?></td>
                                    <td>
                                        <div class="Exam-title">
                                
                                            <div class="Exam-title-info">
                                                <h4><?php echo $row['name']?></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                    <?php echo $row['email']?>
                                    </td>
                                    <td>
                                    <?php echo $row['phone']?>
                                    </td>
                                    <td>
                                    <?php echo $row['userID']?>
                                    </td>
                                    <td>
                                    <?php echo $row2['total_scores']?>
                                    </td>
                                    <td>
                                        <div class="actions">
                                        <a href="deletestudent.php?student_id=<?php echo $row['student_id']?>"> <span class="fa-solid fa-trash"></span></a>
                                    
                                        </div>
                                    </td>
                                </tr>
                                <?php	
                  		}}      		} 
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



    </script>
    <?php }
    else {
        header("Location: login.php");
    } ?>
</body>
</html>