height= 270;
width= 480;

function startGame() {
    myGameArea.start();
}
var myGameArea = {
    canvas : document.createElement("canvas"),
    start : function() {
        this.canvas.width = width;
        this.canvas.height = height;
      //  this.canvas.style.cursor = "none"; //hide the original cursor
        this.context = this.canvas.getContext("2d");
        document.body.insertBefore(this.canvas, document.body.childNodes[0]);
        this.frameNo = 0; 
        this.interval = setInterval(updateGameArea, 20);

        window.addEventListener('mousemove', function (e) {
            myGameArea.x = e.pageX;
            myGameArea.y = e.pageY;
            myGamePiece.image.src = "images/bird3.png";
          //  accelerate(-0.25);
        })
        
        window.addEventListener('touchstart', function (e) {
  //          myGameArea.keys = (myGameArea.keys || []);
 
            myGamePiece.image.src = "images/bird3.png";
        //  if(e.touches.length>1) alert(e.touches.length);
            //dual finger tap work the good
            accelerate(-0.25/4);
        //  accelerate(-0.25);
        })

/*
        window.addEventListener('touchmove', function (e) {
  //          myGameArea.keys = (myGameArea.keys || []);
            myGamePiece.image.src = "images/bird3.png";
          //  if(e.touches.length>1) alert(e.touches.length);
            //dual finger tap work the good
            accelerate(-0.25);
          //  accelerate(-0.25);
        })
  */      window.addEventListener('touchend', function (e) {
                myGamePiece.image.src = "images/bird2.png";
                accelerate(0.05);//  accelerate(-0.25);
            
        })
        window.addEventListener('keydown', function (e) {
   //         myGameArea.keys = (myGameArea.keys || []);
            //myGameArea.keys[e.keyCode] = true;
            myGamePiece.image.src = "images/bird3.png";
            accelerate(-0.25);
        })
        window.addEventListener('keyup', function (e) {
          //  myGameArea.keys[e.keyCode] = false; 
            myGamePiece.image.src = "images/bird2.png";
            accelerate(0.05);
        })
   },
    clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    },
    stop : function() {
        clearInterval(this.interval);
        mySound.stop();
        mySound = new sound("death","sounds/die.mp3");
        mySound.play();
    }
}

function sound(val,src) {
    this.sound = document.createElement("audio");
    this.sound.src = src;
    this.sound.setAttribute("preload", "auto");
    if(val=="background"){
        this.sound.setAttribute("loop", "loop");
    }
    this.sound.setAttribute("controls", "none");
    this.sound.style.display = "none";
    //document.body.appendChild(this.sound);
    this.play = function(){
        this.sound.play();
    }
    this.stop = function(){
        this.sound.pause();
    }
}

