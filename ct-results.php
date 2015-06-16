<?php 
	require_once 'session.php';
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'controller/User.Controller.php';
	require_once 'controller/StudentCt.Controller.php';
	require_once 'controller/CumulativeTest.Controller.php';
	require_once 'controller/DtQuestion.Controller.php';
   
	$sctid		= $_GET['sctid'];

	$scc		= new StudentCtController();
	$scc_set	= $scc->getStudentCtByID($sctid);
	
	$ctc		= new CumulativeTestController();
	$ctc_set	= $ctc->getCumulativeTestByID($scc_set->getCTID());

	$questions	= explode(',',$ctc_set->getQid());
	
	$student	= $uc->loadUserByID($scc_set->getUserID());
	
	$dtc			= new DtQuestionController();
	//$question_set	= $dtc->getAllQuestions();
?>
<script>
	var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 1;
	var pfCustomCSS = ''
	var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
</script>
<div id="container">
<?php 
	if ($user->getType() == 0 ) { 
		if(isset($_GET['p'])) {
?>
			<a class="link" href="view-portfolio.php?user_id=<?php echo $scc_set->getUserID(); ?>">&laquo; <?php echo _("Go Back to Student Portfolio"); ?></a>
<?php
		} else {
?>
			<a class="link" href="student-results.php?m=<?php echo $mid; ?>">&laquo; <?php echo _("Go Back to Students Results Summary"); ?></a>
<?php 	} ?>

<?php } else if ($user->getType() == 2 ) { ?>
<?php if ($_GET['from'] == 1) : ?>
	<a class="link" href="student-ct-listing.php">&laquo; <?php echo _("Go Back"); ?></a>
<?php else : ?>
	<a class="link" href="student.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>
<?php endif; ?>
<?php } ?>
<h1><?php echo _("Cumulative Test Result"); ?> <a href="http://www.printfriendly.com" style="float: right; color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a></h1>
<input type="submit" value="" id="email-btn" class="email-btn" style="float: right;" />
	<div id="results">
		<table border="0">
			<tr>
				<td class="bold alignright"><?php echo _("Name"); ?> :&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo $student->getFirstname() . ' ' . $student->getLastname(); ?></td>
			</tr>
			<tr>
				<td class="bold alignright"><?php echo _("Test Name"); ?> :&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo $ctc_set->getTestName(); ?></td>
			</tr>
			<tr>
				<td class="bold alignright"><?php echo _("Date"); ?> :&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo date('M d, Y', strtotime($scc_set->getStartDate())); ?></td>
			</tr>
			<tr>
				<td class="bold alignright"><?php echo _("Time Started"); ?> :&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo date('h:i:s', strtotime($scc_set->getStartDate())); ?></td>
			</tr>
			<tr>
				<td class="bold alignright"><?php echo _("Time Ended"); ?> :&nbsp;&nbsp;&nbsp;</td>
				<td><?php echo date('h:i:s', strtotime($scc_set->getEndDate())); ?></td>
			</tr>
			<tr>
				<td class="bold"><?php echo _("Score Percentage"); ?> :&nbsp;&nbsp;&nbsp;</td>
				<td><h2 id="score"></h2></td>
			</tr>
		</table>
		<table border="0" class="result morepad">
		<?php
			foreach($questions as $q):
			//if(in_array($row['qid'], $questions)):
					$choices = $dtc->getQuestionChoices($q);
					$sanswer = $scc->getCTTargetAnswer($sctid, $q);
					$qinfo = $dtc->getTargetQuestion($q);
		?>
			<tr class="trline">
				<td><img class="img-answer" /><?php echo _($qinfo[0]['question']); ?>
				<?php if($qinfo[0]['image']) :
					$image = $qinfo[0]['image'];
					$img = trim($image, "en.jpg");

					if($language == 'ar_EG' && $qinfo[0]['translate'] == 1) {
						$img .= '-ar.jpg';
						echo '<br/><img src="'.$img.'" class="dtq-image">';
					} elseif($language == 'es_ES' && $qinfo[0]['translate'] == 1) {
						$img .= '-es.jpg';
						echo '<br/><img src="'.$img.'" class="dtq-image">';
					} elseif($language == 'zh_CN' && $qinfo[0]['translate'] == 1) {
						$img .= '-zh.jpg';
						echo '<br/><img src="'.$img.'" class="dtq-image">';
					} elseif($language == 'en_US' && $qinfo[0]['translate'] == 1) {
						echo '<br/><img src="'.$image.'" class="dtq-image">';
					} else {
						echo '<br/><img src="'.$image.'" class="dtq-image">';
					}
					//echo '<br/><img src="'.$qinfo[0]['image'].'" class="dtq-image">';
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
							Correct Answer: <span class="c-answer"><?php echo $choice['order']; ?></span>. <?php echo $choice['choice']; ?><br>
				<?php 
						endif;
					endforeach; 
					
					$match = false;
					foreach($choices as $choice):
						if($choice['order'] == $sanswer):
							$match = true; ?>
							Student Answer: <span class="s-answer"><?php echo $choice['order']; ?></span>. <?php echo $choice['choice']; ?><br>
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
		<h2>Email This Page</h2>
		<img src="images/close.png" id="close-btn">
		<div id="message">
		<form accept-charset="UTF-8" action="#mail" method="post" onsubmit="this.emailcontent.value = document.getElementById('results').innerHTML;">
			<table border="0">
				<tr>
					<td><p>To:</p></td>
					<td><input class="req" maxlength="100" size="43" id="emailto" name="emailto" type="text" placeholder="Email address"></td>
				</tr>
				<tr>
					<td><p>From:</p></td>
					<td><input class="req" maxlength="100" size="43" id="emailfrom" name="emailfrom" type="text" placeholder="Email address"></td>
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
		$from = $_POST['emailfrom'];
		$message = $_POST['emailmessage'];
		$message .= $_POST['resultcontent'];

		$headers = "From: ". 'webmaster@nexgenready.com' ." \r\n" . 
                   "Reply-To: info@nexgenready.com \r\n" . 
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
<?php require_once "footer.php"; ?>