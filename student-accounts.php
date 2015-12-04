<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	require_once 'controller/StudentGroup.Controller.php';
	
	$userid 	= $user->getUserid();	
	$students 	= $uc->loadUserTypeOrderLname(2, $userid);

	$sgc 		= new StudentGroupController();
	$groups		= $sgc->getGroups($userid);
?>
<div id="container">
	<a class="link back" href="teacher.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>
	<br><br>
	<?php 
		$assigned = array();
		$grp = 1;
		
		foreach($groups as $group) {
			$users =  $sgc->getUsersInGroup($group['group_id']);
			$assigned = array_merge($assigned, $users);
			
			$ctr = 1;
			
	?>
	<h2 class="group-name"><?php echo $group['group_name']; ?></h2>
	<table class="students" id="group-<?php echo $group['group_id']; ?>">
		<tr>
			<th></th>
			<th class="bold suser">#</th>
			<th class="bold"><?php echo _("Student Name"); ?></th>
			<th class="bold"><?php echo _("Gender"); ?></th>
			<!-- <th class="bold" colspan="2"><?php echo _("Action"); ?></th> -->
		</tr>
		<?php
			if($users) {
				foreach($students as $student) {
					if(in_array($student['user_ID'], $users)) {
		?>
						<tr>
							<td><input type="checkbox" class="st-box" value="<?php echo $student['user_ID']; ?>"></td>
							<td><?php echo $ctr; ?></td>
							<td><?php echo $student['last_name']; if ($student['last_name'] != '') echo ', '; echo $student['first_name'] ; ?></td>
							<td><?php echo $student['gender']; ?></td>
							<!-- <td><a href="edit-account.php?user_id=<?php echo $student['user_ID']; ?>&f=0"><?php echo _("Edit"); ?></td> -->
							<!-- <td><a href="view-portfolio.php?user_id=<?php echo $student['user_ID']; ?>"><?php echo _("View Portfolio"); ?></td> -->
						</tr>
		<?php 
						$ctr++;
					}
				}
			} else {
		?>
						<tr>
							<td colspan="5"><?php echo _("There are no students in this group."); ?></td>
						</tr>
		<?php
			}
		?>
	</table>
	<div class="group-control" id="group-control-<?php echo $group['group_id']; ?>">
	<?php echo _("Move to:"); ?>
	<select id="select-<?php echo $grp; ?>">
		<?php 
			foreach($groups as $others) {
				if($others['group_name'] != $group['group_name']) {
		?>
					<option value="<?php echo $others['group_id']; ?>"><?php echo $others['group_name']; ?></option>
		<?php
				}
			}
		?>
					<option value="nogroup"><?php echo _('No Group'); ?></option>
	</select>
	<input type="button" class="button1 transfer" value="<?php echo _("Transfer"); ?>">
	<input type="button" class="button1 delete" value="<?php echo _("Delete Group"); ?>">
	<a href="edit-group-name.php?group_id=<?php echo $group['group_id']; ?>" class="button1 edit"><?php echo _("Edit Name"); ?></a>
	</div>
	<?php $grp++; } ?>

	<h2 class="group-name"><?php echo _("Unassigned Students"); ?></h2>
	<table class="students" id="group-u">
		<tr>
			<th><input type="checkbox" id="select-all"></th>
			<th class="bold" id="suser">#</th>
			<th class="bold"><?php echo _("Student Name"); ?></th>
			<th class="bold"><?php echo _("Gender"); ?></th>
			<!-- <th class="bold"><?php echo _("Action"); ?></th> -->
		</tr>
		<?php
			$ctr = 1;
			$empty = true;

			foreach($students as $student) {
				
				if(!in_array($student['user_ID'], $assigned)) {
					$empty = false;
		?>
					<tr>
						<td><input type="checkbox" class="st-box unassigned-cb" value="<?php echo $student['user_ID']; ?>"></td>
						<td><?php echo $ctr; ?></td>
						<td><?php echo $student['last_name']; if ($student['last_name'] != '') echo ', '; echo $student['first_name'] ; ?></td>
						<td><?php echo $student['gender']; ?></td>
						<!-- <td><a href="edit-account.php?user_id=<?php echo $student['user_ID']; ?>&f=0"><?php echo _("Edit"); ?></td> -->
					</tr>
		<?php 
					$ctr++;
				}
			}

			if($empty) {
		?>
		<tr>
			<td colspan="5"><center><?php echo _("There are no unassigned students."); ?></center></td>
		</tr>
		<?php } ?>
	</table>
	<div class="group-control" id="group-control-u">
	<?php echo _("Move to:"); ?>
	<select class="grps">
		<?php foreach($groups as $others) { ?>
			<option value="<?php echo $others['group_id']; ?>"><?php echo $others['group_name']; ?></option>
		<?php } ?>
	</select>
	<input type="button" class="button1 transfer" value="<?php echo _("Transfer"); ?>">
	</div>
	<br>
	<a class="button1" id="create-group"><?php echo _("New Group"); ?></a>
	<form class="user-group" action="save-group.php" method="post">
		<p><?php echo _("Group Name:"); ?></p>
		<input type="text" id="group-name" name="groupname">
		<div class="clear"></div>
		<div id="group-controls">
			<input type="submit" value="<?php echo _("Create"); ?>" class="button1">
			<a class="link" id="cancel"><?php echo _("Cancel"); ?></a>
		</div>
	</form>
</div>
<!-- Tip Content -->
<ol id="joyRideTipContent">
	<li data-id="create-group" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("Click this button to create a new group. Enter the group name and click <strong>Create</strong>. This step is optional but be reminded that you cannot transfer students to other groups if you don't create one."); ?></p>
	</li>
	<li data-class="suser" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("To transfer students to another group, select the checkbox beside the student's username. You can also click on the first checkbox to select all students."); ?></p>
	</li>
	<li data-class="grps" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade;">
		<p><?php echo _("Select a group where you want the students to be transferred to."); ?></p>
	</li>
	<li data-class="transfer" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("Click this button to transfer your students to the new/other group."); ?></p>
	</li>
	<li data-class="delete" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _('Click this button to delete a group. All students from the deleted group will go to the "Unassigned" table.'); ?></p>
	</li>
	<li data-class="edit" 		data-text="<?php echo _('Close'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("Click this button to update the name of the group."); ?></p>
	</li>
</ol>
<script>
$(document).ready( function () {	
	$('#create-group').click(function() {
		$('.user-group').show();
	});
	
	$('#cancel').click(function(e) {
		$('.user-group').hide();
	});

	$('.group-control input[type=button].delete').click(function(e) {
		if(window.confirm("<?php echo _('Are you sure you want to delete this group?'); ?>")){
			var id 			= $(this).parent().attr('id'),
				group 		= id.split('-');

			$.ajax({
				type	: "POST",
				url		: "delete-group.php",
				data	: {	groupid: group[2] },
				success	: function() {
					window.location.reload(true);
				}
			});
		} else {
			e.preventDefault();
		}
	});
	
	$('.group-control input[type=button].transfer').click(function(e) {
		if(window.confirm("<?php echo _('Are you sure you want to transfer these students?'); ?>")){
            var id 			= $(this).parent().attr('id'),
				group 		= id.split('-'),
				users 		= [],
				create 		= (group[2] == "u") ? 1 : 0,
				transfer 	= $(this).parent().find('select option:selected').val();
		
			$('#group-' + group[2] + ' input[type=checkbox]').each(function() {
				if($(this).is(':checked')) users.push($(this).attr('value'));
			});
			
			$.ajax({
				type	: "POST",
				url		: "update-group.php",
				data	: {	ur: users, ct: create, tf: transfer },
				success	: function(data) {
					console.log(data);
					window.location.reload(true);
				}
			});
        } else {
            e.preventDefault();
        }
		
	});
});

$(document).ready(function(){
	$('#select-all').click(function(){
		if($(this).is(':checked')) {
			$('.unassigned-cb').each(function(){
				$(this).prop('checked', true);
				$('#select-text').html('Deselect all questions');
			});
		} else {
			$('.unassigned-cb').each(function(){
				$(this).prop('checked', false);
				$('#select-text').html('Select all questions')
			});
		}
	});
});
function guide() {
	$('#joyRideTipContent').joyride({
	  autoStart : true,
	  postStepCallback : function (index, tip) {
	  if (index == 10) {
	    $(this).joyride('set_li', false, 1);
	  }
	},
    'template' : {
        'link'    : '<a href="#close" class="joyride-close-tip"><?php echo _("Close"); ?></a>'
      }
    });
}
</script>
<?php require_once "footer.php"; ?>