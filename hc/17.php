<?php 
	/*require_once '../../session.php';
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once 'locale.php';
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(17, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'heating-and-cooling-qq2-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;*/
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
		#buttons .next { display: none; }
		img { border: 0 !important; vertical-align: middle; }
		table { text-align: center; margin: 0 auto; table-layout:fixed; word-break: break-all; border-collapse: separate; border-spacing: 2px; }
		table td { overflow:hidden; padding: 10px; }
		th { background-color: lemonchiffon; padding: 3px; }
		td { background-color: pink; }
		th,td { -moz-border-radius: 10px; border-radius: 10px; word-wrap: break-word; text-align: center;}
		.bg { background-image: url('images/17/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		.images { float: right; margin-right: 10px; width: 40%; }
		#answer { display: none; }
		#A th, #B th, #C th, #D th { padding: 0 !important; }
		#A:hover td, #B:hover td, #C:hover td, #D:hover td { background-color: lightblue; cursor: pointer; }
		#dp_swf_engine { display: none; }
		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (-webkit-min-device-pixel-ratio: 1) {
			table { width: 90%; }
		}	
		@media only screen and (max-width: 1080) {
			h2, p, li {font-size:20px !important;}
			table td {padding:3px;}
			tr img {height:25px;}
		}

		@media only screen and (min-width: 600px) and (max-width: 1250px)  and (orientation : landscape)  and (-webkit-min-device-pixel-ratio: 1){
			h2, p, li {font-size:20px !important; padding:0px 0px;}
			#pic_adjust {height: 10px}
		}
		@media only screen and (min-width: 600px) and (max-width: 1250px)  and (orientation : landscape)  and (-webkit-min-device-pixel-ratio: 1){
			table td {padding:3px;}
			tr img {height:40px;}
		}
		h2, p, li {
		    font-size: 24px;
		    line-height: 25px;
		}
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #2"); ?></h1>

				<div class="images">
					<img src="images/17/hot-soup.jpg" alt="Hot Soup">
				</div>

				<p><?php echo _("A metal pot with hot soup in it is placed on a cool stone countertop as shown in the diagram at the right. The numbered arrows show different ways heat is transferred  in the system containing the pot, counter top and surrounding air."); ?></p>

				<!-- <p><img src="images/17/1.png"><?php echo _("Hot soup"); ?> <img src="images/17/2.png"><?php echo _("Cool countertop"); ?><img src="images/17/3.png"><?php echo _("Metal pot"); ?></p> -->
				
				<!-- <p><?php echo _("The numbered arrows show the transfer of heat from the pot of soup to the surrounding environment."); ?></p> -->
				<br>
				<h2><?php echo _("Which list correctly identiﬁes each method of heat transfer? Click the row to select an answer."); ?></h2>


				<table cellpadding="5px">
					<tr>
						<th>&nbsp;</th>
						<th><img src="images/17/1.png"></th>
						<th><img src="images/17/2.png"></th>
						<th><img src="images/17/3.png"></th>
					</tr>

					<tr id="A">
						<th><img src="images/17/a.png"></th>
						<td><?php echo _("conduction"); ?></td>
						<td><?php echo _("convection"); ?></td>
						<td><?php echo _("radiation"); ?></td>
					</tr>

					<tr id="B">
						<th><img src="images/17/b.png"></th>
						<td><?php echo _("convection"); ?></td>
						<td><?php echo _("conduction"); ?></td>
						<td><?php echo _("radiation"); ?></td>
					</tr>

					<tr id="C">
						<th><img src="images/17/c.png"></th>
						<td><?php echo _("radiation"); ?></td>
						<td><?php echo _("radiation"); ?></td>
						<td><?php echo _("convection"); ?></td>
					</tr>

					<tr id="D">
						<th><img src="images/17/d.png"></th>
						<td><?php echo _("convection"); ?></td>
						<td><?php echo _("conduction"); ?></td>
						<td><?php echo _("conduction"); ?></td>
					</tr>
				</table>
			</div>

			<div id="answer">
				<h1><?php echo _("Quiz Question #2"); ?> - <?php echo _("How did I do?"); ?></h1>
				<p class="center"><?php echo _("You answered..."); ?></p>
				<p class="center"><img src="images/17/hot-soup.jpg" alt="Hot Soup"></p>
				<div class="feedback"></div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="18.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Who wants soup?"); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/saveanswer.js"></script>
	<script src="scripts/rightclick.js"></script>
	<script>
		var myanswer = '', 
		answered = <?php echo $answered; ?>,
		question = $('#question'),
		answer = $('#answer'),
		check = $('a.checkanswer'),
		back = $('a.back'),
		a = $('#A'),
		b = $('#B'),
		c = $('#C'),
		d = $('#D');
		next = $('a.next');

		a.on('click', function() {
			$('td').css('background-color','pink');

			var kids = a.children();
			kids.css('background-color','lightblue');
			myanswer = "A";

			answer.find('.feedback').html('<p class="center"><img src="images/17/1.png"> — <?php echo _("conduction"); ?></p>' + '<p class="center"><img src="images/17/2.png"> — <?php echo _("convection"); ?></p>' + '<p class="center"><img src="images/17/3.png"> — <?php echo _("radiation"); ?></p>' + '<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. 1 is convection, 2 is conduction, and 3 is radiation."); ?></p>');
		});

		b.on('click', function() {
			$('td').css('background-color','pink');

			var kids = b.children();
			kids.css('background-color','lightblue');
			myanswer = "B";

			answer.find('.feedback').html('<p class="center"><img src="images/17/1.png"> — <?php echo _("convection"); ?></p>' + '<p class="center"><img src="images/17/2.png"> — <?php echo _("conduction"); ?></p>' + '<p class="center"><img src="images/17/3.png"> — <?php echo _("radiation"); ?></p>' + '<p class="green center"><img src="images/misc/correct.png" alt="Crrect" /> <?php echo _("Correct. 1 is convection, 2 is conduction, and 3 is radiation."); ?></p>');
		});

		c.on('click', function() {
			$('td').css('background-color','pink');

			var kids = c.children();
			kids.css('background-color','lightblue');
			myanswer = "C";

			answer.find('.feedback').html('<p class="center"><img src="images/17/1.png"> — <?php echo _("radiation"); ?></p>' + '<p class="center"><img src="images/17/2.png"> — <?php echo _("radiation"); ?></p>' + '<p class="center"><img src="images/17/3.png"> — <?php echo _("convection"); ?></p>' + '<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. 1 is convection, 2 is conduction, and 3 is radiation."); ?></p>');
		});

		d.on('click', function() {
			$('td').css('background-color','pink');

			var kids = d.children();
			kids.css('background-color','lightblue');
			myanswer = "D";

			answer.find('.feedback').html('<p class="center"><img src="images/17/1.png"> — <?php echo _("convection"); ?></p>' + '<p class="center"><img src="images/17/2.png"> — <?php echo _("conduction"); ?></p>' + '<p class="center"><img src="images/17/3.png"> — <?php echo _("conduction"); ?></p>' + '<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. 1 is convection, 2 is conduction, and 3 is radiation."); ?></p>');
		});

		check.on('click', function() {
			if (myanswer != '') {
				question.fadeOut(function() {
					answer.fadeIn();
					window.location.hash = "#answer";
				});
				check.fadeOut(function() { next.fadeIn(); back.fadeIn(); });
				save();
			} else {
				alert('<?php echo _("Please select your answer."); ?>');
			}
		});

		back.on('click', function() {
			if (question.is(':visible')) { document.location.href = "16.php"; }
			else {
				answer.fadeOut(function() { question.fadeIn(); });
				next.fadeOut(function() { check.fadeIn(); });
			}
		});

		function save() {			
			if (answered == 0) {
				saveAnswer('heating-and-cooling-qq2-a', myanswer);
				answered = 1;
			}	
		}
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
