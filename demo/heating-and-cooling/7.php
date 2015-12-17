<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(7, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'heating-and-cooling-qc2-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;
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
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<?php if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad')) { ?>
		<link rel="stylesheet" href="css/hexaflip2.css" />
	<?php } else { ?>
		<link rel="stylesheet" href="css/hexaflip.css" />
	<?php } ?>

	<style>
		html, body {overflow: hidden;}
		.bg { background-image: url('images/7/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		.bg ul { padding-left: 20px; }
		.bg li { font-size: 22px; }
		#answers { display: none; }
		#answers p { padding: 0; }
		#question1, #question2, #answer1, #answer2 {
			overflow: hidden;
			background-color: rgba(135, 206, 250, .3);
			margin: 0 auto;
			-webkit-border-radius:10px;
			-moz-border-radius:10px;
			border-radius:10px;
			margin-bottom: 10px;
			padding: 0 10px;
			width: 97%;
		}
		#ans2 { padding-bottom: 10px; }
		#box { width: 90%; margin: 20px auto 10px; }
		#box .info { width: 600px; float: right; padding: 20px 0; }
		
		input[type="checkbox"] { display:none; }
		input[type="checkbox"] + label span {
			display:inline-block;
			width:24px;
			height:24px;
			background:url('images/misc/water.png') no-repeat;
			cursor: pointer;
			vertical-align: top;
		}
		input[type="checkbox"]:checked + label span {
			background:url('images/misc/fire.png') no-repeat;
		}
		label { cursor: pointer; }
		
		html[dir="rtl"] #hexaflip { float: left; margin-bottom: 10px; }
		#dp_swf_engine { display: none; }
		/*li { margin: 5px 0 5px 30px; }*/

		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
			#box { height: 240px; }
			#hexaflip { display: block; margin: 0 auto; }
			html[dir="rtl"] #hexaflip { float: none; }
		}	

		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important; padding:3px 0;}

		}	
		@media only screen and (max-width: 1040px) {
			h2, p, li {font-size:20px !important; padding:3px 0;}
			#box p {font-size:18px !important;}
			#box .info {padding: 35px 0; width: 600px;}
		}
		@media only screen and (max-width: 960px) {
			h2, p, li {font-size:18px !important;}
			#box p {font-size:16px !important;}
			#box .info {padding: 35px 0; width: 500px;}
		}

		@media only screen and (max-width: 768px) {
			h2, p, li {font-size:16px !important;}
			#box p {font-size:14px !important;}
			#box .info {padding: 35px 0; width: 400px;}
		}
		#buttons .next { display: none; }
	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="questions">
				<h1><?php echo _("Quick Check #2"); ?></h1>
				
				<div id="question1">
					<h2><?php echo _("Question A. Click on <span class='blink'>all</span> the statements that are correct."); ?></h2>
					
					<ul>
						<li>
							<input type="checkbox" name="q1" id="a1" value="A">
							<label for="a1"><span></span><?php echo _("We can get heat from friction, electricity, and natural gas."); ?></label>
						</li>
						<li>
							<input type="checkbox" name="q1" id="b1" value="B">
							<label for="b1"><span></span><?php echo _("Not all the effects of heat are reversible."); ?></label>
						</li>
					
						<li>
							<input type="checkbox" name="q1" id="c1" value="C">
							<label for="c1"><span></span><?php echo _("Heat always causes the substance it is heating to change into something new."); ?></label>
						</li>
					
						<li>
							<input type="checkbox" name="q1" id="d1" value="D">
							<label for="d1"><span></span><?php echo _("We can transform different types of energy into heat."); ?></label>
						</li>
						<!--
						<li>
							<input type="checkbox" name="q1" id="e1" value="E">
							<label for="e1"><span></span><?php //echo _("Heat energy only moves from a hotter substance to a colder substance."); ?></label>
						</li>
						-->
					</ul>
				</div>
				<div id="question2">
					<h2><?php echo _("Question B. What does <span class='blink'>not</span> happen when you burn a piece of wood in a campfire?"); ?></h2>
					<ul>
						<li>A. <?php echo _("Chemical energy in the molecules of wood is released."); ?></li>
						<li>B. <?php echo _("The air around the burning wood increases in temperature."); ?></li>
						<li>C. <?php echo _("The wood undergoes a chemical change."); ?></li>
						<li>D. <?php echo _("Energy is released due to friction."); ?></li>
					</ul>
					<div id="box">
						<p class="info"><?php echo _("Rotate or flip the box below either up or down to set your answer. Click, hold and slide mouse up or down."); ?></p>
						<div id="hexaflip"></div>
					</div>
				</div>
				
				<p id="temp" class="hidden"></p>
			</div>
			<div id="answers">
				<h1><?php echo _("Quick Check #2"); ?> - <?php echo _("How did I do?"); ?></h1>
				
				<div id="answer1">
					<h2><?php echo _("Question A. Click on <span class='blink'>all</span> the statements that are correct."); ?>
					</h2><p class="center"><?php echo _("You answered..."); ?></p>
					<div id="ans1"></div>
				</div>
				<div id="answer2">
					<h2><?php echo _("Question B. What does <span class='blink'>not</span> happen when you burn a piece of wood in a campfire?"); ?></h2>
					<p class="center"><?php echo _("You answered..."); ?></p>
					<div id="ans2"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="8.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Chopping wood..."); ?></strong></section></section>
	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/blink.js"></script>
	<script src="scripts/saveanswer.js"></script>
	<script src="scripts/rightclick.js"></script>
	<?php if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad')) { ?>
	<script src="scripts/hexaflip2.js"></script>
	<?php } else { ?>
	<script src="scripts/hexaflip.js"></script>
	<?php } ?>
	
	<script>

		var answered = <?php echo $answered; ?>,
			temp = $('#temp'),
			questions = $('#questions'),
			answers = $('#answers'),
			q1 = $('#question1').find('input[type=checkbox]'),
			a1 = $('#a1'),
			b1 = $('#b1'),
			c1 = $('#c1'),
			d1 = $('#d1'),
			e1 = $('#e1'),
			answer1 = $('#ans1'),
			answer2 = $('#ans2'),
			check = $('a.checkanswer'),
			back = $('a.back'),
			next = $('a.next');

		$('.blink').blink({ speed: 500, blinks: 1000 });
		q1.on('click', function() {
			temp.html('');
			q1.each(function() {
				if ($(this).is(':checked'))
					temp.append($('label[for="' + $(this).attr('id') + '"]').html() + '<br/>');
			});
		});
		check.on('click', function() {
			if (q1.is(':checked')) {
				questions.fadeOut(function() {
					answers.fadeIn();
					window.location.hash = "#answers";
				});
				check.fadeOut(function() {
					next.fadeIn();
					back.fadeIn();
				});
				if ( a1.is(':checked') == true &&
					 b1.is(':checked') == true &&
					 c1.is(':checked') == false &&
					 d1.is(':checked') == true ) {
					answer1.html('<p class="center"><?php echo _("' + temp.html() + '"); ?></p>' +
						'<p class="green center"><img src="images/misc/correct.png" alt="Correct" /> <?php echo _("Great job! We can get heat from friction, electricity, and natural gas. We can transform different types of energy into heat. Some of the effects of heat are reversible, some are not."); ?></p>'
					);
				}
				else {
					answer1.html('<p class="center"><?php echo _("' + temp.html() + '"); ?></p>' +
						'<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("Not quite. We can get heat from friction, electricity, and natural gas. We can transform different types of energy into heat. Some of the effects of heat are reversible, some are not."); ?></p>'
					);
				}
				save();
			} else {
				alert('<?php echo _("Please select your answers."); ?>');
			}
		});
		back.on('click', function() {
			if (questions.is(':visible')) { document.location.href = "6.php"; }
			else {
				answers.fadeOut(function() {
					questions.fadeIn();
				});
				next.fadeOut(function() {
					check.fadeIn();
				});
			}
		});
		function save() {
			var a1 = "",
				a2 = null;
			if ($('#a1').is(':checked')) a1 = 'A';
			if ($('#b1').is(':checked')) a1 += 'B';
			if ($('#c1').is(':checked')) a1 += 'C';
			if ($('#d1').is(':checked')) a1 += 'D';
			if ($('#e1').is(':checked')) a1 += 'E';
			var hexaValue = hexa.getValue();

			if (hexaValue == './images/misc/a.png') {

				answer2.html(
					'<p class="image"><img src="./images/misc/a.png" alt="A" width="120" /></p>' +
					'<p class="center"><?php echo _("Chemical energy in the molecules of wood is released."); ?></p>' + 
					'<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No, chemical energy in the wood is released."); ?></p>'
				);

				a2 = 'A';

			}

			if (hexaValue == './images/misc/b.png') {

				answer2.html(
					'<p class="image"><img src="./images/misc/b.png" alt="B" width="120" /></p>' +
					'<p class="center"><?php echo _("The air around the burning wood increases in temperature."); ?></p>' + 
					'<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No, the temperature of the air does increase."); ?></p>'
				);

				a2 = 'B';

			}

			if (hexaValue == './images/misc/c.png') {

				answer2.html(
					'<p class="image"><img src="./images/misc/c.png" alt="C" width="120" /></p>' +
					'<p class="center"><?php echo _("The wood undergoes a chemical change."); ?></p>' + 
					'<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No, the wood does change chemically when it burns."); ?></p>'
				);

				a2 = 'C';

			}

			if (hexaValue == './images/misc/d.png') {

				answer2.html(
					'<p class="image"><img src="./images/misc/d.png" alt="D" width="120" /></p>' +
					'<p class="center"><?php echo _("Energy is released due to friction."); ?></p>' + 
					'<p class="green center"><img src="images/misc/correct.png" alt="Correct" /> <?php echo _("Correct! Heat energy is released from stored chemical energy, not from friction."); ?></p>'
				);

				a2 = 'D';

			}

			
			if (answered == 0) {

				saveAnswer('heating-and-cooling-qc2-a', a1);
				saveAnswer('heating-and-cooling-qc2-b', a2);

				answered = 1;
			}
		}

		$(window).resize(function() { makeHexa(); });
	</script>

	<script>
		var hexa,
            images = [
                './images/misc/a.png',
                './images/misc/b.png',
                './images/misc/c.png',
                './images/misc/d.png'
            ];

		hexa = new HexaFlip(document.getElementById('hexaflip'), { set: images }, { size: 120 });
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
