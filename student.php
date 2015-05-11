<?php
	require_once 'session.php';	
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'php/functions.php';
	require_once 'controller/StudentModule.Controller.php';
	require_once 'controller/Module.Controller.php';
	require_once 'controller/StudentGroup.Controller.php';
	require_once 'controller/GroupModule.Controller.php';
	require_once 'controller/CumulativeTest.Controller.php';
	require_once 'controller/StudentCt.Controller.php';
	include_once 'controller/Language.Controller.php';
	
	$teacherid 			= $user->getTeacher();
	$userid				= $user->getUserid();

	$gmc				= new GroupModuleController();
	$sgc				= new StudentGroupController();
	$teacher_group		= $sgc->getActiveGroups($teacherid);
	
	foreach($teacher_group as $tgroup):
		$users = $sgc->getUsersInGroup($tgroup['group_id']);

		if(in_array($userid, $users)):
			$usergroup = $tgroup['group_id'];
			$_SESSION['group'] = $usergroup;
			break;
		else:
			$usergroup = 0;
		endif;
	endforeach;

	$scc				= new StudentCtController();
	$ctg				= $scc->getActiveCT($usergroup);
	$ctid 				= 0;

	if($ctg) {
		$ctid = $ctg[0]['ct_id'];
	}

	$ctc 				= new CumulativeTestController();
	$ct 				= $ctc->getCumulativeTestByID($ctid);
	
	$mc					= new ModuleController();
	$modules 			= $mc->getAllModules();

	$tmc				= new TeacherModuleController();
	$tm_set				= $tmc->getTeacherModule($teacherid);
	
	if($ct):
		$st				= $scc->getStudentCt($userid, $ct->getCTID());
	endif;

	$smc				= new StudentModuleController();
	$student_modules	= $smc->loadAllStudentModule($userid);

	$_SESSION['modules'] = array();
	
	//added for languages by jp
	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($teacherid);
?>
<div class="fleft" id="language">
	<?php echo _("Language"); ?>:
	<select id="language-menu">
		<?php
			if(!empty($teacher_languages)) :
				foreach($teacher_languages as $tl) : 
					$lang = $lc->getLanguage($tl['language_id']);
		?>
					<option value="<?php echo $lang->getLanguage_code(); ?>" <?php if($language == $lang->getLanguage_code()) { ?> selected <?php } ?>><?php echo $lang->getLanguage(); ?></option>
		<?php 
				endforeach; 
			else :
		?>
			<option value="en_US" <?php if($language == "en_US") { ?> selected <?php } ?>><?php echo _("English"); ?></option>
		<?php endif; ?>
	</select>
</div>
<div class="clear"></div>
<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstname(); ?></span>!</h1>
<p><?php echo _("This is your Dashboard. On this page, you can select a module to work on and view the results of the modules you have taken."); ?></p></br>
<div id="dash"></div>
<br/>

<?php 
	if($ct): ?>
		<center>
		<div id="ct">
<?php	
		if(!isset($st)): ?>
			<a href="take-ct.php?ctid=<?php echo $ct->getCTID(); ?>" class="take-box"><?php echo _("Take Cumulative Test"); ?></a>
<?php	endif; ?>
		<a href="student-ct-listing.php" class="take-box"><?php echo _("View Cumulative Test Results"); ?></a>
		<br/>
		<br/>
		</div>
		</center>
		<div id="dash"></div>
		<br/>
<?php
	endif;

	if($tm_set):
		
		foreach($modules as $module):
			$moduleid = $module['module_ID'];
			
			foreach($tm_set as $sm):
				if($moduleid == $sm['module_id']):				
?>
					<div class="module-box">
						<h2><?php echo _($module['module_name']); ?></h2>
							<?php 
								$pre 		= checkPreTest($usergroup, $moduleid, $userid);
								$pre_result = $pre['result'];
								
								echo $pre['output'];
								
								if($pre_result):
									$review 		= checkGroupModule($usergroup, $moduleid, $userid);
									$review_result 	= $review['result'];
									
									echo $review['output'];
								endif;
								
								if(isset($review_result) && $review_result):
									$post			= checkPostTest($usergroup, $moduleid, $userid);
									$post_result	= $post['result'];

									echo $post['output'];
								endif;
								
								$pre_result = 0;
								$review_result = 0;
							?>
					</div>
<?php			endif;
			endforeach;
		endforeach;
	else:
?>	
	<div id="dash"></div>
	<br>
	<center><h2><?php echo _("Your teacher has not activated any modules for you yet."); ?></h2></center>
	<br>
	<div id="dash"></div>
<?php endif; ?>
<script>
$(document).ready(function() {
	language = "<?php echo $language; ?>";
	
	if(language == "ar_EG" || language == "es_ES") {
		$('.module-box .take-box').css('padding','15px 5px');
		$('.module-box .take-box').css('fontSize','14px');
		$('.module-box .button1').css('fontSize','11px');
	}
});
</script>
<?php require_once "footer.php"; ?>