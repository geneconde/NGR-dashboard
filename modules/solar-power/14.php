<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(14, $_SESSION['smid']);
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
<link rel="stylesheet" type="text/css" href="styles/modalcomponent.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
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
*{ padding:0; margin:0; }
h1 { font-size: 34px;color:#458B29; margin-left: 3%; margin-right: 3%; padding-top:10px; }
.bg { background: url('images/14/bg.jpg') no-repeat; background-size: 100% 100%; width: 100% !important; height:100%; position: relative; }
.bg > div {width: 100%; -moz-perspective: 600px; height: 100%;}
.marleft {margin-left:33%;}
.column { width: 100%; margin: 10% auto; text-align: center; }
.md-content  { background: #EEC181; }
.md-content h3 { background: #868600; color: #fff; }
p { font-size: 16px; }
button:hover { background: rgba(228, 196, 68, 0.75); }
button {
	font-family: 'PlaytimeRegular';
	border: none;
	outline: 0;
	border-image-source: initial;
	border-image-slice: initial;
	border-image-width: initial;
	border-image-outset: initial;
	border-image-repeat: initial;
	padding: 1em 2em;
	background: #868600;
	color: rgb(255, 255, 255);
	font-size: 15px;
	letter-spacing: 1px;
	text-transform: uppercase;
	cursor: pointer;
	display: inline-block;
	margin: 1% 0;
	border-radius: 10px;
	text-align:center;
}

.md-content img { height: 200px; -webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;}

html[dir="rtl"] h1 { font-size:32px; } 
<?php if($language == "es_ES") { ?>
		h1 { font-size:32px; }
<?php } ?>
	<?php if($language == "ar_EG") { ?>
	 .lang-menu ul {margin-right: -9999px !important} 
	.lang-menu ul {left: 9999px }
	<?php } ?>

@media only screen and (max-width: 1250px) {
.md-content h3 {font-size: 20px !important;}
.md-content > div p {font-size: 18px !important;}
button {font-size: 14px !important;}
}


</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div>
				<h1><?php echo _("Reviewing key vocabulary... related to solar power"); ?></h1>
				<div class="md-modal md-effect" id="modal-1">
					<div class="md-content">
						<h3><?php echo _("Spectrum"); ?></h3>
						<div>
							<img src="images/14/spectrum.jpg"/>
							<p><?php echo _("The spectrum of energy is its range of types, or frequencies. The sun has a wide spectrum of radiant energies that can move through empty space."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-2">
					<div class="md-content">
						<h3><?php echo _("Radiate"); ?></h3>
						<div>
							<img src="images/14/sun.png"/>
							<p><?php echo _("To radiate is to emit energy through space. The sun radiates infrared, visible, and ultraviolet light."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-3">
					<div class="md-content">
						<h3><?php echo _("Radiant energy"); ?></h3>
						<div>
							<img src="images/14/radiant-energy.jpg"/>
							<p><?php echo _("Radiant energy is energy transmitted via the process of radiation, or moving through space as electromagnetic waves. Most of the radiant energy of the sun that reaches Earth is visible and infrared light."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-4">
					<div class="md-content">
						<h3><?php echo _("Visible light"); ?></h3>
						<div>
							<img src="images/14/visible-light.jpg"/>
							<p><?php echo _("Visible light is the portion of the spectrum of electromagnetic radiation that is visible to the unaided eye."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-5">
					<div class="md-content">
						<h3><?php echo _("Infrared light"); ?></h3>
						<div>
							<img src="images/14/infrared.jpg"/>
							<p><?php echo _("Infrared light is the portion of the spectrum of electromagnetic radiation that has longer wavelengths than visible light, and thus is undetectable by the unaided eye. About half of the light that the sun emits to Earth is in the form of infrared light."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<!-- <div class="md-modal md-effect" id="modal-6">
					<div class="md-content">
						<h3>Ultraviolet light</h3>
						<div>
							<img src="images/14/ultraviolet.jpg"/>
							<p>Ultraviolet light, also called UV light, is the portion of the spectrum of electromagnetic radiation that has shorter wavelengths than visible light, and thus is undetectable by the unaided eye. Ultraviolet light is part of sunlight, and is what causes sun tans and sunburns.</p>
							<button class="md-close">Close me!</button>
						</div>
					</div>
				</div> -->
				<div class="md-modal md-effect" id="modal-7">
					<div class="md-content">
						<h3><?php echo _("Water cycle"); ?></h3>
						<div>
							<img src="images/14/water-cycle.jpg"/>
							<p><?php echo _("The water cycle is the natural process by which water is transferred from the ground to the atmosphere, and back again. There are three main steps in the water cycle: evaporation, condensation, and precipitation."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-8">
					<div class="md-content">
						<h3><?php echo _("Evaporate"); ?></h3>
						<div>
							<img src="images/14/evaporate.jpg"/>
							<p><?php echo _("To evaporate means to change from a liquid state to a gas state. Evaporation is one of the main three steps of the water cycle, and occurs as liquid water rises into the atmosphere as it evaporates into water vapor gas."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-9">
					<div class="md-content">
						<h3><?php echo _("Condense"); ?></h3>
						<div>
							<img src="images/14/condense.jpg"/>
							<p><?php echo _("To condense means to change from a gas state to a liquid state. Condensation is one of the main three steps of the water cycle, and occurs as liquid water that has risen into the atmosphere through evaporation, condenses into rain clouds that are ready to precipitate (rain)."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-10">
					<div class="md-content">
						<h3><?php echo _("Precipitate"); ?></h3>
						<div>
							<img src="images/14/precipitate.jpg"/>
							<p><?php echo _("To precipitate means to fall to the earth's surface, such as through liquid rain, solid snow, or other forms of precipitation. Precipitation is one of the main three steps of the water cycle, and occurs as condensed water vapor in the atmosphere falls under gravity to the ground."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<!-- <div class="md-modal md-effect" id="modal-11">
					<div class="md-content">
						<h3>Convection currents</h3>
						<div>
							<img src="images/14/convection-currents.jpg"/>
							<p>Convection currents occur as a fluid rises due to an increased temperature, and then falls again as its pressure decreases with its raised temperature. Water is boiled in a pot through convection currents, as the water that is heated at the bottom of the pot rises and replaces the cooler water at the top. Along with radiation and conduction, convection currents are one of the three main methods of heat transfer.</p>
							<button class="md-close">Close me!</button>
						</div>
					</div>
				</div> -->
				<!-- <div class="md-modal md-effect" id="modal-12">
					<div class="md-content">
						<h3>Dense</h3>
						<div>
							<img src="images/14/density.jpg"/>
							<p>An object's density referred to how much matter is contained in its volume. An object that is solid is more dense than a liquid or gas. This means that per unit of area making up the substance, it contains more molecules than a liquid or gas does.</p>
							<button class="md-close">Close me!</button>
						</div>
					</div>
				</div> -->
				<div class="md-modal md-effect" id="modal-13">
					<div class="md-content">
						<h3><?php echo _("Photosynthesis"); ?></h3>
						<div>
							<img src="images/14/photosynthesis.jpg"/>
							<p><?php echo _("Photosynthesis is the process by which producer organisms, such as plants and phytoplankton, produce their food. These organisms undergo photosynthesis when they use carbon dioxide from the air, water, and light energy from the sun to produce sugar and give off a by-product of oxygen."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-14">
					<div class="md-content">
						<h3><?php echo _("Equator"); ?></h3>
						<div>
							<img src="images/14/equator.jpg"/>
							<p><?php echo _("The equator is the imaginary center line, going horizontally, across Earth. The equator divides Earth into the northern and southern hemispheres. Earth's equator is about 24,901 miles long!"); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-15">
					<div class="md-content">
						<h3><?php echo _("Parallel rays"); ?></h3>
						<div>
							<img src="images/14/parallel-rays.jpg"/>
							<p><?php echo _("Two rays, or lines with an endpoint in one direction and no endpoint in the other, are parallel when they never intersect despite being on the same plane."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>
				<div class="container">
					<!-- Top Navigation -->
					<div class="main clearfix">
						<div class="column">
							<!-- special modal that will add a perspective class to the html element -->
							<button class="md-trigger md-setperspective" data-modal="modal-1"><?php echo _("Spectrum"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-2"><?php echo _("Radiate"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-3"><?php echo _("Radiant energy"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-4"><?php echo _("Visible light"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-5"><?php echo _("Infrared light"); ?></button>
							<!-- <button class="md-trigger md-setperspective" data-modal="modal-6">Ultraviolet light</button> -->
							<button class="md-trigger md-setperspective" data-modal="modal-7"><?php echo _("Water cycle"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-8"><?php echo _("Evaporate"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-9"><?php echo _("Condense"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-10"><?php echo _("Precipitate"); ?></button>
							<!-- <button class="md-trigger md-setperspective" data-modal="modal-11">Convection currents</button> -->
							<!-- <button class="md-trigger md-setperspective" data-modal="modal-12">Dense</button> -->
							<button class="md-trigger md-setperspective" data-modal="modal-13"><?php echo _("Photosynthesis"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-14"><?php echo _("Equator"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-15"><?php echo _("Parallel rays"); ?></button>
						</div>
					</div>
				</div><!-- /container -->
				<div class="clear"></div>
				<div class="md-overlay"></div><!-- the overlay element -->
			</div>
		</div>
	</div>
<!--
	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="13.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons" title="<?php echo _('Next'); ?>">
		<a href="15.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png"></a>
	</div>
-->
	<div id="buttons">
		<a href="13.php" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="15.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	<div class="clear"></div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Words and explanations"); ?></strong></section></section>
	<script src="scripts/classie.js"></script>
	<script src="scripts/modalEffects.js"></script>
	<script>
		// this is important for IEs
		var polyfilter_scriptpath = '/scripts/';
	</script>
	<script src="scripts/cssParser.js"></script>
	<script src="scripts/css-filters-polyfill.js"></script>
	<?php include("setlocale.php"); ?>
</body>
</html>
