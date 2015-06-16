<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(9, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'gathering-data-qc3-a');
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
<script src="scripts/svgmodernizr.custom.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
.wrap { border-left: 1px dashed #d8e2a9; border-right: 1px dashed #d8e2a9; }
.bg { background: url('images/9/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
#answer p { text-align: center; }
#answer img { height: 30px;}
img.next-toggle { display: none; }
#left, #right { width:35%; float: left; }
#left { margin-left: 3%; }
#right {  }
#right li { font-size: 24px; }
.ac-custom label.r1::before { color: red; margin-top: -28px }
.ac-custom label::before { color: #F4938C; background: #4FCFC9; }
.ac-circle label::before { width: 20px; height: 20px; margin-top: -10px; left: 4px; }
.ac-circle svg { width: 35px; margin-top: -25px; left: 1px;color: #F4938C; }

.ac-custom input[type="radio"]:checked + label { color: #dd7c2d; }
.ac-custom svg path {stroke:orange;}
.item {
  border: 1px solid black;
  background-color: #ddddff;
  width: 100px;
  height: 100px;
}
.answer-item {padding-bottom:20px;}	
.question2 {margin-top:20px;}

html[dir="rtl"] .ac-custom label { padding: 0 40px 0 0; }
html[dir="rtl"] .ac-custom input[type="checkbox"], .ac-custom input[type="radio"], .ac-custom label::before { right: 0; }
html[dir="rtl"] .ac-custom svg { right: 8px; }
html[dir="rtl"] .ac-custom label.r1::before { margin-top: -15px; }
html[dir="rtl"] .ac-circle svg { right: -2px !important; }

<?php if($language == "zh_CN") { ?>
	.ac-custom label.r1::before { margin-top: -15px; }
<?php } ?>
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _('Quick Check #3'); ?></h1>
				<section>
					<form class="ac-custom ac-radio ac-swirl" autocomplete="off">
						<h2><?php echo _("Question A. Click on the statement about a hypothesis that is <span class='blink'>not</span> correct."); ?></h2>
						<ul id="choices1">
							<li><input id="r1" name="r1" type="radio"><label class="r1" for="r1"><?php echo _('A hypothesis is a possible explanation or solution to a scientific question or problem.'); ?></label></li>
							<li><input id="r2" name="r1" type="radio"><label for="r2"><?php echo _('Making observations and asking questions help lead to forming a hypothesis.'); ?></label></li>
							<li><input id="r3" name="r1" type="radio"><label for="r3"><?php echo _('All hypothesis are correct because of all the data one gathers.'); ?></label></li>
							<li><input id="r4" name="r1" type="radio"><label for="r4"><?php echo _('Experiments are conducted to see if a hypothesis is correct.'); ?></label></li>
						</ul>
					</form>
				</section>
				
				<section class="question2">
					<form class="ac-custom ac-radio ac-circle" autocomplete="off">
						<h2><?php echo _('Question B. What usually happens <span class="blink">before</span> formulating a hypothesis?'); ?></h2>
						<ul id="choices2">
							<li><input id="ra" name="r2" type="radio"><label for="ra"><?php echo _('Evidence is stated'); ?></label></li>
							<li><input id="rb" name="r2" type="radio"><label for="rb"><?php echo _('Conduct an experiment'); ?></label></li>
							<li><input id="rc" name="r2" type="radio"><label for="rc"><?php echo _('Make observations'); ?></label></li>
							<li><input id="rd" name="r2" type="radio"><label for="rd"><?php echo _('Solve a problem'); ?></label></li>
						</ul>
					</form>
				</section>
				
			</div>
			<div id="answer">
				<h1><?php echo _('Quick Check #3'); ?> - <?php echo _('How did I do?'); ?></h1>
				<div class="answer-item">
					<h2><?php echo _("Question A. Click on the statement about a hypothesis that is <span class='blink'>not</span> correct."); ?></h2>
					<p><?php echo _('You answered...'); ?></p>
					<p><span id="textanswer1"> </span></p>
					<p><img id="answer-icon1"> <span id="feedback1"> </span></p>
				</div>
				<div class="answer-item"> 
					<h2><?php echo _('Question B. What usually happens <span class="blink">before</span> formulating a hypothesis?'); ?></h2>
					<p><?php echo _('You answered...'); ?></p>
					<p><span id="textanswer2"> </span></p>
					<p><img id="answer-icon2"> <span id="feedback2"> </span></p>
				</div>
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _("Check Answer"); ?>"></a>
		<a href="10.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Students experimenting on laboratory...'); ?></strong></section></section>
	<script>

	var 
		nullAnswer = false,
		answer = $('#answer'),
		textanswer1 = $('#textanswer1'),
		textanswer2 = $('#textanswer2'),
		back = $('img.back-toggle'),
		next = $('img.next-toggle'),
		check = $('img.check-toggle'),
		question = $('#question'),
		feedback1 = $('#feedback1'),
		feedback2 = $('#feedback2'),
		answericon1 = $('#answer-icon1'),
		answericon2 = $('#answer-icon2'),
		answer1,
		answer2,
		answered = <?php echo $answered; ?>;
		
	$(document).ready(function() {
		
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "8.php#screen2";
			} else if ($('#answer').is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
				answer.fadeOut(function() {
					question.fadeIn();
					window.location.hash = '';
					feedback1.removeClass('red');
					feedback1.removeClass('green');
					feedback2.removeClass('red');
					feedback2.removeClass('green');
					answericon1.removeClass('img-align');
					answericon2.removeClass('img-align');
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
					save();
				});
			}
		});
	});
	
	function checkNull() {
		if(!$('#choices1 input:radio').is(':checked')) {
			nullAnswer = true;
		}
		if(!$('#choices2 input:radio').is(':checked')) {
			nullAnswer = true;
		}
	}
	
	function checkAnswers() {
		/* For checking of question A */
		if($('#r3').is(':checked')) {
			textanswer1.text("<?php echo _('All hypothesis are correct because of all the data one gathers.'); ?>");
			textstr = "<?php echo _('Correct! This statement is not true. Even though a lot of data may be gathered, it does not always mean a hypothesis is correct. Experiments can be conducted to test a hypothesis.'); ?>";
			answericon1.attr("src", "images/others/correct.png");
			feedback1.addClass('green');
			answer1 = "C";
		} else {
			if($('#r1').is(':checked')) {
			textanswer1.text("<?php echo _('A hypothesis is a possible explanation or solution to a scientific question or problem.'); ?>");
			textstr = "<?php echo _('Nope! This statement is correct. A hypothesis is a scientific guess as to what the answer to a question or problem might be.'); ?>";
				answer1 = "A";
			} else if ($('#r2').is(':checked')) {
				textanswer1.text("<?php echo _('Making observations and asking questions help lead to forming a hypothesis.'); ?>");
				textstr = "<?php echo _('Nope! This statement is correct. Data are gathered in many ways before a hypothesis is formed.'); ?>";
				answer1 = "B";
			} else if ($('#r4').is(':checked')) {
				textanswer1.text("<?php echo _('Experiments are conducted to see if a hypothesis is correct.'); ?>");
				textstr = "<?php echo _('Nope! This statement is correct. To check and see if a hypothesis is correct or not, scientists conduct experiments and gather a lot of data.'); ?>";
				answer1 = "D";
			}
			
			answericon1.attr("src", "images/others/wrong.png");
			answericon1.addClass('img-align');
			feedback1.addClass('red');
		}
		
		feedback1.text(textstr);
		/* End checking of question A */
		
		/* For checking of question B */
		if($('#rc').is(':checked')) {
			textanswer2.text("<?php echo _('Make observations'); ?>");
			textstr = "<?php echo _('Correct! Observations are made and questions are asked before making a hypothesis.'); ?>";
			answericon2.attr("src", "images/others/correct.png");
			feedback2.addClass('green');
			answer2 = "C";
		} else {
			if($('#ra').is(':checked')) {
			textanswer2.text("<?php echo _('Evidence is stated'); ?>");
			textstr = "<?php echo _('Nope! Evidence is the information scientists use to support their hypothesis after it is formed.'); ?>";
				answer2 = "A";
			} else if ($('#rb').is(':checked')) {
				textanswer2.text("<?php echo _('Conduct an experiment'); ?>");
				textstr = "<?php echo _('Nope! Experiments are conducted to test a hypothesis once it is formed.'); ?>";
				answer2 = "B";
			} else if ($('#rd').is(':checked')) {
				textanswer2.text("<?php echo _('Solve a problem'); ?>");
				textstr = "<?php echo _('Nope! Even after a hypothesis is formed the problem may not be solved.'); ?>";
				answer2 = "D";
			}
			
			answericon2.attr("src", "images/others/wrong.png");
			answericon2.addClass('img-align');
			feedback2.addClass('red');
		}
		
		feedback2.text(textstr);
		/* End checking of question B */
	}

	function save() {
		if(answered == 0) {
			saveAnswer('gathering-data-qc3-a', answer1);
			saveAnswer('gathering-data-qc3-b', answer2);
			answered = 1;
		}
	}
	</script>
	
	<script src="scripts/svgcheckbx.js"></script>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
