<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <title>Signup</title>
</head>
<body>
    <div id="nav">
        <div id="logo">

        </div>
    </div>
    <div class="container">
        <div id="login-form">
            <h3 class="animation a1" id="title">Signup</h3>
            <div class="form">
            <form action="register.php" method="post">
                <input type="Name" class="form-field animation a3" placeholder="Name" id="name" name="name">
                <input type="email" class="form-field animation a3" placeholder="Email Address" id="email" name="email">
                <input type="password" class="form-field animation a4"id="pass" name="pass" placeholder="Password">
                <input type="password" class="form-field animation a4"id="ConfirmPass" name="ConfirmPass" placeholder="Confirm Password">
                <input type="submit" value="Signup" class="animation a6" id="Buttonn">
            </form>
        </div>
        </div>
        <div id="image-side">

        </div>
    </div>

    <script>
        let screenSize = screen.width
        if(screenSize<=715){
            setTimeout(function() {
        
        document.getElementById('image-side').style.display='none'
      }, 2*1000);
        }

       
   
</script>

</body>
</html>