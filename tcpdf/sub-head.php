<?php 
session_start();
if (isset($_SESSION['uname'])) {
	include_once('controller/User.Controller.php'); 
	include_once('controller/Subscriber.Controller.php');

	
	$user = null;
	
	$uc = new UserController();
	$sc = new SubscriberController();

	if(isset($_SESSION['uname'])){
		$user = $uc->loadUser($_SESSION['uname']);
	}

	if ($user->getType() == '0') {
		header("Location: teacher.php"); exit;	
	} else if($user->getType() == '1'){
		header("Location:parent/parent.php");exit;
	} else if($user->getType() == '2') {
		header("Location:student.php");exit;
	} else if($user->getType() == '3') {
		header("Location: subscriber/index.php");exit;
	}
}
	include_once('controller/User.Controller.php'); 
	include_once('controller/Subscriber.Controller.php');

	require_once "locale.php";
	include_once "header.php";
	include_once 'php/auto-generate.php';

	$uc = new UserController();
	$sc = new SubscriberController();

	// $exist = $sc->checkEmailExistsSubscribe('julius.caluminga@jigzen.com');



	if(isset($_POST['submit-email'])){

		$email = $_POST['email'];
		$new_pass = generatePassword();

		$exists = $sc->checkEmailExistsSubscribe($email);

		if($exists == 1) {

			$sid = $sc->getIdByEmail($email);

			$userid = $sid[0]['id'];

			$uc->updatePasswordByEmail($userid, $new_pass);

			$to 		= $email;
			$from 		= 'nexgen@nexgenready.com';
			$subject	= 'Your New Password (NexGenReady)';

			$message = '<html><body>';
	        $message .= '<div style="width: 70%; margin: 0 auto;">';
	        $message .= '<div style="background: #083B91; padding: 10px 0;">' . '<img src="http://nexgenready.com/img/logo/logo2.png" />';
	        $message .= '</div>';
	        $message .= '<div style="margin-top: 10px; padding: 15px 0 10px 0;">';
	        $message .= '<p>Hi '. $email .'!</p>' . '</br>';
	        $message .= '<p>Your New Password is: '. $new_pass .'</p>';
	        $message .= '<p style="margin-bottom: 0;">Best Regards,</p>';
	        $message .= '<p style="margin: 0;">NexGenReady Team</p>';
	        $message .= '</div>';
	        $message .= '<div style="background: #272626; color: white; padding: 5px; text-align: center;">';
	        $message .= '<p sytle="color: white;">&copy; 2014 Interactive Learning Online, LLC. ALL Rights Reserved. <a style="color: #f79539;" href="http://nexgenready.com/privacy-policy">Privacy Policy</a> | <a style="color: #f79539;" href="http://nexgenready.com/terms-of-service">Terms of Service</a></p>';
	        $message .= '</div>';
	        $message .= '</div>';
	        $message .= '<body></html>';

	        // To send HTML mail, the Content-type header must be set
			$headers = "From: ".'NexGenReady'. '<webmaster@nexgenready.com>'. "\r\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	        $mail = @mail($to, $subject, $message, $headers);

	        if($mail){ ?>
				<script type="text/javascript">
					alert("<?php echo 'Your new password was sent to your email address '. $email; ?>");
				</script>
			<?php } ?>
		<?php } else { ?>
				<script type="text/javascript">
					alert("<?php echo 'Sorry, the email address that you have entered is not registered.' ?>");
				</script>
	<?php
			}	
	}

	if(isset($_POST['submit-teacher'])){
		if($_POST['tfname'] != '' && $_POST['tlname'] != '')
		{
			$tfname = $_POST['tfname'];
			$tlname = $_POST['tlname'];

			$exists = $uc->checkNameExists($tfname, $tlname, 0);

			if($exists){

			$new_pass = generatePassword();

			$uc->updatePasswordByNames($tfname, $tlname, 0, $new_pass); ?>

			<script type="text/javascript">
				alert("<?php echo 'Your New Password is: '. $new_pass; ?>");
			</script>

			<?php } else { ?>

			<script type="text/javascript">
				alert("<?php echo 'Sorry, the names that you have entered is not registered.'; ?>");
			</script>
		<?php } ?>

	<?php } else { ?>	
		<script type="text/javascript">
			alert("<?php echo 'Please input a correct value.'; ?>");
		</script>
	<?php } ?>
	

<?php }

	if(isset($_POST['submit-student'])){

		if($_POST['sfname'] != '' && $_POST['slname'] != '') {
			$sfname = $_POST['sfname'];
			$slname = $_POST['slname'];

			$exists = $uc->checkNameExists($sfname, $slname, 2);

			if($exists){

			$new_pass = generatePassword();

			$uc->updatePasswordByNames($sfname, $slname, 2, $new_pass); ?>

				<script type="text/javascript">
					alert("<?php echo 'Your New Password is: '. $new_pass; ?>");
				</script>

			<?php } else { ?>

				<script type="text/javascript">
					alert("<?php echo 'Sorry, the names that you have entered is not registered.'; ?>");
				</script>
			<?php } ?>

		<?php } else { ?>	
			<script type="text/javascript">
				alert("<?php echo 'Please input a correct value.'; ?>");
			</script>
		<?php } ?>
	<?php } ?>
<div class="grey"></div>

<div class="mod-desc">
	<div id="forgot">
		<label for="type">Type: </label>
		<select name="type" id="type">
			<option selected>Choose a type...</option>
			<option value="subscriber">Subscriber</option>
			<option value="teacher">Teacher</option>
			<option value="student">Student</option>
		</select>

		<div id="desc-subscriber" class="desc-forgot">
			<h3>Forgot Password for Subscriber</h3>
			<form method="post" >
				<label for="email">Enter your email address: </label>
				<input type="text" name="email" />

				<input type="submit" class="button1" name="submit-email">
			</form>	
		</div>

		<div id="desc-teacher" class="desc-forgot">
			<h3>Forgot Password for Teacher</h3>
			<form method="post">
				<label for="tfname">Enter your First Name: </label>
				<input type="text" name="tfname" />

				<label for="tlname">Enter your Last Name: </label>
				<input type="text" name="tlname" />

				<input type="submit" class="button1" name="submit-teacher">
			</form>	
		</div>

		<div id="desc-student" class="desc-forgot">
			<h3>Forgot Password for Student</h3>
			<form method="post">
				<label for="sfname">Enter your First Name: </label>
				<input type="text" name="sfname" />

				<label for="slname">Enter your Last Name: </label>
				<input type="text" name="slname" />

				<input type="submit" class="button1" name="submit-student">
			</form>	
		</div>

	</div>
	
	<span class="close-btn"><?php echo _("Close!"); ?></span>
</div>

<center><?php echo _("Welcome to NextGenReady! Please log in to your account."); ?></center>
<?php 
	// $test = $sc->loadSubscriber();
// 	$tfname = 'Julius';
// 	$tlname = 'Caluminga';
// // 	// $test = $uc->checkNameExists($fname,$lname);
// $exists = $uc->checkNameExists($tfname,$tlname);

// if($exists)
// {
// 	echo '1';
// } 
// else 
// {
// 	echo '0';
// }

	// // $test = $sc->getIdByEmail('julius.caluminga@jigzen.com');
	// // echo $test[0]['id'];
	// echo '<pre>';
	// print_r($test);
	// echo '</pre>';
?>
<form method="post" action="login.php" name="login" id="login" class="box-shadow">
	<?php if (isset($_GET['msg'])) { ?>
		<?php if($_GET['msg']== 1) {?>
			<span class="msg"><?php echo _("Registration Sucessful. We sent you an email. Please verify your account."); ?></span><br/><br/>
		<?php } else {?>
			<span class="msg"><?php echo _("Your new password is sent to your email."); ?></span><br/><br/>
		<?php } ?>
	<?php }  ?>
	<?php if (isset($_GET['err'])) { ?>
		<span class="err"><?php echo _("Sorry, wrong username or password."); ?></span><br/><br/>
	<?php } ?>
	<?php if (isset($_GET['deac'])) { ?>
		<span class="err"><?php echo _("Sorry, this user has been deactivated."); ?></span><br/><br/>
	<?php } ?>	
	<span><?php echo _("Username"); ?></span><br/>
	<div class="input"><input type="text" class="login_field" name="username" id="username"/></div>
	<span><?php echo _("Password"); ?></span><br/>
	<div class="input"><input type="password" class="login_field" name="password" id="password"/></div>
	<input type="submit" class="button1" value="Login" name="login" />
	<a href="#" class="desc-btn" style="float:right;">Forgot Password?</a>
</form>
<center>
	<p id="new_pass"></p>
</center>

<script>

	$(document).ready(function(){

		$('#type').change(function(){

			type = $(this).val();

			if(type == 'subscriber') {
				$('.desc-forgot').css('display', 'none');
				$('#desc-subscriber').css('display', 'block');
			}
			else if(type == 'teacher') {
				$('.desc-forgot').css('display', 'none');
				$('#desc-teacher').css('display', 'block');
			}
			else if(type == 'student') {
				$('.desc-forgot').css('display', 'none');
				$('#desc-student').css('display', 'block');
			}

		});	
	});	

	$(".close-btn").on("click", function(){
		$(".mod-desc").css("display", "none");
		$(".grey").css("display", "none");
	});
	
	$(".desc-btn").on("click", function(){
		$('.mod-desc').css("display", "block");
		
		//$(".mod-desc").css("display", "block");
		$(".grey").css("display", "block");
	});

</script>
<?php require_once "footer.php"; ?>