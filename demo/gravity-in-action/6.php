<?php
	/* Comment out line 4 and uncomment lines (5, 6, 7 and 10) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";

	//if($user->getType() == 2) $uf->updateStudentLastscreen(6, $_SESSION['smid']);
?>

<!DOCTYPE html>
<html <?php if ($language == 'ar_EG') echo 'dir="rtl"'; ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo _("Gravity in Action"); ?></title>

	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/locale.css">
	<link rel="stylesheet" href="css/jpreloader.css">
	<link rel="stylesheet" href="css/responsiveslides.css">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<?php if ($language == 'ar_EG') : ?>
		<link rel="stylesheet" href="css/grid_rtl.css">
	<?php else : ?>
		<link rel="stylesheet" href="css/grid.css">
	<?php endif; ?>

	<style>

		#s1a h4:nth-child(3) {
		    left: 43% !important;
		    top: 34% !important;
		}
		#s2a h4:nth-child(3) {
		    left: 41% !important;
		    top: 31% !important;
		}
		#s2a h4:nth-child(4) {
		    left: 82% !important;
		    top: 36% !important;
		}

		h1 { color: #D3486F; }

		.wrap { border-color: #e5c6ef; }
		.bg { background-image: url(assets/6/bg.jpg); }

		#s1a { position: relative; }
		#s1a img { height: 260px; }
		#s1a h4 { position: absolute; font-size: 18px; z-index: 2; text-align: center; line-height: 0.5; color: #000; }
		#s1a h4:first-child { left: -3%;   top: 5%; width: 45%}
		#s1a h4:nth-child(2) { left: 57%;   top: 5%;}
		#s1a h4:nth-child(3) { left: 41%; top: 30%; }
		#s1a h4:nth-child(4) { left: 83%; top: 40%; }
		.linea { margin-top: -75%; width: 60px;	height: 80%; margin-left: 2%;}
		.linea2 { margin-top: -75%; width: 100px;	height: 80%; margin-left: 35%;}
		.lineb { margin-top: -100%; width: 100px;	height: 80%; margin-left: 1%;}
		.lineb2 { margin-top: -100%; width: 100px;	height: 80%; margin-left: 26%;}
		#screen1 p {font-size: 20px;}
		.scrn1_p {margin: 5% auto;}

		#s2a { position: relative; }
		#s2a h4 { position: absolute; font-size: 20px; z-index: 2; text-align: center; line-height: 0.5; color: #000; }
		#s2a h4:first-child { left: -2%; top: 4%; width: 45%}
		#s2a h4:nth-child(2) { left: 57%; top: 4%; }
		#s2a h4:nth-child(3) { left: 40%; top: 29%; }
		#s2a h4:nth-child(4) { left: 83%; top: 34%; }

		#screen2 { display: none; }
		.rslides img {  margin: 45px auto;}
		.scrn2_pa { /* margin:35% 0; */ }
		.scrn2_pb {  margin:-50px 0; }
		
		#s2a img{ margin-bottom: 50px; }	
		.rslides{margin-top: -90px;}
		
		#buttons a.next { display: none; }

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) { 
			#s2a h4:nth-child(2) {  line-height: 1;   left: 63%;   top: 2%;}
			#s1a h4:nth-child(2) { line-height: 1;   left: 57%;   top: 2%;}
		}
		@media only screen and (max-width: 1250px) {
			#s2a h4 {  font-size: 18px;}
			p {font-size: 20px ;}
			.bg{ background-size:  100% calc(100% - 65px)!important;
				background-position: 0 34px; }
		}
		@media screen and (max-width: 960px){
			#screen1 p{margin:  3px 0; font-size: 17px;}
			#screen2 p{ font-size:  19px;}
		}

		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) {
		  #s1a h4:first-child {
		    left: -1% !important;
		    top: 4% !important
		  }
		  #s2a h4:first-child { left: 0%; }
		}
		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
			#s2a h4:first-child { left: -4%; }
			#s2a h4:nth-child(3) {
			    left: 43% !important;
			    top: 34% !important;
			}
			#s2a h4:nth-child(4) {
			    left: 83% !important;
			    top: 38% !important;
			}
		}

		<?php if($language == "es_ES") { ?>
			p {font-size: 22px}
			#s1a h4:first-child {  left: 0%;   top: 0%;   width: 50%;  line-height: 1;}
			#s1a h4:nth-child(2) {  top: -4%;   line-height: 1;}

			#s2a h4:first-child {  width: 50%;   line-height: 1;}
			#s2a h4:nth-child(2) {  top: -1%; line-height: 1;}

			@media screen and (max-width: 960px){
				#screen2 p{ font-size:  18px;}
			}
			@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
				#s2a h4:first-child { left: 0; }
			}
		<?php } ?>

		<?php if($language == "zh_CN") { ?>
			#s1a h4:nth-child(3) {
			    left: 43% !important;
			    top: 36% !important;
			    width: 80px;
			    line-height: 20px;
			}
			#s2a h4:nth-child(3) {
			    left: 41% !important;
			    top: 36% !important;
			}
			@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
			  #s1a h4:first-child {
			    left: -5% !important;
			    top: 4% !important
			  }
			}
		<?php } ?>
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_12">

					<div id="screen1" class="screen grid_12">
						<h1><?php echo _("More big ideas about... gravity in action"); ?></h1>

						<p><?php echo _("All objects exert a gravitational pull on other objects. This holds true in the case of the Earth’s moon. Just as the earth is pulling on the moon, the moon is pulling on the earth. <span class='key'>Ocean tides</span> are caused by the gravitational pull of the moon on the mass of water in the earth’s oceans. Because ocean water is a liquid and can move, it “bulges up” from the pull of the moon’s gravity towards the moon’s position on any given day."); ?></p>

						<p><?php echo _("A \"bulge\" of ocean water is created as the moon's gravity pulls in a direct line between the earth and the moon. The moon's gravitational pull is the strongest along a direct line between the earth and the moon. It is at that place a bulge of water occurs. That bulge is known as a <span class='key'>lunar tide</span>, which is also called high tide. The bulge is always found in that direct line, but as the earth rotates on its axis, the bulge is seen to move from east to west on Earth's surface."); ?></p>
	
						<div class="grid_7">
							<div id="s1a">
								
									<h4><?php echo _("Tidal bulge due to inertia"); ?></h4>
									<h4><?php echo _("Tidal bulge due to gravity"); ?></h4>
									<h4><?php echo _("Moon's <br><br> gravitational <br><br> pull"); ?></h4>
									<h4><?php echo _("Moon"); ?></h4>

								<img src="assets/6/s1a.jpg"> <!-- <img class="linea" src="assets/6/line.png"><img class="linea2" src="assets/6/line2.png"> -->
							</div>
						</div>
						
						<div class="grid_5">
							<p class="scrn1_p"><?php echo _("The green shows the relative magnitude of the forces – not the height of the water level changes. The actual change in water level from high tide to low tide is just a few feet."); ?></p>
						</div>

					</div>
					
					<div id="screen2" class="screen grid_12">						
						<div class="grid_12">
						<div class="grid_7">
							<div id="s2a">
							
								<h4><?php echo _("Tidal bulge due to inertia"); ?></h4>
								<h4><?php echo _("Tidal bulge due to gravity"); ?></h4>
								<h4><?php echo _("Moon's <br><br> gravitational <br><br> pull"); ?></h4>
								<h4><?php echo _("Moon"); ?></h4>
						
								<img src="assets/6/s1a.jpg"> <!-- <img class="lineb" src="assets/6/line.png"><img class="lineb2" src="assets/6/line2.png"> -->
							</div>
						</div>
						<div class="grid_5 mtop">					
							<p class="scrn2_pa"><?php echo _("The green shows the relative magnitude of the forces – not the height of the water level changes. The actual change in water level from high tide to low tide is just a few feet."); ?></p>
						</div>
						</div>
						<div class="grid_12">								
						<p class="grid_7 scrn2_pb">
						<?php echo _("There is also an ocean bulge on the other side of the earth that is opposite the moon on the same direct line. The two bulges are what cause high tides twice each day. The tidal bulge of water on the other side of the earth from the moon is caused by centrifugal force, also called inertia, from the earth spinning on its axis. Low tides are the areas of the earth’s oceans in-between the two high tide bulges."); ?></p>
							<div class="grid_5">								
								<ul class="rslides">
									<li><img src="assets/6/s2a.jpg"></li>
									<li><img src="assets/6/s2b.jpg"></li>
									<!--<li><img src="assets/6/s2c.jpg"></li>
									<li><img src="assets/6/s2d.jpg"></li>-->
								</ul>							
							</div>
						</div>

					</div>

						


				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="#" class="readmore" title="<?php echo _("Read More"); ?>"><i class="fa fa-comment"></i></a>
		<a href="7.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("High tide or low tide?"); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/responsiveslides.js"></script>

	<script>
		$(".rslides").responsiveSlides({
			auto: true,
			pager: false,
			nav: false,
			speed: 400
		});

		var hash = window.location.hash.slice(1);

		if (hash != "") {
			$('.screen').hide();
			$('#screen2').show();

			$('.back').fadeOut();

			$('.readmore').fadeOut(function() { 
				$('.next').fadeIn(); 
				$('.back').fadeIn();
			});
		}
		
		$('.back').click(function() {
			if ($('#screen1').is(':visible')) {
				document.location.href = "5.php";
			} else if ($('#screen2').is(':visible')) {

				$('.back').fadeOut();

				$('.next').fadeOut(function() { 
					$('.readmore').fadeIn(); 
						$('.back').fadeIn();
				});

				$('#screen2').fadeOut(function () {
					$('#screen1').fadeIn();

					window.location.hash = '';
				});
			} 
		});

		$('.readmore').click(function(){
			if ($('#screen1').is(':visible')) {

				$('.back').fadeOut();

				$('.readmore').fadeOut(function() { 
					$('.next').fadeIn(); 
					$('.back').fadeIn();
				});

				$('#screen1').fadeOut(function() {
					$('#screen2').fadeIn();

					window.location.hash = '#screen2';
				});
			}
		});
	</script>

	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
