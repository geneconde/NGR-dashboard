<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(15, $_SESSION['smid']);
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
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<style>
		html, body {overflow: hidden;}
		p { text-align: center; }
		h1 { color: #28CDFC; }
		
		.bg { background-image: url('images/15/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		
		#question { height: 320px; width: 470px; margin:0 auto; display: block; }

		#question img{
		  display:none;
		  position:absolute;
		}
		#question img.active{
		  display:block;
		  margin:0 auto;
		}
		
		.bg img {
			border: 0 !important;
		}
		#dp_swf_engine { display: none; }

		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
		}

		<?php if($language == "es_ES") { ?>
			h1 { font-size: 29px; }
		<?php } ?>
	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div>
				<h1><?php echo _("Checking what you now know... about heating and cooling"); ?></h1><br/><br/>
				<p><?php echo _("Answering the following six (6) quiz questions will give you an idea of what you now know and what you still need to study."); ?></p>
				<br>
				<p><?php echo _("Click the NEXT button when you are ready."); ?></p><br>
				<div id="question">
					<img src="images/15/0.png" class="active"/>
					<img src="images/15/1.png"/>
					<img src="images/15/2.png" />
					<img src="images/15/3.png" />
				</div>	
			</div>
		</div>
	</div>
	
	<div id="buttons">
		<a href="14.php" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="16.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	
	<section id="preloader"><section class="selected"><strong><?php echo _("Let's check what you now know"); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/rightclick.js"></script>
	<script>
		$(document).ready(function() {
			setInterval('swapImages()', 1000);
		});

		function swapImages(){
			var active = $('#question .active');
			var next = ($('#question .active').next().length > 0) ? $('#question .active').next() : $('#question img:first');  
			active.removeClass('active');
			next.addClass('active');
		}
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
