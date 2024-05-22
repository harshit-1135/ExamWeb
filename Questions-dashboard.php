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
        $sql = "SELECT * FROM questions where exam_id='$exam_id'";
        $result = $conn->query($sql);
    ?>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>Ex<span>amGround</span></h3>
        </div>t
        

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
                <h1>User Dashboard</h1>
                <small>Home / Dashboard / Exam Details</small>
            </div>
            
            <div class="page-content">
            
            <div class="modal hidden">
            <h2 id="closeModal" style="float: right"><i class="fa-solid fa-x"></i></h2>
            <form action="addQuestion.php" method="post">
            <input type="text" class="form-field animation a3" placeholder="Question Number" id="questionNumber" name="questionNumber">
                <input type="text" class="form-field animation a3" placeholder="Question" id="Question" name="Question">
                <input type="text" class="form-field animation a3" placeholder="Option 1" id="Option1" name="Option1">
                <input type="text" class="form-field animation a4"id="Option2" name="Option2" placeholder="Option 2">
                <input type="text" class="form-field animation a4"id="Option3" name="Option3" placeholder="Option 3">
                <input type="text" class="form-field animation a4"id="Option4" name="Option4" placeholder="Option 4">
                <input type="text" class="form-field animation a4"id="Answer" name="Answer" placeholder="Answer">
                <input type="hidden" name="exam_id" id="exam_id" value="<?php echo "$exam_id" ?>">
                <input type="submit" value="Add Question" class="animation a6" id="Buttonn">
            </form>
            </div>
            <div class="overlay hidden"></div>


                <div class="records table-responsive">

                    <div class="record-header">
                        <div class="add">
                            <span>Questions</span>
                            <h2 id="AddExam"><i class="fa-solid fa-plus"></i></h2>
                        </div>
                    </div>

                    <div id="Exams">
                        <table width="100%">
                            <thead>
                       
                                <tr>
                                    <th>ID</th>
                                    <th><span class="las la-sort"></span> Question</th>
                                    <th><span class="las la-sort"></span> Option 1</th>
                                    <th><span class="las la-sort"></span> Option 2</th>
                                    <th><span class="las la-sort"></span> Option 3</th>
                                    <th><span class="las la-sort"></span> Option 4</th>
                                    <th><span class="las la-sort"></span> Answer</th>
                                    <th><span class="las la-sort"></span> Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {    
	?>	
                                <tr>
                                    <td><?php echo $row['questionNumber']?></td>
                                    <td>
                                        <div class="Exam-title">
                                
                                            <div class="Exam-title-info">
                                                <h4><?php echo $row['question']?></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                    <?php echo $row['option1']?>
                                    </td>
                                    <td>
                                    <?php echo $row['option2']?>
                                    </td>
                                    <td>
                                    <?php echo $row['option3']?>
                                    </td>
                                    <td>
                                    <?php echo $row['option4']?>
                                    </td>
                                    <td>
                                    <?php echo $row['answer']?>
                                    </td>
                                    <td>
                                        <div class="actions">
                                        <a href="deletequestion.php?question_id=<?php echo $row['question_id']?>"> <span class="fa-solid fa-trash"></span></a>

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



    </script>
    <?php }
    else {
        header("Location: login.php");
    } ?>
</body>
</html>