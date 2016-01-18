<?php 
	/* Comment out line 4 and uncomment lines (5, 6, 7, and 10 to 14) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";
	
	/*if ($user->getType() == 2) {
		$uf->updateStudentLastscreen(19, $_SESSION['smid']);
		$sa = $uf->getStudentAnswer($_SESSION['smid'], 'gravity-in-action-qq4-a');
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
	<link rel="stylesheet" href="css/hexaflip.css">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<?php if ($language == 'ar_EG') : ?>
		<link rel="stylesheet" href="css/grid_rtl.css">
	<?php else : ?>
		<link rel="stylesheet" href="css/grid.css">
	<?php endif; ?>

	<style>
		h1 { color: #0A5826; }
		
		.wrap { border-color: #e5dd6f; }
		.bg { background-image: url(assets/19/bg.jpg); }

		#box { margin-top: 20px; }
		#box p { font-size: 24px; text-align: center; }

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) { .bg { background-size: cover !important; } }

		#hexaflip { margin: 20px auto 0; }

		#answer { display: none; }
		#answer .image { width: 200px; margin: auto; }
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
						<h1><?php echo _("Quiz Question #4"); ?></h1>

						<h2><?php echo _("An astronaut lands on Planet X. This planet is much less massive than Earth. Which of the following statements is <span class='blink'>TRUE</span>?"); ?></h2>

						<ul>						
							<li>A. <?php echo _("The astronaut's body mass would be the same as on Earth."); ?></li>
							<li>B. <?php echo _("The astronaut's body weight would be more than that on Earth."); ?></li>
							<li>C. <?php echo _("The astronaut's body mass would be more than that on Earth."); ?></li>
							<li>D. <?php echo _("The astronaut's body weight would be the same than that on Earth."); ?></li>
						</ul>

						<div id="box">
							<p><?php echo _("Click, hold and slide your mouse up and down to rotate the box and select your answer."); ?></p>

							<div id="hexaflip"></div>
						</div>
					</div>

					<div id="answer">
						<h1 class="grid_12"><?php echo _("Quiz Question #4"); ?> - <?php echo _("How did I do?"); ?></h1>

						<p class="grid_12"><?php echo _("You answered..."); ?></p>

						<div class="image"></div>

						<p class="answer grid_12"></p>

						<div class="feedback grid_12"></div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="20.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Walking on the moon..."); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/hexaflip.js"></script>

	<script>
		var answered = 1, /* Change 1 to <?php echo $answered; ?> when ported in the modules folder */
			checkAnswer = 0,
			answer = '';

		function save() {
			var hexaValue = hexa.getValue();

			if (hexaValue == './assets/a.png') {
				$('.image').html("<img src='assets/a.png'>");
				$('.answer').html("<?php echo _("The astronaut's body mass would be the same as on Earth."); ?>");
				$('.feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Correct! The astronaut would weigh less on Planet X than on Earth, but her mass would remain the same."); ?></p>");

				answer = 'A';
			}

			if (hexaValue == './assets/b.png') {
				$('.image').html("<img src='assets/b.png'>");
				$('.answer').html("<?php echo _("The astronaut's body weight would be more than that on Earth."); ?>");
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope. The astronaut would weigh less on Planet X than on Earth, but her mass would remain the same."); ?></p>");

				answer = 'B';
			}

			if (hexaValue == './assets/c.png') {
				$('.image').html("<img src='assets/c.png'>");
				$('.answer').html("<?php echo _("The astronaut's body mass would be more than that on Earth."); ?>");
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("No, the astronaut's body mass would be the same as on Earth."); ?></p>");

				answer = 'C';
			}

			if (hexaValue == './assets/d.png') {
				$('.image').html("<img src='assets/d.png'>");
				$('.answer').html("<?php echo _("The astronaut's body weight would be the same than that on Earth."); ?>");
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("No, the astronaut's body weight would be less than that on Earth."); ?></p>");

				answer = 'D';
			}

			console.log(answer);

			if (answered == 0) {
				saveAnswer('gravity-in-action-qq4-a', answer); // Correct answer: A
				answered = 1;
			}
		}

		$('.checkanswer').click(function() {
			 checkAnswer = 1;

			if (checkAnswer == 0) {
				alert("<?php echo _("Please select your answer."); ?>");
			} else {

				$('.back').fadeOut(); 

				$('.checkanswer').fadeOut(function() { 
					$('.next').fadeIn(); 
					$('.back').fadeIn(); 
				});

				$('#question').fadeOut(function() { 

					save();

					$('#answer').fadeIn();

					window.location.hash = '#answer';
				}); 
			}
		});

		$('.back').click(function() {
			if ($('#question').is(':visible')) {
				document.location.href = "18.php";
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

		var hexa, images = [
			'./assets/a.png',
			'./assets/b.png',
			'./assets/c.png',
			'./assets/d.png'
		];

		hexa = new HexaFlip(document.getElementById('hexaflip'), { set: images }, { size: 180 });
	</script>

	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
