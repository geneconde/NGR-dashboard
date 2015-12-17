<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/DtQuestion.Controller.php';
	include_once 'controller/CumulativeTest.Controller.php';

	$userid = $user->getUserid();
	$mid	= $_GET['mid'];
	$action	= (isset($_GET['action']) ? "edit" : "new");
	
	$mc 			= new ModuleController();
	$dtq 			= new DtQuestionController();
	$question_set 	= $dtq->getDTPool($mid);
	$ctr = 0;

	if(isset($_GET['ctid'])):
		$ctid 	= $_GET['ctid'];
		$ctc 	= new CumulativeTestController();
		$ct		= $ctc->getCumulativeTestByID($ctid);
		$qid	= explode(',', $ct->getQid());
	elseif(isset($_SESSION['ct'.$userid.$mid])):
		$qid	= explode(',', $_SESSION['ct'.$userid.$mid]);
	endif;

	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";

	$module = $mc->loadModule($mid);
?>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<?php if($action == "new"): ?>
			<a class="link back" href="create-ct.php">&laquo <?php echo _("Go Back"); ?></a>
		<?php elseif($action == "edit"): ?>
			<a class="link back" href="edit-ct.php?ctid=<?php echo $ctid; ?>">&laquo <?php echo _("Go Back"); ?></a>
		<?php endif; ?>
	</div>
</div>

<div class="ct-questions wrap">
	<h1><?php echo _($module->getModule_name()); ?></h1>
	<form action="process-ct.php?mid=<?php echo $mid; ?><?php if(isset($ctid)) echo '&ctid='.$ctid; ?>" method="POST">
		<div class="dt-test-note">
			<p><?php echo _('Please select the questions that you would like to add to your cumulative test.'); ?></p>
			<p><span class="rvw"><?php echo "(*) - "._("questions with asterisk are from the module itself"); ?></span></p>
		</div>

		<input type="text" id="search-test" placeholder="<?php echo _('Search...'); ?>">
		<input type="hidden" name="action" value="<?php echo $action; ?>">
		<table border="0" class="result morepad" id="ct-table">
			<thead>
				<tr>
					<td>
						<input type="checkbox" id="select-all">
					</td>
					<td>
						<b><p id="select-text" style="vertical-align: middle;"><?php echo _("Select all questions"); ?></p></b>
					</td>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach($question_set as $question):
			?>
				<tr class="trline">
					<td class="p-right15 check">
						<!-- <div class="onoffswitch1"> -->
							<input type="checkbox" name="questions[]" class="q-cb" id="myonoffswitch<?php echo $ctr + 1;?>" value="<?php echo $question['qid']; ?>" <?php if(isset($qid) && in_array($question['qid'], $qid)) { ?> checked <?php } ?>>
							<!-- <input type="checkbox" name="questions[]" class="onoffswitch1-checkbox" id="myonoffswitch<?php echo $ctr + 1;?>" value="<?php echo $question['qid']; ?>" <?php if(isset($qid) && in_array($question['qid'], $qid)) { ?> checked <?php } ?>> -->
							<!-- <label class="onoffswitch1-label" for="myonoffswitch<?php echo $ctr + 1;?>">
								<div class="onoffswitch1-inner<?php echo $lang; ?>"></div>
								<div class="onoffswitch1-switch<?php if($language == 'ar_EG') { echo $lang; } ?>"></div>
							</label>
						</div> -->
					</td>
					<td>
					<?php
						echo ($ctr + 1).". ";
					
						if($question['from_review']) echo _("<span class='ask'>* </span>");
						echo _($question['question']);
						
						echo '<br/>';

						if($question['image']) :
							$image = $question['image'];
							$img = trim($image, "en.jpg");

							if($language == 'ar_EG' && $question['translate'] == 1) {
								$img .= '-ar.jpg';
								echo '<img src="'.$img.'" class="dtq-image">';
							} elseif($language == 'es_ES' && $question['translate'] == 1) {
								$img .= '-es.jpg';
								echo '<img src="'.$img.'" class="dtq-image">';
							} elseif($language == 'zh_CN' && $question['translate'] == 1) {
								$img .= '-zh.jpg';
								echo '<img src="'.$img.'" class="dtq-image">';
							} elseif($language == 'en_US' && $question['translate'] == 1) {
								echo '<img src="'.$image.'" class="dtq-image">';
							} else {
								echo '<img src="'.$image.'" class="dtq-image">';
							}
						endif;	
					?>
					<?php $choices = $dtq->getQuestionChoices($question['qid']); ?>
					<br/>
					<small><?php echo _("Choices"); ?>:<br/>
					<?php foreach($choices as $choice): ?>
						<span class="letters <?php echo($choice['order']==$question['answer'] ? 'correct-ans' : ''); ?>"><?php echo $choice['order']; ?>. <?php echo _($choice['choice']); ?></span><br>
					<?php endforeach; ?>
					<?php echo _("Answer"); ?>: <?php echo _($question['answer']); ?>
					</small>
					</td>
				</tr>
			<?php 
					$ctr++;
				endforeach;
			?>
			</tbody>
		</table>
		<input id="save" class="button1 save-changes" type="submit" value="<?php if($action == 'new'): echo _("Save Questions"); elseif($action =='edit'): echo _("Update Questions"); endif; ?>">
		<?php if($action == "new"): ?>
			<a class="button1 cancel-changes" href="create-ct.php"><?php echo _("Cancel"); ?></a>
		<?php elseif($action == "edit"): ?>
			<a class="button1 cancel-changes" href="edit-ct.php?ctid=<?php echo $ctid; ?>"><?php echo _("Cancel"); ?></a>
		<?php endif; ?>
	</form>
</div>

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_left" data-tourtarget="#select-all">
    <p><?php echo _("Select questions to include in your test by clicking the checkbox beside each question. You can click the first checkbox to select all the questions."); ?></p>
  </li>
  <li class="tlypageguide_left" data-tourtarget="#save">
    <p><?php echo _("Click this button to save your changes."); ?></p>
  </li>
</ul>

<script>
$(document).ready(function(){
	$('#select-all').click(function(){
		if($(this).is(':checked')) {
			$('.q-cb').each(function(){
				$(this).prop('checked', true);
				$('#select-text').html('<?php echo _("Deselect all questions"); ?>');
			});
		} else {
			$('.q-cb').each(function(){
				$(this).prop('checked', false);
				$('#select-text').html('<?php echo _("Select all questions"); ?>')
			});
		}
	});

	$("#search-test").keyup(function(){
        _this = this;
        $.each($("table tbody").find("tr"), function() {
            console.log($(this).text());
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) == -1)
                $(this).hide();
            else
                $(this).show();                
        });
    });
});
</script>
<?php include "footer.php"; ?>