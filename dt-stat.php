<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/DtQuestion.Controller.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/StudentDt.Controller.php';
	include_once 'controller/StudentGroup.Controller.php';
	
	$userid 	= $user->getUserid();
	$gid		= $_GET['gid'];
	$dtid 		= $_GET['dtid'];
	$qid		= $_GET['qid'];
	
	$sgc		= new StudentGroupController();
	$stg		= $sgc->getUsersInGroup($gid);
	$students 	= $uc->loadUserType(2, $userid);
	
	$dtq		= new DtQuestionController();
	$question	= $dtq->getTargetQuestion($qid);
	$answer		= $question[0]['answer'];
	$choices	= $dtq->getQuestionChoices($qid);
	
	$correct 	= 0;
	$wrong 		= 0;
	
	$sdt		= new StudentDtController();
	$answers	= array();
	
	foreach($choices as $choice):
		$answers[$choice['order']] = 0;
	endforeach;
	
	$arr = array(
			array('','')
		);
	
	foreach($students as $student):
		$sid	= $student['user_ID'];
		
		if(in_array($sid, $stg)):
			$st	= $sdt->getSDTbyStudent($sid, $dtid);

			if($st):
				$sanswer = $sdt->getStudentAnswerByQuestion($st->getStudentDtID(), $qid);
				$sa 	 = $sanswer[0]['answer'];
				$found = false;
				
				foreach($answers as $key => $value):
					if($sa == $key):
						$answers[$key]++;
						$found = true;
						break;
					endif;
				endforeach;
				
				if(!$found):
					$answers[$sa] = 1;
					$sta = array($sa, $answers[$sa]);
					array_push($arr, $sta);
				endif;
				
				if($answer == $sanswer[0]['answer']) $correct++;
				else $wrong++;
			endif;
		endif;
	endforeach;
	
	$dtc		= new DiagnosticTestController();
	$dt_set		= $dtc->getDiagnosticTestByID($dtid);	
	
	$mode		= $dt_set->getMode();
	$mid		= $dt_set->getModuleid();
?>
<style> #dbguide { display: none; } </style>
<div id="container">
<?php if($_GET['page']=="comparative") { ?>
<a class="link back" href="all-students-results.php?gid=<?php echo $gid; ?>&mid=<?php echo $mid; ?>">&laquo; <?php echo _("Go Back to Students Comparative Results"); ?></a>
<?php } else if($_GET['page']=="all") { ?>
<a class="link back" href="all-students-ct-results.php">&laquo; <?php echo _("Go Back to Students Cumulative Results"); ?></a>
<?php } ?>
<br><br>
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
<h1><?php echo _("Diagnostic Question Item Statistics"); ?>
<a href="http://www.printfriendly.com" style="float: right; color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF">
<img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a></h1>
<h3><?php echo _("Question Item Information"); ?></h3>
<br/>
<table border="0" class="result morepad">
	<tr>
		<td class="bold"><?php echo _("Diagnostic Test Title"); ?></td>
		<td>
			<?php
				if($mode == 1) echo _("Pre-Diagnostic Test");
				else if($mode == 2) echo _("Post-Diagnostic Test");
				else if($mode == 3) echo _("Cumulative Test");
			?>
		</td>
	</tr>
	<tr>
		<td class="bold"><?php echo _("Question"); ?></td>
		<td>
			<?php echo _($question[0]['question']); ?>
		</td>
	</tr>
	<tr>
		<td class="bold vtop"><?php echo _("Choices"); ?></td>
		<td>
			<?php
				foreach($choices as $choice):
					echo $choice['order'].". "._($choice['choice'])."<br/>";
				endforeach;
			?>
		</td>
	</tr>
	<tr>
		<td class="bold"><?php echo _("Answer"); ?></td>
		<td><?php echo $answer; ?></td>
	</tr>
</table>
<h3><?php echo _("Student Answer Statistics"); ?></h3>
<br/>
<p><?php echo _("The following pie chart shows the students' answers for this question and how many answered each question item's choices."); ?></p>
<div id="piechart1" style="width: 100%; height: 350px;"></div>
<br>
<div id="piechart2" style="width: 100%; height: 350px;"></div>
<br/>
</div>
<?php
	   
foreach($choices as $choice):
	$ch = array($choice['order'].". "._($choice['choice']), $answers[$choice['order']]);
	array_push($arr, $ch);
endforeach;

$piedata1 = json_encode($arr);

$arr	= 	array(
				array('',''),
				array(_('Correct'), $correct),
				array(_('Wrong'), $wrong)
			);
		
$piedata2 = json_encode($arr);
?>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data1 = google.visualization.arrayToDataTable(<?php echo $piedata1; ?>);
		var data2 = google.visualization.arrayToDataTable(<?php echo $piedata2; ?>);
        var options1 = { is3D: true };
		var options2 = { is3D: true, colors: ['green', 'firebrick'] }
        var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));
		var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
		
        chart1.draw(data1, options1);
		chart2.draw(data2, options2);
      }
</script>
<?php require_once "footer.php"; ?>