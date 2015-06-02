<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(20, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'gathering-data-qq5-a');
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
	<script type="text/javascript" src="https://www.google.com/jsapi"></script> <!-- Google Charts -->
	<script src="scripts/svgmodernizr.custom.js"></script>
	<style>
		.wrap { border-left: 1px dashed #d8e2a9; border-right: 1px dashed #d8e2a9; }
		.bg { background: url('images/18/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
		#answer { display: none; }
		img.next-toggle { display: none; }
		body #answer .answerImg {height:auto !important;}
		#question ul { width: 100%; margin: 0 auto; padding: 0; list-style-type: none;margin-top:10px; }
		#question li { float: left;margin-bottom:10px;height:290px;width:250px; }
		#choices1 { margin-top: 2%; }
		#choices1 label { text-align: center; cursor: pointer; padding-top:10px; }
		#choices1 input[type="radio"] + label img { border: 4px solid transparent; -webkit-transition: all .3s ease; }
		#choices1 input[type="radio"] + label span { color: #000; -webkit-transition: all .3s ease; }
		#choices1 input[type="radio"]:checked + label span { color: #0C83F4; -webkit-transition: all .3s ease; }
		#question img { width: 75%; }
		#question label { font-size: 24px; }
		body img#imganswer { width: 30%; height: 180px; margin: 0 auto; display: block; }
		#choices1 > li:nth-child(2) {margin-right: 20px;margin-left: 20px;}
		#box { width: 90%; margin: 40px auto 0; }
		#box .info { width: 600px; float: right; padding: 20px 0; }
	#feedback div {float:left;}
	#chart_divA > div:nth-child(1) > div > svg > g:nth-child(4),
	#chart_divB > div:nth-child(1) > div > svg > g:nth-child(4),
	#chart_divC > div:nth-child(1) > div > svg > g:nth-child(4),
	#chart_divD > div:nth-child(1) > div > svg > g:nth-child(4),
	#chart_divE > div:nth-child(1) > div > svg > g:nth-child(4),
	#chart_divF > div:nth-child(1) > div > svg > g:nth-child(4) {
		display: none;
	}
	table { width: 75%; margin: 20px auto; color: black; }
	td { border: 3px solid #FD974B; padding: 0; background: rgba(253, 151, 75, .8); }
	th {
	font-size: 22px;
	border: 3px solid #F4938C;
	background-color: #F4938C;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	padding: 0;
}
td { 
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-bottom: 5px;
	text-align: center;
}

	#chart_divA svg, #chart_divB svg, #chart_divC svg{
		position: relative;
		width: 250px;
		height: 250px;
		top: 0;
		left: 0;
		margin: 0;
	}
	.ac-custom input[type="checkbox"], .ac-custom input[type="radio"], .ac-custom label::before {
		top:initial;
		bottom:0;
	}
	.ac-custom input[type="checkbox"], .ac-custom input[type="radio"], .ac-custom label::before {
		background: blueviolet;
	}
	.ac-custom svg {
		top:initial;
		bottom:0;
		left:115px;
	}
	#choices1 span {
		width: 30px;
		display: block;
		margin: 0 auto;
	}
	#question > table > tbody > tr:nth-child(1) > th {
		width:250px;
	}
	#chart_divD > div:nth-child(1) > div > div > svg, #chart_divE > div:nth-child(1) > div > div > svg, #chart_divF > div:nth-child(1) > div > div > svg {
		width: 360px;
	}
	#chart_divD, #chart_divE, #chart_divF {
		margin:0 auto;
	}
	html[dir="rtl"] .ac-custom svg { left:90px; }
</style>
<script type="text/javascript">
	 // Load the Visualization API and the piechart package.
	 google.load('visualization', '1', {packages: ['corechart']});

	 function drawCharts (){
	 	var dataA = google.visualization.arrayToDataTable([
	 		['Hair Color', '# of students', { role: 'style' }, { role: 'annotation' } ],
	 		['<?php echo _("Blonde"); ?>', 12, '#F0E838', '12' ],
	 		['<?php echo _("Brown"); ?>', 11, '#7C4B4B', '11' ],
	 		['<?php echo _("Black"); ?>', 4, 'black', '4' ],
	 		['<?php echo _("Red"); ?>', 1, 'color: red', '1' ],
	 		]);

	 	var optionsA = {
	 		title: ' ',
        	//hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}
        };
        var dataB = google.visualization.arrayToDataTable([
        	['Hair Color', '# of students', { role: 'style' }, { role: 'annotation' } ],
        	['<?php echo _("Blonde"); ?>', 4, '#F0E838', '4' ],
        	['<?php echo _("Brown"); ?>', 11, '#7C4B4B', '11' ],
        	['<?php echo _("Black"); ?>', 12, 'black', '12' ],
        	['<?php echo _("Red"); ?>', 1, 'color: red', '1' ],
        	]);

        var optionsB = {
        	title: ' ',
        	//hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}
        };
        var dataC = google.visualization.arrayToDataTable([
        	['Hair Color', '# of students', { role: 'style' }, { role: 'annotation' } ],
        	['<?php echo _("Blonde"); ?>', 11, '#F0E838', '11' ],
        	['<?php echo _("Brown"); ?>', 12, '#7C4B4B', '12' ],
        	['<?php echo _("Black"); ?>', 4, 'black', '4' ],
        	['<?php echo _("Red"); ?>', 11, 'color: red', '1' ],
        	]);

        var optionsC = {
        	title: ' ',
        	//hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}
        };
        var dataD = google.visualization.arrayToDataTable([
	 		['Hair Color', '# of students', { role: 'style' }, { role: 'annotation' } ],
	 		['<?php echo _("Blonde"); ?>', 12, '#F0E838', '12' ],
	 		['<?php echo _("Brown"); ?>', 11, '#7C4B4B', '11' ],
	 		['<?php echo _("Black"); ?>', 4, 'black', '4' ],
	 		['<?php echo _("Red"); ?>', 1, 'color: red', '1' ],
	 		]);

        var optionsD = {
        	title: ' ',
        	//hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}
        };
        var dataE = google.visualization.arrayToDataTable([
        	['Hair Color', '# of students', { role: 'style' }, { role: 'annotation' } ],
        	['<?php echo _("Blonde"); ?>', 4, '#F0E838', '4' ],
        	['<?php echo _("Brown"); ?>', 11, '#7C4B4B', '11' ],
        	['<?php echo _("Black"); ?>', 12, 'black', '12' ],
        	['<?php echo _("Red"); ?>', 1, 'color: red', '1' ],
        	]);

        var optionsE = {
        	title: ' ',
        	//hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}
        };
        var dataF = google.visualization.arrayToDataTable([
        	['Hair Color', '# of students', { role: 'style' }, { role: 'annotation' } ],
        	['<?php echo _("Blonde"); ?>', 11, '#F0E838', '11' ],
        	['<?php echo _("Brown"); ?>', 12, '#7C4B4B', '12' ],
        	['<?php echo _("Black"); ?>', 4, 'black', '4' ],
        	['<?php echo _("Red"); ?>', 11, 'color: red', '1' ],
        	]);

        var optionsF = {
        	title: ' ',
        	//hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}
        };
        var chartA = new google.visualization.ColumnChart(document.getElementById('chart_divA'));
        chartA.draw(dataA, optionsA);

        var chartB = new google.visualization.ColumnChart(document.getElementById('chart_divB'));
        chartB.draw(dataB, optionsB);

        var chartC = new google.visualization.ColumnChart(document.getElementById('chart_divC'));
        chartC.draw(dataC, optionsC); 

        var chartD = new google.visualization.ColumnChart(document.getElementById('chart_divD'));
        chartD.draw(dataD, optionsD);

        var chartE = new google.visualization.ColumnChart(document.getElementById('chart_divE'));
        chartE.draw(dataE, optionsE);

        var chartF = new google.visualization.ColumnChart(document.getElementById('chart_divF'));
        chartF.draw(dataF, optionsF);   
    }
    google.setOnLoadCallback(drawCharts);

</script>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _('Quiz Question #5'); ?></h1>
				<h2><?php echo _('A student in the fifth grade class decided to see how many had a hair color other than blonde in her classroom. Use the data in the table below to decide which bar graph shows the correct data.'); ?></h2>
				<table>
					<tr>
						<th><?php echo _('Hair Color:'); ?></th>
						<td><?php echo _('Blonde'); ?></td>
						<td><?php echo _('Brown'); ?></td>
						<td><?php echo _('Black'); ?></td>
						<td><?php echo _('Red'); ?></td>
					</tr>
					<tr>
						<th><?php echo _('Number of Students:'); ?></th>
						<td>12</td>
						<td>11</td>
						<td>4</td>
						<td>1</td>
					</tr>
				</table>
				<form class="ac-custom ac-radio ac-swirl" autocomplete="off">
					<ul id="choices1">
						<li id="A" class="radio">
							<div id="chart_divA" style="width: 270px; height: 250px;"></div>
							<span><input id="r1" name="r1" type="radio"><label for="r1"><?php echo _('A'); ?></label></span>
						</li>
						<li id="B" class="radio">
							<div id="chart_divB" style="width: 270px; height: 250px;"></div>
							<span><input id="r2" name="r1" type="radio"><label for="r2"><?php echo _('B'); ?></label></span>
						</li>
						<li id="C" class="radio">
							<div id="chart_divC" style="width: 270px; height: 250px;"></div>
							<span><input id="r3" name="r1" type="radio"><label for="r3"><?php echo _('C'); ?></label></span>
							
						</li>					
					</ul>
				</form>	
			</div>
			<div id="answer">
				<h1><?php echo _('Quiz Question #5'); ?> - <?php echo _('How did I do?'); ?></h1>
				<p><?php echo _('You answered...'); ?></p>
				<div id="chart_divD" style="width: 360px; height: 200px; display:none;"></div>
				<div id="chart_divE" style="width: 360px; height: 200px; display:none;"></div>
				<div id="chart_divF" style="width: 360px; height: 200px; display:none;"></div>
				<p><span id="textanswer1"> </span></p>
				<p><img id="answer-icon1"> <span id="feedback1"> </span></p>
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#answer" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _("Check Answer"); ?>"></a>
		<a href="21.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Brushing blonde hair...'); ?></strong></section></section>
	<script>
		var 
		nullAnswer = false,
		answered = <?php echo $answered; ?>,
		answer1,
		answer = $('#answer'),
		textanswer1 = $('#textanswer1'),
		back = $('img.back-toggle'),
		next = $('img.next-toggle'),
		check = $('img.check-toggle'),
		question = $('#question'),
		feedback1 = $('#feedback1'),
		answericon1 = $('#answer-icon1'),
		chartD = $('#chart_divD'),
		chartE = $('#chart_divE'),
		chartF = $('#chart_divF');

		$(document).ready(function() {
		
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "19.php";
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
					//$('#chart_divD').css('width', '360px');
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
		if($('#r1').is(':checked')) {
			textanswer1 = "";
			chartD.css('display','block');
			chartE.css('display','none');
			chartF.css('display','none');
			textstr = " <?php echo _('Good job! There are 12 students with blonde hair, 11 with brown, 4 with black, and 1 with red hair. Under each bar the hair color is shown.'); ?>";
			answericon1.attr("src", "images/others/correct.png");
			feedback1.addClass('green');
			answer1 = "A";
		} else {
			
			if($('#r2').is(':checked')) {
				textanswer1 = "";
				chartE.css('display','block');
				chartD.css('display','none');
				chartF.css('display','none');
				textstr = " <?php echo _('Not quite. There are 12 students with blonde hair, 11 with brown, 4 with black, and 1 with red hair. Under each bar the hair color is shown.'); ?>";
				answer1 = "B";	
			} else if ($('#r3').is(':checked')) {
				textanswer1 = "";
				chartF.css('display','block');
				chartE.css('display','none');
				chartD.css('display','none');
				textstr = " <?php echo _('Not quite. There are 12 students with blonde hair, 11 with brown, 4 with black, and 1 with red hair. Under each bar the hair color is shown.'); ?>";
				answer1 = "C";
			} 

			answericon1.attr("src", "images/others/wrong.png");
			answericon1.addClass('img-align');
			feedback1.addClass('red');
		}

		feedback1.text(textstr);

		if(answered == 0) {
			saveAnswer('gathering-data-qq5-a', answer1);
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
