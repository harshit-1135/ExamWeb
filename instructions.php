<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/instructions.css">
    <script src="https://kit.fontawesome.com/00ab3c0205.js" crossorigin="anonymous"></script>
    <title>Instructions</title>
</head>
<body>
    <?php session_start();
    echo $_SESSION["difference"] ?>
    
<div id="nav">
        <div id="logo">

        </div>
</div>

<div id="instructions">
    <h1><span>Instruction : </span></h1>
    <li><h4>Lorem ipsum dolor sit, amet consectetur adipisicing.</h4>
    </li>
    <li><h4>Lorem ipsum dolor sit, amet consectetur adipisicing.</h4>
    </li>
    <li><h4>Lorem ipsum dolor sit, amet consectetur adipisicing.</h4>
    </li>
    <li><h4>Lorem ipsum dolor sit, amet consectetur adipisicing.</h4>
    </li>
    <li><h4>Lorem ipsum dolor sit, amet consectetur adipisicing.</h4>
    </li>
    <li><h4>Lorem ipsum dolor sit, amet consectetur adipisicing.</h4>
    </li>
    <li><h4>Lorem ipsum dolor sit, amet consectetur adipisicing.</h4>
    </li>

    <hr>
    <h2>Customization : </h2>

    <span id="sample">This is sample text</span>

    <div class="slidecontainer">
        <form action="customization.php" method="post">
        <h3>Select Font Size : </h3>
    <input type="range" min="1" max="4" value="50" class="slider" id="myRange" name="myRange">
    </div>

    <label for="favcolor">Select font color:</label>
  <input type="color" id="favcolor" name="favcolor" value="#ff0000">

    <input type="submit" id="next-step" value="Next >>">
    </form>
</div>

<script>
    var slider = document.getElementById("myRange");
var output = document.getElementById("sample");
output.style.height = slider.value+"em";

slider.oninput = function() {
    output.style.fontSize = this.value+"em";
}

var colorpicker = document.getElementById("favcolor");
output.style.color=colorpicker.value;

colorpicker.oninput = function(){
    output.style.color=this.value;
}
</script>
</body>
</html>