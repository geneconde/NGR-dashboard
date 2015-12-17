<?php
	require_once 'session.php';	
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'controller/StudentCt.Controller.php';
	require_once 'controller/CumulativeTest.Controller.php';

	$userid	= $user->getUserid();
	$teacherid = $user->getTeacher();

	$scc = new StudentCtController(); 
	$sct_set = $scc->getCtByStudent($userid);

	$ctc = new CumulativeTestController();
	$ct_set = $ctc->getCumulativeTests($teacherid);
?>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="student.php">&laquo <?php echo _("Go Back to Dashboard"); ?></a>
	</div>
</div>

<div id="content">
<div class='wrap'>
	<br><br>
	<h2><?php echo _("Cumulative Test Results"); ?></h2>
	<br>
	<table border="0" class="result morepad">
		<tr>
			<th><?php echo _("Cumulative Tests"); ?></th>
		</tr>
		<?php 
		foreach($ct_set as $ct) :
			foreach($sct_set as $test) :
				
				if($ct['ct_id'] == $test['ct_id']) :
	?>
		<tr>
			<td><a id="ct-del" href="ct-results.php?from=1&sctid=<?php echo $test['student_ct_id']; ?>" class="link"><?php echo $ct['test_name']; ?></a></td>
		</tr>
		<?php 
				endif;
			endforeach; 
		endforeach; 
	?>
	</table>
</div>

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_right" data-tourtarget="#ct-del">
    <p><?php echo _("Click this to view the cumulative test result."); ?></p>
  </li>
</ul>

<?php require_once "footer.php"; ?>