<?php
	$curlang = "English";
	if ($_SESSION["lang"] == "ar_EG") $curlang = "Arabic";
	if ($_SESSION["lang"] == "es_ES") $curlang = "Spanish";
	if ($_SESSION["lang"] == "zh_CN") $curlang = "Chinese";
?>
<ul class="lang-menu">
	<li><a href="../../teacher.php#"><?php echo _("Go Back to Dashboard"); ?></a></li>
	<li><a href="#">Language: <?php echo $curlang; ?></a>
		<ul>
			<li><a style="color:black;" href="<?php echo $_SERVER['PHP_SELF'];?>?lang=en_US">English</a></li>
			<li><a style="color:black;"href="<?php echo $_SERVER['PHP_SELF'];?>?lang=ar_EG">Arabic</a></li>
			<li><a style="color:black;"href="<?php echo $_SERVER['PHP_SELF'];?>?lang=es_ES">Spanish</a></li>
			<li><a style="color:black;"href="<?php echo $_SERVER['PHP_SELF'];?>?lang=zh_CN">Chinese</a></li>
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