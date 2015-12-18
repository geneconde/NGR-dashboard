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
?>
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

<div class="top-buttons">
	<div class="wrap">
		<?php $active = 'dashboard'; ?>
		<?php include "menu.php"; ?>
	</div>
</div>

<div id="content">
<div class='wrap'>
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

	<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
	  <li class="tlypageguide_right" data-tourtarget=".languages">
	    <p><?php echo _("If there are several languages available, click on the button of the language you want to use for all modules and dashboard interface."); ?></p>
	  </li>
	  <li class="tlypageguide_left" data-tourtarget=".module-box">
	    <p><?php echo _("This is the module box. Click the buttons to take modules and pre/post tests and view your results."); ?></p>
	  </li>
	  <li class="tlypageguide_right" data-tourtarget=".take-cumulative">
	    <p><?php echo _("Click this button to take the cumulative test."); ?></p>
	  </li>
	  <li class="tlypageguide_right" data-tourtarget="#logout">
	    <p><?php echo _("Clicking the <strong>Logout</strong> link will log you out of NexGenReady dashboard."); ?></p>
	  </li>
	</ul>

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