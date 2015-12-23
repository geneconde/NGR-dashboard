<?php
	require_once 'session.php';	
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/StudentCt.Controller.php';
	include_once 'controller/StudentGroup.Controller.php';

	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";

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
	<h1><?php echo _("Cumulative Test Activation"); ?></h1>
	<?php if (isset($_GET['m']) && $_GET['m'] == 1) echo '<p class="green" style="padding: 10px 0">'._('Cumulative Test activated for selected groups below.').'</p>'; ?>
	<form action="activate-ct.php?ctid=<?php echo $ctid; ?>" method="post">
		<table border="0" class="result morepad activate-group-ct">
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
									<div class="onoffswitch">
										<input type="checkbox" name="groups[<?php echo $group['group_id']; ?>]" class="onoffswitch-checkbox activate" id="groups[<?php echo $group['group_id']; ?>]" data-gid="<?php echo $group['group_id']; ?>" <?php echo $checked; ?>>
										<label class="onoffswitch-label" for="groups[<?php echo $group['group_id']; ?>]">
											<div class="onoffswitch-inner<?php echo $lang; ?>" ></div>
											<div class="onoffswitch-switch<?php echo ($lang == '-ar' ? $lang : ''); ?>"></div>
										</label>
									</div>
								</td>
							</tr>
			<?php
						
					
				endforeach;
			?>
		</table>
		<input id="activate" type="submit" class="button1 save-changes" value="<?php echo _('Save Changes'); ?>">
		<a href="ct-test.php" class="button1 cancel-changes"><?php echo _("Cancel"); ?></a>
	</form>
</div>
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

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_right" data-tourtarget="#gcheck">
    <p><?php echo _("This column lists the student groups that the cumulative test is activated for."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#activate">
    <p><?php echo _("Click this button to save your changes."); ?></p>
  </li>
</ul>

<?php require_once "footer.php"; ?>