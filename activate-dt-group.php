<?php
	require_once 'session.php';	
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/User.Controller.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/StudentGroup.Controller.php';
	include_once 'controller/GroupModule.Controller.php';
	include_once 'controller/StudentDt.Controller.php';
	
	$mid 		= $_GET['mid'];
	$userid 	= $user->getUserid();

	$mc			= new ModuleController();
	$module_set	= $mc->loadModule($mid);
	
	$dtc		= new DiagnosticTestController();
	$tests		= $dtc->getAllModuleTestsByTeacher($mid, $userid);

	$sgc		= new StudentGroupController();
	$groups		= $sgc->getActiveGroups($userid);
	
	$gmc 		= new GroupModuleController();
	
	$sdc		= new StudentDtController();

	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";
?>
<div id="container">
<a class="link back" href="dt-test.php">&laquo <?php echo _("Go Back"); ?></a>
<h1><?php echo _($module_set->getModule_name()); ?></h1>
<center>
<h2><?php echo _("Groups"); ?></h2>
<table border="0" class="result morepad">
	<tr>
		<th class="bold" id="group"><?php echo _("Group"); ?></th>
		<th class="bold"><?php echo _("Module Status"); ?></th>
		<th class="bold"><?php echo _("Pre-test"); ?></th>
		<th class="bold"><?php echo _("Active?"); ?></th>
		<th class="bold"><?php echo _("Post-test"); ?></th>
		<th class="bold"><?php echo _("Active?"); ?></th>
		<th class="bold"><?php echo _("Action"); ?></th>
	</tr>
<?php
	if($groups):

	foreach($groups as $group):
		$gm = $gmc->getModuleGroupByID($group['group_id'], $mid); ?>
	<tr>
		<td>
			<a class="link" href="student-accounts.php"><?php echo $group['group_name']; ?></a>
		</td>
		<td class="ta-center">
			<?php if($gm && $gm[0]['review_active']) :?>
				<span class="green"><?php echo _("Active"); ?></span>
			<?php else: ?>
				<span class="red"><?php echo _("Not Active"); ?></span>
			<?php endif; ?>
		</td>
		<td>
			<center>
			<?php 
				if($gm):
					$pt = $dtc->getDiagnosticTestByID($gm[0]['pretest_id']);
					if($pt) echo $pt->getTestName();
					else echo _("N/A");
				else:
					echo _("N/A");
				endif;
			?>
			</center>
		</td>
		<td>
			<center>
			<?php if($gm && $gm[0]['pre_active']): ?>
				<span class="green"><?php echo _("Yes"); ?></span>
			<?php else: ?>
				<span class="red"><?php echo _("No"); ?></span>
			<?php endif; ?>
			</center>
		</td>
		<td>
			<center>
			<?php
				if($gm):
					$pt = $dtc->getDiagnosticTestByID($gm[0]['posttest_id']); 
					if($pt) echo $pt->getTestName();
					else echo _("N/A");
				else:
					echo _("N/A");
				endif;
			?>
			</center>
		</td>
		<td>
			<center>
			<?php if($gm && $gm[0]['post_active']): ?>
				<span class="green"><?php echo _("Yes"); ?></span>
			<?php else: ?>
				<span class="red"><?php echo _("No"); ?></span>
			<?php endif; ?>
			</center>
		</td>
		<td>
			<?php $action = ($gm ? "edit" : "set"); ?>
			<a id="edit" class="button1" href="edit-group-module.php?module_id=<?php echo $mid; ?>&group_id=<?php echo $group['group_id']; ?>&action=<?php echo $action; ?>">
				<?php 
					if($gm) echo _("Edit");
					else echo _("Set");
				?>
			</a>
		</td>
	</tr>
<?php 
		endforeach;
	else:
?>
	<tr>
		<td colspan="7"><center><?php echo _("You have not created any groups yet."); ?></center></td>
	</tr>
<?php
	endif;
?>
</table>
</div>
<?php require_once "footer.php"; ?>