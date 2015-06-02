<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once 'locale.php';
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Solar Power"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
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
.bg { background: url('images/9/bg.jpg') no-repeat; background-size: 100% 100%; width:100%; height: 100%; position: relative; }
.wrap {border-left: 1px dashed #FE7F83; border-right: 1px dashed #FE7F83;}
h1 { color: #8a3004; font-size: 32px; }
h2 { color: #046bbd; text-align: center;}
.wrap { overflow: hidden; }
#problem { display: none; }
#problem h2 { padding-top: 30px; margin: 0px; }
img.next-toggle { display: none; }
#buttons .next { display: none; }
#text { z-index: 99; position: relative; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 0px 10px; }
.col { background: #E6C39E; margin: 10px auto; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius:10px; padding:10px; width: 600px; max-width: 100%; padding: 20px; height: 300px; }
textarea { height: 93%; width: 96%; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; font-size: 20px; outline: none; padding: 10px; resize: none; font-family: 'PlaytimeRegular'; border: 1px solid black; }
#scenario img { width: 100%; border-radius: 0; -webkit-border-radius: 0; -moz-border-radius: 0; border: 8px solid #fff; }
#cycle { text-align:center; margin: 0 auto; margin-top:15px; width:450px;}
#cycle img { display: inline-block; border:6px solid rgba(255, 135, 63, .5);box-shadow: 0px 35px 45px -25px rgba(0, 0, 0, .5); width:500px; border-radius:10px}
html[dir="rtl"] h1 { font-size:23px; } 
<?php if($language == "ar_EG") { ?>
@media only screen and (max-width: 1250px) {
	h1 {font-size: 28px !important;}
}
<?php } ?>
<?php if($language == "es_ES"){ ?>
	h1 { font-size:28px; }

<?php } ?>

@media only screen and (max-width: 1250px) {
#problem h2 {padding-top:40px;}
p {font-size: 20px ;}
}
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="scenario">
				<h1><?php echo _("Using what you know... about solar power... to solve a problem"); ?></h1>
				<h2><?php echo _("The Situation"); ?></h2>
				<div id="text">
					<p><?php echo _("You work as an engineer for a company that consults (advises) on matters related to the purchase of  alternative energy equipment.  City officials in Anchorage, Alaska have contacted your company about installing solar panels to help generate electricity for their city office buildings."); ?></p>
				</div>
				<div id="cycle">
					<img src="images/12/1.jpg">
					<img src="images/12/2.jpg">
					<img src="images/12/3.jpg">
				</div>
			</div>
			<div id="problem">
				<h2><?php echo _("The Problem"); ?></h2>
				<p><?php echo _("Using what you know about solar energy and how the sun impacts different parts of the earth at different times of the year, what kind of information would you provide to and questions you would ask the city officials to help them make a decision on whether or not to install solar panels.  Place your information and questions in the text box provided."); ?></p>
				<article class="col">
					<textarea id="probanswer" name="probanswer" row="20" col="40" placeholder="<?php echo _('Click here to start typing your answer...'); ?>"></textarea>
				</article>
			</div>
		</div>
	</div>
<!--
	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="readmore-toggle" src="images/buttons/readmore.png" title="<?php echo _('Read More'); ?>"></a>
		<a href="13.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="#" class="readmore readmore-toggle" title="<?php echo _("Read More"); ?>"><i class="fa fa-comment"></i></a>
		<a href="13.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Hello, engineer..."); ?></strong></section></section>
		<script src="scripts/cycle.js"></script>
	<script>$('#cycle').cycle();</script>
	<script>
		$(document).ready(function() {
			/* screen transition */	
			$('a.back-toggle').click(function(){
				if($('#scenario').is(':visible')) {
					document.location.href= "11.php";
				} else if ($('#problem').is(':visible')) {
					$('a.next-toggle').fadeOut(function() { $('a.readmore-toggle').fadeIn(); });
					$('#problem').fadeOut(function(){
						$('#scenario').fadeIn();
					});
				}
			});
			
			$('a.readmore-toggle').click(function(){
				$('a.readmore-toggle').fadeOut(function() { $('a.next-toggle').fadeIn(); });
				$('#scenario').fadeOut( function(){
					$('#problem').fadeIn();
					window.location.hash = '#problem';
				});
			});
			
			$('a.next-toggle').click( function() {
				if ($('textarea').val() == '') {
					alert('<?php echo _("Please type your answer."); ?>');
				return false;
			}
				answer = $('#probanswer').val();
				//save();
			});

			$(".num").keydown(function(event) {
				// Allow: backspace, delete, tab, escape, and enter
				if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
					(event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
						 return;
				} else {
					if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
						event.preventDefault(); 
					}   
				}
			});
		});
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
