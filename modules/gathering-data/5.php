<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(5, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'gathering-data-qc1-a');
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
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
.wrap { border-left: 1px dashed #d8e2a9; border-right: 1px dashed #d8e2a9; }
.bg { background: url('images/5/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
img.next-toggle { display: none; }
h2 { margin: 0; }
.ac-custom input[type="checkbox"], .ac-custom input[type="radio"], .ac-custom label::before {cursor: pointer;}
table { width: 75%; margin: 0 auto; color: black; }
td { border: 3px solid #FD974B; padding: 0; background: rgba(253, 151, 75, .8); }
td:not(:first-child) { text-align: center; padding: 0; }
td span { text-align: left; margin-left: 15px; text-decoration: none; font-size: 22px; line-height: 22px; }
th:not(:first-child) {
	width: 120px;
	font-size: 22px;
	border: 3px solid #F4938C;
	background-color: #F4938C;
	-webkit-border-top-left-radius: 10px;
	-webkit-border-top-right-radius: 10px;
	-moz-border-radius-topleft: 10px;
	-moz-border-radius-topright: 10px;
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
	padding: 0;
}

td:first-child { 
	-webkit-border-top-left-radius: 10px;
	-webkit-border-bottom-left-radius: 10px;
	-moz-border-radius-topleft: 10px;
	-moz-border-radius-bottomleft: 10px;
	border-top-left-radius: 10px;
	border-bottom-left-radius: 10px;
	width:590px;
}

td:last-child { 
	-webkit-border-top-right-radius: 10px;
	-webkit-border-bottom-right-radius: 10px;
	-moz-border-radius-topright: 10px;
	-moz-border-radius-bottomright: 10px;
	border-top-right-radius: 10px;
	border-bottom-right-radius: 10px;
}

.ac-custom label { }
.ac-custom ul { padding: 0; margin: 2px 0; }
.ac-custom li { margin: 0; padding: 0; list-style-type: none; }
.ac-custom input[type="checkbox"], .ac-custom input[type="radio"], .ac-custom label::before { height: 25px; width: 25px; }
.ac-custom svg { top: 59% !important; left: 27% !important; height: 25px; width: 25px; }
.ac-custom label {}
.ac-custom { padding: 0; } 

table img { width: 25px; }
.ac-radio input{border:0 !important;}
input {outline: none;}
html[dir="rtl"] td { border-radius: 5px; }
<?php if($language == "es_ES") { ?>
	table { width: 90% !important; }
<?php } ?>
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1 id="title"><?php echo _("Quick Check #1"); ?></h1>
				<h1 id="answer"><?php echo _("Quick Check #1"); ?> - <?php echo _("How did I do?"); ?></h1>
				<h2><?php echo _("Below is a list of data of an oil painting. What kind of data (quantitative or qualitative) does each of the following represent?"); ?></h2>
				<table>
					<tr>
						<th> </th>
						<th><?php echo _("Qualitative Data"); ?></th>
						<th><?php echo _("Quantitative Data"); ?></th>
					</tr>
					<tr>
						<td><span><?php echo _("Weighs 8.5 pounds"); ?></span></td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="a1" name="r1" type="radio"><label for="a1" class="css-label"></li>
								</ul>
							</section>
						</td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="a2" name="r1" type="radio"><label for="a2" class="css-label"></li>
								</ul>
							</section>
						</td>
					</tr>
					<tr>
						<td><span><?php echo _("Blue/green color, gold frame"); ?></span></td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="b1" name="r2" type="radio"><label for="b1" class="css-label"></li>
								</ul>
							</section>
						</td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="b2" name="r2" type="radio"><label for="b2" class="css-label"></li>
								</ul>
							</section>
						</td>
					</tr>
					<tr>
						<td><span><?php echo _("Picture is 25 x 36 cm"); ?></span></td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="c1" name="r3" type="radio"><label for="c1" class="css-label"></li>
								</ul>
							</section>
						</td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="c2" name="r3" type="radio"><label for="c2" class="css-label"></li>
								</ul>
							</section>
						</td>
					</tr>
					<tr>
						<td><span><?php echo _("Smells old and musty"); ?></span></td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="d1" name="r4" type="radio"><label for="d1" class="css-label"></li>
								</ul>
							</section>
						</td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="d2" name="r4" type="radio"><label for="d2" class="css-label"></li>
								</ul>
							</section>
						</td>
					</tr>
					<tr>
						<td><span><?php echo _("Texture shows brush strokes of oil paint"); ?></span></td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="e1" name="r5" type="radio"><label for="e1" class="css-label"></li>
								</ul>
							</section>
						</td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="e2" name="r5" type="radio"><label for="e2" class="css-label"></li>
								</ul>
							</section>
						</td>
					</tr>
					<tr>
						<td><span><?php echo _("Masterful brush strokes"); ?></span></td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="f1" name="r6" type="radio"><label for="f1" class="css-label"></li>
								</ul>
							</section>
						</td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="f2" name="r6" type="radio"><label for="f2" class="css-label"></li>
								</ul>
							</section>
						</td>
					</tr>
					<tr>
						<td><span><?php echo _("With frame is 36 x 45 cm"); ?></span></td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="g1" name="r7" type="radio"><label for="g1" class="css-label"></li>
								</ul>
							</section>
						</td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="g2" name="r7" type="radio"><label for="g2" class="css-label"></li>
								</ul>
							</section>
						</td>
					</tr>
					<tr>
						<td><span><?php echo _("Surface area of painting is 140 sq. in."); ?></span></td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="h1" name="r8" type="radio"><label for="h1" class="css-label"></li>
								</ul>
							</section>
						</td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="h2" name="r8" type="radio"><label for="h2" class="css-label"></li>
								</ul>
							</section>
						</td>
					</tr>
					<tr>
						<td><span><?php echo _("Cost $300"); ?></span></td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="i1" name="r9" type="radio"><label for="i1" class="css-label"></li>
								</ul>
							</section>
						</td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="i2" name="r9" type="radio"><label for="i2" class="css-label"></li>
								</ul>
							</section>
						</td>
					</tr>
					<tr>
						<td><span><?php echo _("Peaceful scene of the country"); ?></span></td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="j1" name="r10" type="radio"><label for="j1" class="css-label"></li>
								</ul>
							</section>
						</td>
						<td>
							<section class="ac-custom ac-radio ac-fill" autocomplete="off">
								<ul>
									<li><input id="j2" name="r10" type="radio"><label for="j2" class="css-label"></li>
								</ul>
							</section>
						</td>
					</tr>
					
				</table>
			</div>
				
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _("Check Answer"); ?>"></a>
		<a href="6.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Preparing your first quick check..."); ?></strong></section></section>
	<script>
	
	var nullAnswer = false;
	var answer1, answer2, answer3, answer4, answer5, answer6, answer7, answer8, answer9, answer10;
	var answered = <?php echo $answered; ?>;
	
	$(document).ready(function() {
		$('img.back-toggle').click(function() {
			if($('#title').is(':visible')) {
				document.location.href = "4.php#screen2"; // change to the previous page's last screen e.g. 4.html#screen2
			} else if ($('#answer').is(':visible')) {
				$('img.next-toggle').fadeOut(function() { $('img.check-toggle').fadeIn(); });
				$('#answer').fadeOut(function() {
					$('#title').fadeIn();
					$('input:radio').attr('disabled', false);
					$('table').css('width', '75%');
					$('tr:first-child th:nth-child(2)').remove();
					$('td:nth-child(2)').each(function() {
						$(this).remove();
					});
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
				$('img.check-toggle').fadeOut(function() { $('img.next-toggle').fadeIn(); });
					$('table').fadeOut();
					$('#title').fadeOut( function(){
						$('#answer').fadeIn();
						checkAnswers();
						$('table').fadeIn();
						$('table').css('width', '86%');
						$("table tr:nth-child(1) th:nth-child(2)").before("<th><?php echo _('ANSWER'); ?></th>");
					});
			}
		});
		
		function checkNull() {
			if(!$('#a1').is(':checked') && !$('#a2').is(':checked')) { nullAnswer = true; }
			if(!$('#b1').is(':checked') && !$('#b2').is(':checked')) { nullAnswer = true; }
			if(!$('#c1').is(':checked') && !$('#c2').is(':checked')) { nullAnswer = true; }
			if(!$('#d1').is(':checked') && !$('#d2').is(':checked')) { nullAnswer = true; }
			if(!$('#e1').is(':checked') && !$('#e2').is(':checked')) { nullAnswer = true; }
			if(!$('#f1').is(':checked') && !$('#f2').is(':checked')) { nullAnswer = true; }
			if(!$('#g1').is(':checked') && !$('#g2').is(':checked')) { nullAnswer = true; }
			if(!$('#h1').is(':checked') && !$('#h2').is(':checked')) { nullAnswer = true; }
			if(!$('#i1').is(':checked') && !$('#i2').is(':checked')) { nullAnswer = true; }
			if(!$('#j1').is(':checked') && !$('#j2').is(':checked')) { nullAnswer = true; }
		}
		
		function checkAnswers(){
			
			// A
			if($('#a1').is(':checked')) {
				$('table tr:nth-child(2) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon"></td>');
				answer1 = "qualitative";
			} else if ($('#a2').is(':checked')) {
				$('table tr:nth-child(2) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon"></td>');
				answer1 = "quantitative"
			}
			
			// B
			if($('#b1').is(':checked')) {
				$('table tr:nth-child(3) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon"></td>');
				answer2 = "qualitative";
			} else if ($('#b2').is(':checked')) {
				$('table tr:nth-child(3) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon"></td>');
				answer2 = "quantitative";
			}
			
			// C
			if($('#c1').is(':checked')) {
				$('table tr:nth-child(4) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon"></td>');
				answer3 = "qualitative";
			} else if ($('#c2').is(':checked')) {
				$('table tr:nth-child(4) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon"></td>');
				answer3 = "quantitative";
			}
			
			// D
			if($('#d1').is(':checked')) {
				$('table tr:nth-child(5) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon"></td>');
				answer4 = "qualitative";
			} else if ($('#d2').is(':checked')) {
				$('table tr:nth-child(5) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon"></td>');
				answer4 = "quantitative";
			}
			
			// E
			if($('#e1').is(':checked')) {
				$('table tr:nth-child(6) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon"></td>');
				answer5 = "qualitative";
			} else if ($('#e2').is(':checked')) {
				$('table tr:nth-child(6) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon"></td>');
				answer5 = "quantitative";
			}
			
			// F
			if($('#f1').is(':checked')) {
				$('table tr:nth-child(7) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon"></td>');
				answer6 = "qualitative";
			} else if ($('#f2').is(':checked')) {
				$('table tr:nth-child(7) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon"></td>');
				answer6 = "quantitative";
			}
			
			// G
			if($('#g1').is(':checked')) {
				$('table tr:nth-child(8) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon"></td>');
				answer7 = "qualitative";
			} else if ($('#g2').is(':checked')) {
				$('table tr:nth-child(8) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon"></td>');
				answer7 = "quantitative";
			}
			
			// H
			if($('#h1').is(':checked')) {
				$('table tr:nth-child(9) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon"></td>');
				answer8 = "qualitative";
			} else if ($('#h2').is(':checked')) {
				$('table tr:nth-child(9) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon"></td>');
				answer8 = "quantitative";
			}
			
			// I
			if($('#i1').is(':checked')) {
				$('table tr:nth-child(10) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon"></td>');
				answer9 = "qualitative";
			} else if ($('#i2').is(':checked')) {
				$('table tr:nth-child(10) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon"></td>');
				answer9 = "quantitative"
			}
			
			// J
			if($('#j1').is(':checked')) {
				$('table tr:nth-child(11) td:nth-child(2)').before('<td><img src="images/others/correct.png" class="answer-icon"></td>');
				answer10 = "qualitative";
			} else if ($('#j2').is(':checked')) {
				$('table tr:nth-child(11) td:nth-child(2)').before('<td><img src="images/others/wrong.png" class="answer-icon"></td>');
				answer10 = "quantitative";
			}

			if(answered == 0) {
				saveAnswer('gathering-data-qc1-a', answer1);
				saveAnswer('gathering-data-qc1-b', answer2);
				saveAnswer('gathering-data-qc1-c', answer3);
				saveAnswer('gathering-data-qc1-d', answer4);
				saveAnswer('gathering-data-qc1-e', answer5);
				saveAnswer('gathering-data-qc1-f', answer6);
				saveAnswer('gathering-data-qc1-g', answer7);
				saveAnswer('gathering-data-qc1-h', answer8);
				saveAnswer('gathering-data-qc1-i', answer9);
				saveAnswer('gathering-data-qc1-j', answer10);
				answered = 1;
			} // end save to db
		}
	});
	</script>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
