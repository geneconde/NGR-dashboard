<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(6, $_SESSION['smid']);
?>

<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } if($language == "es_ES") { ?> dir="es" <?php } ?>>
<head>
<title><?php echo _("Solar Power"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/layerslider.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" href="styles/font-awesome.min.css">

<link rel="stylesheet"  href="styles/6.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<style>
	html, body {overflow: hidden;} 
	.wrap { overflow: hidden; }
	.wrap { border-left: 1px dashed #4DC0C0; border-right: 1px dashed #4DC0C0; }
	.bg { background: url('images/6/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
	#screen2, #screen3 { display: none; }
	#buttons .next { display:none; }
	.left { margin-top: 15px; width: 55%; float: left; }
	.pics { padding: 0; height: 165px; width: 85%; margin: 0 auto; text-align: center; }
	.pics > div { float: left; height: 90%; width: 235px; text-align: center; }
	.pics > div:nth-of-type(1), .pics > div:nth-of-type(2) { margin-right: 10px; }
	#fpic1, #fpic2 { position: relative; left: 5px; top: 0; }
	#spic1, #spic2 { position: relative; left: 5px; top: 0; }
	#tpic1, #tpic2 { position: relative; left: 5px; top: 0; }
	#fpic2, #spic2, #tpic2 { display: none; }
	.pics img { height: 100%; }
	div.pics img:not(#pic3) { margin-right: 10px; }
	#layerslider { margin: 0 auto; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; background: rgba(155,219,247,0.8); height: 290px; }
	#layerslider p { text-align: center; }

	#slide1 .ls-s1 {top: 230px !important;}
	#slide1 video { height: 228px; width:  383px; border: 5px solid white;
	-webkit-box-shadow: -1px -1px 15px rgba(50, 50, 50, 0.75);
	-moz-box-shadow:    -1px -1px 15px rgba(50, 50, 50, 0.6);
	box-shadow:         -1px -1px 15px rgba(50, 50, 50, 0.6); }

	#slide2 .ls-s1 {top: 232px !important;}
	#slide2 video { height: 228px; width: 410px; border: 5px solid white;
	-webkit-box-shadow: -1px -1px 15px rgba(50, 50, 50, 0.75);
	-moz-box-shadow:    -1px -1px 15px rgba(50, 50, 50, 0.6);
	box-shadow:         -1px -1px 15px rgba(50, 50, 50, 0.6); }
	#slide3 img { height: 200px; }
	#slide1 {width: 100% !important} #slide2 {width: 100% !important} #slide3 {width: 100% !important}
	.ls-glass .ls-nav-next { right: 0 !important;}
	.ls-glass .ls-nav-prev { left: 0 !important;}
	#screen2 p {font-size:22px;}
	html[dir="rtl"] h1 { font-size:34px; }

	#browse_adjust {margin-top: -20px;}
	.ls-s1 {font-size: 20px !important; width: 100%}

	#slide3 .ls-s1 {width: 36% !important;}
	#slide3 .ls-s3 {width: 36% !important;}
	#slide3 #md_s3_l3 {width: 100% !important;}
	#slide2 .ls-s1 {left: 0px !important;}

@media only screen and (min-device-width : 768px) and (max-device-height : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	.pics { width: 100% !important !important; }
	#slide1, #slide2, #slide3 { width: 100% !important; }
	.pics > div { width: 230px; }
	#vid1, #vid2 { left: 150px !important; }
	#slide3 img { height: 160px; }
	#slide3 img:nth-child(1) { left: 40px !important ; }
	#slide3 img:nth-child(2) { left: 450px !important ; }
	#slide3 img:nth-child(3) { left: 260px !important ; }
	#slide1 p { width: 700px; }
	html[dir="es"] #slide2 video { height: 140px; }
	html[dir="es"] #slide2 p { top: 258px !important; }

	#screen2 p, p {font-size:24px !important; }
	#screen2 #p_adjust {padding-top: 20px ;}
	#screen3 p {padding-top: 20px !important;}
	#slide2 .ls-s1 {left: 0px !important;}
	#slide1 video {left: 0px !important;}

	#layerslider {height: 256px !important;}
	.ls-inner {  height: 257px;}
} 
	@media only screen and (max-width: 1250px) {
		#screen2 p, p {font-size: 20px;}
		 #slide2 p {font-size: 18px;}
		#p_adjust {padding-top: 40px;}

		.pics > div {/*height:80%;*/height: 70%;}
		.pics img { /*width:90%;*/ width:75%; }

		#slide1 video {height: 140px;   width: 234px; left: 0px !important;}
		#slide2 video {  width: 246px;}
		#slide2 .ls-s1 {left: 0px !important;}
		#slide3 .ls-s1 {width: 30% !important;}
		#slide3 .ls-s3 {width: 30% !important;}
		#slide3 #md_s3_l3 {width: 100% !important;}

		#vid1 {margin-left: 37% !important; }
		.ls-s1 {margin-top:-97px !important; font-size: 18px !important;}
		#layerslider {height: 207px;}
		#slide2 video {height: 140px; left:290px !important;}
		#browse_adjust {margin-top: -50px;}

		#slide3 img:nth-child(1) { left: 160px !important; top:97px !important; height:150px;}
		#slide3 img:nth-child(2) { left: 482px !important; height:150px; top:90px !important; }
		#slide3 img:nth-child(3) { left: 335px !important;  height:150px;}
		#md_s3_l3 {margin-top:-55px !important; font-size: 18px !important;}
	
		#screen3 p {padding-top: 40px;}
	}

	@media only screen and (max-width: 1040px) {
		#screen2 p, p {font-size: 20px;}
		 #slide2 p {font-size: 18px;}

		.pics > div {/*height:80%;*/height: 70%; width: 215px;}
		.pics img { /*width:90%;*/ width:75%; }
	}

	@media only screen and (max-width: 978px) {
		#screen2 p, p {font-size: 20px;}
		 #slide2 p {font-size: 18px;}


		.pics > div {height: 70%; width: 200px;}
		.pics img {  width:75%; }
		#fpic1, #fpic2 {left: 5px;}
		#spic1, #spic2 {left: -15px;}
		#tpic1, #tpic2 {left: -15px;}
		.pics {width: 87%;}

		.ls-s1 {right:150px ;}

		#slide3 img:nth-child(1) { left: 95px !important; top:97px !important; height:150px;}
		#slide3 img:nth-child(2) { left: 435px !important; height:150px; top:90px !important; }
		#slide3 img:nth-child(3) { left: 285px !important;  height:150px;}
		#slide2 video {height: 140px; left:37% !important;}
	}

	@media only screen and (max-width: 760px) {
		#screen2 p, p {font-size: 18px !important;}
		#slide3 p, #slide1 p, #slide2 p {font-size: 16px !important;}
		.pics > div {/*height:80%;*/height: 70%; width: 200px;}
		.pics img { /*width:90%;*/ width:75%; }
		#fpic1, #fpic2 {left: 5px;}
		#spic1, #spic2 {left: -40px;}
		#tpic1, #tpic2 {left: -85px;}
		.pics {width:93%;}

		#slide1 video {left: 220px !important;}

		#slide1 p 	{right: 288px;}
		#slide2 p  {right:240px ;}
		#slide3 p {right:240px ; }

		#vid1 {margin-left: 0px !important;}
		#slide3 img:nth-child(1) { left: 70px !important; top:97px !important; height:150px;}
		#slide3 img:nth-child(2) { left: 392px !important; height:150px; top:90px !important; }
		#slide3 img:nth-child(3) { left: 248px !important;  height:150px;}
	}

	@media only screen and (max-width: 713px) {
		#screen2 p, p {font-size: 18px !important;}
		#slide3 p, #slide1 p, #slide2 p {font-size: 16px !important;}

		#vid1 {margin-left: -65px !important;}

		#slide1 p {right:320px ; }
		#slide2 p {right:345px ; }
		#slide3 p {right:345px ; }

		#slide2 video {height: 140px; left:145px !important;}
		.pics {width: 125%;}
		#slide3 img:nth-child(1) { left: 14px !important; top:97px !important; height:150px;}
		#slide3 img:nth-child(2) { left: 299px !important; height:150px; top:90px !important; }
		#slide3 img:nth-child(3) { left: 164px !important;  height:150px;}
	}




<?php if($language == "ar_EG") { ?>
	@media only screen and (max-width: 1250px) {
		#slide1 .ls-s1 {right: 0px;}
		#slide2 .ls-s1 {right: 0px;}
		#slide3 #md_s3_l3 {right: 0px;}
		#slide1 #vid1 {left: 0px !important;}
		#slide3 img:nth-child(1) {  right: 58%;}
		#slide3 img:nth-child(2) {  right: 10%;}
	}

	@media only screen and (max-width: 760px) {
		#slide1 #vid1 {left: 220px !important;}
	}
<?php } ?>

</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="screen1" class="screens">
				<h1><?php echo _("More big ideas... about solar power"); ?></h1>
				<p><?php echo _("The sun's energy drives many phenomena found on earth's surface. The water cycle and food chain both depend on solar energy to fully work properly. We depend on the sun every day, every time we eat in fact. We eat to get energy from food, and that energy was once energy from the sun that was captured by plants in the chemical process that forms plant. So if you trace the energy in food, it always starts with the sun."); ?></p>
				<div class="left">
					<p><?php echo _("For example, think about eating an apple. The apple has sugars that provide energy when you eat it. The apple gets its energy from the apple tree and the apple tree gets its energy from sun (and air and water) through a process called <span class='key'>photosynthesis.</span> This flow of energy from the sun to the apple can be represented with arrows:"); ?></p>
					<br>
					<p><?php echo _("Sun -> apple tree -> apple -> you!!!"); ?></p>
				</div>
			</div>
			<div id="screen2" class="screens">
				<p id = "p_adjust"><?php echo _("The <span class='key'>water cycle</span> also depends on solar energy. Water is found on Earth's surface as a liquid in lakes, rivers, streams and oceans and as a solid in glaciers, snow cover and ice."); ?></p>
				<div class="pics">
					<div>
						<img src="images/6/s2a.jpg" id="fpic1">
						<img src="images/6/s2d.jpg" id="fpic2">
					</div>
					<div>
						<img src="images/6/s2b.jpg" id="spic1">
						<img src="images/6/s2e.jpg" id="spic2">
					</div>
					<div>
						<img src="images/6/s2c.jpg" id="tpic1">
						<img src="images/6/s2f.jpg" id="tpic2">
					</div>
				</div>
				<p id = "browse_adjust"><?php echo _("Browse through the slides below by clicking the left and right arrows"); ?>.</p>
				<div id="layerslider-container">
					<div id="layerslider">
						<div id="slide1" class="ls-layer" style="slidedirection: top; position: relative; slidedelay: 6000;">
							<video id="vid1" loop class="ls-s3" style="top: 0; left: 220px; slidedirection: bottom; easingin: easeInOutBack; easingout: linear; delayin: 0; delayout: 0; durationin: 3000; durationout: 1200;">
								<source src="images/6/s2video1.webm" type="video/webm" />
							</video>
							<p class="ls-s1" style="top: 240px; left: 0; slidedirection: top; easingin: easeInOutBack; easingout: linear; delayin: 0; delayout: 0; durationin: 3000; durationout: 1200;"><?php echo _("The radiant energy of the sun heats water and causes it to <span class='key'>evaporate</span>—to change from a liquid into a water vapor."); ?></p>
						</div>
						<div id="slide2" class="ls-layer" style="slidedirection: top; position: relative; slidedelay: 6000;">
							<video id="vid2" loop class="ls-s3" style="top: 0; left: 220px; slidedirection: top; easingin: easeInOutBack; easingout: linear; delayin: 0; delayout: 0; durationin: 3000; durationout: 1200;">
								<source src="images/6/s2video2.webm" type="video/webm" />
							</video>
							<p class="ls-s1" style="top: 240px; left: 30px; slidedirection: bottom; easingin: easeInOutBack; easingout: linear; delayin: 0; delayout: 0; durationin: 3000; durationout: 1200;font-size:20px;"><?php echo _("The water vapor then rises into the air and collects in clouds. Eventually, the water vapor cools enough <span class='key'>condense</span> or change back into very small droplets of water."); ?></p>
						</div>
						<div id="slide3" class="ls-layer" style="slidedirection: top; position: relative; slidedelay: 6000;">
							<img class="ls-s1" src="images/6/s2g.png" id="pic1" style="top: 10px; left: 40px; slidedirection: right; easingin: easeInOutBack; easingout: linear; delayin: 500; delayout: 0; durationin: 1000; durationout: 1200;">
							
							<img class="ls-s1" src="images/6/s2i.png" id="pic3" style="top: 10px; left: 520px; slidedirection: left; easingin: easeInOutBack; easingout: linear; delayin: 500; delayout: 0; durationin: 1000; durationout: 1200;">
							
							<img class="ls-s3" src="images/6/s2h.png" id="pic2" style="top: 10px; left: 300px; slidedirection: top; easingin: easeInOutBack; easingout: linear; delayin: 1500; delayout: 0; durationin: 1000; durationout: 1200;">

							<p id = "md_s3_l3" class="ls-s1" style="top: 210px; left: 0px; slidedirection: bottom; easingin: easeInOutBack; easingout: linear; delayin: 500; delayout: 0; durationin: 3000; durationout: 1200;"><?php echo _("These small droplets collect into bigger droplets and fall back to earth's surface or <span class='key'>precipitate</span> as liquid rain or solid snow, hail, or sleet."); ?></p>
						</div>
					</div>
				</div>
				<p><?php echo _("The water cycle of evaporation, condensation and precipitation is driven by energy from the sun and operates continually."); ?></p>
			</div>
			<div id="screen3" class="screens">
				<p><?php echo _("Without the sun, there would be no water cycle. The water would not evaporate and clouds would not form.  More importantly, without the Sun, most if not all the water on Earth would simply freeze."); ?></p>
			</div>
		</div>
	</div>
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="#" class="readmore readmore-toggle" title="<?php echo _("Read More"); ?>"><i class="fa fa-comment"></i></a>
		<a href="7.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Catching solar energy"); ?></strong></section></section>
	<script src="scripts/jquery-easing-1.3.js"></script>
	<script src="scripts/layerslider.kreaturamedia.jquery.js"></script>
	<script>
	/* This template is set to 3 screens */
	var hash = window.location.hash.slice(1); // gets the hash when refreshed
	var screenCount = 3; // set number of screens here
	$(document).ready(function() {
		if(hash != "") { // if there is a set hash
			$('.screens').hide();
			$('#'+hash).show(function () {
				var screen = hash[hash.length -1]; // gets the screen number
				if(screen == screenCount) {
					$('.bg').css('background-image','url(images/6/bg2.jpg)');
					$('a.readmore-toggle').fadeOut(function(){ $('a.next-toggle').fadeIn(); });
				} else if (screen == 2) {
					playSlider();
				}
			});
		}
		
		/* Back Transition - change to the corresponding number of screens */
		$('a.back-toggle').click(function(){
			if($('#screen1').is(':visible')) {
				document.location.href = "5.php";
			} else if($('#screen2').is(':visible')) {
				$('#screen2').fadeOut(function (){
					$('#screen1').fadeIn();
					window.location.hash = '';
				});
			} else if($('#screen3').is(':visible')) {
				$('a.next-toggle').fadeOut(function() { $('a.readmore-toggle').fadeIn(); });
				$('#screen3').fadeOut(function (){
					$('.bg').css('background-image','url(images/6/bg.jpg)');
					$('#screen2').fadeIn(function() { playSlider(); });
					window.location.hash = '#screen2';
				});
			}
		});

		/* Read More Screen Transition */
		$('a.readmore-toggle').click(function(){
			if($('#screen1').is(':visible')) {
				$('#screen1').fadeOut(function(){
					$('#screen2').fadeIn();
					window.location.hash = '#screen2';
					playSlider();
				});
			} else if ($('#screen2').is(':visible')) {
				$('a.readmore-toggle').fadeOut(function() { $('a.next-toggle').fadeIn(); });
				$('#screen2').fadeOut(function(){
					$('.bg').css('background-image','url(images/6/bg2.jpg)');
					$('#screen3').fadeIn();
					window.location.hash = '#screen3';
				});
			}
		});
		
		setInterval('swapImages1()', 4000);
	});
	
	function swapImages1(){
	  if($('#fpic1').is(':visible')) {
		$('#fpic1').fadeOut(1000);
		$('#spic1').delay(300).fadeOut(1000);
		$('#tpic1').delay(600).fadeOut(1000);
		$('#fpic2').delay(1000).fadeIn(1000);
		$('#spic2').delay(1300).fadeIn(1000);
		$('#tpic2').delay(1600).fadeIn(1000);
	  } else {
		$('#fpic2').fadeOut(1000);
		$('#spic2').delay(300).fadeOut(1000);
		$('#tpic2').delay(600).fadeOut(1000);
		$('#fpic1').delay(1000).fadeIn(1000);
		$('#spic1').delay(1300).fadeIn(1000);
		$('#tpic1').delay(1600).fadeIn(1000);
	  }
	}
	
	function playSlider() {
		$('#layerslider').layerSlider({
			skinsPath : 'layerslider/skins/',
			skin : 'glass',
			animateFirstLayer : true,
			autoStart : false,
			navStartStop : false,
			navButtons : false,
			responsive : false,
			slideDelay : 0,
			loops : 0
		});
		$('#vid1').get(0).play();
		$('#vid2').get(0).play();
	}
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
