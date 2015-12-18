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
?>
<script>
	var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;
	var pfCustomCSS = 'printfriendly2.php'
	var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
</script>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<?php if($type==0): ?>
			<a class="link back" href="student-results.php?gid=<?php echo $gid; ?>&mid=<?php echo $sm['module_ID']; ?>">&laquo <?php echo _("Go Back"); ?></a>
		<?php else : ?>
			<a class="link back" href="student.php">&laquo <?php echo _("Go Back"); ?></a>
		<?php endif; ?>
	</div>
</div>

<div id="content">
<div class="wrap">
		<h1><?php echo _("Module Score Summary"); ?></h1>
		<p class="text"><?php echo _("The pre-diagnostic test will be available before taking the module. This test must be completed within the specified time. Only answers that are completed within the time limit will be recorded."); ?></p>
		<div class="btn">
			<a href="http://www.printfriendly.com" id="print" class="btn fleft" onclick="window.print();return false;" title="Printer Friendly and PDF"><span><i class="fa fa-print"></i><?php echo _('Print'); ?></span></a>
			<a id="email-btn" class="btn fleft" href="#"><i class="fa fa-envelope"></i><?php echo _('Email'); ?></a>
		</div>
		<div class="clear"></div>

		<div id="results">
			<table border="0" class="details">
				<tr>
					<td class="bold"><?php echo _("Name"); ?></td>
					<td><?php echo $u->getFirstname() . ' ' . $u->getLastname(); ?></td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Module"); ?></td>
					<td><?php echo _($m->getModule_name()); ?></td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Started"); ?></td>
					<td><?php echo date('F j, Y H:i:s',strtotime($sm['date_started'])); ?></td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Finished"); ?></td>
					<td><?php echo date('F j, Y H:i:s',strtotime($sm['date_finished'])); ?></td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Score"); ?></td>
					<td><span id="score"></span></td>
				</tr>
			</table>

			<h3 class="result-title"><?php echo _("Quick Check Results"); ?></h3>
			<?php foreach ($qc as $exercise) {
				$counter = 1;
				$eq = $qnc->loadQuestions($exercise['exercise_ID']);
				$tempSection = 'A';
			?>
			<table border="0" class="result fleft" id="qcr">
				<tr>
					<th colspan="2"><?php echo _($exercise['title']); ?></th>
					<th class="empty"></th>
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
					<td class="mark">
						<?php if($img == 'correct') { ?>
							<i class="fa fa-check"></i>
						<?php } else { ?>
							<i class="fa fa-times"></i>
						<?php } ?>
					</td>
				</tr>
				<?php $counter++; } ?>
			</table>
			<?php } ?>
			<div class="clear"></div>
			<h3 class="result-title"><?php echo _("Quiz Question Results"); ?></h3>
			<?php foreach ($qq as $exercise) {
				$counter = 1;
				$eq = $qnc->loadQuestions($exercise['exercise_ID']);
				$tempSection = 'A';
			?>
			<table border="0" class="result fleft" id="qqr">
				<tr>
					<th colspan="2"><?php echo _($exercise['title']); ?></th>
					<th class="empty"></th>
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
					<td class="mark">
						<?php if($img == 'correct') { ?>
							<i class="fa fa-check"></i>
						<?php } else { ?>
							<i class="fa fa-times"></i>
						<?php } ?>
					</td>
				</tr>
				<?php $counter++; } ?>
			</table>
			<?php } ?>
			<div class="clear"></div>
			<h3 class="result-title"><?php echo _("Problem Solving"); ?></h3>
			<?php 
				$problem = $mmc->getModuleProblem($sm['module_ID']);
				$answer = $mac->getProblemAnswer($smid,$problem['meta_ID']);
			?>
			<table border="0" class="problem-solving">
				<tr>
					<td class="bold"><?php echo _("Problem"); ?></td>
					<td><?php echo _($problem['meta_desc']); ?></td>
				</tr>
				<tr>
					<td class="bold"><?php echo _("Solution"); ?></td>
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
				<input name="sendresults" id="email-send" type="submit" value="<?php echo _('Send'); ?>">
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

	<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
	  <li class="tlypageguide_left" data-tourtarget="#print">
	    <p><?php echo _("Click here to print this page."); ?></p>
	  </li>
	  <li class="tlypageguide_right" data-tourtarget="#email-btn">
	    <p><?php echo _("Click here to email this page/results."); ?></p>
	  </li>
	</ul>

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

<?php require_once "footer.php"; ?>