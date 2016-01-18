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
<script type="text/javascript" src="https://www.google.com/jsapi"></script> <!-- Google Charts -->
<style>
.wrap { border-left: 1px dashed #c1d0e5; border-right: 1px dashed #c1d0e5; }
.bg { background: url('images/18/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
img.next-toggle { display: none; }

.ac-custom { width: 720px; }
.ac-custom label.r2::before { margin-top: -30px }
.ac-custom label.r4::before { margin-top: -30px }
.ac-custom label.r5::before { margin-top: -30px }
.ac-custom label::before { color: #F4938C; background: #FD974B; }
.ac-swirl svg { width: 35px; margin-top: -2px; left: 3px;color: #F4938C; }
.ac-swirl #r4 svg { margin-top: -280px  }
.ac-custom input[type="radio"]:checked + label { color: #FD974B; }
.ac-custom {
clear: both;
margin-top: 10px;
}
.click {display: inline-block !important; padding-top: 20px; vertical-align: middle !important;color:#9E4D84 !important; text-align: center;}
.pet:hover { cursor: pointer; }
#graphDiv { display: none; position: absolute; background: rgba(45, 45, 45, .9); z-index: 1000;  width: 100%; height:100%;padding:50px;}
#graphDiv img { margin: 10px 100px; margin-top: 40px; }
#close { background: white; color: #406468; display: block; margin: 0 auto; width: 85px; padding:10px; border-radius: 5px;margin-top:20px;}
#close:hover { cursor: pointer; }
.size {width: 400px !important;height: 250px !important;}
.pet { width: 30%; padding: 0; display: block; margin: 20px auto 0; }
#question p { width: 100%; color: #A890FD; text-align: center; font-size: 18px;}
#chart_div > div:nth-child(1) > div > svg > g:nth-child(4) {display:none;}
.ac-custom input[type="checkbox"]:checked + label, .ac-custom input[type="radio"]:checked + label {color:#8D3FB3;}
#chart_divB {margin:0 auto;width:150px;}

html[dir="rtl"] .ac-custom ul, .ac-custom ol { margin-right: 185px; }
html[dir="rtl"] .ac-custom label { padding:0 40px 0 0; }
html[dir="rtl"] .ac-custom input[type="checkbox"], .ac-custom input[type="radio"], .ac-custom label::before { right: 0; }
html[dir="rtl"] .ac-custom svg { right: 10px; }
html[dir="rtl"] .ac-custom { width: auto; }

<?php if($language == "zh_CN") { ?>
	.ac-custom input[type="checkbox"], .ac-custom input[type="radio"], .ac-custom label::before { margin-top: -15px !important; }
<?php } ?>

</style>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['<?php echo _("Element"); ?>', '<?php echo _("Density"); ?>', { role: 'style' }],
          ['<?php echo _("Dogs"); ?>', 4, '#FF7345'],            // RGB value
          ['<?php echo _("Snakes"); ?>', 0, '#FF7345'],            // English color name
          ['<?php echo _("Cats"); ?>', 7, '#FF7345'],
          ['<?php echo _("Turtles"); ?>', 1, 'color: #FF7345' ], // CSS-style declaration
          ['<?php echo _("Fish"); ?>', 8, 'color: #FF7345' ],
          ['<?php echo _("Birds"); ?>', 4, 'color: #FF7345' ],
       ]);

        var options = {
          title: '<?php echo _("Kids with Pets"); ?>', titleTextStyle: {color:'#3D5E60', fontSize:20},
          width: 800,
		  height: 500,
		  colors: ['#FF7345'],
          vAxis: {title: '<?php echo _("Number of Kids with Each Pet"); ?>', titleTextStyle: {color: '#3D5E60', fontSize: 20}}
        };

        var data2 = google.visualization.arrayToDataTable([
          ['<?php echo _("Element"); ?>', 'Density', { role: 'style' }],
          ['<?php echo _("Dogs"); ?>', 4, '#FF7345'],            // RGB value
          ['<?php echo _("Snakes"); ?>', 0, '#FF7345'],            // English color name
          ['<?php echo _("Cats"); ?>', 7, '#FF7345'],
          ['<?php echo _("Turtles"); ?>', 1, 'color: #FF7345' ], // CSS-style declaration
          ['<?php echo _("Fish"); ?>', 8, 'color: #FF7345' ],
          ['<?php echo _("Birds"); ?>', 4, 'color: #FF7345' ],
       ]);

        var options2 = {
          title: '<?php echo _("Kids with Pets"); ?>', titleTextStyle: {color:'#3D5E60', fontSize:12},
          width: 150,
		  height: 100,
		  colors: ['#FF7345'],
          vAxis: {title: '<?php echo _("Number of Kids with Each Pet"); ?>', titleTextStyle: {color: '#3D5E60', fontSize: 12}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);

        var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_divB'));
        chart2.draw(data2, options2);
      }
    </script>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			
				<div id="graphDiv" >
					<div id="chart_div"></div>
					<span id="close"><?php echo _('Close me!'); ?></span>
					<!-- <img src="images/18/graph.jpg" >
					 -->
				</div>
			<div id="question">
				<h1><?php echo _('Quiz Question #3'); ?></h1>

				<section>
					<h2><?php echo _('Use the following data to select <span class="blink">all</span> the correct sentences based on the data about kids and their pets.'); ?></h2>
						<!-- <div id="chart_divB"></div> -->
						<img src="images/18/graph.jpg" class="pet" >
						<p class="click"><?php echo _('Click the image to enlarge the graph.'); ?></p>
					<form class="ac-custom ac-checkbox ac-checkmark" autocomplete="off">
						
						
						<ul>
							<li><input id="r1" name="r1" type="checkbox"><label for="r1">A. <?php echo _('Four kids have dogs.'); ?></label></li>
							<li><input id="r2" name="r1" type="checkbox"><label class="r2" for="r2">B. <?php echo _('The number of kids who own dogs, cats, and turtles altogether are more than the number of kids who own fish and birds altogether.'); ?></label></li>
							<li><input id="r3" name="r1" type="checkbox"><label for="r3">C. <?php echo _('Only one kid has a turtle.'); ?></label></li>
							<li><input id="r4" name="r1" type="checkbox"><label class="r4" for="r4">D. <?php echo _('The number of kids who have dogs, is the same as the number of kids who have birds.'); ?></label></li>
							<li><input id="r5" name="r1" type="checkbox"><label class="r5" for="r5">E. <?php echo _('The number of kids who own cats is one more than the number of kids who own fish.'); ?></label></li>
						<ul>
						
					</form>
				</section>
				
			</div>
			<div id="answer">
				<h1><?php echo _('Quiz Question #3'); ?> - <?php echo _('How did I do?'); ?></h1>
				<p><?php echo _('You answered...'); ?></p>
				<p><span id="textanswer1"> </span></p>
					<p><img id="answer-icon1"> <span id="feedback1"> </span></p>
					<!-- <img id="pet" src="images/18/graph.jpg" class="size"> -->
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _("Check Answer"); ?>"></a>
		<a href="19.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Racing with the dogs...'); ?></strong></section></section>
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
		answered = 1,
		answer1;
		
	$(document).ready(function() {
		$('img.pet').click(function() {
			$('#graphDiv').fadeIn();
		});
		$('#close').click(function() {
			$('#graphDiv').fadeOut();
		});
		
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "17.php";
			} else if ($('#answer').is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
				answer.fadeOut(function() {
					textanswer1.text('');
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
		});
	});
	
	function checkNull() {
		if(!$('input:checkbox').is(':checked')) {
			nullAnswer = true;
		}
	}

	function checkAnswers() {
		/* For checking of question A */

		answer1 = "";

		if($('#r1').is(":checked")) { answer1  = "A"; }
		if($('#r2').is(":checked")) { answer1 += "B"; }
		if($('#r3').is(":checked")) { answer1 += "C"; }
		if($('#r4').is(":checked")) { answer1 += "D"; }
		if($('#r5').is(":checked")) { answer1 += "E"; }

		if($('#r1').is(':checked') && $('#r3').is(':checked') && $('#r4').is(':checked') && !$('#r2').is(':checked') && !$('#r5').is(':checked') ) {
			textanswer1.append("A. " + "<?php echo _('Four kids have dogs.'); ?></br>");
			textanswer1.append("C. " + "<?php echo _('Only one kid has a turtle.'); ?></br>");	
			textanswer1.append("D. " + "<?php echo _('The number of kids who have dogs, is the same as the number of kids who have birds.'); ?></br>");
			textstr = "<?php echo _('Correct! The number of kids who own dogs, cats, and turtles altogether are the same as the number of kids who own fish and birds altogether. And the number of kids who own fish is one more than the number of kids who own cats.'); ?>";
			answericon1.attr("src", "images/others/correct.png");
			feedback1.addClass('green');
		} else {
			if($('#r1').is(':checked')){
				textanswer1.append("A. " + "<?php echo _('Four kids have dogs.'); ?></br>");
			} if ($('#r2').is(':checked')) {
				textanswer1.append("B. " + "<?php echo _('The number of kids who own dogs, cats, and turtles altogether are more than the number of kids who own fish and birds altogether.'); ?></br>");
			} if ($('#r3').is(':checked')){
				textanswer1.append("C. " + "<?php echo _('Only one kid has a turtle.'); ?></br>");	
			} if ($('#r4').is(':checked')){
				textanswer1.append("D. " + "<?php echo _('The number of kids who have dogs, is the same as the number of kids who have birds.'); ?></br>");
			} if ($('#r5').is(':checked')){
				textanswer1.append("E. " + "<?php echo _('The number of kids who own cats is one more than the number of kids who own fish.'); ?></br>");
			}
			
			
			textstr = "<?php echo _('Not quite! The number of kids who own dogs, cats, and turtles altogether are the same as the number of kids who own fish and birds altogether. And the number of kids who own fish is one more than the number of kids who own cats.'); ?>";
			 
			answericon1.attr("src", "images/others/wrong.png");
			answericon1.addClass('img-align');
			feedback1.addClass('red');
		}
		feedback1.text(textstr);

		if(answered == 0) {
			saveAnswer('gathering-data-qq3-a', answer1);
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

