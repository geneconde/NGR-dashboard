<?php
	include_once '../controller/User.Controller.php';
	include_once '../controller/Language.Controller.php';

	if (isset($_SESSION['uname'])) {
		$type = $user->getType();
		$lc = new LanguageController();
		$user_id = $user->getUserid();
		$languages = $lc->getAllLanguages();
		$user_languages = $lc->getLanguageByTeacher($user_id);
		$ufl = $user->getFirstLogin();
	}
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title>NexGenReady - Subscriber</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../style.css" />
<link rel="stylesheet" type="text/css" href="../lgs.css">
<link rel="stylesheet" type="text/css" href="../styles/font-awesome.min.css">
<?php if($language == "ar_EG") : ?>
	<link rel="stylesheet" href="../styles/pageguide.min-ar.css" />
<?php else : ?>
	<link rel="stylesheet" href="../styles/pageguide.min.css" />
<?php endif; ?>

<script type="text/javascript" src="../scripts/jquery-1.8.2.min.js"></script>
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

<script src="../phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
<script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="../phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
<script src="../phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

<?php
if($language == "ar_EG") { ?> <script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-ar.js" type="text/javascript"></script>
<?php }
if($language == "es_ES") { ?> <script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
<?php }
if($language == "zh_CN") { ?> <script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-cn.js" type="text/javascript"></script>
<?php } ?>
</head>

<body>
<div id="header">
	<div class="wrap">
		<a class="logo fleft" href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>
		<?php if (isset($user)) {
			$type = $user->getType();
		?>
		<div class="fright" id="logged-in">
			<div>
				<?php if($ufl == 1) : ?>
				<span class="note"><?php echo _("Welcome"); ?></span>, <span class="upper bold"><?php echo $user->getUsername(); ?></span>! <a class="link" id="logout" href="../logout.php"><?php echo _("Logout?"); ?></a>
				<?php else : ?>
				<span class="note"><?php echo _("Welcome"); ?></span>, <span class="upper bold"><?php echo $user->getUsername(); ?></span>! <?php if($type>=3) { ?><a class="link" href="edit-account.php?user_id=<?php echo $user_id; ?>"/><?php echo _("Manage My Account"); ?></a><?php } ?> | <a class="link" id="logout" href="../logout.php"><?php echo _("Logout?"); ?></a>
				<?php endif; ?>
			</div>
			<div class="languages">
				<?php if(!empty($user_languages)) :
					foreach($user_languages as $tl) : 
						$lang = $lc->getLanguage($tl['language_id']); ?>
						<a class="uppercase manage-box" href="<?php echo ($type>=3 ? 'index.php?lang='.$lang->getLanguage_code() : 'student.php?lang='.$lang->getLanguage_code()); ?>"/><?php echo $lang->getShortcode(); ?></a>
				<?php  endforeach;
				else : ?>
					<a class="uppercase manage-box" href="<?php echo ($type>=3 ? 'index.php?lang=en_US' : 'student.php?lang=en_US'); ?>"/><?php echo _("EN"); ?></a>
				<?php endif; ?>
				<?php if($ufl != 1) { ?>
					<a href="edit-languages.php" class="edit-languages link"><?php echo _("Edit Languages"); ?></a>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
	</div>
</div>