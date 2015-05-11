<?php
	require_once 'session.php';
	include_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/User.Controller.php';
	
	$userid		= $_GET['user_id'];
	$user_set	= $uc->getUser($userid);
?>
<div id="container">
<a class="link" href="edit-account.php?user_id=<?php echo $userid; ?>&f=0">&laquo; <?php echo _("Go Back"); ?></a>
<br><br>
<form method="post" id="change-pw" action="save-pw.php?user_id=<?php echo $userid; ?>">
	<center>
		<table>
			<?php 
				if(isset($_GET['s'])) { ?>
					<tr>
						<td colspan="2">
			<?php	if($_GET['s'] == 1) { ?>
							<center><span class='green'><?php echo _("You have successfully changed your password."); ?></span></center>
			<?php 	} else if ($_GET['s'] == 0) { ?>
							<center><span class='red'><?php echo _("Incorrect password."); ?></span></center>
			<?php 	} ?>
						</td>
					</tr>
			<?php 
				} 
			?>	
			<tr>
				<td colspan="2"><center><strong><?php echo _("Change Password"); ?></strong></center></td>
			</tr>
			<tr>
				<td>
					<?php echo _("Input Password:"); ?>
				</td>
				<td>
					<input type="text" name="newpw" id="newpw" data-validation="length" data-validation-length="min6">
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("Re-type Password:"); ?>
				</td>
				<td>
					<input type="text" name="confirm" id="confirm" data-validation="confirmation">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<br>
					<center>
						<input id="edit" class="button1" type="submit" name="edit" id="cpw" value="<?php echo _("Change Password"); ?>">
					</center>
				</td>
			</tr>
		</table>
	</center>
</form>
</div>
<script>
$(document).ready(function() {
	$('.button1').click(function(e) {
		if($('#newpw').val() == $('#confirm').val()) {
			alert('<?php echo _("Please copy the password somewhere so you have a copy of it. Have you made a copy?"); ?>');
		} else {
			e.preventDefault();
			alert('<?php echo _("Password does not match."); ?>');
		}
	});
});

$.validate({
  form : '#change-pw'
});
</script>
<?php require_once "footer.php"; ?>