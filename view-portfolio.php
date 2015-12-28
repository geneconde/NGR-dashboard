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
<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
	</div>
</div>

<div id="content">
<div class="wrap">
	<br>
	<h2><?php echo _("Student Portfolio of ") . $student->getFirstname() . ' ' . $student->getLastname();; ?></h2>
	<p><?php echo _("This page shows all tests and modules taken by the student."); ?></p>
	<br>
	<h3><?php echo _("Cumulative Tests"); ?></h3>
	<table border="0" class="result morepad">
		<tr>
			<th><?php echo _("Test Name"); ?></th>
			<th><?php echo _("Action"); ?></th>
		</tr>
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
								<td><a id="btnCumulative" class="button1" href="ct-results.php?sctid=<?php echo $studentct['student_ct_id']; ?>&p=1"><?php echo _("View"); ?></a></td>
					<?php
							}
						}
						if(!$found) { echo $disabled3; }

					} else {
						echo $disabled3;
					}
					?>

				</tr>
		<?php 	}
			} else { ?>
				<tr>
					<td colspan="2"><center><?php echo _("No cumulative tests yet."); ?></center></td>
				</tr>
		<?php } ?>
	</table>
	<br/>
	<h3><?php echo _("Module"); ?></h3>
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
							<a id="btnMQ" class="button1" href="module-results.php?mid=<?php echo $tm['module_id']; ?>&sid=<?php echo $studentid; ?>"><?php echo _("View"); ?></a>
							</center>
				<?php 	}
					}

					if(!$found) { ?>
						<center><a id="btnMQ" class="button1 disabled"><?php echo _("View"); ?></a></center>
				<?php } ?>
			</td>
			<td>
				<?php
					$disabled = "<a id='btnPreT' class=\"button1 disabled\">"._("Pre-Test")."</a>";
					$disabled2 = "<a id='btnPostT' class=\"button1 disabled m-left5\">"._("Post-Test")."</a>";

					if($gid) {
						$gm_set	= $gmc->getModuleGroupByID($gid, $module['module_ID']);

						if($gm_set) {
							$sdt_set = $sdt->getSDTbyStudent($studentid, $gm_set[0]['pretest_id']);

							if($sdt_set) {
								$enddate = $sdt_set->getEndDate();

								if($enddate != "0000-00-00 00:00:00" || $enddate != "null") {
									echo "<a id='btnPreT' class=\"button1\" href=\"dt-results.php?sdtid={$sdt_set->getStudentDtID()}&p=1\">"._("Pre-Test")."</a>";
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
									echo "<a id='btnPostT' class=\"button1 m-left5\" href=\"dt-results.php?sdtid={$sdt_set->getStudentDtID()}&p=1\">"._("Post-Test")."</a>";
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
	
</div>

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_top" data-tourtarget="#btnCumulative">
    <p><?php echo _("Clicking this button will show the Cumulative Test result of the student. This is grayed out if the student hasn't taken the test yet."); ?></p>
  </li>
  <li class="tlypageguide_top" data-tourtarget="#btnMQ">
    <p><?php echo _("Click this button to view the screenshots of all the Quick Checks and Quiz Questions in the module, the student's answer, the correct answer and the feedback statements. This is grayed out if the student hasn't taken the module yet."); ?></p>
  </li>
  <li class="tlypageguide_top" data-tourtarget="#btnPreT">
    <p><?php echo _("This will show the Pre-Diagnostic Test result of the student. This is grayed out if the student hasn't taken the test yet."); ?></p>
  </li>
  <li class="tlypageguide_top" data-tourtarget="#btnPostT">
    <p><?php echo _("This will show the Post-Diagnostic Test result of the student. This is grayed out if the student hasn't taken the test yet."); ?></p>
  </li>
</ul>

<?php require_once "footer.php"; ?>