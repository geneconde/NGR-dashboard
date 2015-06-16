<?php
	require_once 'session.php';
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'controller/User.Controller.php';
	require_once 'controller/Security.Controller.php';

	$sc = new SecurityController();
	$userid		= $_GET['user_id'];
	$user_set	= $uc->getUser($userid);
	$gender 	= $user_set->getGender();
	$type		= $user_set->getType();

	$questions = $sc->getAllQuestions();
	$securityRecord = $sc->getSecurityRecord($userid);

	$answer = "";
	$questionID = "";
	if(sizeof($securityRecord) == 1){
		$questionID = $securityRecord[0]['question_id'];
		$answer = $securityRecord[0]['answer'];
	}
?>
<style>
	select { width: 295px; }
	.answer { width: 290px !important; }
</style>
<div id="container">
<?php if($type == 2) { ?>
<a class="link" href="student-accounts.php">&laquo; <?php echo _("Go Back"); ?></a>
<?php } else if($type == 0) { ?>
<a class="link" href="teacher.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>
<?php } ?>
<br><br>
<form method="post" action="save-account.php?user_id=<?php echo $userid; ?>&type=<?php echo $type; ?>" id="edit-account">
	<center>
		<table>
			<?php 
				if(isset($_GET['f'])) {
					if($_GET['f'] == 1) { ?>
				<tr>
					<td colspan="2">
						<center><span class='green'><?php echo _("You have updated the account."); ?></span></center>
					</td>
				</tr>
			<?php 	}
				}
			?>
			<tr>
				<td colspan="2">
					<strong><center><?php echo _("User Information"); ?></center></strong>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("Username"); ?>:
				</td>
				<td>
					<!-- <input type="text" name="username" id="uname" value="<?php echo $user_set->getUsername(); ?>" disabled class="editable"><img src="" id="check"> -->
					<input type="text" name="username" id="uname" value="<?php echo $user_set->getUsername(); ?>" class="editable"><img src="" id="check">
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("Password"); ?>:
				</td>
				<td>
					<a href="change-pw.php?user_id=<?php echo $userid; ?>" id="cp"><?php echo _("Change Password"); ?></a>
					<!-- <input type="text" name="password" id="password" value="<?php echo $user_set->getPassword(); ?>" class="editable"><img src="" id="check"> -->
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("First Name"); ?>:
				</td>
				<td>
					<!-- <input type="text" name="fname" value="<?php echo $user_set->getFirstname(); ?>" disabled class="editable" data-validation="required" data-validation-error-msg="<?php echo _("You must enter a first name."); ?>"> -->
					<input type="text" name="fname" value="<?php echo $user_set->getFirstname(); ?>" class="editable" data-validation="required" data-validation-error-msg="<?php echo _("You must enter a first name."); ?>">
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("Last Name"); ?>:
				</td>
				<td>
					<!-- <input type="text" name="lname" value="<?php echo $user_set->getLastname(); ?>" disabled class="editable" data-validation="required" data-validation-error-msg="<?php echo _("You must enter a last name."); ?>"> -->
					<input type="text" name="lname" value="<?php echo $user_set->getLastname(); ?>" class="editable" data-validation="required" data-validation-error-msg="<?php echo _("You must enter a last name."); ?>">
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("Gender"); ?>:
				</td>
				<td>
					<input type="radio" name="gender" id="m" class="gender editable"  <?php if($gender == "m") { ?> checked <?php } ?> value="M"><label for="m"> <?php echo _("Male"); ?></label>
					<input type="radio" name="gender" id="f" class="gender editable"  <?php if($gender == "f") { ?> checked <?php } ?> value="F"><label for="f"> <?php echo _("Female"); ?></label>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong><center><?php echo _("Security Information"); ?></center></strong>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<?php echo _('Security Question'); ?>:
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<select name="squestion">
						<?php
						$i = 1;
						foreach ($questions as $question) { ?>
						   <option <?php if($questionID == $i) { ?> selected <?php } ?> value="<?php echo $question['question_id']; ?>"><?php echo $question["question"]; ?></option> 
						<?php $i++; } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<?php echo _('Security Answer'); ?>:
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input class="answer" id="sanswer" name="sanswer" type="text" placeholder="Enter your answer..." value="<?php echo $answer; ?>" required/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<br>
					<center>
					<!-- <input id="edit" class="button1" type="submit" name="edit" value="<?php echo _("Edit Info"); ?>"> -->
					<!-- <div class="hidden-btn"> -->
					<div>
						<input id="save" class="button1" type="submit" name="save" value="<?php echo _("Save Changes"); ?>">
						<!-- <input id="cancel" class="button1" type="submit" name="cancel" value="<?php echo _("Cancel"); ?>"> -->
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
	// $('#edit').click(function(e) {
	// 	e.preventDefault();
	// 	$('.editable').prop('disabled',false);
	// 	$(this).hide();
	// 	$('.hidden-btn').show();
	// });
	
	// $('#cancel').click(function(e) {
	// 	e.preventDefault();
	// 	$('.editable').prop('disabled',true);
	// 	$('.hidden-btn').hide();
	// 	$('#edit').show();
	// });
	
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

$.validate({
  form : '#edit-account'
});
</script>
<?php require_once "footer.php"; ?>