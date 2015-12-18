<?php 
	require_once "../tempsession.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once "locale.php";
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?>  <?php } ?>>
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
		.canvas { border: 1px solid #fff; background: black; width: 300px; margin: 10px 30px 0 0; height: 160px; float: right; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius:10px; }

		.bg { background-image: url('images/5/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; z-index: 10; }
		.bg ul { padding-left: 20px; }
		.bg li { font-size: 22px; line-height: 23px; }

		#question1, #question2, #answer1, #answer2 {
			overflow: hidden;
			background-color: rgba(135, 206, 250, .3);
			margin: 0 auto;
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
			margin-bottom: 10px;
			padding: 0 10px;
			width: 97%;
		}

		#ans2 { padding-bottom: 10px; }

		#canvasA, #canvasB, #canvasC, #canvasD { display: none; }

		#question1 p { clear: both; }
		#question1 ul { width: 450px; float: left; }
		/*#question2 ul li input[type="radio"] {  z-index: 99; }*/

		#answers { display: none;  }
		#answers p { font-size: 24px; padding: 0; }
		
		#answers .canvas { margin: 0 auto; float: none; margin-bottom: 10px; }
		#answers canvas { display: block !important; }
		
		label { padding-left: 0px !important; cursor: pointer; }

		input[type="radio"] + label span {
			vertical-align: middle;
			display:inline-block;
			width:30px;
			height:30px;
			background:url('images/misc/water.png') no-repeat;
			cursor: pointer;
		}

		input[type="radio"]:checked + label span { background: url('images/misc/fire.png') no-repeat; }
		label:before { content: "" !important; margin-right: 0 !important; height: 0; }
		input[type="radio"] { display: none; }
		
		html[dir="rtl"] #question1 ul { width: 435px; }
		#dp_swf_engine { display: none; }
		
		.lang-menu {z-index:10;}
		
		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
			#question1 ul { width: 340px; }
			html[dir="rtl"] #question1 ul { float: right; width: 360px; padding: 0; }
			html[dir="rtl"] .canvas { float: right; }
		}	

		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
			.lang-menu {z-index:10;}
			.bg {overflow: overlay;}
			.md_adjust {width: 250px; height: 160px;}
			.canvas {width: 250px; height: 160px;}
		}	

		@media only screen and (max-width: 1040px) {
			h2, p, li {font-size:20px !important;}
			.md_adjust {width: 230px; height: 160px;}
			.canvas {width: 230px; height: 160px;}
			.bg li {line-height:10px;}
		}

		@media only screen and (max-width: 960px) {
			h2, p, li {font-size:18px !important;}
			.md_adjust {width: 200px; height: 150px;}
			.canvas {width: 200px; height: 150px;}
			.bg li {line-height:10px;}
		}
		
		@media only screen and (max-width: 768px) {
			h2, p, li {font-size:16px !important;}
			#question1 ul {  width: 410px;}
			.md_adjust {width: 180px; height: 130px;}
			.canvas {width: 180px; height: 130px;}
			.bg li {line-height:10px;}
		}
		@media only screen and (max-width: 600px) {
			h2, p, li {font-size:16px !important;}
			.md_adjust {width: 150px; height: 100px;}
			.canvas {width: 150px; height: 100px;}
			.bg li {line-height:10px;}
		}

		#buttons .next { display: none; }

<?php //if($language == "ar_EG") { ?>
	/* @media only screen and (max-width: 800px) {
		html[dir="rtl"] #question1 ul {width: 364px;}
		html[dir="rtl"]  label {font-size: 16px !important;}
	} */
<?php //} ?>

	</style>
</head>

<body onload="init();">
	<div class="wrap">
		<div class="bg">
			<div id="questions">
				<h1><?php echo _("Quick Check #1"); ?></h1>
				
				<div id="question1">
					<h2><?php echo _("Question A. How do molecules at warm temperatures differ from molecules at cool temperatures?"); ?></h2>
					
					<ul>			
						<li><input type="radio" name="q1" id="a1" value="A"><label for="a1"><span></span><?php echo _("A. At warm temperatures, molecules exchange electrons more."); ?></label> </li>
					
						<li><input type="radio" name="q1" id="b1" value="B"><label for="b1"><span></span><?php echo _("B. At warm temperatures, molecules become larger."); ?></label></li>
					
						<li><input type="radio" name="q1" id="c1" value="C"><label for="c1"><span></span><?php echo _("C. At warm temperatures, molecules move around faster."); ?></label></li>
					
						<li><input type="radio" name="q1" id="d1" value="D"><label for="d1"><span></span><?php echo _("D. At cold temperatures, molecules become smaller."); ?></label></li>
					</ul>
					
					<div class="canvas">
						<canvas class = "md_adjust" id="canvas" width="300" height="160"></canvas>
						<canvas class = "md_adjust" id="canvasA" width="300" height="160"></canvas>
						<canvas class = "md_adjust" id="canvasB" width="300" height="160"></canvas>
						<canvas class = "md_adjust" id="canvasC" width="300" height="160"></canvas>
						<canvas class = "md_adjust" id="canvasD" width="300" height="160"></canvas>
					</div>
				</div>

				<div id="question2">
					<h2><?php echo _("Question B. What is the difference between heat and temperature?"); ?></h2>

					<ul>
						<li><input type="radio" name="q2" id="a2" value="A"><label for="a2"><span></span><?php echo _("A. Temperature is related to the motion of the particles in a substance and heat is related to how much energy moves between substances at different temperatures."); ?></label></li>

						<li><input type="radio" name="q2" id="b2" value="B"><label for="b2"><span></span><?php echo _("B. Temperature is measured with a thermometer and heat is measured with a barometer."); ?></label></li>

						<li><input type="radio" name="q2" id="c2" value="C"><label for="c2"><span></span><?php echo _("C. There is no difference — heat and temperature are the same."); ?></label></li>

						<li><input type="radio" name="q2" id="d2" value="D"><label for="d2"><span></span><?php echo _("D. Heat refers to how hot a substance is but temperature measures both how hot or cold a substance is."); ?></label></li>
					</ul>
				</div>
			</div>

			<div id="answers">
				<h1><?php echo _("Quick Check #1"); ?> - <?php echo _("How did I do?"); ?></h1>
				
				<div id="answer1">
					<h2><?php echo _("Question A. How do molecules at warm temperatures differ from molecules at cool temperatures?"); ?></h2>
					<p class="center"><?php echo _("You answered..."); ?></p>

					<div id="ans1">
						<div class="canvas" id="feedback"></div>
						<p class="answer"></p>
					</div>
				</div>

				<div id="answer2">
					<h2><?php echo _("Question B. What is the difference between heat and temperature?"); ?></h2>
					<p class="center"><?php echo _("You answered..."); ?></p>

					<div id="ans2"></div>
				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="6.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>	

	<section id="preloader"><section class="selected"><strong><?php echo _("Preparing your first quick check!"); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/easeljs-NEXT.min.js"></script>
	<script src="scripts/createjs/events/Event.js"></script>
	<script src="scripts/createjs/events/EventDispatcher.js"></script>
	<script src="scripts/tweenjs/Tween.js"></script>
	<script src="scripts/tweenjs/Ease.js"></script>
	<script src="scripts/tweenjs/MotionGuidePlugin.js"></script>
	<script src="scripts/saveanswer.js"></script>
	<script src="scripts/rightclick.js"></script>
	<script>
		var answered = 0;

		var questions = $('#questions'),
			answers = $('#answers'),

			q1 = $('#question1').find('input[type=radio]'),
			q2 = $('#question2').find('input[type=radio]'),

			answer1 = $('#ans1'),
			answer2 = $('#ans2');

			check = $('a.checkanswer'),
			back = $('a.back'),
			next = $('a.next'),

			a1 = $('#a1'),
			b1 = $('#b1'),
			c1 = $('#c1'),
			d1 = $('#d1'),

			a2 = $('#a2'),
			b2 = $('#b2'),
			c2 = $('#c2'),
			d2 = $('#d2');

		check.on('click', function() {
			if (q1.is(':checked') && q2.is(':checked')) {
				if (a1.is(':checked')) answer1.find('.canvas').html($('#canvasA'));
				if (b1.is(':checked')) answer1.find('.canvas').html($('#canvasB'));
				if (c1.is(':checked')) answer1.find('.canvas').html($('#canvasC'));
				if (d1.is(':checked')) answer1.find('.canvas').html($('#canvasD'));

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
			if (questions.is(':visible')) {
				document.location.href = "4.php";
			} else {
				answers.fadeOut(function() {
					$('#question1').find('.canvas').prepend($('#canvasA'));
					$('#question1').find('.canvas').prepend($('#canvasB'));
					$('#question1').find('.canvas').prepend($('#canvasC'));
					$('#question1').find('.canvas').prepend($('#canvasD'));

					questions.fadeIn();
				});

				next.fadeOut(function() { check.fadeIn(); });
			}
		});

		q1.on('click', function() {
			var radio = $(this).val();
			if (radio == 'A') {
				answer1.find('.answer').html(
					'<p class="center"><?php echo _("A. At warm temperatures, molecules exchange electrons more."); ?></p>' + '<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. Temperature doesn’t have anything to do with electron exchanges."); ?></p>');
			} else if (radio == 'B') {
				answer1.find('.answer').html(
					'<p class="center"><?php echo _("B. At warm temperatures, molecules become larger."); ?></p>' + '<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. Molecules don’t change size at different temperatures."); ?></p>');
			} else if (radio == 'C') {
				answer1.find('.answer').html(
					'<p class="center"><?php echo _("C. At warm temperatures, molecules move around faster."); ?></p>' + '<p class="green center"><img src="images/misc/correct.png" alt="Correct" /> <?php echo _("Correct. As temperature rises, molecules move around faster."); ?></p>');
			} else if (radio == 'D') {
				answer1.find('.answer').html(
					'<p class="center"><?php echo _("D. At cold temperatures, molecules become smaller."); ?></p>' + '<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. Molecules don’t change size at different temperatures."); ?></p>');
			}
		});

		q2.on('click', function() {
			var radio = $(this).val();
			
			if (radio == 'A') {
				answer2.html(
					'<p class="center"><?php echo _("A. Temperature is related to the motion of the particles in a substance and heat is related to how much energy moves between substances at different temperatures."); ?></p>' +
					'<p class="green center"><img src="images/misc/correct.png" alt="Correct" /> <?php echo _("Correct. Temperature measures the motion of molecules, and heat is the total energy of the molecules."); ?></p>'
				);
			} else if (radio == 'B') {
				answer2.html(
					'<p class="center"><?php echo _("B. Temperature is measured with a thermometer and heat is measured with a barometer."); ?></p>' +
					'<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. A barometer measures the pressure of air in the atmosphere."); ?></p>'
				);
			} else if (radio == 'C') {
				answer2.html(
					'<p class="center"><?php echo _("C. There is no difference — heat and temperature are the same."); ?></p>' +
					'<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. Temperature measures the motion of molecules,and heat is the energy that moves from a substance at a higher temperature to a substance at a lower temperature."); ?></p>'
				);
			} else if (radio == 'D') {
				answer2.html(
					'<p class="center"><?php echo _("D. Heat refers to how hot a substance is but temperature measures both how hot or cold a substance is."); ?></p>' +
					'<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. Heat and temperature are related, but they are not the same thing."); ?></p>'
				);
			}
		});

		function save() {
			var answer1,
				answer2;				

			if (a1.is(':checked')) answer1 = a1.val();
			if (b1.is(':checked')) answer1 = b1.val();
			if (c1.is(':checked')) answer1 = c1.val();
			if (d1.is(':checked')) answer1 = d1.val();

			if (a2.is(':checked')) answer2 = a2.val();
			if (b2.is(':checked')) answer2 = b2.val();
			if (c2.is(':checked')) answer2 = c2.val();
			if (d2.is(':checked')) answer2 = d2.val();

			if (answered == 0) {
				localStorage.setItem("qc1-a", answer1);
				localStorage.setItem("qc1-b", answer2);
				
				saveAnswer('heating-and-cooling-qc1-a', answer1);
				saveAnswer('heating-and-cooling-qc1-b', answer2);

				answered = 1;
			}
		}
	</script>

	<script>
		var canvas,
			canvasA,
			canvasB,
			canvasC,
			canvasD;

		var stage;

		var a = document.getElementById('a1'),
			b = document.getElementById('b1'),
			c = document.getElementById('c1'),
			d = document.getElementById('d1');

		function init() {
			if (window.top != window) { document.getElementById("header").style.display = "none"; }

			createjs.MotionGuidePlugin.install(createjs.Tween);

			canvas = document.getElementById("canvas");
			canvasA = document.getElementById("canvasA");
			canvasB = document.getElementById("canvasB");
			canvasC = document.getElementById("canvasC");
			canvasD = document.getElementById("canvasD");

			stage = new createjs.Stage(canvas);
			stage.autoClear = true;

			var ball,
				count = 100,
				path,
				speed = 15000,
				size = 5;

			while (count--) {
				ball = new createjs.Shape();
				ball.graphics.ss(0,'round','round').s(('#000000')).f("#"+rc()+rc()+rc()).dc(0,0,size).ef().es();

				path = [ rx(0),ry(0),rx(0),ry(0),rx(0),ry(0) ];

				createjs.Tween.get(ball, {loop:true})
					.to({guide:{path:path, start:0, end:1}}, speed)
					.wait(Math.random()*4000)
					.to({guide:{path:path, start:1, end:0}}, speed);

				stage.addChild(ball);
			}

			createjs.Ticker.addEventListener("tick", stage);

			a.onclick = function() {
				canvas.style.display = 'none';
				canvasC.style.display = 'none';
				canvasB.style.display = 'none';
				canvasD.style.display = 'none';

				canvasA.style.display = 'block';

				stage = new createjs.Stage(canvasA);
				stage.autoClear = true;

				var ball,
					count = 300,
					path,
					speed = 1000,
					size = 10;

				while (count--) {
					ball = new createjs.Shape();
					ball.graphics.ss(0,'round','round').s(('#000000')).f("#"+rc()+rc()+rc()).dc(0,0,size).ef().es();

					path = [ rx(0),ry(0),rx(0),ry(0),rx(0),ry(0) ];

					createjs.Tween.get(ball, {loop:true})
						.to({guide:{path:path, start:0, end:1}}, speed)
						.wait(Math.random()*4000)
						.to({guide:{path:path, start:1, end:0}}, speed);

					stage.addChild(ball);
				}

				createjs.Ticker.addEventListener("tick", stage);

			}

			b.onclick = function() {
				canvas.style.display = 'none';
				canvasA.style.display = 'none';
				canvasD.style.display = 'none';
				canvasC.style.display = 'none';

				canvasB.style.display = 'block';

				stage = new createjs.Stage(canvasB);
				stage.autoClear = true;

				var ball,
					count = 20,
					path,
					speed = 1000,
					size = 40;

				while (count--) {
					ball = new createjs.Shape();
					ball.graphics.ss(0,'round','round').s(('#000000')).f("#"+rc()+rc()+rc()).dc(0,0,size).ef().es();

					path = [ rx(0),ry(0),rx(0),ry(0),rx(0),ry(0) ];

					createjs.Tween.get(ball, {loop:true})
						.to({guide:{path:path, start:0, end:1}}, speed)
						.wait(Math.random()*4000)
						.to({guide:{path:path, start:1, end:0}}, speed);

					stage.addChild(ball);

				}

				createjs.Ticker.addEventListener("tick", stage);

			}

			c.onclick = function() {
				canvas.style.display = 'none';
				canvasA.style.display = 'none';
				canvasB.style.display = 'none';
				canvasD.style.display = 'none';

				canvasC.style.display = 'block';

				stage = new createjs.Stage(canvasC);
				stage.autoClear = true;

				var ball,
					count = 100,
					path,
					speed = 1000,
					size = 10;

				while (count--) {
					ball = new createjs.Shape();
					ball.graphics.ss(0,'round','round').s(('#000000')).f("#"+rc()+rc()+rc()).dc(0,0,size).ef().es();

					path = [ rx(0),ry(0),rx(0),ry(0),rx(0),ry(0) ];

					createjs.Tween.get(ball, {loop:true})
						.to({guide:{path:path, start:0, end:1}}, speed)
						.wait(Math.random()*4000)
						.to({guide:{path:path, start:1, end:0}}, speed);

					stage.addChild(ball);
				}

				createjs.Ticker.addEventListener("tick", stage);

				// answer1.find('.canvas').html(canvasB);
			}

			d.onclick = function() {
				canvas.style.display = 'none';
				canvasB.style.display = 'none';
				canvasC.style.display = 'none';
				canvasA.style.display = 'none';

				canvasD.style.display = 'block';

				stage = new createjs.Stage(canvasD);
				stage.autoClear = true;

				var ball,
					count = 100,
					path,
					speed = 1000,
					size = 5;

				while (count--) {
					ball = new createjs.Shape();
					ball.graphics.ss(0,'round','round').s(('#000000')).f("#"+rc()+rc()+rc()).dc(0,0,size).ef().es();

					path = [ rx(0),ry(0),rx(0),ry(0),rx(0),ry(0) ];

					createjs.Tween.get(ball, {loop:true})
						.to({guide:{path:path, start:0, end:1}}, speed)
						.wait(Math.random()*4000)
						.to({guide:{path:path, start:1, end:0}}, speed);

					stage.addChild(ball);
				}

				createjs.Ticker.addEventListener("tick", stage);
			}
		}

		function rx(sp) { return Math.random() * 380 + sp; }
		function ry(sp) { return Math.random() * 380 + sp; }
		function rc() { return Math.round(Math.random() * 0xED + 0x12).toString(16); }
	</script>
	<?php include("temp-setlocale.php"); ?>

</body>
</html>
