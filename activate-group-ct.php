<?php
	require_once 'session.php';	
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/StudentCt.Controller.php';
	include_once 'controller/StudentGroup.Controller.php';

	$userid 	= $user->getUserid();
	$ctid 		= $_GET['ctid'];

	$sgc 		= new StudentGroupController();
	$groups 	= $sgc->getActiveGroups($userid);

	$scc 		= new StudentCtController();
	$ct_groups	= $scc->getGroupsInCT($ctid);

?>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="ct-test.php">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="wrap">
	<center>
	<br><br>
	<h2><?php echo _("Cumulative Test Activation"); ?></h2>
	<?php if (isset($_GET['m']) && $_GET['m'] == 1) echo '<p class="green">Cumulative Test activated for selected groups below.</p>'; ?>
	<form action="activate-ct.php?ctid=<?php echo $ctid; ?>" method="post">
		<table border="0" class="result morepad">
			<tr>
				<th><?php echo _("Group Name"); ?></th>
				<th id="gcheck"><?php echo _("Activate"); ?></th>
			</tr>
			<?php
				foreach($groups as $group) :
					$checked = '';
					foreach($ct_groups as $ct_group) :
						if($group['group_id'] == $ct_group['group_id']):
							$checked = 'checked';
						endif;
					endforeach;
			?>
							<tr>
								<td><?php echo $group['group_name']; ?></td>
								<td>
									<center>
										<input type="checkbox" <?php echo $checked; ?> name="groups[<?php echo $group['group_id']; ?>]" class="activate" data-gid="<?php echo $group['group_id']; ?>">
									</center>
								</td>
							</tr>
			<?php
						
					
				endforeach;
			?>
		<table>
		<input id="activate" type="submit" class="button1" value="<?php echo _('Activate Cumulative Test'); ?>">
	</form>
</div>
<script>
(function(){
	var ctid = '<?php echo $ctid; ?>';
	$('.activate').on('change', function(e){
		var cb = $(this);
		if(this.checked) {
			var gid = cb.data("gid");

			$.ajax({
				type	: "GET",
				url		: "check-group-ct.php",
				data	: {	ctid: ctid, gid: gid },
				success : function(data) {
					
					if(data == 1) {
						if(window.confirm("<?php echo _('This group has another cumulative test activated. Do you want to deactivate that test?'); ?>")){
							$.ajax({
								type	: "POST",
								url		: "deactivate-group-ct.php",
								data	: {	gid: gid },
							});
						} else {
							cb.attr('checked', false);
						}
					} 
				}
			});
		}
	});
})();
</script>
<!-- Tip Content -->
<ol id="joyRideTipContent">
	<li data-id="gcheck" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("This column lists the student groups that the cumulative test is activated for."); ?></p>
	</li>
	<li data-id="activate" 		data-text="<?php echo _('Close'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("Click this button to save your changes."); ?></p>
	</li>
</ol>

<script>
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