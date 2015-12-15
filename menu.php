<?php if(!isset($active)) $active=''; ?>
<div class="buttons">
	<?php if($type == 0) : ?>
		<a class="uppercase fright manage-box" href="phpgrid/test-questions.php"><?php echo _("Test Questions"); ?></a>
		<a class="uppercase fright manage-box" target="_blank" href="../marketing/ngss.php"><?php echo _("See the NGSS Alignment"); ?></a>
		<a class="uppercase fright manage-box <?php echo ($active=='student-accounts' ? 'active' : ''); ?>" id="student-accounts" href="phpgrid/manage-students.php"><?php echo _("Student Accounts"); ?></a>
		<a class="uppercase fright manage-box <?php echo ($active=='student-groups' ? 'active' : ''); ?>" id="student-groups" href="student-accounts.php"><?php echo _("Student Groups"); ?></a>
		<a class="uppercase fright manage-box <?php echo ($active=='cumulative-test' ? 'active' : ''); ?>" id="cumulative-test" href="ct-test.php"><?php echo _("Cumulative Test"); ?></a>
		<a class="uppercase fright manage-box <?php echo ($active=='diagnostic-test' ? 'active' : ''); ?>" id="diagnostic-test" href="dt-test.php"><?php echo _("Diagnostic Test"); ?></a>
		<a class="uppercase fright manage-box <?php echo ($active=='dashboard' ? 'active' : ''); ?>" id="dashboard" href="teacher.php"><?php echo _("Dashboard"); ?></a>
	<?php elseif ($type == 2) : ?>
		<a class="uppercase fright manage-box <?php echo ($active=='dashboard' ? 'active' : ''); ?>" id="dashboard" href="student.php"><?php echo _("Dashboard"); ?></a>
	<?php endif; ?>
</div>