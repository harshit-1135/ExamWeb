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
            </div>
            


                <div class="records table-responsive">

                    <div class="record-header">
                        <div class="add">
                            <span>All Students</span>
                            <h2 id="AddExam"><i class="fa-solid fa-plus"></i></h2>
                        </div>
                    </div>

                    <div id="Exams">
   
                    </div>
              </div>

            </div>
            
        </main>
        
    </div>

    <script>

load_invigilator();
function load_invigilator() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
    
        document.getElementById("Exams").innerHTML = this.responseText;
      
    }
  };  
  xmlhttp.open("GET", "load_invigilator.php", true);
  xmlhttp.send();
}
var myVar;
document.addEventListener("DOMContentLoaded",function(){
    myVar = setInterval("load_invigilator()", 10000);
});
    </script>
</body>
</html>