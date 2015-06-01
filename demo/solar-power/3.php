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
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<style>
	html, body {overflow: hidden;} 
.wrap { border-left: 1px dashed #3E44DA; border-right: 1px dashed #3E44DA; overflow: hidden;}
.bg { background: url('images/3/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
h1 { color: Chocolate !important; }
/* h2 { color: #5B616B; } 
h2 span { color: #3D6D8D; }*/
h2 { color:#FFE000; }
h2 span { color:#00F0E6; }
p {margin-left: 2%; margin-right: 2%;}
/* img.next-toggle { display: none; } */
#buttons .next { display: none; }
#text-container { /* -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.9); padding: 10px; */margin-top:35%; }
#choices1 { margin: 10px 0 0 20px; }
input[type=radio].css-radio { display:none; }
input[type=radio].css-radio + label.css-label {
	background-image: url('images/3/unchecked.png');
	height:40px; 
	display:inline-block;
	/* color: #a7702a; */
	color:#FF9105;
	line-height:30px;
	background-repeat:no-repeat;
	background-position: 0 3px;
	background-size: 20px 20px;
	font-size:24px;
	vertical-align:middle;
	cursor:pointer;
	padding-left: 26px;
}

input[type=radio].css-radio:checked + label.css-label { color: #F5FF00; background-image: url('images/3/checked.png'); }
label.css-label {
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
#bottom-text { position: absolute; bottom: 15px; color: #fff; margin-bottom: 2%; }

/*label:active, label:visited, label:focus { color: #c32222 !important; }*/

html[dir="rtl"] input[type=radio].css-radio + label.css-label { background-position-x:right;padding-right:26px; }
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	#text-container { margin-top: 70%; }
}

@media only screen and (max-width: 1250px) {
	input[type=radio].css-radio + label.css-label {font-size: 20px;}
	h2 {margin-top: -40px;font-size: 21px !important;}
	p {font-size: 22px; padding:20px 0px;}
	#choices1 {margin:0px 0 0 20px;}
}

<?php if($language == "ar_EG") { ?>
	 .lang-menu ul {margin-right: -9999px !important} 
	.lang-menu ul {left: 9999px }
<?php } ?>

</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Checking what you know... about solar power"); ?></h1>
				<div id="text-container">
					<h2><?php echo _("At one time or another you have probably walked on a paved road in the early evening after a very hot day and had the sensation that heat energy was coming from the road. <span>Which of the following do you think is original source of the heat coming from the pavement?</span>"); ?></h2>
					<div id="choices1">
						<input type="radio" name="choices" id="a1" class="css-radio">
						<label for="a1" class="css-label"><?php echo _("Geothermal energy"); ?></label><br>
						<input type="radio" name="choices" id="b1" class="css-radio">
						<label for="b1" class="css-label"><?php echo _("Nuclear energy from Earth's core"); ?></label><br>
						<input type="radio" name="choices" id="c1" class="css-radio">
						<label for="c1" class="css-label"><?php echo _("Radiant energy from the sun"); ?></label><br>
						<input type="radio" name="choices" id="d1" class="css-radio">
						<label for="d1" class="css-label"><?php echo _("Heat from the friction of traffic during the day"); ?></label>
					</div>
				</div>
			</div>
			<div id="answer">
				<div id="bottom-text">
				<p><?php echo _("Dark pavements heat up in the sun because they absorb 80-95% of sunlight. Radiant energy from the sun is the original source of this heat. Read on to module more about solar power."); ?></p>
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
		<a href="4.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->
<!--
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><?php echo _("Back"); ?></a>
		<a href="4.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><?php echo _("Next"); ?></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><?php echo _("Check Answer"); ?></a>
	</div>
-->
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="4.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	
	<section id="preloader"><section class="selected"><strong><?php echo _("Putting on sunblock..."); ?></strong></section></section>
	<script>
	var back = $('a.back-toggle'),
		next = $('a.next-toggle'),
		check = $('a.check-toggle'),
		question = $('#question'),
		answer = $('#answer');

		
	$(document).ready(function() {
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "2.php";
			} else if (answer.is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
				answer.fadeOut(function() {
					question.fadeIn();
				});
			}
		});
		
		check.click(function(){ 
			var checkAnswer = $('input:radio:checked').length;
			
			if(checkAnswer < 1)
			{
				alert("<?php echo _('Please select your answer.') ?>");
			} else {
				check.fadeOut(function() { next.fadeIn(); });
				question.fadeOut(function(){ 
					answer.fadeIn();
					window.location.hash = '#answer';
				}); 
			}
		});
	});


	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
