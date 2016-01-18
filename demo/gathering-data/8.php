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
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<style>
.wrap { border-left: 1px dashed #d8e2a9; border-right: 1px dashed #d8e2a9; }
.bg { background: url('images/8/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
.fl {width: 50%;margin-right: 20px;margin-top:20px;}
#screen2, #screen3, #screen4 { display: none; }
#buttons .next { display:none; }
#cycle {width:400px;float:left;margin-top:30px;}
#cycle img { display: inline-block;width:400px;border-radius: 5px;}
.sc2-images{width:615px; margin: 10px 0 0 160px;}
<?php if($language == "es_ES") { ?>
	p { font-size: 22px; }
<?php } ?>
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	.fl { width: 40%; }
	.sc2-images { margin: 10px 0 0 65px; }
}	
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="screen1" class="screens">
				<h1><?php echo _('More big ideas... about gathering data'); ?></h1>
				<p>
					<?php echo _("Whether by accurate measurement, or just observation, scientists gather data as part of how they investigate nature. In the process of science, gathering data is one of the most important things scientists do. Scientists make observations, ask questions, and then make a first explanation called a <span class=\"key\">hypothesis</span> as to what they think the answer to their question or problem might be. Then, to check and see whether their explanation is correct or not, they test their hypothesis by conducting investigations and gathering a lot of data."); ?>
				</p>
				<p class="fl">
					<?php echo _('<span class="key">Evidence</span> is the information (data) that scientists use to test their hypotheses and support their explanations. Research evidence is what makes explanations in science special. It sounds like a simple idea, but it is the basis of all science. Scientific statements, or claims, must be confirmed and supported with a lot of solid evidence; otherwise it is just a guess.'); ?>
				</p>
				<div id="cycle">
					<img src="images/8/d.jpg">
					<img src="images/8/c.jpg">
					<img src="images/8/b.jpg">
					<img src="images/8/a.jpg">
				</div>
			</div>
			<div id="screen2" class="screens">
				<p>
					<?php echo _('Science needs both claims (the explanations scientists make about how nature works) and evidence (the facts and data to support those claims) in order to continually move forward in our understanding about nature. Scientists can then use those claims and evidence to develop even newer and better ideas they can test. This is the process by which the study of science understands more and more about the natural world around us.'); ?> 
				</p>
				<div class="sc2-images">
					<img src="images/8/a.gif">
					<img src="images/8/b.gif">
				</div>
			</div>

		</div>
	</div>
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><?php echo _("Back"); ?></a>
		<a href="#" class="readmore readmore-toggle" title="<?php echo _("Read More"); ?>"><?php echo _("Read More"); ?></a>
		<a href="9.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><?php echo _("Next"); ?></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Collecting evidence...'); ?></strong></section></section>
		
	<script src="scripts/cycle.js"></script>
	<script>$('#cycle').cycle('zoom,fade,turnDown,curtainX');</script>
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
			$('h1').fadeOut();
			screen2.show();
			readmore.fadeOut(function(){ next.fadeIn(); });
		}
		/* Back Transition - change to the corresponding number of screens */
		back.click(function(){
			if(screen1.is(':visible')) {
				document.location.href = "7.php";
			} else if(screen2.is(':visible')) {
				next.fadeOut(function() { readmore.fadeIn(); });
				screen2.fadeOut(function (){
					screen1.fadeIn();
					$('h1').fadeIn();
					window.location.hash = '';
				});
			}
		});

		/* Read More Screen Transition */
		readmore.click(function(){
			if(screen1.is(':visible')) {
				readmore.fadeOut(function() { next.fadeIn(); });
				$('h1').fadeOut();
				screen1.fadeOut( function(){
					screen2.fadeIn();
					window.location.hash = '#screen2';
				});
			}
		});

	});
	</script>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
