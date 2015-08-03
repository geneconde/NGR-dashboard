<?php 
	require_once 'session.php';
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'controller/User.Controller.php';
	require_once 'controller/StudentDt.Controller.php';
	require_once 'controller/Module.Controller.php';
	require_once 'controller/DiagnosticTest.Controller.php';
	require_once 'controller/DtQuestion.Controller.php';
   
	$sdtid			= $_GET['sdtid'];
	if(isset($_GET['gid'])) $gid = $_GET['gid'];
	
	$sdt			= new StudentDtController();
	$sdt_set		= $sdt->getStudentDtByID($sdtid);

	$student		= $uc->loadUserByID($sdt_set->getUserID());

	$mc				= new ModuleController();
	$module			= $mc->loadModule($sdt_set->getModuleID());

	$dtc			= new DiagnosticTestController();
	$dt_set			= $dtc->getDiagnosticTestByID($sdt_set->getDTID());
	
	$questions		= explode(',',$dt_set->getQid());
	
	$dtc			= new DtQuestionController();
	//$question_set	= $dtc->getDTPool($sdt_set->getModuleID());

	$dates = array();
	$ids   = array();
	$mods  = array();

	// echo '<pre>';
	// print_r($sdt_set);
	// echo '</pre>';

	$uid = $sdt_set->getUserID();
	$mod = $sdt_set->getModuleID();
	// $fin = $sdt_set->getFinished();
	// echo $uid . '<br/>' . $mod;

	$test = $sdt->getStudentDtByEndDate($sdt_set->getUserID(), '0000-00-00 00:00:00');

	// echo '<pre>';
	// print_r($test);
	// echo '</pre>';

	// echo $test[0]['date_ended'];

	if( !$test ) {
		$end = '';
		$od = '';
	} else {
		$end = $test[0]['date_ended'];
		$id = $test[0]['user_id'];
	}

if($end == '0000-00-00 00:00:00' && $id == $uid) : ?>
	</br><a class="link" href="student.php">&laquo <?php echo _("Go Back to Dashboard"); ?></a>
	<div id="on_going">
		<h1>This Page is temporary unavailable because you are taking  your exam.</h1>
	</div>
<?php else : ?>
<script>
	var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;
	var pfCustomCSS = 'printfriendly2.php'
	var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
</script>
<div id="container">
	<?php 
		if ($user->getType() == 0 ): 
			if(isset($_GET['p'])):
	?>
			<a class="link" href="view-portfolio.php?user_id=<?php echo $sdt_set->getUserID(); ?>">&laquo; <?php echo _("Go Back to Student Portfolio"); ?></a>
	<?php   else: ?>
			<a class="link" href="student-results.php?gid=<?php echo $gid; ?>&mid=<?php echo $sdt_set->getModuleID(); ?>">&laquo; <?php echo _("Go Back to Students Results Summary"); ?></a>
	<?php
		endif;
	?>
	<?php elseif($user->getType() == 2 ): ?>
		<a class="link" href="student.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>
	<?php endif; ?>
	<?php if ($sdt_set->getMode() == 1): ?>
	<h1><?php echo _("Student Pre-test"); ?> <a href="http://www.printfriendly.com" style="float: right; color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img id="printfriendly" style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a></h1>
	<?php else: ?>
	<h1><?php echo _("Student Post-test"); ?> <a href="http://www.printfriendly.com" style="float: right; color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img id="printfriendly" style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a></h1>
	<?php endif; ?>
	<input type="submit" value="" id="email-btn" class="email-btn" style="float: right;" />
	<div id="results">
		<table border="0" id="info">
			<tr>
				<td class="bold alignright"><?php echo _("Name"); ?> :&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo $student->getFirstname() . ' ' . $student->getLastname(); ?></td>
			</tr>
			<tr>
				<td class="bold alignright"><?php echo _("Module"); ?> :&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo _($module->getModule_name()); ?></td>
			</tr>
			<tr>
				<td class="bold alignright"><?php echo _("Date Started"); ?> :&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo date('M d, Y h:i:s', strtotime($sdt_set->getStartDate())); ?></td>
			</tr>
			<tr>
				<td class="bold alignright"><?php echo _("Date Finished"); ?> :&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo date('M d, Y h:i:s', strtotime($sdt_set->getEndDate())); ?></td>
			</tr>
			<tr>
				<td class="bold"><?php echo _("Score Percentage"); ?> :&nbsp;&nbsp;&nbsp;</td>
				<td><h2 id="score"></h2></td>
			</tr>
		</table>
		<table border="0" class="result morepad">
		<?php
			//foreach($question_set as $row):
			foreach ($questions as $q) :
			//if(in_array($row['qid'], $questions)):
					$choices = $dtc->getQuestionChoices($q);
					$sanswer = $sdt->getTargetAnswer($sdtid, $q);
					$qinfo = $dtc->getTargetQuestion($q);
					
		?>
			<tr class="trline" id="quest">
				<td><img class="img-answer" /><?php echo _($qinfo[0]['question']); ?>
				<?php if($qinfo[0]['image']) :
					$image = $qinfo[0]['image'];
					$img = trim($image, "en.jpg");

					if($language == 'ar_EG' && $qinfo[0]['translate'] == 1) {
						$img .= '-ar.jpg';
						echo '<br/><img src="http://dev.jigzen.com/shymansky/dashboard/'.$img.'" class="dtq-image" width="312px">';
					} elseif($language == 'es_ES' && $qinfo[0]['translate'] == 1) {
						$img .= '-es.jpg';
						echo '<br/><img src="http://dev.jigzen.com/shymansky/dashboard/'.$img.'" class="dtq-image" width="312px">';
					} elseif($language == 'zh_CN' && $qinfo[0]['translate'] == 1) {
						$img .= '-zh.jpg';
						echo '<br/><img src="http://dev.jigzen.com/shymansky/dashboard/'.$img.'" class="dtq-image" width="312px">';
					} elseif($language == 'en_US' && $qinfo[0]['translate'] == 1) {
						echo '<br/><img src="http://dev.jigzen.com/shymansky/dashboard/'.$image.'" class="dtq-image" width="312px">';
					} else {
						echo '<br/><img src="http://dev.jigzen.com/shymansky/dashboard/'.$image.'" class="dtq-image" width="312px">';
					}
					// echo '<br/><img src="'.$qinfo[0]['image'].'" class="dtq-image">';
				endif; ?>
				<br><br>
				<?php echo _("Choices"); ?>:<br/>
				<?php foreach($choices as $choice): ?>
					<span class='letters'><?php echo $choice['order']; ?></span>. <?php echo _($choice['choice']); ?><br>
				<?php endforeach; ?>
				<br/>
				<?php 
					foreach($choices as $choice):
						if($choice['order'] == $qinfo[0]['answer']): ?>
							<?php echo _("Correct Answer:"); ?> <span class="c-answer"><?php echo $choice['order']; ?></span>. <?php echo _($choice['choice']); ?><br>
				<?php 
						endif;
					endforeach; 
					
					$match = false;
					foreach($choices as $choice):
						if($choice['order'] == $sanswer):
							$match = true; ?>
							<?php echo _("Student Answer:"); ?> <span class="s-answer"><?php echo $choice['order']; ?></span>. <?php echo _($choice['choice']); ?><br>
				<?php
						endif;
					endforeach;

					if(!$match) echo "Student Answer: <span class=\"s-answer\"></span>{$sanswer}<br>";
				?>
				</td>
			</tr>
		<?php
			//	endif;
			endforeach;
		?>
		</table>
		<div class="clear"></div>
	</div>
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
		/*$from = $_POST['emailfrom'];*/
		$emailfrom = $_POST['emailfrom'];

		if($sdt_set->getMode() == 1){
			$message = "<h3>Student Pre-test</h3>";
		} else{
			$message =  "<h3>Student Post-test</h3>";
		}
		
		$message .= $_POST['emailmessage'];

		$message .= $_POST['resultcontent'];

		$headers = "From: ". 'webmaster@nexgenready.com' ." \r\n" . 
                   /*"Reply-To: info@nexgenready.com \r\n" . */
	               "Reply-To:". $emailfrom ." \r\n" . 
                   "Content-type: text/html; charset=UTF-8 \r\n";

		$to = $email;
		$from = "info@nexgenready.com"; 
		$subject = 'Your Student Results';

		if(mail($to, $subject, $message, $headers)) {
            echo '<p>' . 'Your message has been sent.' . '</p>';
		} else {
			echo 'There was a problem sending the email.';
		}
	}
?>
<?php endif; ?>	

<!-- End Email -->
<script src="scripts/livevalidation.js"></script>
<script>
var totalquestions = 0,
	correct = 0;
$(document).ready(function() {
	$('.trline').each(function(){
		totalquestions++;
		var cAnswer = $(this).find('.c-answer').html();
		var sAnswer = $(this).find('.s-answer').html();
		
		if(cAnswer == sAnswer) {
			$(this).find('img.img-answer').attr('src','http://corescienceready.com/dashboard/images/correct.png');
			correct++;
		} else {
			$(this).find('img.img-answer').attr('src','http://corescienceready.com/dashboard/images/wrong.png');
		}
	});
	
	$('#score').text(Math.round(((correct/totalquestions)*100)) + "%");

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
	<li data-id="printfriendly" 		data-text="Next" data-options="tipLocation:left;tipAnimation:fade">
		<p>Click here to print this page.</p>
	</li>
	<li data-id="email-btn" 		data-text="Close" data-options="tipLocation:left;tipAnimation:fade">
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
<?php require_once "footer.php"; ?>