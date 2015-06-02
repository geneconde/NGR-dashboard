<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once 'locale.php';
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Solar Power"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/svgcomponent.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" href="styles/font-awesome.min.css">

<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
	html, body {overflow: hidden;} 
	.wrap { overflow: hidden; }

h1 {margin-left: 1%; margin-right: 1%; padding-top: 10px;}
h2	{ padding-bottom:0px; margin-top:  -10px}

.bg { background: url('images/16/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
#answer-icon { display: inline-block; height: 30px; margin-right: 10px; }
#question .placeholder, #answer .placeholder { /* background: rgba(255,255,255,0.5); */border-radius: 10px;padding: 10px 10px 1px 10px;}
/* img.next-toggle { display: none; } */
#buttons .next { display: none; }
#answer p { text-align: center; }

#choices1 { list-style: none; text-align: left; margin: 0; }
#choices1 li { margin: 8px 0px; }
#choices1 input[type="checkbox"] { display: none; }
#choices1 label { display: block; cursor: pointer; }
#choices1 input[type="checkbox"] + label img { border: 4px solid transparent; -webkit-transition: all .3s ease; vertical-align: middle; }
#choices1 input[type="checkbox"]:checked + label img { border: 4px solid #FFF46F; -webkit-transition: all .3s ease; -webkit-backface-visibility: hidden; }
#choices1 input[type="checkbox"] + label span { color: #000; -webkit-transition: all .3s ease; }
#choices1 input[type="checkbox"]:checked + label span { color: #947600; -webkit-transition: all .3s ease; }
#choices1 img { width: 100px; height: 90px;}
#choices1 label { font-size: 24px; }

#selected_answer { height: 170px; margin: 0 auto; width: 98%; margin-top: 5px; }
#selected_answer img { height: 160px; margin-right: 5px; width: 157px; }
html[dir="rtl"] #choices1 label { text-align: right; } 

	<?php if($language == "ar_EG") { ?>
	 .lang-menu ul {margin-right: -9999px !important} 
	.lang-menu ul {left: 9999px }
	<?php } ?>

@media only screen and (max-width: 1250px) { #choices1 input[type="checkbox"] + label span {font-size: 18px !important; width: 100%;}
	#choices1 img {width:14%;height:90px; }
	p {font-size: 20px !important;}
	#choices1, #choices1 li {width: 100%;} #choices1 label {width: 97%;} 
	#selected_answer img {  height: 100%;   width: 19%;} #selected_answer {height: 100%} #choices1 li {  margin: 5px 0px;}
}
@media only screen and (max-width: 768px) { 
	#choices1 img {height: 100%;}
}
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	#selected_answer img {height:130px; width:130px; margin-top: 20px;}
} 
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #1"); ?></h1>
				<div class="placeholder">
					<h2><?php echo _("Click on <span class='red blink'>all</span> the following statements that are <span class='red blink'>true</span>."); ?></h2>
					<ul id="choices1">
						<li id="a">
							<input id="a1" name="c1" type="checkbox" value="A">
							<label for="a1">
								<img src="images/16/a.jpg">
								<span><?php echo _("The Sun warms the Earth on both clear and cloudy days."); ?></span>
							</label>
						</li>
						<li id="b">
							<input id="a2" name="c1" type="checkbox" value="B">
							<label for="a2">
								<img src="images/16/b.jpg">
								<span><?php echo _("The Sun is a huge ball of burning solids and gases."); ?></span>
							</label>
						</li>
						<li id="c">
							<input id="a3" name="c1" type="checkbox" value="C">
							<label for="a3">
								<img src="images/16/c.jpg">
								<span><?php echo _("The Sun radiates energy in all directions."); ?></span>
							</label>
						</li>
						<li id="d">
							<input id="a4" name="c1" type="checkbox" value="D">
							<label for="a4">
								<img src="images/16/d.jpg">
								<span><?php echo _("The Sun strikes the earth the same in all seasons."); ?></span>
							</label>
						</li>
						<li id="e">
							<input id="a5" name="c1" type="checkbox" value="E">
							<label for="a5">
								<img src="images/16/e.jpg">
								<span><?php echo _("The Sun affects our weather and water cycle."); ?></span>
							</label>
						</li>
					</ul>
				</div>
			</div>
			<div id="answer">
				<h1><?php echo _("Quiz Question #1"); ?> - <?php echo _("How did I do?"); ?></h1>
				<div class="placeholder">
					<p><?php echo _("You answered..."); ?></p>
					<div id="selected_answer"></div>
					<div class="clear"></div>
					<p><img id="answer-icon"><span id="feedback"></span></p>
				</div>
			</div>
		</div>
	</div>
<!--
	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _('Check Answer'); ?>"></a>
		<a href="17.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="17.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Your first quiz question is..."); ?></strong></section></section>
	<script>
	var answer1,
		answered = 1,
		textstr = "",
		selected_answer = $('#selected_answer'),
		nullAnswer = false,
		back = $('a.back-toggle'),
		next = $('a.next-toggle'),
		check = $('a.check-toggle'),
		question = $('#question'),
		answer = $('#answer'),
		textanswer = $('#textanswer'),
		feedback = $('#feedback'),
		answericon = $('#answer-icon');
		
	$(document).ready(function() {
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "15.php";
			} else if (answer.is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
				answer.fadeOut(function() {
					question.fadeIn();
					window.location.hash = '';
					feedback.removeClass('red');
					feedback.removeClass('green');
					answericon.removeClass('img-align');
					selected_answer.empty();
				});
			}
		});
		
		check.click(function(e){
			checkNull();
			console.log(nullAnswer);
			if(nullAnswer == true) {
				e.preventDefault();
				window.location.hash = '';
				alert("<?php echo _('Please select your answers.'); ?>");
				nullAnswer = false;
			} else {
				check.fadeOut(function() { next.fadeIn(); });
				question.fadeOut(function(){ 
					answer.fadeIn();
					window.location.hash = '#answer';
					var ctr = 0;
					
					/* For checking */
					var answer1 = "";
					if($('#a1').is(":checked")) { 
						answer1 = "A";
						selected_answer.append('<img src="images/16/a.jpg">');
						ctr++;
					}
					if($('#a2').is(":checked")) { 
						answer1 += "B";
						selected_answer.append('<img src="images/16/b.jpg">');
						ctr++;
					}
					if($('#a3').is(":checked")) { 
						answer1 += "C";
						selected_answer.append('<img src="images/16/c.jpg">');
						ctr++;
					}
					if($('#a4').is(":checked")) { 
						answer1 += "D";
						selected_answer.append('<img src="images/16/d.jpg">');
						ctr++;
					}
					if($('#a5').is(":checked")) { 
						answer1 += "E";
						selected_answer.append('<img src="images/16/e.jpg">');
						ctr++;
					}
					
					if(ctr == 1) selected_answer.css('width','19%');
					else if(ctr == 2) selected_answer.css('width','42%');
					else if(ctr == 3) selected_answer.css('width','62%');
					else if(ctr == 4) selected_answer.css('width','82%');
					else if(ctr == 5) selected_answer.css('width','98%');
					
					if($('#a1').is(':checked') && !$('#a2').is(':checked') && $('#a3').is(':checked') && !$('#a4').is(':checked') && $('#a5').is(':checked')) {
						textstr = "<?php echo _('Correct! The sun warms the earth no matter what the weather may be. The Sun radiates energy equally in all directions. It plays a very important role in the water cycle and our weather.'); ?>";
						answericon.attr("src", "images/others/correct.png");
						feedback.addClass('green');
					} else if(answer1=='B'){
						textstr = "<?php echo _('Nope! The sun is a large ball of superheated gas called plasma - not solid - its energy is released when hydrogen atoms are joined or fused together.'); ?>";
						answericon.attr("src", "images/others/wrong.png");
						answericon.addClass('img-align');
						feedback.addClass('red');
					} else {
						/*textstr = "Nope! The sun is ball of burning gases, not solids. The sun does affect the change of seasons. The sun warms the earth no matter what the weather may be. The Sun radiates energy equally in all directions. It plays a very important role in the water cycle and our weather.";*/
						textstr = "<?php echo _('Not quite. The sun warms the earth no matter what the weather may be, the sun radiates energy in all directions, and the sun plays a very important role in the water cycle and our weather. But the sun is not like a burning fire—its energy is released when hydrogen atoms are joined or fused together and the sun does not strike all places on the earth at the same angle at all times of the year because the earth is tilted on its axis as it orbits the sun.'); ?>";
						answericon.attr("src", "images/others/wrong.png");
						answericon.addClass('img-align');
						feedback.addClass('red');
					}
					feedback.text(textstr);
					/* End Checking */
					
					if(answered == 0) {
						saveAnswer('solar-power-qq1-a', answer1);
						answered = 1;
					} // end saving to db
					
				}); // end question fade
			} // end else
		}); // end check
	}); // end doc ready
	
	function checkNull() {
		if(!$('input:checkbox').is(':checked')) {
		$('#question').append($('#q_answer')).find('input[type="checkbox"]').prop("disabled", false);
			nullAnswer = true;
		}
	}
	</script>
	<script src="scripts/svgcheckbx.js"></script>
	<?php include("setlocale.php"); ?>
</body>
</html>
