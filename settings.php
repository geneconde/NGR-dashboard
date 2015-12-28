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
	$testsA		= $dtc->getTotalDiagnosticTest($userid, $mid, 1);
	$testsB		= $dtc->getTotalDiagnosticTest($userid, $mid, 2);

	$sgc		= new StudentGroupController();
	$groups		= $sgc->getActiveGroups($userid);
	
	$gmc 		= new GroupModuleController();
	
	$sdc		= new StudentDtController();
	
	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";
?>
<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="teacher.php">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="wrap">
	<h1><?php echo _($module_set->getModule_name()); ?></h1>
	<p class="dash-message"><?php echo _("This is the Module Settings page. On this page, you can activate this module on groups as well as create, assign, activate and deactivate pre-dianostic tests and post-diagnostic tests."); ?></p>
	<br>

	<div class="fleft dotted-border">
		<button class="btn-portfilter active" data-toggle="portfilter" data-target="<?php echo _('Group Activation'); ?>"><?php echo _('Group Activation'); ?></button>
		<button class="btn-portfilter" data-toggle="portfilter" data-target="<?php echo _('Pre-diagnostic tests'); ?>"><?php echo _('Pre-diagnostic tests'); ?></button>
		<button class="btn-portfilter" data-toggle="portfilter" data-target="<?php echo _('Post-diagnostic tests'); ?>"><?php echo _('Post-diagnostic tests'); ?></button>
	</div>

	<div class="clear"></div>

	<ul class="thumbnails gallery module-settings">
		<li class="clearfix settings-group" data-tag='<?php echo _("Group Activation"); ?>'>
			<h2><?php echo _("Group Activation"); ?></h2>
			<div class="search-container">
				<input type="text" class="search" id="search-table" placeholder="<?php echo _('Search...'); ?>">
				<span><?php echo _('Type group names and test names. You can also filter by typing "Module Inactive", "Pre-test Active" or "Post-test Inactive".'); ?></span>
			</div>
			<table border="0" class="result morepad" id="group-table">
				<thead>
				<tr>
					<th class="bold" id="group"><?php echo _("Group Name"); ?></th>
					<th class="bold"><?php echo _("Module Status"); ?></th>
					<th class="bold"><?php echo _("Pre-test"); ?></th>
					<th class="bold"><?php echo _("Post-test"); ?></th>
					<th class="bold"><?php echo _("Action"); ?></th>
				</tr>
				</thead>
				<tbody>
			<?php
				if($groups):

				foreach($groups as $group):
					$gm = $gmc->getModuleGroupByID($group['group_id'], $mid); ?>
				<tr>
					<td>
						<a class="link-group" href="student-accounts.php"><?php echo $group['group_name']; ?></a>
					</td>
					<td class="ta-center">
						<div class="fleft status-buttons">
							<div class="<?php echo ($gm && $gm[0]['review_active'] ? 'status-active' : 'status-inactive'); ?>"><?php echo ($gm && $gm[0]['review_active'] ? _('Module Active') : _('Module Inactive')); ?></div>
						</div>
					</td>
					<td>
						<div class="fleft status-buttons">
							<div class="<?php echo ($gm && $gm[0]['pre_active'] ? 'status-active' : 'status-inactive'); ?>"><?php echo ($gm && $gm[0]['pre_active'] ? _('Pre-Test Active') : _('Pre-Test Inactive')); ?></div>
						</div>
					</td>
					<td>
						<div class="fleft status-buttons">
							<div class="<?php echo ($gm && $gm[0]['post_active'] ? 'status-active' : 'status-inactive'); ?>"><?php echo ($gm && $gm[0]['post_active'] ? _('Post-Test Active') : _('Post-Test Inactive')); ?></div>
						</div>
					</td>
					<td>
						<?php $action = ($gm ? "edit" : "set"); ?>
						<a id="edit" class="button1 cool-btn" href="edit-group-module.php?module_id=<?php echo $mid; ?>&group_id=<?php echo $group['group_id']; ?>&action=<?php echo $action; ?>">
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
				</tbody>
			</table>
		</li>

		<li class="clearfix settings-pre" data-tag='<?php echo _("Pre-diagnostic tests"); ?>'>
			<h2><?php echo _("Pre-Diagnostic Tests"); ?></h2>
			<a class="button1 create-test-btn" href="dt-item.php?module_id=<?php echo $mid; ?>&mode=pre&action=new"><?php echo _("Create Pre-Diagnostic Test"); ?></a>
			<div class="search-container">
				<input type="text" class="search pre-test-search" id="search-table" placeholder="<?php echo _('Search...'); ?>">
			</div>
			<table border="0" class="result morepad">
				<thead>
					<tr>
						<th class="bold" id="pre-diag"><?php echo _("Test Title"); ?></th>
						<th class="bold"><?php echo _("# of Questions"); ?></th>
						<th class="bold"><?php echo _("Action"); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if($testsA): ?>
						<?php foreach($testsA as $test): ?>
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
							<a class="button1 pre-link cool-btn" href="dt-item.php?dtid=<?php echo $test['dt_id']; ?>&action=edit" data-id="<?php echo $test['dt_id']; ?>">
								<span>
									<i class="fa fa-pencil-square-o"></i>
									<!-- <?php echo _("Edit"); ?> -->
								</span>
							</a>
							<a class="button1 danger-btn" href="delete-dt.php?dtid=<?php echo $test['dt_id']; ?>&module_id=<?php echo $mid; ?>&mode=pre">
								<span>
									<i class="fa fa-trash-o"></i>
									<!-- <?php echo _("Delete"); ?> -->
								</span>
							</a>
						</td>
					</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="3"><center><?php echo _("You have not created any tests yet."); ?></center></td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</li>

		<li class="clearfix settings-post" data-tag='<?php echo _("Post-diagnostic tests"); ?>'>
			<h2><?php echo _("Post-Diagnostic Tests"); ?></h2>
			<a class="button1 create-test-btn" href="dt-item.php?module_id=<?php echo $mid; ?>&mode=post&action=new"><?php echo _("Create Post-Diagnostic Test"); ?></a>
			<div class="search-container">
				<input type="text" class="search pre-test-search" id="search-table" placeholder="<?php echo _('Search...'); ?>">
			</div>
			<table border="0" class="result morepad">
				<thead>
					<tr>
						<th class="bold"  id="post-test"><?php echo _("Test Title"); ?></th>
						<th class="bold"><?php echo _("# of Questions"); ?></th>
						<th class="bold"><?php echo _("Action"); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if($testsB): ?>
						<?php foreach($testsB as $test): ?>
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
							<a class="button1 post-link cool-btn" href="dt-item.php?dtid=<?php echo $test['dt_id']; ?>&action=edit" data-id="<?php echo $test['dt_id']; ?>">
								<span>
									<i class="fa fa-pencil-square-o"></i>
									<!-- <?php echo _("Edit"); ?> -->
								</span>
							</a>
							<a class="button1 danger-btn" href="delete-dt.php?dtid=<?php echo $test['dt_id']; ?>&module_id=<?php echo $mid; ?>&mode=pre">
								<span>
									<i class="fa fa-trash-o"></i>
									<!-- <?php echo _("Delete"); ?> -->
								</span>
							</a>
						</td>
					</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="3"><center><?php echo _("You have not created any tests yet."); ?></center></td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</li>
		<br>
		<?php if ($user->getType() == 4) { ?>
			<a class="button1" href="add-dt-question.php?module_id=<?php echo $mid; ?>&f=0"><?php echo _("Add questions to this module"); ?></a>
		<?php } ?>
	</ul>
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

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_left" data-tourtarget="#group">
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
  </li>
  <li class="tlypageguide_right" data-tourtarget="#edit">
    <p><?php echo _("Click this button to <strong>Set</strong> or <strong>Edit</strong> the settings of the module, pre-diagnostic test and post-diagnostic test for a group."); ?></p>
  </li>
  <li class="tlypageguide_left" data-tourtarget="#pre-diag">
    <p><?php echo _("This table shows the available pre-diagnostic tests for this module that you have created. You can create several pre-diagnostic tests so that you can create different tests for different student groups. The table also shows the number of questions included in the test. Please note that each student (or student group) can take only one pre-diagnostic test."); ?></p>
    <p><?php echo _("You can click the <strong>Edit</strong> or <strong>Delete</strong> button (in the Action column) to update or delete a test. Please note that if you delete a test and students have already taken it, the data of the students will be deleted as well."); ?></p>
    <p><?php echo _("To create a pre-diagnostic test, click the <strong>Create Pre-Diagnostic Test</strong> button."); ?></p>
  </li>
  <li class="tlypageguide_left" data-tourtarget="#post-test">
    <p><?php echo _("This table shows the available post-diagnostic tests for this module that you have created. You can create several post-diagnostic tests so that you can create different tests for different student groups. The table also shows the number of questions included in the test. Please note that each student (or student group) can take only one post-diagnostic test."); ?></p>
	<p><?php echo _("You can click the <strong>Edit</strong> or <strong>Delete</strong> button (in the Action column) to update or delete a test. Please note that if you delete a test and students have already taken it, the data of the students will be deleted as well."); ?></p>
	<p><?php echo _("To create a post-diagnostic test, click the <strong>Create Post-Diagnostic Test</strong> button."); ?></p>
  </li>
</ul>

<script>
	$('.btn-portfilter').click(function () {
		$('.btn-portfilter').removeClass('active');
		$(this).addClass('active');

		$('#tlyPageGuideWrapper #tlyPageGuideMessages .tlypageguide_close').trigger('click');
	});

	$(".search").keyup(function(){
        _this = this;
        $.each($("table tbody").find("tr"), function() {
            console.log($(this).text());
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) == -1)
                $(this).hide();
            else
                $(this).show();                
        });
    });
</script>
<script src="scripts/bootstrap-portfilter.min.js"></script>
<?php require_once "footer.php"; ?>