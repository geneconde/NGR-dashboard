<?php 
	ini_set('display_errors', '1');
	require_once 'session.php';	
	require_once 'locale.php';	
	require_once 'header.php';
	require_once 'controller/StudentModule.Controller.php';
	require_once 'controller/Module.Controller.php';
	require_once 'controller/Exercise.Controller.php';
	require_once 'controller/StudentAnswer.Controller.php';
	require_once 'controller/Question.Controller.php';
	require_once 'controller/ModuleMeta.Controller.php';
	require_once 'controller/MetaAnswer.Controller.php';
	require_once 'controller/Feedback.Controller.php';
	include_once 'php/generate-email.php';

	$sid 	= $_GET['sid'];
	$mid 	= $_GET['mid'];

	$_SESSION['stud_id'] 	= $sid;
	$_SESSION['mod_id']		= $mid;

	$smc 	= new StudentModuleController();
	$mc 	= new ModuleController();
	$ec 	= new ExerciseController();
	$sac 	= new StudentAnswerController();
	$qnc 	= new QuestionController();
	$mmc 	= new ModuleMetaController();
	$mac 	= new MetaAnswerController();
	$fbc	= new FeedbackController();
	
	$sm 	= $smc->loadSMbyUserID($sid, $mid);
	$m 		= $mc->loadModule($mid);
	$u 		= $uc->loadUserByID($sid);
	$qc 	= $ec->loadExercisesByType($mid,0);
	$qq 	= $ec->loadExercisesByType($mid,1);
	$totalcorrect = 0;
	$total = 0;

	$letters = range('A', 'Z');

	if($_SESSION["lang"] == 'en_US') $curlang = "english";
	else if($_SESSION["lang"] == "ar_EG") $curlang = "arabic";
	else if($_SESSION["lang"] == "es_ES") $curlang = "spanish";
	else if($_SESSION["lang"] == "zh_CN") $curlang = "chinese";	
?>
<style>
	table.result { width: 100% !important; }
</style>
<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="view-portfolio.php?user_id=<?php echo _($sid); ?>">&laquo; <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="wrap module-results">
		<h1><?php echo _("Module Results"); ?></h1>
		<div id="pdf-button" class="btn">
			<a class="btn fleft" href="php/generate-result.php" target="_blank"><i class="fa fa-file-pdf-o"></i><?php echo _('PDF'); ?></a>
			<a id="email-btn" class="btn fleft" href="#"><i class="fa fa-envelope"></i><?php echo _('Email'); ?></a>
		</div>
		<div class="clear"></div>
		<br>
		<div id="results">
			<table border="0" id="info" class="details">
				<tr>
					<td class="bold"><?php echo _("Name"); ?></td>
					<td><?php echo _($u->getFirstname() . ' ' . $u->getLastname()); ?></td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Module"); ?></td>
					<td><?php echo _($m->getModule_name()); ?></td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Date"); ?></td>
					<td><?php echo date('F j, Y H:i:s',strtotime($sm['date_started'])); ?></td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Date"); ?></td>
					<td><?php echo date('F j, Y H:i:s',strtotime($sm['date_finished'])); ?></td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Score"); ?></td>
					<td><span id="score"></span></td>
				</tr>
			</table>
			<div class="clear"></div>
			<br><h3><?php echo _("Quick Check Results"); ?></h3><br>
			<?php foreach ($qc as $exercise) {
				$eq = $qnc->loadQuestions($exercise['exercise_ID']);

				$sections = $qnc->getExerciseSections($exercise['exercise_ID']);

				$arr = explode('/', $exercise['screenshot']);
				array_splice($arr, 5, 0, $curlang );
				$ex_screenshot = implode("/", $arr);
			?>
			<br/>
			<center><img src="<?php echo $ex_screenshot;?>" width="80%"></center>
			<table border="0" class="result center portfolio1">
				<tr>
					<th colspan="4"><?php echo _($exercise['title']); ?></th>
				</tr>
				<tr>
					<th><?php echo _('Activity Code'); ?></th>
					<th><?php echo _('Student Answer'); ?></th>
					<th><?php echo _('Correct Answer'); ?></th>
					<th><?php echo _('Result'); ?></th>
				</tr>
				<?php 
					$answer = '';
					$answers = array();
					foreach ($eq as $question) {
						$total++;
						$answer = $sac->getStudentAnswer($sm['student_module_ID'],$question['question_ID']);
						$img = 'wrong';

						for($i = 0; $i < count($sections); $i++) {
							if($question['section'] == $letters[$i]) {
								if(!isset($answers[$i])) {
									$answers[$i] = $answer;
								} else {
									$answers[$i] = $answers[$i] . ',' . $answer;
								}
							}
						}

						if ($answer === $question['correct_answer']) {
							$img = 'correct';
							$totalcorrect++;
						}
				?>
					<tr>
						<td><?php echo _($exercise['shortcode']) . ' - ' . _('Question ' . $question['section']); ?></td>
						<?php 
						if(strpos($answer,"chemical,mechanical,heat") !== false){
							echo "<script>alert('asdtest'); </script>";
						}
						?>
						<td><?php echo _($answer); ?></td>
						<td><?php echo _($question['correct_answer']); ?></td>
						<td>
							<?php if($img == 'correct') { ?>
								<i class="fa fa-check"></i>
							<?php } else { ?>
								<i class="fa fa-times"></i>
							<?php } ?>
						</td>

					</tr>
				<?php } ?>
			</table>
			<div class="clear"></div>
			<table border="0" class="result center portfolio2">
				<tr>
					<th><?php echo _('Activity Code'); ?></th>
					<th style="width: 400px;"><?php echo _('Feedback'); ?></th>
				<tr>

			<?php 
					for($i = 0; $i < count($sections); $i++) {
						$feedback = $fbc->getFeedback($exercise['exercise_ID'], $sections[$i], $answers[$i]);

						if(!$feedback) {
							$feedback = $fbc->getFeedback($exercise['exercise_ID'], $sections[$i], 'X');
						}
			?>
						<tr>
							<td class="center"><?php echo _($exercise['shortcode']) . ' - ' . _('Question ' . $letters[$i]); ?></td>
							<td class="center"><?php echo _($feedback[0]); ?></td>
						</tr>
			<?php 	} ?>
			</table>
			<hr>
			<?php } ?>
			
			<h3 class="center"><?php echo _("Quiz Question Results"); ?></h3><br>
			<?php foreach ($qq as $exercise) {
				$eq = $qnc->loadQuestions($exercise['exercise_ID']);

				$sections = $qnc->getExerciseSections($exercise['exercise_ID']);

				$arr = explode('/', $exercise['screenshot']);
				array_splice($arr, 5, 0, $curlang );
				$ex_screenshot = implode("/", $arr);

			?>
			<center><img src="<?php echo $ex_screenshot;?>" width="80%"></center>
			<table border="0" class="result center portfolio1">
				<tr>
					<th colspan="4"><?php echo _($exercise['title']); ?></th>
				</tr>
				<tr>
					<th><?php echo _('Activity Code'); ?></th>
					<th><?php echo _('Student Answer'); ?></th>
					<th><?php echo _('Correct Answer'); ?></th>
					<th><?php echo _('Result'); ?></th>
				</tr>
				<?php 
					$answer = '';
					$answers = array();

					foreach ($eq as $question) {
						$total++;
						$answer = $sac->getStudentAnswer($sm['student_module_ID'],$question['question_ID']);
						$img = 'wrong';

						for($i = 0; $i < count($sections); $i++) {
							if($question['section'] == $letters[$i]) {
								if(!isset($answers[$i])) {
									$answers[$i] = $answer;
								} else {
									$answers[$i] = $answers[$i] . ',' . $answer;
								}
							}
						}

						if ($answer === $question['correct_answer']) {
							$img = 'correct';
							$totalcorrect++;
						}
				?>
				<tr>
					<td><?php echo _($exercise['shortcode']) . ' - ' . _('Question ' . $question['section']); ?></td>
					<?php
					$tempAnswer = $answer;
					if(substr_count($answer, ",") == 2 and strpos($answer, ",") !== false and strlen($answer) < 55){
						list($d1, $d2, $d3) = explode(",", $answer);
						// echo "<script>alert(true);</script>";
						$tempAnswer =  _($d1) . ',' . _($d2) . ',' . _($d3);
					}
					?>
					<td><?php echo _($tempAnswer); ?></td>
					<td><?php echo _($question['correct_answer']); ?></td>
					<td>
						<?php if($img == 'correct') { ?>
							<i class="fa fa-check"></i>
						<?php } else { ?>
							<i class="fa fa-times"></i>
						<?php } ?>
					</td>
				</tr>
				<?php } ?>
			</table>
			<div class="clear"></div>
			<table border="0" class="result center portfolio2">
				<tr>
					<th><?php echo _('Activity Code'); ?></th>
					<th><?php echo _('Feedback'); ?></th>
				<tr>
			
			<?php 
					for($i = 0; $i < count($sections); $i++) {
						$feedback = $fbc->getFeedback($exercise['exercise_ID'], $sections[$i], $answers[$i]);

						if(!$feedback) {
							$feedback = $fbc->getFeedback($exercise['exercise_ID'], $sections[$i], 'X');
						}
			?>
						<tr>
							<td class="center"><?php echo _($exercise['shortcode']) . ' - ' . _('Question ' . $letters[$i]); ?></td>
							<td class="center"><?php echo _($feedback[0]); ?></td>
						</tr>
			<?php 	} ?>
			</table>
			<hr>
			<?php } ?>
			<h3><?php echo _("Problem Solving"); ?></h3>
			<?php 
				$problem = $mmc->getModuleProblem($sm['module_ID']);
				$answer = $mac->getProblemAnswer($sm['student_module_ID'],$problem['meta_ID']);
			?>
			<br/>
			<table border="0" class="problem-solving">
				<tr>
					<td class="bold"><?php echo _("Problem"); ?></td>
					<td><?php echo _($problem['meta_desc']); ?></td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Solution"); ?></td>
					<td><?php echo _($answer); ?></td>
				</tr>
			</table>
		</div>
	</div>
	<?php $score = number_format($totalcorrect/$total*100); ?>
	<?php $_SESSION['score'] = $score; ?>
	</div>
	<!-- Start Email -->
	<div id="email-container">
		<div id="email-form">
			<h3>Email This Page</h3>
			<img src="images/close.png" id="close-btn">
			<div id="message">
			<form accept-charset="UTF-8" method="post" onsubmit="this.emailcontent.value = document.getElementById('results').innerHTML;">
				<table border="0">
					<tr>
						<td><p><?php echo _('To'); ?>:</p></td>
						<td><input class="req" maxlength="100" size="43" name="emailto" type="text" id="emailto" placeholder="<?php echo _('Email address'); ?>"></td>
					</tr>
					<tr>
						<td><p><?php echo _('From'); ?>:</p></td>
						<td><input class="req" maxlength="100" size="43" name="emailfrom" type="text" id="emailfrom" placeholder="<?php echo _('Email address'); ?>"></td>
					</tr>
 					<tr>
						<td><p><?php echo _('Message'); ?>:</p></td>
						<td><textarea id="email-message" name="emailmessage" rows="4"></textarea></td>
					</tr>
				</table>
				<input type="hidden" name="resultcontent" id="emailcontent" value="" />
				<input name="sendresults" id="email-send" type="submit" value="<?php echo _('Send'); ?>">
			</form>
			</div>
		</div>
	</div>
	<?php
		if(isset($_POST['sendresults'])) {
			$email = $_POST['emailto'];
			$emailfrom = $_POST['emailfrom'];

			$pdfdocs	= generateResults($sid, $mid);
			$attachment = chunk_split(base64_encode($pdfdocs));
			$separator 	= md5(time());
			$eol 		= PHP_EOL;
			$filename 	= "ModuleResults.pdf";

			$headers = "From: ". 'webmaster@nexgenready.com' . $eol;
	        $headers .= "Reply-To:". $emailfrom . $eol;
	        $headers .= "MIME-Version: 1.0".$eol;
			$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

			$body = "--".$separator.$eol;
	        $body .= "Content-Type: application/octet-stream; name=\"$filename\"".$eol;
	        $body .= "Content-Transfer-Encoding: base64".$eol;
	        $body .= "Content-Disposition: attachment".$eol.$eol;
	        $body .= $attachment.$eol;

	        $body .= "--".$separator.$eol;
	        $body .= "Content-type: text/html; charset=\"utf-8\"".$eol;
	        $body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
	        $body .= $_POST['emailmessage'].$eol.$eol;
	        $body .= "--".$separator."--".$eol.$eol;

			$to = $email;
			$from = "info@nexgenready.com"; 
			$subject = 'Your Student Results';

			if(mail($to, $subject, $body, $headers)) {
                echo '<p class="center">' . _('Your message has been sent.') . '</p>';
			} else {
				echo _('There was a problem sending the email.');
			}
		}
	?>
	<!-- End Email -->
	<!-- start footer -->
	<div id="footer" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
		<div class="copyright">
			<p>© 2014 NexGenReady. <?php echo _("All Rights Reserved."); ?>
			<a class="link f-link" href="../marketing/privacy-policy.php"><?php echo _("Privacy Policy"); ?></a> | 
			<a class="link f-link" href="../marketing/terms-of-service.php"><?php echo _("Terms of Service"); ?></a>
	
			<a class="link fright f-link" href="../marketing/contact.php"><?php echo _("Need help? Contact our support team"); ?></a>
			<span class="fright l-separator">|</span>
			<a class="link fright f-link" href="../marketing/bug.php"><?php echo _("File Bug Report"); ?></a>
			</p>
		</div>
	</div>
	<!-- end footer -->
	<script src="scripts/livevalidation.js"></script>
	<script>document.getElementById('score').innerHTML = '<?php echo $score;?>%';</script>
	<script>
		$(document).ready(function(){
		$('#email-btn').click(function(){
			$('#email-container').css('display','initial');
		});

		$('#close-btn').click(function(){
			$('#email-container').css('display','none');
		});

		var subEadd = new LiveValidation('emailto');
      	subEadd.add( Validate.Email );

      	var subEadd2 = new LiveValidation('emailfrom');
      	subEadd2.add( Validate.Email );
		});
	</script>
</body>
</html>