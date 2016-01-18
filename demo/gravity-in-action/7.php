<?php 
	/* Comment out line 4 and uncomment lines (5, 6, 7, and 10 to 14) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";
	
	/*if ($user->getType() == 2) {
		$uf->updateStudentLastscreen(7, $_SESSION['smid']);
		$sa = $uf->getStudentAnswer($_SESSION['smid'], 'gravity-in-action-qc2-a');
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
		.bg { background-image: url(assets/5/bg.jpg); }
		.ac-custom input[type="radio"]:checked + label { color: #8B4277; }
		.ac-custom label { color: #000; padding-left: 49px;  }
		.ac-custom svg path { stroke: #8B4277; }
		.ac-custom li {  padding: 0.3em 0;}
		#question1 .ac-custom label::before { background-color: #8B4277; height: 20px; width: 20px; margin-top: -11px; }
		#question1 .ac-custom svg { height: 42px; width: 37px; left: 1px; margin-top: -22px; }

		#question2 .ac-custom label::before { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px; }
		#question2 .ac-custom svg { height: 20px; width: 20px; left: 9px; margin-top: -10px; }

		html[dir=rtl] .ac-custom label { padding-right: 49px; }

		html[dir=rtl] #question1 .ac-custom label::after { background-color: #8B4277; height: 20px; width: 20px; margin-top: -11px; }
		html[dir=rtl] #question1 .ac-custom svg { right: 3px; left: 98%; }

		html[dir=rtl] #question2 .ac-custom label::after { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px; }
		html[dir=rtl] #question2 .ac-custom svg { right: 9px; left: 98%; }

		#buttons .next { display: none; }
		@media screen and (max-width: 1250px){
			<?php if($language == "es_ES") { ?>
				 h2{ margin: 5px 0;}
				 .ac-custom label{ font-size: 0.8em;}
			<?php } ?>
			.bg{ background-size:  100% calc(100% - 65px)!important; background-position: 0 34px; }
		}
		<?php if($language == "es_ES") { ?>
			body, h2 {font-size: 22px;}
		<?php } ?>

	
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_12">

					<div id="questions">
						<h1 class="grid_12"><?php echo _("Quick Check #2"); ?></h1>

						<div id="question1" class="grid_12">
							<h2><?php echo _("Question A. Read the sentences below and select the statement that is <span class='blink'>not correct</span>."); ?></h2>

							<form class="ac-custom ac-radio ac-circle" autocomplete="off">
								<ol>
									<li><input id="a1" name="q1" type="radio" value="A"><label for="a1"><span><?php echo _("High and low tides are related to the force of the moon pulling on Earth."); ?></span></label></li>
									<li><input id="b1" name="q1" type="radio" value="B"><label for="b1"><span><?php echo _("Just as the earth is pulling on the moon, the moon is pulling on the earth."); ?></span></label></li>
									<li><input id="c1" name="q1" type="radio" value="C"><label for="c1"><span><?php echo _("Ocean tides are caused by the gravitational pull of the moon."); ?></span></label></li>
									<li><input id="d1" name="q1" type="radio" value="D"><label for="d1"><span><?php echo _("The phases of the moon cause the high tides."); ?></span></label></li>
								<ol>
							</form>
						</div>

						<div id="question2" class="grid_12">
							<h2><?php echo _("Question B. Which of the following is <span class='blink'>true</span> considering the moon's force of gravity exerts a pulling force on Earth's oceans that then creates a \"bulge\" of water?"); ?></h2>

							<form class="ac-custom ac-radio ac-swirl" autocomplete="off">
								<ol>
									<li><input id="a2" name="q2" type="radio" value="A"><label for="a2"><span><?php echo _("A high tide will occur whenever the moon is directly  overhead or directly opposite a location on earth."); ?></span></label></li>
									<li><input id="b2" name="q2" type="radio" value="B"><label for="b2"><span><?php echo _("A low tide will occur whenever the moon is directly overhead."); ?></span></label></li>
									<li><input id="c2" name="q2" type="radio" value="C"><label for="c2"><span><?php echo _("A high tide will generally occur when the moon is new."); ?></span></label></li>
									<li><input id="d2" name="q2" type="radio" value="D"><label for="d2"><span><?php echo _("A high tide will generally occur when the moon is full."); ?></span></label></li>
								<ol>
							</form>
						</div>
					</div>

					<div id="answers">
						<h1 class="grid_12"><?php echo _("Quick Check #2"); ?> - <?php echo _("How did I do?"); ?></h1>

						<div id="answer1" class="grid_12">
							<h2><?php echo _("Question A. Read the sentences below and select the statement that is <span class='blink'>not correct</span>."); ?></h2>

							<p><?php echo _("You answered..."); ?></p>
							<p class="answer"></p>

							<div class="feedback"></div>
						</div>

						<div id="answer2" class="grid_12">
							<h2><?php echo _("Question B. Which of the following is <span class='blink'>true</span> considering the moon's force of gravity exerts a pulling force on Earth's oceans that then creates a \"bulge\" of water?"); ?></h2>

							<p><?php echo _("You answered..."); ?></p>
							<p class="answer"></p>

							<div class="feedback"></div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="8.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Looking at the moon..."); ?></strong></section></section>

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

			if (answer1 == 'A')
				$('#answer1 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("No, this sentence is true. Tides are caused by the pull of the moon, sun, and Earth rotating on its axis."); ?></p>");

			if (answer1 == 'B')
				$('#answer1 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("No, this sentence is true. All objects exert a gravitational pull on other objects. We might not feel it all the time, but it works both ways."); ?></p>");

			if (answer1 == 'C')
				$('#answer1 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("No, this sentence is true. Tides are caused by the pull of the moon, sun, and Earth rotating on its axis."); ?></p>");

			if (answer1 == 'D')
				$('#answer1 .feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Correct! This sentence is false. The bulge does not disappear; it is seen to move from east to west on Earth's surface."); ?></p>");

			
			if (answer2 == 'A')
				$('#answer2 .feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Correct! A high tide will generally occur whenever the moon is directly overhead. And remember, there will also be another high tide on the opposite side of the earth at the same time. "); ?></p>");

			if (answer2 == 'B')
				$('#answer2 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! A high tide, not a low tide, will generally occur whenever the moon is directly overhead or directly opposite a location on earth."); ?></p>");

			if (answer2 == 'C')
				$('#answer2 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! High and low tides occur daily during all phases of the moon."); ?></p>");

			if (answer2 == 'D')
				$('#answer2 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Nope! High and low tides occur daily during all phases of the moon."); ?></p>");

			console.log(answer1);
			console.log(answer2);

			if (answered == 0) {
				saveAnswer('gravity-in-action-qc2-a', answer1); // Correct answer: D
				saveAnswer('gravity-in-action-qc2-b', answer2); // Correct answer: A

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
				document.location.href = "6.php#screen2";
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
