<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/CumulativeTest.Controller.php';
	include_once 'controller/DtQuestion.Controller.php';

	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";

	$userid 	= $user->getUserid();
	$ctid		= $_GET['ctid'];

	$tmc		= new TeacherModuleController();
	$tm  		= $tmc->getTeacherModule($userid);

	$mc 		= new ModuleController();
	$ctc 		= new CumulativeTestController();
	$dtq 		= new DtQuestionController();

	$ct 		= $ctc->getCumulativeTestByID($ctid);

	$timelimit 	= $ct->getTimelimit();
	$tl 		= explode(':', $timelimit);
	$qid		= explode(',', $ct->getQid());

	$allquestions	= $dtq->getAllQuestions();

	$questions = '';

	$count = 0;
	$total = 0;
?>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="ct-test.php">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="ct-container wrap">
	<h1><?php echo _("Edit Cumulative Test"); ?></h1>
	<form action="update-ct.php?ctid=<?php echo $ctid; ?>" method="post">
		<table border="0" class="result morepad details" id="ct-details">
			<tr>
				<td><span class="bold"><?php echo _("Test name:"); ?>  </span></td>
				<td><input type="text" id="test-name" name="test-name" value="<?php echo $ct->getTestName(); ?>"></td>
			</tr>
			<tr>
				<td class="bold"><?php echo _("Time Limit"); ?></td>
				<td><p><?php echo _("This test should be finished within a time limit. If the student exceeds the time limit, whatever he finishes will be recorded."); ?></p>
					<select id="hours" name="hours">
						<option value="00">0</option>
						<option value="01">1</option>
						<option value="02">2</option>
						<option value="03">3</option>
					</select>
					<?php echo _("Hour/s and"); ?> 
					<select id="minutes" name="minutes">
						<option value="00">00</option>
						<option value="05">05</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
						<option value="25">25</option>
						<option value="30">30</option>
						<option value="35">35</option>
						<option value="40">40</option>
						<option value="45" selected>45</option>
						<option value="50">50</option>
						<option value="55">55</option>
					</select>
					<?php echo _("Minutes"); ?>
				</td>
			</tr>
			<tr>
				<td class="bold"><?php echo _("Ready?"); ?></td>
				<td>
					<p><?php echo _("Turn on this feature to make it available to your students. When turned on, the \"Take Cumulative Test\" button will be available in the student's front page when they log in."); ?></p>
					<div class="onoffswitch">
					<input type="checkbox" name="active" class="onoffswitch-checkbox" id="myonoffswitch" <?php if($ct->getActive()) { ?> checked <?php } ?>>
					<label class="onoffswitch-label" for="myonoffswitch">
					<div class="onoffswitch-inner<?php echo $lang; ?>"></div>
					<div class="onoffswitch-switch<?php if($language == 'ar_EG') { echo $lang; } ?>"></div>
					</label>
					</div>
				</td>
			</tr>
		</table>
		<table border="1" class="result morepad" id="ct-modules">
			<tr>
				<th><?php echo _("Module Title"); ?></th>
				<th><?php echo _("No. of Questions"); ?></th>
				<th><?php echo _("Action"); ?></th>
			</tr>
<?php
			foreach($tm as $md) {
				$module = $mc->getModule($md['module_id']);
				$checkingM = $tmc->checkModule($userid);
				if($md['module_id']==$checkingM){ break; }
?>
			<tr>		
				<td><?php echo _($module->getModule_name()); ?></td>
				<td class="center">
					<?php
						foreach($allquestions as $q):
							if($md['module_id'] == $q['module_id']):
								if(in_array($q['qid'], $qid)) $count++;
							endif;
						endforeach;

						echo $count;
						$total += $count;
						$count = 0;
					?>
				</td>
				<td><a class="button1" href="ct-module.php?mid=<?php echo $md['module_id']; ?>&action=edit&ctid=<?php echo $ctid; ?>"><?php echo _("Select Questions");?></a></td>
			</tr>
<?php
			}
?>
			<tr>
				<td><?php echo _("Total Questions"); ?></td>
				<td class="center"><?php echo $total; ?></td>
				<td></td> 
			</tr>
		</table>
		<input type="submit" class="button1 save-changes" value="<?php echo _('Update Test'); ?>">
		<a href="ct-test.php" class="button1 cancel-changes"><?php echo _("Cancel"); ?></a>
	</form>
</div>
<script>
$(document).ready(function() {
	$('#hours').val("<?php echo $tl[0]; ?>");
	$('#minutes').val('<?php echo $tl[1]; ?>');
});
</script>
<?php include "footer.php"; ?>