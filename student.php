<?php
	require_once 'session.php';	
	require_once 'locale.php';
	require_once 'php/functions.php';
	require_once 'controller/StudentModule.Controller.php';
	require_once 'controller/Module.Controller.php';
	require_once 'controller/StudentGroup.Controller.php';
	require_once 'controller/GroupModule.Controller.php';
	require_once 'controller/CumulativeTest.Controller.php';
	require_once 'controller/StudentCt.Controller.php';
	include_once 'controller/Language.Controller.php';
	
	$ufl = $user->getFirstLogin();
	if($ufl == 1){ header("Location: account-update.php?ut=2"); }

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
	.joyride-tip-guide:nth-child(9) {
	    left: 72% !important;
	    top: 39px !important;
	}
	.joyride-tip-guide:nth-child(9) .joyride-nub { left: 85%; }
</style>
</head>
<body>
<div id="header">
	<a class="logo fleft" href="<?php echo $link; ?>"><img src="images/logo2.png"></a>
	<div class="fright" id="logged-in">
		<?php echo _("You are currently logged in as"); ?> <span class="upper bold"><?php echo $user->getUsername(); ?></span>. <a class="link fright" id="logout" href="logout.php"><?php echo _("Logout?"); ?></a>
		<br>
		<div class="languages fright">
			<?php if(!empty($teacher_languages)) :
				foreach($teacher_languages as $tl) : 
					$lang = $lc->getLanguage($tl['language_id']); ?>
					<a class="uppercase manage-box" href="student.php?lang=<?php echo $lang->getLanguage_code(); ?>"/><?php echo $lang->getShortcode(); ?></a>
			<?php  endforeach;
			else : ?>
				<a class="uppercase manage-box" href="student.php?lang=en_US"/><?php echo _("EN"); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>

<div id="content">
<div class="top-buttons">
	<div id="dbguide"><button class="uppercase fleft guide tguide" onClick="guide()">Guide Me</button></div>
</div>

<div class="grey" style="display: none;"></div>
<div class="clear"></div>

<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstname(); ?></span>!</h1>
<?php
	if(isset($_GET["ft"])):
		if($_GET["ft"]==1): ?>
			<div class="first-timer">
				<p>It looks like this is your first time to visit your dashboard...<br/>
				Here at NexGenReady, we place great emphasis on making our interface easy for you to use. To help you learn how to get the most out of all the features of our site, you can click on the <button class="uppercase guide" onClick="guide()">Guide Me</button>button on each page. This will help you navigate and utilize all the things you can do in each section.</p>
			</div>
		<?php
		endif;
	endif;
?>
<p><?php echo _("This is your Dashboard. On this page, you can select a module to work on and view the results of the modules you have taken."); ?></p></br>
<div id="dash"></div>
<br/>

<?php 
	if($ct): ?>
		<center>
		<div id="ct">
<?php	
		if(!isset($st)): ?>
			<a href="take-ct.php?ctid=<?php echo $ct->getCTID(); ?>" class="take-box take-cumulative"><?php echo _("Take Cumulative Test"); ?></a>
<?php	endif; ?>
		<a href="student-ct-listing.php" class="take-box cumulative-results"><?php echo _("View Cumulative Test Results"); ?></a>
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
<!-- guide me content -->
<ol id="joyRideTipContent">
  <li data-class="languages" data-text="Next" data-options="tipLocation:left;tipAnimation:fade">
    <p>If there are several languages available, click on the button of the language you want to use for all modules and dashboard interface.</p>
  </li>
  <li data-class="module-box" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>This is the module box. Click the buttons to take modules and pre/post tests and view your results.</p>
  </li>
  <li data-class="take-cumulative" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>Click this button to take the cumulative test.</p>
    <p></p>
  </li>
  <li data-class="cumulative-results" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>Click this button to view the results of the cumulative tests.</p>
    <p></p>
  </li>
  <li data-id="logout" data-button="Close" data-options="tipLocation:bottom;tipAnimation:fade">
    <p>Clicking the <strong>Logout</strong> link will log you out of NexGenReady dashboard.</p>
  </li>
</ol>
<script>
function guide() {
  	$('#joyRideTipContent').joyride({
      autoStart : true,
      postStepCallback : function (index, tip) {
      if (index == 4) {
        $(this).joyride('set_li', false, 1);
      }
    },
    // modal:true,
    // expose: true
    });
}
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