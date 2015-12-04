<?php 
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.5.2
 * @license: see license.txt included in package
 */

/*NGR Files*/
ini_set('display_errors', 1);
	require_once '../session.php';
	require_once '../locale.php';
	include_once '../controller/DiagnosticTest.Controller.php';
	include_once '../controller/TeacherModule.Controller.php';
	include_once '../controller/Module.Controller.php';
	include_once '../controller/Language.Controller.php';
	include_once '../controller/User.Controller.php';
	include_once('../controller/Subscriber.Controller.php');
	include_once '../php/auto-generate-students.php';
	
	$sc = new SubscriberController();
	$sub = $sc->loadSubscriber($user->getSubscriber());

	//add parameter for is_deleted and is_archived later on method is under userController
	//$student_count = $uc->countUserType($user->getSubscriber(), 2);
	
	$userid 			= $user->getUserid();
	$usertype			= $user->getType();
	$subid				= $user->getSubscriber();
	$create_date		= date('Y-m-d G:i:s');
	$current_date		= date('Y-m-d G:i:s');
	$expire_date		= date('Y-m-d G:i:s', strtotime("+30 days"));
	$updated_at 		= date('Y-m-d H:i:s');

	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

	$uc = new UserController();

	if(isset($_GET['unassign']) && $_GET['unassign'] == 1){
		$uc->updateStudentTeacher($_GET['user_id']);
		header("Location: manage-students.php");
	}

	// include db config
	include_once("config.php");

	// set up DB
	mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
	mysql_select_db(PHPGRID_DBNAME);

	// include and create object
	include(PHPGRID_LIBPATH."inc/jqgrid_dist.php");

	$username = _('Username');
	$password = _('Password');
	$first_name = _('First Name');
	$last_name = _('Last Name');
	$gender = _('Gender');
	$grade_level = _('Grade Level');
	$reset_student_password = _('Reset Student password');
	$reset_password = _('Reset password');
	$student_portfolio = _('Student Portfolio');
	$student_information = _('Student Information');
	$view_portfolio = _('View Portfolio');

	/** Main Grid Table **/
	$col = array();
	$col["title"] = "User ID"; // caption of column
	$col["name"] = "user_id";
	$col["editable"] = false;
	$col["export"] = false; // this column will not be exported
	$col["name"] = "user_ID"; 
	$col["width"] = "10";
	$col["hidden"] = true;
	$cols[] = $col;

	$col = array();
	$col["title"] = $username;
	$col["name"] = "username";
	$col["width"] = "30";
	$col["search"] = true;
	// $col["searchoptions"] = array("defaultValue"=>'username'); 
	$col["searchoptions"] = array("attr"=>array("placeholder"=>'Search Username...')); 
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true; // this column will not be exported
	// $col["formoptions"] = array("elmsuffix"=>'<font color=red> *</font>');
	$cols[] = $col;

	// $col = array();
	// $col["title"] = $password;
	// $col["name"] = "password";
	// $col["width"] = "30";
	// $col["search"] = true;
	// $col["editable"] = true;
	// $col["align"] = "center";
	// $col["export"] = true; // this column will not be exported
	// // $col["formoptions"] = array("elmsuffix"=>'<font color=red> *</font>');
	// $cols[] = $col;

	$col = array();
	$col["title"] = "Type";
	$col["name"]  = "type";
	$col["editable"] = true;
	$col["width"] = "10";
	$col["editoptions"] = array("defaultValue"=>"2","readonly"=>"readonly", "style"=>"border:0");
	$col["viewable"] = false;
	$col["hidden"] = true;
	$col["editrules"] = array("edithidden"=>hidden); 
	$col["export"] = false; // this column will not be exported
	$cols[] = $col;

	$col = array();
	$col["title"] = $first_name;
	$col["name"] = "first_name";
	$col["width"] = "30";
	$col["search"] = true;
	$col["searchoptions"] = array("attr"=>array("placeholder"=>'Search First Name...')); 
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true; 
	$cols[] = $col;

	$col = array();
	$col["title"] = $last_name;
	$col["name"] = "last_name";
	$col["width"] = "30";
	$col["search"] = true;
	$col["searchoptions"] = array("attr"=>array("placeholder"=>'Search Last Name...')); 
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true; 
	$cols[] = $col;

	$col = array();
	$col["title"] = $gender;
	$col["name"] = "gender";
	$col["width"] = "10";
	$col["search"] = true;
	$col["stype"] = "select";
	$col["searchoptions"] = array("value"=>'M:M;F:F');
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true;
	$col["edittype"] = "select";
	$col["editoptions"] = array("value"=>'M:M;F:F');
	$cols[] = $col;

	//$col = array();
	//$col["title"] = "Students";
	//$col["name"] = "students";
	//$col["width"] = "10";
	//$col["editrules"] = array("number"=>true); 
	//$col["search"] = false;
	//$col["editable"] = true;
	//$col["align"] = "center";
	//$col["export"] = true; // this column will not be exported
	// $col["formoptions"] = array("elmsuffix"=>'<font color=red> *</font>');
	//$cols[] = $col;

	$col = array();
	$col["title"] = "Teacher ID";
	$col["name"]  = "teacher_id";
	$col["editable"] = true;
	$col["width"] = "10";
	$col["editoptions"] = array("defaultValue"=>"$userid","readonly"=>"readonly", "style"=>"border:0");
	$col["viewable"] = false;
	$col["hidden"] = true;
	$col["editrules"] = array("edithidden"=>false); 
	$col["export"] = false; // this column will not be exported
	$cols[] = $col;

	$col = array();
	$col["title"] = "Subscriber ID";
	$col["name"]  = "subscriber_id";
	$col["editable"] = true;
	$col["editoptions"] = array("defaultValue"=>"$userid","readonly"=>"readonly", "style"=>"border:0");
	$col["viewable"] = false;
	$col["hidden"] = true;
	$col["editrules"] = array("edithidden"=>false); 
	$col["export"] = false; // this column will not be exported
	$cols[] = $col;

	$col = array();
	$col["title"] = $grade_level; // caption of column
	$col["name"]  = "grade_level";
	$col["searchoptions"] = array("attr"=>array("placeholder"=>'Search Level...')); 
	$col["width"] = "17";
	$col["editable"] = true;
	$col["align"] = "center";
	$cols[] = $col;

	$col = array();
	$col["title"] = "Is Deleted";
	$col["name"]  = "is_deleted";
	$col["editable"] = false;
	$col["viewable"] = true;
	$col["hidden"] = true;
	$col["editrules"] = array("edithidden"=>true); 
	$col["export"] = false; // this column will not be exported
	$cols[] = $col;

	$col = array();
	$col["title"] = $reset_student_password;
	$col["name"] = "reset_pword";
	$col["width"] = "25";
	$col["align"] = "center";
	$col["search"] = false;
	$col["sortable"] = false;
	$col["link"] = "../reset-password.php?user_id={user_ID}"; // e.g. http://domain.com?id={id} given that, there is a column with $col["name"] = "id" exist
	// $col["linkoptions"] = "target='_blank'"; // extra params with <a> tag
	$col["default"] = $reset_password; // default link text
	$col["export"] = false; // this column will not be exported
	$cols[] = $col;

	$col = array();
	$col["title"] = $student_portfolio;
	$col["name"] = "view_more";
	$col["width"] = "25";
	$col["align"] = "center";
	$col["search"] = false;
	$col["sortable"] = false;
	$col["link"] = "../view-portfolio.php?user_id={user_ID}"; // e.g. http://domain.com?id={id} given that, there is a column with $col["name"] = "id" exist
	$col["linkoptions"] = "target='_blank'";
	$col["default"] = $view_portfolio; // default link text
	$col["export"] = false; // this column will not be exported
	$cols[] = $col;

	$col = array();
	$col["title"] = "Action";
	$col["name"] = "act";
	$col["width"] = "50";
	$cols[] = $col;

	$col = array();
	$col["title"] = "";
	$col["name"] = "unassign";
	$col["width"] = "15";
	$col["align"] = "center";
	$col["search"] = false;
	$col["sortable"] = false;
	$col["link"] = 'javascript:
	var conf = confirm("Are you sure you want to unassign this student?");
	if(conf==true) {
		var conf2 = confirm("Proceeding with this will automatically remove the account from the list of students. Kindly contact the subscriber to retrieve the account again. Are you sure you want to do this?");
		if(conf2==true) window.location = "manage-students.php?user_id={user_ID}&unassign=1";
	}';
	$col["default"] = "unassign";
	$col["export"] = false;
	$cols[] = $col;

	$grid = new jqgrid();

	$opt["caption"] = $student_information;
	$opt["height"] = "";
	$opt["autowidth"] = true; // expand grid to screen width
	$opt["multiselect"] = true; // allow you to multi-select through checkboxes
	$opt["hiddengrid"] = false;
	$opt["reloadedit"] = true;

	//Export Options
	$opt["export"] = array("filename"=>"Student Information", "heading"=>"Student Information", "orientation"=>"landscape", "paper"=>"a4");
	$opt["export"]["sheetname"] = "Student Information";
	$opt["export"]["range"] = "filtered";
	$grid->set_options($opt);

	$e["on_update"] = array("update_student", null, true);
	$grid->set_events($e);

	function update_student($data)
	{
		$data["params"]["username"] = trim($data["params"]["username"]);
	}

	$grid->debug = 0;
	$grid->error_msg = "Username Already Exists.";

	$result = mysql_query("SELECT * FROM users WHERE teacher_id = $userid AND type = 2");
	$student_count = mysql_num_rows($result);

	$result2 = mysql_query("SELECT * FROM users WHERE user_ID = $userid");

	// count teachers no of students and the limit of students
	$row = mysql_fetch_assoc($result2);
	$student_limit = $row['students'];

	$difference = $student_limit - $student_count;

	if($student_limit != $student_count && $student_limit >= $student_count) :
	$grid->set_actions(array(
				"add"=>true, // allow/disallow add
				"edit"=>true, // allow/disallow edit
				"delete"=>false, // allow/disallow delete
				"bulkedit"=>true, // allow/disallow edit
				"export_excel"=>true, // export excel button
				//"export_pdf"=>true, // export pdf button
				//"export_csv"=>true, // export csv button
				//"autofilter" => true, // show/hide autofilter for search
				"rowactions"=>true, // show/hide row wise edit/del/save option
				// "showhidecolumns" => true,
				"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
		));
	else :
	 	$grid->set_actions(array(
	 				"add"=>false, // allow/disallow add
	 				"edit"=>true, // allow/disallow edit
	 				"delete"=>false, // allow/disallow delete
	 				"bulkedit"=>true, // allow/disallow edit
	 				"export_excel"=>true, // export excel button
	 				//"export_pdf"=>true, // export pdf button
	 				//"export_csv"=>true, // export csv button
	 				//"autofilter" => true, // show/hide autofilter for search
	 				"rowactions"=>true, // show/hide row wise edit/del/save option
	 				// "showhidecolumns" => true,
	 				"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
	 		));
	 endif;

	$grid->select_command = "SELECT * FROM users WHERE teacher_ID = $userid AND type = 2";

	$grid->table = "users";

	$grid->set_columns($cols); // pass the cooked columns to grid

	$main_view = $grid->render("list1");

	if(isset($_POST['addmultiple'])){
		if($_POST['student_num'] != "") {
			if($_POST['student_num'] > $difference){
				header("Location: manage-students.php?err=1");
			} else {
				generateStudents($_POST['student_num'], $user->getSubscriber(), $user->getUserid());
				header("Location: manage-students.php?msg=1");
			}
		} else {
			header("Location: manage-students.php?err=2");
		}
			
	}


?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>

<head>
	<title>NexGenReady</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<link rel="stylesheet" href="../libraries/joyride/joyride-2.1.css">
	<style>
		.joytest2 ~ div a:nth-child(3){ display: none; }
		.ui-icon { display: inline-block !important; }
		#delmodlist1 { width: auto !important; }

		/*Custom joyride*/
		.joyride-tip-guide:nth-child(7){
			margin-top: 20px !important;
		}
		.joyride-tip-guide:nth-child(9){
			margin-top: 20px !important;
		    margin-left: -30px !important;
		}
		.joyride-tip-guide:nth-child(10){
		    margin-left: -30px !important;
		}
		.joyride-tip-guide:nth-child(11){
		    margin-top: 5px !important;
		    margin-left: -20px !important;
		}
		.joyride-tip-guide:nth-child(12){
		    margin-left: -20px !important;
		}
		.joyride-tip-guide:nth-child(13){
			margin-top: 5px !important;
		    margin-left: -23px !important;
		}
		.joyride-tip-guide:nth-child(14){
			margin-top: 5px !important;
		    margin-left: -23px !important;
		}
		.joyride-tip-guide:nth-child(15){
			margin-top: 3px !important;
		    margin-left: -25px !important;
		}
		/*End custom joyride*/

		tr td:nth-child(15) a {
		  background: rgb(66, 151, 215);
		  color: #fff;
		  padding: 3px 5px;
		  border-radius: 3px;
		}
		tr td:nth-child(15) a:hover, tr td:nth-child(15) a:link, tr td:nth-child(15) a:visited, tr td:nth-child(15) a:focus {
			color: #fff;
		}
		#list1_act { width: auto !important; }
		tr input { width: 90% !important; }
		.ui-jqgrid .ui-search-input input { width: 100% !important; }
		.ui-pg-input { width: auto !important; }
		.ui-icon-pencil { float: none; }
		#list1_act > #jqgh_list1_act { margin-bottom: -15px; }
		.ui-pg-input { width: 25px !important; }
		.phpgrid input.editable { width: 90% !important; }
		.link.back { left: 81px; margin-top: 6px; }
	</style>

	<script src="../phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en-students.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="../phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

	<!-- Run the plugin -->
    <script type="text/javascript" src="../libraries/joyride/jquery.cookie.js"></script>
    <script type="text/javascript" src="../libraries/joyride/modernizr.mq.js"></script>
    <script type="text/javascript" src="../libraries/joyride/jquery.joyride-2.1.js"></script>
	<?php
	if($language == "ar_EG") { ?> <script src="lib/js/jqgrid/js/i18n/grid.locale-ar.js" type="text/javascript"></script>
	<?php }
	if($language == "es_ES") { ?> <script src="lib/js/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<?php }
	if($language == "zh_CN") { ?> <script src="lib/js/jqgrid/js/i18n/grid.locale-cn.js" type="text/javascript"></script>
	<?php }
	?>
</head>

<body>
<div id="header">
	<a class="logo fleft" href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>
	<div class="fright" id="logged-in">
		<?php echo _("You are currently logged in as"); ?> <span class="upper bold"><?php echo $user->getUsername(); ?></span>. <a class="link fright" href="../logout.php"><?php echo _("Logout?"); ?></a>
	</div>
</div>

<div id="content">
	<div class="top-buttons">
		<div id="dbguide"><button class="uppercase fleft guide tguide" onClick="guide()">Guide Me</button></div>
	</div>

	<!-- messages -->
	<?php if(isset($_GET['err'])) : ?>
		<?php if($_GET['err'] == 1) : ?>
			<!-- <div class="error-msg"><p><?php echo _('Error! you are only allowed to create'); ?> <?php echo $student_limit; ?> <?php echo _('students'); ?></p></div> -->
		<?php endif; ?>
		<?php if($_GET['err'] == 2) : ?>
			<div class="error-msg"><p><?php echo _('Please input a valid student value.'); ?></p></div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if(isset($_GET['msg'])) : ?>
		<?php if($_GET['msg'] == 1) : ?>
			<div class="success-msg" style="background-color: green; padding: 5px; text-align: center;"><p style="color: white;"><?php echo _('Successfully created students.'); ?></p></div>

		<?php endif; ?>
	<?php endif; ?>
	<!-- end messages -->

	<a class="link back" href="../teacher.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>
	<br><br>
	<div class="clear"></div>
	<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstName(); ?></span>!</h1>
	<p><?php echo _("This is your Dashboard. In this page, you can manage your students information"); ?>
	<!-- <p><?php echo _("You are only allowed to create " . $student_limit . " students"); ?> -->
  
	<div class="wrap-container">
		<div id="wrap">
			
			<div class="sub-headers">
				<h1><?php echo _('List of Students'); ?></h1>
				<!-- <a onclick="showMultipleAddForm()" id="showmutiplebutton" class="link"><?php echo _('Add Students'); ?></a><br/><br/> -->
				<p> * <?php echo _('Click the column title to filter it Ascending or Descending.'); ?></li></p>
				<!-- <div class="fright">
					<a href="import-csv.php" class="link" style="display: inline-block;">Import Teachers</a> |
					<a href="view-modules.php" class="link" style="display: inline-block;">View Modules</a> | 
					<a href="manage-students.php" class="link" style="display: inline-block;">Manage All Students</a>
					<a href="#" class="link desc-btn" style="display: inline-block;">Forget Password</a>
				</div> -->
			</div>		
			<div class="clear"></div>

			<script>
				var opts = {
				    errorCell: function(res,stat,err)
				    {
						jQuery.jgrid.info_dialog(jQuery.jgrid.errors.errcap,
							'<div class=\"ui-state-error\">'+ res.responseText +'</div>', 
								jQuery.jgrid.edit.bClose,
									{buttonalign:'right'}
						);		    	
				    }
				};	
			</script>
			<!-- <div style="margin:10px 0">
				<?php echo $excel_view; ?>
			</div> -->
			<div style="margin:10px 0" class="phpgrid">
				<?php echo $main_view; ?>
				<p><br/>* <?php echo _("Note: If the students request for a password reset, please change the student's password to something that's easy to remember. Once the spreadsheet is updated, the student will be able to use the new password."); ?></p>
			</div>
		</div>
	</div>

	<!-- simple form, used to add a new row -->
    <div id="multipleaddform">
        <div class="row">
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="add_multiple_form">
				<?php //$difference = $user->getStudents() - $student_count; ?>
				<p><?php echo _('You have already created') ?> <?php echo $student_count . '/' . $student_limit; ?> <?php echo _('students'); ?></p><br/>
				<label><?php echo _('Student'); ?></label>:
				<input type="text" value="" name="student_num" placeholder="<?php echo _('Input number of students you want to add'); ?>" class="validate[required,custom[integer]]"><br/>
		        <input type="submit" id="addmultiplebutton" class="button" name="addmultiple" value="Submit">
		        <a id="cancelbutton2" class="button"><?php echo _('Cancel'); ?></a>
		    </form>
        </div>
    </div>	

	</div>
	<!-- Tip Content -->
    <ol id="joyRideTipContent">
		<li data-id="jqgh_list1_username" 			data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
			<p><?php echo _('To update information, you can do any of the following:'); ?></p>
			<p>1. <?php echo _('Double click on a cell to update the information then press Enter'); ?></p>
		</li>
		<li data-class="ui-custom-icon" 			data-text="<?php echo _('Next'); ?>" data-options="tipLocation:right;tipAnimation:fade">
			<p>2. <?php echo _('Click the pencil icon <span class="ui-icon ui-icon-pencil"></span> in the <strong>Actions</strong> column to update all cells then press Enter; or'); ?></p>
		</li>
		<li data-class="cbox" 			data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
			<p>3. <?php echo _('Click the checkbox in the first column of any row then click the pencil icon <span class="ui-icon ui-icon-pencil "></span> at the bottom left of the table.'); ?></p>
		</li>
		<li data-id="cb_list1" 			data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
			<p>4. <?php echo _('To update a column for multiple students (same information in the same column for multiple students), click the checkbox of multiple rows and click the <strong>Bulk Edit</strong> button at the bottom of the table. A pop up will show. Update only the field/s that you want to update and it will be applied to the students you selected.'); ?></p>
		</li>
		<li data-id="search_list1" 			data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
			<p><?php echo _('To search for a record, click the magnifying glass icon <span class="ui-icon ui-icon-search"></span> at the bottom of the table.'); ?></p>
		</li>
		<li data-class="ui-icon-extlink" 			data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
			<p><?php echo _('To export/save the student list to an Excel file, click the <strong>Excel</strong> button at the bottom of the table.'); ?></p>
		</li>
		<li data-id="next_list1_pager" 			data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
			<p><?php echo _('Go to the next set of students by clicking the left and right arrows; or'); ?></p>
		</li>
		<li data-class="ui-pg-input" 			data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
			<p><?php echo _('Type in the page number and press Enter.'); ?></p>
		</li>
		<li data-class="ui-pg-selbox" 			data-text="<?php echo _('Close'); ?>" data-options="tipLocation:top;tipAnimation:fade">
			<p><?php echo _('You can also modify the number of students you want to show in a page.'); ?></p>
		</li>
    </ol>
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
	var language;
	$(document).ready(function() {
		$('#language-menu').change(function() {
			language = $('#language-menu option:selected').val();
			document.location.href = "<?php echo $_SERVER['PHP_SELF'];?>?lang=" + language;
		});

		$("tr th:nth-child(14)").each(function() {
		    var t = $(this);
		    var n = t.next();
		    t.html(t.html() + n.html());
		    n.remove();
		});
	});

	function showMultipleAddForm() {
		if ( $("#multipleaddform").is(':visible') ) 
		    $("#multipleaddform").css("display","none");
		else
		    $("#multipleaddform").css("display","block");
		}

		$("#cancelbutton2").on("click", function() {
         		showMultipleAddForm();
	        });

		// $(".close-btn").on("click", function(){
		// 	$(".mod-desc").css("display", "none");
		// 	$(".grey").css("display", "none");
		// });
		
		// $(".desc-btn").on("click", function(){
		// 	$('.forgot-password').css("display", "block");
			
		// 	//$(".mod-desc").css("display", "block");
		// 	$(".grey").css("display", "block");
		// });
	</script>
	
	<!-- jQuery Validation Engine
	<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
	<!--<link rel="stylesheet" href="css/template.css" type="text/css"/>-->
	<!-- <script src="scripts/jquery-1.8.2.min.js" type="text/javascript"></script>
	<script src="scripts/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
	<script src="scripts/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
	
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#add_multiple_form").validationEngine();
		});

		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
	</script> -->
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

	function cdl(event, element){
		var cdl = confirm('<?php echo _("Are you sure you want to delete this student account?"); ?>');
		if(!cdl){
			event.stopPropagation();
		}
	}
	</script>
</body>
</html>
