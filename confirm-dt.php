<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	require_once 'header.php';
	
	$sdtid		= $_GET['sdtid'];
	$dtid 		= $_GET['dtid'];
	$index		= $_GET['i'] - 1;
?>	
<div id="container">
	<div id="confirm-box">
		<div>
			<p><?php echo _('You are about to submit this test. You can still go back and check your answers. Do you really want to submit this test?'); ?></p>
			<a href="dt.php?dtid=<?php echo $dtid ?>&i=<?php echo $index; ?>" class="button1 back-confirm">Back</a>
			<a href="dt-results.php?sdtid=<?php echo $sdtid; ?>" class="button1">Submit</a>
		</div>
	</div>
</div>
<?php require_once "footer.php"; ?>