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
<br>
<div id="container">
<a class="link" href="student.php">&laquo <?php echo _("Go Back to Dashboard"); ?></a>
<center>
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


			<td><a href="ct-results.php?from=1&sctid=<?php echo $test['student_ct_id']; ?>" class="link"><?php echo $ct['test_name']; ?></a></td>

	</tr>
	<?php 
			endif;
		endforeach; 
	endforeach; 
?>
</table>
</center>