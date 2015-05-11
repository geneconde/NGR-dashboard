<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/DtQuestion.Controller.php';
	include_once 'controller/CumulativeTest.Controller.php';

	$userid = $user->getUserid();
	$mid	= $_GET['mid'];
	$action	= (isset($_GET['action']) ? "edit" : "new");
	
	$mc 			= new ModuleController();
	$dtq 			= new DtQuestionController();
	$question_set 	= $dtq->getDTPool($mid);
	$ctr = 0;

	if(isset($_GET['ctid'])):
		$ctid 	= $_GET['ctid'];
		$ctc 	= new CumulativeTestController();
		$ct		= $ctc->getCumulativeTestByID($ctid);
		$qid	= explode(',', $ct->getQid());
	elseif(isset($_SESSION['ct'.$userid.$mid])):
		$qid	= explode(',', $_SESSION['ct'.$userid.$mid]);
	endif;

	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";

	$module = $mc->loadModule($mid);
?>
<div id="container" class="ct-questions">
	<?php if($action == "new"): ?>
		<a class="link" href="create-ct.php">&laquo <?php echo _("Go Back"); ?></a>
	<?php elseif($action == "edit"): ?>
		<a class="link" href="edit-ct.php?ctid=<?php echo $ctid; ?>">&laquo <?php echo _("Go Back"); ?></a>
	<?php endif; ?>

	<h1><?php echo _($module->getModule_name()); ?></h1>
	<form action="process-ct.php?mid=<?php echo $mid; ?><?php if(isset($ctid)) echo '&ctid='.$ctid; ?>" method="POST">
		<input type="hidden" name="action" value="<?php echo $action; ?>">
		<table border="0" class="result morepad">
			<tr>
				<td colspan="2">
					<p><?php echo _('Please select the questions that you would like to add to your cumulative test.'); ?></p>
					<p><span class="rvw"><?php echo "(*) - "._("questions with asterisk are from the review itself"); ?></span></p>
				</td>
			</tr>
			<tr>
				<td>
					<center>
						<input type="checkbox" id="select-all">
					</center>
				</td>
				<td>
					<p id="select-text" style="vertical-align: middle;"><?php echo _("Select all questions"); ?></p>
				</td>
			</tr>
			<?php
				foreach($question_set as $question):
			?>
				<tr class="trline">
					<td class="p-right15">
						<!-- <div class="onoffswitch1"> -->
							<input type="checkbox" name="questions[]" class="q-cb" id="myonoffswitch<?php echo $ctr + 1;?>" value="<?php echo $question['qid']; ?>" <?php if(isset($qid) && in_array($question['qid'], $qid)) { ?> checked <?php } ?>>
							<!-- <input type="checkbox" name="questions[]" class="onoffswitch1-checkbox" id="myonoffswitch<?php echo $ctr + 1;?>" value="<?php echo $question['qid']; ?>" <?php if(isset($qid) && in_array($question['qid'], $qid)) { ?> checked <?php } ?>> -->
							<!-- <label class="onoffswitch1-label" for="myonoffswitch<?php echo $ctr + 1;?>">
								<div class="onoffswitch1-inner<?php echo $lang; ?>"></div>
								<div class="onoffswitch1-switch<?php if($language == 'ar_EG') { echo $lang; } ?>"></div>
							</label>
						</div> -->
					</td>
					<td>
					<?php
						echo ($ctr + 1).". ";
					
						if($question['from_review']) echo _("<span class='ask'>* </span>");
						echo _($question['question']);
						
						echo '<br/>';
			
						if($question['image'])
							echo '<img src="'.$question['image'].'" class="dtq-image">';
					?>
					<?php $choices = $dtq->getQuestionChoices($question['qid']); ?>
					<br/>
					<small><?php echo _("Choices"); ?>:<br/>
					<?php foreach($choices as $choice): ?>
						<span class='letters'><?php echo $choice['order']; ?></span>. <?php echo _($choice['choice']); ?><br>
					<?php endforeach; ?>
					<?php echo _("Answer"); ?>: <?php echo _($question['answer']); ?>
					</small>
					</td>
				</tr>
			<?php 
					$ctr++;
				endforeach;
			?>
		</table>
		<br>
		<input type="submit" value="<?php if($action == 'new'): echo _("Save Questions"); elseif($action =='edit'): echo _("Update Questions"); endif; ?>"  class="button1">
	</form>
</div>

<script>
$(document).ready(function(){
	$('#select-all').click(function(){
		if($(this).is(':checked')) {
			$('.q-cb').each(function(){
				$(this).prop('checked', true);
				$('#select-text').html('Deselect all questions');
			});
		} else {
			$('.q-cb').each(function(){
				$(this).prop('checked', false);
				$('#select-text').html('Select all questions')
			});
		}
	});
});
</script>