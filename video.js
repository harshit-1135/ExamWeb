var videoElem = document.getElementById("MyVideo")

var recorder;
const settings ={
    video:  true,
    audio: true
}
var myVar;

function startCamera(){
    document.getElementById("EndExam").style.display="block";
    document.getElementById("StartExam").style.display="none";



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
            document.body.insertBefore(newVideoEl, endBtn);
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
document.addEventListener("DOMContentLoaded",function(){
    myVar = setInterval("oneMinOver()", 10000);
});