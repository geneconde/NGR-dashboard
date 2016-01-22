<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/DtQuestion.Controller.php';
	include_once 'controller/DiagnosticTest.Controller.php';

	$userid = $user->getUserid();
	$action = $_GET['action'];
	
	if($action == "new"):
		$mid 	= $_GET['module_id'];
		$mode 	= ($_GET['mode'] == 'pre' ? 1 : 2 );

	elseif($action == "edit"):
		$dtid		= $_GET['dtid'];
		$dtc 		= new DiagnosticTestController();
		$dt_set		= $dtc->getDiagnosticTestByID($dtid);
		$questions 	= $dt_set->getQid();
		$qid		= explode(',', $questions);
		$mid		= $dt_set->getModuleid();
		$mode		= $dt_set->getMode();
		$testname	= $dt_set->getTestName();
	endif;
	
	$dtq 			= new DtQuestionController();
	$question_set 	= $dtq->getDTPool($mid);
	$letters 		= range('a','z');
	
	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";
?>
<style type="text/css">
	div#choice_size img {
	    width: 208px !important;
	    height: 117px !important;
	}
</style>
<div class="top-buttons">
	<div class="wrap">
		<?php if($ufl != 1) : ?>
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<?php endif; ?>
		<a class="link back" href="#" onclick="location.href = document.referrer;">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="wrap">
	<?php if ($mode == 1): ?>
	<h1><?php echo $display = ($action == "edit"? _("Edit") : _("Create")); ?> <?php echo _("Pre-Diagnostic Test"); ?></h1><br>
	<p><?php echo _("The pre-diagnostic test will be available before taking the module. This test must be completed within the specified time limit. Only answers that are completed within the time limit will be recorded."); ?></p>
	<?php else: ?>
	<h1><?php echo $display = ($action == "edit"? _("Edit") : _("Create")); ?> <?php echo _("Post-Diagnostic Test"); ?></h1>
	<p><?php echo _("The post-diagnostic test will be taken after the students completed the module. This test must be completed within the specified time limit. Only answers that are completed within the time limit will be recorded."); ?></p>
	<?php endif; ?>

	<div class="dt-test-name">
		<p class="bold"><?php echo _('Test name'); ?></p>
		<input type="text" id="test-name" value="<?php if(isset($testname)) echo $testname; ?>">
	</div>
	<div class="dt-test-note">
		<p class="bold"><?php echo _("Choose Questions"); ?></p>
		<p><?php echo _("This is the pool of questions you can choose from."); ?></p>
		<p class="rvw"><?php echo "(*) - "._("questions with asterisk are from the module itself"); ?></p>
	</div>

	<input type="text" id="search-test" placeholder="<?php echo _('Search...'); ?>">
	<table border="0" class="result morepad" id="dt-table">
		<thead>
			<tr>
				<td>
					<input type="checkbox" id="select-all">
				</td>
				<td>
					<p id="select-text"><b><?php echo _("Select all questions"); ?></b></p>
				</td>
			</tr>
		</thead>
		<?php
			$ctr = 1;
			foreach($question_set as $row):
		?>
		<tbody>
			<tr class="trline">
				<td class="check">
					<input type="checkbox" name="onoffswitch<?php echo $ctr;?>" class="q-cb" id="myonoffswitch<?php echo $ctr;?>" value="<?php echo $row['qid']; ?>" <?php if(isset($qid)): if(in_array($row['qid'], $qid)): echo "checked"; endif; endif; ?>>
				</td>
				<td>
				<?php 
					if($row['from_review']) echo _("<span class='ask'>* </span>");
					echo _($row['question']);
					echo '<br/>';
					
					if($row['image'])
						echo '<img src="'.$row['image'].'" class="dtq-image">';
					
					$choices = $dtq->getQuestionChoices($row['qid']);
				?>
				<br/>
				<small>
					<?php echo _("Choices"); ?>: 
					<br/>
					<?php foreach($choices as $choice): ?>
					<span class="letters <?php echo($choice['order']==$row['answer'] ? 'correct-ans' : ''); ?>">
						<?php 	echo $choice['order']; ?>. <?php echo _($choice['choice']); 
								if(empty($choice['image'])){
								}else{
									echo '<div id="choice_size"><img src="'.$choice['image'].'"></div>';
								}
						?>
					</span>
					<br>
					<?php endforeach; ?> 
					<br/>
					<?php echo _("Answer"); ?>: <?php echo $row['answer']; ?>
				</small>
				</td>
			</tr>
			<?php 
					$ctr++;
				endforeach; 
			?>
		</tbody>
	</table>
	<div class="clear"></div>
	<a href="#" class="button1 save-changes" id="save"><?php echo _("Save Changes"); ?></a>
	<a href="#" onclick="location.href = document.referrer;" class="button1 cancel-changes"><?php echo _("Cancel"); ?></a>
	<br><br>
	</form>
</div>

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_right" data-tourtarget="#test-name">
    <p><?php echo _("Enter a title for your test."); ?></p>
  </li>
  <li class="tlypageguide_left" data-tourtarget="#select-all">
    <p><?php echo _("Select questions to include in your test by clicking the checkbox beside each question. You can click the first checkbox to select all the questions."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#save">
    <p><?php echo _("Click this button to save your changes."); ?></p>
  </li>
</ul>

<script>
	var action 		= '<?php echo $action; ?>';
	var	moduleid 	= '<?php echo $mid; ?>';
	var	md 			= '<?php echo $mode; ?>';
	var selected 	= [];
	var dtid		= '<?php if(isset($dtid)) echo $dtid; ?>';
	$(document).ready(function() {
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

		$('#save').click(function(e) {
			selected = [];
			$('.q-cb').each(function() {
				if($(this).is(':checked')) {
					selected.push($(this).attr('value'));
				}
			});
			
			var questions 	= selected.join(',');
			var name 		= $('#test-name').val();

			if(questions == ''){
				alert('<?php echo _("Please select questions for this test."); ?>');
				e.preventDefault();
			} else if($.trim($('#test-name').val()) == '') {
				alert('<?php echo _("Please enter a name for this test."); ?>');
				e.preventDefault();
			} else {
				$.ajax({
					type	: "POST",
					url		: "update-test.php",
					data	: {	mid: moduleid, mode: md, qid: questions, act: action, tname: name, dtid: dtid },
					success	: function(data) {
						if(data == 0) {
							$('#test-name').focus();
							$('#test-name:focus').css({
								'outline': 'none',
								'box-shadow': '0px 0px 5px rgb(230, 0, 0)',
								'border': '1px solid rgb(219, 90, 90)'
							});
							
							alert('<?php echo _("A same test name already exists. Please change the name of the test."); ?>');
						} else window.location.href = document.referrer;
					}
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

<?php require_once "footer.php"; ?>