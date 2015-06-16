<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(3, $_SESSION['smid']);
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Gathering Data"); ?></title> <!-- Change module title here -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<style>
.wrap { border-left: 1px dashed #d8e2a9; border-right: 1px dashed #d8e2a9; }
body{overflow-x:hidden;}
.bg { background: url('images/3/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; overflow: hidden; }
.cont { margin-top: 20px; }
#answer { display: none; }
img.next-toggle { display: none; }
h2 { margin: 0; }

.cd-dropdown,
.cd-select {
	position: relative;
	width: 200px;
	margin: 0 auto;
	display: block;
}

.cd-dropdown > span {
	height: 30px;
	line-height: 30px;
	color: black;
	font-weight: 700;
	font-size: 16px;
	background: #f38932;
	display: block;
	padding: 0 50px 0 30px;
	position: relative;
	cursor: pointer;
}

.cd-dropdown > span:after {
	content: '\25BC';
	position: absolute;
	right: 0px;
	width: 50px;
	text-align: center;
	font-size: 12px;
	padding: 10px;
	line-height: 12px;
}


.cd-dropdown ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
	display: block;
	position: relative;
}

.cd-dropdown ul li {
	display: block;
}

.cd-dropdown ul li span {
	background: #f6a665;
	line-height: 40px;
	padding: 0 45px 0 30px;
	display: block;
	color: black;
	cursor: pointer;
	font-weight: 700;

}

.cd-dropdown > span,
.cd-dropdown ul li span {
	-webkit-backface-visibility: hidden;
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

.cd-dropdown > span span[class^="icon-"],
.cd-dropdown > span span[class*=" icon-"]{
	padding: 0 30px 0 45px;
}

/* Select fallback styling */
.cd-select {
	border: 1px solid #ddd;
}

.cd-dropdown ul {
	position: absolute;
	top: 0px;
	width: 100%;
}

.cd-dropdown > span,
.cd-dropdown ul li {
	box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}

.cd-dropdown ul li {
	position: absolute;
	pointer-events: none;
}

.cd-active.cd-dropdown > span {
	color: black;
}

.cd-active.cd-dropdown ul li {
	pointer-events: auto;
}

.cd-active.cd-dropdown ul li span {
	-webkit-transition: all 0.2s linear 0s;
	-moz-transition: all 0.2s linear 0s;
	-ms-transition: all 0.2s linear 0s;
	-o-transition: all 0.2s linear 0s;
	transition: all 0.2s linear 0s;
}

.cd-active.cd-dropdown ul li span:hover {
	background: #c29ad2;
	color: #fff;
}
#question img { width: 210px; }
body #answer img { height: 100%; width: 265px; margin: 30px 10px; float: left; }
#col1, #col2, #col3 { float: left;}
#col1 img, #col2 img, #col3 img { display: block; margin: 0 auto; }
#col1 p, #col2 p, #col3 p {text-align: center;}
#col2 {margin-left: 100px;
margin-right: 100px;}
#col1 {margin-left:10px;}
<?php if($language == "es_ES") { ?>
	h1 { font-size: 33px; }
<?php } ?>
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question" class="screens">
				<h1><?php echo _("Checking what you know... about gathering data"); ?></h1>
				<p><?php echo _("You have probably used some tools or instruments to help you gather different kinds of data. Doctors use instruments to extend and improve their senses all the time to gather data about their patients."); ?></p>
				<p><?php echo _("Look at each picture and click on the sense doctors try to extend or improve when they use the instrument."); ?></p>
				<div class="cont">
					<div id="col1">
						<img src="images/3/3a.jpg" />
						<p><?php echo _("Thermometer"); ?></p>
						<select id="cd-dropdown1" class="cd-select">
							<option value="-1" selected><?php echo _("Select"); ?></option>
							<option value="1" ><?php echo _("Sight"); ?></option>
							<option value="2" ><?php echo _("Hearing"); ?></option>
							<option value="3" ><?php echo _("Touch"); ?></option>
							<option value="4" ><?php echo _("Taste"); ?></option>
							<option value="5" ><?php echo _("Smell"); ?></option>
						</select>
					</div>
					<div id="col2"> 
						<img src="images/3/3a2.jpg" />
						<p><?php echo _("Stethoscope"); ?></p>
						<select id="cd-dropdown2" class="cd-select">
							<option value="-1" selected><?php echo _("Select"); ?></option>
							<option value="1" ><?php echo _("Sight"); ?></option>
							<option value="2" ><?php echo _("Hearing"); ?></option>
							<option value="3" ><?php echo _("Touch"); ?></option>
							<option value="4" ><?php echo _("Taste"); ?></option>
							<option value="5" ><?php echo _("Smell"); ?></option>
						</select>
					</div>
					<div id="col3"> 
						<img src="images/3/3a3.jpg" />
						<p><?php echo _("X-ray"); ?></p>
						<select id="cd-dropdown3" class="cd-select">
							<option value="-1" selected><?php echo _("Select"); ?></option>
							<option value="1" ><?php echo _("Sight"); ?></option>
							<option value="2" ><?php echo _("Hearing"); ?></option>
							<option value="3" ><?php echo _("Touch"); ?></option>
							<option value="4" ><?php echo _("Taste"); ?></option>
							<option value="5" ><?php echo _("Smell"); ?></option>
						</select>
					</div>
				</div>
			</div>
			<div id="answer" class="screens">
				<img src="images/3/thermometer.png" />
				<img src="images/3/stethoscope.png" />
				<img src="images/3/x-ray.png" />
				<p><?php echo _("The thermometer is used to extend the doctors sense of touch so she can be more accurate than just \"the patient feels warm\" and get a true measurement of her temperature. The stethoscope is used to extend the doctor's hearing, to better listen to the patient's heartbeat and breathing. X-rays are taken to help the doctor see the bones inside the patient's body which cannot otherwise be seen."); ?></p>
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _("Check Answer"); ?>"></a>
		<a href="4.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Disinfecting medical instruments..."); ?></strong></section></section>
	<script type="text/javascript" src="scripts/modernizr.custom.63321.js"></script>
	
	<script type="text/javascript" src="scripts/jquery.dropdown.js"></script>
	<script type="text/javascript">
		
		$( function() {
			
			$( '#cd-dropdown1' ).dropdown( {
				easing: 'ease',
				gutter : 5,
				stack : false,
				slidingIn : 100,
				//random: true,
				//delay: 5
			} );


			$( '#cd-dropdown2' ).dropdown( {
				easing: 'linear',
				gutter : 5,
				stack : false,
				slidingIn : 200,
				//random: true,
			} );

			$( '#cd-dropdown3' ).dropdown( {
				easing: 'linear',
				gutter : 5,
				stack : false,
				slidingIn : 100,
				//random: true
			} );


		});
	</script>
		
	<script>
	var hash = window.location.hash.slice(1);
	
	var back = $('img.back-toggle'),
		next = $('img.next-toggle'),
		check = $('img.check-toggle'),
		question = $('#question'),
		answer = $('#answer');
		
	$(document).ready(function() {
		 		 
		if(hash != "") {
			$('.screens').hide();
			$('h1').fadeOut();
			answer.show();
			check.fadeOut(function(){ next.fadeIn(); });
		}
		
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "2.php";
			} else if (answer.is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
				answer.fadeOut(function() {
					$('h1').fadeIn();
					question.fadeIn();
				});
			}
		});
		
		check.click(function(){
			var checkAnswer = $('div#col1 input').val();
			var checkAnswer2 = $('div#col2 input').val();
			var checkAnswer3 = $('div#col3 input').val();
					
			if (checkAnswer == -1 || checkAnswer2 == -1 || checkAnswer3 == -1) {
				alert('<?php echo _("Please select your answers."); ?>');
			} else {
				check.fadeOut(function() { next.fadeIn(); });
				question.fadeOut(function(){
					window.location.hash = '#answer';
					answer.fadeIn();
				}); 
			}
		});
	});
	</script>
	
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
