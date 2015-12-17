<?php 
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/CumulativeTest.Controller.php';
	include_once 'controller/StudentCt.Controller.php';
	
	$userid 	= $user->getUserid();
	$ctid 		= $_GET['ctid'];
	$students 	= $uc->loadUserType(2, $userid);
	
	$ctc 		= new CumulativeTestController();
	$ct_set		= $ctc->getCumulativeTestByID($ctid);
	
	if($ct_set):
		$ctqid 		= explode(',',$ct_set->getQid());
	endif;
	
	$scc		= new StudentCtController();
?>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="ct-test.php">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="wrap">
	<h1><?php echo _("Students Cumulative Test Results"); ?></h1>
	<br>
	<span class="red upper bold"><?php echo _("Note:"); ?></span><br>
	<ul class="list_notes">
		<li><?php echo _("Click the column header to view the statistics for each question."); ?></li>
		<li><?php echo _("If the table is not displaying correctly, please refresh this page."); ?></li>
	</ul>
	<br>
	<?php 
		if(!isset($ct_set)):
			echo "<h3>"._("You have not set a cumulative test for this module.")."</h3>";
		else:
			$coltotal = array();
			$totalrow = 0;
			$ctr = 0;
	?>
	<div class="results ct_results">
		<table id="table_id2">
			<thead>	
				<tr>
					<th id="stdname"><?php echo _("Student Name"); ?></th>
					<?php 
						foreach($ctqid as $question):
							$coltotal[$ctr] = 0;
							$ctr++;
					?>
						<th id="qtns">
							<li>
								<a href="ct-stat.php?ctid=<?php echo $ctid; ?>&qid=<?php echo $question; ?>">Q#<?php echo $ctr; ?>
									<!-- <img src="images/appbar.link.png"> -->
								</a>
							</li>
						</th>
					<?php endforeach; ?>
					<th id="ttl"><?php echo _("Total %"); ?></th>
				</tr>
			</thead>	
			<tbody>
				<?php
					foreach($students as $student):
						$ct_set = $scc->getStudentCt($student['user_ID'],$ctid);
						if($ct_set) $sctid = $ct_set->getSCTID();
						
						$totalpt = 0;
						$cpt = 0;
				?>
				<tr>
					<td class="bold">
						<?php echo $student['last_name']; if ($student['last_name'] != '') echo ', '; echo $student['first_name'] ; ?>
					</td>
					<?php
						$ctr = 0;
						foreach($ctqid as $question):
							if($ct_set):
								$sanswer = $scc->getCTStudentAnswerByQuestion($sctid, $question);
									
								if($sanswer[0]['mark'] == 1):
									$cpt++;
									$coltotal[$ctr]++;
								endif;
								
								$totalpt++;
					?>
								<td><?php echo $sanswer[0]['mark']; ?></td>
					<?php 	else: ?>
									<td>—</td>
					<?php
							endif;
							
							$ctr++;
						endforeach;
					?>
					<td>
					<?php 
						if(isset($ct_set)):
							$totalrow += round(($cpt/$totalpt)*100);
							echo round(($cpt/$totalpt)*100, 0)."%";
						else:
							echo "0"."%";
						endif;
					?>
					</td>							
				</tr>
				<?php endforeach; ?>
				<tr>
					<td class="bold"><?php echo _("Total"); ?> (<?php echo count($students); ?>)</td>
					<?php foreach ($coltotal as $total): ?>
					<td class="bold"><?php echo number_format($total/count($students)*100).'%'; ?></td>
					<?php endforeach; ?>
					<td class="bold"><?php echo number_format($totalrow/count($students)).'%'; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php endif; ?>
</div>

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_top" data-tourtarget="#stdname">
    <p><?php echo _("This column lists all students in this student group."); ?></p>
  </li>
  <li class="tlypageguide_top" data-tourtarget="#qtns">
    <p><?php echo _("The heading represents the question items. Click the heading to show the statistics for that question. Scroll left and right to view all the students' information. Note that each question takes the value of 1 for the correct answer and 0 for the wrong answer."); ?></p>
  </li>
  <li class="tlypageguide_top" data-tourtarget="#ttl">
    <p><?php echo _("This column shows the percentage of the correct answer vs. the total number of questions taken in this test/module."); ?></p>
  </li>
</ul>

<script>
window.onresize = function() {
    $('#table_id2').dataTable().fnAdjustColumnSizing();
}

$(document).ready( function () {
 	var oTable = $('#table_id2').dataTable({
 		"sScrollX": "100%",
		"sScrollXInner": "120%",
		"responsive" : true,
 		"bScrollCollapse": true,
		"bSort": false,
		 "bPaginate": false,
 	});
	
 	new FixedColumns(oTable,{
 		"iLeftColumns": 1,
		"iLeftWidth": 150,
		"iRightColumns": 1,
		"iRightWidth": 90,
 	});

});
</script>
<?php require_once "footer.php"; ?>