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
<style>
	/*Custom joyride*/
	.joyride-tip-guide:nth-child(6){
	    margin-left: -30px !important;
	}
	/*End custom joyride*/
</style>
<div id="container">
<a class="link" href="settings.php?mid=<?php echo $mid; ?>">&laquo <?php echo _("Go Back"); ?></a>

<?php if ($mode == 1): ?>
<h1><?php echo $display = ($action == "edit"? _("Edit") : _("Create")); ?> <?php echo _("Pre-Diagnostic Test"); ?></h1>
<?php echo _("A pre-diagnostic test will be taken by the students before they work on any of the modules available to them. This test should be completed within the specified time limit. Only the answers that are completed within the time limit will be recorded."); ?>
<?php else: ?>
<h1><?php echo $display = ($action == "edit"? _("Edit") : _("Create")); ?> <?php echo _("Post-Diagnostic Test"); ?></h1>
<?php echo _("A post-diagnostic test will be taken by the student after they finished all available reviews. This test should be finished within a time limit. If the student exceeds the time limit, whatever he finishes will be recorded."); ?>
<?php endif; ?>
<br><br>
<span class="bold"><?php echo _('Test name:'); ?>  </span><input type="text" id="test-name" value="<?php if(isset($testname)) echo $testname; ?>">
<table border="0" class="result morepad">
	<tr>
		<td colspan="2">
			<span class="bold"><?php echo _("Choose Questions"); ?></span><br/>
			<?php echo _("This is the pool of questions you can choose from."); ?><br/>
			<span class="rvw"><?php echo "(*) - "._("questions with asterisk are from the review itself"); ?></span>
		</td>
	</tr>
	<tr>
		<td>
			<center>
				<input type="checkbox" id="select-all">
			</center>
		</td>
		<td>
			<p id="select-text"><?php echo _("Select all questions"); ?></p>
		</td>
	</tr>
	<br>
	<?php
		$ctr = 1;
		foreach($question_set as $row):
	?>
	<tr class="trline">
		<td>
			<!-- <div class="onoffswitch1"> -->
				<!-- <input type="checkbox" name="onoffswitch<?php echo $ctr;?>" class="onoffswitch1-checkbox" id="myonoffswitch<?php echo $ctr;?>" value="<?php echo $row['qid']; ?>" <?php if(isset($qid)): if(in_array($row['qid'], $qid)): echo "checked"; endif; endif; ?>> -->
				<input type="checkbox" name="onoffswitch<?php echo $ctr;?>" class="q-cb" id="myonoffswitch<?php echo $ctr;?>" value="<?php echo $row['qid']; ?>" <?php if(isset($qid)): if(in_array($row['qid'], $qid)): echo "checked"; endif; endif; ?>>
				<!-- <label class="onoffswitch1-label" for="myonoffswitch<?php echo $ctr;?>">
					<div class="onoffswitch1-inner<?php echo $lang; ?>"></div>
					<div class="onoffswitch1-switch<?php if($language == 'ar_EG') { echo $lang; } ?>"></div>
				</label> -->
			<!-- </div> -->
		</td>
		<td>
		<?php 
			if($row['from_review']) echo _("<span class='ask'>* </span>");
			echo _($row['question']);
			echo '<br/>';
			if($row['image']) :
				$image = $row['image'];
				$img = trim($image, "en.jpg");
				
				if($language == 'ar_EG' && $row['translate'] == 1) {
					$img .= '-ar.jpg';
					echo '<img src="'.$img.'" class="dtq-image">';
				} elseif($language == 'es_ES' && $row['translate'] == 1) {
					$img .= '-es.jpg';
					echo '<img src="'.$img.'" class="dtq-image">';
				} elseif($language == 'zh_CN' && $row['translate'] == 1) {
					$img .= '-zh.jpg';
					echo '<img src="'.$img.'" class="dtq-image">';
				} elseif($language == 'en_US' && $row['translate'] == 1) {
					echo '<img src="'.$image.'" class="dtq-image">';
				} else {
					echo '<img src="'.$image.'" class="dtq-image">';
				}
			endif;
			
			$choices = $dtq->getQuestionChoices($row['qid']);
		?>
		<br/>
		<small><?php echo _("Choices"); ?>:<br/>
		<?php foreach($choices as $choice): ?>
			<span class='letters'><?php echo $choice['order']; ?></span>. <?php echo _($choice['choice']); ?><br>
		<?php endforeach; ?>
		<br/><?php echo _("Answer"); ?>: <?php echo $row['answer']; ?>
		</small>
		</td>
	</tr>
	<?php 
			$ctr++;
		endforeach; 
	?>
</table>
<div class="clear"></div>
<br/>
<a href="#" class="button1" id="save"><?php echo _("Save Changes"); ?></a>
</form>
</div>
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
					} else window.location.href = "settings.php?mid=<?php echo $mid; ?>";
				}
			});
		}
	});
});
</script>
<!-- Tip Content -->
<ol id="joyRideTipContent">
	<li data-id="test-name" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("Enter a title for your test."); ?></p>
	</li>
	<li data-id="select-all" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("Select questions to include in your test by clicking the checkbox beside each question. You can click the first checkbox to select all the questions."); ?></p>
	</li>
	<li data-id="save" 			data-text="<?php echo _('Close'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("Click this button to save your changes."); ?></p>
	</li>
</ol>

<script>
  function guide() {
  	$('#joyRideTipContent').joyride({
      autoStart : true,
      postStepCallback : function (index, tip) {
      if (index == 2) {
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