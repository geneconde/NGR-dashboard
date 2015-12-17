<?php 
	require_once '../../session.php';
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once 'locale.php';
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(20, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'heating-and-cooling-qq5-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo _("Heating and Cooling"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="initial-scale=1">

	<link rel="stylesheet" href="css/locale.css" />
	<link rel="stylesheet" href="css/fonts.css" />
	<link rel="stylesheet" href="css/jpreloader.css" />
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<style>
		html, body {overflow: hidden;}
		p, h3, li { font-size: 24px; }
		.bg img { width: 80px; }
		#buttons .next { display: none; }

		.bg { background-image: url('images/20/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; z-index: 10;  }

		.correct { background-color: Green !important; color: #fff !important; }

		.wrong { background-color: Red !important; color: #fff !important; }

		.wrap { position: static; }
		.answer { padding: 0 10px !important; }

		#feedbacks { margin: 0; text-align: center; }

		#answer { display: none; }
		#preview { position: absolute; width: 259px; height: 191px; display: none; }

		#question table, #answer table {width: 97%; margin: 10px auto; text-align:center; border-radius: 10px; }
		#question table th, #question table td, #answer table th, #answer table td { background: rgba(255, 255, 255, .5); font-weight: normal; text-transform: uppercase; font-size: 18px; border: 1px solid rgba(255, 255, 255, .8); padding: 5px 15px 0 5px; }
		#question table td { font-size: 16px; }
		#question table p, #answer table p { margin: 0; }
		#question table th, #answer table th { padding: 5px 15px; text-align: center; }
		#question table tr th:nth-child(1) { color: #777; }
		#question table tr th:nth-child(2), #answer table tr th:nth-child(2) { color: #ed2a7b; }
		#question table tr th:nth-child(3), #answer table tr th:nth-child(3) { color: #91268f; }
		#question table tr th:nth-child(4), #answer table tr th:nth-child(4) { color: #7cc623; }

		#question table th:first-child, #answer table th:first-child { border-top-left-radius: 10px; }
		#question table th:last-child, #answer table th:last-child { border-top-right-radius: 10px; }

		#answer p, #answer h3, #answer li, #answer table th { font-size: 20px; }
		#answer p { padding: 0; font-size: 24px; }
		#answer table { margin: 20px auto; }

		#draggable { width: 100%; height: 100%; text-align: center; }
		#droppable { min-width: 1px; padding: 0; min-height: 19px; text-align: center; height: 70px; }

		img.mark { border: 0 !important; width: 22px; height: 25px; border-radius: none; -webkit-border-radius: none; -moz-border-radius: none; }
		[draggable] { cursor: url(https://mail.google.com/mail/images/2/openhand.cur), default !important; }
		[draggable]:active { cursor: url(https://mail.google.com/mail/images/2/closedhand.cur), default !important; }

		.grab { cursor: move; cursor: -moz-grab; cursor: -webkit-grab; }
		.grabbing { cursor: move; cursor: -moz-grabbing; cursor: -webkit-grabbing; }
		#dp_swf_engine { display: none; }
		
		.lang-menu {z-index:10;}
		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
		}
		@media only screen and (min-width: 600px) and (max-width: 1250px)  and (orientation : landscape)  and (-webkit-min-device-pixel-ratio: 1){
			#question img {width:60px;}
		}
	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #5"); ?></h1>
				<h2><?php echo _("In each example, how does heat energy transfer? Drag the methods either on conduction, convection, or radiation for each question."); ?></h2>

				<table>
					<tr>
						<th><?php echo _("Method"); ?></th>
						<th><?php echo _("Conduction"); ?></th>
						<th><?php echo _("Convection"); ?></th>
						<th><?php echo _("Radiation"); ?></th>
					</tr>

					<tr>
						<td class="a"><img id="drag1" class="grab" src="images/20/1.jpg" alt="<?php echo _("Touching the handle of a hot pot from the stove"); ?>"></td>
						<td id="10"></td>
						<td id="11"></td>
						<td id="12"></td>
					</tr>

					<tr>
						<td class="b"><img id="drag2" class="grab" src="images/20/2.jpg" alt="<?php echo _("Sitting out in a sunny day"); ?>"></td>
						<td id="20"></td>
						<td id="21"></td>
						<td id="22"></td>
					</tr>

					<tr>
						<td class="c"><img id="drag3" class="grab" src="images/20/3.jpg" alt="<?php echo _("Sitting by a campfire"); ?>"></td>
						<td id="30"></td>
						<td id="31"></td>
						<td id="32"></td>
					</tr>

<!-- 					<tr>
						<td class="d"><img id="drag4" class="grab" src="images/20/4.jpg" alt="<?php echo _("Drying your hair with a hair dryer"); ?>"></td>
						<td id="40"></td>
						<td id="41"></td>
						<td id="42"></td>
					</tr> -->

					<tr>
						<td class="e"><img id="drag5" class="grab" src="images/20/5.jpg" alt="<?php echo _("Bubbles rising in a pot of water on the stove"); ?>"></td>
						<td id="50"></td>
						<td id="51"></td>
						<td id="52"></td>
					</tr>

					<tr>
						<td class="f"><img id="drag6" class="grab" src="images/20/6.jpg" alt="<?php echo _("Person warming their hands on a cup of hot chocolate"); ?>"></td>
						<td id="60"></td>
						<td id="61"></td>
						<td id="62"></td>
					</tr>
				</table>
			</div>

			<div id="answer">
				<h1><?php echo _("Quiz Question #5"); ?> - <?php echo _("How did I do?"); ?></h1>
				<p><?php echo _("Please check your answers."); ?></p>

				<table>
					<tr>
						<th>&nbsp;</th>
						<th><?php echo _("Conduction"); ?></th>
						<th><?php echo _("Convection"); ?></th>
						<th><?php echo _("Radiation"); ?></th>
					</tr>

					<tr>
						<td id="answer1"></td>
						<td id="10"></td>
						<td id="11"></td>
						<td id="12"></td>
					</tr>

					<tr>
						<td id="answer2"></td>
						<td id="20"></td>
						<td id="21"></td>
						<td id="22"></td>
					</tr>

					<tr>
						<td id="answer3"></td>
						<td id="30"></td>
						<td id="31"></td>
						<td id="32"></td>
					</tr>

<!-- 					<tr>
						<td id="answer4"></td>
						<td id="40"></td>
						<td id="41"></td>
						<td id="42"></td>
					</tr> -->

					<tr>
						<td id="answer5"></td>
						<td id="50"></td>
						<td id="51"></td>
						<td id="52"></td>
					</tr>

					<tr>
						<td id="answer6"></td>
						<td id="60"></td>
						<td id="61"></td>
						<td id="62"></td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="21.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Transferring heat..."); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/jquery-ui.js"></script>
	<script src="scripts/jquery.ui.touch-punch.min.js"></script>
	<script src="scripts/saveanswer.js"></script>
	<script src="scripts/qtip.js"></script>
	<script src="scripts/rightclick.js"></script>
	<script>
		var answered = <?php echo $answered; ?>,
		question = $('#question'),
		answer = $('#answer'),
		check = $('a.checkanswer'),
		back = $('a.back'),
		next = $('a.next'); 

		check.on('click', function() {
			if ($('td.a').html() == "" && $('td.b').html() == "" && $('td.c').html() == "" /* && $('td.d').html() == "" */ && $('td.e').html() == "" && $('td.f').html() == "") {
				question.fadeOut(function() {
					answer.fadeIn();
					window.location.hash = "#answer";
				});
				check.fadeOut(function() { next.fadeIn(); back.fadeIn(); });
				save();
			} else {
				alert('<?php echo _("Please select your answers."); ?>');
			}
		});

		back.on('click', function() {
			if (question.is(':visible')) { document.location.href = "19.php"; }
			else {
				answer.fadeOut(function() { question.fadeIn(); });
				next.fadeOut(function() { check.fadeIn(); });
			}
		});
		
		$('#question img').draggable({ revert: 'invalid', containment: "#question table", scroll: false });

		$('#question img').each(function() {
			var image = $(this);
			image.mousedown(function() { image.removeClass('grab'); image.addClass('grabbing'); image.css('opacity', '0.7'); });
			image.mouseup(function() { image.removeClass('grabbing'); image.addClass('grab'); image.css('opacity', '1'); });
			
			var p = $(this).parent().parent().children(':not(:first-child)');
			var drop1, drop2, drop3;
			
			for(var i = 1; i < 4; i++) {
				window['drop' + i] = image.parent().parent().children(':nth-child(' + (i + 1) +')');
				window['drop' + i].droppable ({
					accept: image,
					drop: function (event, ui) { image.detach().css({top: 0,left: 0}).appendTo($(this)); }
				});
			}
		});


		function save() {
			var ans1 = null,
			ans2 = null,
			ans3 = null,
			// ans4 = null,
			ans5 = null,
			ans6 = null,

			fb1 = $('#fb1'),
			fb2 = $('#fb2'),
			fb3 = $('#fb3'),
			// fb4 = $('#fb4'),
			fb5 = $('#fb5'),
			fb6 = $('#fb6');

			var y = '<img class="mark" src="images/misc/correct.png">';
			var n = '<img class="mark" src="images/misc/wrong.png">';

			if ($('#10').html() != '') {
				ans1 = 'conduction';
				$('#answer1').html(y);

				answer.find('#10').html(question.find('#10').html());
				answer.find('#11').html('');
				answer.find('#12').html('');
			} else if ($('#11').html() != '') {
				ans1 = 'convection';
				$('#answer1').html(n);

				answer.find('#10').html('');
				answer.find('#11').html(question.find('#11').html());
				answer.find('#12').html('');
			} else if ($('#12').html() != '') {
				ans1 = 'radiation';
				$('#answer1').html(n);

				answer.find('#10').html('');
				answer.find('#11').html('');
				answer.find('#12').html(question.find('#12').html());
			}
			
			if ($('#20').html() != '') {
				ans2 = 'conduction';
				$('#answer2').html(n);

				answer.find('#20').html(question.find('#20').html());
				answer.find('#21').html('');
				answer.find('#22').html('');		
			} else if ( $('#21').html() != '' ) {
				ans2 = 'convection';
				$('#answer2').html(n);

				answer.find('#20').html('');
				answer.find('#21').html(question.find('#21').html());
				answer.find('#22').html('');
			} else if ( $('#22').html() != '' ) {
				ans2 = 'radiation';
				$('#answer2').html(y);

				answer.find('#20').html('');
				answer.find('#21').html('');
				answer.find('#22').html(question.find('#22').html());
			}

			if ( $('#30').html() != '' ) {
				ans3 = 'conduction';				
				$('#answer3').html(n);

				answer.find('#30').html(question.find('#30').html());
				answer.find('#31').html('');
				answer.find('#32').html('');
			} else if ( $('#31').html() != '' ) {
				ans3 = 'convection';
				$('#answer3').html(n);

				answer.find('#30').html('');
				answer.find('#31').html(question.find('#31').html());
				answer.find('#32').html('');
			} else if ( $('#32').html() != '' ) {
				ans3 = 'radiation';
				$('#answer3').html(y);

				answer.find('#30').html('');
				answer.find('#31').html('');
				answer.find('#32').html(question.find('#32').html());
			}

			// if ( $('#40').html() != '' ) {
			// 	ans4 = 'conduction';
			// 	$('#answer4').html(n);

			// 	answer.find('#40').html(question.find('#40').html());
			// 	answer.find('#41').html('');
			// 	answer.find('#42').html('');
			// } else if ( $('#41').html() != '' ) {
			// 	ans4 = 'convection';
			// 	$('#answer4').html(y);

			// 	answer.find('#40').html('');
			// 	answer.find('#41').html(question.find('#41').html());
			// 	answer.find('#42').html('');
			// } else if ( $('#42').html() != '' ) {
			// 	ans4 = 'radiation';
			// 	$('#answer4').html(n);

			// 	answer.find('#40').html('');
			// 	answer.find('#41').html('');
			// 	answer.find('#42').html(question.find('#42').html());
			// }

			if ( $('#50').html() != '' ) {
				ans5 = 'conduction';
				$('#answer5').html(n);

				answer.find('#50').html(question.find('#50').html());
				answer.find('#51').html('');
				answer.find('#52').html('');	
			} else if ( $('#51').html() != '' ) {
				ans5 = 'convection';
				$('#answer5').html(y);

				answer.find('#50').html('');
				answer.find('#51').html(question.find('#51').html());
				answer.find('#52').html('');
			} else if ( $('#52').html() != '' ) {
				ans5 = 'radiation';
				$('#answer5').html(n);

				answer.find('#50').html('');
				answer.find('#51').html('');
				answer.find('#52').html(question.find('#52').html());
			}

			if ( $('#60').html() != '' ) {
				ans6 = 'conduction';
				$('#answer6').html(y);

				answer.find('#60').html(question.find('#60').html());
				answer.find('#61').html('');
				answer.find('#62').html('');		
			} else if ( $('#61').html() != '' ) {
				ans6 = 'convection';
				$('#answer6').html(n);

				answer.find('#60').html('');
				answer.find('#61').html(question.find('#61').html());
				answer.find('#62').html('');
			} else if ( $('#62').html() != '' ) {
				ans6 = 'radiation';
				$('#answer6').html(n);

				answer.find('#60').html('');
				answer.find('#61').html('');
				answer.find('#60').html('');
				answer.find('#61').html('');
				answer.find('#60').html('');
				answer.find('#61').html('');
				answer.find('#62').html(question.find('#62').html());
			}

			if (answered == 0) {
				saveAnswer('heating-and-cooling-qq5-a', ans1);
				saveAnswer('heating-and-cooling-qq5-b', ans2);
				saveAnswer('heating-and-cooling-qq5-c', ans3);
				// saveAnswer('heating-and-cooling-qq5-d', ans4);
				saveAnswer('heating-and-cooling-qq5-e', ans5);
				saveAnswer('heating-and-cooling-qq5-f', ans6);
				answered = 1;
			}	
		}

		$('.bg img').qtip({
			content: $(this).attr('alt'),
			position: {
				corner: {
					tooltip: 'bottomLeft',
					target: 'topRight'
				}
			},
			style: {
				border: {
					radius: 5
				},
				tip: true,
				name: 'cream'
			}
		});
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
