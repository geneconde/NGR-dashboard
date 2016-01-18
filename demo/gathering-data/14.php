<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once 'locale.php';
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Gathering Data"); ?></title> <!-- Change module title here -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/modalcomponent.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<style>
.wrap { border-left: 1px dashed #d8e2a9; border-right: 1px dashed #d8e2a9; }
.bg { background: url('images/13/bg.jpg') no-repeat; background-size: 100% 100%; width: 100% !important; height:100%; position: relative; }
.bg > div { -moz-perspective: 600px; }
h1 { font-size: 34px; }
.column { width: 100%; text-align: center; margin: 10% auto;}
.md-content  { background: #EEC181; }
.md-content h3 {
background: #868600;
color: #fff;
}
p { font-size: 16px; }
button:hover { background: rgba(228, 196, 68, 0.75); }
.md-overlay { }
button {
	font-family: 'PlaytimeRegular';
	border: none;
	border-image-source: initial;
	border-image-slice: initial;
	border-image-width: initial;
	border-image-outset: initial;
	border-image-repeat: initial;
	outline: none;
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
}
<?php if($language == "es_ES") { ?>
	h1 { font-size: 27px; }
<?php } ?>
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div>
				<h1><?php echo _('Reviewing key vocabulary related to... gathering data'); ?></h1>
				<div class="md-modal md-effect" id="modal-1">
					<div class="md-content">
	
						<h3><?php echo _('Instrument'); ?></h3>
						<div>
							<img src="images/14/instrument.jpg"/>
							<p><?php echo _("Instruments are objects used to extend or improve senses in order to obtain data. A stethoscope is an example of an instrument. It amplifies the sense of hearing in order to measure a person's heart rate and breathing."); ?></p>
							<button class="md-close"><?php echo _('Close me!'); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-2">
					<div class="md-content">
						<h3><?php echo _('Qualitative data'); ?></h3>
						<div>
							<img src="images/14/quality.jpg"/>
							<p><?php echo _('Data that are a description of some characteristic or behavior that do not involve numbers are called qualitative data.'); ?></p>
							<button class="md-close"><?php echo _('Close me!'); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-3">
					<div class="md-content">
						<h3><?php echo _('Quantitative data'); ?></h3>
						<div>
							<img src="images/14/quantity.jpg"/>
							<p><?php echo _('Data that can be stated in terms of an amount or number are called quantitative data.'); ?></p>
							<button class="md-close"><?php echo _('Close me!'); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-4">
					<div class="md-content">
						<h3><?php echo _('Metric system'); ?></h3>
						<div>
							<img src="images/14/metric.jpg"/>
							<p><?php echo _('The metric system is a decimal system for measuring mass, volume, and length. The metric system uses grams to measure mass, liters to measure volume, and meters to measure length.'); ?></p>
							<p><?php echo _('The metric system was introduced in France in 1790, it is based on units of tens. For example, a decimeter is 1/ 10 of a meter, a centimeter is 1/ 100 of a meter and a kilometer is 1000 meters.'); ?> </p>
							<button class="md-close"><?php echo _('Close me!'); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-5">
					<div class="md-content">
						<h3><?php echo _('Estimate'); ?></h3>
						<div>
							<img src="images/14/estimate.jpg"/>
							<p><?php echo _('An estimate is a measurement or answer that is close to the real measurement or answer. When exact measurements are not needed, the measurement can be estimated.'); ?></p>
							<button class="md-close"><?php echo _('Close me!'); ?></button>
						</div>
					</div>
				</div>
	
				<div class="md-modal md-effect" id="modal-6">
					<div class="md-content">
						<h3><?php echo _('Error'); ?></h3>
						<div>
							<img src="images/14/error.jpg"/>
							<p><?php echo _('An error is like a mistake. If you measure something once and it is different from the second time you measure it, you can see there is error in measurement. One of the measurements, or both of them might have been slightly wrong- that is considered an error. Instruments we use have some amount of error, so we take several measurements and average them to make the error less.'); ?></p>
							<button class="md-close"><?php echo _('Close me!'); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-7">
					<div class="md-content">
						<h3><?php echo _('Accurate'); ?></h3>
						<div>
							<img src="images/14/accurate.jpg"/>
							<p><?php echo _('Accurate means to be correct and make no mistakes. When you measure something, you can be accurate by making the correct measurements. If you measure more or less than the right amount, you are not being accurate.'); ?></p>
							<p><?php echo _('In science, it is important to provide accurate information when you do an experiment. It will help you to be accurate if you do things very carefully.'); ?></p>
							<button class="md-close"><?php echo _('Close me!'); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-8">
					<div class="md-content">
						<h3><?php echo _('Average'); ?></h3>
						<div>
							<img src="images/14/average.jpg"/>
							<p><?php echo _('An average is a single value or number that is meant to best represent a list of values. There are a few different ways to determine an average. For example, you might measure the height of three different plants to be 11 inches, 12 inches, and 16 inches. One way to determine the average height is to identify the middle value, which in this case would be 12 inches. But a more accurate way to determine the average height would be to add all of the values and divide by the number of values, as shown below. (11 + 12 + 16) / 3 = 13 inches average '); ?></p>
							<button class="md-close"><?php echo _('Close me!'); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-9">
					<div class="md-content">
						<h3><?php echo _('Hypothesis'); ?></h3>
						<div>
							<img src="images/14/hypothesis.jpg"/>
							<p><?php echo _("A hypothesis is like a scientific guess as to what the answer to a question or problem might be. A hypothesis is a \"for now\" explanation for an observation or scientific problem that you can test by investigating it more."); ?></p>
							<button class="md-close"><?php echo _('Close me!'); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-10">
					<div class="md-content">
						<h3><?php echo _('Evidence'); ?></h3>
						<div>
							<img src="images/14/evidence.jpg"/>
							<p><?php echo _('Evidence is the information (data) that scientists use to support their hypothesis and explanations. Scientists use different kinds of data to prove whether their hypothesis is right or not. The data they use is called evidence.'); ?></p>
							<button class="md-close"><?php echo _('Close me!'); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-11">
					<div class="md-content">
						<h3><?php echo _('Data'); ?></h3>
						<div>
							<img src="images/14/data.jpg"/>
							<p><?php echo _('Data are bits of factual information that can be used to draw conclusions or make decisions. Factual information means that the information is true or based on something that really happened. The way that people gather data is by observing something and writing down exactly what they see. There are many different jobs in which people collect data. Scientists collect data about the world around us. Teachers collect data about the grades their students earn. Even policemen collect data about the criminals they catch.'); ?></p>
							<button class="md-close"><?php echo _('Close me!'); ?></button>
						</div>
					</div>
				</div>
				
				<div class="container">
					<!-- Top Navigation -->
					<div class="main clearfix">
						<div class="column">
							<!-- special modal that will add a perspective class to the html element -->
							<button class="md-trigger md-setperspective" data-modal="modal-1"><?php echo _('Instrument'); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-2"><?php echo _('Qualitative data'); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-3"><?php echo _('Quantitative data'); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-4"><?php echo _('Metric system'); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-5"><?php echo _('Estimate'); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-6"><?php echo _('Error'); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-7"><?php echo _('Accurate'); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-8"><?php echo _('Average'); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-9"><?php echo _('Hypothesis'); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-10"><?php echo _('Evidence'); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-11"><?php echo _('Data'); ?></button>
						</div>
					</div><!-- /container -->
				</div>
				<div class="clear"></div>
				<div class="md-overlay"></div><!-- the overlay element -->
			
			</div>	
		</div>
	</div>
	
	<div id="buttons">
		<a href="13.php" class="back back-toggle" title="<?php echo _("Back"); ?>"><?php echo _("Back"); ?></a>
		<a href="15.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><?php echo _("Next"); ?></a>
	</div>
	<div class="clear">		
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Words and explanations'); ?></strong></section></section>
	<script src="scripts/classie.js"></script>
	<script src="scripts/modalEffects.js"></script>
	<script>
		// this is important for IEs
		var polyfilter_scriptpath = '/scripts/';
	</script>
	<script src="scripts/cssParser.js"></script>
	<script src="scripts/css-filters-polyfill.js"></script>
	<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
