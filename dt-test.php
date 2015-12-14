<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/Language.Controller.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	
	$userid = $user->getUserid();

	$tmc = new TeacherModuleController();
	$tm_set = $tmc->getTeacherModule($userid);
	
	$mc = new ModuleController();
	$dtc = new DiagnosticTestController();
?>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = 'diagnostic-test'; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="teacher.php">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">

<div class="dt-test wrap">
	<h1><?php echo _('Diagnostic Test'); ?></h1>
	<table class='outer-table'>
		<?php $modules = $mc->getAllModules(); ?>
		<?php foreach($modules as $module): ?>
			<?php foreach($tm_set as $sm): ?>
				<?php if($module['module_ID'] == $sm['module_id']): ?>
				<tr class="m-name">
					<td colspan='2'><h2><?php echo _($module['module_name']); ?></h2></td>
				</tr>
				<tr>
					<th class="dt-header"><?php echo _('Pre-Diagnostic Test'); ?></th>
					<th class="dt-header"><?php echo _('Post-Diagnostic Test'); ?></th>
				</tr>
				<tr class='test-container'>
					<?php $pre = $dtc->getTotalDiagnosticTest($userid, $module['module_ID'], 1); ?>
					<?php $post = $dtc->getTotalDiagnosticTest($userid, $module['module_ID'], 2); ?>
					<td>
						<table class="inner-table">
						<?php if(!empty($pre)) { ?>
							<?php foreach ($pre as $test) : ?>
								<tr>
									<td class='test-name'><?php echo $test['test_name']; ?></td>
									<td><?php echo "<a class='button1' href='dt-item.php?dtid=".$test['dt_id']."&action=edit' class='action-dt'>"._('Edit')."</a>"."<a class='button1' href='delete-dt.php?dtid=".$test['dt_id']."&module_id=".$module['module_ID']."&mode=pre' class='action-dt'>"._('Delete')."</a>"; ?>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php } else { ?>
							<tr><td class='test-note' colspan='2'><?php echo _('You have not created any pre-test yet.'); ?></td></tr>
						<?php } ?>
						</table>
					</td>

					<td>
						<table class="inner-table">
						<?php if(!empty($post)) { ?>
							<?php foreach ($post as $test) : ?>
								<tr>
									<td class='test-name'><?php echo $test['test_name']; ?></td>
									<td>
										<?php echo "<a class='button1' href='dt-item.php?dtid=".$test['dt_id']."&action=edit' class='action-dt'>"._('Edit')."</a>"."<a class='button1' href='delete-dt.php?dtid=".$test['dt_id']."&module_id=".$module['module_ID']."&mode=post' class='action-dt'>"._('Delete')."</a>"; ?>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php } else { ?>
							<tr><td class='test-note' colspan='2'><?php echo _('You have not created any post-test yet.'); ?></td></tr>
						<?php } ?>
						</table>
					</td>
				</tr>
				<tr class='create-act'>
					<td><a href="dt-item.php?module_id=<?php echo $module['module_ID']; ?>&mode=pre&action=new" class=" button1 create-dt"><?php echo _('Create Pre-Diagnostic Test'); ?></a></td>
					<td><a href="dt-item.php?module_id=<?php echo $module['module_ID']; ?>&mode=post&action=new" class=" button1 create-dt"><?php echo _('Create Post-Diagnostic Test'); ?></a></td>
				</tr>
				<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</table>
</div>
<?php include "footer.php"; ?>