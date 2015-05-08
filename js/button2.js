
var button2 = document.getElementById("button2");
var ctxb2 = button2.getContext("2d");
button2.width = 66;
button2.height = 63;


var buttonI2 = new Image();
buttonI2.src = "images/templates/button.png";

buttonI2.onload = function(){
    ctxb2.drawImage(buttonI2,0, 0);
    
};

button2.onmousedown = function(){
    buttonclicked2=true;
    var e = $.Event("keydown", { keyCode: 32}); //"keydown" if that's what you're doing
    $("body").trigger(e);
};

button2.onmouseup = function(){button2clicked()};
var button2clicked = function(){
    if(buttonclicked2){
        if(!pet.isBusy && !pet.isDead && pet.level!=0){	
            if(iconstat==1){
                feed();
                if(pet.isSleeping){
                    if(pet.energyLevel<2)
                        pet.energyLevel+=2;
                    pet.isSleeping=false;
                    pet.careMistakes++;
                }
            }
            else if (iconstat==2){
                pet.isBusy=true;
                clearInterval(mainInt);
                if(pet.isSick || pet.energyLevel<3){
                    no();
                    if(pet.isSleeping){
                        if(pet.energyLevel<2)
                            pet.energyLevel+=2;
                        pet.isSleeping=false;
                        pet.careMistakes++;
                    }
                }
                else{
                    train();
                    if(pet.isSleeping){
                        if(pet.energyLevel<2)
                            pet.energyLevel+=2;
                        pet.isSleeping=false;
                        pet.careMistakes++;
                    }
                }
            }
            else if (iconstat==3){
                flush();
            }
            else if (iconstat==4){
                medicine();
                if(pet.isSleeping){
                    if(pet.energyLevel<2)
                        pet.energyLevel+=2;
                    pet.isSleeping=false;
                    pet.careMistakes++;
                }
            }
            else if (iconstat==5){
                pet.isBusy=true;
                clearInterval(mainInt);
                lightscreen = true;
                var button1 = document.getElementById("button1");
                var ctxb1 = button1.getContext("2d");
                
                
                var buttonI1 = new Image();
                buttonI1.src = "images/templates/updown.png";
                
                buttonI1.onload = function(){
                    ctxb1.drawImage(buttonI1,15, 15, 30, 30);
                    
                };
                var button2 = document.getElementById("button2");
                var ctxb2 = button2.getContext("2d");
                var buttonI2 = new Image();
                buttonI2.src = "images/templates/confirm.png";
                
                buttonI2.onload = function(){
                    ctxb2.drawImage(buttonI2,15, 15, 30, 30);
                    
                };
                var button3 = document.getElementById("button3");
                var ctxb3 = button3.getContext("2d");
                var buttonI3 = new Image();
                buttonI3.src = "images/templates/exit.png";
                buttonI3.onload = function(){
                    ctxb3.drawImage(buttonI3,15, 15, 30, 30);
                    
                };
                if(lightsToBeOn)
                    ctx.drawImage(lightson,0,0);
                else
                    ctx.drawImage(lightsoff,0,0);
            }
        }
        else if (trainGameInProgress){
            userChoice = 2;
            playoutTrain();
        }
        else if (sickGameInProgress){
            if (syringePos == 1)
                needleHeight = 31;
            else if (syringePos == 2)
                needleHeight = 73;
            else if (syringePos == 3)
                needleHeight = 115;
            sickGameInProgress = false;
            sickPlayOut = true;
            
        }
        
        else if(powerscreen){
            clearInterval(powerseq);
            powerscreen=false;
            setTimeout(flushGameResults,500);
        }
        else if(lightscreen){
            lightscreen = false;
            var button1 = document.getElementById("button1");
            var ctxb1 = button1.getContext("2d");
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
            lightsToggle();
        }
        else if(!pet.lights && iconstat==5 && !pet.isDead && pet.level!=0){
            pet.isBusy=true;
            clearInterval(mainInt);
            lightscreen = true;
            var button1 = document.getElementById("button1");
            var ctxb1 = button1.getContext("2d");
            
            
            var buttonI1 = new Image();
            buttonI1.src = "images/templates/updown.png";
            
            buttonI1.onload = function(){
                ctxb1.drawImage(buttonI1,15, 15, 30, 30);
                
            };
            var button2 = document.getElementById("button2");
            var ctxb2 = button2.getContext("2d");
            var buttonI2 = new Image();
            buttonI2.src = "images/templates/confirm.png";
            
            buttonI2.onload = function(){
                ctxb2.drawImage(buttonI2,15, 15, 30, 30);
                
            };
            var button3 = document.getElementById("button3");
            var ctxb3 = button3.getContext("2d");
            var buttonI3 = new Image();
            buttonI3.src = "images/templates/exit.png";
            buttonI3.onload = function(){
                ctxb3.drawImage(buttonI3,15, 15, 30, 30);
                
            };
            if(lightsToBeOn)
                ctx.drawImage(lightson,0,0);
            else
                ctx.drawImage(lightsoff,0,0);
        }
        buttonclicked2=false;
    }
    
};
