<?php 
	require_once 'session.php';
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'php/functions.php';
	require_once 'controller/Exercise.Controller.php';
	require_once 'controller/Question.Controller.php';
	require_once 'controller/StudentAnswer.Controller.php';
	require_once 'controller/StudentModule.Controller.php';
	require_once 'controller/StudentGroup.Controller.php';
	require_once 'controller/GroupModule.Controller.php';
	
	$mid 		= $_GET['mid'];
	$gid		= $_GET['gid'];
	$userid 	= $user->getUserid();
	$students 	= $uc->loadUserType(2, $userid);
	
	$sgc		= new StudentGroupController();
	$stg		= $sgc->getUsersInGroup($gid);

	$dtc 		= new DiagnosticTestController();
	$gmc		= new GroupModuleController();
	$gm			= $gmc->getModuleGroupByID($gid, $mid);

	if($gm):
		$preid		= $gm[0]['pretest_id'];
		$postid		= $gm[0]['posttest_id'];
		
		if($preid  != 0):
			$dt_pre  = $dtc->getDiagnosticTestByID($preid);
			$qidpre  = explode(',', $dt_pre->getQid());
		endif;
		
		if($postid != 0):
			$dt_post = $dtc->getDiagnosticTestByID($postid);
			$qidpost = explode(',', $dt_post->getQid());
		endif;
	endif;
	
	$qs 	= new QuestionController();
	$sa 	= new StudentAnswerController();
	$ec 	= new ExerciseController();
	$smc 	= new StudentModuleController();
	
	$qc = $ec->loadExercisesByType($mid,0);
	$qq = $ec->loadExercisesByType($mid,1);
	
	$sdt		= new StudentDtController();
	
	$exercisetotal = count($qc) + count($qq);
	$coltotal = array();
	$totalrowtotal = 0;
	$ctr = 0;
	$modnotanswered = 0;
	$prenotanswered = 0;
	$postnotanswered = 0;
?>
<style>.list_notes { font-size: 14px; }</style>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="student-results.php?gid=<?php echo $gid; ?>&mid=<?php echo $mid; ?>">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="wrap">
<h1><?php echo _("Students Comparative Results"); ?></h1>

<span class="red upper bold"><?php echo _("Note:"); ?></span><br/>
<ul class="list_notes">
<li><?php echo _("Click the column header to view the statistics for each question."); ?></li>
<li><?php echo _("If the table is not displaying correctly, please refresh this page."); ?></li>
<li><?php echo _("Scroll left and right, and up and down, to view all your students' data."); ?></li>
</ul>
<br/>
<h3><?php echo _("Module Results"); ?></h3>
<br/>
<div class="results">
	<table id="table_id">
		<thead>
			<tr>		
				<th class="bold"><?php echo _("Student Name"); ?></th>
				<?php 
					foreach($qc as $exercise):
						$coltotal[$ctr] = 0; 
				?>
						<th>
							<li>
								<a href="statistics.php?e=<?php echo $exercise['exercise_ID']; ?>&mid=<?php echo $mid; ?>&gid=<?php echo $gid; ?>">
									<?php echo $exercise['shortcode'];?>
									<img src="images/appbar.link.png">
								</a>
							</li>
						</th>
				<?php 
						$ctr++;
					endforeach;
				?>
				<?php 
					foreach ($qq as $exercise):
						$coltotal[$ctr] = 0; 
				?>
						<th id="questions">
							<li>
								<a href="statistics.php?e=<?php echo $exercise['exercise_ID']; ?>&mid=<?php echo $mid; ?>&gid=<?php echo $gid; ?>">
									<?php echo $exercise['shortcode']; ?>
									<img src="images/appbar.link.png">
								</a>
							</li>
						</th>
				<?php 
						$ctr++;
					endforeach;
				?>
				<th class="bold" id="totala"><?php echo _("Total %"); ?></th>
			</tr>
		</thead>
		<tbody>
		   <?php 
				foreach($students as $student):
					if(in_array($student['user_ID'], $stg)):
						$rowtotal = 0;
						$ctr = 0;
						
						$sm = $smc->loadStudentModuleByUser($student['user_ID'],$mid);
						
						if($sm) $smid = $sm[0]['student_module_ID'];			
						
						$u = $uc->loadUserByID($student['user_ID']);
			?>
			<tr>
				<td id="studname" class="bold"><?php echo $u->getLastname(); if ($u->getLastname() != '') echo ', '; echo $u->getFirstname(); ?></td>
				<?php 
					foreach ($qc as $exercise):
						$score 		= 1;
						$answered 	= 0;
						
						if($sm):
							$eq = $qs->loadQuestions($exercise['exercise_ID']);

							foreach ($eq as $question):
								$answer = $sa->getStudentAnswer($smid,$question['question_ID']);

								if($answer):
									$answered = 1;
									if ($answer != $question['correct_answer']):
										$score = 0;
										break;
									endif;							
								endif;
								
							endforeach;
						else:
							$score = 0;
						endif;
					
						if($score == 1):
							$rowtotal++;
							$coltotal[$ctr]++;
						endif;
				?>
				<td><?php if($answered): echo $score; else: echo "—"; $modnotanswered++; endif; ?></td>
				<?php 
						$ctr++; 
					endforeach;
				?>
				<?php 
					foreach ($qq as $exercise):
						$score 		= 1;
						$answered 	= 0;
						
						if($sm):
							$eq = $qs->loadQuestions($exercise['exercise_ID']);
							
							foreach ($eq as $question):
								$answer = $sa->getStudentAnswer($smid,$question['question_ID']);
								
								if($answer):
									$answered = 1;
									if ($answer != $question['correct_answer']):
										$score = 0;
										break;
									endif;
								else:
									$score = 0;
									break;
								endif;
							endforeach;
						else:
							$score = 0;
						endif;
						
						if ($score == 1):
							$rowtotal++;
							$coltotal[$ctr]++;
						endif;
				?>
				<td><?php if($answered): echo $score; else: echo "—"; $modnotanswered++; endif; ?></td>
				<?php 
						$ctr++; 
					endforeach;
				?>
				<td class="bold" style="text-align:center">
					<?php 
						$totalrowtotal += number_format(($rowtotal/$exercisetotal)*100);
						echo number_format(($rowtotal/$exercisetotal)*100).'%'; 
					?>
				</td>
			</tr>
			<?php
					endif;
				endforeach;
			?>
			<?php
				$countusers = count($stg);
				$modanswerees = ceil($countusers-$modnotanswered/$ctr); ?><?php //echo $ctr; echo $notanswered; echo $countusers; ?>
			<tr>
				<td class="bold">
					<?php echo _("Total"); ?>: <?php echo $modanswerees; ?></td>
				<?php foreach ($coltotal as $total) { ?>
				<td class="bold"><?php echo number_format($total/$modanswerees*100).'%'; ?></td>
				<?php } ?>
				<td class="bold"><?php echo number_format($totalrowtotal/$modanswerees).'%'; ?></td>
			</tr> 
		</tbody>
	</table>
</div>

<?php 
	
	if(!isset($dt_pre)):
		echo "<h3>"._("You have not set a pre-test for this module.")."</h3>";
	else:
		$coltotal = array();
		$totalrow = 0;
		$ctr = 0;
?>
<h3><?php echo _("Pre-Diagnostic Test Results"); ?></h3><br>
<div class="results">
	<table id="table_id2">
		<thead>
			<tr>
				<th class="bold"><?php echo _("Student Name"); ?></th> 
				<?php 
					foreach($qidpre as $qpre):
						$coltotal[$ctr] = 0;
						$ctr++;
				?>
				<th>
					<li>
						<a href="dt-stat.php?dtid=<?php echo $preid; ?>&qid=<?php echo $qpre; ?>&page=comparative&gid=<?php echo $gid; ?>">Q#<?php echo $ctr; ?>
							<img src="images/appbar.link.png">
						</a>
					</li>
				</th>
				<?php endforeach; ?>
				<th class="bold"><?php echo _("Total %"); ?></th>
			</tr>
		</thead>	
		<tbody>
			<?php 
				foreach($students as $student):
					if(in_array($student['user_ID'], $stg)):
						$stest = $sdt->getSDTbyStudent($student['user_ID'],$preid);
						
						if($stest):
							$sdtid = $stest->getStudentDtID();
							$pretest = $sdt->getStudentAnswer($sdtid);
						endif;
						
						$totalpt = 0;
						$cpt = 0;
			?>
				<tr>
					<td class="bold">
						<?php echo $student['last_name']; if ($student['last_name'] != '') echo ', '; echo $student['first_name'] ; ?>
					</td>
			<?php
						$ctr = 0;
						foreach($qidpre as $qpre):
							if(isset($pretest)):
								foreach($pretest as $pt):
									if($pt['qid'] == $qpre):
										if($pt['mark'] == 1): 
											$cpt++;
											$coltotal[$ctr]++;
										endif;
										$totalpt++;
			?>
										<td><?php echo $pt['mark']; ?></td>
			<?php
									endif;
								endforeach;
							else:
			?>
									<td>—</td>
			<?php
							$prenotanswered++;
							endif;
							$ctr++;
						endforeach;
			?>
					<td>
			<?php 
						if(isset($pretest)):
							$totalrow += round(($cpt/$totalpt)*100);
							echo round(($cpt/$totalpt)*100, 0)."%";
						else:
							echo "0";
						endif;
						
						$pretest = null;
			?>
					</td>							
				</tr>
			<?php 
					endif;
				endforeach;
			?>
			<?php
				$countusers = count($stg);
				$preanswerees = ceil($countusers-$prenotanswered/$ctr); ?>
			<tr>
				<td class="bold"><?php echo _("Total"); ?>: <?php echo $preanswerees; ?></td>
				<?php foreach ($coltotal as $total): ?>
				<td class="bold"><?php echo number_format($total/$preanswerees*100).'%'; ?></td>
				<?php endforeach; ?>
				<td class="bold"><?php echo number_format($totalrow/$preanswerees).'%'; ?></td>
			</tr>
		</tbody>
	</table>
</div>
<?php endif; ?>


<?php 
	if(!isset($dt_post)):
		echo "<h3>"._("You have not set a post-test for this module.")."</h3>";
	else:
		$coltotal = array();
		$totalrow = 0;
		$ctr = 0;
?>
<h3><?php echo _("Post-Diagnostic Test Results"); ?></h3><br>
<div class="results">
	<table id="table_id3">
		<thead>
			<tr>
				<th class="bold"><?php echo _("Student Name"); ?></th>
				<?php 
					foreach($qidpost as $qpost):
						$coltotal[$ctr] = 0;
						$ctr++;
				?>
					<th>
						<li>
							<a href="dt-stat.php?dtid=<?php echo $postid; ?>&qid=<?php echo $qpost; ?>&page=comparative&gid=<?php echo $gid; ?>">Q#<?php echo $ctr; ?><img src="images/appbar.link.png"></a>
						</li>
					</th>
				<?php endforeach; ?>
				<th class="bold"><?php echo _("Total %"); ?></th>
			</tr>
		</thead>	
		<tbody>
			<?php
				foreach($students as $student):
					if(in_array($student['user_ID'], $stg)):
						$stest = $sdt->getSDTbyStudent($student['user_ID'],$postid);
						
						if($stest):
							$sdtid = $stest->getStudentDtID();
							$posttest = $sdt->getStudentAnswer($sdtid);
						endif;
						
						$totalpt = 0;
						$cpt = 0;
			?>
				<tr>
					<td class="bold">
						<?php echo $student['last_name']; if ($student['last_name'] != '') echo ', '; echo $student['first_name'] ; ?>
					</td>
			<?php
						$ctr = 0;
						foreach($qidpost as $qpost):
							if(isset($posttest)):
								foreach($posttest as $pt):
									if($pt['qid'] == $qpost):
										if($pt['mark'] == 1):
											$cpt++;
											$coltotal[$ctr]++;
										endif;
										$totalpt++;
			?>
										<td><?php echo $pt['mark']; ?></td>
			<?php
									endif;
								endforeach;
							else:
			?>
								<td>—</td>
			<?php
							$postnotanswered++;
							endif;
							$ctr++;
						endforeach;
			?>
					<td>
			<?php 
						if(isset($posttest)):
							$totalrow += round(($cpt/$totalpt)*100);
							echo round(($cpt/$totalpt)*100, 0)."%";
						else:
							echo "0";
						endif;
						
						$posttest = null;
			?>
					</td>							
				</tr>
			<?php 
					endif;
				endforeach;
			?>
			<?php
				$countusers = count($stg);
				$postanswerees = ceil($countusers-$postnotanswered/$ctr); ?>
			<tr>
				<td class="bold"><?php echo _("Total"); ?>: <?php echo $postanswerees; ?></td>
				<?php foreach ($coltotal as $total) { ?>
				<td class="bold"><?php echo number_format($total/$postanswerees*100).'%'; ?></td>
				<?php } ?>
				<td class="bold"><?php echo number_format($totalrow/$postanswerees).'%'; ?></td>
			</tr>
		</tbody>
	</table>
</div>
<?php endif; ?>

</div>
<script>
window.onresize = function() {
	$('#table_id').dataTable().fnAdjustColumnSizing();
    $('#table_id2').dataTable().fnAdjustColumnSizing();
	$('#table_id3').dataTable().fnAdjustColumnSizing();
}

$(document).ready( function () {
	var oTable = $('#table_id').dataTable( {
 		"sScrollX": "100%", 
		"sScrollXInner": "120%", 
		"sScrollY": "250px",
		"responsive" : true,
		"bSort": false,
		"bPaginate": false,	
 		"bScrollCollapse": true
 	} );
 	new FixedColumns( oTable, {
 		"iLeftColumns": 1,
		"iLeftWidth": 150,
		"iRightColumns": 1,
		"iRightWidth": 90
 	} );
	
 	var oTable = $('#table_id2').dataTable( {
 		"sScrollX": "100%", 
		"sScrollY": "250px",
		"sScrollXInner": "120%",
		"responsive" : true,		
		"bSort": false,
		"bPaginate": false,	
 		"bScrollCollapse": true
 	} );
 	new FixedColumns( oTable, {
 		"iLeftColumns": 1,
		"iLeftWidth": 150,
		"iRightColumns": 1,
		"iRightWidth": 90
 	} );
	
	var oTable = $('#table_id3').dataTable( {
 		"sScrollX": "100%", 
		"sScrollY": "250px",
		"sScrollXInner": "120%",
		"responsive" : true,		
		"bSort": false,
		 "bPaginate": false,
 		"bScrollCollapse": true
 	} );
 	new FixedColumns( oTable, {
 		"iLeftColumns": 1,
		"iLeftWidth": 150,
		"iRightColumns": 1,
		"iRightWidth": 90
 	} );
 } );
</script>
<!-- Tip Content -->
<ol id="joyRideTipContent">
	<li data-id="studname" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("This column lists all students in this student group."); ?></p>
	</li>
	<li data-id="questions" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("The top row contains the <strong>Quick Checks</strong> and <strong>Quiz Questions</strong>. These are clickable and will lead to the statistics page of the activity. Scroll left and right to view all the students' data."); ?></p>
	</li>
	<li data-id="totala" 		data-text="<?php echo _('Close'); ?>" data-options="tipLocation:left;tipAnimation:fade">
		<p><?php echo _("This column shows the percentage of the correct and wrong answers for a student. Note that an activity (a Quick Check or a Quiz Question) takes a value of <strong>1</strong> if all answers in that activity are correct, otherwise the value is <strong>0</strong>."); ?></p>
	</li>
</ol>

<script>
  function guide() {
  	$('#joyRideTipContent').joyride({
      autoStart : true,
      postStepCallback : function (index, tip) {
      if (index == 10) {
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