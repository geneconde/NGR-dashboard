<?php 
ini_set('display_errors', 0);
	require_once '../session.php';
	require_once 'locale.php';
	include_once '../controller/DiagnosticTest.Controller.php';
	include_once '../controller/TeacherModule.Controller.php';
	include_once '../controller/Module.Controller.php';
	include_once '../controller/Language.Controller.php';
	include_once '../controller/User.Controller.php';
	include_once '../controller/Module.Controller.php';
	require_once '../controller/DiagnosticTest.Controller.php';
	require_once '../controller/StudentDt.Controller.php';
	include_once('../controller/Subscriber.Controller.php');
	include_once 'php/auto-generate.php';
	
	$sc = new SubscriberController();
	$sub = $sc->loadSubscriber($user->getSubscriber());

	//add parameter for is_deleted and is_archived later on method is under userController
	$student_count = $uc->countUserType($user->getSubscriber(), 2);

	$userid 			= $user->getUserid();
	$usertype			= $user->getType();
	$subid				= $user->getSubscriber();

	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

	$dtc = new DiagnosticTestController();
	$sdtc = new StudentDtController();
	$uc = new UserController();
	
	$mc = new ModuleController();
	$all_modules = $mc->getAllModules();

	$subheads = array();
	$is2ndLayer = $user->getSubheadid();

	if(isset($_GET['u'])){
		$getU = $_GET['u'];
		$gotU = $uc->getUserByUN($getU);
		if(sizeof($gotU)<=0){
			header("Location: statistics.php");
		} else {
			$gotUserID = $gotU[0]['user_ID'];

			$teachers = array();
			$query = "SELECT * from users where subscriber_id=$subid and subhead_id=".$gotUserID;
			$under_sub = $uc->select_custom($query);
			foreach ($under_sub as $value) {
				if($value['type'] == 0){
					array_push($teachers, $value);
				}
				if($value['type'] == 4){
					$result = getTeachers($value['user_ID'],$subid);
					foreach ($result as $value) {
						array_push($teachers, $value);
					}
				}
			}
		}
	}
	else if($usertype==3 || ($usertype==4 and empty($is2ndLayer))){
		$teachers = array();
		$query = "SELECT * from users where (type=4 or type=0) and subscriber_id=$subid and subhead_id is null";
		if($usertype==4 and empty($is2ndLayer)) $query = "SELECT * from users where subscriber_id=$subid and subhead_id=$userid";
		$check_for_subadmin = $uc->select_custom($query);
		foreach ($check_for_subadmin as $value) {
			if($value['type']==0){
				array_push($teachers, $value);
			}
			if($value['type']==4){
				$result = getTeachers($value['user_ID'],$subid);
				foreach($result as $teach){
					array_push($teachers, $teach);
				}
			}
			$subheads[$value['username']] = $teachers;
			$teachers = array();
		}
	}

	else if($usertype==4 and !empty($is2ndLayer)){
		$teachers = array();
		$query = "SELECT * from users where subscriber_id=$subid and subhead_id=".$userid;
		$under_sub = $uc->select_custom($query);
		foreach ($under_sub as $value) {
			if($value['type'] == 0){
				array_push($teachers, $value);
			}
			if($value['type'] == 4){
				$result = getTeachers($value['user_ID'],$subid);
				foreach ($result as $value) {
					array_push($teachers, $value);
				}
			}
		}
	}

	function getTeachers($id,$subid){
		$query = "SELECT * from users where subscriber_id=$subid and subhead_id=".$id;
		$teach = UserController::select_custom($query);
		$arr = array();
		foreach ($teach as $value) {
			if($value['type'] == 4){
				$result = getTeachers($value['user_ID'],$subid);
				foreach ($result as $value) {
					array_push($arr, $value);
				}
			} else{
				array_push($arr, $value);
			}
		}
		return $arr;
	}
?>

<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>

<head>
	<title>NexGenReady</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<style>
	#dbguide {display: none;}

    div.dataTables_wrapper {
    	width: 100%;
        margin: 0 auto;
    }
    #stats_length { margin-bottom: 5px; }
    .pn { background: #fff !important; }
    table { border: solid 1px #a0a0a0; }
    td, th { border-left: solid 1px #a0a0a0; border-right: solid 1px #a0a0a0; }
    .even_gradeC a,
    .even_gradeC a:visited,
    .even_gradeC a:focus,
    .even_gradeC a:hover
    { color: #000; text-decoration: none; }
    .fleft.back { margin-bottom: -15px; }
	a.current { color: gray; cursor: default; }
	</style>

	<link rel="stylesheet" href="css/jquery.dataTables.css" />
	<script src="scripts/jquery-1.8.2.min.js"></script> 
	<script src="scripts/jquery.dataTables.js"></script>
	<script src="scripts/dataTables.fixedColumns.min.js"></script>

</head>

<body>
	<div id="header">
		<a href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>
	</div>

	<div id="content">
	<br>
	<?php if (isset($user)) { ?>
	<div class="fright" id="logged-in">
		<?php echo _("You are currently logged in as"); ?> <span class="upper bold"><?php echo $user->getUsername(); ?></span>. <a class="link" href="../logout.php"><?php echo _("Logout?"); ?></a>
	</div>
	<?php } ?>
	<div class="clear"></div>

	<div class="fleft" id="language">
		<?php echo _("Language"); ?>:
		<?php
			if(!empty($teacher_languages)) :
				foreach($teacher_languages as $tl) : 
					$lang = $lc->getLanguage($tl['language_id']);
		?>
					<a class="uppercase manage-box" href="index.php?lang=<?php echo $lang->getLanguage_code(); ?>"/><?php echo $lang->getLanguage(); ?></a>
		<?php 
				endforeach; 
			else :
		?>
			<a class="uppercase manage-box" href="index.php?lang=en_US"/><?php echo _("English"); ?></a>
		<?php endif; ?>

	<a href="edit-languages.php" class="link"><?php echo _("Edit Languages"); ?></a>
	</div>
	<div id="dbguide"><button class="uppercase guide tguide" onClick="guide()">Guide Me</button></div>
	<div class="clear"></div>
	<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstName(); ?></span>!</h1>
	<div class="wrap-container">
		<div id="wrap">
			<div class="sub-headers">
				<h1><?php echo _('Statistics'); ?></h1>
				
				<p class="fleft"> * <?php echo _('Click the column title to filter it Ascending or Descending.'); ?></p><br>
				<p class="fleft"> * <?php echo _('Refresh your browser to fix the table.'); ?></p>
				<br><br>
				<div class="fright">
					<a href="index.php" class="link" style="display: inline-block;"><?php echo _('Manage Sub-Admin'); ?></a> | 
					<a href="manage-students.php" class="link" style="display: inline-block;"><?php echo _('Manage All Students'); ?></a> | 
					<a href="unassigned-students.php" class="link" style="display: inline-block;"><?php echo _('Unassigned Students'); ?></a> | 
					<a href="floating-accounts.php" class="link" style="display: inline-block;"><?php echo _('Floating Teachers'); ?></a> | 
					<a href="view-modules.php" class="link" style="display: inline-block;"><?php echo _('View Modules'); ?></a> | 
					<a href="statistics.php" class="link current" style="display: inline-block;"><?php echo _('Statistics'); ?></a>
				</div>
				<div class="clear"></div>
				<?php if(isset($_GET['u'])) : ?>
				<div class="fleft back">
					<a href="statistics.php" class="link"><?php echo _('Back'); ?></a>
				</div>
				<?php endif; ?>
			</div>
			<div class="clear"></div>

			<div style="margin:30px 0">
				<!-- start DataTable -->
				<!-- start for department -->
				<?php if(sizeof($subheads) < 1) : ?>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="stats">
					<thead>
						<tr>
							<th rowspan="2" class="pn"><?php echo _('Teacher name'); ?></th>
							<?php foreach ($all_modules as $module) : ?>
								<th colspan="2"><?php echo _($module['module_name']); ?></th>
							<?php endforeach; ?>
						</tr>
						<tr>
							<?php foreach ($all_modules as $module) : ?>
								<th>Pre</th>
								<th>Post</th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<?php
							$total_arr = array();
							$total_arr2 = array();
						?>
						<?php foreach ($teachers as $teacher) : ?>
						<?php
							$q = "SELECT * from users where type=2 and teacher_id=".$teacher['user_ID'];
							$students = $uc->select_custom($q);
						?>
						<tr class="even_gradeC" id="4">
							<td><?php echo $teacher['username']; ?></td>
						<!-- start pre test -->
							<?php $temp1 = 0; ?>
							<?php foreach ($all_modules as $module) : ?>
								<?php
									$percent = "0%";
									$number_of_correct_answers = 0;
									$dt_holder = $dtc->getTotalDiagnosticTest($teacher['user_ID'],$module['module_ID'],1);

									foreach ($students as $student) {
										$student_dt =  $sdtc->getStudentTestRecord($student['user_ID'],$module['module_ID'],1);
										if(!empty($student_dt)){
											$student_correct_answer = $sdtc->getTotalCorrectAnswers($student_dt[0]['student_dt_id']);
											$number_of_correct_answers += sizeof($student_correct_answer);
										}
									}
									if($number_of_correct_answers==0){
										$percent = "0%";
									} else {
										if(!empty($dt_holder)){
											$dt_questions = explode(",", $dt_holder[0]['qid']);
											$number_of_questions = sizeof($dt_questions);
											$total_temp = (($number_of_correct_answers/$number_of_questions/sizeof($students)) * 100);
											$percent = round($total_temp,2) . "%";
											$total_arr[$module['module_ID']] += $total_temp;
										}
									}
								?>
								<th><?php echo $percent; ?></th>
						<!-- end pre test -->
						<!-- start post test -->
								<?php
									$percent2 = "0%";
									$number_of_correct_answers2 = 0;
									$dt_holder = $dtc->getTotalDiagnosticTest($teacher['user_ID'],$module['module_ID'],2);

									foreach ($students as $student) {
										$student_dt =  $sdtc->getStudentTestRecord($student['user_ID'],$module['module_ID'],2);
										if(!empty($student_dt)){
											$student_correct_answer = $sdtc->getTotalCorrectAnswers($student_dt[0]['student_dt_id']);
											$number_of_correct_answers2 += sizeof($student_correct_answer);
										}
									}
									if($number_of_correct_answers2==0){
										$percent2 = "0%";
									} else {
										if(!empty($dt_holder)){
											$dt_questions = explode(",", $dt_holder[0]['qid']);
											$number_of_questions = sizeof($dt_questions);
											$total_temp = (($number_of_correct_answers2/$number_of_questions/sizeof($students)) * 100);
											$percent2 = round($total_temp,2) . "%";
											$total_arr2[$module['module_ID']] += $total_temp;
										}
									}
								?>
								<th><?php echo $percent2; ?></th>
							<!-- end post test -->
							<?php endforeach; ?>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<th><?php echo _('Average'); ?>:</th>
							<?php foreach ($all_modules as $module) : ?>
								<?php
									$pre_total = "0%";
									$post_total = "0%";
									if(isset($total_arr[$module['module_ID']]))
										$pre_total = round($total_arr[$module['module_ID']],2);
									if(isset($total_arr2[$module['module_ID']]))
										$post_total = round($total_arr2[$module['module_ID']],2);
								?>
								<th><?php echo (!empty($teachers) ? round($pre_total/sizeof($teachers),2)."%" : "0%"); ?></th>
								<th><?php echo (!empty($teachers) ? round($post_total/sizeof($teachers),2)."%" : "0%"); ?></th>
							<?php endforeach; ?>
						</tr>
					</tfoot>
				</table>
				<!-- end for department -->

				<!-- start for main -->
				<?php elseif (sizeof($subheads) >= 1 || ($usertype==4 and !empty($is2ndLayer))) : ?>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="stats">
					<thead>
						<tr>
							<th rowspan="2" class="pn"><?php echo _('Head/Sub-Admin'); ?></th>
							<?php foreach ($all_modules as $module) : ?>
								<th colspan="2"><?php echo _($module['module_name']); ?></th>
							<?php endforeach; ?>
						</tr>
						<tr>
							<?php foreach ($all_modules as $module) : ?>
								<th>Pre</th>
								<th>Post</th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<?php
							$pre_total_total = array();
							$post_total_total = array();
						?>
						<?php foreach ($subheads as $key => $sub) : ?>
							<tr class="even_gradeC" id="4">
								<td>
								<?php $check = $uc->getUserByUN($key); ?>
								<?php if($check[0]['type'] == '4'){ ?>
									<a href='statistics.php?u=<?php echo $key; ?>'><?php echo $key; ?></a>
								<?php } else { ?>
									<?php echo $key; ?>
								<?php } ?>
								</td>
							<?php
								$total_arr = array();
								$total_arr2 = array();
							?>
							<?php foreach ($sub as $teacher) : ?>
							<?php
								$q = "SELECT * from users where type=2 and teacher_id=".$teacher['user_ID'];
								$students = $uc->select_custom($q);
							?>
							<!-- start pre test -->
								<?php foreach ($all_modules as $module) : ?>
									<?php
										$percent = "0%";
										$computed_value = 0;
										$number_of_correct_answers = 0;
										$dt_holder = $dtc->getTotalDiagnosticTest($teacher['user_ID'],$module['module_ID'],1);

										foreach ($students as $student) {
											$student_dt =  $sdtc->getStudentTestRecord($student['user_ID'],$module['module_ID'],1);
											if(!empty($student_dt)){
												$student_correct_answer = $sdtc->getTotalCorrectAnswers($student_dt[0]['student_dt_id']);
												$number_of_correct_answers += sizeof($student_correct_answer);
											}
										}
										if($number_of_correct_answers==0){
											$percent = "0%";
										} else {
											if(!empty($dt_holder)){
												$dt_questions = explode(",", $dt_holder[0]['qid']);
												$number_of_questions = sizeof($dt_questions);
												$total_temp = (($number_of_correct_answers/$number_of_questions/sizeof($students)) * 100);
												$percent = round($total_temp,2) . "%";
												$computed_value = $computed_value + $total_temp;
												$total_arr[$module['module_ID']] = $computed_value;
											}
										}
									?>
							<!-- end pre test -->
							<!-- start post test -->
									<?php
										$percent2 = "0%";
										$computed_value2 = 0;
										$number_of_correct_answers2 = 0;
										$dt_holder = $dtc->getTotalDiagnosticTest($teacher['user_ID'],$module['module_ID'],2);

										foreach ($students as $student) {
											$student_dt =  $sdtc->getStudentTestRecord($student['user_ID'],$module['module_ID'],2);
											if(!empty($student_dt)){
												$student_correct_answer = $sdtc->getTotalCorrectAnswers($student_dt[0]['student_dt_id']);
												$number_of_correct_answers2 += sizeof($student_correct_answer);
											}
										}
										if($number_of_correct_answers2==0){
											$percent2 = "0%";
										} else {
											if(!empty($dt_holder)){
												$dt_questions = explode(",", $dt_holder[0]['qid']);
												$number_of_questions = sizeof($dt_questions);
												$total_temp = (($number_of_correct_answers2/$number_of_questions/sizeof($students)) * 100);
												$percent2 = round($total_temp,2) . "%";
												$computed_value2 = $computed_value2 + $total_temp;
												$total_arr2[$module['module_ID']] = $computed_value2;
											}
										}
									?>
								<!-- end post test -->
								<?php endforeach; ?>
							<?php endforeach; ?>
							<?php foreach ($all_modules as $module) : ?>
								<?php
									$pre_total = 0;
									$post_total = 0;
									if(isset($total_arr[$module['module_ID']])){
										$pre_total = round($total_arr[$module['module_ID']],2);
										$pre_total = round($pre_total/sizeof($sub),2);
										$pre_total_total[$module['module_ID']] += $pre_total;
									}
									if(isset($total_arr2[$module['module_ID']])){
										$post_total = round($total_arr2[$module['module_ID']],2);
										$post_total = round($post_total/sizeof($sub),2);
										$post_total_total[$module['module_ID']] += $post_total;
									}
								?>
								<td><?php echo (!empty($sub) ? $pre_total."%" : "0%"); ?></td>
								<td><?php echo (!empty($sub) ? $post_total."%" : "0%"); ?></td>
							<?php endforeach; ?>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<th><?php echo _('Average'); ?>:</th>
							<?php foreach ($all_modules as $module) : ?>
								<?php
									$pre_total = "0%";
									$post_total = "0%";
									if(isset($pre_total_total[$module['module_ID']]))
										$pre_total = round($pre_total_total[$module['module_ID']],2);
									if(isset($post_total_total[$module['module_ID']]))
										$post_total = round($post_total_total[$module['module_ID']],2);
								?>
								<th><?php echo (!empty($subheads) ? round($pre_total/sizeof($subheads),2)."%" : "0%"); ?></th>
								<th><?php echo (!empty($subheads) ? round($post_total/sizeof($subheads),2)."%" : "0%"); ?></th>
							<?php endforeach; ?>
						</tr>
					</tfoot>
				</table>
				<!-- end for main -->
			<?php endif; ?>
				<!-- end DataTable -->
			</div>
		</div>
	</div>
</div>

<!-- start footer -->
<div id="footer" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
	<div class="copyright">
		<p>© 2014 NexGenReady. <?php echo _("All Rights Reserved."); ?>
		<a class="link f-link" href="../../marketing/privacy-policy.php"><?php echo _("Privacy Policy"); ?></a> | 
		<a class="link f-link" href="../../marketing/terms-of-service.php"><?php echo _("Terms of Service"); ?></a>

		<a class="link fright f-link" href="../../marketing/contact.php"><?php echo _("Need help? Contact our support team"); ?></a>
		<span class="fright l-separator">|</span>
		<a class="link fright f-link" href="../../marketing/bug.php"><?php echo _("File Bug Report"); ?></a>
		</p>
	</div>
</div>
<!-- end footer -->

<script>
window.onresize = function() {
	$('#stats').dataTable().fnAdjustColumnSizing();
}
$(document).ready(function() {
    var table = $('#stats').DataTable( {
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        fixedColumns:   {
            leftColumns: 1
        },
        "columnDefs": [{
        	"width": "10%", "targets": 0
		}]
    } );

	$("a.current").click(function(){
		event.preventDefault();
	});
});
</script>
</body>
</html>