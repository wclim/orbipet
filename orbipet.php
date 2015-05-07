<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description">
        <meta name="author"><!-- Le styles -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/chui-ios-3.5.2.css">
        <script src="js/chui-3.5.2.js"></script>   
        <style type="text/css">
            .glyphicon-chevron-left,glyphicon-chevron-right {
                position: absolute;
                top: 50%;
                z-index: 5;
                display: inline-block;
            }
        </style>
        <script>
            var mouseup= function(){
                buttonclicked1=false;
                buttonclicked2=false;
                buttonclicked3=false;
            };
        </script>
        <script>
            function load(){
                TINY.box.show({html:'<center><br><b>Please enter a name for your pet.</b></br><br><form onsubmit="pet.name=document.getElementById(&#39;petname&#39;).value;startGame();TINY.box.hide(); return false"><input required type="text" id="petname" maxlength="10"><input type="submit" value="Create!"></form>',width:250,height:100, close:false});
            };
        </script>
        <script>
            function resetGame()
            {
                if(pet.level>0)
                    TINY.box.show({html:'<center><br><b>This will erase your game data!</b></br><br><a href = "javascript:TINY.box.show({html:&#39; <center><br><b>Please enter a name for your pet.</b></br><br><form onsubmit=&#34;realresetGame(); return false&#34;><input required type=&#34;text&#34; id=&#34;petname&#34; maxlength=&#34;13&#34;><input type=&#34;submit&#34; value=&#34;Create!&#34;></form>&#39;,width:250,height:100,});"><button>Ok, I know</button></a>',width:250,height:100});
            }
            function realresetGame() {
                TINY.box.hide();
                pet.name=document.getElementById('petname').value;
                clearTimeout( mistakeTimer );
                iconstat = 0; //0 is default
                ctxicon.drawImage(iconbartop,0, 0);
                ctxicon.drawImage(iconbarbot,0, 175);
                ctxicon.drawImage(iconalertoff,0, 175);
                clearInterval(mainInt);
                shitanimation = false;
                sleepanimation = false;
                egganimation = false;
                happyAnimation = false;
                noAnimation = false;
                screenleftlimit =0;
                pet.imagesize= 0;
                pet.isBusy=false; //if pet is doing stuff
                pet.chanceToFallSick= 10;// 10/10000 chance of falling sick by default , i.e. 0.1% chance
                pet.age= 0; //age is seconds
                pet.level=0; //level 0 is egg, level 1 is baby, level 2 is child, level 3 is adult
                pet.type= 0; //type is the different evolution paths, child have 2 types, adult have 3 types
                pet.careMistakes= 0; //care mistakes determine evolution path
                pet.training= 0; //training is prerequisites to evolve
                pet.currentFoodLevel= 100;
                pet.currentFoodCapacity= 0;//the max amount of food pet can consume, this amount will increase as pet grows bigger
                pet.energyLevel= 100;	//0-100% when energy becomes 0, pet goes to sleep
                pet.maxEnergy= 100;
                pet.isDead= false; //if pet died
                pet.isHungry= false; //if pet is hungry
                pet.isSleeping= false; //if pet is sleeping
                pet.isSick= false; //if pet is sick
                pet.lights= true;//on or off the lights for pet to sleep
                pet.chanceToShit= 7;
                pet.pooCount= 0; //how many shit there are
                pet.willEvolveAt= 39; //countdown time to evolve to next stage, default value is 39, i.e. 30 secs for egg to hatch
                
                pet.moveleftbefore=true;
                pet.moverightbefore=false;
                pet.stayinspotbefore=false;
                pet.goingLeft= true;
                pet.shitcount= 0;
                pet.x = 103;
                pet.y = 0;
                evolveseqcount = 0;
                eggCount =0;
                countForEnergy = 0;
                countForEvolution = 0;
                timeCounter=0;
                hungryCount=0;
                foodattention = false;
                sickattention = false;
                hungryOnset=false;
                overfeedOnset=false;
                sickOnset = false;
                sickCounter=0;
                document.getElementById("pet details").innerHTML = ("<b><u><font size=2>"+pet.name+"'s Details</font></u></b><br><b>Hatching...</b>");
                setTimeout(function(){mainInt = setInterval(main, 600); },100);//updates per 600 milisecond for egg
            }
        </script>
        <style>
            body 
            {
                font-family: Tahoma;
                font-size: 7pt;
                text-align: justify;
                color: ffffff;
                line-height: 14px;
                margin: 0px;
                cursor: mouse;
            }
            
            .tbox {position:absolute; display:none; padding:14px 17px; z-index:900}
            .tinner {border: 3px dotted black; color: #808080; font-size:10pt; padding:15px; -moz-border-radius:5px; border-radius:5px; background:#fff no-repeat 50% 50%; }
            .tmask {position:absolute; display:none; top:0px; left:0px; height:100%; width:100%; background:#000; z-index:800}
            .tclose {position:absolute; top:0px; right:0px; width:30px; height:30px; cursor:pointer; background:url(images/close.png) no-repeat}
            .tclose:hover {background-position:0 -30px}
            
            .b3 {
                font-size: 8pt;
                color:#808080;
                font-family:"tahoma";
                background: white;
                border: 3px dotted black;
                font-weight: none;
                padding: 10px;
                text-align:left;
                border-radius:10px;
            }
            
            
            
        </style>
        
        <body onmouseup = "mouseup()" onload = "load()">
            <a  class="btn btn-info btn-lg" onclick= "resetGame()">
                <span class="glyphicon glyphicon-chevron-left" ></span>Reset
            </a>
            <div style="position:absolute; width: 509; height: 325; left: 130; top: 20; background: none;">
                
                
                <div style="position:absolute; width:66; height: 63; left: 50; top: 50;">
                    <canvas id = "button1"></canvas>
                </div>
                <div style="position:absolute; width:66; height: 63; left: 50; top: 125;">
                    <canvas id = "button2"></canvas>
                </div>
                <div style="position:absolute; width:66; height: 63; left: 50; top: 200;">
                    <canvas id = "button3"></canvas>
                </div>
                
                
                <div style="position:absolute; width: 289; height: 205; left: 150; top: 50; background: none ; border: 4px ridge #e6e6e6;">
                    <div style="position:absolute; height: 30; left: 0; top: 0;">
                        <canvas id = "iconbar"></canvas>
                    </div>
                    <div style="position:absolute; left: 0; top: 30; background-color:#FFF; filter:alpha(opacity=80);">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
            
            <div style="position:absolute; width: 150; left: 10; top: 70;">
                <div id = "pet details" class=b3>
                    
                </div>
                <div style="position: relative; top: 30; width:85">
                    
                </div>
            </div>    
            
            
            
            
            <script src="js/button1.js"></script>
            <script src="js/button2.js"></script>
            <script src="js/button3.js"></script>
            <script src="js/iconbar.js"></script>
            <script src="js/orbigood1.js"></script>
            <script src="js/foodgame.js"></script>
            <script type="text/javascript" src="js/tinybox.js"></script>
            <script src="js/bootstrap.min.js" type="text/javascript"></script>
            <body>
                
                
                
                
                <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
                <link href="css/custom.css" rel="stylesheet" type="text/css">
                <script src="js/custom.js" type="text/javascript"></script>
            </head>
        </html>