
<?php
	ini_set('display_errors', 1);
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/Language.Controller.php';
	
	$type = $user->getType();
	if($type == 3 || $type == 4) { header("Location: subscriber/index.php"); }
	
	$userid 			= $user->getUserid();
	$dtc 				= new DiagnosticTestController();
	$ct  				= $dtc->getCumulativeTest($userid);
	$diagnostic_test  	= $dtc->getAllTeacherTests($userid);
	
	$tmc = new TeacherModuleController();
	$tm_set = $tmc->getTeacherModule($userid);
	
	$mc = new ModuleController();

	$teachermodules = array();
	
	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

	$ufl = $user->getFirstLogin();
	if($ufl == 1){ header("Location: account-update.php"); }
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title>NexGenReady</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="styles/layerslider.css" />
<link rel="stylesheet" type="text/css" href="styles/jquery.countdown.css" />
<link rel="stylesheet" href="libraries/joyride/joyride-2.1.css">
<link rel="stylesheet" type="text/css" href="lgs.css">

<!-- added for the tabbed navigation results
<link rel="stylesheet" type="text/css" href="styles/tabbed-navigation.css" />
<link rel="stylesheet" type="text/css" href="styles/tabbed-reset.css" />
<script type="text/javascript" src="scripts/modernizr.js"></script> -->
<!-- end tabbed navigation results -->

<script type="text/javascript" src="scripts/jquery-1.8.3.min.js" ></script>
<script type="text/javascript" src="scripts/jquery-ui.js"></script>
<script type="text/javascript" src="scripts/jquery.plugin.js"></script>
<script type="text/javascript" src="libraries/joyride/jquery.cookie.js"></script>
<script type="text/javascript" src="libraries/joyride/modernizr.mq.js"></script>
<script type="text/javascript" src="libraries/joyride/jquery.joyride-2.1.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="scripts/language-scripts.js"></script>

<style>
	a.ngss_link:hover {
		text-decoration: none;
		background-color: #FAEBD7;
	}
	<?php if($language == "es_ES") {  ?>
		.close-btn { width: 65px !important; }
		.module-menu {
		 	width: 105% !important;
		 	margin: 0 auto;
		 	padding-top: 10px;
		  	text-align: center;
			margin-left: -8px !important;
		}
	<?php } else if($language == "zh_CN") { ?>
		.close-btn { width: 40px !important; }
	<?php } ?>
	.joyride-tip-guide:nth-child(15) {
	    left: 72% !important;
	    top: 39px !important;
	}
	.joyride-tip-guide:nth-child(15) .joyride-nub { left: 85%; }
</style>
</head>
<body>
<div id="header">
	<a class="logo fleft" href="<?php echo $link; ?>"><img src="images/logo2.png"></a>
	<div class="fright" id="logged-in">
		<?php echo _("You are currently logged in as"); ?> <span class="upper bold"><?php echo $user->getUsername(); ?></span>. <a class="link fright" id="logout" href="logout.php"><?php echo _("Logout?"); ?></a>
		<br>
		<a id="my-account" class="uppercase fright manage-box" href="edit-account.php?user_id=<?php echo $userid; ?>"/><?php echo _("Manage My Account"); ?></a>
		<div class="languages fright">
			<?php if(!empty($teacher_languages)) :
				foreach($teacher_languages as $tl) : 
					$lang = $lc->getLanguage($tl['language_id']); ?>
					<a class="uppercase manage-box" href="teacher.php?lang=<?php echo $lang->getLanguage_code(); ?>"/><?php echo $lang->getShortcode(); ?></a>
			<?php  endforeach;
			else : ?>
				<a class="uppercase manage-box" href="teacher.php?lang=en_US"/><?php echo _("EN"); ?></a>
			<?php endif; ?>
			<a href="teacher-languages.php" class="link"><?php echo _("Edit Languages"); ?></a>
		</div>
	</div>
</div>

<div id="content">
<div class="top-buttons">
	<div id="dbguide"><button class="uppercase fleft guide tguide" onClick="guide()">Guide Me</button></div>
	<div class="buttons">
		<a class="uppercase fright manage-box" target="_blank" href="../marketing/ngss.php"/><?php echo _("See the NGSS Alignment"); ?></a>
		<a id="student-accounts" class="uppercase fright manage-box" href="phpgrid/manage-students.php"/><?php echo _("Student Accounts"); ?></a>
		<a id="student-groups" class="uppercase fright manage-box" href="student-accounts.php"/><?php echo _("Student Groups"); ?></a>
		<a class="uppercase fright manage-box" href="ct-settings.php" id="gm-cumulative-settings"><?php echo _("CUMULATIVE TEST SETTINGS"); ?></a>
		<a class="uppercase fright manage-box" href="all-ct.php" id="gm-cumulative-results"><?php echo _("CUMULATIVE TEST RESULTS"); ?></a>
		<a class="uppercase fright manage-box" href="#"><?php echo _("Module"); ?></a>
	</div>
</div>

<div class="grey" style="display: none;"></div>
<div class="clear"></div>

<h1 class="dash-welcome"><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstname(); ?></span>!</h1>
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
<p class="dash-message"><?php echo _("This is your Dashboard. On this page, you can preview the modules available for your students, adjust modules settings and view the students' results."); ?></p>
<br><br>

<div class="container wrapper">
	<div class="pull-right">
		<button class="btn-portfilter" data-toggle="portfilter" data-target="all">All</button>
		<button class="btn-portfilter" data-toggle="portfilter" data-target="Earth Science">Earth Science</button>
		<button class="btn-portfilter" data-toggle="portfilter" data-target="Life Science">Life Science</button>
		<button class="btn-portfilter" data-toggle="portfilter" data-target="Physical Science">Physical Science</button>
		<button class="btn-portfilter" data-toggle="portfilter" data-target="STEM Skills and Practices">Stem Skills and Practices</button>
	</div>

	<ul class="thumbnails gallery">

	<?php $modules = $mc->getAllModules(); ?>
	<?php foreach($modules as $module): ?>
		<?php foreach($tm_set as $sm): ?>
			<?php if($module['module_ID'] == $sm['module_id']): ?>
				<?php array_push($teachermodules, $module['module_ID']); ?>
				<li class="clearfix gm-module" data-tag='<?php echo _($module['category']); ?>'>
					<div class="thumbnail">
						<div class="caption">
							<div class="mod-desc">
								<div><?php echo _($module['module_desc']); ?></div>
								<span class="close-btn"><?php echo _("Close!"); ?></span>
							</div>
							<div class="fleft"><h4><?php echo _($module['module_name']); ?></h4></div>
							<div class="fright cat"><label><?php echo _($module['category']); ?></label></div>
							<div class="clear"></div>
							<div class="fleft module-img">
								<img src="images\portfolio\<?php echo $module['module_ID']; ?>.jpg" alt="<?php echo _($module['module_name']); ?>">
							</div>
							<div class="fright module-buttons">
								<a href="#" class="desc-btn overview"><?php echo _("Overview"); ?></a>
								<a class="view-module" href="demo/<?php echo $module['module_ID']; ?>/1.php"><?php echo _("Module"); ?></a><br>
								<a class="settings" href="settings.php?mid=<?php echo $module['module_ID']; ?>"><?php echo _("Settings"); ?></a>
								<a class="results" href="student-group-results.php?mid=<?php echo $module['module_ID']; ?>"><?php echo _("Results"); ?></a>
							</div>
						</div>
					</div>
				</li>
		<?php endif; ?>
		<?php endforeach; ?>
	<?php endforeach; ?>
	<?php $_SESSION['modules'] = $teachermodules; ?>
	</ul>
</div>

<div class="clear"></div>

<!-- guide me content -->
<ol id="joyRideTipContent">
  <li data-class="languages" data-text="<?php echo _('Next'); ?>" data-options="tipLocation:left;tipAnimation:fade">
    <p><?php echo _("Click on <strong>Edit Languages</strong> to set the language options in which the modules themselves and your dashboard and its functions can be viewed."); ?></p>
  </li>
  <li data-id="my-account" data-button="<?php echo _('Next'); ?>" data-options="tipLocation:left;tipAnimation:fade">
    <p><?php echo _("Click this button to personalize your information."); ?></p>
  </li>
  <li data-id="student-accounts" data-button="<?php echo _('Next'); ?>" data-options="tipLocation:left;tipAnimation:fade">
    <p><?php echo _("Click this button to manage account and change password of your students."); ?></p>
  </li>
  <li data-id="student-groups" data-button="<?php echo _('Next'); ?>" data-options="tipLocation:left;tipAnimation:fade">
    <p><?php echo _("Click this button to manage student groups. You can create groups and transfer students as well."); ?></p>
  </li>
  <li data-class="gm-module" data-button="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
    <p><?php echo _("This is the module box. This is where you can manage data related to the module. You can click on the <strong>Overview</strong> button to view the description of each module."); ?></p>
  </li>
  <li data-class="view-module" data-button="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
    <p><?php echo _("Clicking this button will allow you to go through the module as a student would experience it. This is for demonstration purposes only so answers are not saved."); ?></p>
  </li>
  <li data-class="settings" data-button="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
    <p><?php echo _("The settings button will take you to a screen that allows you to do the following:"); ?></p>
    <ul style="padding-left: 20px; font-size: 14px;">
    	<li><?php echo _("Open/close the module completely for any or all groups"); ?></li>
    	<li><?php echo _("Create, edit or delete a pre and/or post diagnostic test"); ?></li>
    	<li><?php echo _("Open/close a pre and post diagnostic tests for the student groups"); ?></li>
    	<li><?php echo _("Set time limits for the test for each student group"); ?></li>
    </ul>
    <p></p>
  </li>
  <li data-class="results" data-button="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
    <p><?php echo _("All student's responses to questions embedded in a module, including questions on the pre and post diagnostic tests for a module and a \"cumulative\" post-diagnostic test across several modules, are automatically recorded in a database and will be available for individual students and groups of students."); ?></p>
    <p><?php echo _("Clicking on this button will take you to a screen where you can select a group and view the test results of the students in that group."); ?></p>
  </li>
  <li data-id="gm-cumulative-settings" data-button="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
    <p><?php echo _('Click this button to create a <strong>"cumulative test"</strong>. This test can cover any or all modules. Creating and administering a <strong>"cumulative test"</strong> across several modules is optional.'); ?></p>
  </li>
  <li data-id="gm-cumulative-results" data-button="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
    <p><?php echo _("Click this button to view the results of the cumulative tests of students."); ?></p>
  </li>
  <li data-id="logout" data-button="<?php echo _('Close'); ?>" data-options="tipLocation:bottom;tipAnimation:fade">
    <p><?php echo _("Clicking the <strong>Logout</strong> link will log you out of NexGenReady dashboard."); ?></p>
  </li>
</ol>
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
		$(".grey").css("display", "block");
	});
</script>
<script>
  function guide() {
  	$('#joyRideTipContent').joyride({
      autoStart : true,
      postStepCallback : function (index, tip) {
      if (index == 12) {
        $(this).joyride('set_li', false, 1);
      }
    },
    'template' : {
        'link'    : '<a href="#close" class="joyride-close-tip"><?php echo _("Close"); ?></a>'
      }
    });
  }
</script>
<script src="scripts/bootstrap-portfilter.min.js"></script>

<?php require_once "footer.php"; ?>