<?php 
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
	
	$smid 	= $_GET['smid'];
	if(isset($_GET['gid'])) $gid = $_GET['gid'];
	
	$smc 	= new StudentModuleController();
	$mc 	= new ModuleController();
	$ec 	= new ExerciseController();
	$sac 	= new StudentAnswerController();
	$qnc 	= new QuestionController();
	$mmc 	= new ModuleMetaController();
	$mac 	= new MetaAnswerController();
	
	$sm 	= $smc->loadStudentModule($smid);
	$m 		= $mc->loadModule($sm['module_ID']);
	$u 		= $uc->loadUserByID($sm['user_ID']);
	$qc 	= $ec->loadExercisesByType($sm['module_ID'],0);
	$qq 	= $ec->loadExercisesByType($sm['module_ID'],1);
	$totalcorrect = 0;
	$total = 0;
	
	$link = $user->getType();
	if ($link == 0) $link = 'teacher';
	else if ($link == 1) $link = 'parent';
	else if ($link == 2) $link = 'student';
?>

	<script>
		var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;
		var pfCustomCSS = 'printfriendly2.php'
		var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
	</script>

	<div id="container">
		<?php if ($link == 'teacher') { ?>
		<a class="link back" href="student-results.php?gid=<?php echo $gid; ?>&mid=<?php echo $sm['module_ID']; ?>">&laquo; <?php echo _("Go Back to Students Results Summary"); ?></a>
		<?php } else { ?>
		<a class="link back" href="<?php echo $link.'.php';?>">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>
		<?php } ?>
		<br><br>
		<h1><?php echo _("Module Score Summary"); ?>
			<a href="http://www.printfriendly.com" style="float: right; color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF">
				<img id="printfriendly" style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="<?php echo _("Print Friendly and PDF"); ?>"/>
			</a>
		</h1>

		<input type="submit" value="" id="email-btn" class="email-btn" style="float: right;" />
		<div id="results">
			
			<table border="0">
				<tr>
					<td class="bold alignright"><?php echo _("Name"); ?> :&nbsp;&nbsp;&nbsp;</td>
					<td><?php echo $u->getFirstname() . ' ' . $u->getLastname(); ?></td>
				</tr>
				<tr>
					<td class="bold alignright"><?php echo _("Module"); ?> :&nbsp;&nbsp;&nbsp;</td>
					<td><?php echo _($m->getModule_name()); ?></td>
				</tr>
				<tr>
					<td class="bold alignright"><?php echo _("Date Started"); ?> :&nbsp;&nbsp;&nbsp;</td>
					<td><?php echo date('F j, Y H:i:s',strtotime($sm['date_started'])); ?></td>
				</tr>
				<tr>
					<td class="bold alignright"><?php echo _("Date Finished"); ?> :&nbsp;&nbsp;&nbsp;</td>
					<td><?php echo date('F j, Y H:i:s',strtotime($sm['date_finished'])); ?></td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Score Percentage"); ?> :&nbsp;&nbsp;&nbsp;</td>
					<td><h2 id="score"></h2></td>
				</tr>
			</table>
			<br/>
			<h3><?php echo _("Quick Check Results"); ?></h3>
			<?php foreach ($qc as $exercise) {
				$counter = 1;
				$eq = $qnc->loadQuestions($exercise['exercise_ID']);
				$tempSection = 'A';
			?>
			<table border="0" class="result fleft" id="qcr">
				<tr>
					<th colspan="2"><?php echo _($exercise['title']); ?></th>
				</tr>
				<?php
					$numberOfsecA = $qnc->getExercisePerSections($exercise['exercise_ID'],'A');
					$numberOfsecB = $qnc->getExercisePerSections($exercise['exercise_ID'],'B');
					$numberOfsecC = $qnc->getExercisePerSections($exercise['exercise_ID'],'C');
				?>
				<?php foreach ($eq as $question) {
					$total++;
					$answer = $sac->getStudentAnswer($smid,$question['question_ID']);
					$img = 'wrong';
					if ($answer && $answer == $question['correct_answer']) {
						$img = 'correct';
						$totalcorrect++;
					}
				?>
				<tr>
					<td>
						<?php
							if($tempSection != $question['section']) { $counter = 1; }
							$tempSection = $question['section'];
						?>
						<?php echo _(strtoupper($question['section'])); ?>
						<?php
							if(sizeof($numberOfsecA) > 1 && $question['section'] == 'A'){
								echo " - " . $counter;
							}
							if(sizeof($numberOfsecB) > 1 && $question['section'] == 'B'){
								echo " - " . $counter;
							}
							if(sizeof($numberOfsecC) > 1 && $question['section'] == 'C'){
								echo " - " . $counter;
							}
						?>
					</td>
					<td>
						<?php if($img == 'correct') { ?>
							<img src="http://dev.jigzen.com/shymansky/dashboard/images/correct.png" alt="<?php echo $img; ?>"/>
						<?php } else { ?>
							<img src="http://dev.jigzen.com/shymansky/dashboard/images/wrong.png" alt="<?php echo $img; ?>"/>
						<?php } ?>
					</td>
				</tr>
				<?php $counter++; } ?>
			</table>
			<?php } ?>
			<div class="clear"></div>
			<h3><?php echo _("Quiz Question Results"); ?></h3>
			<?php foreach ($qq as $exercise) {
				$counter = 1;
				$eq = $qnc->loadQuestions($exercise['exercise_ID']);
				$tempSection = 'A';
			?>
			<table border="0" class="result fleft" id="qqr">
				<tr>
					<th colspan="2"><?php echo _($exercise['title']); ?></th>
				</tr>
				<?php
					$numberOfsecA = $qnc->getExercisePerSections($exercise['exercise_ID'],'A');
					$numberOfsecB = $qnc->getExercisePerSections($exercise['exercise_ID'],'B');
					$numberOfsecC = $qnc->getExercisePerSections($exercise['exercise_ID'],'C');
				?>
				<?php foreach ($eq as $question) {
					$total++;
					$answer = $sac->getStudentAnswer($smid,$question['question_ID']);
					$img = 'wrong';
					if ($answer && $answer == $question['correct_answer']) {
						$img = 'correct';
						$totalcorrect++;
					}
				?>
				<tr>
					<td>
						<?php
							if($tempSection != $question['section']) { $counter = 1; }
							$tempSection = $question['section'];
						?>
						<?php echo _(strtoupper($question['section'])); ?>
						<?php
							if(sizeof($numberOfsecA) > 1 && $question['section'] == 'A'){
								echo " - " . $counter;
							}
							if(sizeof($numberOfsecB) > 1 && $question['section'] == 'B'){
								echo " - " . $counter;
							}
							if(sizeof($numberOfsecC) > 1 && $question['section'] == 'C'){
								echo " - " . $counter;
							}
						?>
					</td>
					<td>
						<?php if($img == 'correct') { ?>
							<img src="http://dev.jigzen.com/shymansky/dashboard/images/correct.png" alt="<?php echo $img; ?>"/>
						<?php } else { ?>
							<img src="http://dev.jigzen.com/shymansky/dashboard/images/wrong.png" alt="<?php echo $img; ?>"/>
						<?php } ?>
					</td>
				</tr>
				<?php $counter++; } ?>
			</table>
			<?php } ?>
			<div class="clear"></div>
			<h3><?php echo _("Problem Solving"); ?></h3>
			<?php 
				$problem = $mmc->getModuleProblem($sm['module_ID']);
				$answer = $mac->getProblemAnswer($smid,$problem['meta_ID']);
			?>
			<br/>
			<table border="0" class="valigntop">
				<tr>
					<td class="bold"><?php echo _("Problem:"); ?> &nbsp;&nbsp;</td>
					<td><?php echo _($problem['meta_desc']); ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Solution:"); ?> &nbsp;&nbsp;</td>
					<td><?php echo $answer; ?></td>
				</tr>
			</table>
		</div>
	</div>
	<?php $score = number_format($totalcorrect/$total*100); ?>
	
	</div>
	<!-- Start Email -->
	<div id="email-container">
		<div id="email-form">
			<h3><?php echo _('Email This Page'); ?></h3>
			<img src="images/close.png" id="close-btn">
			<div id="message">
			<form accept-charset="UTF-8" action="#" method="post" onsubmit="this.emailcontent.value = document.getElementById('results').innerHTML;">
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
						<td><textarea cols="40" id="email-message" name="emailmessage" rows="4"></textarea></td>
					</tr>
				</table>
				<input type="hidden" name="resultcontent" id="emailcontent" value="" />
				<input name="sendresults" type="submit" value="<?php echo _('Send'); ?>">
			</form>
			</div>
		</div>
	</div>
	<?php
		if(isset($_POST['sendresults'])) {
			$email = $_POST['emailto'];
			$emailfrom = $_POST['emailfrom'];
			$message = $_POST['emailmessage'];
			$message .= $_POST['resultcontent'];


			$headers = "From: ". 'webmaster@nexgenready.com' ." \r\n" . 
	                   /*"Reply-To: info@nexgenready.com \r\n" . */
	                   "Reply-To:". $emailfrom ." \r\n" .
	                   "Content-type: text/html; charset=UTF-8 \r\n";

			$to = $email;
			/*$from = "info@nexgenready.com";*/ 
			$from = $emailfrom;
			$subject = 'Your Student Results';

			if(mail($to, $subject, $message, $headers)) {
                echo '<p class="center">' . 'Your message has been sent.' . '</p>';
			} else {
				echo 'There was a problem sending the email.';
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

	<!-- Tip Content -->
    <ol id="joyRideTipContent">
		<li data-id="printfriendly" 		data-text="Next" data-options="tipLocation:right;tipAnimation:fade">
			<p>Click here to print this page.</p>
		</li>
		<li data-id="email-btn" 		data-text="Close" data-options="tipLocation:right;tipAnimation:fade">
			<p>Click here to email this page/results.</p>
		</li>
    </ol>

    <script>
      function guide() {
	  	$('#joyRideTipContent').joyride({
	      autoStart : true,
	      postStepCallback : function (index, tip) {
	      if (index == 10) {
	        $(this).joyride('set_li', false, 1);
	      }
	    },
	    // modal:true,
	    // expose: true
	    });
	  }
    </script>
</body>
</html>