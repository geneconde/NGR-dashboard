<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(21, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'gathering-data-qq6-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Gathering Data"); ?></title> <!-- Change module title here -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" type="text/css" href="styles/svgcomponent.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/save-answer.js"></script>
<script src="scripts/svgmodernizr.custom.js"></script>
<style>
.wrap { border-left: 1px dashed #c1d0e5; border-right: 1px dashed #c1d0e5; }
.bg { background: url('images/18/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
img.next-toggle { display: none; }

#answer p { text-align: center; }
#answer img { height: 30px; }
#left, #right { width:35%; float: left; }
#left { margin-left: 3%; }

#right li { font-size: 24px; }
.ac-custom li {padding:10px;}
.ac-custom label.r1::before { color: red; margin-top: -28px }
.ac-custom label::before { color: #4FCBC7; background: #4FCFC9; }
.ac-circle label::before { width: 20px; height: 20px; margin-top: 0; left: 30px; }
.ac-circle svg { width: 35px; margin-top: -25px; left: 33px;color: #FFD47F; }

.ac-custom input[type="radio"]:checked + label { color: #FFFFFF; }

table { margin: 5% auto; }
table span { font-size: 24px; }
tr {  }
td { padding: 5px 5px 5px 15px; background: #F4938C; border-radius: 5px;}
td:not(:first-child) {
	margin-left: 20px;
}
th:not(:first-child) {
	width: 120px;
	font-size: 22px;
	border: 3px solid #F4938C;
	background-color: #F4938C;
	-webkit-border-top-left-radius: 5px;
	-webkit-border-top-right-radius: 5px;
	-moz-border-radius-topleft: 5px;
	-moz-border-radius-topright: 5px;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
	padding: 0;
}
table img { width: 25px;display: block;
margin-left: auto;
margin-right: auto; }
.yAns{display:none;text-align: center;}
html[dir="rtl"] .ac-custom label { padding: 0 40px; }
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1 id="title"><?php echo _('Quiz Question #6'); ?></h1>
				<h1 id="answer"><?php echo _('Quiz Question #6'); ?> - <?php echo _('How did I do?'); ?></h1>
				<section>
					<form class="ac-custom ac-radio ac-circle" autocomplete="off">
						<h2><?php echo _('Click on the circle next to the word qualitative or quantitative to select the type of data you think the descriptions of chocolate milk are.'); ?></h2>
						<p class="yAns"><?php echo _('You answered...'); ?></p>
						<table>
							<tr>
								<th> </th>
								<th><?php echo _('Qualitative Data'); ?></th>
								<th><?php echo _('Quantitative Data'); ?></th>
							</tr>
							<tr>
								<td><span><?php echo _('Sweet taste'); ?></span></td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="a1" name="r1" type="radio"><label for="a1" class="css-label"></li>
										</ul>
									</section>
								</td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="a2" name="r1" type="radio"><label for="a2" class="css-label"></li>
										</ul>
									</section>
								</td>
							</tr>
							<tr>
								<td><span><?php echo _('Serving temperature 150º F'); ?></span></td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="b1" name="r2" type="radio"><label for="b1" class="css-label"></li>
										</ul>
									</section>
								</td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="b2" name="r2" type="radio"><label for="b2" class="css-label"></li>
										</ul>
									</section>
								</td>
							</tr>
							<tr>
								<td><span><?php echo _('12 ounces of hot chocolate'); ?></span></td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="c1" name="r3" type="radio"><label for="c1" class="css-label"></li>
										</ul>
									</section>
								</td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="c2" name="r3" type="radio"><label for="c2" class="css-label"></li>
										</ul>
									</section>
								</td>
							</tr>
							<tr>
								<td><span><?php echo _('Frothy appearance'); ?></span></td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="d1" name="r4" type="radio"><label for="d1" class="css-label"></li>
										</ul>
									</section>
								</td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="d2" name="r4" type="radio"><label for="d2" class="css-label"></li>
										</ul>
									</section>
								</td>
							</tr>
							<tr>
							
								<td><span><?php echo _('Strong taste'); ?></span></td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="e1" name="r5" type="radio"><label for="e1" class="css-label"></li>
										</ul>
									</section>
								</td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="e2" name="r5" type="radio"><label for="e2" class="css-label"></li>
										</ul>
									</section>
								</td>
							</tr>
							<tr>
								<td><span><?php echo _('Serving glass is 7 inches in height'); ?></span></td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="f1" name="r6" type="radio"><label for="f1" class="css-label"></li>
										</ul>
									</section>
								</td>
								<td>
									<section class="ac-custom ac-radio ac-circle" autocomplete="off">
										<ul>
											<li><input id="f2" name="r6" type="radio"><label for="f2" class="css-label"></li>
										</ul>
									</section>
								</td>
							</tr>
						</table>
						
						
					</form>
				</section>
				
			</div>
		
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#answer" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _("Check Answer"); ?>"></a>
		<a href="22.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Ready for your last quiz question?'); ?> </strong></section></section>
	<script>
	
	var nullAnswer = false;
	var answer1, answer2, answer3, answer4, answer5, answer6;
	var answered = <?php echo $answered; ?>;
	
	$(document).ready(function() {
		$('img.back-toggle').click(function() {
			if($('#title').is(':visible')) {
				document.location.href = "20.php";
			} else if ($('#answer').is(':visible')) {
				$('img.next-toggle').fadeOut(function() { $('img.check-toggle').fadeIn(); });
				$('.yAns').fadeOut();
				$('#answer').fadeOut(function() {
					$('#title').fadeIn();
					$('h2').fadeIn();
					$('input:radio').attr('disabled', false);
					$('tr:first-child th:nth-child(2)').remove();
					$('td:nth-child(2)').each(function() {
						$(this).remove();
					});
					$('#question').fadeIn();
					//$('.yAns').css('display', 'none');
					
				});
			}
		});

		$('img.check-toggle').click(function(e){
			checkNull();

			if(nullAnswer == true) {
				e.preventDefault();
				window.location.hash = '';
				alert('<?php echo _("Please select your answers."); ?>');
				nullAnswer = false;
			} else {
				$('input:radio').attr('disabled', true);
				//$('.yAns').(css('display', 'block'));
				
				$('img.check-toggle').fadeOut(function() { $('img.next-toggle').fadeIn(); });
					$('table').fadeOut();
					$('h2').fadeOut();
					$('#title').fadeOut( function(){
						$('.yAns').fadeIn();
						$('#answer').fadeIn();
						checkAnswers();
						$('table').fadeIn();

						$("table tr:nth-child(1) th:nth-child(2)").before("<th><?php echo _('ANSWER'); ?></th>");
					});
			}
		});
	});

	function checkNull() {
		if(!$('#a1').is(':checked') && !$('#a2').is(':checked')) { nullAnswer = true; }
		if(!$('#b1').is(':checked') && !$('#b2').is(':checked')) { nullAnswer = true; }
		if(!$('#c1').is(':checked') && !$('#c2').is(':checked')) { nullAnswer = true; }
		if(!$('#d1').is(':checked') && !$('#d2').is(':checked')) { nullAnswer = true; }
		if(!$('#e1').is(':checked') && !$('#e2').is(':checked')) { nullAnswer = true; }
		if(!$('#f1').is(':checked') && !$('#f2').is(':checked')) { nullAnswer = true; }
	}

	function checkAnswers(){
		// A
		if($('#a1').is(':checked')) {
			$('table tr:nth-child(2) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon a"></td>');
			answer1 = "qualitative";
		} else if ($('#a2').is(':checked')) {
			$('table tr:nth-child(2) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon a"></td>');
			answer1 = "quantitative";
		}

		// B
		if($('#b1').is(':checked')) {
			$('table tr:nth-child(3) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon b"></td>');
			answer2 = "qualitative";
		} else if ($('#b2').is(':checked')) {
			$('table tr:nth-child(3) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon b"></td>');
			answer2 = "quantitative";
		}

		// C
		if($('#c1').is(':checked')) {
			$('table tr:nth-child(4) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon c"></td>');
			answer3 = "qualitative";
		} else if ($('#c2').is(':checked')) {
			$('table tr:nth-child(4) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon c"></td>');
			answer3 = "quantitative";
		}

		// D
		if($('#d1').is(':checked')) {
			$('table tr:nth-child(5) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon d"></td>');
			answer4 = "qualitative";
		} else if ($('#d2').is(':checked')) {
			$('table tr:nth-child(5) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon d"></td>');
			answer4 = "quantitative";
		}

		// E
		if($('#e1').is(':checked')) {
			$('table tr:nth-child(6) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon e"></td>');
			answer5 = "qualitative";
		} else if ($('#e2').is(':checked')) {
			$('table tr:nth-child(6) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon e"></td>');
			answer5 = "quantitative";
		}

		// F
		if($('#f1').is(':checked')) {
			$('table tr:nth-child(7) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon f"></td>');
			answer6 = "qualitative";
		} else if ($('#f2').is(':checked')) {
			$('table tr:nth-child(7) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon f"></td>');
			answer6 = "quantitative";
		}

		if(answered == 0) {
			saveAnswer('gathering-data-qq6-a', answer1);
			saveAnswer('gathering-data-qq6-b', answer2);
			saveAnswer('gathering-data-qq6-c', answer3);
			saveAnswer('gathering-data-qq6-d', answer4);
			saveAnswer('gathering-data-qq6-e', answer5);
			saveAnswer('gathering-data-qq6-f', answer6);
			answered = 1;
		}
	}
	</script>
	<script src="scripts/svgcheckbx.js"></script>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
