<?php 
	/* Comment out line 4 and uncomment lines (5, 6, 7, and 10 to 14) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";
	
	/*if ($user->getType() == 2) {
		$uf->updateStudentLastscreen(18, $_SESSION['smid']);
		$sa = $uf->getStudentAnswer($_SESSION['smid'], 'gravity-in-action-qq3-a');
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
		
		.wrap { border-color: #e5dd6f; }
		.bg { background-image: url(assets/18/bg.jpg); }

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) { .bg { background-size: cover !important; } }

		.ac-custom input[type="radio"]:checked + label { color: #8B4277; }
		.ac-custom label { color: #000; padding-left: 49px; }
		.ac-custom label::before { background-color: #8B4277; height: 20px; width: 20px; margin-top: -11px; }
		.ac-custom svg { height: 42px; width: 37px; left: 1px; margin-top: -22px; }
		.ac-custom svg path { stroke: #8B4277; }

		html[dir=rtl] .ac-custom label { padding-right: 49px; }
		html[dir=rtl] .ac-custom label::after { background-color: #8B4277; height: 20px; width: 20px; margin-top: -11px; }
		html[dir=rtl] .ac-custom svg { right: 3px; left: 98%; }

		#answer { display: none; }
		#answer p { text-align: center; }

		#buttons .next { display: none; }
		@media screen and (max-width: 1250px){
		
			.bg{ background-size:  100% calc(100% - 65px)!important; background-position: 0 34px; }
		}
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_12">

					<div id="question" class="grid_12">
						<h1><?php echo _("Quiz Question #3"); ?></h1>
						<h2><?php echo _("Imagine a catastrophic event in which a huge asteroid slammed into the moon in a head-on collision. The moon remained about the same in terms of mass and shape after the collision, but the moon's orbital velocity was significantly slowed due to the force of the impact. Which of the following statements would be <span class='blink'>true</span> following the collision?"); ?></h2>

						<form class="ac-custom ac-radio ac-circle" autocomplete="off">
							<ol>
								<li><input id="a" name="q" type="radio" value="A"><label for="a"><span><?php echo _("The phases of the moon as seen from Earth would change."); ?></span></label></li>
								<li><input id="b" name="q" type="radio" value="B"><label for="b"><span><?php echo _("The moon would begin to slowly spiral down to Earth."); ?></span></label></li>
								<li><input id="c" name="q" type="radio" value="C"><label for="c"><span><?php echo _("The moon would start to move closer to the sun."); ?></span></label></li>
								<li><input id="d" name="q" type="radio" value="D"><label for="d"><span><?php echo _("The moon's orbit would not change."); ?></span></label></li>
							<ol>
						</form>
					</div>

					<div id="answer" class="grid_12">
						<h1><?php echo _("Quiz Question #3"); ?> - <?php echo _("How did I do?"); ?></h1>

						<p><?php echo _("You answered..."); ?></p>
						<p class="answer"></p>

						<div class="feedback"></div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="19.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Colliding asteroids..."); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/svgcheckbx.js"></script>

	<script>
		var answered = 1, /* Change 1 to <?php echo $answered; ?> when ported in the modules folder */
			checkAnswer = 0,
			answer = '';

		function save() {

			$('.answer').html($('input:radio:checked').parent().find('span').text());

			answer = $('input:radio:checked').val();

			if (answer == 'A')
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! The phases of the moon are the result of the moon's position in orbit and sunlight reflecting from it."); ?></p>");

			if (answer == 'B')
				$('.feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("You got it! The impact would cause the moon to slow down, which then would cause the moon to slowly start to spiral down to Earth."); ?></p>");

			if (answer == 'C')
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Not bad thinking! But the gravitational force between the moon and Earth would still be much greater than the gravitational force between the moon and the sun, so the moon would not start to move toward the sun."); ?></p>");

			if (answer == 'D')
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Just the opposite! The moon's orbit would begin to change as it spiraled into Earth."); ?></p>");

			console.log(answer);

			if (answered == 0) {
				saveAnswer('gravity-in-action-qq3-a', answer); // Correct answer: B
				answered = 1;
			}
		}

		$('.checkanswer').click(function() {
			 checkAnswer = $('input:radio:checked').length;

			if (checkAnswer == 0) {
				alert("<?php echo _("Please select your answer."); ?>");
			} else {

				$('.back').fadeOut();

				$('.checkanswer').fadeOut(function() { 
					$('.next').fadeIn(); 
					$('.back').fadeIn(); 
				});

				$('#question').fadeOut(function(){ 

					save();

					$('#answer').fadeIn();

					window.location.hash = '#answer';
				}); 
			}
		});

		$('.back').click(function() {
			if ($('#question').is(':visible')) {
				document.location.href = "17.php";
			} else if ($('#answer').is(':visible')) {

				$('.back').fadeOut();

				$('.next').fadeOut(function() { 
					$('.checkanswer').fadeIn(); 
					$('.back').fadeIn(); 
				});

				$('#answer').fadeOut(function() {
					$('#question').fadeIn();

					window.location.hash = '';
				});
			}
		});
	</script>

	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
