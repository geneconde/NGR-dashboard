<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	require_once 'header.php';
	
	$sctid		= $_GET['sctid'];
	$ctid 		= $_GET['ctid'];
	$index		= $_GET['i'] - 1;
?>	
<div id="container">
	<div id="confirm-box">
		<div>
			<p><?php echo _('You are about to submit this test. You can still go back and check your answer. Do you really want to submit this test?'); ?></p>
			<a href="ct-results.php?sctid=<?php echo $sctid; ?>" class="button1">Submit</a>
			<a href="ct.php?ctid=<?php echo $ctid ?>&i=<?php echo $index; ?>" class="button1">Back</a>
		</div>
	</div>
</div>
<?php require_once "footer.php"; ?>