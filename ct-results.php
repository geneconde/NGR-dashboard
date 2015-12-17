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
	var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;
	var pfCustomCSS = 'printfriendly2.php'
	var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
</script>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<?php if ($user->getType() == 0 ) : ?>
			<?php if(isset($_GET['p'])) : ?>
					<a class="link" href="view-portfolio.php?user_id=<?php echo $scc_set->getUserID(); ?>">&laquo; <?php echo _("Go Back to Student Portfolio"); ?></a>
			<?php else : ?>
					<a class="link" href="student-results.php?m=<?php echo $mid; ?>">&laquo; <?php echo _("Go Back to Students Results Summary"); ?></a>
			<?php endif; ?>
		<?php elseif ($user->getType() == 2 ) : ?>
			<?php if (isset($_GET['from']) ) : ?>
				<a class="link back" href="student-ct-listing.php">&laquo; <?php echo _("Go Back"); ?></a>
			<?php else : ?>
				<a class="link back" href="student.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>
			<?php endif; ?>				
		<?php endif; ?>
	</div>
</div>

<div id="content">
<div class="wrap">
<h1><?php echo _("Cumulative Test Result"); ?></h1>
	<div class="btn">
		<a href="http://www.printfriendly.com" id="print" class="btn fleft" onclick="window.print();return false;" title="Printer Friendly and PDF"><span><i class="fa fa-print"></i><?php echo _('Print'); ?></span></a>
		<a id="email-btn" class="btn fleft" href="#"><i class="fa fa-envelope"></i><?php echo _('Email'); ?></a>
	</div>
	<div class="clear"></div>
	<div id="results">
		<table border="0" class="details">
			<tr>
				<td class="bold"><?php echo _("Name"); ?></td>
				<td><?php echo $student->getFirstname() . ' ' . $student->getLastname(); ?></td>
			</tr>
			<tr>
				<td class="bold"><?php echo _("Test Name"); ?></td>
				<td><?php echo $ctc_set->getTestName(); ?></td>
			</tr>
			<tr>
				<td class="bold"><?php echo _("Date"); ?></td>
				<td><?php echo date('M d, Y', strtotime($scc_set->getStartDate())); ?></td>
			</tr>
			<tr>
				<td class="bold"><?php echo _("Started"); ?></td>
				<td><?php echo date('h:i:s', strtotime($scc_set->getStartDate())); ?></td>
			</tr>
			<tr>
				<td class="bold"><?php echo _("Ended"); ?></td>
				<td><?php echo date('h:i:s', strtotime($scc_set->getEndDate())); ?></td>
			</tr>
			<tr>
				<td class="bold"><?php echo _("Score"); ?></td>
				<td><span id="score"></span></td>
			</tr>
		</table>
		<table border="0" class="result morepad ct-results">
		<?php
			foreach($questions as $q):
			//if(in_array($row['qid'], $questions)):
					$choices = $dtc->getQuestionChoices($q);
					$sanswer = $scc->getCTTargetAnswer($sctid, $q);
					$qinfo = $dtc->getTargetQuestion($q);
		?>
			<tr class="trline">
				<td><i class="fa answer"></i><?php echo _($qinfo[0]['question']); ?>
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
			<input name="sendresults" id="email-send" type="submit" value="Send">
		</form>
		</div>
	</div>
</div>
<?php
	if(isset($_POST['sendresults'])) {
		$email = $_POST['emailto'];
		$emailfrom = $_POST['emailfrom'];
		$message = "<h3>Cumulative Test Result</h3>";
		$message .= $_POST['emailmessage'];
		$message .= $_POST['resultcontent'];

		$headers = "From: ". 'webmaster@nexgenready.com' ." \r\n" . 
                   "Reply-To:". $emailfrom ." \r\n" .
                   "Content-type: text/html; charset=UTF-8 \r\n";

		$to = $email;
		$from = "info@nexgenready.com"; 
		$subject = 'Your Student Results';

		if(mail($to, $subject, $message, $headers)) {
            echo '<p>' . _('Your message has been sent.') . '</p>';
		} else {
			echo _('There was a problem sending the email.');
		}
	}
?>
<!-- End Email -->
<!-- Tip Content -->

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_left" data-tourtarget="#print">
    <p><?php echo _("Click here to print this page."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#email-btn">
    <p><?php echo _("Click here to email this page/results."); ?></p>
  </li>
</ul>

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
			$(this).find('.fa.answer').addClass("fa-check");
			correct++;
		} else {
			$(this).find('.fa.answer').addClass("fa-times");
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