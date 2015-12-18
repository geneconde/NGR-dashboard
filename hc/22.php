<?php 
	ini_set('display_errors', 1);
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
	<link rel="stylesheet" href="css/normalize.css" />
	<link rel="stylesheet" href="css/fonts.css" />
	<link rel="stylesheet" href="css/jpreloader.css" />
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<script src="scripts/blink.js"></script>
	
	<style>
		html, body {overflow: hidden;}
		h1 { margin-top: 0; padding-top: 40px; text-align: center; font-size: 50px; }
		h1 .blink { color: #FFCDF6; }
		h2 { text-align: center; color: #000; font-size: 24px; margin: 0 20px; margin-top: 40px; }

		.bg { background-image: url('images/22/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }	

		#results {
			width: 216px;
			margin: 60px auto 0;
			text-align: center;
			color: #fff;
			font-size: 28px;
			padding: 6px;
			display: block;
			border: 2px solid #fff;

			-webkit-border-radius: 6px;
			border-radius: 6px;
			background-clip: padding-box;

			background: #ce5642;
			background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzZlYjdmYSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM2NDllY2YiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
			background: -moz-linear-gradient(top,  #ce5642 0%, #e17f6e 100%); 
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ce5642), color-stop(100%,#e17f6e)); Safari4+ */
			background: -webkit-linear-gradient(top,  #ce5642 0%,#e17f6e 100%); 
			background: -o-linear-gradient(top,  #ce5642 0%,#e17f6e 100%); 
			background: -ms-linear-gradient(top,  #ce5642 0%,#e17f6e 100%); 
			background: linear-gradient(to bottom,  #ce5642 0%,#e17f6e 100%); 
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ce5642', endColorstr='#e17f6e',GradientType=0 ); */
		}

		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
		}
		#results:hover { background: #e7875f !important; }
		#dp_swf_engine { display: none; }
	</style> 
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<h1><span class="blink"><?php echo _("Congratulations, ") ?> QATEST!</span></h1>
			<h2 class="center"><?php echo _("You've completed the Heating and Cooling module."); ?></h2>
			<h2 class="center"><?php echo _("You can check how you did on the 'Quick Checks' and 'Quiz Questions' for this module by clicking the button below.") ?></h2>
			<a id="results"
			href="#"><span id="link"><?php echo _("View Result"); ?></span>
				
			</a>
		</div>
	</div>

	<div id="buttons">
		<a href="16.php" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("You're done!"); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>

	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/rightclick.js"></script>
	
	<?php include("temp-setlocale.php"); ?>
</body>
</html>
