<?php
	$curlang = "English";

	if ($_SESSION["lang"] == "ar_EG") $curlang = "Arabic";
	if ($_SESSION["lang"] == "es_ES") $curlang = "Spanish";
	if ($_SESSION["lang"] == "zh_CN") $curlang = "Chinese";
?>

<ul class="lang-menu-n">
	<li><a href="../../"><?php echo _("Go Back to Dashboard"); ?></a></li>
	<li>
		<ul>
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?lang=en_US"<?php if($_SESSION['lang'] == 'en_US') { ?> class="active-lang" <?php } ?>>En</a></li>
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?lang=ar_EG"<?php if($_SESSION['lang'] == 'ar_EG') { ?> class="active-lang" <?php } ?>>Ar</a></li>
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?lang=es_ES"<?php if($_SESSION['lang'] == 'es_ES') { ?> class="active-lang" <?php } ?>>Sp</a></li>
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?lang=zh_CN"<?php if($_SESSION['lang'] == 'zh_CN') { ?> class="active-lang" <?php } ?>>Cn</a></li>
		</ul>
	</li>		
</ul>

<ul class="lang-menu">
	<li><a href="../../teacher.php#">Go Back to Dashboard</a></li>
	<li><a href="#">Language: <?php echo $curlang; ?></a>
		<ul>
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?lang=en_US">English</a></li>
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?lang=ar_EG">Arabic</a></li>
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?lang=es_ES">Spanish</a></li>
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?lang=zh_CN">Chinese</a></li>
		</ul>
	</li>
</ul>

<script>
	function addHash(tag) {
		$("ul.lang-menu ul a").each(function() {
			this.href = this.href + tag;
		});
	}

	function removeHash() {
		$("ul.lang-menu ul a").each(function() {
			var str = this.href;
			if (str.indexOf("#") != -1) 
				this.href = str.substring(0, str.indexOf("#"));
		});
	}
</script>
