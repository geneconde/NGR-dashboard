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
		h1 { color: #28CDFC; }
		p { text-align: left; }

		.image { margin-top: 30px; }
		.image img { margin-right: 20px; }
		.image img:last-child { margin-right: 0; }

		.bg { background-image: url('images/6/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		#screen2 { display: none; overflow: hidden; }
		#screen2 img { margin: 10px 10px; float: left; }
		#screen2 p:first-child { margin-top: 10px; float: left; width: 70%; }
		#jquery_jplayer_1 {margin:0 auto;}
		html[dir="rtl"] p { text-align: right; }
		#dp_swf_engine { display: none; }

		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (-webkit-min-device-pixel-ratio: 1) {
			#screen2 { padding-top: 30px; }
			#screen2 p:first-child { width: 65%; }
			#jp_video_0 {width: 542px !important ;height: 300px !important;}
			#screen2 #pic_top {margin: 15px 10px; height:330px;}
			#screen2 #pic_bot {margin: 3px 10px;}
		}	

		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
			.image {margin-top:10px;}
			#jp_video_0 {width: 542px !important ;height: 300px !important;}
			#screen2 #pic_top {margin: 40px 10px; height:280px;}
			#screen2 #pic_bot {margin: 3px 10px; height: 145px;}
			#screen2 p:first-child {margin-top:40px;}
			#screen2 .bg {overflow: overlay;}
		}	

		#buttons .next { display: none; }

	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="screen1">
				<h1><?php echo _("More big ideas... about heating and cooling"); ?><span id="ans"></span></h1>
				
				<p><?php echo _("Other forms of energy can be changed into heat energy.  Wood and natural gas can be burned to produce heat for your home. Electricity can be used to create heat in your toaster, oven or microwave to cook your food. Pressing your hands together and rubbing back and forth quickly produces heat energy. This heat is produced by <span class='key'>friction</span>, the force between two things or surfaces that rub together. Since there is always friction when two things rub together, there is always heat energy generated."); ?></p>
				
				<div class="image">
					<div id="jquery_jplayer_1"></div>
					<div id="jp_container_1"></div>
				</div>
			</div>

			<div id="screen2">
				<p><?php echo _("When we add heat to a substance, the substance changes in some way. For example,  by adding heat to an ice cube it causes it to change from a solid to a liquid. In this case only the form has changed. This is called a <span class='key'>physical change</span>. But sometimes heat can change a substance into a new substance. This is called a <span class='key'>chemical change</span>. The new substance  has a different chemical composition with different properties. When we turn batter into a pancake, we are using  heat to cook and chemically change the batter ingredients into something different -- a pancake."); ?></p>

				<img id = "pic_top" src="images/6/physical.gif" alt="Physical change">
				<div class="clear"></div>
				<img id = "pic_bot" src="images/6/chemical.gif" alt="Chemical change">
				
				<p><br/><?php echo _("In a physical change, we can often reverse the change. In the example of heating an ice cube, we can reverse it and freeze the water again. But in a chemical change, we often cannot reverse the change. In the example of making pancakes, we can't change the pancakes back into batter again."); ?></p>
			</div>
		</div>	
	</div>

	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="#" class="readmore readmore-toggle" title="<?php echo _("Read More"); ?>"><i class="fa fa-comment"></i></a>
		<a href="12.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	
	<section id="preloader"><section class="selected"><strong><?php echo _("Rubbing hands..."); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/saveanswer.js"></script>
	<script src="scripts/jquery.jplayer.min.js"></script>
	<script src="scripts/rightclick.js"></script>
	<script>
		$("#jquery_jplayer_1").jPlayer({
	   ready: function () {
		$(this).jPlayer("setMedia", {
		 webmv: "images/6/match.webm",
		 m4v: "images/6/match.m4v"		 
		}).jPlayer("play");
	   },

	  ended: function() { // The $.jPlayer.event.ended event
		$(this).jPlayer("play"); // Repeat the media
	  },

	   swfPath: "scripts",
	   supplied: "webmv, m4v",
	    size: {
				 width: "640",
				 height: "360px"
			},
	   solutions: "flash, html",
	    nativeVideoControls: {
            all: /./
        }
	  });
	
		var check = $('img.check'),
			back = $('a.back'),
			next = $('a.next'),
			more = $('a.readmore'),

			screen1 = $('#screen1'),
			screen2 = $('#screen2');

		more.on('click', function() {
			screen1.fadeOut(function() {
				screen2.fadeIn();
				window.location.hash = "#screen2";
			});
			more.fadeOut(function() { next.fadeIn(); });
		});

		back.on('click', function() {
			if (screen1.is(':visible')) { document.location.href = "5.php"; }

			else {
				screen2.fadeOut();
				screen1.fadeIn();
				
				next.fadeOut(function() {
					more.fadeIn();
				});

				removeHash();
			}
		});

		var curURL = window.location.toString();
		var oldURL = document.referrer;

		var hash = "";

		if ( curURL.indexOf("#screen2") != -1 || oldURL.indexOf("7.php") != -1 ) {
			screen1.fadeOut(function() { 
				screen2.fadeIn(); 
			});

			more.fadeOut(function() {
				next.fadeIn(); 
			});

			window.location.hash = "#screen2";
		}
	</script>
	<?php include("temp-setlocale.php"); ?>
</body>
</html>
