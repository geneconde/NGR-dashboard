<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/CumulativeTest.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/DtQuestion.Controller.php';
	
	$action	= $_GET['action'];
	$userid = $user->getUserid();
	
	$ctc 			= new CumulativeTestController();
	$dtq 			= new DtQuestionController();
	$question_set 	= $dtq->getAllQuestions();
	
	$mc			= new ModuleController();
	$module_set	= $mc->getAllModules();
	
	if($action == "edit"):
		$ctid			= $_GET['ctid'];
		$ct_set 		= $ctc->getCumulativeTestByID($ctid);
		$questions 		= explode(',', $ct_set->getQid());
		$active			= $ct_set->getActive();
		$tl				= explode(":", $ct_set->getTimelimit());
		$testname		= $ct_set->getTestName();
	endif;
	
	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";
?>
<div id="container">
<a class="link" href="ct-settings.php">&laquo <?php echo _("Go Back"); ?></a>
<h1><?php if($action == "edit") { echo _("Edit Cumulative Test"); } else if($action == "new") { echo _("Create Cumulative Test"); } ?></h1>
<p><?php echo _("The Cumulative Test is a test that can be taken by students anytime. You can choose from a pool of questions with topics from the different science reviews available to your students."); ?></p>
<br/>
<table border="0" class="result morepad">
	<tr>
		<td><span class="bold">Test name:  </span></td>
		<td><input type="text" id="test-name" value="<?php if(isset($testname)) echo $testname; ?>"></td>
	</tr>
	<tr>
		<td class="bold"><?php echo _("Time Limit"); ?></td>
		<td><p><?php echo _("This test should be finished within a time limit. If the student exceeds the time limit, whatever he finishes will be recorded."); ?></p>
			<select id="hours">
				<option>0</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select>
			<?php echo _("Hour/s and"); ?> 
			<select id="minutes">
				<option>00</option>
				<option>05</option>
				<option>10</option>
				<option>15</option>
				<option>20</option>
				<option>25</option>
				<option>30</option>
				<option>35</option>
				<option>40</option>
				<option selected>45</option>
				<option>50</option>
				<option>55</option>
			</select>
			<?php echo _("Minutes"); ?>
		</td>
	</tr>
	<tr>
		<td class="bold"><?php echo _("Ready?"); ?></td>
		<td>
			<p><?php echo _("Turn on this feature to make it available to your students. When turned on, the \"Take Cumulative Test\" button will be available in the student's front page when they log in."); ?></p>
			<div class="onoffswitch">
			<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php if(isset($active) && $active) { ?> checked <?php } ?>>
			<label class="onoffswitch-label" for="myonoffswitch">
			<div class="onoffswitch-inner<?php echo $lang; ?>"></div>
			<div class="onoffswitch-switch<?php if($language == 'ar_EG') { echo $lang; } ?>"></div>
			</label>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<span class="bold"><?php echo _("Choose Questions"); ?></span><br/>
			<?php echo _("This is the pool of questions you can choose from. It contains topics from different science reviews available to you."); ?><br/>
			<span class="rvw"><?php echo "(*) - "._("questions with asterisk are from the reviews"); ?></span>
		</td>
	</tr>
	<?php $ctr= 1;
		  foreach($question_set as $row):
	?>
	<tr class="trline">
		<td>
			<div class="onoffswitch1">
				<input type="checkbox" name="onoffswitch<?php echo $ctr; ?>" class="onoffswitch1-checkbox" id="myonoffswitch<?php echo $ctr;?>" 
					   value="<?php echo $row['qid']; ?>" <?php if(isset($questions) && in_array($row['qid'], $questions)) { ?> checked <?php } ?>>
				<label class="onoffswitch1-label" for="myonoffswitch<?php echo $ctr;?>">
					<div class="onoffswitch1-inner<?php echo $lang; ?>"></div>
					<div class="onoffswitch1-switch<?php if($language == 'ar_EG') { echo $lang; } ?>"></div>
				</label>
			</div>
		</td>
		<td>
		<?php
			foreach($module_set as $module):
				if($row['module_id'] == $module['module_ID']) echo "["._($module['module_name'])."] ";
			endforeach;
		
			if($row['from_review']) echo _("<span class='ask'>* </span>");
			
			echo $row['question'];
		?>
		<br/>
		<?php $choices = $dtq->getQuestionChoices($row['qid']); ?>
		<br/>
		<small><?php echo _("Choices"); ?>:<br/>
		<?php foreach($choices as $choice): ?>
			<span class='letters'><?php echo $choice['order']; ?></span>. <?php echo $choice['choice']; ?><br>
		<?php endforeach; ?>
		<br/><?php echo _("Answer"); ?>: <?php echo $row['answer']; ?>
		</small>
		</td>
	</tr>
	<?php 
			$ctr++;
		endforeach;
	?>
</table>
<div class="clear"></div>
<br/>
<a href="#" class="button1" id="save">
	<?php 
		if($action == "edit"): echo _("Update and Save");
		elseif($action == "new"): echo _("Create");
		endif;
	?>
</a>
</div>
<script>
var selected,
	questions,
	timelimit,
	active,
	name,
	action = '<?php echo $action; ?>';
	
$(document).ready(function() {
	if(action == "edit") {
		$('#hours').val('<?php if(isset($tl)) echo ltrim($tl[0], '0'); ?>');
		$('#minutes').val('<?php if(isset($tl)) echo $tl[1]; ?>');
	}

	$('#save').click(function(e) {
		selected = [];
		
		$('.onoffswitch1-checkbox').each(function() {
			if($(this).is(':checked')) {
				selected.push($(this).attr('value'));
			}
		});
		
		name 		= $('#test-name').val();
		questions	= selected.join(',');
		active		= ($('#myonoffswitch').is(':checked')) ? 1 : 0;
		timelimit	= "0" + $('#hours').val() + ":" + $('#minutes').val() + ":" + "00";
		
		if(questions == ""){
			alert("Please select questions for this test.");
			e.preventDefault();
		} else {
			$.ajax({
				type	: "POST",
				url		: "add-ct.php<?php if(isset($ctid)) { ?>?ctid=<?php echo $ctid; } ?>",
				data	: {	qid: questions, isactive: active, tlimit: timelimit, act: action, tname: name },
				success	: function(data) {
					window.location.href = "ct-settings.php";
				}
			});
		}
	});
});
</script>
<?php require_once "footer.php"; ?>