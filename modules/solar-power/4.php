<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(4, $_SESSION['smid']);
?>

<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Solar Power"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" href="styles/font-awesome.min.css">


<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<style>
	html, body {overflow: hidden;} 
	.wrap { overflow: hidden; }
	.bg { background: url('images/4/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; background-color: #000; overflow: hidden; }
	
	#screen2 { display: none; height: 100%; }

	#buttons .next { display:none; }
	/*img.next-toggle { display:none; }*/
	p { color: #fff; }
	#flashlight {
		margin: 0 auto;
		max-width:900px;
		background: #fff url(images/4/bg2.jpg) no-repeat center; 
		background-attachment: fixed;
		background-size: 900px 100%;
		width: 200px; height: 200px;
		position: absolute;
		border-radius: 100%;
		overflow-y: hidden;
		overflow-x: hidden;
		z-index: 1;
		border: 5px solid #fff;
		top: 180px;
		left: 550px;
		color: #fff;
		text-align: center;
		cursor: none;
	}
	#text { position: absolute; background-color: rgba(255,255,255,0); z-index: 10; width: 95%; cursor: none; }
	#instruction { position: absolute; background-color: rgba(255,255,255,0); z-index: 10; bottom: 5px; cursor: none; }
	#instruction p { text-align: center; }

	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (-webkit-min-device-pixel-ratio: 1) {
		#text { z-index: 5; }
	}

	@media only screen and (max-width: 1250px) {
		p{font-size: 20px;}
		#screen2 p {padding: 40px 0px}
	}

	<?php if($language == "ar_EG") { ?>
	 .lang-menu ul {margin-right: -9999px !important} 
	.lang-menu ul {left: 9999px }
	<?php } ?>
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="screen1" class="screens">
				<h1><?php echo _("Reviewing big ideas... about solar power"); ?></h1>
				<p ><?php echo _("The sun is a large ball of exploding gas. The sun can be considered a giant nuclear power plant within the solar system. Inside the sun, atoms of hydrogen gas are constantly smashed together (or fused) to form another gas called helium. This is called <span class='key'>fusion</span>. When that happens, energy is released. Because the Sun is so large and contains so much material, the amount of energy released by this process is tremendous. The Sun <span class='key'>radiates</span>, or sends out, huge amounts of energy in all directions in space. While only a very small amount of that energy reaches us on Earth, it is just the right amount to meet the needs of life on Earth."); ?></p>

			</div>
			<div id="screen2" class="screens">
				<div id="flashlight"></div>
				<div id="text">
					<p ><?php echo _("The sun produces many different kinds of energy. In fact, the sun produces a wide <span class='key'>spectrum</span> (or range) of <span class='key'>radiant</span> energies that can move through empty space. Most of the radiant energy from the sun that reaches us on Earth is in the form of <span class='key'>visible light</span> and <span class='key'>infrared light</span>. The visible light from the sun gives us the colors (including white) that we see. Infrared light is a kind of heat light. It is not as energetic as visible light, but it is the most abundant kind of sunlight. People can't see infrared light without special \"night vision\" glasses, but some insects and some animals can see infrared light through special sense devices that act like eyes."); ?></p>
				</div>
				<div id="instruction">
					<p ><?php echo _("Move your mouse around the black screen to see the effect of night vision goggles and see what's hidden in the dark."); ?></p>
				</div>
			</div>
		</div>
	</div>
<!--
	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="readmore-toggle" src="images/buttons/readmore.png" title="<?php echo _('Read More'); ?>"></a>
		<a href="5.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="#" class="readmore readmore-toggle" title="<?php echo _("Read More"); ?>"><i class="fa fa-comment"></i></a>
		<a href="5.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Put on some sunblock"); ?></strong></section></section>
	<script>
	/* This is set to 2 screens */
	var hash = window.location.hash.slice(1),
		screenCount = 2,
		back = $('a.back-toggle'),
		readmore = $('a.readmore-toggle'),
		next = $('a.next-toggle'),
		screen1 = $('#screen1'),
		screen2 = $('#screen2'),
		bg = $('.bg');

		
	$(document).ready(function() {
		if(hash != "") {
			$('.screens').hide();
			screen2.show();
			readmore.fadeOut(function(){ next.fadeIn(); });
			bg.css('background','#000');
		}
		
		/* Back Transition - change to the corresponding number of screens */
		back.click(function(){
			if(screen1.is(':visible')) {
				document.location.href = "3.php#answer";
			} else if(screen2.is(':visible')) {
				next.fadeOut(function() { readmore.fadeIn(); });
				screen2.fadeOut(function (){
					bg.css('background','url(images/4/bg.jpg)');
					screen1.fadeIn();
					window.location.hash = '';
				});
			}
		});

		/* Read More Screen Transition */
		readmore.click(function(){
			if(screen1.is(':visible')) {
				readmore.fadeOut(function() { next.fadeIn(); });
				screen1.fadeOut( function(){
					bg.css('background','#000');
					screen2.fadeIn();
					window.location.hash = '#screen2';
				});
			}
		});
		
		$('#screen2').mousemove(function (e) {
			var width = $(window).width();
			var deduct = 0;
			
			if(width < 1224) deduct = 175;
			else if(width >= 1224 && width < 1366) deduct = 260;
			else if(width >= 1366 && width < 1517) deduct = 325;
			else if(width >= 1517 && width < 1820) deduct = 430;
			else if(width >= 1820) deduct = 550;
			
            var backx = e.pageX - deduct;
            var backy = e.pageY - 100;
			
            $("#flashlight").css('top', backy);
            $("#flashlight").css('left', backx);
        });

	});
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
