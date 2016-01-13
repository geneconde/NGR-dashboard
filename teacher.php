<?php
	ini_set('display_errors', 1);
	require_once 'session.php';
	require_once 'locale.php';
	require_once 'header.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/Language.Controller.php';
	include_once 'controller/StudentGroup.Controller.php';
	include_once 'controller/GroupModule.Controller.php';

	$type = $user->getType();
	if($type == 3 || $type == 4) { header("Location: subscriber/index.php"); }
	if($type == 2) { header("Location: student.php"); }

	$userid 			= $user->getUserid();
	$dtc 				= new DiagnosticTestController();
	$ct  				= $dtc->getCumulativeTest($userid);
	$diagnostic_test  	= $dtc->getAllTeacherTests($userid);

	$tmc = new TeacherModuleController();
	$tm_set = $tmc->getTeacherModule($userid);

	$mc = new ModuleController();
	$gmc 		= new GroupModuleController();

	$sgc		= new StudentGroupController();
	$groups		= $sgc->getActiveGroups($userid);

	$teachermodules = array();

	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

	$ufl = $user->getFirstLogin();
	if($ufl == 1){ header("Location: account-update.php"); }
?>
<style>
	a.ngss_link:hover {
		text-decoration: none;
		background-color: #FAEBD7;
	}
	<?php if($language == "es_ES") {  ?>
		.close-btn { width: 65px !important; }
	<?php } else if($language == "zh_CN") { ?>
		.close-btn { width: 40px !important; }
	<?php } ?>
</style>


<div class="top-buttons">
	<div class="wrap">
		<?php $active = 'dashboard'; ?>
		<?php include "menu.php"; ?>

	</div>
</div>

<div id="content">
<div class='wrap teacher-dash'>
	<div class="grey" style="display: none;"></div>
	<div class="clear"></div>

	<h1 class="dash-welcome">Dashboard</h1>
	<!-- <div id="dbguide"><button class="uppercase guide tguide" onClick="guide()">Step by Step Page Guide</button></div> -->
	<?php
		if(isset($_GET["ft"])):
			if($_GET["ft"]==1): ?>
				<div class="first-timer">
					<p><?php echo _("It looks like this is your first time to visit your dashboard..."); ?><br/>
					<?php echo _('Here at NexGenReady, we place great emphasis on making our interface easy for you to use. To help you learn how to get the most out of all the features of our site, you can click on the <button class="uppercase guide" onClick="guide()">Guide Me</button>button on each page. This will help you navigate and utilize all the things you can do in each section.'); ?></p>
				</div>
			<?php
			endif;
		endif;
	?>
	<p class="dash-message"><?php echo _("This is your Dashboard. On this page, you can preview the modules available for your students, adjust modules settings and view the students' results."); ?></p><br>


	<br>

	<div class="fleft module-filter">
		<button class="btn-portfilter active" data-toggle="portfilter" data-target="<?php echo _('all'); ?>"><?php echo _('View All'); ?></button>
		<button class="btn-portfilter" data-toggle="portfilter" data-target="<?php echo _('Earth Science'); ?>"><?php echo _('Earth Science'); ?></button>
		<button class="btn-portfilter" data-toggle="portfilter" data-target="<?php echo _('Life Science'); ?>"><?php echo _('Life Science'); ?></button>
		<button class="btn-portfilter" data-toggle="portfilter" data-target="<?php echo _('Physical Science'); ?>"><?php echo _('Physical Science'); ?></button>
		<button class="btn-portfilter" data-toggle="portfilter" data-target="<?php echo _('STEM Skills and Practices'); ?>"><?php echo _('Stem Skills and Practices'); ?></button>
		<button class="btn-portfilter" data-toggle="portfilter" data-target="<?php echo _('New Modules'); ?>"><?php echo _('New Modules'); ?></button>
	</div>
	<div class="clear"></div>
	<ul class="thumbnails gallery">

	<?php $modules = $mc->getAllModules(); ?>
	<?php foreach($modules as $module): ?>
		<?php foreach($tm_set as $sm): ?>
			<?php if($module['module_ID'] == $sm['module_id']): ?>
			<?php $mod = 0; $pre = 0; $post = 0; ?>
				<?php foreach($groups as $group): ?>
					<?php
					$gm = $gmc->getModuleGroupByID($group['group_id'], $module['module_ID']);
					if(!empty($gm)){
						$mod += $gm[0]['review_active'];
						$pre += $gm[0]['pre_active'];
						$post += $gm[0]['post_active'];
					}
					?>
				<?php endforeach; ?>
				<?php array_push($teachermodules, $module['module_ID']); ?>
				<li class="clearfix gm-module" data-tag='<?php echo _($module['category']); ?>'>
					<div class="thumbnail">
						<div class="caption">
							<div class="mod-desc">
								<div><?php echo _($module['module_desc']); ?></div>
								<span class="close-btn"><?php echo _("Close!"); ?></span>
							</div>
							<div class="fleft"><h3><?php echo _($module['module_name']); ?></h3></div>
							<div class="fright cat"><label><?php echo _($module['category']); ?></label></div>
							<div class="clear"></div>
							<div class="fleft module-img">
								<img src="images\portfolio\<?php echo $module['module_ID']; ?>.jpg" alt="<?php echo _($module['module_name']); ?>">
							</div>
							<div class="fleft module-buttons">
								<a href="#" class="desc-btn"><i class="fa fa-search"></i><?php echo _("Overview"); ?></a><br/>
								<a class="view-module" href="demo/<?php echo $module['module_ID']; ?>/1.php"><i class="fa fa-picture-o"></i><?php echo _("Module"); ?></a><br>
								<a class="settings" href="settings.php?mid=<?php echo $module['module_ID']; ?>"><i class="fa fa-cog"></i><?php echo _("Settings"); ?></a><br/>
								<a class="results" href="student-group-results.php?mid=<?php echo $module['module_ID']; ?>"><i class="fa fa-file-text-o"></i><?php echo _("Results"); ?></a><br>
							</div>
							<div class="fleft status-buttons">
								<div class="status-lbl"><?php echo _('Current Status'); ?></div>
								<div class="<?php echo ($mod >= 1 ? 'status-active' : 'status-inactive'); ?>"><?php echo ($mod >= 1 ? _('Module Active') : _('Module Inactive')); ?></div>
								<div class="<?php echo ($pre >= 1 ? 'status-active' : 'status-inactive'); ?>"><?php echo ($pre >= 1 ? _('Pre-test Inactive') : _('Pre-test Active')); ?></div>
								<div class="<?php echo ($post >= 1 ? 'status-active' : 'status-inactive'); ?>"><?php echo ($post >= 1 ? _('Post-test Inactive') : _('Post-test Active')); ?></div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</li>
		<?php endif; ?>
		<?php endforeach; ?>
	<?php endforeach; ?>
	<?php $_SESSION['modules'] = $teachermodules; ?>
	</ul>

    <ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
      <li class="tlypageguide_right" data-tourtarget=".languages">
        <p><?php echo _("Click on <strong>Edit Languages</strong> to set the language options in which the modules themselves and your dashboard and its functions can be viewed."); ?></p>
      </li>
      <li class="tlypageguide_left" data-tourtarget="#my-account">
        <p><?php echo _("Click this button to personalize your information."); ?></p>
      </li>
      <li class="tlypageguide_bottom" data-tourtarget="#student-accounts">
        <p><?php echo _("Click this button to manage account and change password of your students."); ?></p>
      </li>
      <li class="tlypageguide_bottom" data-tourtarget="#student-groups">
        <p><?php echo _("Click this button to manage student groups. You can create groups and transfer students as well."); ?></p>
      </li>
      <li class="tlypageguide_left" data-tourtarget=".gm-module">
        <p><?php echo _("This is the module box. This is where you can manage data related to the module. You can click on the <strong>Overview</strong> button to view the description of each module."); ?></p>
      </li>
      <li class="tlypageguide_left" data-tourtarget=".gm-module">
        <p><?php echo _("Clicking this button will allow you to go through the module as a student would experience it. This is for demonstration purposes only so answers are not saved."); ?></p>
      </li>
      <li class="tlypageguide_left" data-tourtarget=".view-module">
        Here is the fourth item description. The number will appear below the element.
      </li>
      <li class="tlypageguide_left" data-tourtarget=".settings">
        <p><?php echo _("The settings button will take you to a screen that allows you to do the following:"); ?></p>
	    <ul style="padding-left: 20px; font-size: 14px;">
	    	<li><?php echo _("Open/close the module completely for any or all groups"); ?></li>
	    	<li><?php echo _("Create, edit or delete a pre and/or post diagnostic test"); ?></li>
	    	<li><?php echo _("Open/close a pre and post diagnostic tests for the student groups"); ?></li>
	    	<li><?php echo _("Set time limits for the test for each student group"); ?></li>
	    </ul>
      </li>
      <li class="tlypageguide_bottom" data-tourtarget="#cumulative-test">
        <p><?php echo _("All student's responses to questions embedded in a module, including questions on the pre and post diagnostic tests for a module and a \"cumulative\" post-diagnostic test across several modules, are automatically recorded in a database and will be available for individual students and groups of students."); ?></p>
	    <p><?php echo _("Clicking on this button will take you to a screen where you can select a group and view the test results of the students in that group."); ?></p>
      </li>
      <li class="tlypageguide_right" data-tourtarget="#logout">
        <p><?php echo _("Clicking the <strong>Logout</strong> link will log you out of NexGenReady dashboard."); ?></p>
      </li>
    </ul>

	<script>
		$(".close-btn").on("click", function(){
			$(".mod-desc").css("display", "none");
			$(".grey").css("display", "none");
		});
		
		$(".desc-btn").on("click", function(){
			$(this).parent().parent().find(".mod-desc").css("display", "block");
			$(".grey").css("display", "block");
		});

		$('.btn-portfilter').click(function () {
			$('.btn-portfilter').removeClass('active');
			$(this).addClass('active');
		});
		
		$('.wrap').css("min-height",$('#content').height());

	</script>
	<script src="scripts/bootstrap-portfilter.min.js"></script>

<?php require_once "footer.php"; ?>