<?php 
	/* Comment out line 4 and uncomment lines (5, 6, 7, and 10 to 14) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";
	
	/*if ($user->getType() == 2) {
		$uf->updateStudentLastscreen(5, $_SESSION['smid']);
		$sa = $uf->getStudentAnswer($_SESSION['smid'], 'gravity-in-action-qc1-a');
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

		p, h2, label, li { font-size: 20px; }
		
		.wrap { border-color: #e5dd6f; }
		.bg { background-image: url(assets/5/bg.jpg); }

		.grab { cursor: move; cursor: -moz-grab; cursor: -webkit-grab; }
		.grabbing { cursor: move; cursor: -moz-grabbing; cursor: -webkit-grabbing; }

		.bounds { padding: 6px 0; margin: 0; }

		.sortable li { 
			background-color: Chocolate; 
			cursor: move; 
			cursor: -moz-grab; 
			cursor: -webkit-grab; 
			color: PapayaWhip; 
			text-align: center; 
			border-radius: 5px; 
			margin: 0 0 7px 0; 
			position: relative; 
			z-index: 2; 
			font-size: 19px ;
			}

		.ac-custom li { padding: 6px 0; }
		.ac-custom input[type="checkbox"]:checked + label { color: #8B4277; }
		.ac-custom label { color: #000; padding-left: 49px; }
		.ac-custom label::before { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px;}
		.ac-custom svg path { stroke: #8B4277; }
		.ac-custom svg { height: 20px; width: 20px; left: 9px; margin-top: -10px; }

		html[dir=rtl] .ac-custom label { padding-right: 49px; }
		html[dir=rtl] .ac-custom label::after { border: 2px solid #8B4277; height: 34px; width: 34px; margin-top: -18px; }
		html[dir=rtl] .ac-custom svg { right: 9px; left: 98%; }

		#answer1 .sortable li { cursor: default !important; }
		#answer1 .feedback li { padding: 2px 0; }

		html[dir=rtl] #answer1 .feedback img { padding-right: 0; padding-left: 0; }

		#answer2 p { font-size: 20px  }

		#buttons .next { display: none; }

		@media only screen and (max-width: 1250px) {.sortable li {  margin: 0 0 3px 0;   font-size: 17px ;} p, h2, label, li {  font-size: 19px ;} #answer1 .feedback li {  padding: 0px 0;} .bg{ background-size:  100% calc(100% - 65px)!important; background-position: 0 34px; }}
		@media screen and  (max-width: 900px){
			h1{font-size:  28px;}
			h2{ margin: 5px 0 ; font-size:  18px !important;}
			.sortable li{font-size: 15px;}
			li{ font-size: 17px;}
			img{ width: 22px;height: 22px;}
		}
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_12">

					<div id="questions">
						<h1 class="grid_12"><?php echo _("Quick Check #1"); ?></h1>

						<div id="question1" class="grid_6">
							<h2><?php echo _("Question A. Use what you know about the relationship between mass and gravitational force to rank the celestial bodies (the planets and the Sun in our solar system). Drag the boxes of the celestial bodies up and down to sort them from highest to lowest based on gravitational force they possess. The highest gravity should be at the top."); ?></h2>
						
							<p class="center"><?php echo _("Celestial Body Mass"); ?></p>
							 <!-- (Kilograms x 10<sup>24</sup>) -->						
						
							<div class="bounds grid_8 prefix_2">
								<ul class="sortable">
									<li id="1"><?php echo _("Earth 5.97 x 10<sup>24</sup> Kilograms"); ?></li>
									<li id="2"><?php echo _("Jupiter 1,900 x 10<sup>24</sup> Kilograms"); ?></li>
									<li id="3"><?php echo _("Mars 0.641 x 10<sup>24</sup> Kilograms"); ?></li>
									<li id="4"><?php echo _("Mercury 0.330 x 10<sup>24</sup> Kilograms"); ?></li>
									<li id="5"><?php echo _("Neptune 102 x 10<sup>24</sup> Kilograms"); ?></li>
									<li id="6"><?php echo _("Saturn 568 x 10<sup>24</sup> Kilograms"); ?></li>
									<li id="7"><?php echo _("Sun 1,989,000 x 10<sup>24</sup> Kilograms"); ?></li>
									<li id="8"><?php echo _("Uranus 86.8 x 10<sup>24</sup> Kilograms"); ?></li>
									<li id="9"><?php echo _("Venus 4.87 x 10<sup>24</sup> Kilograms"); ?></li>
								</ul>
							</div>
						</div>

						<div id="question2" class="grid_6">
							<h2><?php echo _("Question B. A 1-liter bottle of water on earth has a mass of approximately 1 kilogram and weighs about 10 newtons. If that bottle is transported to a planet that has less mass than that of Earth, mark <span class='blink'>all</span> of the following that will be <span class='blink'>true</span>."); ?></h2>

							<form class="ac-custom ac-checkbox ac-cross" autocomplete="off">
								<ol>
									<li><input id="a" type="checkbox" value="A"><label for="a"><span><?php echo _("The weight of the bottle of water will remain the same."); ?></span></label></li>
									<li><input id="b" type="checkbox" value="B"><label for="b"><span><?php echo _("The weight of the bottle will be less than that on earth."); ?></span></label></li>
									<li><input id="c" type="checkbox" value="C"><label for="c"><span><?php echo _("The mass of the bottle of water will be more than that on earth."); ?></span></label></li>
									<li><input id="d" type="checkbox" value="D"><label for="d"><span><?php echo _("The mass of the bottle of water will be the same."); ?></span></label></li>
								<ol>
							</form>
						</div>

						<div class="clear"></div>
					</div>

					<div id="answers">
						<h1 class="grid_12"><?php echo _("Quick Check #1"); ?> - <?php echo _("How did I do?"); ?></h1>

						<div id="answer1" class="grid_6">
							<h2><?php echo _("Question A. Use what you know about the relationship between mass and gravitational force to rank the celestial bodies (the planets and the Sun in our solar system). Drag the boxes of the celestial bodies up and down to sort them from highest to lowest based on gravitational force they possess. The highest gravity should be at the top."); ?></h2>

							<p><?php echo _("You answered..."); ?></p>

							<div class="feedback grid_1 prefix_1">
								<ul>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
								</ul>
							</div>

							<div class="answer grid_8"></div>
							
							<div class="clear"></div>
						</div>

						<div id="answer2" class="grid_6">
							<h2><?php echo _("Question B. A 1-liter bottle of water on earth has a mass of approximately 1 kilogram and weighs about 10 newtons. If that bottle is transported to a planet that has less mass than that of Earth, mark <span class='blink'>all</span> of the following that will be <span class='blink'>true</span>."); ?></h2>

							<p><?php echo _("You answered..."); ?></p>

							<div class="answer"></div>
							<div class="feedback"></div>
						</div>

						<div class="clear"></div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="6.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Preparing your first quick check..."); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/jquery.ui.touch-punch.min.js"></script>
	<script src="js/svgcheckbx.js"></script>

	<script>
		var answered = 1, /* Change 1 to <?php echo $answered; ?> when ported in the modules folder */
			checkAnswer = 0,
			answer1 = '',
			answer2 = '';

		function save() {

			$('#answer1 .answer').html($('.bounds').html());

			if ($('#1').index() == 5) {
				$('#answer1 .feedback li:nth-child(6)').html("<img src='assets/correct.png'>");
			} else {
				$('#answer1 .feedback li:nth-child(6)').html("<img src='assets/wrong.png'>");
			}

			if ($('#2').index() == 1) {
				$('#answer1 .feedback li:nth-child(2)').html("<img src='assets/correct.png'>");
			} else {
				$('#answer1 .feedback li:nth-child(2)').html("<img src='assets/wrong.png'>");
			}
			
			if ($('#3').index() == 7) {
				$('#answer1 .feedback li:nth-child(8)').html("<img src='assets/correct.png'>");
			} else {
				$('#answer1 .feedback li:nth-child(8)').html("<img src='assets/wrong.png'>");
			}
			
			if ($('#4').index() == 8) {
				$('#answer1 .feedback li:nth-child(9)').html("<img src='assets/correct.png'>");
			} else {
				$('#answer1 .feedback li:nth-child(9)').html("<img src='assets/wrong.png'>");
			}
			
			if ($('#5').index() == 3) {
				$('#answer1 .feedback li:nth-child(4)').html("<img src='assets/correct.png'>");
			} else {
				$('#answer1 .feedback li:nth-child(4)').html("<img src='assets/wrong.png'>");
			}
			
			if ($('#6').index() == 2) {
				$('#answer1 .feedback li:nth-child(3)').html("<img src='assets/correct.png'>");
			} else {
				$('#answer1 .feedback li:nth-child(3)').html("<img src='assets/wrong.png'>");
			}
			
			if ($('#7').index() == 0) {
				$('#answer1 .feedback li:nth-child(1)').html("<img src='assets/correct.png'>");
			} else {
				$('#answer1 .feedback li:nth-child(1)').html("<img src='assets/wrong.png'>");
			}
			
			if ($('#8').index() == 4) {
				$('#answer1 .feedback li:nth-child(5)').html("<img src='assets/correct.png'>");
			} else {
				$('#answer1 .feedback li:nth-child(5)').html("<img src='assets/wrong.png'>");
			}
			
			if ($('#9').index() == 6) {
				$('#answer1 .feedback li:nth-child(7)').html("<img src='assets/correct.png'>");
			} else {
				$('#answer1 .feedback li:nth-child(7)').html("<img src='assets/wrong.png'>");
			}

			answer1 = $('#1').index().toString() + 
					  $('#2').index().toString() + 
					  $('#3').index().toString() + 
					  $('#4').index().toString() + 
					  $('#5').index().toString() + 
					  $('#6').index().toString() + 
					  $('#7').index().toString() + 
					  $('#8').index().toString() + 
					  $('#9').index().toString();

			$('input[type=checkbox]').each(function() {
				if ($(this).is(':checked')) {
					$('#answer2 .answer').append("<p>" + $(this).parent().find('span').text() + "</p>");

					answer2 += $(this).val();
				}
			});

			if (answer2 == 'BD') {
				$('#answer2 .feedback').html("<p class='green'><img src='assets/correct.png'><?php echo _("Correct! The total mass (amount of matter) of the bottle of water will not change, but because the mass of that planet is less than Earth, then the gravitational forces will be less--the bottle will weigh less."); ?></p>");
			} else {
				$('#answer2 .feedback').html("<p class='red'><img src='assets/wrong.png'><?php echo _("Not quite! The total mass (amount of matter) of the bottle of water will not change. Because the mass of that planet is less than Earth, then the gravitational forces will be less--the bottle will weigh less."); ?></p>");
			}

			console.log(answer1);
			console.log(answer2);
						
			if (answered == 0) {
				saveAnswer('gravity-in-action-qc1-a', answer1); // Correct answer: 517832046
				saveAnswer('gravity-in-action-qc1-b', answer2); // Correct answer: BD

				answered = 1;
			}
		}

		function clear() {
			$('#answer2 .answer').html('');
			$('#answer2 .feedback').html('');

			answer2 = '';
		}

		$('.checkanswer').click(function() {
			checkAnswer = $('input:checkbox:checked').length;

			if (checkAnswer == 0) {
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
				document.location.href = "4.php#screen2";
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

		$(".sortable").sortable({ scroll: false, containment: ".bounds" });
	</script>

	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
