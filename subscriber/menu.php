<?php if(!isset($active)) $active=''; ?>
<div class="buttons">
	<a class="uppercase fright manage-box" target="_blank" href="../../marketing/ngss.php"><?php echo _("See the NGSS Alignment"); ?></a>
	<a class="uppercase fright manage-box <?php echo ($active=='modules' ? 'active' : ''); ?>" id="modules" href="view-modules.php"><?php echo _("Modules"); ?></a>
	<a class="uppercase fright manage-box <?php echo ($active=='statistics' ? 'active' : ''); ?>" id="statistics" href="statistics.php"><?php echo _("Statistics"); ?></a>
	<a class="uppercase fright manage-box <?php echo ($active=='dashboard' ? 'active' : ''); ?>" id="dashboard" href="index.php"><?php echo _("Dashboard"); ?></a>
</div>