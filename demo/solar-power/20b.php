<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once 'locale.php';
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Solar Power"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />

<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" href="styles/font-awesome.min.css">

<script src="scripts/jquery.min.js"></script>
<script src="scripts/jquery-ui.js"></script>
<script src="scripts/jquery.ui.touch-punch.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<script src="scripts/save-answer.js"></script>
<script src="scripts/jquery.jsPlumb-1.4.1-all-min.js"></script>
<style>

	html { overflow-y: hidden; overflow-x: hidden;}
	.wrap { overflow: hidden; }

	h1 {margin-left: 1%; margin-right: 1%; padding-top: 10px;}
	h2	{ padding-bottom:0px; margin-top:  -10px}

.bg { background: url('images/20/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
#answer p {text-align:center;padding-bottom:25px}
/* img.next-toggle { display: none; } */
#buttons .next { display: none; }

#answer-icon { display: inline-block; height: 30px; margin-right: 10px; }
#question .placeholder {/* background: rgba(255,255,255,0.5); */ border-radius: 10px;position: absolute; padding:10px;height: 85%;margin-right: 21px;}
/*  #answer .placeholder  { background: rgba(255,255,255,0.5);border-radius: 10px;position: absolute; padding:10px;height: 35%;margin-right: 21px;} */
#answer { z-index:555;position: relative; }

#feedback { text-align: center; }
.grab { cursor: move; cursor: -moz-grab; cursor: -webkit-grab; }
.grabbing { cursor: move; cursor: -moz-grabbing; cursor: -webkit-grabbing; }
.img-holder { width: 60%; margin: 0 auto; }
.img-holder img { width: 90%; }
.instruction {font-size:20px; font-weight: normal;}
/* Matching Type */
#test { width: 70%; margin: 0 auto; }
#container { width: 100%; text-align: center; position: absolute; }
#col1 { left: 0px; width: 150px; position: absolute; ;}
#col2 { right: 320px; width: 200px; position: absolute; }
ul { list-style-type: none; margin: 5px; padding: 0; }
#reset { background: white; padding: 5px 10px; border-radius: 5px; border: solid white;float: right; margin-top: 95px;}
#reset:hover { border: solid #4FCBC7; cursor: pointer; }
.lBox { background-color: #FFC689; height: 20px; width: 100%; border-radius: 5px; margin: 10px 0px; padding: 5px 10px; }
.rBox { background-color: #97A2F8; height: 20px; width: 100%; border-radius: 5px; margin: 10px 0px; padding: 5px 10px; }
._jsPlumb_endpoint { margin-top: 1px;  }
._jsPlumb_endpoint_connected { margin-top: -1px; }

/* End Matching Type */
#col1 li img { width:25px;height:25px;position: absolute;margin-left:-105px; }
#answer { padding-top:330px; }
html[dir="rtl"] #col1 { left:250px; } 
html[dir="rtl"] #col2 { right:70px; } 
html[dir="rtl"] #col1 li img { left:50px; }
html[dir="rtl"] #question .placeholder { margin-right:0;margin-left:21px; }
/*
html[dir="rtl"] span.south { top: 110px; left: 281px; }
html[dir="rtl"] span.north { top: 180px; left: 281px; }
html[dir="rtl"] span.east { top: 145px; left: 245px; }
html[dir="rtl"] span.west { top: 145px; left: 320px; } */

<?php if($language == "zh_CN") { ?>
		#answer { padding-top:360px; }
		/*
		span.south { top: 165px !important; }
		span.north { top: 240px !important; }
		span.east, span.west { top: 205px !important; } */
<?php } ?>

div.img-holder span { position: absolute; color: #0E0E96; }
/*span.south { left: 233px; top: 120px; }
span.north { left: 231px; top: 200px; }
span.east { left: 190px; top: 160px; }
span.west { left: 275px; top: 160px; }
*/
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) and (-webkit-min-device-pixel-ratio: 1) {
	#container { width: 90%; }
}	
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	#test { width: 80%; }
	#container { width: 90%; }
	#col2 { right: 200px; }
	html[dir="rtl"] #col1 { left: 140px; }
	#answer { z-index: 4; }
}	

@media only screen and (max-width: 1250px) {
 	.lBox, .rBox {padding:3px 10px;} 
	._jsPlumb_endpoint {margin-top:1px ;} 
}

</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1 class='add-text'><?php echo _("Quiz Question #5"); ?></h1>
				<div class="placeholder">
					<h2><?php echo _("As the sun seems to move across the sky during the day, the shape of the shadows it makes changes. Here are five pictures of a house showing its shadows changing with the position of the sun in the sky:"); ?></h2>
				<div class="img-holder">
					<img src="images/20/time-of-day2_guides.jpg">
				<!--<span class="south">S</span>
					<span class="north">N</span>
					<span class="east">E</span>
					<span class="west">W</span> -->
				</div>
				<p class="instruction"><?php echo _("Connect the letters on the left, which represents the images above, to the time on the right by dragging any of the circles at the left column to another circle in the right column. Click the Start Over button to remove the lines and connect again."); ?></p>
				<div id="test">
					<div id="container">
						<div id="col1">
							<ul>
								<li><?php echo _("Column A"); ?></li>
								<li><div class='lBox' id="c1"><?php echo _("A"); ?></div></li>
								<li><div class='lBox' id="c2"><?php echo _("B"); ?></div></li>
								<li><div class='lBox' id="c3"><?php echo _("C"); ?></div></li>
								<li><div class='lBox' id="c4"><?php echo _("D"); ?></div></li>
								<li><div class='lBox' id="c5"><?php echo _("E"); ?></div></li>
							</ul>
						</div>
						<div id="col2">
							<ul>
								<li><?php echo _("Column B"); ?></li>
								<li>
									<div class='rBox' id="A">12:00 <?php echo _("noon"); ?></div>
								</li>
								<li>
									<div class='rBox' id="B"><?php echo _("09:00AM"); ?></div>
								</li>
								<li>
									<div class='rBox' id="C">18:00 <?php echo _("or"); ?> 6:00PM</div>
								</li>
								<li>
									<div class='rBox' id="D">15:00 <?php echo _("or"); ?> 3:00PM</div>
								</li>
								<li>
									<div class='rBox' id="E"><?php echo _("06:00AM"); ?></div>
								</li>
							</ul>
						</div>
					</div>
					
				</div>
				<div class="clear"></div><div class="clear">
				<span id="reset"> <?php echo _("Start Over"); ?> </span></div>
				</div>
			</div>
			
			<div id="answer">
				<!-- <h1><?php echo _("Quiz Question #5"); ?> - <?php echo _("How did I do?"); ?></h1> -->
				<div class="placeholder"><!-- <p><?php echo _("You answered..."); ?></p> -->
					<div class="clear"></div>
					<p><img id="answer-icon"><span id="feedback"></span></p>
				</div>
			</div>
		</div>
	</div>
<!--
	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _('Check Answer'); ?>"></a>
		<a href="21.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="21.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("A black silhouette follows..."); ?></strong></section></section>
	<script>
	var source = "";
	var target = "";
	var choices = "";
	var ans1 = "", ans2 = "", ans3 = "", ans4 = "", ans5 = "";
	//var a1 = "", a2 = "", a3 = "", a4 = "", a5 = "";
	
	var answer1 = "",
		answered = 1,
		textstr = "",
		studentAnswers = [],
		marks = [],
		nullAnswer = false,
		back = $('a.back-toggle'),
		next = $('a.next-toggle'),
		check = $('a.check-toggle'),
		question = $('#question'),
		answer = $('#answer'),
		textanswer = $('#textanswer'),
		feedback = $('#feedback'),
		answericon = $('#answer-icon'),
		correct = true,
		sortable = $('#sortable');
		
	$(document).ready(function() {
	
	
	jsPlumb.bind("ready", function() {
		$('.box').draggable({ //for draggable div
			drag:function(){
			    jsPlumb.repaint($('.lBox , .rBox', $(this))); // repaints when dragged
			}
		});

		var startpointOptions = { isSource:true,container:$('#container'), anchors:["Right"], connector:[ "Straight" ] };
		var endpointOptions = { isTarget:true,container:$('#container'), connector:["Straight"], anchors:["Left"] };
		var startpoint = jsPlumb.addEndpoint($('.lBox'), startpointOptions);
		var endpoint = jsPlumb.addEndpoint($('.rBox'), endpointOptions);

		//get answers

		jsPlumb.bind("jsPlumbConnection", function(conn) {
			 if (conn.sourceId == 'c1') {
				ans1 = conn.targetId;
			}else if (conn.sourceId == 'c2') {
				ans2 = conn.targetId;
			}else if (conn.sourceId == 'c3') {	
				ans3 = conn.targetId;
			 }else if (conn.sourceId == 'c4') {
				ans4 = conn.targetId;
			 }else if (conn.sourceId == 'c5') {
				ans5 = conn.targetId;
			 }
			 $('#reset').click(function(){
				        jsPlumb.detach(conn);
				    });
			  $('img.back-toggle').click(function() {
				    	if ($('#answer').is(':visible')) {
				    	    jsPlumb.detach(conn);
				    	}
				    });
		});

	});
	
	
	
	
		back.click(function() {
			if($('.img-holder').is(':visible')) {
				document.location.href = "19.php";
			} else if (answer.is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
				answer.fadeOut(function() {
					$('.img-holder').fadeIn();
					$('.instruction').fadeIn();
					$('#reset').fadeIn();
					window.location.hash = '';
					feedback.removeClass('red');
					feedback.removeClass('green');
					answericon.removeClass('img-align');
					$("#col1 ul li img").remove();
					$('.add-text').text('<?php echo _("Quiz Question #5"); ?>'); 
					answer1 = "";
				});
			}
		});
		
		check.click(function(e){
			checkNull();
			
			if(nullAnswer == true) {
				e.preventDefault();
				window.location.hash = '';
				alert("<?php echo _('Please select your answers.'); ?>");
				nullAnswer = false;
			} else {
				check.fadeOut(function() { next.fadeIn(); });
				$('.img-holder').fadeOut(function(){ 
					$('.instruction').fadeOut();
					$('#reset').fadeOut();
					$('.add-text').text('<?php echo _("Quiz Question #5"); ?> - <?php echo _("How did I do?"); ?>');
					answer.fadeIn();
					window.location.hash = '#answer';
					for(var i = 1; i < 6; i++) {
						answer1 += window["ans" + i];
					}
					//alert(answer1);
					correct = (answer1 == "DBCAE") ? true : false;
					
					if( ans1 == 'D'){
						$('#c1').parent().prepend('<img class="ansImg" src="images/others/correct.png"/>');
					} else {
						$('#c1').parent().prepend('<img class="ansImg" src="images/others/wrong.png"/>'); }
					if( ans2 == 'B'){
						$('#c2').parent().prepend('<img class="ansImg" src="images/others/correct.png"/>');
					} else {
						$('#c2').parent().prepend('<img class="ansImg" src="images/others/wrong.png"/>'); }
					if( ans3 == 'C'){
						$('#c3').parent().prepend('<img class="ansImg" src="images/others/correct.png"/>');
					} else {
						$('#c3').parent().prepend('<img class="ansImg" src="images/others/wrong.png"/>'); }
					if( ans4 == 'A'){
						$('#c4').parent().prepend('<img class="ansImg" src="images/others/correct.png"/>');
					} else {
						$('#c4').parent().prepend('<img class="ansImg" src="images/others/wrong.png"/>'); }
					if( ans5 == 'E'){
						$('#c5').parent().prepend('<img class="ansImg" src="images/others/correct.png"/>');
					} else {
						$('#c5').parent().prepend('<img class="ansImg" src="images/others/wrong.png"/>'); }		
					/* For checking */
					if (correct) {
						textstr = "<?php echo _('Correct! When the earth is rotating on its axis, it seems that in the morning the sun is rising from the east. At noon, the sun is directly over the earth and the shadow is shortest. As the day goes on, the shadows begin to get longer again until the earth rotates in a way that it appears the sun is setting in the west. Knowing the position of the sun at the time the shadow is created, the time of day can be estimated.'); ?>";
						answericon.attr("src", "images/others/correct.png");
						feedback.addClass('green');
					} else { 
						textstr = "<?php echo _('Not quite! When the earth is rotating on its axis, it seems that in the morning the sun is rising from the east. At noon, the sun is directly over the earth and the shadow is shortest. As the day goes on, the shadows begin to get longer again until the earth rotates in a way that it appears the sun is setting in the west. Knowing the position of the sun at the time the shadow is created, the time of day can be estimated.'); ?>";
						answericon.attr("src", "images/others/wrong.png");
						answericon.addClass('img-align');
						feedback.addClass('red');
					}
					feedback.text(textstr);
					/* End checking */
					sortable.sortable('disable');
					$('#answer .clear').before($('#choices'));
					$('#sortable li').css('cursor','default');
				});
				// end question fade
			}
		}); // end check
		
		$('#sortable').sortable();
	}); // end doc ready
	
	/*function checkNull() {
		for(i = 1; i < 6; i++) {
			if(window["ans" + i] == "") nullAnswer = true; 
		}
	}*/
	function checkNull(){
		
		if (!$("div[elid='c1']").hasClass("_jsPlumb_endpoint_connected")){
			nullAnswer = true;
		}
		if (!$("div[elid='c2']").hasClass("_jsPlumb_endpoint_connected")){
			nullAnswer = true;
		}
		if (!$("div[elid='c3']").hasClass("_jsPlumb_endpoint_connected")){
			nullAnswer = true;
		}
		if (!$("div[elid='c4']").hasClass("_jsPlumb_endpoint_connected")){
			nullAnswer = true;
		}
		if (!$("div[elid='c5']").hasClass("_jsPlumb_endpoint_connected")){
			nullAnswer = true;
		}
	}
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>