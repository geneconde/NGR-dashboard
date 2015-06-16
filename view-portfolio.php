<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/StudentModule.Controller.php';
	include_once 'controller/StudentGroup.Controller.php';
	include_once 'controller/GroupModule.Controller.php';
	include_once 'controller/StudentDt.Controller.php';
	include_once 'controller/CumulativeTest.Controller.php';
	include_once 'controller/StudentCt.Controller.php';

	$studentid 		= $_GET['user_id'];
	$userid 		= $user->getUserid();

	$uc 			= new UserController();
	$student 		= $uc->GetUser($studentid);
	
	$sgc			= new StudentGroupController();
	$gid 			= $sgc->getGroupOfUser($studentid);
	
	$gmc			= new GroupModuleController();
	$sdt			= new StudentDtController();
	
	$mc 			= new ModuleController();
	$modules 		= $mc->getAllModules();
		
	$tmc 			= new TeacherModuleController();
	$tm_set 		= $tmc->getTeacherModule($userid);
	
	$smc			= new StudentModuleController();
	$studentmodule 	= $smc->loadAllStudentModule($studentid);

	$ctc			= new CumulativeTestController();
	$sct 			= new StudentCtController();
?>
<div id="container">
	<!-- <a class="link" href="manage-student-accounts.php">&laquo <?php echo _("Go Back"); ?></a>
	<br><br> -->
	<center>
	<h2><?php echo _("Student Portfolio"); ?></h2>
	<br>
	<h2><?php echo _("Student Name: "); ?><?php echo $student->getFirstname() . ' ' . $student->getLastname(); ?></h2>
	<br>
	<h3><?php echo _("Cumulative Tests"); ?></h3>
	<table border="0" class="result morepad">
		<tr>
			<th><?php echo _("Test Name"); ?></td>
			<th><?php echo _("Action"); ?></td>
		<tr>
		<?php
			$ct_set 	= $ctc->getCumulativeTests($userid);
			$sct_set	= $sct->getCtByStudent($studentid);

			if($ct_set) {
			foreach($ct_set as $ct) {
		?>
			<tr>
				<td><?php echo $ct['test_name']; ?></td>
		<?php
				$disabled3 = "<td><a class=\"button1 disabled\">" . _("View") . "</a></td>";

				if($sct_set) {
					$found = false;

					foreach($sct_set as $studentct) {
						if($ct['ct_id'] == $studentct['ct_id'] && $studentct['date_ended'] != '0000-00-00 00:00:00') { 
							$found = true;
		?>
							<td><a class="button1" href="ct-results.php?sctid=<?php echo $studentct['student_ct_id']; ?>&p=1"><?php echo _("View"); ?></a></td>
		<?php
						}
					}

					if(!$found) echo $disabled3;
				} else {
					echo $disabled3;
				}
		?>
				
			</tr>
		<?php 
				} 
			} else { ?>
				<tr>
					<td colspan="2"><center><?php echo _("No cumulative tests yet."); ?></center></td>
				</tr>
		<?	} ?>
	</table>
	</center>
	<br>
	<center>
	<h3><?php echo _("Review"); ?></h3>
	<table border="0" class="result morepad">
		<tr>
			<th class="bold"><?php echo _("Module"); ?></th>
			<th class="bold"><?php echo _("Portfolio"); ?></th>
			<th class="bold" colspan="2"><?php echo _("Diagnostic Tests"); ?></th>
		</tr>
		<?php 
			foreach($modules as $module): 
				foreach($tm_set as $tm):
					if($module['module_ID'] == $tm['module_id']):
		?>
		<tr>
			<td>
				<?php echo _($module['module_name']); ?>
			</td>
			<td>
				<?php
					$found = false; 
					foreach($studentmodule as $sm) {
						if($tm['module_id'] == $sm['module_ID'] && $sm['date_finished'] != '0000-00-00 00:00:00') { 
							$found = true;
					?>
							<center>
							<a class="button1" href="module-results.php?mid=<?php echo $tm['module_id']; ?>&sid=<?php echo $studentid; ?>">
								<?php echo _("View"); ?>
							</a>
							</center>
				<?php 	}
					}

					if(!$found) { ?>
						<center><a class="button1 disabled"><?php echo _("View"); ?></a></center>
				<?php } ?>
			</td>
			<td>
				<?php
					$disabled = "<a class=\"button1 disabled\">"._("Pre-Test")."</a>";
					$disabled2 = "<a class=\"button1 disabled m-left5\">"._("Post-Test")."</a>";

					if($gid) {
						$gm_set	= $gmc->getModuleGroupByID($gid, $module['module_ID']);

						if($gm_set) {
							$sdt_set = $sdt->getSDTbyStudent($studentid, $gm_set[0]['pretest_id']);

							if($sdt_set) {
								$enddate = $sdt_set->getEndDate();

								if($enddate != "0000-00-00 00:00:00" || $enddate != "null") {
									echo "<a class=\"button1\" href=\"dt-results.php?sdtid={$sdt_set->getStudentDtID()}&p=1\">"
										 ._("Pre-Test").
										 "</a>";
								} else {
									echo $disabled;
								}
							} else {
								echo $disabled;
							}
						} else {
							echo $disabled;
						}
					} else {
						echo $disabled;
					}
					
					if($gid) {
						$gm_set	= $gmc->getModuleGroupByID($gid, $module['module_ID']);

						if($gm_set) {
							$sdt_set = $sdt->getSDTbyStudent($studentid, $gm_set[0]['posttest_id']);

							if($sdt_set) {
								$enddate = $sdt_set->getEndDate();

								if($enddate != "0000-00-00 00:00:00" || $enddate != "null") {
									echo "<a class=\"button1 m-left5\" href=\"dt-results.php?sdtid={$sdt_set->getStudentDtID()}&p=1\">"
										 ._("Post-Test").
										 "</a>";
								} else {
									echo $disabled2;
								}
							} else {
								echo $disabled2;
							}
						} else {
							echo $disabled2;
						}
					} else {
						echo $disabled2;
					}
					
					

					
				?>
			</td>
		</tr>
		<?php 
					endif;
				endforeach;
			endforeach;
		?>
	</table>
	</center>

	
</div>
<?php require_once "footer.php"; ?>
