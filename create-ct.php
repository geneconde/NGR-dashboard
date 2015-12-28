<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/CumulativeTest.Controller.php';

	$userid = $user->getUserid();

	$tmc	= new TeacherModuleController();
	$tm  	= $tmc->getTeacherModule($userid);

	$mc 	= new ModuleController();

	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";

	$questions = '';
?>
<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="ct-test.php">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div class="ct-container wrap">
	<h1><?php echo _("Create Cumulative Test"); ?></h1>
	<form action="add-ct.php" method="post" id="ct-form">
		<div class="ct-name">
			<p class="bold"><?php echo _("Test name"); ?></p>
			<input type="text" id="test-name" name="test-name" data-validation="required" data-validation-error-msg="<?php echo _("You must enter a test name."); ?>">
		</div>
		<div class="ct-limit">
			<p class="bold"><?php echo _("Time Limit"); ?></p>
			<p><?php echo _("This test must be completed within the specified time limit. Only answers that are completed within the time limit will be recorded."); ?></p>
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
		</div>
		<div class="dt-test-note">
			<p class="bold"><?php echo _("Ready?"); ?></p>
			<p><?php echo _("Turn on this feature to make it available to your students. When turned on, the \"Take Cumulative Test\" button will be available in the student's front page when they log in."); ?></p>
			<div class="onoffswitch">
				<input type="checkbox" name="active" class="onoffswitch-checkbox" id="myonoffswitch" <?php if(isset($active) && $active) { ?> checked <?php } ?>>
				<label class="onoffswitch-label" for="myonoffswitch">
				<div class="onoffswitch-inner<?php echo $lang; ?>"></div>
				<div id="switch" class="onoffswitch-switch<?php if($language == 'ar_EG') { echo $lang; } ?>"></div>
				</label>
			</div>
		</div>

		<table border="0" class="result morepad" id="ct-modules">
			<tr>
				<th><?php echo _("Module Title"); ?></th>
				<th><?php echo _("No. of Questions"); ?></th>
				<th id="action"><?php echo _("Action"); ?></th>
			</tr>
			<?php
				foreach($tm as $md){
					$module = $mc->getModule($md['module_id']);
					$checkingM = $tmc->checkModule($userid);
					if($md['module_id']==$checkingM){ break; }
			?>
					<tr>
						<td><?php echo _($module->getModule_name()); ?></td>
						<td class="center">
							<?php
								if(isset($_SESSION['ct'.$userid.$md['module_id']])):
									$questions 	= $questions .','. $_SESSION['ct'.$userid.$md['module_id']];
									$questions 	= ltrim($questions, ',');
					
									$qid		= explode(',', $_SESSION['ct'.$userid.$md['module_id']]);
									echo count($qid);
								else:
									echo 0;
								endif;
							?>
						</td>
						<td><a class="button1 cool-btn" href="ct-module.php?mid=<?php echo $md['module_id']; ?>"><?php echo _("Select Questions"); ?></a></td>
					</tr>
			<?php
				}
			?>
		</table>
		<input type='hidden' name="questions" value="<?php echo $questions; ?>">
		<div>
			<input type="submit" id="subtest" class="button1 save-changes" value="<?php echo _('Create Test'); ?>">
			<a href="ct-test.php" class="button1 cancel-changes"><?php echo _("Cancel"); ?></a>
		</div>
	</form>
</div>
<script>
$(document).ready(function(){
	if(localStorage.getItem("<?php echo $userid.'-test-name'; ?>") != null){
		$('#test-name').val(localStorage.getItem("<?php echo $userid.'-test-name'; ?>"));
	}

	if(localStorage.getItem("<?php echo $userid.'-hours'; ?>") != null){
		$('#hours').val(localStorage.getItem("<?php echo $userid.'-hours'; ?>"));
	}

	if(localStorage.getItem("<?php echo $userid.'-minutes'; ?>") != null){
		$('#minutes').val(localStorage.getItem("<?php echo $userid.'-minutes'; ?>"));
	}

	if(localStorage.getItem("<?php echo $userid.'-active'; ?>") == "on"){
		$('#myonoffswitch').attr('checked','checked');
	}

	window.onbeforeunload = function(){
		localStorage.setItem("<?php echo $userid.'-test-name'; ?>", $('#test-name').val());
		localStorage.setItem("<?php echo $userid.'-hours'; ?>", $('#hours').val());
		localStorage.setItem("<?php echo $userid.'-minutes'; ?>", $('#minutes').val());
		localStorage.setItem("<?php echo $userid.'-active'; ?>", $('#myonoffswitch').val());
	};
});

$.validate({
  form : '#ct-form'
});
</script>

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_right" data-tourtarget="#test-name">
    <p><?php echo _("Enter a name for this test."); ?></p>
  </li>
  <li class="tlypageguide_top" data-tourtarget="#hours">
    <p><?php echo _("Set the time limit for this cumulative test."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#switch">
    <p><?php echo _("Toggle this switch (on/off) to active/deactivate this cumulative test."); ?></p>
  </li>
  <li class="tlypageguide_top" data-tourtarget="#action">
    <p><?php echo _("Click <strong>Select Questions</strong> to choose the questions you want to add to the cumulative test from each module."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#subtest">
    <p><?php echo _("Click this button to save this test."); ?></p>
  </li>
</ul>

<?php require_once "footer.php"; ?>