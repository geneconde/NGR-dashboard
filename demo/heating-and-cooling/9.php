<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(9, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'heating-and-cooling-qc3-a');
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
		img.no-border { border: none !important; }

		.answer { padding: 0 10px !important; }
		.feedback { margin: 0; padding: 0 10px !important; text-align: center; }

		.bg { background-image: url('images/9/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative;  z-index: 10; }
		.bg li { padding: 0; }

		#answers { display: none; }

		#preview {
			position: absolute;
			width: 259px;
			height: 191px;
			display: none;
		}

		#question1 table, 
		#answer1 table {
			width: 97%;
			margin: 10px auto;
		}

		#question1 table th, #question1 table td,
		#answer1 table th, #answer1 table td {
			background: rgba(255, 255, 255, .5);
			font-size: 20px;
			text-shadow: 1px 1px 0px #fff;
			border: 1px solid rgba(255, 255, 255, .8);
			padding: 3px 0 0 0;
		}		

		#question1 table p,
		#answer1 table p { margin: 0; }

		/*#answer1 img { vertical-align: middle; margin-bottom: 5px; }*/

		#question1 table th,
		#answer1 table th {
			padding: 5px 0;
			text-align: center;
		}

		#question1 table tr th:nth-child(1) { color: #777; }

		#question2, #question3, #answer2, #answer3 {
			width: 46% !important;
			margin-right: 25px !important;
			float: left;
		}

		#question3, #answer3 { margin-right: 0 !important; }

		#question1, #question2, #question3, #answer1, #answer2, #answer3 {
			overflow: hidden;
			background-color: rgba(135, 206, 250, .3) !important;
			margin: 0 auto;
			-webkit-border-radius:10px;
			-moz-border-radius:10px;
			border-radius:10px;
			margin-bottom: 10px;
			padding: 0 10px;
			width: 97%;
		}

		#ans2 { padding-bottom: 10px; }

		#question2 ul { overflow: hidden; }

		#question2 ul, #question3 ul { padding-left: 30px; }
		#question3 ul { padding-left: 10px; }

		#question1 table tr th:nth-child(2),
		#answer1 table tr th:nth-child(2) {
			color: #ed2a7b;
		}

		#question1 table tr th:nth-child(3),
		#answer1 table tr th:nth-child(3) {
			color: #91268f;
		}

		#question1 table tr th:nth-child(4),
		#answer1 table tr th:nth-child(4) {
			color: #f7941d;
		}

		#answers p, 
		#answers h3, 
		#answers li,
		#answer1 p, #answer2 p {
			text-align: center;
			padding: 0;
		}

		#answer1 table { margin: 20px auto; }

		#answer1 td { text-align: center; }
		#answer1 td img { display: inline-block; }

		#draggable {
			width: 100%; 
			height: 100%; 
			text-align: center; 
		}

		#droppable { 
			min-width: 1px; 
			padding: 0;
			min-height: 19px; 
			text-align: center;
			height: 62px;
		}

		[draggable] { cursor: url(https://mail.google.com/mail/images/2/openhand.cur), default !important; }

		[draggable]:active { cursor: url(https://mail.google.com/mail/images/2/closedhand.cur), default !important; }
		
		label { padding-left: 0px !important; cursor: pointer; }

		input[type="radio"] + label span {
			vertical-align: middle;
			display:inline-block;
			width:30px;
			height:30px;
			background:url('images/misc/water.png') no-repeat;
			cursor: pointer;
		}

		input[type="radio"]:checked + label span {
			background:url('images/misc/fire.png') no-repeat;
		}
		
		label:before {
			content: "" !important;
			margin-right: 0 !important; 
			height: 0;
		}
		
		input[type="radio"] { display: none; }
		
		table tr td { text-align: center; }

		#questions table img { width: 70px; display: inline-block; }
		#answers table img { display: inline-block; }

		.grab { cursor: move; cursor: -moz-grab; cursor: -webkit-grab; }
		.grabbing { cursor: move; cursor: -moz-grabbing; cursor: -webkit-grabbing; }
		#dp_swf_engine { display: none; }

		.lang-menu {z-index:10;}
		h2, p, li {padding:3px 0;}

		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
			#question2, #answer2 { width: 45% !important; }
			h2, p, li {font-size:20px !important; padding:3px 0;}
		}	

		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important; padding:3px 0;}
			#question1 table th, #answer1 table th {padding: 0px 0;}
			#question1 table th, #question1 table td, #answer1 table th, #answer1 table td {font-size:18px;}
			#question1 table, #answer1 table {margin:0px auto;}
		}	

		@media only screen and (max-width: 1024px) {
			h2, p, li {font-size:20px !important;}
			#questions table img {width: 60px;}
			#question1 table td {padding: 0px 0 0 0;}

			#question2 {  width: 50% !important;}
		}

		@media only screen and (max-width:  960px) {
			h2, p, li {font-size:18px !important;}
			.bg {overflow: overlay;}
			#question1 table, #answer1 table {margin:0px auto;}
			#questions table img {width: 50px;}
			#question1 table td {padding: 0px 0 0 0;}
			#question2 {  width: 45% !important;}
		}

		@media only screen and (max-width: 768px) {
			h2, p, li {font-size:16px !important;}
			#questions table img {width: 50px;}
			#question1 table td {padding: 0px 0 0 0;}
			#question2 {  width: 40% !important;}
		}
<?php if($language == "en_US") { ?>
	#question3, #answer3{width: 41% !important;}
	#question2, #answer2{width: 49% !important;}
<?php } ?>
<?php if($language == "ar_EG") { ?>
	h2, p, li {font-size: 20px;}
	#question3, #answer3{width: 41% !important;}
	#question2, #answer2 {width: 49% !important;}
<?php } ?>
<?php if($language == "zh_CN") { ?>
	#question3, #answer3{width: 41% !important;}
	#question2, #answer2{width: 49% !important;}
<?php } ?>
<?php if($language == "es_ES") { ?>
	#question3, #answer3{width: 41% !important;}
	#question2, #answer2{width: 49% !important;}
<?php } ?>

		#buttons .next { display: none; }

	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="questions">
				<h1><?php echo _("Quick Check #3"); ?></h1>

				<div id="question1">
					<h2><?php echo _("Question A. Drag the heat transfer method onto the example it matches."); ?></h2>

				<table>
					<tr>
						<th><?php echo _("Method"); ?></th>
						<th><?php echo _("Convection"); ?></th>
						<th><?php echo _("Radiation"); ?></th>
						<th><?php echo _("Conduction"); ?></th>
					</tr>

					<tr>
						<td class="first"><img src="images/9/hand-on-pot.jpg" class="grab" id="hand-on-pot" alt="<?php echo _("Energy is transferred by direct contact"); ?>"></td>
						<td id="10"></td>
						<td id="11"></td>
						<td id="12"></td>
					</tr>

					<tr>
						<td class="second"><img src="images/9/pot-with-cloud.jpg" class="grab" id="pot-with-cloud" alt="<?php echo _("Energy is transferred by the mass motion of molecules"); ?>"></td>
						<td id="20"></td>
						<td id="21"></td>
						<td id="22"></td>
					</tr>

					<tr>
						<td class="third"><img src="images/9/hand-near-fire.jpg" class="grab" id="hand-near-fire" alt="<?php echo _("Energy is transferred by electromagnetic radiation"); ?>"></td>
						<td id="30"></td>
						<td id="31"></td>
						<td id="32"></td>
					</tr>
				</table>
					
					<!--<table>
						<tr>
							<th><?php echo _("Method"); ?></th>
							<th><?php echo _("Convection"); ?></th>
							<th><?php echo _("Radiation"); ?></th>
							<th><?php echo _("Conduction"); ?></th>
						</tr>

						<tr>
							<td class="first"><div id="draggable" ondrop="drop(event)"><img draggable="true" ondragstart="drag(event)" id="drag1"  width="70px" alt="<?php echo _("Energy is transferred by direct contact"); ?>" src="images/9/hand-on-pot.jpg"></div></td>			
							<td id="10"><div id="droppable" class="drag1" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>
							<td id="11"><div id="droppable" class="drag1" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>
							<td id="12"><div id="droppable" class="drag1" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>					
						</tr>

						<tr>
							<td class="second"><div id="draggable" ondrop="drop(event)"><img draggable="true" ondragstart="drag(event)" id="drag2"  width="70px" alt="<?php echo _(""); ?>" src="images/9/pot-with-cloud.jpg"></div></td>
							
							<td id="20"><div id="droppable" class="drag2" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>	<td id="21"><div id="droppable" class="drag2" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>	<td id="22"><div id="droppable" class="drag2" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>
						</tr>

						<tr>
							<td class="third"><div id="draggable" ondrop="drop(event)"><img draggable="true" ondragstart="drag(event)" id="drag3" width="70px" alt="<?php echo _(""); ?>" src="images/9/hand-near-fire.jpg"></div></td>
							<td id="30"><div id="droppable" class="drag3" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>	<td id="31"><div id="droppable" class="drag3" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>
							<td id="32"><div id="droppable" class="drag3" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>
						</tr>
					</table>-->
				</div>

				<div id="question2">
					<h2><?php echo _("Question B. Sunlight is a form of energy that travels through space without the aid of fluids or solids. Which method of heat transfer is sunlight?"); ?></h2>

					<ul>
						<li>
							<input type="radio" name="q2" id="a2" value="A">
							<label for="a2"><span></span><?php echo _("A. Convection"); ?></label>
						</li>

						<li>
							<input type="radio" name="q2" id="b2" value="B">
							<label for="b2"><span></span><?php echo _("B. Conduction"); ?></label>
						</li>

						<li>
							<input type="radio" name="q2" id="c2" value="C">
							<label for="c2"><span></span><?php echo _("C. Radiation"); ?></label>
						</li>

						<li>
							<input type="radio" name="q2" id="d2" value="D">
							<label for="d2"><span></span><?php echo _("D. All of the above"); ?></label>
						</li>
					</ul>
				</div>

				<div id="question3">
					<h2><?php echo _("Question C. What happens when you make toast over a campfire?"); ?></h2>

					<ul>
						<li>
							<input type="radio" name="q1" id="a3" value="A">
							<label for="a3"><span></span><?php echo _("A. The bread is heated"); ?></label>
						</li>

						<li>
							<input type="radio" name="q1" id="b3" value="B">
							<label for="b3"><span></span><?php echo _("B. The air around the bread is heated."); ?></label>
						</li>

						<li>
							<input type="radio" name="q1" id="c3" value="C">
							<label for="c3"><span></span><?php echo _("C. Both A and B"); ?></label>
						</li>
					</ul>
				</div>
			</div>

			<div id="answers">
				<h1><?php echo _("Quick Check #3"); ?> - <?php echo _("How did I do?"); ?></h1>
				
				<div id="answer1">
					<h2><?php echo _("Question A. Drag the heat transfer method onto the example it matches."); ?></h2>

					<table>
						<tr>
							<th>&nbsp;</th>
							<th><?php echo _("Convection"); ?></th>
							<th><?php echo _("Radiation"); ?></th>
							<th><?php echo _("Conduction"); ?></th>
						</tr>

						<tr class="one">
							<td class="feedback"></td>			
							<td id="10"></td>
							<td id="11"></td>
							<td id="12"></td>					
						</tr>

						<tr class="two">
							<td class="feedback"></td>			
							<td id="20"></td>
							<td id="21"></td>
							<td id="22"></td>					
						</tr>

						<tr class="three">
							<td class="feedback"></td>			
							<td id="30"></td>
							<td id="31"></td>
							<td id="32"></td>					
						</tr>
					</table>
				</div>

				<div id="answer2">
					<h2><?php echo _("Question B. Sunlight is a form of energy that travels through space without the aid of fluids or solids. Which method of heat transfer is sunlight?"); ?></h2>
						
					<p class="center"><?php echo _("You answered..."); ?></p>
					<p class="center answer"></p>

					<p class="feedback"></p>
				</div>

				<div id="answer3">
					<h2><?php echo _("Question C. What happens when you make toast over a campfire?"); ?></h2>
						
					<p class="center"><?php echo _("You answered..."); ?></p>
					<p class="center answer"></p>
					<p class="feedback"></p>
				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="10.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader">
		<section class="selected">
			<strong><?php echo _("Another quick check on the way!"); ?></strong>
		</section>
	</section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/qtip.js"></script>
	<script src="scripts/jquery-ui.js"></script>
	<script src="scripts/jquery.ui.touch-punch.min.js"></script>
	<script src="scripts/saveanswer.js"></script>
	<script src="scripts/rightclick.js"></script>
	<script>
		var answered = <?php echo $answered; ?>,

			questions = $('#questions'),
			answers = $('#answers'),

			q2 = $('#question2').find('input[type=radio]'),
			q3 = $('#question3').find('input[type=radio]'),

			answer1 = $('#answer1'),
			answer2 = $('#answer2'),
			answer3 = $('#answer3'),

			check = $('a.checkanswer'),
			back = $('a.back'),
			next = $('a.next');

		$('#questions img').draggable({ revert: 'invalid' });
		
		$('#questions img').each(function() {
			var image = $(this);
			var p = $(this).parent().parent().children(':not(:first-child)');
			var drop1 = $(this).parent().parent().children(':nth-child(2)');
			var drop2 = $(this).parent().parent().children(':nth-child(3)');
			var drop3 = $(this).parent().parent().children(':nth-child(4)');
			
			image.mousedown(function() { image.removeClass('grab'); image.addClass('grabbing'); image.css('opacity', '0.7'); });
			image.mouseup(function() { image.removeClass('grabbing'); image.addClass('grab'); image.css('opacity', '1'); });
			
			drop1.droppable ({
				accept: image,
				drop: function (event, ui) { image.detach().css({top: 0,left: 0}).appendTo(drop1); }
			});
			
			drop2.droppable ({
				accept: image,
				drop: function (event, ui) { image.detach().css({top: 0,left: 0}).appendTo(drop2); }
			});

			drop3.droppable ({
				accept: image,
				drop: function (event, ui) { image.detach().css({top: 0,left: 0}).appendTo(drop3); }
			});
		});

		q2.on('click', function() {

			var radio = $(this).val();

			if (radio == 'A') {

				answer2.find('.answer')
					.html('<?php echo _("Convection"); ?>');

				answer2.find('.feedback')
					.html('<img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No, transfer by convection requires a substance—space is empty."); ?>')
					.removeClass('green')
					.addClass('red');

			}

			if (radio == 'B') {

				answer2.find('.answer')
					.html('<?php echo _("Conduction"); ?>');

				answer2.find('.feedback')
					.html('<img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No, transfer by conduction requires a substance—space is empty."); ?>')
					.removeClass('green')
					.addClass('red');

			}

			if (radio == 'C') {

				answer2.find('.answer')
					.html('<?php echo _("Radiation"); ?>');

				answer2.find('.feedback')
					.html('<img src="images/misc/correct.png" alt="Correct" /> <?php echo _("Correct, sunlight can pass through empty space—it doesn’t need any matter."); ?>')
					.removeClass('red')
					.addClass('green');

			}

			if (radio == 'D') {

				answer2.find('.answer')
					.html('<?php echo _("All of the above"); ?>');

				answer2.find('.feedback')
					.html('<img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No, sunlight is only transferred by radiation through empty space."); ?>')
					.removeClass('green')
					.addClass('red');

			}

		});

		q3.on('click', function() {

			var radio = $(this).val();

			if (radio == 'A') {

				answer3.find('.answer')
					.html('<?php echo _("The bread is heated"); ?>');

				answer3.find('.feedback')
					.html('<img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("Not quite, the bread is heated but so is the air around it."); ?>')
					.removeClass('green')
					.addClass('red');

			}

			if (radio == 'B') {

				answer3.find('.answer')
					.html('<?php echo _("The air around the bread is heated"); ?>');

				answer3.find('.feedback')
					.html('<img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("Not quite, the air is heated, but so is the bread."); ?>')
					.removeClass('green')
					.addClass('red');

			}

			if (radio == 'C') {

				answer3.find('.answer')
					.html('<?php echo _("The bread is heated and the air around the bread is heated"); ?>');

				answer3.find('.feedback')
					.html('<img src="images/misc/correct.png" alt="Correct" /> <?php echo _("Correct. Heat energy from the campfire is transferred to both the air and bread."); ?>')
					.removeClass('red')
					.addClass('green');

			}

		});

		check.on('click', function() {
			if ($('td.first').html() == '' && $('td.second').html() == '' && $('td.third').html() == '' && q2.is(':checked') && q3.is(':checked')) {
				questions.fadeOut(function() {
					answers.fadeIn();
					window.location.hash = "#answers";
				});
				check.fadeOut(function() { next.fadeIn(); back.fadeIn(); });
				save();
			} else {
				alert('<?php echo _("Please select your answers."); ?>');
			}
		});

		back.on('click', function() {

			if (questions.is(':visible')) { document.location.href = "8.php"; }

			else {
				answers.fadeOut(function() { questions.fadeIn(); });
				next.fadeOut(function() { check.fadeIn(); });
			}
		});

		function allowDrop(e) { 
			e.preventDefault(); 
		}

		function drag(e) {
			e.dataTransfer.setData("Text", e.target.id); 
		}

		function drop(e) {

			var eleid = e.dataTransfer.getData("Text");
			var el = e.target;

			if ( $(el).hasClass(eleid) ) {
				el.appendChild(document.getElementById(eleid));
			}

			e.preventDefault();

		}

		function save() {

			var aa1 = '', 
				aa2 = '', 
				aa3 = '',

				a2 = $('#a2'),
				b2 = $('#b2'),
				c2 = $('#c2'),
				d2 = $('#d2'),

				a3 = $('#a3'),
				b3 = $('#b3'),
				c3 = $('#c3'),

				ans1 = '',
				ans2 = '',
				ans3 = '';

			// Question 1
			if ($('#10').html() != '') {
				$('tr.one').find('.feedback').html('<img src="images/misc/wrong.png" alt="wrong" class="no-border">');

				aa1 = 'convection';

				answer1.find('#10').html('<img src="images/9/hand-on-pot.jpg" width="70" alt="<?php echo _("Energy is transferred by direct contact"); ?>">');
				answer1.find('#11').html('');
				answer1.find('#12').html('');
			} else if ($('#11').html() != '') {
				$('tr.one').find('.feedback').html('<img src="images/misc/wrong.png" alt="wrong" class="no-border">');

				aa1 = 'radiation';

				answer1.find('#10').html('');
				answer1.find('#11').html('<img src="images/9/hand-on-pot.jpg" width="70" alt="<?php echo _("Energy is transferred by direct contact"); ?>">');
				answer1.find('#12').html('');
			} else if ($('#12').html() != '') {
				$('tr.one').find('.feedback').html('<img src="images/misc/correct.png" alt="Correct" class="no-border">');
				aa1 = 'conduction';

				answer1.find('#10').html('');
				answer1.find('#11').html('');
				answer1.find('#12').html('<img src="images/9/hand-on-pot.jpg" width="70" alt="<?php echo _("Energy is transferred by direct contact"); ?>">');
			}

			if ($('#20').html() != '') {
				$('tr.two').find('.feedback').html('<img src="images/misc/correct.png" alt="wrong" class="no-border">');

				aa2 = 'convection';

				answer1.find('#20').html('<img src="images/9/pot-with-cloud.jpg" width="70" alt="<?php echo _("Energy is transferred by the mass motion of molecules"); ?>">');
				answer1.find('#21').html('');
				answer1.find('#22').html('');
			} else if ($('#21').html() != '') {
				$('tr.two').find('.feedback').html('<img src="images/misc/wrong.png" alt="Correct" class="no-border">');

				aa2 = 'radiation';

				answer1.find('#20').html('');
				answer1.find('#21').html('<img src="images/9/pot-with-cloud.jpg" width="70" alt="<?php echo _("Energy is transferred by the mass motion of molecules"); ?>">');
				answer1.find('#22').html('');
			} else if ($('#22').html() != '') {
				$('tr.two').find('.feedback').html('<img src="images/misc/wrong.png" alt="wrong" class="no-border">');

				aa2 = 'conduction';

				answer1.find('#20').html('');
				answer1.find('#21').html('');
				answer1.find('#22').html('<img src="images/9/pot-with-cloud.jpg" width="70" alt="<?php echo _("Energy is transferred by the mass motion of molecules"); ?>">');
			}

			if ($('#30').html() != '') {
				$('tr.three').find('.feedback').html('<img src="images/misc/wrong.png" alt="Correct" class="no-border">');
				aa3 = 'convection';

				answer1.find('#30').html('<img src="images/9/hand-near-fire.jpg" width="70" alt="<?php echo _("Energy is transferred by electromagnetic radiation"); ?>">');
				answer1.find('#31').html('');
				answer1.find('#32').html('');
			} else if ($('#31').html() != '') {
				$('tr.three').find('.feedback').html('<img src="images/misc/correct.png" alt="wrong" class="no-border">');

				aa3 = 'radiation';

				answer1.find('#30').html('');
				answer1.find('#31').html('<img src="images/9/hand-near-fire.jpg" width="70" alt="<?php echo _("Energy is transferred by electromagnetic radiation"); ?>">');
				answer1.find('#32').html('');
			} else if ($('#32').html() != '') {
				$('tr.three').find('.feedback').html('<img src="images/misc/wrong.png" alt="wrong" class="no-border">');

				aa3 = 'conduction';

				answer1.find('#30').html('');
				answer1.find('#31').html('');
				answer1.find('#32').html('<img src="images/9/hand-near-fire.jpg" width="70" alt="<?php echo _("Energy is transferred by electromagnetic radiation"); ?>">');
			}

			ans1 = aa1 + ',' + aa2 + ',' + aa3;

			// Question 2

			if ( a2.is(':checked') ) ans2 = a2.val();

			else if ( b2.is(':checked') ) ans2 = b2.val();

			else if ( c2.is(':checked') ) ans2 = c2.val();

			else if ( d2.is(':checked') ) ans2 = d2.val();

			// Question 3

			if ( a3.is(':checked') ) ans3 = a3.val();

			else if ( b3.is(':checked') ) ans3 = b3.val();

			else if ( c3.is(':checked') ) ans3 = c3.val();

			if (answered == 0) {

				saveAnswer('heating-and-cooling-qc3-a', aa1);
				saveAnswer('heating-and-cooling-qc3-b', aa2);
				saveAnswer('heating-and-cooling-qc3-c', aa3);
				saveAnswer('heating-and-cooling-qc3-d', ans2);
				saveAnswer('heating-and-cooling-qc3-e', ans3);

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

