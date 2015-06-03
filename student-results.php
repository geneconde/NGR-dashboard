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
	<div id="container">
	<a class="link" href="student-group-results.php?mid=<?php echo $mid; ?>">&laquo <?php echo _("Go Back"); ?></a>
	<h1><?php echo _("Students Results Summary"); ?></h1>	
	<center>
	<?php if(!empty($stg)): ?>
	<table border="0" class="result morepad">
		<tr>
			<th class="bold"><?php echo _("Student Name"); ?></th>
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
					<a class="button1" href="dt-results.php?sdtid=<?php echo $pretest->getStudentDtID(); ?>&gid=<?php echo $gid; ?>"><?php echo _("Pre-Test"); ?></a>
				<?php else: ?>
					<a class="button1 disabled" href="#"><?php echo _("Pre-Test"); ?></a>
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
							<a class="button1" href="results.php?smid=<?php echo $sm['student_module_ID']; ?>&gid=<?php echo $gid; ?>"><?php echo _("Module"); ?></a>
				<?php 	
							elseif ($finished == 0 && $sm['module_ID'] == $mid): 
				?>
							<span class="button2"><?php echo _("In Progress"); ?></span>
				<?php 		
							endif;
						endforeach;
					else :
				?>
						<a class="button1 disabled" href="#"><?php echo _("Module"); ?></a>
				<?php
					endif;
				?>
				<!-- end view results -->

				<!-- check post -->
				<?php 
					$posttest	= $sdc->getSDTbyStudent($student['user_ID'], $postid);
					
					if($posttest):
				?>
					<a class="button1" href="dt-results.php?sdtid=<?php echo $posttest->getStudentDtID(); ?>&gid=<?php echo $gid; ?>"><?php echo _("Post-Test"); ?></a>
				<?php else: ?>
					<a class="button1 disabled" href="#"><?php echo _("Post-Test"); ?></a>
				<?php endif; ?>
			</td>
		</tr>
		<?php 
				endif;
			endforeach;
		?>
	</table>
	<div class="clear"></div>
	<br/>
	<div class="center"><a class="take-box" href="all-students-results.php?gid=<?php echo $gid; ?>&mid=<?php echo $mid; ?>"><?php echo _("See how all your students did"); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="take-box" href="student-solutions.php?m=<?php echo $mid; ?>"><?php echo _("Print Student Solutions"); ?></a></div>
	</div>
	<?php else: ?>
		<br>
		<br>
		<h3><?php echo _("There are no students assigned to this group yet."); ?></h3>
	<?php endif; ?>
	</center>
	
	<script>
	$(document).ready(function() {
		$('.disabled').click(function(e) {
			e.preventDefault();
		});
	});
	</script>
	<?php require_once "footer.php"; ?>