<?php
	require_once '../session.php';
	include_once '../locale.php';
	include_once 'header.php';
	include_once '../controller/User.Controller.php';
	
	$userid		= $_GET['user_id'];
	$user_set	= $uc->getUser($userid);

	if(isset($_POST['edit'])) {
		$password = $uc->hashPassword($_POST['oldpw']);
		$oldpassword = $user_set->getPassword();
		$tnp = $uc->hashPassword($_POST['newpw']);
		if($oldpassword != $password){
			header("Location: change-pw.php?user_id={$userid}&s=0");
			exit();
		} else if($oldpassword == $tnp){
			header("Location: change-pw.php?user_id={$userid}&s=2");
			exit();
		} else {
			$np = $_POST['newpw'];
			$uc->updatePassword($userid, $np);
			header("Location: change-pw.php?user_id={$userid}&s=1");
		}
	}
?>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="edit-account.php?user_id=<?php echo $userid; ?>">&laquo; <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class='wrap'>
<form method="post" id="change-pw" action=""><!-- save-pw.php?user_id=<?php echo $userid; ?> -->
		<h2 class="info-title"><?php echo _("Change Password"); ?></h2>
		<table class='details'>
			<?php 
				if(isset($_GET['s'])) { ?>
					<tr>
						<td colspan="2">
			<?php if($_GET['s'] == 1) { ?>
							<center><span class='green'><?php echo _("You have successfully changed your password."); ?></span></center>
			<?php } else if ($_GET['s'] == 0) { ?>
							<center><span class='red'><?php echo _("Incorrect password."); ?></span></center>
			<?php } else if ($_GET['s'] == 2) { ?>
							<center><span class='red'><?php echo _("Password must differ from old password."); ?></span></center>
			<?php } ?>
						</td>
					</tr>
			<?php } ?>
			<tr>
				<td colspan="2">
					<center>
						<p><?php echo _("Please copy the password somewhere so you have a copy of it."); ?></p>
					</center>
				</td>
			</tr>
			<tr>
				<td>
					<label><?php echo _("Enter Old Password:"); ?></label>
				</td>
				<td>
					<input type="password" name="oldpw" id="oldpw" data-validation="length" data-validation-length="min6" data-validation-error-msg="Please enter your current password">
				</td>
			</tr>
			<tr>
				<td>
					<label><?php echo _("Enter Password:"); ?></label>
				</td>
				<td>
					<input type="password" name="newpw" id="newpw" data-validation="length" data-validation-length="min6" data-validation-error-msg="Please enter a minimum of 6 characters">
				</td>
			</tr>
			<tr>
				<td>
					<label><?php echo _("Re-type Password:"); ?></label>
				</td>
				<td>
					<input type="password" name="confirm" id="confirm" data-validation="confirmation">
				</td>
			</tr>
		</table>
		<input id="edit" class="button1 save-changes" type="submit" name="edit" id="cpw" value="<?php echo _("Change Password"); ?>">
</form>
</div>
<script>
$(document).ready(function() {
	$('.button1').click(function(e) {
		if($('#newpw').val() != $('#confirm').val() && $('#newpw').val() != "") {
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