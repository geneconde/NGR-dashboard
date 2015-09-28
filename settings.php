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
<style>
	.joyride-tip-guide { width: 22%; }
	.joyride-tip-guide:nth-child(8) .joyride-content-wrapper {
    	margin-top: -174px !important;
	}
</style>
<div id="container">
<a class="link" href="teacher.php">&laquo <?php echo _("Go Back to Dashboard"); ?></a>
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
<h2><?php echo _("Pre-Diagnostic Tests"); ?></h2>
<table border="0" class="result morepad">
	<tr>
		<th class="bold" id="pre-diag"><?php echo _("Test Title"); ?></th>
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
		<th class="bold"  id="post-test"><?php echo _("Test Title"); ?></th>
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
<!-- Tip Content -->
<ol id="joyRideTipContent">
	<li data-id="group" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:left;tipAnimation:fade">
		<p><?php echo _("In this page, you can initiate actions to activate/deactivate the module, as well as the pre and post diagnostic tests, for a group. The columns are defined as follows:"); ?></p>
		<ul style="padding-left: 20px; font-size: 14px;">
			<li><?php echo _("Group - student group's name"); ?></li>
			<li><?php echo _("Module Status - indicates whether a module is active or not"); ?></li>
			<li><?php echo _("Pre-test - specifies the title of the pre-diagnostic test assigned to this group"); ?></li>
			<li><?php echo _("Active? - indicates whether the pre-diagnostic test is active or not"); ?></li>
			<li><?php echo _("Post-test - specifies the title of the post-diagnostic test assigned to this group"); ?></li>
			<li><?php echo _("Active? - indicates whether the post-diagnostic test is active or not"); ?></li>
			<li><?php echo _("Action - shows either <strong>Set</strong> or <strong>Edit</strong> button to activate/deactivate the module, pre-test and post-test. You can also set the time limit for both tests."); ?></li>
		</ul>
		<p></p>
	</li>
	<li data-id="edit" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("Click this button to <strong>Set</strong> or <strong>Edit</strong> the settings of the module, pre-diagnostic test and post-diagnostic test for a group."); ?></p>
	</li>
	<li data-id="pre-diag" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:left;tipAnimation:fade">
		<p><?php echo _("This table shows the available pre-diagnostic tests for this module that you have created. You can create several pre-diagnostic tests so that you can create different tests for different student groups. The table also shows the number of questions included in the test. Please note that each student (or student group) can take only one pre-diagnostic test."); ?></p>
		<p><?php echo _("You can click the <strong>Edit</strong> or <strong>Delete</strong> button (in the Action column) to update or delete a test. Please note that if you delete a test and students have already taken it, the data of the students will be deleted as well."); ?></p>
		<p><?php echo _("To create a pre-diagnostic test, click the <strong>Create Pre-Diagnostic Test</strong> button."); ?></p>
	</li>
	<li data-id="post-test" 		data-text="<?php echo _('Close'); ?>" data-options="tipLocation:left;tipAnimation:fade">
		<p><?php echo _("This table shows the available post-diagnostic tests for this module that you have created. You can create several post-diagnostic tests so that you can create different tests for different student groups. The table also shows the number of questions included in the test. Please note that each student (or student group) can take only one post-diagnostic test."); ?></p>
		<p><?php echo _("You can click the <strong>Edit</strong> or <strong>Delete</strong> button (in the Action column) to update or delete a test. Please note that if you delete a test and students have already taken it, the data of the students will be deleted as well."); ?></p>
		<p><?php echo _("To create a post-diagnostic test, click the <strong>Create Post-Diagnostic Test</strong> button."); ?></p>
	</li>
</ol>
<script>
  	function guide() {
	  	$('#joyRideTipContent').joyride({
	      autoStart : true,
	      postStepCallback : function (index, tip) {
	      if (index == 10) {
	        $(this).joyride('set_li', false, 1);
	      }
	    },
	    'template' : {
	        'link'    : '<a href="#close" class="joyride-close-tip"><?php echo _("Close"); ?></a>'
	      }
	    });
  	}
</script>
<?php require_once "footer.php"; ?>