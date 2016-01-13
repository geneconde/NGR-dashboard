<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/DtQuestion.Controller.php';
	include 'controller/SubmittedTest.Controller.php';
	
	$userid = $user->getUserid();
	$stc = new SubmittedTestController();
	$tests 	= $stc->getAllTest($userid);

	$dtq 			= new DtQuestionController();
	$question_set 	= $dtq->getAllQuestions();
	$modules 		= $dtq->getModules();
	$letters 		= range('a','z');
	
	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";
?>
<div class="top-buttons">
	<div class="wrap">
		<?php if($ufl != 1) : ?>
		<?php $active = 'question-library'; ?>
		<?php include "menu.php"; ?>
		<?php endif; ?>
		<a class="link back" href="#" onclick="location.href = document.referrer;">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
	<div class="wrap" id="test_question_list">
		<h1><?php echo _("Test Item Library"); ?></h1>
		<br>
		<p><?php echo _("This is the Test Item Library page. In this page, you can view and search all questions available for the the diagnostic and cumulative tests. You can copy and paste the items to a Word document for whatever purpose it may serve you."); ?></p><br>

		<div class="fleft dotted-border">
			<button class="btn btn-portfilter active" data-toggle="portfilter" data-target="Test Item List"><?php echo _('Test Item List'); ?></button>
			<button class="btn-portfilter" id="submit-test"><?php echo _('Submit Test Item'); ?></button>
			<button class="btn btn-portfilter" data-toggle="portfilter" data-target="Submitted Test Items"><?php echo _('Submitted Test Items'); ?></button>
		</div>
		
		<div class="clear"></div>

		<ul class="thumbnails gallery module-settings">
			<li class="clearfix settings-group" data-tag='Test Item List'>
				<h2><?php echo _("Test Item List"); ?></h2>
				<div class="question-library-test-name">
					<p class="bold"><?php echo _('Test name'); ?></p>
					<input type="text" id="test-name">
				</div>
				<div class="dt-test-note">
					<p class="bold"><?php echo _("Choose Questions"); ?></p>
					<p><?php echo _("This is the pool of questions you can choose from."); ?></p>
					<p class="rvw"><?php echo "(*) - "._("questions with asterisk are from the module itself"); ?></p>
				</div>
				<div class="search-container">
					<select name="module" id="select-module">
						<option value="all">All</option>
						<?php foreach($modules as $module) : ?>
							<option value="<?php echo $module['module_id'] ?>">
								<?php 
									$_data = str_replace("-", " ", $module['module_id']);
									$name = ucwords($_data);
									echo $name;
								?>
							</option>
						<?php endforeach; ?>
					</select>
					<input type="text" id="search-test" placeholder="<?php echo _('Search...'); ?>">
				</div>

				<table class="result morepad table table-striped table-bordered" id="test-list">
					<thead>
						<tr>
							<th>
								<span><strong><?php echo _("Select Questions"); ?></strong></span>
							</th>
							<th>
								<span id="select-text"><strong><?php echo _("Module"); ?></strong></span>
							</th>
							<th>
								<span id="select-text"><strong><?php echo _("Questions"); ?></strong></span>
							</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach($question_set as $row) : ?>
							<tr class="trline">
								<td class="p-right15 check">
									<input type="checkbox" name="questions[]" class="q-cb" id="myonoffswitch<?php echo $ctr + 1;?>" value="<?php echo $row['qid']; ?>" disabled>
								</td>
								<td class="mname">
									<?php 
										$_data = str_replace("-", " ", $row['module_id']);
										$module = ucwords($_data);
										echo $module;
									?>
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
									<small><?php echo _("Choices"); ?>:<br/>
									<?php foreach($choices as $choice): ?>
										<span class="letters <?php echo($choice['order']==$row['answer'] ? 'correct-ans' : ''); ?>"><?php echo $choice['order']; ?>. <?php echo _($choice['choice']); ?></span><br>
									<?php endforeach; ?>
									<br/><?php echo _("Answer"); ?>: <?php echo $row['answer']; ?>
									</small>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</li>
			<li class="clearfix submitted-test-items" data-tag='Submitted Test Items'>
				<h2><?php echo _("Submitted Test Items"); ?></h2>
				<table id="submitted-test-list">
					<thead>
						<tr>
							<th><?php echo _("Test Name"); ?></th>
							<th><?php echo _("Status"); ?></th>
							<th><?php echo _("Date Submitted"); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if($tests) : ?>
						<?php foreach ($tests as $test): ?>
						<tr>
							<td class="valignMid"><?php echo _($test['name']); ?></td>
							<td>
								<?php
									if($test['status']==3) $class = "status-inactive";
									else if($test['status']==2) $class = "status-rejected";
									else if($test['status']==1) $class = "status-active";
								?>
								<div class="<?php echo $class; ?>">
									<?php
										if($test['status']==3) echo _("Pending");
										else if($test['status']==2) echo _("Rejected");
										else if($test['status']==1) echo _("Approved");
									?>
								</div>
							</td>
							<td><?php echo date('M jS, Y', strtotime($test['date_submitted'])); ?></td>
						</tr>
						<?php endforeach ?>
						<?php endif; ?>
					</tbody>
				</table>
			</li>
		</ul>

	</div>
</div>

<script type="text/javascript" src="scripts/jquery.dataTables2.min.js"></script>
<script src="scripts/bootstrap-portfilter.min.js"></script>
<script>
var selected = [];
$(document).ready(function() {
	$('#test-list').DataTable({
    	"iDisplayLength": 15,
        "bPaginate": true,
        "bFilter": true,
        "bInfo" : false,
        "aaSorting": [],
        responsive: true,
        "fnDrawCallback": function( oSettings ) {
	    	$('.q-cb').prop('disabled', false);
	    }
    });
    
    $('#submitted-test-list').DataTable();

	$("#search-test").keyup(function(){
        $('#test-list').dataTable().fnFilter(this.value);
    });
});

$('#select-module').on('change', function() {
    var selected = $( "#select-module option:selected" ).text();
    var string = selected.replace(/^\s+|\s+$/g, "");
    $('#test-list').dataTable().fnFilter(string);
    if(selected == 'All')
    {
    	$('#test-list').dataTable().ajax.reload();
    }
});

$('.q-cb').click(function(){
	if($(this).is(':checked')) {
		selected.push($(this).attr('value'));
	} else {
		selected.pop($(this).attr('value'));
	}
});

$("#submit-test").click(function (){
	var questions = selected.join(',');
	var name = $('#test-name').val();
	if(questions == ''){
		alert('<?php echo _("Please select questions for this test."); ?>');
		e.preventDefault();
	} else if($.trim($('#test-name').val()) == '') {
		alert('<?php echo _("Please enter a name for this test."); ?>');
		e.preventDefault();
	} else {
		$.ajax({
			type	: "POST",
			url		: "submit-test.php",
			data	: {	tname: name, qids: questions },
			success	: function(data) {
				if(data == 0)
					alert('<?php echo _("A same test name already exists. Please change the name of the test."); ?>');
				else {
					alert('<?php echo _("Test Submitted"); ?>');
					window.location.href = document.referrer;
				}
			}
		});
	}
});

$('.btn.btn-portfilter').click(function () {
	$('.btn.btn-portfilter').removeClass('active');
	$(this).addClass('active');
});
</script>

<?php require_once "footer.php"; ?>