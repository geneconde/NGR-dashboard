<?php 
	/* Comment out line 4 and uncomment lines (5, 6, 7, and 10 to 14) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";
	
	/*if ($user->getType() == 2) {
		$uf->updateStudentLastscreen(11, $_SESSION['smid']);
		$sa = $uf->getStudentAnswer($_SESSION['smid'], 'gravity-in-action-qc4-a');
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
		 h2, p, li { font-size: 20px; } 
		
		.wrap { border-color: #e5dd6f; }
		.bg { background-image: url(assets/11/bg.jpg); }

		.ac-custom input[type="radio"]:checked + label { color: #8B4277; }
		.ac-custom label { color: #000; padding: 0 0 5px 49px; }
		.ac-custom svg path { stroke: #8B4277; }

		#question1 .ac-custom label::before { background-color: #8B4277; height: 20px; width: 20px; margin-top: -11px; }
		#question1 .ac-custom svg { height: 42px; width: 37px; left: 1px; margin-top: -22px; }

		#question2 .ac-custom label::before { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px; }
		#question2 .ac-custom svg { height: 20px; width: 20px; left: 9px; }

		html[dir=rtl] .ac-custom label { padding-right: 49px; }

		html[dir=rtl] #question1 .ac-custom label::after { background-color: #8B4277; height: 20px; width: 20px; margin-top: -11px; }
		html[dir=rtl] #question1 .ac-custom svg { right: 3px; left: 98%; }

		html[dir=rtl] #question2 .ac-custom label::after { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px; }
		html[dir=rtl] #question2 .ac-custom svg { right: 9px; left: 98%; }

		.ac-custom li { padding: .2em 0; }

		#buttons .next { display: none; }
		<?php if($language == 'es_ES'){ ?>
			#questions p, #questions h2, #questions li { font-size: 19px; }
			#questions h1{ font-size: 30px;}
			#questions p, #questions h2{ margin-top: 2px; margin-bottom: 2px;}
			h2{ font-size:  19px; margin-top: 2px; margin-bottom: 2px;}
			#question2 .ac-custom label::before{height:30px; width: 30px;}

			#question2 .ac-custom svg { margin-top: -12px; left: 6px;}


		<?php }else{ ?>
			#question2 .ac-custom svg { margin-top: -10px; left: 6px;}

			<?php } ?>
		@media only screen and (max-width: 1250px) {p {margin: 0px auto;} .ac-custom label {  padding: 0 0 10px 50px;} .ac-custom li {  padding: 0em 0;} #question2 .ac-custom label::before{  margin-top: -25px;} #question2 .ac-custom svg {  margin-top: -15px;}.bg{ background-size:  100% calc(100% - 65px)!important; background-position: 0 34px; } .ac-custom label{font-size: .9em;}}
		@media screen and (max-width: 900px){
			h1{ font-size:  28px;}
			h2{ font-size:  19px; margin: 0px 0;}
			p{font-size:  19px; margin: 0px 0;}
			#question2 .ac-custom label::before{height:25px; width: 25px;}
			#question2 .ac-custom svg { margin-top: -20px; left: 5px; }
		}
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_12">

					<div id="questions">
						<h1 class="grid_12"><?php echo _("Quick Check #4"); ?></h1>

						<div id="question1">
							<p class="grid_12"><?php echo _("After learning about the acceleration due to gravity on free-falling objects, answer the following questions. Ignore the factor of air resistance in your answers. "); ?></p>

							<h2 class="grid_12"><?php echo _("Question A. A punted football is falling back to the field after reaching its peak height. How fast will it be moving when it is caught 3 seconds later? (acceleration due to gravity = 9.8 m/s2)"); ?></h2>

							<div class="grid_12">
								<form class="ac-custom ac-radio ac-circle" autocomplete="off">
									<ol>
										<li><input id="a1" name="q1" type="radio" value="A"><label for="a1"><span><?php echo _("0 meters per second"); ?></span></label></li>
										<li><input id="b1" name="q1" type="radio" value="B"><label for="b1"><span><?php echo _("9.8 m/s2"); ?></span></label></li>
										<li><input id="c1" name="q1" type="radio" value="C"><label for="c1"><span><?php echo _("19.6 meters"); ?></span></label></li>
										<li><input id="d1" name="q1" type="radio" value="D"><label for="d1"><span><?php echo _("29.4 meters per second"); ?></span></label></li>
									<ol>
								</form>
							</div>
						</div>

						<div id="question2">
							<h2 class="grid_12"><?php echo _("Question B. A watermelon and a marble are dropped from the same height. Which of the following is true?"); ?></h2>

							<div class="grid_12">
								<form class="ac-custom ac-radio ac-swirl" autocomplete="off">
									<ol>
										<li><input id="a2" name="q2" type="radio" value="A"><label for="a2"><span><?php echo _("Because it is heavier, the watermelon will accelerate more than the marble."); ?></span></label></li>
										<li><input id="b2" name="q2" type="radio" value="B"><label for="b2"><span><?php echo _("Because it is lighter, the marble will reach the ground later than the watermelon."); ?></span></label></li>
										<li><input id="c2" name="q2" type="radio" value="C"><label for="c2"><span><?php echo _("Because the acceleration due to gravity of 9.8 m/s2 is the same for all free-falling objects, both the watermelon and marble will reach the ground at the same time (ignoring air resistance)."); ?></span></label></li>
										<li><input id="d2" name="q2" type="radio" value="D"><label for="d2"><span><?php echo _("The watermelon and the marble will be accelerated at different amounts based on their sizes."); ?></span></label></li>
									<ol>
								</form>
							</div>
						</div>
					</div>

					<div id="answers">
						<h1 class="grid_12"><?php echo _("Quick Check #4"); ?> - <?php echo _("How did I do?"); ?></h1>

						<div id="answer1">
							<h2 class="grid_12"><?php echo _("Question A. A punted football is falling back to the field after reaching its peak height. How fast will it be moving when it is caught 3 seconds later? (acceleration due to gravity = 9.8 m/s2)"); ?></h2>

							<p class="grid_12"><?php echo _("You answered..."); ?></p>
							<p class="answer grid_12"></p>

							<div class="feedback grid_12"></div>
						</div>

						<div id="answer2">
							<h2 class="grid_12"><?php echo _("Question B. A watermelon and a marble are dropped from the same height. Which of the following is true?"); ?></h2>

							<p class="grid_12"><?php echo _("You answered..."); ?></p>
							<p class="answer grid_12"></p>

							<div class="feedback grid_12"></div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="12.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Ready for your last quick check?"); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/svgcheckbx.js"></script>

	<script>
		var answered = 1, /* Change 1 to <?php echo $answered; ?> when ported in the modules folder */
			checkAnswer = 0,
			answer1 = '',
			answer2 = '';

		function save() {

			$('#answer1 .answer').html($('#question1 input:radio:checked').parent().find('span').text());
			$('#answer2 .answer').html($('#question2 input:radio:checked').parent().find('span').text());

			answer1 = $('#question1 input:radio:checked').val();
			answer2 = $('#question2 input:radio:checked').val();
			//Question A
			if (answer1 == 'A')
				$('#answer1 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! The football has gained speed as it falls due to the force of gravity accelerating it."); ?></p>");

			if (answer1 == 'B')
				$('#answer1 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! This is the acceleration due to gravity, not the speed of the football after falling for 3 seconds."); ?></p>");

			if (answer1 == 'C')
				$('#answer1 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! This is the distance the football will have traveled in its fall after 2 seconds, not its speed after falling for 3 seconds."); ?></p>");

			if (answer1 == 'D')
				$('#answer1 .feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Correct!  After 3 seconds of free-fall, the football would have a speed of 29.4 meters per second."); ?></p>");
			
			//Question B
			if (answer2 == 'A')
				$('#answer2 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! Even though the watermelon is heavier, the acceleration due to gravity of 9.8 m/s2 is the same for all free-falling objects."); ?></p>");

			if (answer2 == 'B')
				$('#answer2 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! Even though the marble is lighter, the acceleration due to gravity of 9.8 m/s2 is the same for all free-falling objects."); ?></p>");

			if (answer2 == 'C')
				$('#answer2 .feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Right!  Ignoring air resistance, both will reach the ground at the same time because of the acceleration due to gravity being the same for each."); ?></p>");

			if (answer2 == 'D')
				$('#answer2 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! The acceleration due to gravity of 9.8 m/s2 is the same for all free-falling objects."); ?></p>");

			console.log(answer1);
			console.log(answer2);

			if (answered == 0) {
				saveAnswer('gravity-in-action-qc4-a', answer1); // Correct answer: A
				saveAnswer('gravity-in-action-qc4-b', answer2); // Correct answer: A

				answered = 1;
			}
		}

		$('.checkanswer').click(function() {
			checkAnswer = $('input:radio:checked').length;

			if (checkAnswer < 2) {
				alert("<?php echo _("Please select your answers."); ?>");
			} else {

				$('.back').fadeOut();

				$('.checkanswer').fadeOut(function() { 
					$('.next').fadeIn(); 
					$('.back').fadeIn(); 
				});

				$('#questions').fadeOut(function() { 

					save();

					$('#answers').fadeIn();

					window.location.hash = '#answer';
				}); 
			}
		});

		$('.back').click(function() {
			if ($('#questions').is(':visible')) {
				document.location.href = "10.php";
			} else if ($('#answers').is(':visible')) {

				$('.back').fadeOut();

				$('.next').fadeOut(function() { 
					$('.checkanswer').fadeIn(); 
					$('.back').fadeIn(); 
				});

				$('#answers').fadeOut(function() {
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
