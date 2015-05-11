<?php
	require_once 'session.php';
	include_once 'header.php';
?>
<div id="container">
<form method="post" action="save-feedback.php">
	<center>
		<table>
			<tr>
				<td colspan="2"><center><strong>Add Feedback</strong></center></td>
			</tr>
			<tr>
				<td>
					Exercise ID:
				</td>
				<td>
					<input type="text" name="exercise-id" id="exercise-id">
				</td>
			</tr>
			<tr>
				<td>
					Choice:
				</td>
				<td>
					<input type="text" name="choice">
				</td>
			</tr>
			<tr>
				<td>
					Feedback:
				</td>
				<td>
					<textarea name="feedback" cols="30" rows="4" style="resize: none;"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<br>
					<center>
						<input id="edit" class="button1" type="submit" name="edit" id="cpw" value="Add Feedback">
					</center>
				</td>
			</tr>
		</table>
	</center>
</form>
</div>
<?php require_once "footer.php"; ?>