<?php 
	require_once "../tempsession.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once "locale.php";	
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?>  <?php } ?>>
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
		h1 { color: #37a1de; text-align: center;}

		.bg { background-image: url('images/1/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		.bg img { margin: 0 auto; }

		#hc { bottom: 0; padding-bottom: 55px; position: absolute; line-height: 84px; }
		#hc img { border: none; width: 760px; padding-left: 10px; }
		#hc img { border: none; }
		#start img { width: 70px; padding-top: 13px; padding-left: 10px; cursor: pointer; } 
		
		@-ms-keyframes wiggle{0%{-ms-transform:rotate(3deg);}50%{-ms-transform:rotate(-3deg);}100%{-ms-transform:rotate(3deg);}}
		@-moz-keyframes wiggle{0%{-moz-transform:rotate(3deg);}50%{-moz-transform:rotate(-3deg);}100%{-moz-transform:rotate(3deg);}}
		@-webkit-keyframes wiggle{0%{-webkit-transform:rotate(3deg);}50%{-webkit-transform:rotate(-3deg);}100%{-webkit-transform:rotate(3deg);}}
		@keyframes wiggle{0%{transform:rotate(3deg);}50%{transform:rotate(-3deg);}100%{transform:rotate(3deg);}}
		img.wiggle-me:hover{-ms-animation:wiggle .3s 2;-moz-animation:wiggle .3s 2;-webkit-animation:wiggle .3s 2;animation:wiggle .3s 2;}
		html[dir="rtl"] #start img { float: right; }
		html[dir="rtl"] #banner { float: left; }
		html[dir="rtl"] #hc { margin-right: 30px; }
		#dp_swf_engine { display: none; }

	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
		#hc { bottom: 150px; padding-bottom: 55px; }
		#hc img#banner { width: 610px; }
	}

	@media only screen and (max-width: 1250px) {
		#start img {padding-left:0px;}
	}	
	a#start {
	    width: 155px !important;
	    font-size: 22px !important;
	    color: white !important;
	    background: url('images/1/start.png')center no-repeat !important;
	    text-align: center !important;
	    background-size: 80px 82px !important;
	    padding: 25px !important;
	    text-align: center !important;
	}
	a#start:hover {
	    animation: wiggle .3s 155 !important;
	}
	#hc img {
	    float: left !important;
    	width: 713px !important;
	}

	@media only screen and (max-width: 960px) {
		#hc img {
		    float: left !important;
		    width: 80% !important;
		}
	}
	
	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<br>
			<h1><?php echo _("Welcome to the Heating and Cooling module"); ?>, QATEST! </h1>
			<div id="hc" >
				<img src="images/1/hc.png" id="banner"> 				
				<a href="2.php" id="start" class="wiggle-me"><?php echo _("Start"); ?></a>
			</div>
		</div>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Let's begin!") ?></strong></section></section>
	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/rightclick.js"></script>
	<?php include("temp-setlocale.php"); ?>
</body>
</html>
