<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controller/DtQuestion.Controller.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controller/DiagnosticTest.Controller.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controller/StudentDt.Controller.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controller/TeacherModule.Controller.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controller/StudentModule.Controller.php';

function getQuestionIDs($moduleid, $userid, $mode) {
	$dtc 		= new DiagnosticTestController();
	$dt_set 	= $dtc->getDiagnosticTest($moduleid, $userid, $mode);
	$questions 	= explode(',',$dt_set->getQid());
	return $questions;
}

function checkPreTest($groupid, $mid, $userid) {
	$gmc		= new GroupModuleController();
	$gm_set		= $gmc->getModuleGroupByID($groupid, $mid);
	$result		= array(
		"output"	=> '',
		"result"	=> 0
	);
	
	if($gm_set && $gm_set[0]['pre_active'] == 1):
		$sdt		= new StudentDtController();
		$sdt_set	= $sdt->getSDTbyStudent($userid, $gm_set[0]['pretest_id']);
		
		if($sdt_set):
			$enddate = $sdt_set->getEndDate();
			
			if($enddate == "0000-00-00 00:00:00" || $enddate == "null"):
				$result['output']	.=	
							"<div class=\"clear\"></div>
							<div class=\"left-box fleft left-lower\">
								<p>"._("You have started the pre diagnostic test but did not finish it. You must finish the test first.")."</p>
							</div>
							<a class=\"take-box fright student-box\" href=\"take-dt.php?gid={$groupid}&mid={$mid}&dtid={$gm_set[0]['pretest_id']}&mode=pre\">
								<p class=\"dbl\">"._("Continue")."</p>
								<p class=\"dbl\">"._("Diagnostic")."</p>
								<p class=\"dbl\">"._("Test")."</p>
							</a>";
			else:
				$result['output']	.=	
							"<div class=\"module-nav fleft\">
								<a class=\"button1\" href=\"dt-results.php?sdtid={$sdt_set->getStudentDtID()}\">"
									._("Pre-Test")."<br/>"._("Results").
								"</a>
							</div>";
				$result['result'] = 1;
			endif;
		else:
			$result['output']	.=	
						"<div class=\"clear\"></div>
						<div class=\"left-box fleft left-lower\">
							<p>"._("A pre-test is available for you to take.")."</p>
						</div>
						<a class=\"take-box fright student-box\" href=\"take-dt.php?gid={$groupid}&mid={$mid}&dtid={$gm_set[0]['pretest_id']}&mode=pre\">
							<p class=\"dbl\">"._("Take Pre")."</p>
							<p class=\"dbl\">"._("Diagnostic")."</p>
							<p class=\"dbl\">"._("Test")."</p>
						</a>";
		endif;
	else:
		$result['result'] = 1;
	endif;
	
	return $result;
}

function checkGroupModule($groupid, $mid, $userid) {
	$gmc			= new GroupModuleController();
	$gm_set			= $gmc->getModuleGroupByID($groupid, $mid);
	$result			= array(
			"output"	=> '',
			"result"	=> 0
		);
	
	if($gm_set && $gm_set[0]['review_active']):
		$smc	= new StudentModuleController();
		$sm		= $smc->loadStudentModuleByUser($userid, $mid);
		array_push($_SESSION['modules'], $mid);
	
		if($sm):
			$enddate 	= $sm[0]['date_finished'];
			
			if($enddate == "0000-00-00 00:00:00" || $enddate == "null"):
				$lastscreen = $sm[0]['last_screen'];
				$continueid = $sm[0]['student_module_ID'];
				
				$result['output']	.=
									"<div class=\"clear\"></div>
									<div class=\"left-box fleft left-lower\">
										<p>"._("You have started this module but did not finish it. Click the button to continue where you left off.")."</p>
									</div>
									<a  class=\"take-box  dbl2 fright student-box\" href=\"take-dt-test.php?m={$mid}&smid={$continueid}&s={$lastscreen}\">
										<p class=\"dbl\">"._("Go To")."</p>
										<p class=\"dbl\">"._("Page")."</p>
										<p class=\"dbl\">{$lastscreen}</p>
									</a>";
			else:
				$smid 	= $sm[0]['student_module_ID'];
			
				$result['output'] 	.=
									"<div class=\"module-nav fleft\">
										<a class=\"button1\" href=\"results.php?smid={$smid}\">"
											._("Module")."<br/>"._("Results").
										"</a>
									</div>";
					
				if(!$gm_set[0]['post_active']):
					$result['output']	.=
										"<div class=\"clear\"></div>
										<div class=\"left-box fleft left-lower\">
											<p>"._("You are done with this module.")."</p>
										</div>
										<a class=\"take-box fright student-box\" href=\"take-test.php?m={$mid}\">"._("REVIEW")."<br/>"._("MODULE")."</a>";
				endif;
				
				$result['result'] = 1;
			endif;
		else:
			$result['output']	.=
								"<div class=\"clear\"></div>
								<div class=\"left-box fleft left-lower\">
									<p>"._("Click the button to the right to take this module. ")."</p>
								</div>
								<a class=\"take-box fright student-box\" href=\"take-test.php?m={$mid}\">"
									._("TAKE")."<br/>"._("MODULE").
								"</a>";
								// <p>"._("Thanks for taking the pre-test. Click the button to the right to take this module. ")."</p>
			
		endif;
	else:
		$result['output'] .= "<div class=\"clear\"></div>
							  <div class=\"left-box fleft left-lower\">
								<p>This module has not been activated yet.</p>
							  </div>";
		//$result['result'] = 1;
	endif;
	
	return $result;
}

function checkPostTest($groupid, $mid, $userid) {
	$gmc		= new GroupModuleController();
	$gm_set		= $gmc->getModuleGroupByID($groupid, $mid);
	$result		= array(
		"output"	=> '',
		"result"	=> 0
	);
	
	if($gm_set && $gm_set[0]['post_active'] == 1):
		$sdt		= new StudentDtController();
		$sdt_set	= $sdt->getSDTbyStudent($userid, $gm_set[0]['posttest_id']);
		
		if($sdt_set):
			$enddate = $sdt_set->getEndDate();
			
			if($enddate == "0000-00-00 00:00:00" || $enddate == "null"):
				$result['output']	.=	
							"<div class=\"module-nav fleft\">
								<a class=\"button1\" href=\"take-test.php?m={$mid}\">"
									._("Review")."<br/>"._("Module").
								"</a>
							</div>
							<div class=\"clear\"></div>
							<div class=\"left-box fleft left-lower\">
								<p>"._("You have started the post diagnostic test but did not finish it. You must finish the test first.")."</p>
							</div>
							<a class=\"take-box fright student-box\" href=\"take-dt.php?gid={$groupid}&mid={$mid}&dtid={$gm_set[0]['posttest_id']}&mode=post\">
								<p class=\"dbl\">"._("Continue")."</p>
								<p class=\"dbl\">"._("Diagnostic")."</p>
								<p class=\"dbl\">"._("Test")."</p>
							</a>";
			else:
				$result['output']	.=	
							"<div class=\"module-nav fleft\">
								<a class=\"button1\" href=\"dt-results.php?sdtid={$sdt_set->getStudentDtID()}\">"
									._("Post-Test")."<br/>"._("Results").
								"</a>
							</div>
							<div class=\"clear\"></div>
							<div class=\"left-box fleft left-lower\">
								<p>"._("You are done with this module.")."</p>
							</div>
							<a class=\"take-box fright student-box\" href=\"take-test.php?m={$mid}\">"._("REVIEW")."<br/>"._("MODULE")."</a>";

				$result['result'] = 1;
			endif;
		else:
			$result['output']	.=	
						"<div class=\"module-nav fleft\">
							<a class=\"button1\" href=\"take-test.php?m={$mid}\">"
								._("Review")."<br/>"._("Module").
							"</a>
						</div>
						<div class=\"clear\"></div>
						<div class=\"left-box fleft left-lower\">
							<p>"._("Thanks for completing the module. You can now take the post diagnostic test.")."</p>
						</div>
						<a class=\"take-box fright student-box\" href=\"take-dt.php?gid={$groupid}&mid={$mid}&dtid={$gm_set[0]['posttest_id']}&mode=post\">
							<p class=\"dbl\">"._("Take Post")."</p>
							<p class=\"dbl\">"._("Diagnostic")."</p>
							<p class=\"dbl\">"._("Test")."</p>
						</a>";
		endif;
	else:
		// $result['output']	.=
		// 					"<div class=\"clear\"></div>
		// 					 <div class=\"left-box fleft left-lower\">
		// 						<p>"._("You are done with this review.")."</p>
		// 					 </div>";
		$result['result'] = 1;
	endif;
	
	return $result;
}

function addDate($startdate, $timelimit) {
	$cd = strtotime($startdate);
	$newdate = date('Y-m-d G:i:s', mktime(date('G',$cd)  + (int)$timelimit[0], 
										  date('i',$cd)  + (int)$timelimit[1], 
										  date('s',$cd)  + (int)$timelimit[2], 
										  date('m',$cd), 
										  date('d',$cd),
										  date('Y',$cd)));
	return $newdate;
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>