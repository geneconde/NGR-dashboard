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
<link rel="stylesheet" type="text/css" href="styles/hexaflip.css" />
<link rel="stylesheet" href="styles/font-awesome.min.css">

<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
	html, body {overflow: hidden;} 
	.wrap { overflow: hidden; }


.bg { background: url('images/17/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
h1 { margin-bottom: 10px; }

h1 {margin-left: 1%; margin-right: 1%; padding-top: 10px;}
h2	{ padding-bottom:0px; margin-top:  -10px}
#answer { display: none; }
#answer-icon { display: inline-block; height: 30px; margin-right: 10px; }
#question .placeholder, #answer .placeholder { /* background: rgba(255,255,255,0.5); */border-radius: 10px;padding: 10px 10px 10px 10px;position:absolute; margin-right:22px;width: 93%;}

h1 {margin-left: 1%; margin-right: 1%; padding-top: 10px;}
h2	{ padding-bottom:0px; margin-top:  -10px}

#buttons .next { display: none; }
/* img.next-toggle { display: none; } */
#choices { width: 40%; float: left; margin-left: 30px; margin-top: 10px; }
#choices p { margin: 10px 0px; }

/*
#hexaflip-container { float: right; width: 45%; }
#hexaflip-container p { color: #000; margin-top: 20px; margin-bottom: 20px; text-align: center; }

#hexaflip { margin: 0 auto; }
.hexaflip-cube { text-rendering: optimizeLegibility; -webkit-font-smoothing: antialiased; cursor: move; cursor: -webkit-grab; cursor: -moz-grab; display: inline-block; position: relative; -webkit-transform-style: preserve-3d; -moz-transform-style: preserve-3d; -o-transform-style: preserve-3d; -ms-transform-style: preserve-3d; transform-style: preserve-3d; -webkit-transition: -webkit-transform 0.4s; -moz-transition: -moz-transform 0.4s; -o-transition: -o-transform 0.4s; -ms-transition: -ms-transform 0.4s; transition: transform 0.4s;}
.hexaflip-cube.no-tween { -webkit-transition-duration: 0; -moz-transition-duration: 0; -o-transition-duration: 0; -ms-transition-duration: 0; transition-duration: 0; }
.hexaflip-cube > div { width: 100%; overflow: hidden; height: 100.5%; position: absolute; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; text-align: center; background-color: #333; color: #fff; font-weight: 100; text-shadow: 0 -2px 0 rgba(0,0,0,0.2); line-height: 1.5; }
.hexaflip-left, .hexaflip-right { background-color: #555 !important; }
*/
	#hexaflip-container { float: right; margin-right: 15px; width: 45%; padding: 0; } 
	#hexaflip-container p { color: #055D79; padding: 0 0 10px 0; }
	#hexaflip { margin: 0 auto; }

.img-div { width: 100%; margin: 0 auto; text-align: center; }
#answer p { text-align: center; }
html[dir="rtl"] #choices { float:right;margin-left:0;margin-right:30px; } 
html[dir="rtl"] #hexaflip-container { float:left; }
html[dir="rtl"] #question .placeholder { margin-left:22px;margin-right:0; }
html[dir="rtl"] #answer .placeholder { margin-left:22px;margin-right:0; }

@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	#question .placeholder, #answer .placeholder { width: 92%; }
}	

	<?php if($language == "ar_EG") { ?>
	 .lang-menu ul {margin-right: -9999px !important} 
	.lang-menu ul {left: 9999px }
	<?php } ?>

	@media only screen and (max-width: 1250px) {
		p {font-size: 20px !important;}
		#hexaflip-container p {font-size: 18px !important; }
		#choices p {margin: 0px 0px;} #hexaflip-container p {width: 90%;} #hexaflip {width:235px;}
	}
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #2"); ?></h1>	
				<div class="placeholder">
					<h2><?php echo _("Which two elements make up the gas inside the sun?"); ?></h2>
					<div id="choices">
						<p><?php echo _('A. ');?><?php echo _("Carbon and nitrogen"); ?></p>
						<p><?php echo _('B. ');?><?php echo _("Hydrogen and oxygen"); ?></p>
						<p><?php echo _('C. ');?><?php echo _("Oxygen and carbon"); ?></p>
						<p><?php echo _('D. ');?><?php echo _("Hydrogen and helium"); ?></p>
					</div>
					<div id="hexaflip-container">
						<p><?php echo _("Rotate or flip the 3D box below either up or down to set your answer."); ?></p>
						<div id="hexaflip"></div>
					</div>
				</div>
			</div>
			<div id="answer">
				<h1><?php echo _("Quiz Question #2"); ?> - <?php echo _("How did I do?"); ?></h1>		
				<div class="placeholder">
					<p><?php echo _("You answered..."); ?></p>
					<div class="img-div"><img id="imganswer"></div>
					<p><span id="textanswer"></span></p>
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
		<a href="18.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="18.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("What the sun is made of..."); ?></strong></section></section>
	<script>
	var answer1,
		answered = 1,
		textstr = "",
		nullAnswer = false,
		back = $('a.back-toggle'),
		next = $('a.next-toggle'),
		check = $('a.check-toggle'),
		question = $('#question'),
		answer = $('#answer'),
		textanswer = $('#textanswer'),
		feedback = $('#feedback'),
		answericon = $('#answer-icon'),
		imganswer = $('#imganswer');
		
	$(document).ready(function() {
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "16.php";
			} else if (answer.is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
				answer.fadeOut(function() {
					question.fadeIn();
					window.location.hash = '';
					feedback.removeClass('red');
					feedback.removeClass('green');
					answericon.removeClass('img-align');
				});
			}
		});
		
		check.click(function(){ 
			check.fadeOut(function() { next.fadeIn(); });
			question.fadeOut(function(){ 
				answer.fadeIn();
				window.location.hash = "#answer";
				
				/* For checking */
				var hexavalue = hexa.getValue();
				if (hexavalue == './images/others/a.png') answer1 = "A";
				if (hexavalue == './images/others/b.png') answer1 = "B";
				if (hexavalue == './images/others/c.png') answer1 = "C";
				if (hexavalue == './images/others/d.png') answer1 = "D";

				if(answer1 == "D") {
					textanswer.text('D. <?php echo _("Hydrogen and helium"); ?>');
					textstr = "<?php echo _('You got it! Hydrogen and helium are the gases inside the sun.'); ?>";
					imganswer.attr("src","images/others/d.png");
					answericon.attr("src", "images/others/correct.png");
					feedback.addClass('green');
				} else {
					textstr = '';
					if(answer1 == "A") {
						textanswer.text('A. <?php echo _("Carbon and nitrogen"); ?>');
						textstr = "<?php echo _('Try again! There is no carbon or nitrogen on the Sun.'); ?>";
						imganswer.attr("src","images/others/a.png");
					} else if (answer1 == "B") {
						textanswer.text('B. <?php echo _("Hydrogen and oxygen"); ?>');
						textstr = "<?php echo _('Not quite! There is no oxygen on the Sun.'); ?>";
						imganswer.attr("src","images/others/b.png");
					} else if (answer1 == "C") {
						textanswer.text('C. <?php echo _("Oxygen and carbon"); ?>');
						textstr = "<?php echo _('Nope! There is no oxygen or carbon on the Sun.'); ?>";
						imganswer.attr("src","images/others/c.png");
					}
					answericon.attr("src", "images/others/wrong.png");
					answericon.addClass('img-align');
					feedback.addClass('red');
				}
				feedback.text(textstr);
				/* End checking */
				
				if(answered == 0) {
					saveAnswer('solar-power-qq2-a', answer1);
					answered = 1;
				} // end saving to db
			}); // end question fade
		}); // end check
		
		makeHexa();
	}); // end doc ready
	</script>

<!-- 
	<script src="scripts/hexaflip.min.js"></script>
    <script>
        var hexa;
		set = ['./images/others/a.png','./images/others/b.png','./images/others/c.png','./images/others/d.png'];
        function resize(){
            var size, margin = 20;
            size = 200;
    	    var settings = { size: size, margin: margin, perspective: 1000, touchSensitivity: 1 };
            return settings;
        }
        function makeHexa(){
            var settings = resize();
            $('#hexaflip').empty();
            hexa = new HexaFlip(document.getElementById('hexaflip'),  {set1: set}, settings);
        }
            </script>
-->
	<script src="scripts/hexaflip.js"></script>
    <script>
		var set1 = ['./images/others/a.png','./images/others/b.png','./images/others/c.png', './images/others/d.png'];
		var hexa = new HexaFlip(document.getElementById('hexaflip'), { set: set1 }, { size: 150 });
    </script>

	<?php include("setlocale.php"); ?>
</body>
</html>
