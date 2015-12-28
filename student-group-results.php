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

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="teacher.php">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
	<div class="wrap">
		<br><br>
		<h2><?php echo _("Student Groups"); ?></h2>
		<table border="0" class="result morepad">
			<tr>
				<th class="bold"><?php echo _("Group"); ?></th>
				<th class="bold"><?php echo _("Results"); ?></th>
			</tr>
			<?php foreach($groups as $group): ?>
			<tr>
				<td><?php echo $group['group_name']; ?></td>
				<td id="result"><a class="button1 cool-btn" href="student-results.php?gid=<?php echo $group['group_id']; ?>&mid=<?php echo $mid; ?>"><?php echo _("View Results"); ?></a></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>

	<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
	  <li class="tlypageguide_right" data-tourtarget="#result">
	    <p><?php echo _("Click this button to view the module and test results of a student group."); ?></p>
	  </li>
	</ul>

<?php require_once "footer.php"; ?>