function Process(img_src, img_width, img_height, loc_dest_x, loc_dest_y, dest_width, dest_height){
	this.snow_arr = new Array();

	this.img_src = img_src;

	this.img_width = img_width;
	this.img_height = img_height;

	this.loc_dest_x = loc_dest_x;
	this.loc_dest_y = loc_dest_y;
	this.dest_width = dest_width;
	this.dest_height = dest_height;

	this.num_snow = 0;

	this.dest_element = document.body;
}

Process.prototype.run = function(fps, num_snow){
	var temp;
	var pointer;

	temp = 1 / fps * 1000;
	pointer = this;

	this.initSnow(num_snow);

	setInterval(function(){ pointer.playSnow(); }, temp);
}

Process.prototype.initSnow = function(num_snow){
	var snow;
	var x, y, scale;

	for( var i=0 ; i<num_snow ; ++i ){
		x = this.getRandomPositionX();
		y = this.getRandomPositionY();
		scale = this.getRandomScale();
		
		snow = new Snow(this.img_src, this.img_width, this.img_height, x, y, scale, this.dest_element);

		this.snow_arr[i] = snow;
	}
}

Process.prototype.getRandomPositionX = function(){
	return Math.random() * this.dest_width + this.loc_dest_x;
}

Process.prototype.getRandomPositionY = function(){
	return Math.random() * this.dest_height + this.loc_dest_y;
}

Process.prototype.getRandomScale = function(){
	return Math.random() * 0.2 + 0.4; // 0.4 - 0.6?
}

function Snow(img_src, img_width, img_height, x, y, scale, dest_element){
	this.img = document.createElement("img");
	this.img.src = img_src;

	this.original_width = img_width;
	this.original_height = img_height;
	
	this.x = x;
	this.y = y;
	
	this.scale = scale;

	this.dx = 0;
	this.dy = 0;
	
	this.img_div = document.createElement("div");
	this.img_div.style.position = "absolute";

	this.img_div.appendChild(this.img);
	dest_element.appendChild(this.img_div);
	
	this.setPosition(this.x, this.y);
	this.setScale(this.scale);
	this.setRandomVelocity();
}

Snow.prototype.setPosition = function(x, y){
	this.x = x;
	this.y = y;
	
	this.img_div.style.left = this.x + "px";
	this.img_div.style.top = this.y + "px";
}

Snow.prototype.setScale = function(scale){
	this.scale = scale;

	this.img.width = parseInt(this.original_width * this.scale);
	this.img.height = parseInt(this.original_height * this.scale);

	this.img_div.style.width = this.img.width + "px";
	this.img_div.style.height = this.img.height + "px";
}

Snow.prototype.setRandomVelocity = function(){
	this.dx = Math.random() - 0.5;
	this.dy = Math.random() * 0.7 + 0.3;
}

Process.prototype.playSnow = function(){
	var snow;

	for( var i=0 ; i<this.snow_arr.length ; ++i ){
		snow = this.snow_arr[i];

		snow.timeProc();

		this.checkCollision(snow);
	}
}

Snow.prototype.timeProc = function(){
	if( Math.random() < 0.05 )
		this.setRandomVelocity();

	this.setPosition(this.x+this.dx, this.y+this.dy);
}

Process.prototype.checkCollision = function(snow){
	if( snow.y > this.loc_dest_y + this.dest_height ){
		snow.setPosition(snow.x, this.loc_dest_y);
		snow.setScale(this.getRandomScale());
		snow.setRandomVelocity();
	}
	
	if( snow.x < this.loc_dest_x )
		snow.setPosition(this.loc_dest_x+this.dest_width, snow.y);
	
	if( snow.x > this.loc_dest_x + this.dest_width )
		snow.setPosition(this.loc_dest_x, snow.y);
}