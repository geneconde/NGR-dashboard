<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(14, $_SESSION['smid']);
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
	<link rel="stylesheet" href="css/modalcomponent.css" />
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<style>
		html, body {overflow: hidden;}
    h1 { font-size: 34px; }    

		button {
			border: none;
			border-image-source: initial;
			border-image-slice: initial;
			border-image-width: initial;
			border-image-outset: initial;
			border-image-repeat: initial;
			padding: 1em 2em;
			background: #66a2d6;
			color: #fff;
			font-family: 'PlaytimeRegular';
			font-size: 15px !important;
			letter-spacing: 1px;
			text-transform: uppercase;
			cursor: pointer;
			display: inline-block;
			margin: 1% 0;
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
		}

		.md-content { background: #d0ebff; }
		.md-content p { font-size: 16px; }
		.md-content h3 { background: #66A2D6; color: #fff; }

		.small { font-size: 18px; }
		.smaller { font-size: 16px; }

		h3 { font-size: 24px !important; }
		p { font-size: 20px; }

		.column { 
			width: 80%; 
			text-align: center; 
			margin: 10% auto;
		}

		.bg { background-image: url('images/14/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		#dp_swf_engine { display: none; }
		@media only screen and (max-width: 1250px) {
			h2, p, li, .md-content h3 {font-size:20px !important;}
			.md-content > div p  {font-size: 15px !important;}
		}
	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div>
				<h1><?php echo _("Reviewing key vocabulary related to... heating and cooling"); ?></h1>
				
				<div class="md-modal md-effect" id="modal-1">
					<div class="md-content">
						<h3><?php echo _("Heat"); ?></h3>
						<div>
							<img src="images/14/heat.jpg" alt="Heat">
							<p><?php echo _("Heat is the energy that moves from a hotter to a colder substance. Heat energy causes the particles of a substance to wiggle or vibrate faster if the particles are fixed in a place or to move around faster if the particles are free to move."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				
				<div class="md-modal md-effect" id="modal-3">
					<div class="md-content">
						<h3><?php echo _("Temperature"); ?></h3>
						<div>
							<img src="images/14/temperature.jpg" alt="Temperature">
							<p class="small"><?php echo _("How fast or slowly the tiny particles of matter vibrate or move around is called temperature. The faster the particles move, the higher the temperature is. The more slowly the particles move, the lower the temperature is."); ?></p>
							<p class="small"><?php echo _("How much heat energy is needed to raise or lower the temperature of matter depends on the amount of matter involved. The more matter there is, the more heat energy has to be exchanged to raise or lower the temperature."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				
				<div class="md-modal md-effect" id="modal-4">
					<div class="md-content">
						<h3><?php echo _("Friction"); ?></h3>
						<div>
							<img src="images/14/friction.jpg" alt="Friction">
							<p><?php echo _("Friction is the force between two things or surfaces that rub together. Since there is always friction when two things rub together, there is always heat energy generated."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				
				<div class="md-modal md-effect" id="modal-5">
					<div class="md-content">
						<h3><?php echo _("Physical change"); ?></h3>
						<div>
							<img src="images/14/physical-change.jpg" alt="Physical change">
							<p class="smaller"><?php echo _("When a substance goes through a physical change, only its form or appearance changes. Even though it may look different, it is still the same substance. For example, when water freezes, it turns to ice. The ice and the water are the same substance. Only their forms are different."); ?></p>
							<p class="smaller"><?php echo _("Another example is sawdust. If someone takes a saw and saws into wood, some of the wood breaks into tiny pieces and becomes sawdust. The sawdust is still wood. It is just wood in a different form. It has gone through a physical change."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				
				<div class="md-modal md-effect" id="modal-6">
					<div class="md-content">
						<h3><?php echo _("Chemical change"); ?></h3>
						<div>
							<img src="images/14/chemical-change.jpg" alt="Chemical change">
							<p><?php echo _("A chemical change is a change in the chemical composition of a substance to produce a new material with different properties. When we turn batter into a pancake, we are using heat to cook and chemically change the raw ingredients into something different."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				
				<div class="md-modal md-effect" id="modal-7">
					<div class="md-content">
						<h3><?php echo _("Conduction"); ?></h3>
						<div>
							<img src="images/14/conduction.jpg" alt="Conduction">
							<p><?php echo _("Conduction is the process by which heat energy flows from an object at a higher temperature that comes in contact with an object at a lower temperature. If you have ever picked up a spoon from a hot cup of chocolate, the spoon became hotter by conduction."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				
				<div class="md-modal md-effect" id="modal-8">
					<div class="md-content">
						<h3><?php echo _("Convection"); ?></h3>
						<div>
							<img src="images/14/convection.jpg" alt="Convection">
							<p><?php echo _("Heat can move from one place to another by convection. Convection is when heat energy moves when matter containing the heat moves like warm air rising. It is usually warmer near the ceiling of a room than on the floor because the warmer air rises to the ceiling by convection and cold air sinks to the bottom of the room. Warm water also rises and cold water sinks by convection."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				
				<div class="md-modal md-effect" id="modal-9">
					<div class="md-content">
						<h3><?php echo _("Radiation"); ?></h3>
						<div>
							<img src="images/14/radiation.jpg" alt="Radiation">
							<p class="smaller"><?php echo _("Radiation is any energy that is given off by a source and moves as waves, particles, or rays. There are many different types of radiation. Light and heat are both forms of radiation."); ?></p>
							<p class="smaller"><?php echo _("Some types of radiation can be very harmful to people, but other types of radiation can be helpful. A special type of radiation, called gamma radiation, can be used to help people fight diseases such as cancer. Gamma radiation kills cells, but when pointed directly at cancer cells, it can help a person fight off cancer by killing these diseased cells."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				
				<div class="md-modal md-effect" id="modal-10">
					<div class="md-content">
						<h3><?php echo _("Conductor"); ?></h3>
						<div>
							<img src="images/14/conductor.jpg" alt="Conductor">
							<p><?php echo _("A conductor is a material that easily transfers heat or electrical energy. Most metals are good conductors for both heat and electrical energy."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				
				<div class="md-modal md-effect" id="modal-11">
					<div class="md-content">
						<h3><?php echo _("Insulator"); ?></h3>
						<div>
							<img src="images/14/insulator.jpg" alt="Insulator">
							<p><?php echo _("An insulator is a material that does not easily transfer energy heat or electrical energy. The special mitten that you use to take something from the oven acts as an insulator."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				
				<div class="column">
					<button class="md-trigger md-setperspective" data-modal="modal-1"><?php echo _("Heat"); ?></button>
					<button class="md-trigger md-setperspective" data-modal="modal-3"><?php echo _("Temperature"); ?></button>
					<button class="md-trigger md-setperspective" data-modal="modal-4"><?php echo _("Friction"); ?></button>
					<button class="md-trigger md-setperspective" data-modal="modal-5"><?php echo _("Physical change"); ?></button>
					<button class="md-trigger md-setperspective" data-modal="modal-6"><?php echo _("Chemical change"); ?></button>
					<button class="md-trigger md-setperspective" data-modal="modal-7"><?php echo _("Conduction"); ?></button>
					<button class="md-trigger md-setperspective" data-modal="modal-8"><?php echo _("Convection"); ?></button>
					<button class="md-trigger md-setperspective" data-modal="modal-9"><?php echo _("Radiation"); ?></button>
					<button class="md-trigger md-setperspective" data-modal="modal-10"><?php echo _("Conductor"); ?></button>
					<button class="md-trigger md-setperspective" data-modal="modal-11"><?php echo _("Insulator"); ?></button>
				</div>

				<div class="md-overlay"></div>
			</div>
		</div>
	</div>
	
	<div id="buttons">
		<a href="13.php" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="15.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	
	<section id="preloader"><section class="selected"><strong><?php echo _("Words and explanations"); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/classie.js"></script>
	<script src="scripts/modalEffects.js"></script>
	<script src="scripts/rightclick.js"></script>
	<?php include("setlocale.php"); ?>
</body>
</html>
