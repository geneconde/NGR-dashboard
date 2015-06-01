<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once 'locale.php';
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
.bg { background: url('images/17/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
img.next-toggle { display: none; }

.ac-custom label.r4::before { margin-top: -30px }
.ac-custom label::before { color: #F4938C; background: #FD974B; }
.ac-swirl svg { width: 35px; margin-top: -2px; left: 3px;color: #F4938C; }
.ac-swirl #r4 svg { margin-top: -280px  }
.ac-custom input[type="radio"]:checked + label { color: #FD974B; }

.pet { width: 48%; height: 300px; padding: 1.5% 0; display: block; margin: 0 auto; }
body #answer img.pet { height: 300px; }
.bg #answer #pet { height: 15%; padding: 1.5% 0; display: block; margin: 0 auto; }
table {width:50%;margin:0 auto 0;border: 0;
background: transparent;}
table tr td img {width:60px;height:auto !important;}
table, td {border:1px solid #4B939F;background: #DEF9FD;font-size:24px;text-align:center;color: #406468;}
#choices1 { margin: 20px 0 0; }
#tally { margin-top: 10px; }
.tallies {text-decoration: line-through;}
.ac-custom input[type="radio"]:checked + label {color: #8D3FB3;}
.petss {margin-top: 25px;
display: inline-block;
vertical-align: top;}
<?php if($language == "es_ES") { ?>
	h2 { font-size: 22px; }
	.ac-custom label { font-size: 20px; }
	.ac-swirl svg { margin-top: -6px; }
<?php } ?>

html[dir="rtl"] .ac-custom label { padding:0 40px 0 0; }
html[dir="rtl"] .ac-custom input[type="checkbox"], .ac-custom input[type="radio"], .ac-custom label::before { right: 0; }
html[dir="rtl"] .ac-swirl svg { right: 3px; }
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _('Quiz Question #2'); ?></h1>
				
				<section>
					<form class="ac-custom ac-radio ac-swirl" autocomplete="off">
						<h2><?php echo _('A fifth grade class gathered data by surveying the class to see which pets were the different students favorites. Based on the chart of their survey, which of the following statements is <span class="blink">not</span> correct?'); ?></h2>
						
						<ul id="choices1">
							
							<li><input id="r1" name="r1" type="radio"><label for="r1"><?php echo _('The data shows how many students like dogs.'); ?></label></li>
							<li><input id="r2" name="r1" type="radio"><label for="r2"><?php echo _('We can understand how many students like birds more than dogs.'); ?></label></li>
							<li><input id="r3" name="r1" type="radio"><label for="r3"><?php echo _('We can understand why students like birds more than dogs.'); ?></label></li>
							<li><input id="r4" name="r1" type="radio"><label class="r4" for="r4"><?php echo _('If all the students were required to choose a favorite animal, we can understand how many students were in the class from the data gathered here.'); ?></label></li>
						</ul>
						<!-- <img class="pet" src="images/17/pet.png" /> -->
					</form>
					<table id="tally">
						<!-- <tr><td colspan = "2">Favorite Pet</td></tr> -->
						<tr><td><?php echo _('Pet'); ?></td><td><?php echo _('Tallies'); ?></td></tr>
						<tr><td><img src="images/17/dog.jpg" alt="" /><span class="petss"><?php echo _('Dog'); ?></span></td><td><span class="tallies">IIII</span> - II</td></tr>
						<tr><td><img src="images/17/cat.jpg" alt="" /><span class="petss"><?php echo _('Cat'); ?></span></td><td>IIII</td></tr>
						<tr><td><img src="images/17/bird.jpg" alt="" /><span class="petss"><?php echo _('Bird'); ?></span></td><td><span class="tallies">IIII</span> - <span class="tallies">IIII</span></td></tr>
					</table>
				</section>
				
			</div>
			<div id="answer">
				<h1><?php echo _('Quiz Question #2'); ?> - <?php echo _('How did I do?'); ?></h1>
				<div class="answer-item">
					
					<p><?php echo _('You answered...'); ?></p>
					<p><span id="textanswer1"> </span></p>
					<p><img id="answer-icon1"> <span id="feedback1"> </span></p>
					<table id="tally">
						<tr><td><?php echo _('Pet'); ?></td><td><?php echo _('Tallies'); ?></td></tr>
						<tr><td><img src="images/17/dog.jpg" alt="" /><span class="petss"><?php echo _('Dog'); ?></span></td><td><span class="tallies">IIII</span> - II</td></tr>
						<tr><td><img src="images/17/cat.jpg" alt="" /><span class="petss"><?php echo _('Cat'); ?></span></td><td>IIII</td></tr>
						<tr><td><img src="images/17/bird.jpg" alt="" /><span class="petss"><?php echo _('Bird'); ?></span></td><td><span class="tallies">IIII</span> - <span class="tallies">IIII</span></td></tr>
					</table>
					<!-- <img class="pet" src="images/17/pet.png" > -->
				</div>
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#answer" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _("Check Answer"); ?>"></a>
		<a href="18.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Playing with pets...'); ?></strong></section></section>
	<script>
	var 
		nullAnswer = false,
		answer = $('#answer'),
		textanswer1 = $('#textanswer1'),
		back = $('img.back-toggle'),
		next = $('img.next-toggle'),
		check = $('img.check-toggle'),
		question = $('#question'),
		feedback1 = $('#feedback1'),
		answericon1 = $('#answer-icon1'),
		answered = 1;
		
	$(document).ready(function() {
		
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "16.php";
			} else if ($('#answer').is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
				answer.fadeOut(function() {
					question.fadeIn();
					window.location.hash = '';
					feedback1.removeClass('red');
					feedback1.removeClass('green');
					answericon1.removeClass('img-align');
				});
			}
		});
		
	
		check.click(function(e){
		
			checkNull();
		
			if(nullAnswer == true) {
				e.preventDefault();
				window.location.hash = '';
				alert("<?php echo _("Please select your answers."); ?>");
				nullAnswer = false;
			} else {
				check.fadeOut(function() { next.fadeIn(); });
				question.fadeOut(function(){
					answer.fadeIn();
					window.location.hash = '#answer';
					checkAnswers();
				});
			}
			$('#tally').css('margin-top', '10px');
		});
	});
	
	function checkNull() {
		if(!$('#choices1 input:radio').is(':checked')) {
			nullAnswer = true;
		}
	}
	
	function checkAnswers() {
		/* For checking of question A */
		if($('#r3').is(':checked')) {
			textanswer1.text("<?php echo _('We can understand why students like birds more than dogs.'); ?>");
			textstr = "<?php echo _('Correct. When we gather data it does not show why things happen.'); ?>";
			answericon1.attr("src", "images/others/correct.png");
			feedback1.addClass('green');
			answer1 = "C";
		} else {
			if($('#r1').is(':checked')) {
			textanswer1.text("<?php echo _('The data shows how many students like dogs.'); ?> ");
			textstr = "<?php echo _('Nope! This statement is correct. There are seven students who selected dogs as their favorite pets.'); ?>";
				answer1 = "A";
			} else if ($('#r2').is(':checked')) {
				textanswer1.text("<?php echo _('We can understand how many students like birds more than dogs.'); ?>");
				textstr = "<?php echo _('Nope! This statement is correct. 3 students prefer birds to dogs.'); ?>";
				answer1 = "B";
			} else if ($('#r4').is(':checked')) {
				textanswer1.text("<?php echo _('If all the students were required to choose a favorite animal, we can understand how many students were in the class from the data gathered here.'); ?>");
				textstr = "<?php echo _('Nope! This statement is correct. By adding 7, 4, and 10, the data can help us understand that there are 21 students in the class.'); ?>";
				answer1 = "D";
			}

			answericon1.attr("src", "images/others/wrong.png");
			answericon1.addClass('img-align');
			feedback1.addClass('red');
		}

		feedback1.text(textstr);

		if (answered == 0) {
			saveAnswer('gathering-data-qq2-a', answer1);
			answered = 1;
		}
		/* End checking of question A */
	}
	</script>
	<script src="scripts/svgcheckbx.js"></script>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
