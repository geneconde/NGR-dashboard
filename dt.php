<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	require_once 'header.php';
	require_once 'php/functions.php';
	require_once 'controller/DiagnosticTest.Controller.php';
	require_once 'controller/DtQuestion.Controller.php';
	require_once 'controller/StudentDt.Controller.php';
	require_once 'controller/GroupModule.Controller.php';
	
	$userid 		= $user->getUserid();
	$dtid			= $_GET['dtid'];
	$groupid		= $_SESSION['group'];
	
	$dtc 			= new DiagnosticTestController();
	$dt				= $dtc->getDiagnosticTestByID($dtid);
	$questions		= explode(',',$dt->getQid());
	$mode			= $dt->getMode();
	$mid			= $dt->getModuleid();

	$module 		= $mc->getModule($mid);
	
	$gmc			= new GroupModuleController();
	$gm				= $gmc->getModuleGroupByID($groupid, $mid);
	
	$md				= ($mode == 1 ? "timelimit_pre" : "timelimit_post" );
	$tl				= explode(':', $gm[0][$md]);

	$sdt 			= new StudentDtController();
	$sdt_set		= $sdt->getSDTbyStudent($userid, $dtid);
	
	if(isset($_GET['i'])) $index = $_GET['i'];
	else $index = 0;
	
	$count 	= $index + 1;
	$cq		= $questions[$index];
	
	$fin	= ($count == count($questions) ? 1 : 0);
	
	$dtq			= new DtQuestionController();
	$question		= $dtq->getTargetQuestion($cq);
	$choices		= $dtq->getQuestionChoices($cq);
	$finish = _("Finish");



	if($sdt_set):
		$sdtid 		= $sdt_set->getStudentDtID();
		$startdate	= $sdt_set->getStartDate();
		$current	= date('Y-m-d G:i:s');
		$now		= date_create_from_format('Y-m-d G:i:s', $current);
		
		$expiration	= addDate($startdate, $tl);
		$ex 		= date_create_from_format('Y-m-d G:i:s', $expiration);
		
		if($ex > $now):
			$diff 		= $now->diff($ex);
			$difference = $diff->format('%h:%i:%s');
		else:
			$difference	= "00:00:00";
		endif;
		
		$tl			= explode(':', $difference);
	else:
		$startdate		= date('Y-m-d G:i:s');
		$testvalues = array(
			"userid" 		=> $userid,
			"moduleid"		=> $mid,
			"mode"			=> $mode,
			"dtid"			=> $dtid,
			"datestarted"	=> $startdate,
		);
		$sdt->addStudentDT($testvalues);
		
		$sdt_set 		= $sdt->getSDTbyStudent($userid, $dtid);
		$sdtid 			= $sdt_set->getStudentDtID();
	endif;
	
	$hour			= ltrim($tl[0], '0');
	$min			= ltrim($tl[1], '0');
	$sec			= ltrim($tl[2], '0');
	$timelimit 		= (($hour * 60 + $min) * 60) + $sec;

	if($timelimit == 0){
		header("location: save-dt-unanswered.php?sdtid=$sdtid&in=1");
	}

	$sa		= $sdt->getStudentAnswerByQuestion($sdtid, $question[0]['qid']);
	
	$panswer = '';
	if($sa)	$panswer = $sa[0]['answer'];
	
	if(strlen($panswer) > 1) $pa = str_split($panswer);
?>
<style> #dbguide { display: none; } </style>
<div id="container">
<a class="link back" href="student.php">&laquo <?php echo _("Go Back"); ?></a>
<?php if($mode == 1): ?>
<h1><?php echo _($module->getModule_name()); ?> - <?php echo _("Pre-Diagnostic Test"); ?></h1>
<?php //echo _("You have"); ?> <?php //echo $timelimit; ?> <?php //echo _("minutes to answer the questions below."); ?>
<?php else: ?>
<h1><?php echo _($module->getModule_name()); ?> - <?php echo _("Post-Diagnostic Test"); ?></h1>
<?php //echo _("You have"); ?> <?php //$timelimit; ?> <?php //echo _("minutes to answer the questions below."); ?>
<?php endif; ?>
<form action="save-dt.php?sdtid=<?php echo $sdtid; ?>&qid=<?php echo $question[0]['qid']; ?>&index=<?php echo $index; ?>&fin=<?php echo $fin; ?>" method="post">
	<table border="0" class="exam">
		<tr>
			<td colspan="2" class="bold"><?php echo _("Time Left:"); ?> <div id="countdown"></div></td>
		</tr>
		<tr>
			<td colspan="2"><span class="bold"><?php echo _("Question"); ?>:</td>
		</tr>
		<tr>
			<td><?php echo $count.". "._($question[0]['question']); ?></td>
		</tr>
		<tr>
			<?php
				$type = explode('-', $question[0]['type']);
				$choicetype = $type[0];
				
				if($type[1] == "mc") $testtype = "radio";
				else if($type[1] == "ch") $testtype = "checkbox";
			?>
			<td class="choices dt-<?php echo $choicetype; ?>">
				<?php if($question[0]['image'] != null || $question[0]['image'] != ""): ?>
					<?php
						$image = $question[0]['image'];
						$img = trim($image, "en.jpg");

						if($language == 'ar_EG' && $question[0]['translate'] == 1) {
							$img .= '-ar.jpg';
							echo '<img src="'.$img.'" class="dtq-image">';
						} elseif($language == 'es_ES' && $question[0]['translate'] == 1) {
							$img .= '-es.jpg';
							echo '<img src="'.$img.'" class="dtq-image">';
						} elseif($language == 'zh_CN' && $question[0]['translate'] == 1) {
							$img .= '-zh.jpg';
							echo '<img src="'.$img.'" class="dtq-image">';
						} elseif($language == 'en_US' && $question[0]['translate'] == 1) {
							echo '<img src="'.$image.'" class="dtq-image">';
						} else {
							echo '<img src="'.$image.'" class="dtq-image">';
						}
					?><br/>
				<?php endif;

					$ctr = 0;
					foreach($choices as $choice):
				?>
						<input type="<?php echo $testtype; ?>" name="choice<?php if($testtype == "checkbox"){ ?>[]<?php }?>" value="<?php echo $choice['order']; ?>" id="c<?php echo $ctr; ?>" <?php if($testtype == "radio"): if($panswer == $choice['order']): ?> checked <?php endif; ?>
								  <?php elseif($testtype == "checkbox"): if(isset($pa) && in_array($choice['order'], $pa)): ?> checked <?php endif ?>
								  <?php endif; ?>>
						<label for="c<?php echo $ctr; ?>">
							<?php if($choicetype == "image"): ?>
								<img src="<?php echo $choice['image']; ?>"><br>
							<?php endif; ?>
							<span class='letters'><?php echo $choice['order']; ?>. </span><?php echo _($choice['choice']); ?>
						</label>
				<?php
						if($choicetype == "normal") echo "<br>";
						
						$ctr++;
						if($ctr == 4):
				?>
							<div class="clear"></div>
				<?php
						endif;
					endforeach;
				?>
			</td>
			<input type="hidden" name="type" value="<?php echo $testtype; ?>">
		</tr>
	</table>
	<div class="clear"></div>
	<br/>
	<?php if( $index != 0 ) : ?>
		<a href="dt.php?dtid=<?php echo $dtid; ?>&i=<?php echo ($index - 1); ?>" class="button1 fleft<?php if($index <= 0) { echo " hidden"; } ?>" id="dt-back"><?php echo _('Back'); ?></a>
	<?php endif; ?>
	<input type="submit" class="button1" name="student-test" id="submit-test" value="<?php if($fin) { echo $finish; } else { echo _("Next"); } ?>">
</form>
<!-- <a href="dt-results.php?sdtid=<?php //echo $sdtid; ?>" class="hidden button1" id="check-results"><?php //echo _("Check Results"); ?></a> -->
</div>
<script>
var timelimit 	= <?php echo $timelimit; ?> + 1;
var testtype	= '<?php echo $testtype; ?>';
var fin = '<?php echo $finish; ?>';
$(document).ready(function() {
	window.onbeforeunload = confirmOnPageExit;

	$('#submit-test').click(function(e) {
		window.onbeforeunload = null;
		
		var checked = false;
		
		$('.choices input[type=' + testtype + ']').each(function() {
			if($(this).is(':checked')) checked = true;
		});
		
		if(!checked) { 
			e.preventDefault();
			alert("<?php echo _('Please select an answer for this question.'); ?>");
		}
		
		//if($(this).val() == fin) {
		//	if(!window.confirm("<?php echo _('You are about to submit this test. You can still go back and check your answers. Do you really want to submit this test?'); ?>")){
		//		e.preventDefault();
		//	}
		//}
	});
	
	$('#dt-back').click(function() {
		window.onbeforeunload = null;
	});

	$('#check-results').click(function() {
		window.onbeforeunload = null;
	});

	<?php if($language == "es_ES") { ?>
		$('#countdown').countdown({ labels: ['Años', 'Meses', 'Semanas', 'Días', 'Horas', 'Minutos', 'Segundos'], until: +timelimit, format: 'HMS', onExpiry: stopTest });		
	<?php } else if($language == "zh_CN"){ ?>
		$('#countdown').countdown({ labels: ['年', '月', '周', '天', '小時', '分鐘', '秒'], until: +timelimit, format: 'HMS', onExpiry: stopTest });	
	<?php } else{ ?>
		$('#countdown').countdown({ until: +timelimit, format: 'HMS', onExpiry: stopTest });	
	<?php } ?>
	
	function stopTest() {
		$('.choices input[type=' + testtype + ']').each(function() {
			$(this).attr('disabled',true);
		});
	
		$.ajax({
			type	: "POST",
			url		: "save-dt-unanswered.php?sdtid=<?php echo $sdtid; ?>",
		});
		
		alert("<?php echo _('Your time has expired for this exam. Any questions you have not answered will be marked as incorrect.'); ?>");
		
		$('#dt-back').addClass('hidden');
		$('#submit-test').addClass('hidden');
		$('#check-results').removeClass('hidden');
		$('.button1').removeAttr('href');
		$('#submit-test').prop('disabled', true);
	}
});

var confirmOnPageExit = function (e) 
{
    // If we haven't been passed the event get the window.event
    e = e || window.event;

    var message = '<?php echo _("You are currently taking your exam."); ?>';

    // For IE6-8 and Firefox prior to version 4
    if (e) 
    {
        e.returnValue = message;
    }

    // For Chrome, Safari, IE8+ and Opera 12+
    return message;
};
</script>
<?php require_once "footer.php"; ?>