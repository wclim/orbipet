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
            function getData()
            {
                $.ajax({ 
                    url: "data.sav",
                    type: "POST",
                    dataType: "text",
                    success: function(data, status) {
                        var datas = data.split('\n');
                        pet.name = datas[0];
                        pet.imagesize =  parseInt(datas[1]);
                        pet.isBusy = false; //if pet is doing stuff
                        pet.chanceToFallSick = parseInt(datas[2]); // 10/10000 chance of falling sick by default , i.e. 0.1% chance
                        pet.age =  parseInt(datas[3]); //age is seconds
                        pet.level = parseInt(datas[4]); //level 0 is egg, level 1 is baby, level 2 is child, level 3 is adult
                        pet.type = parseInt(datas[5]); //type is the different evolution paths, child have 2 types, adult have 3 types
                        pet.careMistakes = parseInt(datas[6]); //care mistakes determine evolution path
                        pet.training = parseInt(datas[7]); //training is prerequisites to evolve
                        pet.currentFoodLevel = parseInt(datas[8]);
                        pet.currentFoodCapacity = parseInt(datas[9]);//the max amount of food pet can consume
                        pet.energyLevel = parseInt(datas[10]);	//0-100% when energy becomes 0, pet goes to sleep
                        pet.maxEnergy = parseInt(datas[11]);
                        if (datas[12].toLowerCase() == "true"){
                            pet.isDead = true;
                        }else{
                            pet.isDead=false;
                        }
                        if (datas[13].toLowerCase() == "true"){
                            pet.isHungry = true;
                        }else{
                            pet.isHungry=false;
                        }
                        if (datas[14].toLowerCase() == "true"){
                            pet.isSleeping = true;
                        }else{
                            pet.isSleeping=false;
                        }
                        if (datas[15].toLowerCase() == "true"){
                            pet.isSick = true;
                        }else{
                            pet.isSick=false;
                        }
                        if (datas[16].toLowerCase() == "true"){
                            pet.lights = true;
                        }else{
                            pet.lights=false;
                        }
                        pet.chanceToShit = parseInt(datas[17]);
                        pet.shitcount = parseInt(datas[18]);
                        pet.willEvolveAt = parseInt(datas[19]);
                        
                        startGame();
                    }
                    
                });
                
                return;
            };
            
            function save(){
                function saveFile(fs) {
                    fs.root.getFile("data.sav", {create: true}, function(DatFile) {
                        DatFile.createWriter(function(DatContent) {
                            var blob = new Blob(["Lorem Ipsum"], {type: "text/plain"});
                            DatContent.write(blob);
                        });
                    });                  
                    window.webkitRequestFileSystem(window.PERSISTENT , 1024*1024, saveFile);
                }
            }
        </script>
        <script>
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
        
        <body onmouseup = "mouseup()" onload = "getData()">
            
            <a  class="btn btn-info btn-lg" onclick= "save()">
                <span class="glyphicon glyphicon-chevron-left" ></span>Pause Game
            </a>
            <div style="position:absolute; width: 509; height: 325; left: 247; top: 60; background: none;">
                
                
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
            
            <div style="position:absolute; width: 205; left: 20; top: 200;">
                <div id = "pet details" class=b3>
                    
                </div>
                <div style="position: relative; top: 30; width:85">
                    
                </div>
            </div>    
            
            
            
            
            <script src="js/template.js"></script>
            <script src="js/button1.js"></script>
            <script src="js/button2.js"></script>
            <script src="js/button3.js"></script>
            <script src="js/iconbar.js"></script>
            <script src="js/orbigood1.js"></script>
            <script src="js/foodgame.js"></script>
            <script src="js/bootstrap.min.js" type="text/javascript"></script>
            <body>
                
                
                
                
                <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
                <link href="css/custom.css" rel="stylesheet" type="text/css">
                <script src="js/custom.js" type="text/javascript"></script>
            </head>
        </html>