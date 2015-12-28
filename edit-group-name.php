<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	require_once 'controller/StudentGroup.Controller.php';

	if(isset($_GET['group_id'])){
		$group_id = $_GET['group_id'];
		$sgc 		= new StudentGroupController();
		$groups = $sgc->getGroupName($group_id);
	}
?>
<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="student-accounts.php">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="wrap">
	<div class="edit-group-name">
		<form method="post" action="update-group-name.php" id="edit-group-name">
			<h2 class="group-name"><?php echo _("Group Name"); ?></h2>

			<?php if(isset($_GET['err'])) : ?>
				<?php if($_GET['err'] == 1) : ?>
					<p style="color: red;"><?php echo _('Invalid group name value.'); ?></p><br>
				<?php endif; ?>
			<?php endif; ?>
			<?php if(isset($_GET['msg'])) : ?>
				<?php if($_GET['msg'] == 1) : ?>
					<p style="color: green;"><?php echo _('Successfully updated group name.'); ?></p><br>
				<?php endif; ?>
			<?php endif; ?>

			<label><?php echo _("Group Name"); ?>:</label>
			<?php foreach($groups as $group) { ?>
				<input type="text" name="gname" value="<?php echo $group['group_name']; ?>" >
				<input type="hidden" name="gid" value="<?php echo $group['group_id']; ?>" >
			<?php } ?>
			<div>
				<input id="save" class="button1 save-changes" type="submit" name="gsave" value="<?php echo _("Save"); ?>">
				<a href="student-accounts.php" class="button1 cancel-changes"><?php echo _("Cancel"); ?></a>
			</div>
		</form>
	</div>
</div>
<?php require_once "footer.php"; ?>