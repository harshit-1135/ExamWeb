<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title> Admin Dashboard</title>
    <link rel="stylesheet" href="./css/admin.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="CSS/profile.css"><link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<link rel="stylesheet" href="css/profile.css">
    <script src="https://kit.fontawesome.com/00ab3c0205.js" crossorigin="anonymous"></script>
</head>
<body>

<?php 
session_start();
$name = $_SESSION["name"];
$name_parts = explode(" ", $name);
$first_name = $name_parts[0];
$last_name = $name_parts[1];
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

$sql = "SELECT * FROM online_exam_teacher where id='$id'";
$result = $conn->query($sql);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){


?>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>Ex<span>amGround</span></h3>
        </div>
        

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="dashboard.php" class="active">
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
                       <a href="">
                            <span class="fas fa-sign-out-alt"><a href="logout.php"></span>
                            <small>Logout</small></a>
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
                        
                    </div>
                </div>
            </div>
        </header>
        
        
		<section class="py-5 my-5">
			<div class="container">
				<h1 class="mb-5">Account Settings</h1>
				<div class="bg-white shadow rounded-lg d-block d-sm-flex">
					<div class="profile-tab-nav border-right">
						<div class="p-4">
							<div class="img-circle text-center mb-3">
								<img src="images/user.png" alt="Image" class="shadow">
							</div>
							<h4 class="text-center"><?php echo "$name"?></h4>
						</div>
						<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
								<i class="fa fa-home text-center mr-1"></i> 
								Account
							</a>
							<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
								<i class="fa fa-key text-center mr-1"></i> 
								Password
							</a>
						
						</div>
					</div>
					
					<form action="updateprofile.php" method="post">
					<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
							<h3 class="mb-4">Account Settings</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										  <label>First Name</label>
										  <input type="text" class="form-control" name="FName" id="FName" value="<?php echo "$first_name";?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										  <label>Last Name</label>
										  <input type="text" class="form-control" name="LName" id="LName" value="<?php echo "$last_name";?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										  <label>Email</label>
										  <input type="text" class="form-control" name="email" id="email" value="<?php echo $row["email"];?>">
									</div>
								</div>

								
								
							</div>
							</form>
							<div>
							<input type="submit" value="Update" class="btn btn-primary">
								<button class="btn btn-light">Cancel</button>
							</div>
						</div>

						<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
						<form action="updatepassword.php" method="post">	
						<h3 class="mb-4">Password Settings</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										  <label>Old password</label>
										  <input type="password" name="oldp" id="oldp" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										  <label>New password</label>
										  <input type="password"name="newp" id="newp" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										  <label>Confirm new password</label>
										  <input type="password" name="newpc" id="newpc"  class="form-control">
									</div>
								</div>
							</div>
							<div>
							<input type="submit" value="Update" class="btn btn-primary">
						</form>
								<button class="btn btn-light">Cancel</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</section>
        
    </div>
<?php }}?>
    <script>
        function showmodel(){
            document.querySelector('.overlay').classList.add('showoverlay');
            document.querySelector('.addpatient').classList.add('showaddpatient');
        }
        function closemodel(){
            document.querySelector('.overlay').classList.remove('showoverlay');
            document.querySelector('.addpatient').classList.remove('showaddpatient');
        }
    </script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>