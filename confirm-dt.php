<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	require_once 'header.php';
	
	require_once 'controller/StudentDt.Controller.php';

	$sdt	= new StudentDtController();

	$sdtid		= $_GET['sdtid'];
	$dtid 		= $_GET['dtid'];
	$index		= $_GET['i'] - 1;

	$sdt_set	= $sdt->getStudentDtByID($sdtid);

	if( isset($_POST['submit']) ) {

		$startdate	= $sdt_set->getStartDate();
		$sdt->finishDiagnosticTest($sdtid, $startdate);

		header("Location: dt-results.php?sdtid={$sdtid}");
	}
?>	
<div id="container">
	<div id="confirm-box">
		<div>
			<form action="" method="post">
				<p><?php echo _('You are about to submit this test. You can still go back and check your answers. Do you really want to submit this test?'); ?></p>
				<a href="dt.php?dtid=<?php echo $dtid ?>&i=<?php echo $index; ?>" class="button1 back-confirm">Back</a>
				<input type="submit" name="submit" class="button1" value="Submit">
			</form>
		</div>
	</div>
</div>
<?php require_once "footer.php"; ?>