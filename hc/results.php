<?php 
	require_once '../header.php';
	require_once '../controller/Exercise.Controller.php';
	require_once '../controller/Question.Controller.php';
	$ec 	= new ExerciseController();

	$qc 	= $ec->loadExercisesByType('heating-and-cooling',0);
	$qq 	= $ec->loadExercisesByType('heating-and-cooling',1);
	$qnc 	= new QuestionController();
	$img = 'wrong';
?>

<div id="content">
	<div class="wrap">
		<h1><?php echo _("Module Score Summary"); ?>
			<a href="http://www.printfriendly.com" style="float: right; color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF">
				<img id="printfriendly" style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="<?php echo _("Print Friendly and PDF"); ?>"/>
			</a>
		</h1>
		

	<table border="0" class="result fleft" id="qcr">
		<tr>
			<th colspan="2"><?php echo _('QUICK CHECK #1'); ?></th>
		</tr>
		
		
		<tr>
			<td>
				A
			</td>
			
			<td>
				<?php if($img == 'correct') { ?>
					<img src="http://dev.jigzen.com/shymansky/dashboard/images/correct.png" alt="<?php echo $img; ?>"/>
				<?php } else { ?>
					<img src="http://dev.jigzen.com/shymansky/dashboard/images/wrong.png" alt="<?php echo $img; ?>"/>
				<?php } ?>
			</td>
		</tr> 
		<tr>
			<td>B</td>
			<td>
				<?php if($img == 'correct') : ?>
					<img src="http://dev.jigzen.com/shymansky/dashboard/images/correct.png" alt="<?php echo $img; ?>"/>
				<?php else : ?>
					<img src="http://dev.jigzen.com/shymansky/dashboard/images/wrong.png" alt="<?php echo $img; ?>"/>
				<?php endif; ?>
			</td>
		</tr>
	</table>

	</div>
</div>

