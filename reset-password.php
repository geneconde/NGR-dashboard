<?php
	require_once 'session.php';
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'controller/User.Controller.php';

	$userid		= $_GET['user_id'];
	$user_set	= $uc->getUser($userid);

	$saved = false;
	if(isset($_POST['save'])) {
		$password = $_POST['password'];
		$uc->updatePassword($userid, $password);
		$saved = true;
		//header("Location: reset-password.php?user_id=$userid&f=1");
		$previous = "javascript:history.go(-2)";
	} else{
		$previous = "javascript:history.go(-1)";
	}
?>
<style>
	#dbguide { display: none; }
	.generate {
		cursor: default;
		background: lightgray;
		padding: 3px 7px;
		border-radius: 5px;
	}
	.generate:hover { background: rgb(188, 188, 188); }
	table td { width: 40% !important; }
	table { width: 380px !important;}
</style>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="<?php echo $previous; ?>">&laquo; <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="wrap">
<br><br>
<form method="post" action="" id="change-pw">
	<center>
		<table>
			<?php if($saved) : ?>

				<tr>
					<td colspan="3">
						<center><span class='green'><?php echo _("You have updated the account."); ?></span></center>
					</td>
				</tr>
			<?php endif; ?>
			<tr>
				<td colspan="3">
					<strong><center><?php echo _("Reset Password"); ?></center></strong>
				</td>
			</tr>
			<tr>
				<td>
					<label><?php echo _("New Password"); ?>:</label>

				</td>
				<td>
					<input type="text" name="password" id="password" class="editable" placeholder="<?php echo _('Enter new password'); ?>" minlength="6" required>
				</td>
				<td><a onclick="generatePass();" name="generate" class="generate" ><?php echo _('Generate'); ?></a></td>
			</tr>
			<tr>
				<td colspan="3">
					<br>
					<center>
					<div>
						<input id="save" class="button1" type="submit" name="save" value="<?php echo _("Save Changes"); ?>">
					</div>
					</center>
				</td>
			</tr>
		</table>
	</center>
</form>
</div>
<script>
var olduname = "<?php echo $user_set->getUsername(); ?>";
$(document).ready(function() {
	
	$('#uname').focusout(function() {
		var uid = $(this).val();
		if(uid != olduname) {
			$.ajax({
				type	: "POST",
				url		: "validate-user.php",
				data	: {	userid: uid },
				success : function(data) {
					if(data == 1) { 
						$('#check').attr('src','images/accept.png');
						$('#save').prop('disabled',false);
					} else { 
						$('#check').attr('src','images/error.png'); 
						$('#save').prop('disabled',true);
					}
				}
			});
		} else {
			$('#check').attr('src','images/accept.png');
			$('#save').prop('disabled',false);
		}
	});
});

function generatePass(){
	$( "#password" ).val(Math.random().toString(36).slice(-8));
}
</script>
<?php require_once "footer.php"; ?>