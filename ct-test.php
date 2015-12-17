<?php
	ini_set('display_errors', '1');
	require_once 'session.php';	
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/CumulativeTest.Controller.php';
	include_once 'controller/StudentGroup.Controller.php';
	include_once 'controller/StudentCt.Controller.php';
	
	$userid 	= $user->getUserid();
	
	$sgc 		= new StudentGroupController();
	$groups 	= $sgc->getActiveGroups($userid);

	$ctc		= new CumulativeTestController();
	$ct_set		= $ctc->getCumulativeTests($userid);

	$scc 		= new StudentCtController();
?>
<style type="text/css">
.button1 { display: inline !important; }
td.ct_options { width: 43% !important; }
<?php if($language == "es_ES") { ?>
	.ct_options { width: 50% !important; }
<?php } ?>
</style>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = 'cumulative-test'; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="teacher.php">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="wrap">
<h1><?php echo _("Cumulative Test Settings"); ?></h1>
<table border="0" class="result morepad">
	<tr>
		<th><?php echo _("Test Name"); ?></th>
		<th id="grpc"><?php echo _("ACTIVATED FOR"); ?></th>
		<th><?php echo _("Action"); ?></th>
		<!-- <th><?php echo _("Set"); ?></th> -->
	</tr>
	<?php 
		if($ct_set):
			foreach($ct_set as $ct): ?>
				<tr>
					<td style="vertical-align:top;"><?php echo $ct['test_name']; ?></td>
					<td>
						<?php $ct_groups	= $scc->getGroupsInCT($ct['ct_id']); ?>
						<?php foreach($ct_groups as $ct_group) : ?>
						<?php $gnamearr = $sgc->getGroupName($ct_group['group_id']); ?>
						<p><?php echo $gnamearr[0]['group_name']; ?></p>
						<?php endforeach; ?>
					</td>
					<td class="ct_options">
						<a class="button1 edit-ct cool-btn" href="edit-ct.php?ctid=<?php echo $ct['ct_id']; ?>" data-id="<?php echo $ct['ct_id']; ?>">
							<?php echo _("Edit"); ?>
						</a>
						<a class="button1 ct-del danger-btn" href="delete-ct.php?ctid=<?php echo $ct['ct_id']; ?>">
							<?php echo _("Delete"); ?>
						</a>
						<a class="button1 activate-ct cool-btn" href="activate-group-ct.php?ctid=<?php echo $ct['ct_id']; ?>">
							<?php echo _("Activate on Groups"); ?>
						</a>
						<a class="button1 ct-res cool-btn" href="all-students-ct-results.php?ctid=<?php echo $ct['ct_id']; ?>">
							<?php echo _("Result"); ?>
						</a>
					</td>
				</tr>
		<?php 
			endforeach; 
		else :
	?>
		<tr>
			<td colspan="4"><center><?php echo _("You have not created any cumulative tests yet."); ?></center></td>
		</tr>
	<?php endif; ?>
</table>
<a class="button1 create-test-btn" href="create-ct.php" id="cct"><?php echo _("Create Cumulative Test"); ?></a>
</div>
<script type="text/javascript" src="scripts/chosen.jquery.js" ></script>
<script>
$(document).ready(function() {
	localStorage.clear();
	
	$('.activate').click(function(e) {
		e.preventDefault();
		var cid = $(this).data('id');
		
		if(!$(this).hasClass('disabled')) {
			$.ajax({
				type:	"POST",
				url:	"activate-ct.php",
				data:	{ ctid: cid },
				success: function() {
					window.location.reload();
				}
			});
		}
	});
	
	$('.ct-del').click(function(e) {
		if(window.confirm("<?php echo _('Deleting this test will also delete all records of students who have taken this test. Are you sure you want to delete this diagnostic test?'); ?>")){
            window.location.href = $(this).attr('href');
        } else {
            e.preventDefault();
        }
	});
	
	$('.edit-ct').click(function(e) {
		var redirect = ($(this).attr('href'));
		var id = $(this).data('id');
		var check;

		e.preventDefault();
		
		$.ajax({
			type	: "POST",
			url		: "check-ct-test.php",
			data	: {	ctid: id },
			success	: function(data) {
				console.log(data);
				if(data == 1) {
					if(window.confirm("<?php echo _('There are student records that are tied to this test. Editing this test would delete those student records. Are you sure you want to edit?'); ?>")){
						$.ajax({
							type	: "POST",
							url		: "delete-ct-records.php",
							data	: {	ctid: id },
							success	: function(data) {
								console.log(data);
							}
						});
						
						window.location.href = redirect;
					}
				} else window.location.href = redirect;
			}
		});
	});

	$('.chosen').on('change', function(){
		var id = $(this).parent().find('.ctid').val();
		var groups = $(this).val();

		$.ajax({
			type	: "POST",
			url		: "update-ct-group.php",
			data	: {	ctid: id, gid: groups }
		});
	});
});
</script>

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_top" data-tourtarget="#grpc">
    <p><?php echo _("This column lists the student groups that the cumulative test is activated for."); ?></p>
  </li>
  <li class="tlypageguide_bottom" data-tourtarget=".edit-ct">
    <p><?php echo _("Click the <strong>Edit</strong> button to edit/update the cumulative test you created."); ?></p>
  </li>
  <li class="tlypageguide_bottom" data-tourtarget=".ct-del">
    <p><?php echo _("Click this button to delete the cumulative test/s you created."); ?></p>
  </li>
  <li class="tlypageguide_bottom" data-tourtarget=".activate-ct">
    <p><?php echo _("Click this button to activate the cumulative test to one or more student groups."); ?></p>
  </li>
  <li class="tlypageguide_bottom" data-tourtarget=".ct-res">
    <p><?php echo _("Click this button to view the result."); ?></p>
  </li>
  <li class="tlypageguide_bottom" data-tourtarget="#cct">
    <p><?php echo _("Click this button to create a cumulative test."); ?></p>
  </li>
</ul>

<?php require_once "footer.php"; ?>