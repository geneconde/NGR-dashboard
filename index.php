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
?>
<style>#dbguide, .top-buttons .buttons { display: none; }</style>
	</div>
</div>
<div id="content">
<div class="wrap">
<br><br>
<div class="grey"></div>

<div class="mod-desc">
	<div id="forgot">

		<div id="desc-username">
			<h3>Forgot Password</h3>
			<form method="post" class="username" action="security-question.php">
				<label for="tUsername">Enter your username: </label>
				<input type="text" name="username" />

				<input type="submit" class="button1" name="submit-username">
			</form>	
		</div>

		<div id="sq" class="desc-forgot">
			<h3>Security Question</h3>
			<form method="POST" class="securityQuestionForm" action="security-question.php">
				<p class="sQuestion"></p>
				<label for="sqAnswer">Answer: </label>
				<input type="text" name="sqAnswer" />
				<input type="hidden" name="id" value="">
				<input type="hidden" name="uType" value="">
				<input type="submit" class="button1" name="submit-sqAnswer">
			</form>	
		</div>

		<div id="message" class="desc-forgot">
			<p></p>
		</div>
	</div>
	<span class="close-btn"><?php echo _("Close!"); ?></span>
</div>

<center><?php echo _("Welcome to NexGenReady! Please log in to your account."); ?></center>

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

</div>
<script>

	$(document).ready(function(){

		$('form.username').on('submit', function (e) {
			var formData = {
	            'username' : $('input[name=username]').val()
	        };
			$.ajax({
				type : 'POST',
				url : 'security-question.php',
				data : formData,
				dataType    : 'json',
				encode : true
			})
				.done(function(data) {
					if(data['type'])
					{ //if student
						if($("#sq").is(":visible"))
						{
							$("#sq").css('display', 'none');
						}
						$('#message').css('display', 'block');
						$('#message p').html(data['message']);
						$('#message').removeClass("error-div").addClass("info-div");
					} else
					{
						if(data['success'])
						{
							$('#sq').css('display', 'block');
							$('input[name="id"]').attr('value', data['id']);
							$('input[name="uType"]').attr('value', data['uType']);
							$('.sQuestion').html(data['message']);
							$('#message').css('display', 'none');
						} else {

							if($("#sq").is(":visible"))
							{
								$("#sq").css('display', 'none');
							}
							$('#message').css('display', 'block');
							$('#message p').html(data['message']);
							$('#message').removeClass("success-div").addClass("error-div");
						}
					}
				}).fail(function (jqXHR, textStatus) {
				    console.log(JSON.stringify(textStatus, null, 4) + " " + JSON.stringify(jqXHR, null, 4));
				});

			e.preventDefault();
        });

		$('form.securityQuestionForm').on('submit', function (e) {
			var formData = {
	            'sqAnswer' : $('input[name="sqAnswer"]').val(),
	            'id' : $('input[name="id"]').val(),
	            'uType' : $('input[name="uType"]').val()
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
				}).fail(function (jqXHR, textStatus) {
				    console.log(JSON.stringify(textStatus, null, 4) + " " + JSON.stringify(jqXHR, null, 4));
				});
			e.preventDefault();
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