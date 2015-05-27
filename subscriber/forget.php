<?php 
	/*NGR Files*/
	ini_set('display_errors', 1);
	require_once '../session.php';
	require_once 'locale.php';
	// include_once '../controller/DiagnosticTest.Controller.php';
	// include_once '../controller/TeacherModule.Controller.php';
	// include_once '../controller/Module.Controller.php';
	include_once '../controller/Language.Controller.php';
	include_once('../controller/Subscriber.Controller.php');
	// include_once 'php/auto-generate.php';

	$sc = new SubscriberController();
	$sub = $sc->loadSubscriber($user->getSubscriber());

	//add parameter for is_deleted and is_archived later on method is under userController
	$teacher_count = $uc->countUserType($user->getSubscriber(), 0);

	$userid 			= $user->getUserid();
	$usertype			= $user->getType();
	$subid				= $user->getSubscriber();

	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

	$difference = $sub->getTeachers() - $teacher_count;

	if(isset($_POST['addmultiple'])){
		if($_POST['teacher_num'] != "") {
			//if($_POST['teacher_num'] > $difference){
				//header("Location: index.php?err=1");
			//} else {
				generateTeachers($_POST['teacher_num'], $sub->getID());
				header("Location: index.php?msg=1");
			//}
		} else {
			header("Location: index.php?err=2");
		}
			
	}
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>

<head>
	<title>NexGenReady</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<link rel="stylesheet" type="text/css" href="../style.css" />

	<script src="../phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="../phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>

<body>
	<div id="header">

		<a href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>

	</div>

	<!-- error and messages -->
	<?php if(isset($_GET['err'])) : ?>
		<?php if($_GET['err'] == 1) : ?>
			<div class="error-msg"><p><?php echo _('Error! you are only allowed to create'); ?> <?php echo $difference; ?> <?php echo _('teachers'); ?></p></div>
		<?php endif; ?>
		<?php if($_GET['err'] == 2) : ?>
			<div class="error-msg"><p><?php echo _('Please input a valid teacher value.'); ?></p></div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if(isset($_GET['msg'])) : ?>
		<?php if($_GET['msg'] == 1) : ?>
			<div class="success-msg" style="background-color: green; padding: 5px; text-align: center;"><p style="color: white;"><?php echo _('Successfully created teachers.'); ?></p></div>
		<?php endif; ?>
	<?php endif; ?>

	<div id="content">
	<br>
	<?php if (isset($user)) { ?>
	<div class="fright" id="logged-in">
		<?php echo _("You are currently logged in as"); ?> <span class="upper bold"><?php echo $user->getUsername(); ?></span>. <a class="link" href="../logout.php"><?php echo _("Logout?"); ?></a>
	</div>
	<?php } ?>
	<div class="clear"></div>

	<div class="fleft" id="language">
		<?php echo _("Language"); ?>:
		<select id="language-menu">
			<?php
				if(!empty($teacher_languages)) :
					foreach($teacher_languages as $tl) : 
						$lang = $lc->getLanguage($tl['language_id']);
			?>
						<option value="<?php echo $lang->getLanguage_code(); ?>" <?php if($language == $lang->getLanguage_code()) { ?> selected <?php } ?>><?php echo $lang->getLanguage(); ?></option>
			<?php 
					endforeach; 
				else :
			?>
				<option value="en_US" <?php if($language == "en_US") { ?> selected <?php } ?>><?php echo _("English"); ?></option>
			<?php endif; ?>
		</select>
		<a href="edit-languages.php" class="link"><?php echo _("Edit Languages"); ?></a>
	</div>
	<div class="fright m-top10" id="accounts">
		<a class="link fright" href="edit-account.php?user_id=<?php echo $userid; ?>&f=0"><?php echo _("My Account"); ?></a>
	</div>
	<div class="clear"></div>
	<!-- <h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $sub->getFirstName(); ?></span>!</h1>
	<p><?php echo _("This is your Dashboard. In this page, you can manage your teachers and students information"); ?>
	<p><?php echo _("You are only allowed to create " . $sub->getTeachers() . " teachers and " . $sub->getStudents() . " students"); ?> -->


		<div class="wrap-container">
			<div id="wrap">
				<center>
					<table>
						<tr>
							<td colspan="2">
								<strong><center><?php echo _("Forget Password"); ?></center></strong>
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
								<!-- <a href="change-pw.php?user_id=<?php echo $userid; ?>" id="cp"><?php echo _("Change Password"); ?></a> -->
								<input type="text" name="password" id="password" value="<?php echo $user_set->getPassword(); ?>" class="editable"><img src="" id="check">
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
			</div>
		</div>	

	</div>

	<div id="footer" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
		<div class="copyright">
			<p>© 2014 NexGenReady. <?php echo _("All Rights Reserved."); ?>
			<a class="link f-link" href="../../marketing/privacy-policy.php"><?php echo _("Privacy Policy"); ?></a> | 
			<a class="link f-link" href="../../marketing/terms-of-service.php"><?php echo _("Terms of Service"); ?></a>
	
			<a class="link fright f-link" href="../../marketing/contact.php"><?php echo _("Need help? Contact our support team"); ?></a>
			<span class="fright l-separator">|</span>
			<a class="link fright f-link" href="../../marketing/bug.php"><?php echo _("File Bug Report"); ?></a>
			</p>
		</div>
	</div>


</body>
</html>	