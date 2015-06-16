<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(4, $_SESSION['smid']);
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
<script type="text/javascript" src="scripts/fadeSlideShow.js"></script>
<style>
.wrap { border-left: 1px dashed #d8e2a9; border-right: 1px dashed #d8e2a9; }
.bg { background: url('images/4/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#screen1 img { width: 50%; display: block; margin: 0 auto;  }
#screen2, #screen3 { display: none; }
img.next-toggle { display:none; }

#hand { width: 750px; height: 265px; margin: 0 auto; background-image: url("images/4/hand.png"); background-size: 100%; background-repeat: no-repeat; }
#hand span { font-size: 28px; }
#hand p { padding-top: 20px; }
#hand p:first-of-type { float:left; padding-left: 95px; }
#hand p:last-of-type { float: right; padding-right: 95px; }
#img { width: 250px; height: 222px; padding-top: 24px; padding-left: 478px; }

#healthy { float: left; 
margin: 84px 0 0 24px;
transform:rotate(-60deg);
-ms-transform:rotate(-60deg); /* IE 9 */
-webkit-transform:rotate(-60deg); /* Opera, Chrome, and Safari */
}
#fast { float: right; 
margin: 80px 43px 0 0;
transform:rotate(60deg);
-ms-transform:rotate(60deg); /* IE 9 */
-webkit-transform:rotate(60deg); /* Opera, Chrome, and Safari */
}
#happy { float: left; margin-top: 54px; margin-left: 92px; }

#slideshowWrapper{position:relative;width:405px;margin:auto; height:280px;}
#fssPrev{position:absolute;top:169px;left:-67px;background:url(arrows.png) -67px 0px;width:67px;height:143px;text-indent:-999999px;}
#fssNext{position:absolute;top:169px;left:646px;background:url(arrows.png) no-repeat;width:67px;height:143px;text-indent:-999999px;}
#fssPlayPause{display:none;}

ul#slideshow{list-style:none;padding:2px;margin:auto;margin-top:5%;width:450px;overflow:hidden;}
p{text-align:left;}
#fssList{display:none; list-style:none;width:646px;margin:auto;padding:5px 0 0 45%;}
#fssList li{display:inline;padding-right:10px;}
#fssList li a{color:#999;text-decoration:none;}
#fssList li.fssActive a{font-weight:bold;color:#333;}
ul li img { margin: 0 auto; }
#top{background:#3b5998;width:100%;height:40px;margin-bottom:20px;}
#top h1{color:#fff;font-weight:normal;font-size:18px;padding:7px 0 0 15px;display:block !important;}
#top h1 span{font-size:11px;}
#top h1 a{text-decoration:underline;color:#fff;}
#top h1 a:hover{text-decoration:none;}
html[dir="rtl"] #happy { margin-left: -10px; }
<?php if($language == "es_ES") { ?>
	h1 { font-size: 32px; }
<?php } ?>
<?php if($language == "zh_CN") { ?>
	#happy { margin-left: 75px; }
<?php } ?>
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="screen1" class="screens">
				<h1><?php echo _("Reviewing big ideas... about gathering data"); ?></h1>
				<p><?php echo _("Scientists use data to help them answer questions and explain things. The data can be a measure of some amount or a description of some characteristic or behavior. Data that can be stated in terms of an amount or number are called <span class='key'>quantitative data</span>. Data that are a description of some characteristic or behavior that do not involve numbers are called <span class='key'>qualitative data</span>. Quantitative and qualitative data usually go hand-in-hand in most scientific investigations."); ?>
				</p>
				
				<div id="hand">
					<div id="img">
						<span id="healthy"><?php echo _("Healthy"); ?></span>
						<span id="fast"><?php echo _("Fast"); ?></span>
						<span id="happy"><?php echo _("Happy"); ?></span>
					</div>
					<p><?php echo _("Quantitative"); ?></p>
					<p><?php echo _("Qualitative"); ?></p>
				</div>
			</div>
			<div id="screen2" class="screens">
				<p><?php echo _("Instruments are designed mainly to make it easier to gather data. For example, a hand lens and a microscope make it possible to see very small things that cannot be seen with our eyes alone. Telescopes allow us to see things at great distances that we could not see with our eyes alone. A hand lens, microscope and telescope all extend our sense of sight. Similarly, a sound detector can extend our sense of hearing by helping us hear soft sounds that could not be heard with our ears alone."); ?></p>
				<p><?php echo _("Other instruments are designed to give us quantitative measurements of things.  For example, a thermometer allows us to measure temperature, and a balance allows us to measure mass."); ?>
				</p>
				<div id="slideshowWrapper">
				    <ul id="slideshow">
					  <li><img src="images/4/1.jpg" /></li>
					  <li><img src="images/4/2.jpg" /></li>
					  <li><img src="images/4/3.jpg" /></li>
					  <li><img src="images/4/4.jpg" /></li>
					  <li><img src="images/4/5.jpg" /></li>
				    </ul><br clear="all" />
				</div>
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="readmore-toggle" src="images/buttons/readmore.png" title="<?php echo _("Read More"); ?>"></a>
		<a href="5.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Collecting data..."); ?></strong></section></section>
	<script>
		/* This is set to 2 screens */
	var hash = window.location.hash.slice(1),
		screenCount = 2,
		back = $('img.back-toggle'),
		readmore = $('img.readmore-toggle'),
		next = $('img.next-toggle'),
		screen1 = $('#screen1'),
		screen2 = $('#screen2'),
		bg = $('.bg');
		
	$(document).ready(function() {
		
		jQuery('#slideshow').fadeSlideShow();
 		 
		if(hash != "") {
			$('.screens').hide();
			//$('h1').fadeOut();
			screen2.show();
			readmore.fadeOut(function(){ next.fadeIn(); });
		}
		/* Back Transition - change to the corresponding number of screens */
		back.click(function(){
			if(screen1.is(':visible')) {
				document.location.href = "3.php#answer";
			} else if(screen2.is(':visible')) {
				next.fadeOut(function() { readmore.fadeIn(); });
				screen2.fadeOut(function (){
					screen1.fadeIn();
					window.location.hash = '';
				});
			}
		});

		/* Read More Screen Transition */
		readmore.click(function(){
			if(screen1.is(':visible')) {
				readmore.fadeOut(function() { next.fadeIn(); });
				//$('h1').fadeOut();
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
