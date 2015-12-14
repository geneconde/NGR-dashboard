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
			<td><a id="ct-del" href="ct-results.php?from=1&sctid=<?php echo $test['student_ct_id']; ?>" class="link"><?php echo $ct['test_name']; ?></a></td>
		</tr>
		<?php 
				endif;
			endforeach; 
		endforeach; 
	?>
	</table>
	</center>
</div>
	<!-- Tip Content -->
	<ol id="joyRideTipContent">
		<li data-id="ct-del" data-text="Close" data-options="tipLocation:top;tipAnimation:fade">
			<p>Click this to view the cumulative test result.</p>
		</li>
	</ol>
	<script>
	  function guide() {
	  	$('#joyRideTipContent').joyride({
	      autoStart : true,
	      postStepCallback : function (index, tip) {
	      if (index == 1) {
	        $(this).joyride('set_li', false, 1);
	      }
	    },
	    // modal:true,
	    // expose: true
	    });
	  }
	</script>
<?php require_once "footer.php"; ?>