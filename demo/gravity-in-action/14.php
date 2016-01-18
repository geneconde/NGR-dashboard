<?php
	/* Comment out line 4 and uncomment lines (5, 6, 7 and 10) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";

	//if($user->getType() == 2) $uf->updateStudentLastscreen(14, $_SESSION['smid']);
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
	<link rel="stylesheet" href="css/modalcomponent.css">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<style>
		h1 { color: #fff75c; margin-left: 3%; margin-right: 3%; }
		p { color: #fff; }

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) { h1 { font-size: 28px; } }

		.wrap { border-color: #1683b1; }

		.bg { background-image: url(assets/14/bg.jpg); }
		.bg > div { -moz-perspective: 600px; }

		.column { width: 95%; text-align: center; margin: 10% auto; }
		.md-content { background-color: #eee; }
		.md-content p { font-size: 16px; }
		.md-content img { width: 270px; height: 200px; }
		.md-content h3 { background-color: #e49b2a; color: #fff; }

		button {
			border: none;
			border-image-source: initial;
			border-image-slice: initial;
			border-image-width: initial;
			border-image-outset: initial;
			border-image-repeat: initial;
			padding: 10px 20px;
			background-color: #e49b2a; 
			color: #fff;
			font-size: 16px;
			letter-spacing: 1px;
			text-transform: uppercase;
			cursor: pointer;
			display: inline-block;
			margin: 1% 0;
			border-radius: 5px;
			outline: 0;
		}

		button:hover { background-color: #e45f2a; }
		@media screen and (max-width: 1250px){
		
			.bg{ background-size:  100% calc(100% - 65px)!important; background-position: 0 34px; }
		}
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div>
				<h1><?php echo _("Reviewing key vocabulary related to... gravity in action"); ?></h1>

				<div class="md-modal md-effect" id="modal-1">
					<div class="md-content">
						<h3><?php echo _("Gravity"); ?></h3>

						<div>
							<img src="assets/14/gravity.jpg"/>

							<p><?php echo _("The natural attraction of all matter to other matter. This force is directly proportional to the mass of the two objects, and indirectly proportional to their distance apart from one another."); ?></p>

							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-2">
					<div class="md-content">
						<h3><?php echo _("Force"); ?></h3>

						<div>
							<img src="assets/14/force.jpg"/>

							<p><?php echo _("An external effort which causes an object to undergo some sort of change. This change may be in its movement, direction, or construction, depending on the type of force applied, as well as the conditions of the object itself."); ?></p>

							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-3">
					<div class="md-content">
						<h3><?php echo _("Newton"); ?></h3>

						<div>
							<img src="assets/14/newtons.jpg"/>

							<p><?php echo _("A unit of measurement to describe force. Defined as the force of 1 kg*m/s<sup>2</sup>, or the force needed to accelerate one kilogram of matter one meter per second per second."); ?></p>

							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-4">
					<div class="md-content">
						<h3><?php echo _("Acceleration"); ?></h3>

						<div>
							<img src="assets/14/acceleration.jpg"/>

							<p><?php echo _("The rate a moving object’s velocity changes with time. How fast it speeds up, slows down, or changes direction."); ?></p>

							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-5">
					<div class="md-content">
						<h3><?php echo _("Lunar Tide"); ?></h3>

						<div>
							<img src="assets/14/lunartide.jpg"/>

							<p><?php echo _("The change in sea level due to the gravity of the moon, and to a smaller extent, the sun. The moon and sun's gravity pull on the water on Earth, altering sea levels depending on where they are."); ?></p>

							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-6">
					<div class="md-content">
						<h3><?php echo _("Satellite"); ?></h3>

						<div>
							<img src="assets/14/satellite.jpg"/>

							<p><?php echo _("An object that orbits a larger object in space. There are many man-made satellites orbiting the earth, but the moon is also an Earth satellite. Likewise, the earth is a satellite orbiting the sun."); ?></p>

							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-7">
					<div class="md-content">
						<h3><?php echo _("Celestial Body"); ?></h3>

						<div>
							<img src="assets/14/celestialbody.jpg"/>

							<p><?php echo _("A term used to describe any piece of solid matter that is not on Earth. A celestial body can be anything from a tiny asteroid, to a planet, to a star."); ?></p>

							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-8">
					<div class="md-content">
						<h3><?php echo _("Natural Satellite"); ?></h3>

						<div>
							<img src="assets/14/naturalsatellite.jpg"/>

							<p><?php echo _("An object that orbits a larger object in space, which was not put there by humans. Examples would include the moon orbiting Earth and the eight planets orbiting our sun."); ?></p>

							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-9">
					<div class="md-content">
						<h3><?php echo _("Velocity"); ?></h3>

						<div>
							<img src="assets/14/velocity.jpg"/>

							<p><?php echo _("An object's motion in a specific direction, described in units of distance traveled per unit of time and the direction of the motion. Example: A person ran at 2 meters per second, north by northwest."); ?></p>

							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="main">
						<div class="column">
							<button class="md-trigger md-setperspective" data-modal="modal-1"><?php echo _("Gravity"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-2"><?php echo _("Force"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-3"><?php echo _("Newton"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-4"><?php echo _("Acceleration"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-5"><?php echo _("Lunar Tide"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-6"><?php echo _("Satellite"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-7"><?php echo _("Celestial Body"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-8"><?php echo _("Natural Satellite"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-9"><?php echo _("Velocity"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-overlay"></div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="13.php" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="15.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Words and explanations"); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/modalEffects.js"></script>
	<script>var polyfilter_scriptpath = 'js/';</script>
	<script src="js/cssParser.js"></script>
	<script src="js/css-filters-polyfill.js"></script>
	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
