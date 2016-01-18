<?php 
	/* Comment out line 4 and uncomment lines (5, 6, 7, and 10 to 14) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";
	
	/*if ($user->getType() == 2) {
		$uf->updateStudentLastscreen(17, $_SESSION['smid']);
		$sa = $uf->getStudentAnswer($_SESSION['smid'], 'gravity-in-action-qq2-a');
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
		.bg { background-image: url(assets/17/bg.jpg); }

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) { .bg { background-size: cover !important; } }

		#box p { font-size: 20px; text-align: center; }
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

					<div id="question">
						<h1 class="grid_12"><?php echo _("Quiz Question #2"); ?></h1>

						<h2 class="grid_12"><?php echo _("In science, the numbers we get from measurements are meaningless without units. Which of the following is a unit of gravitational force?"); ?></h2>

						<ul class="grid_5 prefix_1">						
							<li>A. <?php echo _("Newton"); ?></li>
							<li>B. <?php echo _("Kilometer"); ?></li>
							<li>C. <?php echo _("Kilogram"); ?></li>
							<li>D. <?php echo _("Newtons per Kilogram"); ?></li>
						</ul>

						<div id="box" class="grid_5 suffix_1">
							<p><?php echo _("Click, hold and slide your mouse up and down to rotate the box and select your answer."); ?></p>

							<div id="hexaflip"></div>
						</div>

						<div class="clear"></div>
					</div>

					<div id="answer">
						<h1 class="grid_12"><?php echo _("Quiz Question #2"); ?> - <?php echo _("How did I do?"); ?></h1>

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
		<a href="18.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Finding gravitational strength..."); ?></strong></section></section>

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
				$('.answer').html("<?php echo _("Newton"); ?>");
				$('.feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Correct! The newton (abbreviated 'N') was named in honor of Sir Isaac Newton, who discovered the three laws of motion."); ?></p>");

				answer = 'A';
			}

			if (hexaValue == './assets/b.png') {
				$('.image').html("<img src='assets/b.png'>");
				$('.answer').html("<?php echo _("Kilometer"); ?>");
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope. A kilometer is a measure of distance."); ?></p>");

				answer = 'B';
			}

			if (hexaValue == './assets/c.png') {
				$('.image').html("<img src='assets/c.png'>");
				$('.answer').html("<?php echo _("Kilogram"); ?>");
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope. A kilogram is a measure of mass."); ?></p>");

				answer = 'C';
			}

			if (hexaValue == './assets/d.png') {
				$('.image').html("<img src='assets/d.png'>");
				$('.answer').html("<?php echo _("Newtons per Kilogram"); ?>");
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Not quite, but you were close. Newton is the unit of gravity."); ?></p>");

				answer = 'D';
			}

			console.log(answer);

			if (answered == 0) {
				saveAnswer('gravity-in-action-qq2-a', answer); // Correct answer: A
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

				$('#question').fadeOut(function(){ 

					save();

					$('#answer').fadeIn();

					window.location.hash = '#answer';
				}); 
			}
		});

		$('.back').click(function() {
			if ($('#question').is(':visible')) {
				document.location.href = "16.php";
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
