
var button3 = document.getElementById("button3");
var ctxb3 = button3.getContext("2d");
button3.width = 66;
button3.height = 63;


var buttonI3 = new Image();
buttonI3.src = "images/templates/button.png";

buttonI3.onload = function(){
    ctxb3.drawImage(buttonI3,0, 0);
    
};

button3.onmousedown = function(){
    buttonclicked3=true;
    var e = $.Event("keydown", { keyCode: 39}); //"keydown" if that's what you're doing
    $("body").trigger(e);
};

button3.onmouseup = function(){button3clicked()};
var button3clicked = function(){
    if(buttonclicked3){
        if(!pet.isBusy){
            iconstat=5;
            changeIcon();
        }
        
        else if (trainGameInProgress){
            userChoice = 3;
            playoutTrain();
        }
        else if (sickGameInProgress){
            if (syringePos < 3)
                syringePos++;
        }
        
        else if(lightscreen){
            pet.isBusy=false;
            lightscreen=false;
            var buttonI1 = new Image();
            buttonI1.src = "images/templates/button.png";
            
            buttonI1.onload = function(){
                ctxb1.drawImage(buttonI1,0,0);
                
            };
            var button2 = document.getElementById("button2");
            var ctxb2 = button2.getContext("2d");
            var buttonI2 = new Image();
            buttonI2.src = "images/templates/button.png";
            
            buttonI2.onload = function(){
                ctxb2.drawImage(buttonI2,0,0);
                
            };
            var button3 = document.getElementById("button3");
            var ctxb3 = button3.getContext("2d");
            var buttonI3 = new Image();
            buttonI3.src = "images/templates/button.png";
            
            buttonI3.onload = function(){
                ctxb3.drawImage(buttonI3,0,0);
                
            };
            main();
            mainInt = setInterval(main,777); 
        }
        else if(powerscreen){
            clearInterval(powerseq);
            powerscreen=false;
            setTimeout(flushGameResults,500);
        }
        else if(!pet.lights){
            iconstat=5;
            changeIcon();
        }
        buttonclicked3=false;
    }
};


