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
	<div id="container">
		<div id="graphDiv" >
		<?php
		if (isset($_POST["submit"])) {
			$emails 	= $_POST['email'];

			$pdfdocs	= generateResults($sid, $mid);
			$attachment = chunk_split(base64_encode($pdfdocs));
			$separator 	= md5(time());
			$eol 		= PHP_EOL;
			$filename 	= "example1.pdf";
			$count = count($emails);
			//echo $emails[0];

			if($emails[0] == null) {
				echo '<script>' . 'alert("Please Fill-up all the forms below.");' . '</script>';
			} else {	
				foreach($emails as $email){
					$to = $email;
                	$from = "invoice@nexgenready.com"; 
                	$subject = 'Portfolio Result';

                	$headers  = "From: ".'NexGenReady'.$eol;
                	$headers .= "MIME-Version: 1.0".$eol; 
                	$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

                	$message = '<html><body>';
                	$message .= '<div style="width: 70%; margin: 0 auto;">';
                	$message .= '<div style="background: #083B91; padding: 10px 0;">' . '<img src="http://corescienceready.com/marketing/img/logo/logo2.png" />';
                	$message .= '</div>';
                	$message .= '<div style="margin-top: 10px; padding: 15px 0 10px 0;">';
                	$message .= '<p>Hi '. $user->getUsername(). '!' . '</p>';
                	$message .= '<p>The attached file are the results of your student '. $u->getFirstname() . ' ' . $u->getLastname() . ' in ' . $m->getModule_name() . ' module.' . '</p>';
                	$message .= '<p style="margin-bottom: 0;">Best Regards,</p>';
                	$message .= '<p style="margin: 0;">NexGenReady Team</p>';
                	$message .= '</div>';
                	$message .= '<div style="background: #272626; color: white; padding: 5px; text-align: center;">';
                	$message .= '<p sytle="color: white;">&copy; 2014 Interactive Learning Online, LLC. ALL Rights Reserved. <a style="color: #f79539;" href="privacy-policy.php">Privacy Policy</a> | <a style="color: #f79539;" href="terms-of-service.php">Terms of Service</a></p>';
                	$message .= '</div>';
                	$message .= '</div>';
                	$message .= '<body></html>';

                	// message
                	$messageMail = "--".$separator.$eol;
                	$messageMail .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
                	$messageMail .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
                	$messageMail .= $message.$eol;

                	// attachment
                	$messageMail .= "--".$separator.$eol;
                	$messageMail .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
                	$messageMail .= "Content-Transfer-Encoding: base64".$eol;
                	$messageMail .= "Content-Disposition: attachment".$eol.$eol;
                	$messageMail .= $attachment.$eol;
                	$messageMail .= "--".$separator."--";

                	$mail = @mail("$to", "$subject", "$messageMail", "$headers");
            	}    
            		if($mail){
		              	echo '<script>' . 'alert("E-Mail Sent.");' . '</script>';
		            } else {
		              	echo 'fail';
		            }
            }    
			// echo "<pre>";
			// print_r($emails);
			// echo "</pre>";
		}	
		?>
			<form method="POST" action="#email">
				<ul>
					<li class="cf">
						<div class="input_fields_wrap">
				            <button class="add_field_button" name="add_field_button"></button>
				            <div class="more-fields cf">
				            	<label><?php echo _("Email Address"); ?></label>
				            	<input type="text" id="eadd1" name="email[]" placeholder="<?php echo _('Enter how many students for this teacher...'); ?>" /><br />
				            </div>
			            </div>
					</li>
					<li class="cf"><input type="submit" value="Submit" name="submit" class="email-submit" /></li>
				</ul>
				<p><?php echo _('Note: You can send to a maximum of 5 emails only.'); ?></p>
			</form>
			<span id="close"><img src="images/xmark.png" /></span>
		</div>
		<a class="link" href="view-portfolio.php?user_id=<?php echo _($sid); ?>">&laquo <?php echo _("Go Back"); ?></a>
		<h1><?php echo _("Module Results"); ?></h1>
		<div id="pdf-button">
			<a href="php/generate-result.php" target="_blank"><img src="images/pdf.png" alt="Download PDF" title="Download PDF" /></a>
			<a href="#" id="mail"><img src="images/mail.png" alt="Email PDF" title="Email PDF" /></a>
		</div>
		<!-- <a href="http://www.printfriendly.com" style="float: right; color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF">
			<img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="<?php echo _("Print Friendly and PDF"); ?>"/>
		</a>
		<input type="submit" value="" id="email-btn" class="email-btn" style="float: right;" /> -->
		<div id="results">
			
			<table border="0" id="info">
				<tr>
					<td class="bold alignright"><?php echo _("Name"); ?> :&nbsp;&nbsp;&nbsp;</td>
					<td><?php echo _($u->getFirstname() . ' ' . $u->getLastname()); ?></td>
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
			
			<h3 class="center"><?php echo _("Quick Check Results"); ?></h3><br>
			<?php foreach ($qc as $exercise) {
				$eq = $qnc->loadQuestions($exercise['exercise_ID']);

				$sections = $qnc->getExerciseSections($exercise['exercise_ID']);

				//print_r($sections);
				
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

						if ($answer == $question['correct_answer']) {
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
								<img src="images/correct.png" alt="<?php echo $img; ?>"/>
							<?php } else { ?>
								<img src="images/wrong.png" alt="<?php echo $img; ?>"/>
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

						if ($answer == $question['correct_answer']) {
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
							<img src="images/correct.png" alt="<?php echo $img; ?>"/>
						<?php } else { ?>
							<img src="images/wrong.png" alt="<?php echo $img; ?>"/>
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
			<form accept-charset="UTF-8" action="#" method="post" onsubmit="this.emailcontent.value = document.getElementById('results').innerHTML;">
				<table border="0">
					<tr>
						<td><p>To:</p></td>
						<td><input class="req" maxlength="50" size="50" name="emailto" type="text" id="emailto"></td>
					</tr>
					<tr>
						<td><p>From:</p></td>
						<td><input class="req" maxlength="50" size="50" name="emailfrom" type="text" id="emailfrom"></td>
					</tr>
					<tr>
						<td><p>Message:</p></td>
						<td><textarea cols="40" id="email-message" name="emailmessage" rows="4"></textarea></td>
					</tr>
				</table>
				<input type="hidden" name="resultcontent" id="emailcontent" value="" />
				<input name="sendresults" type="submit" value="Send">
			</form>
			</div>
		</div>
	</div>
	<?php
		if(isset($_POST['sendresults'])) {
			$email = $_POST['emailto'];
			$message = $_POST['emailmessage'];
			$message .= $_POST['resultcontent'];


			$headers = "From: ". 'webmaster@nexgenready.com' ." \r\n" . 
	                   "Reply-To: info@nexgenready.com \r\n" . 
	                   "Content-type: text/html; charset=UTF-8 \r\n";

			$to = $email;
			$from = "info@nexgenready.com"; 
			$subject = 'Your Student Results';

			if(mail($to, $subject, $message, $headers)) {
                echo _('<p class="center">' . 'Your message has been sent.' . '</p>');
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

		$('#mail img').click(function() {
			$('#graphDiv').fadeIn();
		});
		$('#close').click(function() {
			$('#graphDiv').fadeOut();
		});

		var max_fields      = 5;
	    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	    var add_button      = $(".add_field_button"); //Add button ID

	    var x = 1; //initlal text box count
	    $(add_button).click(function(e){ //on add input button click
	        e.preventDefault();
	        if(x < max_fields){ //max input box allowed
	            x++; //text box increment
	            $(wrapper).append('<div class="more-fields cf"><label>Email Address ' + x +'</label><input type="text" id="eadd' + x + '" name="email[]" placeholder="Enter email address..." /><a href="#" class="remove_field">Remove</a></div>'); //add input box
	        }
	        var eadd = [];
	      	for(var a = 2; a <= 5; a++){
	      		eadd[a] = new LiveValidation('eadd' + a);
	      		eadd[a].add(Validate.Email);
	      	}
	    });    
	    
	    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	        e.preventDefault(); $(this).parent('div').remove(); x--;
	    })

		var subEadd = new LiveValidation('emailto');
      	subEadd.add( Validate.Email );

      	var subEadd2 = new LiveValidation('emailfrom');
      	subEadd2.add( Validate.Email );

      	var eadd1 = new LiveValidation('eadd1');
      	eadd1.add(Validate.Email);
	});
	</script>
</body>
</html>