<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/exam.css">
    <script src="https://kit.fontawesome.com/aae27bcfc8.js" crossorigin="anonymous"></script>
    <title>Exam</title>
</head>
<body onload="startCamera();">
<div id="nav">
        <div id="logo">
        <div id="timer-mob">
             <h2>10:10</h2>
        </div>
        </div>
       
    </div>
   <div class="container">
   
        <div id="left-side">
        <div id="q-ans"></div>   

        <div id="nav-panel-mob">
        <button id="Prev-Question" onclick="load_previous();" class="nav-button"><i class="fa-solid fa-arrow-left"></i></button>
        <button id="Next-Question" onclick="load_next();" class="nav-button"><i class="fa-solid fa-arrow-right"></i></button>        </div>
        </div>
            
        <div id="right-side">

            <div id="menu">
                <div id="timer">
                    <h2>10:10</h2>
                </div>
                <div id="ButtonPannel">
                    <h2 class="menuButton"  onclick="ShowVideo()" ><i class="fa-solid fa-video"></i><span id="huh"><span id="huhhh">Show </span> Video</span> </h2>
                    <h2 class="menuButton"  onclick="ShowChat()" ><i class="fa-solid fa-comment"></i><span id="huh"><span id="huhh">Show </span>Warnings</span></h2>
                </div>
                <div id="video">

                <video autoplay="false"  width="100%" height="100%" id="MyVideo" muted style="display:none" ></video>
                <button id="EndExam" style="display:none">End Exam</button>
  
              </div>
                <div id="chat">
                  
                </div>
                <div id="nav-panel">
                    <button id="Prev-Question" onclick="load_previous();" class="nav-button"><i class="fa-solid fa-arrow-left"></i></button>
                    <button id="Next-Question" onclick="load_next();" class="nav-button"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
   </div>


   <script>
    var video=0;
    var chat=0;
    function ShowVideo(){
        if(video==0 && chat==0){
            document.getElementById("video").style.display="block";
            document.getElementById("MyVideo").style.display="block";
            video=1;
        }
        else if(video==0 && chat==1){ 
            document.getElementById("video").style.display="block";
            document.getElementById("MyVideo").style.display="block";
            document.getElementById("chat").style.display="none";
            chat=0;
            video=1;
        }
        else{
            document.getElementById("video").style.display="none";
            document.getElementById("MyVideo").style.display="none";
            video=0;
        }
        

    }
    function ShowChat(){
        if(chat==0 && video==0){
            document.getElementById("chat").style.display="block";
            chat=1;
        }
        else if(chat==0 && video==1){
            document.getElementById("chat").style.display="block";
            document.getElementById("video").style.display="none";
            chat= 1;
            video=0;
        }
        else{
            document.getElementById("chat").style.display="none";
            chat=0;
        }
        
    }
    setInterval(function() {
  timer();
}, 1000);

var questionNumber = 1;
load_questions(questionNumber);

function load_questions(questionNumber) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText === "00:00:00") {
        window.location = "viewresult.php";
      } else {
        document.getElementById("q-ans").innerHTML = this.responseText;
      }
    }
  };

  xmlhttp.open("GET", "load_questions.php?questionNumber=" + questionNumber, true);
  xmlhttp.send();
}


    function load_previous(){
        if(questionNumber==1){
            load_questions(questionNumber);
        }
        else{
            questionNumber= questionNumber-1;
            load_questions(questionNumber);
        }
    }

    function load_next(){
        
            questionNumber= questionNumber+1;
            load_questions(questionNumber);
        
    }

    function radioclick(radiovalue,questionNo){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){                
                
            }
        };
        xmlhttp.open("GET","saveoptions.php?questionNumber="+questionNo +"&value1="+radiovalue,true);
        xmlhttp.send();
    }
function timer() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText === "00:00:00") {
        window.location = "viewresult.php";
      } else {
        document.getElementById("timer").innerHTML = this.responseText;
        document.getElementById("timer-mob").innerHTML = this.responseText;
      }
    }
  };
  xmlhttp.open("GET", "load_timer.php", true);
  xmlhttp.send();
}
warnings();
function warnings() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText === '3') {
        window.location = "createresult.php";
      } else {
        document.getElementById("chat").innerHTML = this.responseText;
      }
    }
  };
  xmlhttp.open("GET", "load_warnings.php", true);
  xmlhttp.send();
}

setInterval(function() {
  warnings();
}, 1000);


    var videoElem = document.getElementById("MyVideo");
    var navpanel = document.getElementById("nav-panel");

var recorder;
const settings ={
    video:  true,
    audio: true
}
var myVar;

function startCamera(){
   
    navigator.mediaDevices.getUserMedia(settings).then((stream)=>{
        console.log(stream)
        videoElem.srcObject = stream
        recorder = new MediaRecorder(stream)
        recorder.start();
        const blobContainer = [];
                recorder.ondataavailable = function(e){
            blobContainer.push(e.data)
        }
        recorder.onerror = function(e){
            return console.log(e.error || new Error(e.name));
        }
        recorder.onstop= function(e){
            console.log(window.URL.createObjectURL(new Blob(blobContainer)));
            var newVideoEl = document.createElement('video')
            newVideoEl.height = '400'
            newVideoEl.width = '600'
            newVideoEl.autoplay = false
            newVideoEl.controls = false
            newVideoEl.style.display="none"
            newVideoEl.innerHTML = `<source src="${window.URL.createObjectURL(new Blob(blobContainer))}"
             type="video/mp4">`
           
            var formdata = new FormData();
            formdata.append('blobFile', new Blob(blobContainer));
            fetch('uploader.php', {
                method: 'POST',
                body: formdata
            }
            ).then(()=>{
               startCamera();
               

            })


        }

        
        })  
}
function oneMinOver(){
    videoElem.pause();
    recorder.stop();
    
    
}
function screenchangewarning(){
  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){                
                
            }
        };
        xmlhttp.open("GET","screenchangewarning.php",true);
        xmlhttp.send();
}

document.addEventListener("DOMContentLoaded",function(){
    myVar = setInterval("oneMinOver()", 10000);
});

document.addEventListener("visibilitychange",()=>{
  if(document.visibilityState==="hidden"){
    document.title = document.visibilityState;
    screenchangewarning();
  };
})
   </script>
</body>
</html>