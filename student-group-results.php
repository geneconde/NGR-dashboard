<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/StudentGroup.Controller.php';
	
	$userid = $user->getUserid();
	$mid	= $_GET['mid'];
	
	$sgc 	= new StudentGroupController();
	$groups	= $sgc->getGroups($userid);
?>
<div id="container">
	<a class="link" href="teacher.php">&laquo <?php echo _("Go Back to Dashboard"); ?></a>
	<br><br>
	<center>
	<h2><?php echo _("Student Groups"); ?></h2>
	<table border="0" class="result morepad">
		<tr>
			<th class="bold"><?php echo _("Group"); ?></th>
			<th class="bold"><?php echo _("Results"); ?></th>
		</tr>
		<?php foreach($groups as $group): ?>
		<tr>
			<td><?php echo $group['group_name']; ?></td>
			<td><a class="button1" href="student-results.php?gid=<?php echo $group['group_id']; ?>&mid=<?php echo $mid; ?>"><?php echo _("View Results"); ?></a></td>
		</tr>
		<?php endforeach; ?>
	</table>
	</center>
</div>
<?php require_once "footer.php"; ?>