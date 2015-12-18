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

<div id="content" id="test_question_list">
	<div class="wrap">
		<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstName(); ?></span>!</h1>
		<p><?php echo _("This is your Dashboard. In this page, you can view all the questions in every modules."); ?><br><br></p>


		<input type="text" id="search-test" placeholder="<?php echo _('Search...'); ?>"> <br><br>
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
		<br><br>

		<table class="result morepad table table-striped table-bordered" id="dt-table">
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

	</div>
</div>

<script type="text/javascript" src="scripts/jquery.dataTables2.min.js"></script>
<script>

$(document).ready(function() {
	$('#dt-table').DataTable({
    	"iDisplayLength": 15,
        "bPaginate": true,
        "bFilter": true,
        "bInfo" : false,
        "aaSorting": [],
        responsive: true,
    });
	
	$("#search-test").keyup(function(){
        $('#dt-table').dataTable().fnFilter(this.value);
    });

    

});
$('#select-module').on('change', function() {
    	
    var selected = $( "#select-module option:selected" ).text();
    var string = selected.replace(/^\s+|\s+$/g, "");

    $('#dt-table').dataTable().fnFilter(string);

    if(selected == 'All')
    {
    	$('#dt-table').dataTable().ajax.reload();
    }

});

</script>

<?php require_once "footer.php"; ?>