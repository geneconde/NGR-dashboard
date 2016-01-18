<?php 
	/* Comment out line 4 and uncomment lines (5, 6, 7, and 10 to 14) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";
	
	/*if ($user->getType() == 2) {
		$uf->updateStudentLastscreen(16, $_SESSION['smid']);
		$sa = $uf->getStudentAnswer($_SESSION['smid'], 'gravity-in-action-qq1-a');
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
		.bg { background-image: url(assets/16/bg.jpg); }

		.bounds { position: relative; }
		.bounds p { position: absolute; }

		.a p:first-child { left: 43%; top: 130px; }
		.a p:nth-child(2) { left: 49%; top: 0; }
		.a p:nth-child(3) { left: 23%; top: 55%; }
		.a p:nth-child(4) { right: 20%; top: 45%; }
		
		.b p:first-child { left: 36%; top: 130px; }
		.b p:nth-child(2) { left: 36%; top: 13%; }
		.b p:nth-child(3) { left: 18%; top: 63%; }
		.b p:nth-child(4) { right: 25%; top: 62%; }

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) { 
			.bg { background-size: cover !important; } 

			.a p:nth-child(2) { left: 49%; top: -2px; }
			.a p:nth-child(3) { left: 21%; top: 55%; }
			.a p:nth-child(4) { right: 18%; top: 45%; }

			.b p:nth-child(2) { left: 35%; top: 12%; }
			.b p:nth-child(3) { left: 16%; top: 63%; }
			.b p:nth-child(4) { right: 22%; top: 62%; }
		}

		.ac-custom li { padding: 5px 0; }
		.ac-custom label { color: #000; padding-left: 49px; }
		.ac-custom label::before { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px; }
		.ac-custom input[type="radio"]:checked + label { color: #8B4277; }
		.ac-custom svg { height: 20px; width: 20px; left: 9px; margin-top: -10px; }
		.ac-custom svg path { stroke: #8B4277; }

		html[dir=rtl] .ac-custom label { padding-right: 49px; }
		html[dir=rtl] .ac-custom label::after { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px; }
		html[dir=rtl] .ac-custom svg { right: 9px; left: 98%; }

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

					<div id="question">
						<h1 class="grid_12"><?php echo _("Quiz Question #1"); ?></h1>

						<h2 class="grid_12"><?php echo _("Look at the two sets of images, 1 and 2. Considering the factors that affect gravitational forces, which statement below is <span class='blink'>correct</span>?"); ?></h2>
						
						<div class="a bounds grid_4 prefix_1 suffix_1">
							<p><?php echo _("<span class='key'>Image 1</span>"); ?></p>
							<p><?php echo _("Far"); ?></p>
							<p><?php echo _("Big mass"); ?></p>
							<p><?php echo _("Small mass"); ?></p>

							<img src="assets/16/a.png">
						</div>

						<div class="b bounds grid_4 prefix_1 suffix_1">
							<p><?php echo _("<span class='key'>Image 2</span>"); ?></p>
							<p><?php echo _("Close"); ?></p>
							<p><?php echo _("Big mass"); ?></p>
							<p><?php echo _("Bigger mass"); ?></p>

							<img src="assets/16/b.png">
						</div>

						<div class="clear"></div>

						<div class="grid_12" style="margin-top: 20px;">
							<form class="ac-custom ac-radio ac-swirl" autocomplete="off">
								<ol>
									<li><input id="a" name="q" type="radio" value="A"><label for="a"><span><?php echo _("The gravitational force in image 1 is stronger because there is more total mass and the objects are closer together than those in image 2."); ?></span></label></li>
									<li><input id="b" name="q" type="radio" value="B"><label for="b"><span><?php echo _("The gravitational force in image 1 is stronger because there is less total mass and the objects are farther apart than in image 2."); ?></span></label></li>
									<li><input id="c" name="q" type="radio" value="C"><label for="c"><span><?php echo _("The gravitational force in image 1 is stronger because the total mass of both objects is more than that in image 2."); ?></span></label></li>
									<li><input id="d" name="q" type="radio" value="D"><label for="d"><span><?php echo _("The gravitational force in image 2 is stronger because there is more total mass and the objects are closer together than in image 1."); ?></span></label></li>
								<ol>
							</form>
						</div>
					</div>

					<div id="answer">
						<h1 class="grid_12"><?php echo _("Quiz Question #1"); ?> - <?php echo _("How did I do?"); ?></h1>

						<p class="grid_12"><?php echo _("You answered..."); ?></p>

						<div class="a bounds grid_4 prefix_1 suffix_1">
							<p></p>
							<p><?php echo _("Far"); ?></p>
							<p><?php echo _("Big mass"); ?></p>
							<p><?php echo _("Small mass"); ?></p>

							<img src="assets/16/a.png">
						</div>

						<div class="b bounds grid_4 prefix_1 suffix_1">
							<p></p>
							<p><?php echo _("Close"); ?></p>
							<p><?php echo _("Big mass"); ?></p>
							<p><?php echo _("Bigger mass"); ?></p>

							<img src="assets/16/b.png">
						</div>
						
						<div class="clear"></div>

						<p class="answer grid_12"></p>

						<div class="feedback grid_12"></div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="17.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Your first quiz question is..."); ?></strong></section></section>

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
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! The total of the masses is smaller and the distance between the masses is greater than in image 2. Gravitational forces increase as the distance between the two objects decreases and as the mass of the objects increases."); ?></p>");

			if (answer == 'B')
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! Gravitational forces increase as the distance between the two objects decreases and as the mass of the objects increases."); ?></p>");

			if (answer == 'C')
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! Gravitational forces increase as the distance between the two objects decreases and as the mass of the objects increases."); ?></p>");

			if (answer == 'D')
				$('.feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Correct. Gravitational forces increase as the distance between the two objects decreases and as the mass of the objects increases."); ?></p>");

			console.log(answer);

			if (answered == 0) {
				saveAnswer('gravity-in-action-qq1-a', answer); // Correct answer: D
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

				$('#question').fadeOut(function() { 

					save();

					$('#answer').fadeIn();

					window.location.hash = '#answer';
				}); 
			}
		});

		$('.back').click(function() {
			if ($('#question').is(':visible')) {
				document.location.href = "15.php";
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
