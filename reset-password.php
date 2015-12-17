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
		$uc->updateStudentPassword($userid, $password);
		$saved = true;
		//header("Location: reset-password.php?user_id=$userid&f=1");
		$previous = "javascript:history.go(-2)";
	} else{
		$previous = "javascript:history.go(-1)";
	}
?>
<style>
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
<form method="post" action="" id="change-pw">
	<?php if($saved) : ?>
		<span class='green'><?php echo _("You have updated the account."); ?></span><br>
	<?php endif; ?>
	<br>
	<h2><?php echo _("Reset Password"); ?></h2><br>
	<label><?php echo _("New Password"); ?>:</label>
	<input type="text" name="password" id="password" class="editable" placeholder="<?php echo _('Enter new password'); ?>" minlength="6" required>
	<a onclick="generatePass();" name="generate" class="generate" ><?php echo _('Generate'); ?></a>
	<br><br>
	<div>
		<input id="save" class="button1 save-test" type="submit" name="save" value="<?php echo _("Save Changes"); ?>">
	</div>
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