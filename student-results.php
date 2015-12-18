<?php 
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/StudentDt.Controller.php';
	include_once 'controller/StudentModule.Controller.php';
	include_once 'controller/StudentGroup.Controller.php';
	include_once 'controller/GroupModule.Controller.php';
	
	$userid		= $user->getUserid();
	$mid 		= $_GET['mid'];
	$gid		= $_GET['gid'];
	
	$sgc		= new StudentGroupController();
	$stg		= $sgc->getUsersInGroup($gid);
	
	$students 	= $uc->loadUserTypeOrderLname(2, $userid);
	
	$dtc 		= new DiagnosticTestController();
	$smc		= new StudentModuleController();
	$sdc		= new StudentDtController();
	
	$gmc		= new GroupModuleController();
	$gm			= $gmc->getModuleGroupByID($gid, $mid);
	
	if($gm):
		$preid		= $gm[0]['pretest_id'];
		$postid		= $gm[0]['posttest_id'];
	endif;
	
?>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="student-group-results.php?mid=<?php echo $mid; ?>">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
	<div class="wrap">
	<h1><?php echo _("Students Results Summary"); ?></h1>
	<?php if(!empty($stg)): ?>
	<table border="0" class="result morepad">
		<tr>
			<th class="bold" id="studname"><?php echo _("Student Name"); ?></th>
			<!-- <th class="bold"><?php echo _("Results"); ?></th> -->
			<!-- <th class="bold"><?php echo _("Diagnostic Test"); ?></th> -->
			<th class="bold"><?php echo _("View Results"); ?></th>
		</tr>
		<?php
			foreach ($students as $student):
				if(in_array($student['user_ID'], $stg)):
			
					$finished = 1;
					$continueid = null;
					$studentmodules = $smc->loadStudentModuleByUser($student['user_ID'],$mid);
		?>
		<tr>
			<td><?php echo $student['last_name']; if ($student['last_name'] != '') echo ', '; echo $student['first_name'] ; ?></td>
			<td>
				<!-- check pre -->
				<?php 
					$pretest	= $sdc->getSDTbyStudent($student['user_ID'], $preid);

					if($pretest):
				?>
					<a id="prebtn" class="button1 cool-btn" href="dt-results.php?sdtid=<?php echo $pretest->getStudentDtID(); ?>&gid=<?php echo $gid; ?>"><?php echo _("Pre-Test"); ?></a>
				<?php else: ?>
					<a id="prebtn" class="button1 disabled" href="#"><?php echo _("Pre-Test"); ?></a>
				<?php endif; ?>
				<!-- end check pre -->
				
				<!-- view results -->
				<?php
					if ($studentmodules):
						foreach($studentmodules as $sm):
							if ($sm['date_finished'] == '0000-00-00 00:00:00' && $sm['module_ID'] == $mid):
								$finished = 0;
								$continueid = $sm['student_module_ID'];
							endif;
							
							if ($finished == 1 && $sm['module_ID'] == $mid):
				?>
							<a id="statmodule" class="button1 cool-btn" href="results.php?smid=<?php echo $sm['student_module_ID']; ?>&gid=<?php echo $gid; ?>"><?php echo _("Module"); ?></a>
				<?php 	
							elseif ($finished == 0 && $sm['module_ID'] == $mid): 
				?>
							<span id="statmodule" class="button2"><?php echo _("In Progress"); ?></span>
				<?php 		
							endif;
						endforeach;
					else :
				?>
						<a id="statmodule" class="button1 disabled" href="#"><?php echo _("Module"); ?></a>
				<?php
					endif;
				?>
				<!-- end view results -->

				<!-- check post -->
				<?php 
					$posttest	= $sdc->getSDTbyStudent($student['user_ID'], $postid);
					
					if($posttest):
				?>
					<a id="postbtn" class="button1 cool-btn" href="dt-results.php?sdtid=<?php echo $posttest->getStudentDtID(); ?>&gid=<?php echo $gid; ?>"><?php echo _("Post-Test"); ?></a>
				<?php else: ?>
					<a id="postbtn" class="button1 disabled" href="#"><?php echo _("Post-Test"); ?></a>
				<?php endif; ?>
			</td>
		</tr>
		<?php 
				endif;
			endforeach;
		?>
	</table>
	<div class="clear"></div>
	<br><br>
	<div><a id="view-all" class="take-box" href="all-students-results.php?gid=<?php echo $gid; ?>&mid=<?php echo $mid; ?>"><?php echo _("See how all your students did"); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id="print" class="take-box" href="student-solutions.php?m=<?php echo $mid; ?>"><?php echo _("Print Student Solutions"); ?></a></div>
	<?php else: ?>
		<br>
		<br>
		<h3><?php echo _("There are no students assigned to this group yet."); ?></h3>
	<?php endif; ?>
	</div>
	
	<script>
	$(document).ready(function() {
		$('.disabled').click(function(e) {
			e.preventDefault();
		});
	});
	</script>

	<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
	  <li class="tlypageguide_right" data-tourtarget="#studname">
	    <p><?php echo _("This column lists all students in this student group."); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget="#prebtn">
	    <p><?php echo _("Click this button to view the result of this student's pre-diagnostic test. This button is grayed out if the student has not yet taken the test."); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget="#statmodule">
	    <p><?php echo _("Click this button to view the result of the module activities of this student. This button is grayed out if the student has not yet taken the module. It will also say <strong>\"In Progress\"</strong> if the student is currently taking the module."); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget="#postbtn">
	    <p><?php echo _("Click this button to view the result of this student's post-diagnostic test. This button is grayed out if the student has not yet taken the test."); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget="#view-all">
	    <p><?php echo _("Click this button to view the summary tables for all <strong>Quick Checks</strong> and <strong>Quiz Questions</strong> embedded in the module and on the pre-diagnostic test and post-diagnostic test for the module."); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget="#print">
	    <p><?php echo _("Click this button to view and/or print the answers of the students in the <strong>Problem Solving</strong> section of the module."); ?></p>
	  </li>
	</ul>

<?php require_once "footer.php"; ?>