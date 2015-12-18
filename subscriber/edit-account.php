<?php
	require_once '../session.php';
	require_once 'locale.php';
	require_once 'header.php';
	require_once '../controller/User.Controller.php';
	require_once '../controller/Security.Controller.php';

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

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="index.php">&laquo; <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class='wrap'>
<form method="post" action="save-account.php?user_id=<?php echo $userid; ?>&type=<?php echo $type; ?>" id="edit-account">
	<h2 class="info-title"><?php echo _("User Information"); ?></h2>
		<?php  if(isset($_GET['f'])) {
			if($_GET['f'] == 1) { ?>
				<span class='green'><?php echo _("You have updated the account."); ?></span>
		<?php  } } ?>
	<table class="details" id="edit-account">
		<tr>
			<td>
				<?php echo _("Username"); ?>:
			</td>
			<td>
				<!-- <input type="text" name="username" id="uname" value="<?php echo $user_set->getUsername(); ?>" disabled class="editable"><img src="" id="check"> -->
				<input type="text" name="username" id="uname" value="<?php echo $user_set->getUsername(); ?>" class="editable" data-validation="required" data-validation-error-msg="<?php echo _("You must enter a username."); ?>"><img src="" id="check">
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
				<input type="text" name="fname" id="fname" value="<?php echo $user_set->getFirstname(); ?>" class="editable" data-validation="required" data-validation-error-msg="<?php echo _("You must enter a first name."); ?>">
			</td>
		</tr>
		<tr>
			<td>
				<?php echo _("Last Name"); ?>:
			</td>
			<td>
				<!-- <input type="text" name="lname" value="<?php echo $user_set->getLastname(); ?>" disabled class="editable" data-validation="required" data-validation-error-msg="<?php echo _("You must enter a last name."); ?>"> -->
				<input type="text" name="lname" id="lname" value="<?php echo $user_set->getLastname(); ?>" class="editable" data-validation="required" data-validation-error-msg="<?php echo _("You must enter a last name."); ?>">
			</td>
		</tr>
		<tr>
			<td>
				<?php echo _("Gender"); ?>:
			</td>
			<td id="gender">
				<input type="radio" name="gender" id="m" class="gender editable"  <?php if($gender == "m") { ?> checked <?php } ?> value="M"><label for="m"> <?php echo _("Male"); ?></label>
				<input type="radio" name="gender" id="f" class="gender editable"  <?php if($gender == "f") { ?> checked <?php } ?> value="F"><label for="f"> <?php echo _("Female"); ?></label>
			</td>
		</tr>
		</table>
		<h2 class="info-title"><?php echo _("Security Information"); ?></h2>
		<table class="details">
		<tr>
			<td colspan="2">
				<?php echo _('Security Question'); ?>:
			</td>
		</tr>
		<tr>
			<td colspan="2" class="squestion">
				<select name="squestion" id="squestion">
					<?php
					$i = 1;
					foreach ($questions as $question) { ?>
					   <option <?php if($questionID == $i) { ?> selected <?php } ?> value="<?php echo $question['question_id']; ?>"><?php echo _($question["question"]); ?></option> 
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
			<td colspan="2" class="sanswer">
				<input class="answer" id="sanswer" name="sanswer" type="text" placeholder="Enter your answer..." value="<?php echo $answer; ?>" required/>
			</td>
		</tr>
	</table>
	<input id="save" class="button1 save-changes" type="submit" name="save" value="<?php echo _("Save Changes"); ?>">
</form>
</div>

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_right" data-tourtarget="#uname">
    <p><?php echo _("Update your <strong>username</strong> to something that you can easily remember."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#cp">
    <p><?php echo _("Update your <strong>password</strong> to something that you can easily remember."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#fname">
    <p><?php echo _("Update your <strong>first name</strong>."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#lname">
    <p><?php echo _("Update your <strong>last name</strong>."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#gender">
    <p><?php echo _("Select your <strong>gender</strong>."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#squestion">
    <p><?php echo _("Choose a security question and enter in your answer for that question. This will be used to change your password if you forget it in the future."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#sanswer">
    <p><?php echo _("Enter the answer to your security question. This is case sensitive."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#save">
    <p><?php echo _("Click the <strong>Save Changes</strong> button to save your changes."); ?></p>
  </li>
</ul>
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
		uid = $.trim(uid);
		$('#uname').val(uid);
		if(uid != olduname) {
			$.ajax({
				type	: "POST",
				url		: "../validate-user.php",
				data	: {	userid: uid },
				success : function(data) {
					if(data == 1 && uid != '') { 
						$('#check').attr('src','../images/accept.png');
						$('#save').prop('disabled',false);
					} else { 
						$('#check').attr('src','../images/error.png'); 
						$('#save').prop('disabled',true);
					}
				}
			});
		} else {
			$('#check').attr('src','../images/accept.png');
			$('#save').prop('disabled',false);
		}
	});
});

$.validate({
  form : '#edit-account'
});
</script>
<?php require_once "footer.php"; ?>