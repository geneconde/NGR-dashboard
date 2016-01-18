<?php 
	/* Comment out line 4 and uncomment lines (5, 6, 7, and 10 to 14) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";
	
	/*if ($user->getType() == 2) {
		$uf->updateStudentLastscreen(20, $_SESSION['smid']);
		$sa = $uf->getStudentAnswer($_SESSION['smid'], 'gravity-in-action-qq5-a');
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
		.bg { background-image: url(assets/20/bg.jpg); }

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) { .bg { background-size: cover !important; } }

		.ac-custom input[type="checkbox"]:checked + label { color: #8B4277; }
		.ac-custom label { color: #000; padding-left: 49px; }
		.ac-custom label::before { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px;}
		.ac-custom svg path { stroke: #8B4277; }
		.ac-custom svg { height: 20px; width: 20px; left: 9px; margin-top: -10px; }

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

					<div id="question" class="grid_12">
						<h1><?php echo _("Quiz Question #5"); ?></h1>
						<h2><?php echo _("Click on <span class='blink'>all</span> the statements that are an example of a satellite."); ?></h2>

						<form class="ac-custom ac-checkbox ac-checkmark" autocomplete="off">
							<ol>
								<li><input id="a" type="checkbox" value="A"><label for="a"><span><?php echo _("The moon orbits around the earth."); ?></span></label></li>
								<li><input id="b" type="checkbox" value="B"><label for="b"><span><?php echo _("The earth orbits around the sun."); ?></span></label></li>
								<li><input id="c" type="checkbox" value="C"><label for="c"><span><?php echo _("A comet orbiting the sun."); ?></span></label></li>
								<li><input id="d" type="checkbox" value="D"><label for="d"><span><?php echo _("The north star shines in the night sky. "); ?></span></label></li>
							<ol>
						</form>
					</div>

					<div id="answer" class="grid_12">
						<h1><?php echo _("Quiz Question #5"); ?> - <?php echo _("How did I do?"); ?></h1>

						<p><?php echo _("You answered..."); ?></p>

						<div class="answer"></div>
						<div class="feedback"></div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="21.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Orbiting satellites..."); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/svgcheckbx.js"></script>

	<script>
		var answered = 1, /* Change 1 to <?php echo $answered; ?> when ported in the modules folder */
			checkAnswer = 0,
			answer = '';

		function save() {

			$('input[type=checkbox]').each(function() {
				if ($(this).is(':checked')) {
					$('.answer').append("<p>" + $(this).parent().find('span').text() + "</p>");

					answer += $(this).val();
				}
			});

			if (answer == 'ABC') {
				$('.feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Correct! The moon, the earth and comet are all examples of satellites because the moon travels around the earth, and the earth and comet travel around the sun."); ?></p>");
			} else {
				$('.feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! The moon, the earth and comet are examples of satellites because the moon travels around the earth, and the earth and comet travel around the sun. But the north star is not a satellite because it does not travel around any other celestial body."); ?></p>");
			}

			//console.log(answer);

			if (answered == 0) {
				saveAnswer('gravity-in-action-qq5-a', answer); // Correct answer: ABC
				answered = 1;
			}
		}

		function clear() {
			$('.answer').html('');
			$('.feedback').html('');

			answer = '';
		}

		$('.checkanswer').click(function() {
			 checkAnswer = $('input:checkbox:checked').length;

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
				document.location.href = "19.php";
			} else if ($('#answer').is(':visible')) {

				$('.back').fadeOut(); 

				$('.next').fadeOut(function() { 
					$('.checkanswer').fadeIn(); 
					$('.back').fadeIn(); 
				});

				$('#answer').fadeOut(function() {

					clear();

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
