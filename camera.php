<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/camera.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.24/webcam.js"></script>
    <script src="https://kit.fontawesome.com/00ab3c0205.js" crossorigin="anonymous"></script>
    <title>Click your photo </title>
</head>
<body>
    <?php session_start();
   echo strtotime($_SESSION["end_time"])-strtotime(date("Y-m-d H:i:s"));

   ?>
    
<div id="nav">
        <div id="logo">

        </div>
</div>

<div id="instructions">
    <h1><span>Click your photo : </span></h1>
    <form action="savephoto.php" method="post">
    <div id="my_camera" class="pre_capture_frame" ></div>
    <input type="hidden" name="image" id="captured_image_data">
    <input type="button" class="Capture_Button" value="Take Snapshot" onClick="take_snapshot()"> 
    <hr>
    <h1><span>Captured Photo</span></h1>
		<div id="results" >
			<img style="width: 350px;" class="after_capture_frame" />
		</div>
		<br>
		<button type="submit" class="Capture_Button" >Next</button>
    </form>
       <script language="JavaScript">
            Webcam.set({
             width: 350,
             height: 287,
             image_format: 'jpeg',
             jpeg_quality: 90
            });	 
            Webcam.attach( '#my_camera' );
           
           function take_snapshot() {
            
            Webcam.snap( function(data_uri) {
                $("#captured_image_data").val(data_uri);
            document.getElementById('results').innerHTML = 
             '<img class="after_capture_frame" src="'+data_uri+'"/>';
            
            });	 
           }
       
       
       </script>

</body>
</html>