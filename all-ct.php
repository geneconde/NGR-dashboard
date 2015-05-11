<?php
	require_once 'session.php';	
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/CumulativeTest.Controller.php';
	
	$userid 	= $user->getUserid();
	
	$ctc		= new CumulativeTestController();
	$ct_set		= $ctc->getCumulativeTests($userid);
?>
<div id="container">
<a class="link" href="teacher.php">&laquo <?php echo _("Go Back to Dashboard"); ?></a>
<center>
<br>
<h2><?php echo _("Cumulative Tests"); ?></h2>
<table border="0" class="result morepad">
	<tr>
		<th><?php echo _('Test Name'); ?></th>
		<th><?php echo _('Results'); ?></th>
	</tr>
	<?php 
	if($ct_set):
		foreach($ct_set as $ct): ?>
			<tr>
				<td><?php echo $ct['test_name']; ?></td>
				<td>
					<a class="button1 ct-del" href="all-students-ct-results.php?ctid=<?php echo $ct['ct_id']; ?>">
						<?php echo _("View Results"); ?>
					</a>
				</td>
			</tr>
	<?php 
		endforeach;
	else:
	?>
	<tr>
		<td colspan="2"><?php echo _('No Cumulative Tests.'); ?></td>
	<tr>
	<?php endif; ?>
</table>
</center>
</div>