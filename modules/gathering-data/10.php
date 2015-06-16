<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(10, $_SESSION['smid']);
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
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" type="text/css" href="styles/responsiveslides.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /><!--For accordion-->
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script><!--For accordion-->
<script src="scripts/responsiveslides.js"></script>
<style>
.wrap { border-left: 1px dashed #d8e2a9; border-right: 1px dashed #d8e2a9; }
.bg { background: url('images/10/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; overflow: hidden; }
.bg ul { margin: 0; padding: 0; width: 535px; float: left; }
.bg ul li { list-style-type: none; font-size: 22px;}
.acc-container{width:93%;margin:0 auto;min-height:300px;}
#screen1 p { font-size: 22px; }
#accordion h3{background:#f49e9c; font-family: 'PlaytimeRegular';font-size:20px;}
#accordion{height:100%; margin-top: 20px; width:100%;}
#accordion p{font-family: 'PlaytimeRegular';}
#accordion h2{font-family: 'PlaytimeRegular';}
.ui-accordion .ui-accordion-content {overflow:hidden !important;background: #fafdb6; padding: 5px; }
.acc-img-container{width:120px;float:left;}
.acc-img-container img{width:110px; max-height: 100px; }
.acc-container li{font-size:24px;color:black;}
ul.rslides { width: 124px; }
#screen1 ul.rslides li p { font-size: 15px; text-align: center; width: 124px; }
.blank { height: 10px; }

html[dir="rtl"] .bg ul { margin-left: 10px; width: 510px;  } 
html[dir="rtl"] ul.rslides { width: 124px !important; }
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="screen1" class="screens">
				<h1><?php echo _('More big ideas... about gathering data'); ?></h1>
				<p>
					<?php echo _('People in the United States use the US system of measurements for measuring length, mass, volume and temperature. But scientists and people in other countries use the metric system. Scientists prefer to use the <span class="key">metric system</span> because measures in the metric system are related by factors of 10. For example, 1 meter (m) is equal to 100 centimeters (cm) or 10 x 10 cm and 1 kilogram (kg) is equal to 1000 grams (g) or 10 x 10 x10 gs. You will use the metric system in science classes in the near future. The following table shows how US and metric system measurements compare. Click on the pink tabs below to learn more about measurements.'); ?>
				</p>
				<div class="acc-container">
					<div id="accordion">
						<h3><?php echo _('Length or distance'); ?></h3>
							<div>
								<div class="acc-img-container">
									<img src="images/10/length.png" />
								</div>
								<ul>
									<li><?php echo _('1 inch is a little bit more than 2 times a centimeter (cm)'); ?></li>
									<li><?php echo _('1 meter (m) is a little bit longer than a 3 feet or 1 yard'); ?></li>
									<li><?php echo _('1 kilometer (km) is a little more than half a mile'); ?></li>
								</ul>
								<ul class="rslides slider">
									<li> <img src="images/10/in.jpg"> <p><?php echo _('US quarter coin'); ?></p></li>
									<li> <img src="images/10/m.jpg"> <p><?php echo _('Baseball bat'); ?></p></li>
									<li> <img src="images/10/km.jpg"> <p><?php echo _('Football pitch'); ?></p></li>
								</ul>
								<div class="clear"></div>
							</div>
						<h3><?php echo _('Mass'); ?></h3>
							<div>
								<div class="acc-img-container">
									<img src="images/10/mass.png" />
								</div>
								<ul>
									<li><?php echo _('1 ounce is about 28 times more than 1 gram (g)'); ?></li>
									<li><?php echo _('1 kilogram (kg) is about 2 pounds'); ?></li>
								</ul>
								<ul class="rslides slider">
									<li> <img src="images/10/g.jpg"> <p><?php echo _('Pen'); ?></p></li>
									<li> <img src="images/10/kg.jpg"> <p><?php echo _('16 pound bowling ball'); ?></p></li>
								</ul>
								<div class="clear"></div>
							</div>
						<h3><?php echo _('Volume'); ?></h3>
							<div>
								<div class="acc-img-container">
									<img src="images/10/volume.png" />
								</div>
								<ul>
									<li><?php echo _('1 liquid ounce is about 30 milliliters (ml)'); ?></li>
									<li><?php echo _('1 liter (l) is a about 1 liquid ounce more than a 32 ounce quart'); ?></li>
									<li class="blank"> </li>
									<li><?php echo _('Example: A 2-liter soda bottle equals about the same volume as a ½ gallon milk bottle'); ?></li>
								</ul>
								<ul class="rslides slider">
									<li> <img src="images/10/gal.jpg"></li>
									<li> <img src="images/10/liter.jpg"></li>
								</ul>
								<div class="clear"></div>
							</div>
						<h3><?php echo _('Time'); ?></h3>
							<div>
								<div class="acc-img-container">
									<img src="images/10/time.png" />
								</div>
								<ul>
									<li><?php echo _('Time is measured the same in both metric and US systems'); ?></li>
								</ul>
								<ul class="rslides slider">
									<li> <img src="images/10/time.jpg"> <p><?php echo _('Wrist watch'); ?></p></li>
								</ul>
							</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="9.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="11.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Converting metric units...'); ?></strong></section></section>
	<script>
		$(".slider").responsiveSlides({
			auto: true,
			pager: false,
			nav: false,
			speed: 400,
			timeout: 3500
		});
	  $(function() {
	    $( "#accordion" ).accordion({
	      heightStyle: "content"
	    });
	  });
 </script>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
