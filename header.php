<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title>NexGenReady</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="styles/layerslider.css" />
<link rel="stylesheet" type="text/css" href="styles/jquery.countdown.css" />
<link rel="stylesheet" href="libraries/joyride/joyride-2.1.css">
<link rel="stylesheet" type="text/css" href="lgs.css">

<!-- added for the tabbed navigation results
<link rel="stylesheet" type="text/css" href="styles/tabbed-navigation.css" />
<link rel="stylesheet" type="text/css" href="styles/tabbed-reset.css" />
<script type="text/javascript" src="scripts/modernizr.js"></script> -->
<!-- end tabbed navigation results -->

<script type="text/javascript" src="scripts/jquery-1.8.3.min.js" ></script>
<script type="text/javascript" src="scripts/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="scripts/FixedColumns.js"></script>
<script type="text/javascript" src="scripts/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui.js"></script>
<script type="text/javascript" src="scripts/jquery.plugin.js"></script>
<script type="text/javascript" src="scripts/jquery.countdown.js"></script>
<script type="text/javascript" src="libraries/joyride/jquery.cookie.js"></script>
<script type="text/javascript" src="libraries/joyride/modernizr.mq.js"></script>
<script type="text/javascript" src="libraries/joyride/jquery.joyride-2.1.js"></script>
<!--
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://www.datatables.net/release-datatables/extras/FixedColumns/media/js/FixedColumns.js"></script>
-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script>

<?php if (isset($user)) { $type = $user->getType(); } ?>
</head>
<body>
	<div id="header">
		<a class="logo fleft" href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>
		<?php if (isset($user)) { ?>
		<div class="fright" id="logged-in">
			<?php echo _("You are currently logged in as"); ?> <span class="upper bold"><?php echo $user->getUsername(); ?></span>. <a class="link fright" href="logout.php"><?php echo _("Logout?"); ?></a>
		</div>
		<?php } ?>
	</div>

	<div id="content">
	<div class="top-buttons">
		<div id="dbguide"><button class="uppercase fleft guide tguide" onClick="guide()">Guide Me</button></div>
	</div>