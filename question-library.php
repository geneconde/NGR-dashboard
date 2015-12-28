<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/DtQuestion.Controller.php';
	
	$userid = $user->getUserid();

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
			<button class="btn-portfilter active" data-toggle="portfilter" data-target="Test Item List"><?php echo _('Test Item List'); ?></button>
			<button class="btn-portfilter" data-toggle="portfilter" data-target="Submit Test Item"><?php echo _('Submit Test Item'); ?></button>
			<button class="btn-portfilter" data-toggle="portfilter" data-target="Submitted Test Items"><?php echo _('Submitted Test Items'); ?></button>
		</div>
		
		<div class="clear"></div>

		<ul class="thumbnails gallery module-settings">
			<li class="clearfix settings-group" data-tag='Test Item List'>
				<h2><?php echo _("Test Item List"); ?></h2>
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
								<td>
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
			<li class="clearfix submit-test-item" data-tag='Submit Test Item'>
				<h2><?php echo _("Submit Test Item"); ?></h2>
			</li>
			<li class="clearfix submitted-test-items" data-tag='Submitted Test Items'>
				<h2><?php echo _("Submitted Test Items"); ?></h2>
			</li>
		</ul>

	</div>
</div>

<script type="text/javascript" src="scripts/jquery.dataTables2.min.js"></script>
<script src="scripts/bootstrap-portfilter.min.js"></script>
<script>

$(document).ready(function() {
	$('#test-list').DataTable({
    	"iDisplayLength": 15,
        "bPaginate": true,
        "bFilter": true,
        "bInfo" : false,
        "aaSorting": [],
        responsive: true,
    });
	
	$("#search-test").keyup(function(){
        $('#test-list').dataTable().fnFilter(this.value);
    });

});

$('.btn-portfilter').click(function () {
	$('.btn-portfilter').removeClass('active');
	$(this).addClass('active');
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

</script>

<?php require_once "footer.php"; ?>