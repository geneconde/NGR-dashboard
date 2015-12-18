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
		h1 { font-size: 27px; }
		#buttons .next { display: none; }

		.image { margin-top: 20px; }
		.image img { margin-right: 20px; }
		.image img:last-child { margin-right: 0; }

		.bg { background-image: url('images/12/bg.png'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }

		#screen2 { display: none; }
		#screen2 h2 { padding-top: 20px; }

		#answer {
			width: 60%;
			margin: 30px auto 0;
			padding: 10px;
			display: block;
			border: 0;
			outline: none;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			border-radius: 10px;
			font-family: PlaytimeRegular;
			font-size: 20px;
		}
		
		.instruction {
			background-color: rgba(166, 225, 255, 0.7);
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
			margin-bottom: 10px;
			padding: 10px;
		}
		#dp_swf_engine { display: none; }

		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (-webkit-min-device-pixel-ratio: 1) {
			#screen2 { padding-top: 30px; }
			h2, p, li {font-size:20px !important;}
		}	
		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
			#screen2 h2 {padding-top:40px;}
			.image img {height: 200px;}
		}
		div#screen2 {
		    padding-top: 40px !important;
		}
		@media only screen and (max-width: 1250px) {
			div#screen2 {
			    padding-top: 65px !important;
			}
		}
		@media only screen and (max-width: 960px) {
			#answer1 h2 {
			    line-height: 18px;
			    font-size: 19px !important;
			}
		}

	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div>
				<div id="screen1">
					<h1><?php echo _("Using what you know... about heating and cooling... to solve a problem"); ?></h1>

					<h2 class="center"><?php echo _("The Situation"); ?></h2>
					
					<p class="instruction"><?php echo _("You are an engineer at a company that just purchased a new aluminum radiant barrier product. The product is in the shape of flat panels made with a layer of laminated aluminum film on one side. You are assigned the task of applying this new product to keep the company building cool in the hot summer days."); ?></p>
				
					<div class="image">
						<img src="images/12/img1.jpg" alt="Aluminum barrier">
						<img src="images/12/img2.jpg" alt="Aluminum barrier">
					</div>
				</div>
				
				<div id="screen2">
					<h2 class="center"><?php echo _("Your Task"); ?></h2>			
					<p class="instruction"><?php echo _("How would you go about installing the panels to keep the company building cool in the hot summer days? Explain why your installation plan will keep the building cool."); ?></p>
					
					<textarea id="answer" cols="60" rows="11" placeholder="<?php echo _("Click here to start typing your answer..."); ?>"></textarea>
				</div>
			</div>
		</div>
	</div>
	
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="#" class="readmore readmore-toggle" title="<?php echo _("Read More"); ?>"><i class="fa fa-comment"></i></a>
		<a href="13.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	
	<section id="preloader"><section class="selected"><strong><?php echo _("Aluminum deliveries coming up!"); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/saveanswer.js"></script>
	<script src="scripts/rightclick.js"></script>
	<script>

		var answered = 0;
		
		var check = $('a.checkanswer'),
			back = $('a.back'),
			next = $('a.next'),
			more = $('a.readmore'),

			screen1 = $('#screen1'),
			screen2 = $('#screen2');

		more.on('click', function() {
			screen1.fadeOut(function() { 
				screen2.fadeIn(); 
				window.location.hash = "#task";
			});
			more.fadeOut(function() { next.fadeIn(); });
		});

		back.on('click', function() {
			if (screen1.is(':visible')) { document.location.href = "6.php"; }
			else {
				screen2.fadeOut(function() {
					screen1.fadeIn();
					more.fadeIn(function() { next.fadeOut(); });
					removeHash();
				});
				
			}
		});

		next.on('click', function() { if ($("#answer").val() == '') {
				alert('<?php echo _("Please type your answer."); ?>');
				return false;
			} else {
				save();
				document.location.href = "13.php"; 
			} });

		var curURL = window.location.toString();
		var oldURL = document.referrer;

		var hash = "";

		// if (curURL.indexOf("#screen2") != -1 || oldURL.indexOf("13.php") != -1) {
		// 	screen1.fadeOut(function() { screen2.fadeIn(); });
		// 	more.fadeOut(function() { next.fadeIn(); });
		// 	window.location.hash = "#task";
		// }

		function save() {
			var answer = $('#answer').val();			
			if (answered == 0) {
				localStorage.setItem("problem-solving", answer);
				saveMeta('heating-and-cooling',answer);
				answered = 1;
			}
		}
	</script>
	<?php include("temp-setlocale.php"); ?>
</body>
</html>
