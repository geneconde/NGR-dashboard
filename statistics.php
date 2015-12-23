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

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="all-students-results.php?gid=<?php echo $gid; ?>&mid=<?php echo $mid; ?>">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="wrap">

<?php
if($language == "ar_EG") {
	echo "
	<script>
		var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;
		var pfCustomCSS = 'printfriendly.php'
		var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
	</script>";
} else {
	echo "
	<script>
		var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;
		var pfCustomCSS = 'printfriendly2.php'
		var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
	</script>";
}
?>

<h1><?php echo _("Exercise Statistics"); ?></h1>

<div class="btn">
	<a href="http://www.printfriendly.com" id="print" class="btn fleft" onclick="window.print();return false;" title="Printer Friendly and PDF"><span><i class="fa fa-print"></i><?php echo _('Print'); ?></span></a>
</div>
<div class="clear"></div>

<h3 class="result-title"><?php echo _($exercise['title']); ?> <?php echo _("Screenshot"); ?></h3>
<?php echo _("The image below is an actual screenshot of the exercise in the review. It shows the question items and the correct answers."); ?><br/><br/>
<?php
	$arr = explode('/', $exercise['screenshot']);
	array_splice($arr, 5, 0, $curlang );
	$ex_screenshot = implode("/", $arr);	
?>

<center><img id="xshot" src="<?php echo $ex_screenshot;?>" width="80%"></center>
<br>
<?php foreach ($eq as $question) { ?>
<h3 class="result-title"><?php echo _("Question") . " " . _($question['section']); ?> - <?php echo _($question['title']); ?></h3>
<?php echo _("Correct Answer"); ?>: <span class="green bold upper"><?php echo _($question['correct_answer']); ?> </span><br/>
<!-- <div id="<?php echo 'q1_'.$question['section'].$question['title']; ?>" class="pchart p1"></div> -->
<div id="<?php echo 'q2_'.$question['section'].$question['title']; ?>" class="pchart p2"></div>
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
		// chart = new google.visualization.PieChart(document.getElementById('<?php echo 'q1_'.$question['section'].$question['title']; ?>'));
		// chart.draw(data, options);
		
		<?php 
			$uniques = array_count_values($values);
			$arr = array(array('',''));
			foreach ($uniques as $key => $value):
				$temparr = array("$key",$value);
				array_push($arr,$temparr);
			endforeach;
			$cwpie = json_encode($arr);
			$temp = str_replace('[["",""],', '', $cwpie);
			$temp = str_replace('[', '', $temp);
			$temp = str_replace(']', '', $temp);
			$arr2 = explode(",", $temp);
			$arrTemp = array();

			foreach ($arr2 as $value) {
				if(is_numeric($value)) unset($value);
				else array_push($arrTemp, $value); 
			}
			$index = 99;
			if(in_array('"'._($question['correct_answer']).'"', $arrTemp)){
				$index = array_search('"'._($question['correct_answer']).'"', $arrTemp);
			}
			foreach ($arr2 as $value) {
				if(is_numeric($value)) unset($value);
			}
		?>
		data = google.visualization.arrayToDataTable(<?php echo $cwpie; ?>);
		options = { is3D: true, colors: ['#FF0000','#FF3030','#FF4040','#FF6666','#FFC1C1'],
			slices: {
	            <?php echo $index; ?>: { color: 'green' },
	         },
          	title: '<?php echo _("Student Answers Statistics"); ?>' }
		chart = new google.visualization.PieChart(document.getElementById('<?php echo 'q2_'.$question['section'].$question['title']; ?>'));
		chart.draw(data, options);
		<?php endforeach; ?>
  }
</script>

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_left" data-tourtarget="#xshot">
    <p><?php echo _("This page shows the information and statistics of a question or activity. This is the screenshot of the activity in the actual module."); ?></p>
  </li>
  <li class="tlypageguide_top" data-tourtarget=".p1">
    <p><?php echo _("This pie chart shows the percentage of the correct and wrong answers (for this item) of all the students who took the test."); ?></p>
  </li>
  <li class="tlypageguide_top" data-tourtarget=".p2">
    <p><?php echo _("This pie chart shows the percentage of the students who selected the same answer for this question (Example: Out of 5 students, 2 answered A and 3 answered B. Pie chart will show 40% for A and 60% or B)"); ?></p>
  </li>
</ul>

<?php require_once "footer.php"; ?>