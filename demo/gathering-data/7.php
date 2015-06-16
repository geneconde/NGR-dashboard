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
<link rel="stylesheet" type="text/css" href="styles/calculator.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/svgmodernizr.custom.js"></script>
<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js"></script>
<script src="scripts/save-answer.js"></script>
<style> 
.wrap { border-left: 1px dashed #d8e2a9; border-right: 1px dashed #d8e2a9; }
.bg { background: url('images/7/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#question section { margin-bottom: 10px; }
#answer { display: none; }
#answer p { text-align: center; }
#answer img { height: 30px;}
img.next-toggle { display: none; }
#left, #right { float: left; }
#left { width: 200px; }
#right { font-size: 18px; width: 360px; margin: 10px 0 0 0; }
#right li { font-size: 24px; }
.ac-custom label { font-size: 24px; }
.ac-custom label::before { color: #F4938C; background: #4FCFC9; }
.ac-custom input[type="checkbox"]:checked + label, .ac-custom input[type="radio"]:checked + label {color:#dd7c2d;}
#question section:last-child { margin-bottom: 0; }
table { width: 90%; margin: 0 auto; color: black; }
td { border: 3px solid #FD974B; padding: 0; background: rgba(253, 151, 75, .8); }
th {
	font-size: 20px;
	border: 3px solid #F4938C;
	background-color: #F4938C;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	padding: 0;
}
td:first-child { 
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-bottom: 5px;
	text-align: center;
}

td:last-child { 
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-bottom: 5px;
	text-align: center;
}
.answer-item {padding-bottom:20px;}		
#choices1 { margin: 5px 0 0; }
#choices2 { margin: 10px 0 0 0; }
#calculator {
	width: 246px;
	height: auto;
	margin: 10px 0;
	display:block;
	padding: 20px 20px 9px;
	background: #9dd2ea;
	background: linear-gradient(#9dd2ea, #8bceec);
	border-radius: 3px;
	box-shadow: 0px 4px #009de4, 0px 10px 15px rgba(0, 0, 0, 0.2);
}

.top span.clear { float: left; } 
.top .screen {
	height: 29px;
	width: 151px;
	
	float: right;
	
	padding: 0 10px;
	
	background: rgba(0, 0, 0, 0.2);
	border-radius: 3px;
	box-shadow: inset 0px 4px rgba(0, 0, 0, 0.2);
	
	font-size: 17px;
	line-height: 32px;
	color: white;
	text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
	text-align: right;
	letter-spacing: 1px;
}

.keys, .top {overflow: hidden;}

.keys span, .top span.clear {
	float: left;
	position: relative;
	top: 0;
	
	cursor: pointer;
	
	width: 46px;
	height: 26px;
	
	background: white;
	border-radius: 3px;
	box-shadow: 0px 4px rgba(0, 0, 0, 0.2);
	
	margin: 0 7px 11px 0;
	
	color: #888;
	line-height: 25px;
	text-align: center;
	
	user-select: none;
	
	transition: all 0.2s ease;
}

.keys span.operator {
	background: #FFF0F5;
	margin-right: 1px;
}

.keys span.eval {
	background: #f1ff92;
	box-shadow: 0px 4px #9da853;
	color: #888e5f;
}

.top span.clear {
	background: #ff9fa8;
	box-shadow: 0px 4px #ff7c87;
	color: white;
}

.keys span:hover {
	background: #9c89f6;
	box-shadow: 0px 4px #6b54d3;
	color: white;
}

.keys span.eval:hover {
	background: #abb850;
	box-shadow: 0px 4px #717a33;
	color: #ffffff;
}

.top span.clear:hover {
	background: #f68991;
	box-shadow: 0px 4px #d3545d;
	color: white;
}

.keys span:active {
	box-shadow: 0px 0px #6b54d3;
	top: 4px;
}

.keys span.eval:active {
	box-shadow: 0px 0px #717a33;
	top: 4px;
}

.top span.clear:active {
	top: 4px;
	box-shadow: 0px 0px #d3545d;
}
#graphDiv { display: none; position: absolute; background: rgba(45, 45, 45, .9); z-index: 1000;  width: 100%; height:100%;padding:50px;}
.pet { float:left;width: 135px;cursor:pointer; }
.cal-cont { display: block;margin: 10% auto;width: 250px; }
#close { background: white; color: #406468; display: block; margin: 0 auto; width: 65px; padding:10px; border-radius: 5px;margin-top:20px;}
#close:hover { cursor: pointer; }
h2, .ac-custom label { font-size: 22px; }
.ac-custom svg { top: 8px; }
#choices1 li:nth-child(2) svg, #choices1 li:nth-child(3) svg { top: 22px; }
.calculator { width: 200px; position: absolute; top: 30%; left: 40%; }  
.button { font-size: 18px; }

html[dir="rtl"] #choices1 li:nth-child(2) svg, html[dir="rtl"] #choices1 li:nth-child(3) svg { top:9px; }
html[dir="rtl"] .ac-custom label { padding: 0 40px 0 0; }
html[dir="rtl"] .ac-custom input[type="checkbox"], .ac-custom input[type="radio"], .ac-custom label::before { right: 0; }
html[dir="rtl"] .ac-custom svg { right: 8px; }
html[dir="rtl"] #left { float: right; }
html[dir="rtl"] #right { float: right; }
html[dir="rtl"] #left { width: 180px; margin-right: 145px; }
html[dir="rtl"] .pet { float: right; }

<?php if($language == "es_ES") {  ?>
	h2, .ac-custom label { font-size: 21px; }
<?php } ?>	
<?php if($language == "zh_CN") {  ?>
	#choices1 li:nth-child(2) svg, #choices1 li:nth-child(3) svg {top: 8px;}
<?php } ?>	
</style>

</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="graphDiv" >
				<div class="calculator demo">
			        <div class="u4 display">
			            <div class="display-inner"><div class="display-text" data-bind="text: display"></div></div>
			        </div>
			        <button id="calculator-button-c" class="u1 button button-red" data-bind="click: clear">c</button>
			        <button id="calculator-button-backspace" class="u1 button button-backspace button-gray" data-bind="click: backspace">&#x21e4;</button>
			        <button id="calculator-button-negate" class="u1 button button-gray" data-bind="click: negate">&#xb1;</button>
			        <button id="calculator-button-÷" class="u1 button button-gray" data-bind="click: operator">÷</button>
			        <button id="calculator-button-7" class="u1 button button-gray" data-bind="click: number">7</button>
			        <button id="calculator-button-8" class="u1 button button-gray" data-bind="click: number">8</button>
			        <button id="calculator-button-9" class="u1 button button-gray" data-bind="click: number">9</button>
			        <button id="calculator-button-x" class="u1 button button-gray" data-bind="click: operator">x</button>
			        <button id="calculator-button-4" class="u1 button button-gray" data-bind="click: number">4</button>
			        <button id="calculator-button-5" class="u1 button button-gray" data-bind="click: number">5</button>
			        <button id="calculator-button-6" class="u1 button button-gray" data-bind="click: number">6</button>
			        <button id="calculator-button--" class="u1 button button-gray" data-bind="click: operator">-</button>
			        <button id="calculator-button-1" class="u1 button button-gray" data-bind="click: number">1</button>
			        <button id="calculator-button-2" class="u1 button button-gray" data-bind="click: number">2</button>
			        <button id="calculator-button-3" class="u1 button button-gray" data-bind="click: number">3</button>
			        <button id="calculator-button-+" class="u1 button button-gray" data-bind="click: operator">+</button>
			        <button id="calculator-button-0" class="u2 button button-gray" data-bind="click: number">0</button>
			        <button id="calculator-button-." class="u1 button button-gray" data-bind="click: number">.</button>
			        <button id="calculator-button-=" class="u1 button button-blue" data-bind="click: operator">=</button>            
			    </div>
			    <span id="close"><?php echo _('Close me!'); ?></span>
			</div>
			<div id="question">
				<h1><?php echo _("Quick Check #2"); ?></h1>
				
				<section>
					<form class="ac-custom ac-radio ac-fill" autocomplete="off">
						<h2><?php echo _("Question A. On a scale in the fruit section of a grocery store, a shopper weighed out 3 pounds of apples that were selling for $1 per pound. But when the shopper got to the checkout lane, the cashier weighed the apples again and instead of paying $3 for the apples, the shopper paid only $2.90. Why did the shopper most likely not have to pay $3 for the apples?"); ?></h2>
						<ul id="choices1">
							<li><input id="r1" name="r1" type="radio"><label for="r1"><?php echo _("There was a discount the shopper was not aware of."); ?></label></li>
							<li><input id="r2" name="r1" type="radio"><label for="r2"><?php echo _("The scale in the fruit section of the grocery store showed more than the accurate weight of the apples."); ?></label></li>
							<li><input id="r3" name="r1" type="radio"><label for="r3"><?php echo _("The scale in the fruit section of the grocery store showed less than the accurate weight of the apples."); ?></label></li>
							<li><input id="r4" name="r1" type="radio"><label for="r4"><?php echo _("The cashier just estimated the weight to be less."); ?></label></li>
						</ul>
					</form>
					
					<div class="clear"></div>
				</section>
				
				<section>
					<form class="ac-custom ac-radio ac-swirl" autocomplete="off">
						<h2><?php echo _("Question B. Based on the data gathered of the performances of five mice shown below, what is the average time for a mouse to finish the maze? Click on the calculator below to do your calculations."); ?></h2>
						<div id="left">
							<ul id="choices2">
								<li><input id="ra" name="r2" type="radio"><label for="ra"><?php echo _("205 seconds"); ?></label></li>
								<li><input id="rb" name="r2" type="radio"><label for="rb"><?php echo _("45 seconds"); ?></label></li>
								<li><input id="rc" name="r2" type="radio"><label for="rc"><?php echo _("41 seconds"); ?></label></li>
								<li><input id="rd" name="r2" type="radio"><label for="rd"><?php echo _("32 seconds"); ?></label></li>
							</ul>
						</div>	
						<div id="right">
							<table>
								<tr><th><?php echo _("Mouse"); ?></th><th><?php echo _("Time"); ?></th></tr>
								<tr><td><?php echo _("Mouse"); ?> 1</td><td><?php echo _("took 53 seconds"); ?></td></tr>
								<tr><td><?php echo _("Mouse"); ?> 2</td><td><?php echo _("took 32 seconds"); ?></td></tr>
								<tr><td><?php echo _("Mouse"); ?> 3</td><td><?php echo _("took 34 seconds"); ?></td></tr>
								<tr><td><?php echo _("Mouse"); ?> 4</td><td><?php echo _("took 30 seconds"); ?></td></tr>
								<tr><td><?php echo _("Mouse"); ?> 5</td><td><?php echo _("took 56 seconds"); ?></td></tr>				
							</table>
						</div>
					</form>
					<img src="images/7/calculator.png" class="pet" >
				</section>
				
			</div>
			<div id="answer">
				<h1><?php echo _("Quick Check #2"); ?> - <?php echo _("How did I do?"); ?></h1>
				<div class="answer-item">
					<h2><?php echo _("Question A. On a scale in the fruit section of a grocery store, a shopper weighed out 3 pounds of apples that were selling for $1 per pound. But when the shopper got to the checkout lane, the cashier weighed the apples again and instead of paying $3 for the apples, the shopper paid only $2.90. Why did the shopper most likely not have to pay $3 for the apples?"); ?></h2>
					<p><?php echo _("You answered..."); ?></p>
					<p><span id="textanswer1"> </span></p>
					<p><img id="answer-icon1"> <span id="feedback1"> </span></p>
				</div>
				<div class="answer-item"> 
					<h2><?php echo _("Question B. Based on the data gathered of the performances of five mice shown below, what is the average time for a mouse to finish the maze? Click on the calculator below to do your calculations."); ?></h2>
					<p><?php echo _("You answered..."); ?></p>
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
		<a href="8.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _('Scaling 3 red apples...'); ?></strong></section></section>
	<?php include("setlocale.php"); ?>	

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
		answered = 1;
		
	$(document).ready(function() {
		
		$('img.pet').click(function() {
			$('#graphDiv').fadeIn();
		});
		$('#close').click(function() {
			$('#graphDiv').fadeOut();
		});

		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "6.php#screen3";
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
		if($('#r2').is(':checked')) {
			textanswer1.text("<?php echo _('The scale in the fruit section of the grocery store showed more than the accurate weight of the apples.'); ?>");
			textstr = "<?php echo _("The scale at the grocery store fruit section wasn't accurate. It read 3 lbs. But the scale at the grocery checkout lane was more accurate and the vegetables actually weighed 2.9 lbs."); ?>";
			answericon1.attr("src", "images/others/correct.png");
			feedback1.addClass('green');
			answer1 = "B";
		} else {
			if($('#r1').is(':checked')) {
			textanswer1.text("<?php echo _('There was a discount the shopper was not aware of.'); ?>");
			textstr = " <?php echo _('Probably not. The scale the customer used to weigh the apples was probably not accurate.'); ?> ";
				answer1 = "A";
			} else if ($('#r3').is(':checked')) {
				textanswer1.text("<?php echo _('The scale in the fruit section of the grocery store showed less than the accurate weight of the apples.'); ?>");
				textstr = "<?php echo _('Nope! The first scale actually showed more than what was actually weighed.'); ?>";
				answer1 = "C";
			} else if ($('#r4').is(':checked')) {
				textanswer1.text("<?php echo _('The cashier just estimated the weight to be less.'); ?>");
				textstr = "<?php echo _('Probably not. Estimates are not used in stores where items are sold by weight.'); ?>";
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
			textanswer2.text("<?php echo _('41 seconds'); ?>");
			textstr = "<?php echo _('You got it! If you add the 5 times and divide by 5, the answer is 41 seconds.'); ?>";
			answericon2.attr("src", "images/others/correct.png");
			feedback2.addClass('green');
			answer2 = "C";
		} else {
			if($('#ra').is(':checked')) {
			textanswer2.text("<?php echo _('205 seconds'); ?>");
			textstr = "<?php echo _('Nope! 205 seconds is the total of all the times combined, not an average.'); ?>";
				answer2 = "A";
			} else if ($('#rb').is(':checked')) {
				textanswer2.text("<?php echo _('45 seconds'); ?>");
				textstr = "<?php echo _('No, but close. Check your calculations again.'); ?>";
				answer2 = "B";
			} else if ($('#rd').is(':checked')) {
				textanswer2.text("<?php echo _('32 seconds'); ?>");
				textstr = "<?php echo _('Nope! The average is somewhere between the highest and lowest time.'); ?>";
				answer2 = "D";
			}

			answericon2.attr("src", "images/others/wrong.png");
			answericon2.addClass('img-align');
			feedback2.addClass('red');
		}
		
		feedback2.text(textstr);
		/* End checking of question B */
	}

	function save(){
		if(answered == 0) {
			saveAnswer('gathering-data-qc2-a', answer1);
			saveAnswer('gathering-data-qc2-b', answer2);
			answered = 1;
		}
	}
	</script>
	<script src="scripts/knockout-2.1.0.js"></script>
	<script src="scripts/calculator.js"></script>
	<script src="scripts/svgcheckbx.js"></script>
	<script src="scripts/jpreloader.js"></script>
</body>
</html>
