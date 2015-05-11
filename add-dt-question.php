<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	
	$mid = $_GET['module_id'];
?>
<a class="link" href="diagnostic-tests.php?module_id=<?php echo $mid; ?>">&laquo <?php echo _("Go Back to Dashboard"); ?></a>
<br><br>
<form method="post" id="question-form" action="save-dt-question.php?module_id=<?php echo $mid; ?>">
	<center>
		<table id="add-question">
			<tr>
				<td colspan="2">
					<?php if($_GET['f'] == 1) echo "<span class='red'>You have successfully added the question.</span><br><br>"; ?>
					<?php echo _("Please fill in each of the textboxes."); ?>
				</td>
			</tr>
			<tr id="qtr">
				<td>
					<?php echo _("Question:"); ?>
				</td>
				<td>
					<textarea class="tb" name="question" id="question" data-validation="required" data-validation-error-msg="You must enter a question"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("Choice A:"); ?>
				</td>
				<td>
					<input class="tb" type="text" name="choice-a" data-validation="required" data-validation-error-msg="You must enter a choice">
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("Choice B:"); ?>
				</td>
				<td>
					<input class="tb" type="text" name="choice-b" data-validation="required" data-validation-error-msg="You must enter a choice">
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("Choice C:"); ?>
				</td>
				<td>
					<input class="tb" type="text" name="choice-c" data-validation="required" data-validation-error-msg="You must enter a choice">
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("Choice D:"); ?>
				</td>
				<td>
					<input class="tb" type="text" name="choice-d" data-validation="required" data-validation-error-msg="You must enter a choice">
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("Answer:"); ?>
				</td>
				<td>
					<select name="answer">
						<option selected>A</option>
						<option>B</option>
						<option>C</option>
						<option>D</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<input class="button1" type="submit" name="add-question" value="Add question">
				</td>
			</tr>
		</table>
	</center>
</form>
<script>
$.validate({
  form : '#question-form'
});
</script>
<?php require_once "footer.php"; ?>