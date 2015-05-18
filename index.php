<?php 
session_start();
if (isset($_SESSION['uname'])) {
	include_once('controller/User.Controller.php'); 
	include_once('controller/Subscriber.Controller.php');
	include_once 'controller/Security.Controller.php';

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
	include_once 'controller/Security.Controller.php';

	require_once "locale.php";
	include_once "header.php";
	include_once 'php/auto-generate.php';

	$uc = new UserController();
	$sc = new SubscriberController();
	$sec = new SecurityController();

	// $exist = $sc->checkEmailExistsSubscribe('julius.caluminga@jigzen.com');
?>

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
			<form method="post" class="email" action="security-question.php">
				<label for="email">Enter your email address: </label>
				<input type="text" name="email" />

				<input type="submit" class="button1" name="submit-email">
			</form>	
		</div>

		<div id="desc-teacher" class="desc-forgot">
			<h3>Forgot Password for Teacher</h3>
			<form method="post" class="teacher" action="security-question.php">
				<label for="tUsername">Enter your username: </label>
				<input type="text" name="tUsername" />
				<input type="hidden" name="teacher" value="teacher">

				<input type="submit" class="button1" name="submit-teacher">
			</form>	
		</div>

		<div id="desc-student" class="desc-forgot">
			<h3>Forgot Password for Student</h3>
			<form method="POST" class="student" action="security-question.php">
				<label for="sUsername">Enter your username: </label>
				<input type="text" name="sUsername" />
				<input type="hidden" name="student" value="student">

				<input type="submit" class="button1" name="submit-student">
			</form>	
		</div>

		<div id="sq" class="desc-forgot">
			<h3>Security Question</h3>
			<form method="POST" class="securityQuestionForm" action="security-question.php">
				<p class="sQuestion"></p>
				<label for="sqAnswer">Answer: </label>
				<input type="text" name="sqAnswer" />
				<input type="hidden" name="id" value="">
				<input type="submit" class="button1" name="submit-sqAnswer">
			</form>	
		</div>

		<div id="esq" class="desc-forgot">
			<h3>Security Question</h3>
			<form method="POST" class="emailQuestionForm" action="security-question.php">
				<p class="esQuestion"></p>
				<label for="esqAnswer">Answer: </label>
				<input type="text" name="esqAnswer" />
				<input type="hidden" name="eid" value="">
				<input type="hidden" name="email2" value="">
				<input type="submit" class="button1" name="submit-esqAnswer">
			</form>	
		</div>

		<div id="message" class="desc-forgot">
			<p></p>
		</div>
	</div>
	<span class="close-btn"><?php echo _("Close!"); ?></span>
</div>

<center><?php echo _("Welcome to NextGenReady! Please log in to your account."); ?></center>

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

		$('form.email').on('submit', function (e) {
			var formData = {
	            'email' : $('input[name=email]').val()
	        };
			$.ajax({
				type : 'POST',
				url : 'security-question.php',
				data : formData,
				dataType    : 'json',
				encode : true
			})
				.done(function(data) {
					if(data['success']){
						$('#esq').css('display', 'block');
						$('input[name="eid"]').attr('value', data['id']);
						$('input[name="email2"]').attr('value', data['email']);
						$('.esQuestion').html(data['message']);
						$('#message').css('display', 'none');
					} else {

						if($("#esq").is(":visible")){
							$("#esq").css('display', 'none');
						}
						$('#message').css('display', 'block');
						$('#message p').html(data['message']);
						$('#message').removeClass("success-div").addClass("error-div");
					}
				});
			e.preventDefault();
        });

		$('form.student').on('submit', function (e) {
			var formData = {
	            'username' : $('input[name=sUsername]').val(),
	            'type' : $('input[name=student]').val()
	        };
			$.ajax({
				type : 'POST',
				url : 'security-question.php',
				data : formData,
				dataType    : 'json',
				encode : true
			})
				.done(function(data) {
					if(data['success']){
						$('#sq').css('display', 'block');
						$('input[name="id"]').attr('value', data['id']);
						$('.sQuestion').html(data['message']);
						$('#message').css('display', 'none');
					} else {

						if($("#sq").is(":visible")){
							$("#sq").css('display', 'none');
						}
						$('#message').css('display', 'block');
						$('#message p').html(data['message']);
						$('#message').removeClass("success-div").addClass("error-div");
					}
				});
			e.preventDefault();
        });

		$('form.teacher').on('submit', function (e) {
			var formData = {
	            'username' : $('input[name=tUsername]').val(),
	            'type' : $('input[name=teacher]').val()
	        };
			$.ajax({
				type : 'POST',
				url : 'security-question.php',
				data : formData,
				dataType    : 'json',
				encode : true
			})
				.done(function(data) {
					if(data['success']){
						$('#sq').css('display', 'block');
						$('input[name="id"]').attr('value', data['id']);
						$('.sQuestion').html(data['message']);
						$('#message').css('display', 'none');
						$('#message').removeClass("success-div").addClass("error-div");
					} else {

						if($("#sq").is(":visible")){
							$("#sq").css('display', 'none');
						}
						$('#message').css('display', 'block');
						$('#message p').html(data['message']);
					}
				});
			e.preventDefault();
        });

		$('form.securityQuestionForm').on('submit', function (e) {
			var formData = {
	            'sqAnswer' : $('input[name="sqAnswer"]').val(),
	            'id' : $('input[name="id"]').val()
	        };
			$.ajax({
				type : 'POST',
				url : 'security-question.php',
				data : formData,
				dataType    : 'json',
				encode : true
			})
				.done(function(data) {
					$('#message').css('display', 'block');
					$('#message p').html(data['message']);
					if(data['success']){
						$('#message').removeClass("error-div").addClass("success-div");
					} else {
						$('#message').removeClass("success-div").addClass("error-div");
					}
				});
			e.preventDefault();
        });

		$('form.emailQuestionForm').on('submit', function (e) {
			var formData = {
	            'email2' : $('input[name=email2]').val(),
	            'esqAnswer' : $('input[name="esqAnswer"]').val(),
	            'eid' : $('input[name="eid"]').val()
	        };
			$.ajax({
				type : 'POST',
				url : 'security-question.php',
				data : formData,
				dataType    : 'json',
				encode : true
			})
				.done(function(data) {
					$('#message').css('display', 'block');
					$('#message p').html(data['message']);
					if(data['success']){
						$('#message').removeClass("error-div").addClass("success-div");
					} else {
						$('#message').removeClass("success-div").addClass("error-div");
					}
				});
			e.preventDefault();
        });


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
	
	$(".grey").on("click", function(){
		if($('.security-wrapper').is(":visible")){
			$(".security-wrapper").css("display", "none");
		} else {
			$(".mod-desc").css("display", "none");
		}
		$(".grey").css("display", "none");
	});

	$("input[name='check-answer']").on("click", function(){
		$(".security-wrapper").css("display", "none");
		$(".grey").css("display", "none");
	});
</script>
<?php require_once "footer.php"; ?>