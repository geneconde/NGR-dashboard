var SmokeEffect1 = {
	
	imgLocation: "", //url to image here
	smokeWidth: 80, //standard width
	smokeHeight: 45, //standard height
	
	//don't touch this:
	smokePos: new Array(),
		
	makeEffect: function(id, posX, posY) {
		//set position from the "parent"
		SmokeEffect1.smokePos[id] = new Array();
		SmokeEffect1.smokePos[id]['x'] = posX;
		SmokeEffect1.smokePos[id]['y'] = posY;
		
		//set a random time to start puffing
		var time = (Math.floor(Math.random()*3001));
		setTimeout("SmokeEffect1.animate('" + id + "')", time);
	},
	
	animate: function(id) {

		//create the smoke cloud
		var puff = document.createElement("IMG");
		$(puff).attr("src", SmokeEffect1.imgLocation);
		$(puff).attr("alt", "puff");
		$(puff).attr("class", "puff");
		
		//create a temp id for the cloud so we can delete it later on
		var tempId = "puff" + Math.floor(Math.random()*1001);
		$(puff).attr("id", tempId);
		
		//append the cloud to the body
		$(document.body).append($(puff));
		
		var objPos = $('#' + id).offset();
		
		//do smoke animation
		$(puff).css({
			top: (objPos['top'] + SmokeEffect1.smokePos[id]['y']) + "px",
			left: (objPos['left'] + SmokeEffect1.smokePos[id]['x']) + "px",
			zIndex: 25,
			opacity: 0.4
		});
		$(puff).animate({
			width: SmokeEffect1.smokeWidth + "px",
			height: SmokeEffect1.smokeHeight + "px",
			marginLeft: "-" + (SmokeEffect1.smokeWidth / 2) + "px",
			marginTop: "-" + (SmokeEffect1.smokeHeight * 1.5) + "px",
			opacity: 0.9
		},{
			duration: 1500
			// duration: 500
		}).animate({
			marginTop: "-" + (SmokeEffect1.smokeHeight * 3.5) + "px",
			opacity: 0.0
		},{
			duration: 2500
			// duration: 1000
		});
		
		//create timeout and run the animation again
		var time = 1500 + (Math.floor(Math.random()*1501));
		
		setTimeout("SmokeEffect1.animate('" + id + "')", time);
		
		//remove the old one
		setTimeout("$('#" + tempId + "').remove()", 4200);
		
	}
}

var SmokeEffect2 = {
	
	imgLocation: "", //url to image here
	smokeWidth: 80, //standard width
	smokeHeight: 45, //standard height
	
	//don't touch this:
	smokePos: new Array(),
		
	makeEffect: function(id, posX, posY) {
		//set position from the "parent"
		SmokeEffect2.smokePos[id] = new Array();
		SmokeEffect2.smokePos[id]['x'] = posX;
		SmokeEffect2.smokePos[id]['y'] = posY;
		
		//set a random time to start puffing
		var time = (Math.floor(Math.random()*3001));
		setTimeout("SmokeEffect2.animate('" + id + "')", time);
	},
	
	animate: function(id) {

		//create the smoke cloud
		var puff = document.createElement("IMG");
		$(puff).attr("src", SmokeEffect2.imgLocation);
		$(puff).attr("alt", "puff");
		$(puff).attr("class", "puff");
		
		//create a temp id for the cloud so we can delete it later on
		var tempId = "puff" + Math.floor(Math.random()*1001);
		$(puff).attr("id", tempId);
		
		//append the cloud to the body
		$(document.body).append($(puff));
		
		var objPos = $('#' + id).offset();
		
		//do smoke animation
		$(puff).css({
			top: (objPos['top'] + SmokeEffect2.smokePos[id]['y']) + "px",
			left: (objPos['left'] + SmokeEffect2.smokePos[id]['x']) + "px",
			zIndex: 25,
			opacity: 0.4
		});
		$(puff).animate({
			width: SmokeEffect2.smokeWidth + "px",
			height: SmokeEffect2.smokeHeight + "px",
			marginLeft: "-" + (SmokeEffect2.smokeWidth / 2) + "px",
			marginTop: "-" + (SmokeEffect2.smokeHeight * 1.5) + "px",
			opacity: 0.9
		},{
			duration: 1500
			// duration: 500
		}).animate({
			marginTop: "-" + (SmokeEffect2.smokeHeight * 3.5) + "px",
			opacity: 0.0
		},{
			duration: 2500
			// duration: 1000
		});
		
		//create timeout and run the animation again
		var time = 1500 + (Math.floor(Math.random()*1501));
		
		setTimeout("SmokeEffect2.animate('" + id + "')", time);
		
		//remove the old one
		setTimeout("$('#" + tempId + "').remove()", 4200);
		
	}
}