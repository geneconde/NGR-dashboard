<?php
	ini_set('display_errors', 1);
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/Language.Controller.php';
	
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
<style>
	<?php if($language == "es_ES") { ?>
		.module-menu {
		 	width: 105% !important;
		 	margin: 0 auto;
		 	padding-top: 10px;
		  	text-align: center;
			margin-left: -8px !important;
		}
	<?php } ?> 
	
	<?php if($language == "es_ES") {  ?>
		.close-btn { width: 65px !important; }
	<?php } ?>
</style>
<div class="grey"></div>

<div class="fleft" id="language">
	<?php echo _("Language"); ?>:
	
	<?php
			if(!empty($teacher_languages)) :
				foreach($teacher_languages as $tl) : 
					$lang = $lc->getLanguage($tl['language_id']);
		?>
					<a class="uppercase manage-box" href="teacher.php?lang=<?php echo $lang->getLanguage_code(); ?>"/><?php echo $lang->getLanguage(); ?></a>
		<?php 
				endforeach; 
			else :

		?>
			<a class="uppercase manage-box" href="teacher.php?lang=en_US"/><?php echo _("English"); ?></a>
		<?php endif; ?>

	<!-- <select id="language-menu">
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
	</select> -->
	<a href="teacher-languages.php" class="link"><?php echo _("Edit Languages"); ?></a>
</div>
<div class="fright m-top10" id="accounts">
	<div id="manage-container">
		<?php echo _('Manage:'); ?> 
		
			<a class="uppercase manage-box" href="edit-account.php?user_id=<?php echo $userid; ?>"/><?php echo _("Teacher Account"); ?></a>
			<a class="uppercase manage-box" href="phpgrid/manage-students.php"/><?php echo _("Student Accounts"); ?></a>
			<a class="uppercase manage-box" href="student-accounts.php"/><?php echo _("Student Groups"); ?></a>

		<!-- <select id="manage-menu">
			<option selected><?php echo _('Options'); ?></option>
			<option value="edit-account.php?user_id=<?php echo $userid; ?>&f=0"><?php echo _('Teacher Account'); ?></option>
			<option value="phpgrid/manage-students.php"><?php echo _('Student Accounts'); ?></option>
			<option value="student-accounts.php"><?php echo _('Student Groups'); ?></option>
		</select> -->
	</div>
	<!-- <a class="link fright" href="edit-account.php?user_id=<?php echo $userid; ?>&f=0"><?php echo _("Manage Teacher Account"); ?></a><p class="fright margin-sides">|</p>
	<a class="link fright" href="manage-student-accounts.php"><?php echo _("Manage Student Accounts"); ?></a><p class="fright margin-sides">|</p>
	<a class="link fright" href="student-accounts.php"><?php echo _("Manage Student Groups"); ?></a> -->
</div>
<div class="clear"></div>
<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstname(); ?></span>!</h1>
<p><?php echo _("This is your Dashboard. On this page, you can preview the modules available for your students, adjust modules settings and view the students' results."); ?></p></br>

<br/>
<div id="dash"></div>
<br/>
<div id="ct">
<center>
	<a class="take-box" href="ct-settings.php"><?php echo _("CUMULATIVE TEST SETTINGS"); ?></a>
	<a class="take-box" href="all-ct.php"><?php echo _("CUMULATIVE TEST RESULTS"); ?></a>
</center>
</div>
<br/>
<div id="dash"></div>
<br/><br/>

<?php 
	$modules = $mc->getAllModules();
	foreach($modules as $module):
		foreach($tm_set as $sm):
			if($module['module_ID'] == $sm['module_id']):
				array_push($teachermodules, $module['module_ID']);
?>
<div class="module-box teacher-mb">
	<span><?php echo _($module['category']); ?></span>
	<!-- <span class="desc-btn"><?php echo _("Overview"); ?></span> -->
	
	<div class="mod-desc">
		<div><?php echo _($module['module_desc']); ?></div>
		<span class="close-btn"><?php echo _("Close!"); ?></span>
	</div>

	<h2><?php echo _($module['module_name']); ?></h2>
	<br/>
	<div class="module-menu">
		<span class="take-box desc-btn"><?php echo _("Overview"); ?></span>
		<a class="take-box" href="demo/<?php echo $module['module_ID']; ?>/1.php"><?php echo _("Module"); ?></a>
		<a class="take-box" href="settings.php?mid=<?php echo $module['module_ID']; ?>"><?php echo _("Settings"); ?></a>
		<a class="take-box" href="student-group-results.php?mid=<?php echo $module['module_ID']; ?>"><?php echo _("Results"); ?></a>
	</div>
	<br>
</div>
<?php 
			endif;
		endforeach;
	endforeach;

	$_SESSION['modules'] = $teachermodules;
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