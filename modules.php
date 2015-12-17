<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	require_once 'controller/StudentGroup.Controller.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/Language.Controller.php';
	include_once 'controller/GroupModule.Controller.php';
	
	$uc = new UserController();
	$userid = $user->getUserid();

	$sgc 		= new StudentGroupController();
	$groups		= $sgc->getGroups($userid);

	$groupHolder = $sgc->getGroups($userid);
	$groupID = $groupHolder[0]['group_id'];
	$groupNameHolder = $sgc->getGroupName($groupID);
	$group_name = $groupNameHolder[0]["group_name"];

	$dtc 				= new DiagnosticTestController();
	$ct  				= $dtc->getCumulativeTest($userid);
	$diagnostic_test  	= $dtc->getAllTeacherTests($userid);

	$gmc 		= new GroupModuleController();
	$tmodules	= $gmc->getModuleByTeacher($userid);

	$tmc = new TeacherModuleController();
	$tm_set = $tmc->getTeacherModule($userid);
	
	$teachermodules = array();
	
	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

	$mc = new ModuleController();
	$dtc = new DiagnosticTestController();
	
	if(empty($tm_set)){
		$modules = $tmc->getAllModules();
		$i = 1;
		foreach($modules as $module){
			$x = $module['module_ID'];
		 	$tmc->addTeacherModule($userid, $x);	
		}
		header("Location: modules.php");
	
	}
?>
<div id="content">
<div class='wrap'>
 	<div class="center">
 		<h1 class="lgs-text"><?php echo _("Let's Get Started"); ?></h1>
		<p class="lgs-text-sub heading-input step step2"><?php echo _("Step 3: Your Modules"); ?></p>
		<p class="lgs-text-sub heading-input"><?php echo _("Modules"); ?></p>
		<p class="lgs-text-sub note"><?php echo _("Listed below are 3 of the modules available in your account. You can choose to start by creating the pre and post diagnostic tests for any module (first two buttons) and then simply click on Activate (last button), or you can choose to quickly activate any or all of the modules by clicking on the Activate button (last button) and skip the pre and post diagnostic tests."); ?></p>
		<table class="modules">			
			<?php 
			$modules = $mc->getAllModules();
			$catTemp = 'module-category';
			foreach ($modules as $key => $module) : ?>
			<?php
				$category = $module['category'];
				$mname = $gmc->getModuleName($module['module_ID']);
				$gm = $gmc->getModuleGroupByID($groupID,$module['module_ID']);
				if(!$gm):
					$values = array(
						"group_id" 			=> $groupID,
						"module_id"			=> $module['module_ID'],
						"pretest_id"		=> 0,
						"posttest_id"		=> 0,
						"review_active"		=> 0,
						"pre_active"		=> 0,
						"post_active"		=> 0,
						"timelimit_pre"		=> "00:45:00",
						"timelimit_post"	=> "00:45:00"
					);
					$gmc->addGroupModule($values);
				endif;
				$cea = $dtc->getDiagnosticTest($module['module_ID'], $userid, 1);
				$ceb = $dtc->getDiagnosticTest($module['module_ID'], $userid, 2);
				$preID = "";
				$postID = "";
				if ($cea) $preID = $cea->getDTID();
				if ($ceb) $postID = $ceb->getDTID();
				$gmActive = $gmc->getModuleGroupByID($groupID,$module['module_ID']);
			?>

			<?php if($catTemp != $category) { ?>
			<tr><td class="category"><?php echo _($category); ?></td></tr>
			<?php $catTemp = $category; ?>
			<?php } ?>

			<tr>
				<td id="module-name" class="module-name"><?php echo _($mname); ?></td>
			</tr>
			<tr class="lgs-modules">
				<td class="dactivate a">
					<a class="pre-test"
					<?php if($cea) { ?>
						href="dt-item.php?dtid=<?php echo $preID; ?>&action=edit"><?php echo _("Edit Pre-Diagnostic Test"); ?>
					<?php } else { ?>
						href="dt-item.php?module_id=<?php echo $module['module_ID']; ?>&mode=pre&action=new"><?php echo _("Create Pre-Diagnostic Test"); ?>
					<?php } ?>
					</a>
				</td>
				<td class="dactivate b">
					<a class="post-test"
					<?php if($ceb){ ?>
						href="dt-item.php?dtid=<?php echo $postID; ?>&action=edit"><?php echo _("Edit Post-Diagnostic Test"); ?>
					<?php } else { ?>
						href="dt-item.php?module_id=<?php echo $module['module_ID']; ?>&mode=post&action=new"><?php echo _("Create Post-Diagnostic Test"); ?>
					<?php } ?>
					</a>
				</td>
				<?php
				$dtA = $dtc->getDiagnosticTestByID($preID);
				$dtB = $dtc->getDiagnosticTestByID($postID);
				$dtAn = "";
				$dtBn = "";
				if ($dtA) $dtAn = $dtA->getTestName();
				if ($dtB) $dtBn = $dtB->getTestName();
				$adActivated = 0;
				$btnLabel = _("Activate for ") . "$group_name";
				if($gmActive){
					if($gmActive[0]['pre_active'] == '1' || $gmActive[0]['post_active'] == '1' || $gmActive[0]['review_active'] == '1'){
						$btnLabel = _("Deactivate for ") . "$group_name";
						$adActivated = 1;
					}
				}

				$adc = $module['module_ID'].': '.$groupID.': '.$preID.': '.$postID.': '.$mname.': '.$dtAn.': '.$dtBn.': '.$adActivated.': '.$group_name;
				?>
				<td class="dactivate btn">
					<input class="dactivatemin" type="button" id="<?php echo $module['module_ID']; ?>" value="<?php echo $btnLabel; ?>" onclick="toggle('<?php echo $adc; ?>');">
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
		<!-- <input id="skip_Submit" name="skip_Submit" class="start" type="submit" value="Next" />final-words.php -->
		<a href="final-words.php" class="nbtn" id="next"><?php echo _("Next"); ?></a>
		<a class="nbtn back" href="phpgrid/student-information.php"><?php echo _("Back"); ?></a>
	</div>
</div>
<script>
	var inputElement = document.getElementById("abtn");
	inputElement.type = "button";
	inputElement.addEventListener('click', function(){
	    toggle(adc);
	});
	function toggle(adc)
	{
		adc = adc.split(": ");
		var mid = adc[0];
		var gid = adc[1];
		var preid = adc[2];
		var postid = adc[3];
		var module = 1;
		var preAct = (preid == "" ? 0 : 1);
		var postAct = (postid == "" ? 0 : 1);
		var pre	= "00:45:00";
		var post	= "00:45:00";
		var mname = adc[4];
		var preName = adc[5];
		var postName = adc[6];
		var adActivated = adc[7];
		var gname = adc[8];
		if(preid=="" && adActivated!=1 && document.getElementById(mid).value=="<?php echo _('Activate for '); ?>"+gname){ var conf = confirm('<?php echo _("Are you sure you want to activate the module without activating the pre-test? Once your students start with the module, you won\'t be able to activate a pre-test."); ?>');
		}
		if(document.getElementById(mid).value=="<?php echo _('Activate for '); ?>"+gname || conf == true) {
			var msg = "<?php echo _('The following has been activated for '); ?><?php echo $group_name; ?>:\n* " + mname + "<?php echo _(' module'); ?>";
			if(preid!="") { msg += "\n* <?php echo _('The pre-diagnostic test '); ?>"+preName; }
			if(postid!="") { msg += "\n* <?php echo _('The post-diagnostic test '); ?>"+postName; }
			$.ajax({
				type	: "POST",
				url		: "update-module-group.php?group_id=<?php echo $groupID; ?>&module_id="+mid,
				data	: {	preid: preid, postid: postid, ractive: module, preactive: preAct, postactive: postAct, pretl: pre, posttl: post },
				success	: function(json) {
					if(json.error) return;
					alert(msg);
				}
			});
			document.getElementById(mid).value="<?php echo _('Deactivate for '); ?>"+gname;
		}
		else if(document.getElementById(mid).value=="<?php echo _('Deactivate for '); ?>"+gname) {
			var msg = "<?php echo _('The following has been deactivated for '); ?><?php echo $group_name; ?>:\n* " + mname + "<?php echo _(' module'); ?>";
			if(preid!="") { msg += "\n* <?php echo _('The pre-diagnostic test '); ?>"+preName; }
			if(postid!="") { msg += "\n* <?php echo _('The post-diagnostic test '); ?>"+postName; }
			$.ajax({
				type	: "POST",
				url		: "update-module-group.php?group_id=<?php echo $groupID; ?>&module_id="+mid,
				data	: {	preid: preid, postid: postid, ractive: 0, preactive: 0, postactive: 0, pretl: pre, posttl: post },
				success	: function(json) {
					if(json.error) return;
					alert(msg);
				}
			});
			document.getElementById(mid).value="<?php echo _('Activate for '); ?>"+gname;
		}
	}
</script>
<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_left" data-tourtarget=".dactivate.a">
    <p><?php echo _("Create a pre-diagnostic test for any module by clicking the button below. After you create a pre-diagnostic test, the button's text will change to <strong>Edit Pre-Diagnostic test</strong>. Clicking this button will let you update the test."); ?></p>
  </li>
  <li class="tlypageguide_top" data-tourtarget=".dactivate.b">
    <p><?php echo _("Create a post-diagnostic test for any module by clicking the button below. After you create a post-diagnostic test, the button's text will change to <strong>Edit Post-Diagnostic test</strong>. Clicking this button will let you update the test."); ?></p>
  </li>
  <li class="tlypageguide_top" data-tourtarget=".dactivate.btn">
    <p><?php echo _("Click this button to activate the module as well as the pre-diagnostic test and post-diagnostic test, if you created any."); ?></p>
  </li>
  <li class="tlypageguide_left" data-tourtarget="#next">
    <p><?php echo _("Click <strong>Next</strong> to go to the next page."); ?></p>
  </li>
</ul>
<?php include "footer.php"; ?>