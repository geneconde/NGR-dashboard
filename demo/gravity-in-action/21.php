<?php 
	/* Comment out line 4 and uncomment lines (5, 6, 7, and 10 to 14) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";
	
	/*if ($user->getType() == 2) {
		$uf->updateStudentLastscreen(21, $_SESSION['smid']);
		$sa = $uf->getStudentAnswer($_SESSION['smid'], 'gravity-in-action-qq6-a');
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
		.bg { background-image: url(assets/21/bg.jpg); }

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) { .bg { background-size: cover !important; } }

		.ac-custom label { color: #000; padding-left: 49px; font-size: .95em; }
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

		.ac-custom li { padding: .3em 0;}

		#fig_desc, #fig_desc2 { position: relative; }
		#fig_desc p, #fig_desc2 p { position: absolute; font-size: 18px; z-index: 2; text-align: center; line-height: 1; color: #000; }
		#fig_desc p:first-child, #fig_desc2 p:first-child { color: blue; left: 50%; top: 6%; }
		#fig_desc p:nth-child(2), #fig_desc2 p:nth-child(2) { color: blue; left: -110%; top: 70%;}
		#fig_desc p:nth-child(3), #fig_desc2 p:nth-child(3) { color: blue; left: 87%; top: 67%;}
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
						<h1 class="grid_12"><?php echo _("Quiz Question #6"); ?></h1>

						<h2 class="grid_12"><?php echo _("Look at the figure below. Which statement is <span class='key'>TRUE</span>? (Note: Be careful! The size of the object doesn’t represent the mass of the object!)"); ?></h2>

						<div class="grid_4 prefix_4">
							
							<div id="fig_desc">
								<p class="grid_12 prefix_1"><?php echo _('1 - A "lead" ball having a mass of 100 kilograms'); ?> </p>
								<p class="grid_12 prefix_1"><?php echo _('2 - An "aluminum" ball having a mass of 75 kilograms'); ?> </p>
								<p class="grid_12 prefix_1"><?php echo _('3 - A "steel" ball having a mass of 50 kilograms.'); ?> </p>

								<img src="assets/21/figure.png">
							</div>

							<!-- <img src="assets/21/figure.png"> -->
						</div>

						<div class="grid_12">
							<form class="ac-custom ac-radio ac-swirl" autocomplete="off">
								<ol>
									<li><input id="a" name="q" type="radio" value="A"><label for="a"><span><?php echo _("Being the most massive, only Object 1 exerts a gravitational force on the other objects."); ?></span></label></li>
									<li><input id="b" name="q" type="radio" value="B"><label for="b"><span><?php echo _("Having a mass between Objects 1 and 3, Object 2 exerts the greatest force on the other objects."); ?></span></label></li>
									<li><input id="c" name="q" type="radio" value="C"><label for="c"><span><?php echo _("The gravitational force between Objects 1 and 2 is greater than the force between Objects 1 and 3."); ?></span></label></li>
									<li><input id="d" name="q" type="radio" value="D"><label for="d"><span><?php echo _("The gravitational force between Objects 1 and 2 and Objects 1 and 3 is the same."); ?></span></label></li>
								<ol>
							</form>
						</div>
					</div>

					<div id="answer">
						<h1 class="grid_12"><?php echo _("Quiz Question #6"); ?> - <?php echo _("How did I do?"); ?></h1>

						<p class="grid_12"><?php echo _("You answered..."); ?></p>

						<div class="grid_4 prefix_4">
							<div id="fig_desc2">
								<p class="grid_12 prefix_1"><?php echo _('1 - A "lead" ball having a mass of 100 kilograms'); ?> </p>
								<p class="grid_12 prefix_1"><?php echo _('2 - An "aluminum" ball having a mass of 75 kilograms'); ?> </p>
								<p class="grid_12 prefix_1"><?php echo _('3 - A "steel" ball having a mass of 50 kilograms.'); ?> </p>

								<img src="assets/21/figure.png">
							</div>
						</div>

						<p class="answer grid_12"></p>

						<div class="feedback grid_12"></div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="22.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Ready for your last quiz question?"); ?></strong></section></section>

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
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope. All objects with mass exert a gravitational force on other objects."); ?></p>");

			if (answer == 'B')
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope. Object 1, being the most massive, exerts the greatest gravitational force."); ?></p>");

			if (answer == 'C')
				$('.feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Correct. Due to the larger mass of Object 1, the gravitational force exerted between Objects 1 and 2 is greater than that between Objects 2 and 3."); ?></p>");

			if (answer == 'D')
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope. A gravitational force is exerted by each object on the others. Their masses affect the amount of force they exert."); ?></p>");

			console.log(answer);

			if (answered == 0) {
				saveAnswer('gravity-in-action-qq6-a', answer); // Correct answer: C
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
				document.location.href = "20.php";
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
