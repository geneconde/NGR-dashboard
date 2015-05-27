<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title>NexGenReady - Subscriber</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../style.css" />
<link rel="stylesheet" type="text/css" href="../styles/layerslider.css" />
<link rel="stylesheet" type="text/css" href="../styles/jquery.countdown.css" />

<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<!-- <link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen" /> -->
<script src="scripts/jquery-1.8.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../scripts/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../scripts/FixedColumns.js"></script>
<script type="text/javascript" src="../scripts/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui.js"></script>
<script type="text/javascript" src="../scripts/jquery.plugin.js"></script>
<script type="text/javascript" src="../scripts/jquery.countdown.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script>

<link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/themes/redmond/jquery-ui.custom.css"></link>	
<link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/jqgrid/css/ui.jqgrid.css"></link>	

<!-- <link rel="stylesheet" type="text/css" href="../style.css" /> -->

<script src="../phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
<script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="../phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
<script src="../phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

</head>
<body>
	<div id="header">
		<!-- <div class="logo"><span class="big">N</span>EX<span class="big">G</span>EN<span class="big">R</span>EADY</a></div> -->
		<a href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>
	</div>
	<div id="content">
	<br>
	<?php if (isset($user)) { ?>
	<div class="fright" id="logged-in">
		<?php echo _("You are currently logged in as"); ?> <span class="upper bold"><?php echo $user->getUsername(); ?></span>. <a class="link" href="../logout.php"><?php echo _("Logout?"); ?></a>
	</div>
	<?php } ?>
	<div class="clear"></div>