<?php
	/* Comment out line 4 and uncomment lines (5, 6, 7 and 10) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";

	//if($user->getType() == 2) $uf->updateStudentLastscreen(4, $_SESSION['smid']);
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
		h1 { color: #C76565; }

		.wrap { border-color: #82c4de; }
		.bg { background-image: url(assets/4/bg.jpg); }
		
		p { font-size:.94em; }
		<?php if($language == 'es_ES'){ ?>
			#screen1 h1{ font-size:  30px;}
			#screen1 p{ margin: 5px 0;}
			#screen1 {font-size:  22px;}
			.rslides img{height:  200px;}
		<?php }	?>
			//.rslides li:nth-child(4) .caption { font-size: 16px; }
		.rslides { position: relative; }
		.rslides img { position: relative; z-index: 1; }
		.rslides .caption { position: absolute; bottom: 10px; z-index: 2; background: rgba(255, 255, 255, .8); border-bottom-left-radius: 4px; border-bottom-right-radius: 4px; padding: 5px 10px; }

		#screen2 { display: none; }

		#s2a { position: relative; }
		#s2a p { position: absolute; font-size: 16px; z-index: 2; width: 50px; text-align: center; line-height: 1; background-color: Chocolate; padding: 2px; border-radius: 5px; color: PapayaWhip; }

		#s2a p:nth-child(1) { top: 39%; left: 50%; }
		#s2a p:nth-child(2) { top: 46%; left: 45%; width: 94px; }
		#s2a p:nth-child(3) { top: 53%; left: 45%; width: 156px; }
		#s2a p:nth-child(4) { bottom: 17%; left: 27%; }
		#s2a p:nth-child(5) { bottom: 10%; left: 21%; width: 94px; }
		#s2a p:nth-child(6) { bottom: 3%; left: 19%; width: 165px; }

		#s2a img { position: relative; z-index: 1; }
		
		.caption { font-size: 19px; }

		#buttons a.next { display: none; }
		
		.rslides img { height: 220px; }

		@media only screen and (max-width: 1250px) {#screen2 img {  margin-left: 8%;   width: 80%;} #s2a p {  font-size: 14px;}.bg{ background-size:  100% calc(100% - 65px)!important; background-position: 0 34px; } .rslides img{height:  200px;}}
		@media screen and (max-width: 750px){
			#screen1 h1{ font-size:  28px;}
			#screen1 p{ font-size:  18px; margin: 5px 0;}


		}
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_12">

					<div id="screen1" class="screen">
						<h1 class="grid_12"><?php echo _("Reviewing big ideas about... gravity in action"); ?></h1>

						<p class="grid_12"><?php echo _("A <span class='key'>force</span> is a push or a pull. For example, you have to exert a force to push your friend on a swing or to pull them in a wagon. <span class='key'>Gravity</span> is also a force, but it is special in several ways. Gravity acts only to pull objects toward each other, whether the objects are touching or not."); ?></p>

						<p class="grid_7"><?php echo _("There are two factors that affect how much the force of gravity will pull two or more objects together. The first factor is the masses of the objects involved. The more massive the objects are, the greater the gravitational force between them will be. For example, the gravitational force between a 10kg and a 5kg object is twice as strong as between two 5 kg objects; and the gravitational force between two 10kg objects is four times as strong as between two 5 kg objects."); ?></p>

						<div class="grid_5">
							<ul class="rslides">
								<li><img src="assets/4/s1a.jpg"><!--<span class="caption"><?php echo _("Massive objects exert a stronger pull than less massive objects."); ?></span>--></li>
								<!-- <li><img src="assets/4/s1b.jpg"><span class="caption"><?php echo _("Massive objects exert a stronger pull than less massive objects."); ?></span></li> -->
								<!-- <li><img src="assets/4/s1c.jpg"><span class="caption"><?php echo _("Massive objects exert a stronger pull than less massive objects."); ?></span></li> -->
								<li><img src="assets/4/s1d.jpg"><!--<span class="caption"><?php echo _("Massive objects exert a stronger pull than less massive objects."); ?></span>--></li>
							</ul>
							<span class="caption"><?php echo _("Massive objects exert a stronger pull than less massive objects."); ?></span>
						</div>

						<div class="clear"></div>

						<p class="grid_12"><?php echo _("The force of gravity between objects is measured in <span class='key'>Newtons</span>. If one object is many times more massive than another object, we refer to the gravitational force on the smaller object as its weight. So when you weigh yourself on a standard bathroom scale, your weight is the gravitational force between you and the Earth."); ?></p>
					</div>

					<div id="screen2" class="screen">
						<div class="grid_5">
							<div id="s2a">
								<p><?php echo _("Moon"); ?></p>
								<p><?php echo _("Mass = 72 kg."); ?></p>
								<p><?php echo _("Weight = 12 kg. (26 lbs.)"); ?></p>
								<p><?php echo _("Earth"); ?></p>
								<p><?php echo _("Mass = 72 kg."); ?></p>
								<p><?php echo _("Weight = 72 kg. (158 lbs.)"); ?></p>

								<img src="assets/4/s2a.jpg">
							</div>
						</div>

						<p class="grid_7"><?php echo _("Astronauts weigh much less on the moon than on Earth because the moon’s mass is much smaller than the mass of the earth. So the gravitational force between the moon and a person is less than the gravitational force between the earth and that same person."); ?></p>

						<div class="clear"></div>

						<p class="grid_8"><?php echo _("The second factor affecting gravitational force is the distance between objects. The farther away two objects are from each other, the weaker the gravitational force is between them. The closer they are, the stronger the force is. So, unlike pushing or pulling a wagon where you have to be in contact with the wagon, the gravitational force between objects acts across distance—the objects don't have to touch!"); ?></p>

						<div class="grid_4">
							<img src="assets/4/s2b.jpg">
							<span class="caption"><?php echo _("Given equal masses, objects that are far apart exert less gravitational force on each other than objects that are close together."); ?></span>
						</div>

						<div class="clear"></div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="#" class="readmore" title="<?php echo _("Read More"); ?>"><i class="fa fa-comment"></i></a>
		<a href="5.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Pushing the swing..."); ?></strong></section></section>

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
				document.location.href = "3.php#answer";
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
