function snakey(){
	var bgImage = new Image();
	var start = new Image();
	var end = new Image();
	var pixel = new Image();
	var clear = new Image();
	bgImage.src = "img/screen.png";
	start.src = "img/gamestart.png";
	end.src = "img/gameover.png";
	pixel.src = "img/blackpixel.png";
	clear.src = "img/whitepixel.png";
	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");
	canvas.width = 301;
	canvas.height = 301;
	
	start.onload = function () {
		ctx.drawImage(start, 0, 0);
	};
	document.onkeydown = function(e) { return handleKeys(e) };
	var NORTH = 0, EAST = 1, SOUTH = 2, WEST = 3;
	var UP = 38, DOWN = 40, LEFT = 37, RIGHT = 39; 
	
	var game_on=false;
	var score=0;
	document.getElementById("score").innerHTML = ("Score: " + score);
	var snake = {
		direction: EAST,
		pending_direction: EAST,
		body: {
    	    y:[],
            x:[]
		},
		yhead: 25,
		xhead: 4 ,
	}
	var food = {
			y:0,
			x:0
	}
	for (var i=0; i<5; i++){
		snake.body.x.push(i);
		snake.body.y.push(25);
	}
	free_space = false;
	while (!free_space) {
		free_space = true;
		food.x = (Math.floor(Math.random() * 50));
		food.y = (Math.floor(Math.random() * 50));
	    // make sure apple is draw in free space, not on top of snake
		for(i = 0;i < snake.body.x.length; i++)
			if(snake.body.x[i] == food.x && snake.body.y[i] == food.y)
				free_space = false;
	}
	
	function game(){
		game_on=true;
		ctx.drawImage(bgImage,0,0);
		ctx.drawImage(pixel, 1, 151);
		ctx.drawImage(pixel, 7, 151);
		ctx.drawImage(pixel, 13, 151);
		ctx.drawImage(pixel, 19, 151);
		ctx.drawImage(pixel, 1+snake.xhead*6, 1+snake.yhead*6);
		ctx.drawImage(pixel, 1+food.x*6, 1+6*food.y);
		startsnakegame = setInterval(snakegame,45);
	};
	
	var snakegame = function(){
		if (snake.pending_direction !== null) {
			snake.direction = snake.pending_direction;
			snake.pending_direction = null;
		}
		if (snake.direction==NORTH)
			snake.yhead--;
		else if (snake.direction==EAST)
			snake.xhead++;
		else if (snake.direction==SOUTH)
			snake.yhead++;
		else if (snake.direction==WEST)
			snake.xhead--;
		
		if (snake.xhead < 0 || snake.xhead >= 50 || snake.yhead < 0 || snake.yhead >= 50)
			  gameOver();
		else{
			ctx.drawImage(pixel, 1+snake.xhead*6, 1+snake.yhead*6);
			snake.body.x.push(snake.xhead);
			snake.body.y.push(snake.yhead);
			
			if(food.x == snake.xhead && food.y == snake.yhead){
				score++;
				document.getElementById("score").innerHTML = ("Score: " + score);	
				free_space = false;
				while (!free_space) {
				  free_space = true;
				  food.x = (Math.floor(Math.random() * 50));
				  food.y = (Math.floor(Math.random() * 50));

				  // make sure apple is draw in free space, not on top of snake
				  for(i = 0;i < snake.body.x.length; i++)
					if(snake.body.x[i] == food.x && snake.body.y[i] == food.y)
					  free_space = false;
				}
				ctx.drawImage(pixel, 1+food.x*6, 1+6*food.y);
			}
			else
				ctx.drawImage(clear, 1+snake.body.x.shift()*6,1+snake.body.y.shift()*6);
			for (var i = 0; i < snake.body.x.length-1; i++)
				if (snake.body.x[i] == snake.xhead && snake.body.y[i] == snake.yhead)
					gameOver();
		}
		
	};	
	
	var gameOver = function(){
		clearInterval(startsnakegame);
		ctx.drawImage(end,0,0); 
		setTimeout(snakey, 3000);
	};
		
	function handleKeys(e) {
		var char;
		var evt = (e) ? e : window.event;

		char = (evt.charCode) ?
		  evt.charCode : evt.keyCode;
		 if (char==32 && !game_on){
			game();
		}
		if(char==32)
			e.preventDefault();
		if (char > 36 && char < 41) {
		  handleChar(char);
		  return false;
		};
		return true;
	}
	function handleChar(char) {
		if (!game_on)
		  return;

		switch (char) {
		  case UP:
			if (snake.direction != SOUTH)
			  snake.pending_direction = NORTH;
			break;
		  case DOWN:
			if (snake.direction != NORTH)
			  snake.pending_direction = SOUTH;
			break;
		  case LEFT:
			if (snake.direction != EAST)
			  snake.pending_direction = WEST;
			break;
		  case RIGHT:
			if (snake.direction != WEST)
			  snake.pending_direction = EAST;
			break;
		}
	 };
};

$(document).on({
    "contextmenu": function(e) {

        // Stop the context menu
        e.preventDefault();
    },
    "mousedown": function(e) { 
    },
    "mouseup": function(e) { 
    }
});

$(document).ready(function(){
  $show_me=0;
  $("#showmore").click(function(){
  if($show_me==0){
    $("#aboutme").html("Gender: Male<br>Year: 2<br>Major: Computer Science<br>Age: 22<br>Occupation: Student<br>Country: Singapore");
	$("#showmore").html("Show less");
	$show_me=1;
	}else{
	$("#aboutme").html("Gender: Male<br>Year: 2<br>Major: Computer Science");
	$("#showmore").html("Show more");
	$show_me=0;
	}
  });
});

document.documentElement.addEventListener('keydown', function (e) {
    if ( ( e.keycode || e.which ) == 32) {
        e.preventDefault();
    }
}, false);