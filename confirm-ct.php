<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	require_once 'header.php';
	
	require_once 'controller/StudentCt.Controller.php';
	
	$scc	= new StudentCtController();

	$sctid		= $_GET['sctid'];
	$ctid 		= $_GET['ctid'];
	$index		= $_GET['i'] - 1;

	$sc		= $scc->getStudentCtByID($sctid);
		
	if( isset($_POST['submit']) ) {
		$startdate	= $sc->getStartDate();
		$scc->finishCumulativeTest($sctid, $startdate);

		header("Location: ct-results.php?sctid={$sctid}");
	}
?>
<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
	</div>
</div>

<div id="content">
<div class="wrap">
	<div id="confirm-box">
		<div>
			<form action="" method="post">
				<p><?php echo _('You are about to submit this test. You can still go back and check your answers. Do you really want to submit this test?'); ?></p>
				<a href="ct.php?ctid=<?php echo $ctid ?>&i=<?php echo $index; ?>" class="button1 back-confirm">Back</a>
				<input type="submit" name="submit" class="button1" value="Submit">
			</form>
		</div>
	</div>
</div>
<?php require_once "footer.php"; ?>