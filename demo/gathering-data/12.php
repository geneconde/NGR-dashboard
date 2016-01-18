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
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
.wrap { border-left: 1px dashed #c0d1e5; border-right: 1px dashed #c0d1e5; }
h1 { font-size: 30px;}
.bg { background: url('images/12/bg2.jpg') no-repeat; background-size: 100% 100%; width:100%; height: 100%; position: relative; }
#assignment { display: none; } /* change selector depending on heading */
img.next-toggle { display: none; }
.col {margin: 10px auto; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius:10px; padding:10px; width: 600px; max-width: 100%; padding: 20px; height: 300px; }
textarea { height: 93%; width: 96%; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; border: none; font-size: 20px; outline: none; padding: 10px; resize: none; font-family: 'PlaytimeRegular'; }
#problem h2 { text-align: center; }
#problem p, #assignment p {text-align:left;}
#assignment h2 { text-align: center; }
#assignment {padding-top:20px;}
#cycle {width:400px;margin:0 auto;}
#cycle img { display: inline-block;width:400px;border-radius: 10px;}
<?php if($language == "es_ES") { ?>
	h1 { font-size: 24px; }
<?php } ?>

html[dir="rtl"] #problem p { text-align: right; }
html[dir="rtl"] #assignment p { text-align: right; }
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="problem">
			<h1><?php echo _('Using what you know... about gathering data... to solve a problem'); ?></h1>
				<h2><?php echo _('The Problem'); ?></h2>
				<p><?php echo _('As a paleontologist (a scientist who studies fossils) working at a natural history museum, you are studying the skull of an unknown dinosaur to determine what it likely ate. You know that there is a link between dinosaurs and their teeth. The skull fossil has no visible teeth, but the skull was found with some fossilized bones of a much smaller animal and some fossils of animal droppings.'); ?></p>
				<div id="cycle">
					<img src="images/12/pal1.jpg">
					<img src="images/12/pal2.jpg">
				</div>
			</div>
			<div id="assignment">
				<h2><?php echo _('The Assignment'); ?></h2>
				<p><?php echo _('Using what you know about gathering data to support a claim or explanation, enter in the text box provided what you think the dinosaur mostly ate—was it an herbivore (a plant eater) or a carnivore (a meat eater) -- and how you came to that conclusion.'); ?></p>
				<article class="col">
					<textarea id="probanswer" name="probanswer" row="20" col="40" placeholder="<?php echo _("Click here to start typing your answer..."); ?>"></textarea>
				</article>
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="readmore-toggle" src="images/buttons/readmore.png" title="<?php echo _("Read More"); ?>"></a>
		<a href="12.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Excavating dinosaur bones...'); ?></strong></section></section>
	<script src="scripts/cycle.js"></script>
	<script>$('#cycle').cycle('zoom,fade,turnDown,curtainX');</script>
	<script>
		var answer;
		var answered = 1;
		$(document).ready(function() {
			/* screen transition */	
			$('img.back-toggle').click(function(){
				if($('#problem').is(':visible')) {
					document.location.href= "11.php";
				} else if ($('#assignment').is(':visible')) {
					$('img.next-toggle').fadeOut(function() { $('img.readmore-toggle').fadeIn(); });
					$('#assignment').fadeOut(function(){
						$('h1').fadeIn();
						$('#problem').fadeIn();
					});
				}
			});
			
			$('img.readmore-toggle').click(function(){
				$('img.readmore-toggle').fadeOut(function() { $('img.next-toggle').fadeIn(); });
				$('h1').fadeOut();
				$('#problem').fadeOut( function(){
					$('#assignment').fadeIn();
					window.location.hash = '#assignment';
				});
			});
			
			$('img.next-toggle').click( function(e) {

				if ($('#probanswer').val().length < 1)  {
					e.preventDefault();
					alert('<?php echo _("Please type your answer."); ?>');
				} else {
					$('img.next-toggle').parent().attr('href','13.php');
				}

				answer = $('#probanswer').val();
				save();
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

			function save() {
				if (answered == 0) {
					saveMeta('gathering-data', answer);
					answered = 1;
				}
			}
		});
	</script>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
