<?php
	ini_set('display_errors', 1);
	require_once '../session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once '../controller/DiagnosticTest.Controller.php';
	include_once '../controller/TeacherModule.Controller.php';
	include_once '../controller/Module.Controller.php';
	include_once '../controller/Language.Controller.php';
	
	$userid 			= $user->getUserid();
	$dtc 				= new DiagnosticTestController();
	$ct  				= $dtc->getCumulativeTest($userid);
	$diagnostic_test  	= $dtc->getAllTeacherTests($userid);
	
	$tmc = new TeacherModuleController();
	$tm_set = $tmc->getTeacherModule($userid);
	
	$mc = new ModuleController();

	$teachermodules = array();
	
	//added for languages by jp
	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

?>

<div class="grey"></div>

<a class="link" href="index.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>
<br><br>

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
	<a href="edit-languages.php" class="link"><?php echo _("Edit Languages"); ?></a>
</div>
<!-- <div class="fright m-top10" id="accounts">
	<div id="manage-container">
		<?php echo _('Manage:'); ?> 
		<select id="manage-menu">
			<option selected><?php echo _('Options'); ?></option>
			<option value="edit-account.php?user_id=<?php echo $userid; ?>&f=0"><?php echo _('Teacher Account'); ?></option>
			<option value="phpgrid/manage-students.php"><?php echo _('Student Accounts'); ?></option>
			<option value="student-accounts.php"><?php echo _('Student Groups'); ?></option>
		</select>
	</div>
</div> -->
<div class="clear"></div>
<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstname(); ?></span>!</h1>
<p><?php echo _("On this page, you can preview the modules available."); ?></p></br>

<?php 
	$modules = $mc->getAllModules();
	foreach($modules as $module):
		//foreach($tm_set as $sm):
			//if($module['module_ID'] == $sm['module_id']):
				array_push($teachermodules, $module['module_ID']); ?>
				<div class="module-box teacher-mb">
					<span><?php echo $module['category']; ?></span>
					<!-- <span class="desc-btn"><?php echo _("Overview"); ?></span> -->
					
					<div class="mod-desc">
						<div><?php echo $module['module_desc']; ?></div>
						<span class="close-btn"><?php echo _("Close!"); ?></span>
					</div>

					<h2><?php echo _($module['module_name']); ?></h2>
					<br/>
					<div class="module-menu">
						<span class="take-box desc-btn"><?php echo _("OVERVIEW"); ?></span>
						<a class="take-box" href="../demo/<?php echo $module['module_ID']; ?>/1.php"><?php echo _("MODULE"); ?></a>
					</div>
					<div class="clear"></div>
					<br>
				</div>
<?php 
			//endif;
		//endforeach;
	endforeach;

	$_SESSION['modules'] = $teachermodules;
?>
<?php
	// echo '<pre>';
	// print_r($sm);
	// echo '</pre>';
?>

<div class="clear"></div>
<script>
	$("#manage-menu").change(function() {
		window.location = $(this).find("option:selected").val();
	});

	$(".close-btn").on("click", function(){
		$(".mod-desc").css("display", "none");
		$(".grey").css("display", "none");
	});
	
	$(".desc-btn").on("click", function(){
		$(this).parent().parent().find(".mod-desc").css("display", "block");
		
		//$(".mod-desc").css("display", "block");
		$(".grey").css("display", "block");
	});
</script>
<?php require_once "footer.php"; ?>