	</div>
	<!-- start footer -->
	<div id="footer" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
		<div class="copyright">
			<p>© 2014 NexGenReady. <?php echo _("All Rights Reserved."); ?>
			<a class="link f-link" href="../../marketing/privacy-policy.php"><?php echo _("Privacy Policy"); ?></a> | 
			<a class="link f-link" href="../../marketing/terms-of-service.php"><?php echo _("Terms of Service"); ?></a>
	
			<a class="link fright f-link" href="../../marketing/contact.php"><?php echo _("Need help? Contact our support team"); ?></a>
			<span class="fright l-separator">|</span>
			<a class="link fright f-link" href="../../marketing/bug.php"><?php echo _("File Bug Report"); ?></a>
			</p>
		</div>
	</div>
	<!-- end footer -->
	<script>
	var language;
	$(document).ready(function() {
		$('#language-menu').change(function() {
			language = $('#language-menu option:selected').val();
			document.location.href = "<?php echo $_SERVER['PHP_SELF'];?>?lang=" + language;
		});

	    jQuery(document).ready(function() {
	        var pageguide = tl.pg.init();
	    });
	});
	</script>

	<?php if($language == "ar_EG") : ?>
		<script src="../scripts/pageguide.min-ar.js"></script>
	<?php else : ?>
		<script src="../scripts/pageguide.min.js"></script>
	<?php endif; ?>
	<div id="dialog-confirm1" title="Deleting Student Account">
	  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to delete this student account?</p>
	</div>
	<div id="dialog-confirm2" title="Deleting Student Account">
	  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Delete Student Account(s)?</p>
	</div>
	<div id="dialog-confirm3" title="Deleting Student Account">
	  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>If you want this student to be taken out from the list, you can click the unassign button insted. Do you still want to delete this account?</p>
	</div>
</body>
</html>