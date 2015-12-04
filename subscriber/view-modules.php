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
<style>
	.guide { display: none; }
	.take-box { text-transform: uppercase; }
	.module-menu a { font-size: 15px !important; }
</style>

<br><br>
<a class="link" href="index.php">&laquo; <?php echo _("Go Back to Account Management page"); ?></a>
<br>
<div class="clear"></div>
<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstname(); ?></span>!</h1>
<p><?php echo _("In this Dashboard, you can preview all the modules in your library."); ?></p><br><br><br>
<div class="clear"></div>
<?php 
	$modules = $mc->getAllModules();
	foreach($modules as $module):
		//foreach($tm_set as $sm):
			//if($module['module_ID'] == $sm['module_id']):
				array_push($teachermodules, $module['module_ID']); ?>
				<div class="module-box teacher-mb">
					<span><?php echo _($module['category']); ?></span>
					
					<div class="mod-desc">
						<div><?php echo $module['module_desc']; ?></div>
						<span class="close-btn"><?php echo _("Close!"); ?></span>
					</div>

					<h2><?php echo _($module['module_name']); ?></h2>
					<br/>
					<div class="module-menu">
						<span class="take-box desc-btn"><?php echo _("Overview"); ?></span>
						<a class="take-box" href="../demo/<?php echo $module['module_ID']; ?>/1.php"><?php echo _("Module"); ?></a>
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