<?php 
	/*require_once '../../session.php';
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once 'locale.php';
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(19, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'heating-and-cooling-qq4-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;*/
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo _("Heating and Cooling"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="initial-scale=1">
	<link rel="stylesheet" href="css/locale.css" />
	<link rel="stylesheet" href="css/fonts.css" />
	<link rel="stylesheet" href="css/jpreloader.css" />
	<link rel="stylesheet" href="css/video.css" />
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<style>		
		html, body {overflow: hidden;}
		#buttons .next { display: none; }
		.bg { background-image: url('images/19/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		#answer { display: none; }		
		#box { overflow: hidden; }		
		.choices { width: 70%; margin: 0 auto; text-align: center; margin-top: 20px; height: 240px; }
		.choices .pic { width: 50%; float: left; height: 167px; }		
		.choices .pic img { cursor: pointer; height: 100%; }
		#dp_swf_engine { display: none; }
		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
		}
		@media only screen and (min-width: 600px) and (max-width: 1250px)  and (orientation : landscape)  and (-webkit-min-device-pixel-ratio: 1){
			.choices {height:215px; margin-top:5px;}
		}
	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #4"); ?></h1>
				<h2><?php echo _("When a piece of metal is heated, what definitely changes?"); ?></h2>				
				<div class="choices">					
					<div class="pic">						
						<img src="images/19/mass.jpg" id="a1" class="grayscale" alt="Mass">						
						<p><?php echo _("its mass"); ?></p>					
					</div>					
					<div class="pic">						
						<img src="images/19/temperature.jpg" id="b1" class="grayscale" alt="Temperature">						
						<p><?php echo _("its temperature"); ?></p>					
					</div>
				</div>
				<div class="clear"></div>
				<div class="choices">
						<div class="pic">						
						<img src="images/19/color.jpg" id="c1" class="grayscale"  alt="Color">						
						<p><?php echo _("its color"); ?></p>					
					</div>					
						<div class="pic">						
						<img src="images/19/chemical.jpg" id="d1" class="grayscale"  alt="Chemicals">						
						<p><?php echo _("its chemicals"); ?></p>					
					</div>	
				</div>			
			</div>

			<div id="answer">				
				<h1><?php echo _("Quiz Question #4"); ?> - <?php echo _("How did I do?"); ?></h1>				
				<p class="center"><?php echo _("You answered..."); ?></p>				
				<div id="feedback"></div>			
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="20.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Clanging metals..."); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jquery-ui.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/saveanswer.js"></script>
	<script src="scripts/rightclick.js"></script>
	<script>
		var answered = <?php echo $answered; ?>, ans = '';
			question = $('#question'),			
			feedback = $('#feedback'),
			answer = $('#answer'),
			choices = $('.choices'),						
			pic = $('.pic img'),
			check = $('a.checkanswer'),
			back = $('a.back'),
			next = $('a.next');

		pic.on('click', function() {			
			$('.pic img').each(function() { 
				$(this).css('border','0');
			});			

			$(this).css('border','5px solid #974322');
			ans = $(this).attr('alt');
		});
		
		check.on('click', function() {
			if (ans == '') {
				alert('<?php echo _("Please select your answer."); ?>');
			} else {
				question.fadeOut(function() {
					answer.fadeIn();
					window.location.hash = "#answer";
				});
				check.fadeOut(function() { next.fadeIn(); back.fadeIn(); });
				save();
			}
		});

		back.on('click', function() {
			if (question.is(':visible')) { document.location.href = "18.php"; }
			else {
				answer.fadeOut(function() { question.fadeIn(); });
				next.fadeOut(function() { check.fadeIn(); });
			}
		});

		function save() {	
			var feedback =  $('#feedback'),
				ansDB;

			if (ans == 'Mass') {
				ansDB = 'A';

				feedback.html(
					'<p class="center"><img src="images/19/mass.jpg"/></p>' +	'<p class="center"><?php echo _("its mass"); ?></p>' + '<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No, its mass does not change when a metal is heated."); ?></p>'	
					);			
			}

			if (ans == 'Temperature') {
				ansDB = 'B';

				feedback.html(					
				'<p class="center"><img src="images/19/temperature.jpg" /></p>' +	'<p class="center"><?php echo _("its temperature"); ?></p>' + '<p class="green center"><img src="images/misc/correct.png" alt="Correct" /> <?php echo _("Correct, the temperature changes when a metal is heated."); ?></p>'			
				);		
			}

			if (ans == 'Color') {
				ansDB = 'C';

				feedback.html(					
				'<p class="center"><img src="images/19/color.jpg"  /></p>' + '<p class="center"><?php echo _("its color"); ?></p>' + '<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No, the metal’s color may change, but not necessarily."); ?></p>'	
				);			
			}

			if (ans == 'Chemicals') {				
				ansDB = 'D';

				feedback.html('<p class="center"><img src="images/19/chemical.jpg" /></p>' + '<p class="center"><?php echo _("its chemicals"); ?></p>' +	'<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No, the chemicals making up a metal do not change when it is heated."); ?></p>'				
				);			
			}

			if (answered == 0) {				
				saveAnswer('heating-and-cooling-qq4-a', ansDB);				
				answered = 1;			
			}		
		}
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
