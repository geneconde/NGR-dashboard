<?php 
	/* Comment out line 4 and uncomment lines (5, 6, 7, and 10 to 14) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";
	
	/*if ($user->getType() == 2) {
		$uf->updateStudentLastscreen(9, $_SESSION['smid']);
		$sa = $uf->getStudentAnswer($_SESSION['smid'], 'gravity-in-action-qc3-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;*/
?>

<!DOCTYPE html>
<html <?php if ($language == 'ar_EG') echo 'dir="rtl"'; ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo _("Gravity in Action"); ?></title>

	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/locale.css">
	<link rel="stylesheet" href="css/jpreloader.css">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<?php if ($language == 'ar_EG') : ?>
		<link rel="stylesheet" href="css/grid_rtl.css">
		<link rel="stylesheet" href="css/ac_rtl.css">
	<?php else : ?>
		<link rel="stylesheet" href="css/grid.css">
		<link rel="stylesheet" href="css/ac.css">
	<?php endif; ?>

	<style>
		h1 { color: #0A5826; }
		/* p, h2 { font-size: 20px; } */
		
		.wrap { border-color: #e5dd6f; }
		.bg { background-image: url(assets/9/bg.jpg); }

		.ac-custom li { padding: 4px 0; }
		.ac-custom label { color: #000; font-size: 22px; padding-left: 49px; }
		.ac-custom svg path { stroke: #8B4277; }
		<?php if($language == 'es_ES'){ ?>
			#questions h2{ margin: 3px 0;}
		<?php } ?>
		#question1 .ac-custom input[type="radio"]:checked + label { color: #8B4277; }
		#question1 .ac-custom label::before { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px; }
		#question1 .ac-custom svg { height: 20px; width: 20px; left: 9px; margin-top: -10px; }

		html[dir=rtl] #question1 .ac-custom label::after { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px; }
		html[dir=rtl] #question1 .ac-custom svg { right: 9px; left: 98%; }

		#question2 .ac-custom input[type="checkbox"]:checked + label { color: #8B4277; }
		#question2 .ac-custom label::before { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px;}
		#question2 .ac-custom svg { height: 20px; width: 20px; left: 9px; margin-top: -10px; }

		html[dir=rtl] #question2 .ac-custom label::after { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px; }
		html[dir=rtl] #question2 .ac-custom svg { right: 9px; left: 98%; }

		html[dir=rtl] .ac-custom label { padding-right: 49px; }

		#buttons .next { display: none; }

		@media only screen and (max-width: 1250px) {
			.ac-custom label {font-size: 18px;} 
			.bg{ background-size:  100% calc(100% - 65px)!important; 
			background-position: 0 34px; } 
			#questions h2{margin: 3px 0;}
			.ac-custom li{ padding: 3px 0;}
			.ac-custom input[type="checkbox"]{  top:-25px; }
			#question2 .ac-custom label::before {left: 4px; height: 25px; width: 25px; margin-top: -13px} 
			#question1 .ac-custom label::before {height: 25px; width: 25px;margin-top: -13px; left:  3px;}
		}

		
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_12">

					<div id="questions">
						<h1 class="grid_12"><?php echo _("Quick Check #3"); ?></h1>

						<div id="question1" class="grid_12">
							<h2><?php echo _("Question A. Read the following statements and click on the <span class='blink'>correct</span> answer."); ?></h2>

							<form class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ol>
									<li><input id="a1" name="q1" type="radio" value="A"><label for="a1"><span><?php echo _("The force of gravity causes all objects launched up into the sky to fall back down to Earth."); ?></span></label></li>
									<li><input id="b1" name="q1" type="radio" value="B"><label for="b1"><span><?php echo _("Communication satellites are rocketed into space to a distance where Earth's gravity is much stronger."); ?></span></label></li>
									<li><input id="c1" name="q1" type="radio" value="C"><label for="c1"><span><?php echo _("Artificial satellites are like the moon in that they both orbit the earth."); ?></span></label></li>
									<li><input id="d1" name="q1" type="radio" value="D"><label for="d1"><span><?php echo _("If the moon had more velocity than it does while orbiting, it would spiral downward until it crashed into Earth's surface."); ?></span></label></li>
								<ol>
							</form>
						</div>

						<div id="question2" class="grid_12">
							<h2><?php echo _("Question B. Click on <span class='blink'>all</span> the statements that are <span class='blink'>true</span>."); ?></h2>

							<form class="ac-custom ac-checkbox ac-boxfill" autocomplete="off">
								<ol>
									<li><input id="a2" type="checkbox" value="A"><label for="a2"><span><?php echo _("For satellites to get into orbit, gravity is turned off."); ?></span></label></li>
									<li><input id="b2" type="checkbox" value="B"><label for="b2"><span><?php echo _("Natural satellites are celestial bodies."); ?></span></label></li>
									<li><input id="c2" type="checkbox" value="C"><label for="c2"><span><?php echo _("A communication satellite is a type of artificial satellite."); ?></span></label></li>
									<li><input id="d2" type="checkbox" value="D"><label for="d2"><span><?php echo _("Gravity affects the balance of motion of natural satellites, but does not affect artificial satellites."); ?></span></label></li>
									<li><input id="e2" type="checkbox" value="E"><label for="e2"><span><?php echo _("Gravity affects the balance of motion of natural and artificial satellites."); ?></span></label></li>
								<ol>
							</form>
						</div>
					</div>

					<div id="answers">
						<h1 class="grid_12"><?php echo _("Quick Check #3"); ?> - <?php echo _("How did I do?"); ?></h1>

						<div id="answer1" class="grid_12">
							<h2><?php echo _("Question A. Read the following statements and click on the <span class='blink'>correct</span> answer."); ?></h2>

							<p><?php echo _("You answered..."); ?></p>
							<p class="answer"></p>

							<div class="feedback"></div>
						</div>

						<div id="answer2" class="grid_12">
							<h2><?php echo _("Question B. Click on <span class='blink'>all</span> the statements that are <span class='blink'>true</span>."); ?></h2>

							<p><?php echo _("You answered..."); ?></p>

							<!-- <div class="answer"></div> -->
							<div class="feedback"></div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="10.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Repairing satellites..."); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/svgcheckbx.js"></script>

	<script>
		var answered = 1, /* Change 1 to <?php echo $answered; ?> when ported in the modules folder */
			checkAnswer = 0,
			answer1 = '',
			answer2 = '';

		function save() {

			$('#answer1 .answer').html($('#question1 input:radio:checked').parent().find('span').text());

			answer1 = $('#question1 input:radio:checked').val();

			if (answer1 == 'A')
				$('#answer1 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("This is not correct since some objects launched from Earth go into orbit as satellites."); ?></p>");

			if (answer1 == 'B')
				$('#answer1 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Just the opposite! Satellites are rocketed into space to a distance where Earth's gravity is much weaker. Remember, the force of gravity between two objects decreases as distance increases."); ?></p>");

			if (answer1 == 'C')
				$('#answer1 .feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Correct, the moon is in perfect balance of motion and gravity with the earth. Communication satellites try to simulate that balance. "); ?></p>");

			if (answer1 == 'D')
				$('#answer1 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope. If the moon had less velocity, it would spiral downward. If it had more velocity, the moon would continue on a path away from Earth."); ?></p>");

			$('input[type=checkbox]').each(function() {
				if ($(this).is(':checked')) {
					$('#answer2 .answer').append("<p>" + $(this).parent().find('span').text() + "</p>");

					answer2 += $(this).val();
				}
			});

			if (answer2 == 'BCE') {
				$('#answer2 .feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Correct! Natural satellites are celestial bodies and communication satellites are artificial satellites. The balance of motion of natural and artificial satellites depends on gravitational forces. Communication satellites are rocketed into space to a distance where Earth's gravity is much weaker - gravity can't be turned off."); ?></p>");
			} else {
				$('#answer2 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Not quite... Natural satellites are celestial bodies and communication satellites are artificial satellites. The balance of motion of natural and artificial satellites depends on gravitational forces. Communication satellites are rocketed into space to a distance where Earth's gravity is much weaker - gravity can't be turned off."); ?></p>");
			}

			console.log(answer1);
			console.log(answer2);

			if (answered == 0) {
				saveAnswer('gravity-in-action-qc3-a', answer1); // Correct answer: C
				saveAnswer('gravity-in-action-qc3-b', answer2); // Correct answer: BCE

				answered = 1;
			}
		}

		function clear() {
			$('#answer2 .answer').html('');
			$('#answer2 .feedback').html('');

			answer2 = '';
		}

		$('.checkanswer').click(function() {
			if ($('input:radio:checked').length == 0)
				checkAnswer = 0;
			else if ($('input:checkbox:checked').length == 0)
				checkAnswer = 0;
			else
				checkAnswer = 1;

			if (checkAnswer == 0) {
				alert("<?php echo _("Please select your answers."); ?>");
			} else {

				$('.back').fadeOut();

				$('.checkanswer').fadeOut(function() { 
					$('.next').fadeIn(); 
					$('.back').fadeIn(); 
				});

				$('#questions').fadeOut(function() { 
					$('#answers').fadeIn();

					save();

					window.location.hash = '#answer';
				}); 
			}
		});

		$('.back').click(function() {
			if ($('#questions').is(':visible')) {
				document.location.href = "8.php#screen2";
			} else if ($('#answers').is(':visible')) {

				$('.back').fadeOut();

				$('.next').fadeOut(function() { 
					$('.checkanswer').fadeIn(); 
					$('.back').fadeIn(); 
				});

				$('#answers').fadeOut(function() {

					clear();

					$('#questions').fadeIn();

					window.location.hash = '';
				});
			}
		});
	</script>

	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
