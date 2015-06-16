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
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" type="text/css" href="styles/flexslider.css" />
<link rel="stylesheet" href="styles/font-awesome.min.css">

<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<style>
	html, body {overflow: hidden;} 
	.wrap { overflow: hidden; }
	.bg { background: url('images/10/bg.jpg') no-repeat; background-size: 100% 100% !important; width: 100%; height: 100%; position: relative; background-color: #000; }
	#screen2 { display: none; height: 100%; overflow: hidden; }
	#buttons .next { display:none; }
	/* img.next-toggle { display:none; } */
.left { float: left; width: 35%; margin-right: 10px; }
.left img { height: 100%; width: 100%; }
.right { float: right: width: 60%; }
.left2 { width: 65% !important; float: left; margin-right: 10px; }
.flex-container { width: 250px; z-index: 100; margin: 0 auto; padding-top: 10px; float: right; margin-right: 20px; }
.flex-next, .flex-prev { z-index: 999; background-image: linear-gradient(to bottom, #B8BD50, #97AC42); }
.flexslider { z-index: 99; background: #f9e8a2; }
.flexslider .slides { overflow: hidden; }
.flexslider .slides img { width: 234px !important; height: 347px !important; }
#screen2 p { padding: 10px 0 0 0; }
#screen2 .placeholder { width: 450px; height: 450px; margin: 2% auto; border-radius: 5px; position: relative; background: url(images/10/s2a.jpg) no-repeat; }
#screen2 .placeholder p { font-size: 20px; position: absolute; color: #fff; }
#screen2 .placeholder p:first-child { left: 225px; top: 0; }
#screen2 .placeholder p:nth-child(2) { left: 10px; top: 120px; }
#screen2 .placeholder p:nth-child(3) { right: 10px; top: 165px; }
#screen2 .placeholder p:last-child { right: 225px; top: 200px; }

html[dir="rtl"] h1 { font-size:34px; }
html[dir="rtl"] #screen2 p { font-size:22px; } 

@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	.left2 { width: 55% !important; }	#screen2 { height: auto; }	.flexslider {margin-top:0px !important;}	#screen2 p {margin-top: 10px !important;} #screen2 .placeholder p:first-child {  top: -15px !important; }
#screen2 .placeholder p:nth-child(2) { top: 120px !important; } #screen2 .placeholder p:nth-child(3) {  top: 165px !important; } #screen2 .placeholder p:last-child {  top: 200px !important; }
}	

@media only screen and (max-width: 1250px) {
	p {font-size: 20px} .flexslider {margin-top:-70px;} #screen2 p {margin-top: 40px} #screen2 .placeholder p:first-child {top:-50px;} 
	#screen2 .placeholder p:nth-child(2) {top:80px;}
	#screen2 .placeholder p:nth-child(3) {top:120px;}
	#screen2 .placeholder p:last-child {top:165px;}
}

@media only screen and (max-width: 900px) {
	.flexslider {margin-top: 0%;} .left img {width:90%;} .left2 {width:58% !important;} .flex-container {width:200px !important;} .flexslider .slides img {height: 300px !important;}
}

@media only screen and (max-width: 758px) {
	p {font-size: 18px;}
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
				<h1><?php echo _("More big ideas... about solar power"); ?></h1>
				<div class="left">
					<img src="images/10/s1a.jpg">
				</div>
				<div class="right">
					<p><?php echo _("Everyone knows it is hot in the summer and cold in the winter in the northern hemisphere even though the sun itself doesn't change. What everyone doesn't know is that the way the sun's light energy hits the earth, the shape of the earth and the tilt of the earth are what cause the different seasons."); ?></p>
				</div>
				<div class="clear"></div>
				<div class="left2">
					<p><?php echo _("Let's start with the way the light energy from the sun strikes the earth and the earth's shape. It is useful to think of the sun's light as traveling in <span class='key'>parallel rays</span> when they strike the earth. Because the earth is shaped like a ball, the parallel rays do not hit all places on the earth's surface at the same angle. At or near the earth's <span class='key'>equator</span>, the sun's rays hit the earth with the greatest energy--like a ball thrown directly at a wall. Light rays hitting the earth further and further away from the equator hit the earth with less and less energy—like a ball thrown at more and more of a glancing angle at a wall. The less energy striking that part of the Earth, the colder that part of the Earth is."); ?></p>
				</div>
				<div class="flex-container">
					<div class="flexslider">
						<ul class="slides">
							<li><img src="images/10/s1b.jpg"></li>
							<li><img src="images/10/s1c.jpg"></li>
							<li><img src="images/10/s1d.jpg"></li>
							<li><img src="images/10/s1e.jpg"></li>
						</ul>
					</div>
				</div>
			</div>
			<div id="screen2" class="screens">
				<p><?php echo _("The tilt of the earth on its axis is the reason we have different seasons. As the earth revolves around the sun, the tilt means different places on the earth receive more or less energy from the parallel rays that hit the earth. So when the earth is tilted with its north pole toward the sun, it is summer in the northern hemisphere and winter in the southern hemisphere. When the earth is tilted with its south pole toward the sun, it is just the opposite--summer in the southern hemisphere and winter in the northern hemisphere."); ?></p>
				<div class="placeholder">
					<p><?php echo _("Spring"); ?></p>
					<p><?php echo _("Summer"); ?></p>
					<p><?php echo _("Winter"); ?></p>
					<p><?php echo _("Autumn"); ?></p>
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
		<a href="11.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="#" class="readmore readmore-toggle" title="<?php echo _("Read More"); ?>"><i class="fa fa-comment"></i></a>
		<a href="11.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Changing seasons..."); ?></strong></section></section>
	<script src="scripts/jquery.flexslider-min.js"></script>
	<script>
	var hash = window.location.hash.slice(1);
	var screenCount = 2;
	$(document).ready(function() {
		if(hash != "") {
			$('.screens').hide();
			$('#screen2').show();
			$('a.readmore-toggle').fadeOut(function(){ $('a.next-toggle').fadeIn(); });
			//$('.bg').css('background','url(images/10/bg2.jpg)');
		}
		
		/* Back Transition - change to the corresponding number of screens */
		$('a.back-toggle').click(function(){
			if($('#screen1').is(':visible')) {
				document.location.href = "9.php";
			} else if($('#screen2').is(':visible')) {
				$('a.next-toggle').fadeOut(function() { $('a.readmore-toggle').fadeIn(); });
				$('#screen2').fadeOut(function (){
					//$('.bg').css('background','url(images/10/bg.jpg)');
					$('.bg').css('backgroundSize','100% 100%');
					$('#screen1').fadeIn();
					window.location.hash = '';
				});
			}
		});

		/* Read More Screen Transition */
		$('a.readmore-toggle').click(function(){
			if($('#screen1').is(':visible')) {
				$('a.readmore-toggle').fadeOut(function() { $('a.next-toggle').fadeIn(); });
				$('#screen1').fadeOut( function(){
					//$('.bg').css('background','url(images/10/bg2.jpg)');
					$('#screen2').fadeIn();
					window.location.hash = '#screen2';
				});
			}
		});
		
		$('#screen2').mousemove(function (e) {
            var backx = e.pageX - 325;
            var backy = e.pageY - 100;
            var backpos = backx + 'px ' + backy + 'px';
            $("#flashlight").css('top', backy);
            $("#flashlight").css('left', backx);
        });

		$('.flexslider').flexslider({
            animation: 'fade',
            controlsContainer: '.flexslider',
			controlNav: false
        });
	});
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
