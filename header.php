<?php
	include_once 'controller/User.Controller.php';
	include_once 'controller/Language.Controller.php';

	if (isset($_SESSION['uname'])) {
		$type = $user->getType();
		$lc = new LanguageController();
		$userid = $user->getUserid();
		$teacher_id = $user->getUserid();
		if($type==2) { $teacher_id = $user->getTeacher(); }
		$languages = $lc->getAllLanguages();
		$teacher_languages = $lc->getLanguageByTeacher($teacher_id);
		$ufl = $user->getFirstLogin();
	}
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title>NexGenReady</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="styles/layerslider.css" />
<link rel="stylesheet" type="text/css" href="styles/jquery.countdown.css" />
<link rel="stylesheet" type="text/css" href="lgs.css">
<link rel="stylesheet" type="text/css" href="styles/font-awesome.min.css">
<?php if($language == "ar_EG") : ?>
	<link rel="stylesheet" href="styles/pageguide.min-ar.css" />
<?php else : ?>
	<link rel="stylesheet" href="styles/pageguide.min.css" />
<?php endif; ?>

<script type="text/javascript" src="scripts/jquery-1.8.3.min.js" ></script>
<script type="text/javascript" src="scripts/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="scripts/FixedColumns.js"></script>
<script type="text/javascript" src="scripts/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui.js"></script>
<script type="text/javascript" src="scripts/jquery.plugin.js"></script>
<script type="text/javascript" src="scripts/jquery.countdown.js"></script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
</script>

</head>
<body>
<div id="header">
	<div class="wrap">
		<a class="logo fleft" href="<?php echo $link; ?>"><img src="images/logo2.png"></a>
		<?php if (isset($user)) {
			$type = $user->getType();
		?>
		<div class="fright" id="logged-in">
			<div>
				<?php if($ufl == 1) : ?>
				<span class="note"><?php echo _("Welcome"); ?></span>, <span class="upper bold"><?php echo $user->getUsername(); ?></span>! <a class="link" id="logout" href="logout.php"><?php echo _("Logout?"); ?></a>
				<?php else : ?>
				<span class="note"><?php echo _("Welcome"); ?></span>, <span class="upper bold"><?php echo $user->getUsername(); ?></span>! <?php if($type==0) { ?><a id="my-account" class="link" href="edit-account.php?user_id=<?php echo $userid; ?>"/><?php echo _("Manage My Account"); ?></a><?php } ?> | <a class="link" id="logout" href="logout.php"><?php echo _("Logout?"); ?></a>
				<?php endif; ?>
			</div>
			<div class="languages fright">
				<?php if(!empty($teacher_languages)) :
					foreach($teacher_languages as $tl) : 
						$lang = $lc->getLanguage($tl['language_id']); ?>
						<a class="uppercase manage-box" href="<?php echo ($type==0 ? 'teacher.php?lang='.$lang->getLanguage_code() : 'student.php?lang='.$lang->getLanguage_code()); ?>"/><?php echo $lang->getShortcode(); ?></a>
				<?php  endforeach;
				else : ?>
					<a class="uppercase manage-box" href="<?php echo ($type==0 ? 'teacher.php?lang=en_US' : 'student.php?lang=en_US'); ?>"/><?php echo _("EN"); ?></a>
				<?php endif; ?>
				<?php if($type == 0) : ?>
					<?php if($ufl != 1) { ?>
						<a href="teacher-languages.php" class="link"><?php echo _("Edit Languages"); ?></a>
					<?php } ?>
				<?php endif; ?>
			</div>
		</div>
		<?php } ?>
	</div>
</div>