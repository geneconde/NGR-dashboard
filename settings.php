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
<a class="link" href="teacher.php">&laquo <?php echo _("Go Back to Dashboard"); ?></a>
<h1><?php echo _($module_set->getModule_name()); ?></h1>
<center>
<h2><?php echo _("Groups"); ?></h2>
<table border="0" class="result morepad">
	<tr>
		<th class="bold"><?php echo _("Group"); ?></th>
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
			<a class="button1" href="edit-group-module.php?module_id=<?php echo $mid; ?>&group_id=<?php echo $group['group_id']; ?>&action=<?php echo $action; ?>">
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
<h2><?php echo _("Pre-Diagnostic Tests"); ?></h2>
<table border="0" class="result morepad">
	<tr>
		<th class="bold"><?php echo _("Test Title"); ?></th>
		<th class="bold"><?php echo _("# of Questions"); ?></th>
		<th class="bold"><?php echo _("Action"); ?></th>
	</tr>
	<?php 
		if($tests):

			foreach($tests as $test):
				if($test['mode'] == 1):
	?>
	<tr>
		<td><?php echo $test['test_name']; ?></td>
		<td>
			<center>
			<?php
				$count = count(explode(',',$test['qid']));
				echo $count;
			?>
			</center>
		</td>
		<td>
			<a class="button1 pre-link" href="edit-dt.php?dtid=<?php echo $test['dt_id']; ?>&action=edit" data-id="<?php echo $test['dt_id']; ?>">
			<?php echo _("Edit"); ?>
			</a>
			<a class="button1 dt-del" href="delete-dt.php?dtid=<?php echo $test['dt_id']; ?>&module_id=<?php echo $mid; ?>&mode=pre">
			<?php echo _("Delete"); ?>
			</a>
		</td>
	</tr>
	<?php 
				endif;
			endforeach;
		else:
	?>
		<tr>
			<td colspan="3"><center><?php echo _("You have not created any tests yet."); ?></center></td>
		</tr>
	<?php endif; ?>
</table>
<a class="button1" href="edit-dt.php?module_id=<?php echo $mid; ?>&mode=pre&action=new"><?php echo _("Create Pre-Diagnostic Test"); ?></a>
<div class="clear"></div>
<br>

<h2><?php echo _("Post-Diagnostic Tests"); ?></h2>
<table border="0" class="result morepad">
	<tr>
		<th class="bold"><?php echo _("Test Title"); ?></th>
		<th class="bold"><?php echo _("# of Questions"); ?></th>
		<th class="bold"><?php echo _("Action"); ?></th>
	</tr>
	<?php 
		if($tests):
		
			foreach($tests as $test):
				if($test['mode'] == 2):
	?>
	<tr>
		<td><?php echo $test['test_name']; ?></td>
		<td>
			<center>
			<?php
				$count = count(explode(',',$test['qid']));
				echo $count;
			?>
			</center>
		</td>
		<td>
			<a class="button1 post-link" href="edit-dt.php?dtid=<?php echo $test['dt_id']; ?>&action=edit" data-id="<?php echo $test['dt_id']; ?>">
			<?php echo _("Edit"); ?>
			</a>
			<a class="button1 dt-del" href="delete-dt.php?dtid=<?php echo $test['dt_id']; ?>&module_id=<?php echo $mid; ?>&mode=pre">
			<?php echo _("Delete"); ?>
			</a>
		</td>
	</tr>
	<?php 
				endif;
			endforeach;
		else:
	?>
		<tr>
			<td colspan="3"><center><?php echo _("You have not created any tests yet."); ?></center></td>
		</tr>
	<?php endif; ?>
</table>
<a class="button1" href="edit-dt.php?module_id=<?php echo $mid; ?>&mode=post&action=new"><?php echo _("Create Post-Diagnostic Test"); ?></a>
<div class="clear"></div>
<br>
<?php if ($user->getType() == 4) { ?>
	<a class="button1" href="add-dt-question.php?module_id=<?php echo $mid; ?>&f=0"><?php echo _("Add questions to this module"); ?></a>
<?php } ?>
</center>
<div class="clear"></div>
</div>
<script>
$(document).ready(function() {
	$('.dt-del').click(function(e) {
		if(window.confirm("<?php echo _('Deleting this test will also delete all records of students who have taken this test. Are you sure you want to delete this diagnostic test?'); ?>")){
            window.location.href = $(this).attr('href');
        } else {
            e.preventDefault();
        }
	});
	
	$('.pre-link, .post-link').click(function(e) {
		var redirect = ($(this).attr('href'));
		var id = $(this).data('id');
		var check;

		e.preventDefault();
		
		$.ajax({
			type	: "POST",
			url		: "check-dt-test.php",
			data	: {	dtid: id },
			success	: function(data) {
				
				if(data == 1) {
					if(window.confirm("<?php echo _('There are student records that are tied to this test. Editing this test would delete those student records. Are you sure you want to edit?'); ?>")){
						$.ajax({
							type	: "POST",
							url		: "delete-dt-records.php",
							data	: {	dtid: id }
						});
						
						window.location.href = redirect;
					}
				} else window.location.href = redirect;
			}
		});
	});
});
</script>
<?php require_once "footer.php"; ?>