<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	require_once 'controller/StudentGroup.Controller.php';

	if(isset($_GET['group_id']))
	{
		$group_id = $_GET['group_id'];	
	}
	
	$sgc 		= new StudentGroupController();
	$groups = $sgc->getGroupName($group_id);

	// $groups		= $sgc->getGroups($userid);

	if(isset($_POST['gsave']))
	{
		$group_name = $_POST['gname'];
		$id = $_POST['gid'];
		if($group_name == "")
		{
			header("Location: edit-group-name.php?group_id=" . $id . "&err=1");
		} 
		else 
		{
			$sgc->updateGroupName($id, $group_name);
			header("Location: edit-group-name.php?group_id=" . $id . "&msg=1");
		}
		
	}
	
?>
<div id="container">
	<a class="link" href="student-accounts.php">&laquo; <?php echo _("Go Back"); ?></a>
	<div class="edit-group-name">
		<?php if(isset($_GET['err'])) : ?>
			<?php if($_GET['err'] == 1) : ?>
				<p style="color: red;"><?php echo _('Invalid group name value.'); ?></p>
			<?php endif; ?>
		<?php endif; ?>
		<?php if(isset($_GET['msg'])) : ?>
			<?php if($_GET['msg'] == 1) : ?>
				<p style="color: green;"><?php echo _('Successfully updated group name.'); ?></p>
			<?php endif; ?>
		<?php endif; ?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="edit-group-name">
			<center>
				<table>
					<tr>
						<td colspan="2">
							<strong><center><?php echo _("Group Name"); ?></center></strong>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo _("Group Name"); ?>:
						</td>
						<td>
							<?php foreach($groups as $group) { ?>
								<input type="text" name="gname" value="<?php echo $group['group_name']; ?>" >
								<input type="hidden" name="gid" value="<?php echo $group['group_id']; ?>" >
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<br>
							<center>
								<div>
									<input id="save" class="button1" type="submit" name="gsave" value="<?php echo _("Save"); ?>">
									<a href="student-accounts.php" class="button1"><?php echo _("Cancel"); ?></a>
								</div>
							</center>
						</td>
					</tr>
				</table>
			</center>
		</form>
	</div>
</div>
<?php require_once "footer.php"; ?>