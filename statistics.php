<?php 
	require_once 'session.php';
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'controller/StudentModule.Controller.php';
	require_once 'controller/Exercise.Controller.php';
	require_once 'controller/Question.Controller.php';
	require_once 'controller/StudentAnswer.Controller.php';
	require_once 'controller/StudentGroup.Controller.php';
	
	$userid = $user->getUserid();
	$mid 	= $_GET['mid'];
	$gid	= $_GET['gid'];
	$e 		= $_GET['e'];
	
	$sgc		= new StudentGroupController();
	$stg		= $sgc->getUsersInGroup($gid);
	
	$students = $uc->loadUserType(2, $userid);
	$smid = [];
	
	$smc = new StudentModuleController();
	
	foreach($students as $student):
		if(in_array($student['user_ID'], $stg)):
			$student_module = [];
			$student_module = $smc->loadStudentModuleByUser($student['user_ID'], $mid);
			if($student_module) array_push($smid, $student_module[0]['student_module_ID']);
		endif;
	endforeach;
	
	$ec = new ExerciseController();
	$exercise = $ec->getExercise($e);
	
	$qc = new QuestionController();
	$eq = $qc->loadQuestions($e);
	
	$sac = new StudentAnswerController();

	if($_SESSION["lang"] == 'en_US') $curlang = "english";
	else if($_SESSION["lang"] == "ar_EG") $curlang = "arabic";
	else if($_SESSION["lang"] == "es_ES") $curlang = "spanish";
	else if($_SESSION["lang"] == "zh_CN") $curlang = "chinese";	
?>
<div id="container">
<a class="link" href="all-students-results.php?gid=<?php echo $gid; ?>&mid=<?php echo $mid; ?>">&laquo <?php echo _("Go Back"); ?></a>
<h1><?php echo _("Exercise Statistics"); ?> <a href="http://www.printfriendly.com" style="float: right; color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a></h1>
<h3><?php echo _($exercise['title']); ?> <?php echo _("Screenshot"); ?></h3>
<?php echo _("The image below is an actual screenshot of the exercise in the review. It shows the question items and the correct answers."); ?><br/><br/>
<?php
	$arr = explode('/', $exercise['screenshot']);
	array_splice($arr, 5, 0, $curlang );
	$ex_screenshot = implode("/", $arr);
	
?>
<center><img src="<?php echo $ex_screenshot;?>" width="80%"></center>
<br/>
<?php foreach ($eq as $question) { ?>
<h3><?php echo _("Question") . " " . _($question['section']); ?> - <?php echo _($question['title']); ?></h3>
<?php echo _("Correct Answer"); ?>: <span class="green bold upper"><?php echo _($question['correct_answer']); ?> </span><br/>
<div id="<?php echo 'q1_'.$question['section'].$question['title']; ?>" class="pchart"></div>
<div id="<?php echo 'q2_'.$question['section'].$question['title']; ?>" class="pchart"></div>
<div class="clear"></div>
<?php } ?>
</div>
<script>
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawPie);	  
	function drawPie(){
		var data, options,chart;
		<?php 
			foreach ($eq as $question):
			
				if($question['correct_answer']) $correct = _($question['correct_answer']);
				else $correct = "None";
				
				$values = [];
				
				foreach($smid as $sm):
					$answers = $sac->getQuestionAnswersByStudent($question['question_ID'], $sm);
					array_push($values, _($answers[0]['answer']));
				endforeach;
				
				$c = 0;
				$w = 0;
				
				foreach ($values as $v):
					if ($v == $correct) $c++;
					else $w++;
				endforeach;
				
				$arr = array(array('Tst','t'),array(_('Correct'), $c),array(_('Wrong'), $w));
				$cwpie = json_encode($arr);
		?>
		data = google.visualization.arrayToDataTable(<?php echo $cwpie; ?>);
		options = { is3D: true, colors: ['green', 'red'], title: '<?php echo _("Correct and Wrong Statistics"); ?>' }
		chart = new google.visualization.PieChart(document.getElementById('<?php echo 'q1_'.$question['section'].$question['title']; ?>'));
		chart.draw(data, options);
		
		<?php 
				$uniques = array_count_values($values);
				$arr = array(array('',''));
				foreach ($uniques as $key => $value):
					$temparr = array("$key",$value);
					array_push($arr,$temparr);
				endforeach;
				$cwpie = json_encode($arr);
		?>
		data = google.visualization.arrayToDataTable(<?php echo $cwpie; ?>);
		options = { is3D: true, title: '<?php echo _("Student Answers Statistics"); ?>' }
		chart = new google.visualization.PieChart(document.getElementById('<?php echo 'q2_'.$question['section'].$question['title']; ?>'));
		chart.draw(data, options);	
		<?php endforeach; ?>
  }
</script>
<?php require_once "footer.php"; ?>