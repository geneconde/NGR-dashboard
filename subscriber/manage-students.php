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
	require_once 'locale.php';
	include_once '../controller/DiagnosticTest.Controller.php';
	include_once '../controller/TeacherModule.Controller.php';
	include_once '../controller/Module.Controller.php';
	include_once '../controller/Language.Controller.php';
	include_once '../controller/User.Controller.php';
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

	$difference = $sub->getStudents() - $student_count;

	$uc = new UserController();

	if(isset($_GET['unassign']) && $_GET['unassign'] == 1){
		$uc->updateStudentTeacher($_GET['user_id']);
		header("Location: manage-students.php");
	}

	// include db config
	include_once("../phpgrid/config.php");

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
	$teacher = _('Teacher');
	$action = _('Action');
	$type = _('Type');

	$grid = new jqgrid();

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
	$col["searchoptions"] = array("attr"=>array("placeholder"=>'Enter Username...')); 
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true; // this column will not be exported	
	$cols[] = $col;

	$col = array();
	$col["title"] = $type;
	$col["name"]  = "type";
	$col["editable"] = true;
	$col["width"] = "10";
	$col["editoptions"] = array("defaultValue"=>"2","readonly"=>"readonly", "style"=>"border:0");
	$col["viewable"] = true;
	$col["hidden"] = true;
	$col["editrules"] = array("edithidden"=>false); 
	$col["export"] = false; // this column will not be exported
	$cols[] = $col;

	$col = array();
	$col["title"] = $first_name;
	$col["name"] = "first_name";
	$col["width"] = "30";
	$col["search"] = true;
	$col["searchoptions"] = array("attr"=>array("placeholder"=>'Enter First Name...')); 
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true; 
	$cols[] = $col;

	$col = array();
	$col["title"] = $last_name;
	$col["name"] = "last_name";
	$col["width"] = "30";
	$col["search"] = true;
	$col["searchoptions"] = array("attr"=>array("placeholder"=>'Enter Last Name...')); 
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

	$col = array();
	$col["title"] = "Subscriber ID";
	$col["name"]  = "subscriber_id";
	$col["editable"] = true;
	$col["editoptions"] = array("defaultValue"=>"$subid","readonly"=>"readonly", "style"=>"border:0");
	$col["viewable"] = false;
	$col["hidden"] = true;
	$col["editrules"] = array("edithidden"=>false); 
	$col["export"] = false; // this column will not be exported
	$cols[] = $col;

	$col = array();
	$col["title"] = $grade_level; // caption of column
	$col["name"] = "grade_level"; 
	$col["searchoptions"] = array("attr"=>array("placeholder"=>'Enter Level...')); 
	$col["width"] = "15";
	$col["editable"] = true;
	$col["align"] = "center";
	$cols[] = $col;

	$col = array();
	$col["title"] = $teacher;
	$col["name"] = "teacher_id";
	$col["dbname"] = "users.teacher_id"; // this is required as we need to search in name field, not id
	$col["width"] = "30";
	$col["align"] = "center";
	$col["editable"] = true;
	$col["edittype"] = "select"; // render as select
	$col["search"] = false;
	$col["export"] = false;
	# fetch data from database, with alias k for key, v for value
	$str = $grid->get_dropdown_values("select distinct user_ID as k, concat(first_name, ' ',last_name) as v from users where subscriber_id = $subid and type=0");
	$col["editoptions"] = array("value"=>$str); 
	$col["formatter"] = "select"; // display label, not value
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
	$col["title"] = $student_portfolio;
	$col["name"] = "view_more";
	$col["width"] = "25";
	$col["align"] = "center";
	$col["search"] = false;
	$col["sortable"] = false;
	$col["link"] = "../view-portfolio.php?user_id={user_ID}"; // e.g. http://domain.com?id={id} given that, there is a column with $col["name"] = "id" exist
	$col["linkoptions"] = "target='_blank' class='c-link'"; // extra params with <a> tag

	$col["default"] = $view_portfolio; // default link text
	$col["export"] = false; // this column will not be exported
	$cols[] = $col;

	$col = array();
	$col["title"] = $reset_student_password;
	$col["name"] = "reset_pword";
	$col["width"] = "35";
	$col["align"] = "center";
	$col["search"] = false;
	$col["sortable"] = false;
	$col["link"] = "../reset-password.php?user_id={user_ID}"; // e.g. http://domain.com?id={id} given that, there is a column with $col["name"] = "id" exist
	// $col["linkoptions"] = "target='_blank'"; // extra params with <a> tag
	$col["default"] = $reset_password; // default link text
	$col["export"] = false; // this column will not be exported
	$cols[] = $col;

	$col = array();
	$col["title"] = $action;
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
	if(conf==true) window.location = "manage-students.php?user_id={user_ID}&unassign=1";';
	$col["default"] = "unassign";
	$col["export"] = false;
	$cols[] = $col;

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

	$e["on_insert"] = array("add_student", null, true);
	$grid->set_events($e);

	$_SESSION["sid"] = $subid;
	$_SESSION["count"] = $student_count;
	$_SESSION["max_student"] = $sub->getStudents();

	function add_student($data)
	{
		$subid = $_SESSION["sid"];
		$max_student = $_SESSION["max_student"];
		$count = $_SESSION["count"];

	    if ($count >= $max_student) {
	    	phpgrid_error("You have reached the maximum number of students. ". $count . '/' . $max_student);  
	    }

		//mysql_query("INSERT INTO users VALUES (null,'{$data["params"]["user_ID"]}','{$data["params"]["username"]}','{$data["params"]["password"]}','{$data["params"]["type"]}','{$data["params"]["first_name"]}','{$data["params"]["last_name"]}','{$data["params"]["gender"]}','{$data["params"]["teacher_id"]}','{$data["params"]["subscriber_id"]}','{$data["params"]["grade_level"]}','{$data["params"]["is_deleted"]}')");

	}

	$grid->debug = 0;
	$grid->error_msg = "Username Already Exists.";
	/*echo '<h1>'. $sub->getStudents() . '</h1>';*/


	if($sub->getStudents() <= $student_count) :
		
		$grid->set_actions(array(
				"add"=>false, // allow/disallow add
				"edit"=>true, // allow/disallow edit
				"delete"=>true, // allow/disallow delete
				"bulkedit"=>true, // allow/disallow edit
				"export_excel"=>true, // export excel button
				"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
			));

	else :			
		$grid->set_actions(array(
				"add"=>true, // allow/disallow add
				"edit"=>true, // allow/disallow edit
				"delete"=>true, // allow/disallow delete
				"bulkedit"=>true, // allow/disallow edit
				"export_excel"=>true, // export excel button
				"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
		));

	endif;

	$grid->select_command = "SELECT * FROM users WHERE subscriber_id = $subid AND type = 2 and (teacher_id <> 0 and teacher_id in (SELECT user_id FROM users))";

	$grid->table = "users";

	$grid->set_columns($cols); // pass the cooked columns to grid

	$main_view = $grid->render("list1");

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

	<script src="../phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en-students.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="../phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
	<?php
	if($language == "ar_EG") { ?> <script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-ar.js" type="text/javascript"></script>
	<?php }
	if($language == "es_ES") { ?> <script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<?php }
	if($language == "zh_CN") { ?> <script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-cn.js" type="text/javascript"></script>
	<?php }
	?>

	<style>
	.fleft { margin-top: -16px; }
	.tguide { float: left; font-family: inherit; }
	.guide {
		padding: 5px;
		background-color: orange;
		border-radius: 5px;
		border: none;
		font-size: 10px;
		color: #000;
		cursor: pointer;
	}
	.guide:hover {
		background-color: orange;
	}
	.joytest2 ~ div a:nth-child(3){
	    display: none;
	}
	.joyride-tip-guide:nth-child(8){
	    margin-top: 15px !important;
	}
	.ui-icon {
	  display: inline-block !important;
	}
	#delmodlist1 { width: auto !important; }
	<?php if($language == "ar_EG") { ?>
	.tguide { float: right; }
	<?php } ?>

	/*End custom joyride*/
	#dbguide {margin-top: 10px;}
	tr td:nth-child(15) a {
	  background: rgb(66, 151, 215);
	  color: #fff;
	  padding: 3px 5px;
	  border-radius: 3px;
	}
	tr td:nth-child(15) a:hover, tr td:nth-child(15) a:link, tr td:nth-child(15) a:visited, tr td:nth-child(15) a:focus {
		color: #fff;
	}
	#list1_act {
		width: auto !important;
	}
	tr input { width: 90% !important; }
	.ui-jqgrid .ui-search-input input { width: 100% !important; }
	.ui-pg-input { width: auto !important; }
	</style>

	<!-- Run the plugin -->
    <script type="text/javascript" src="../libraries/joyride/jquery.cookie.js"></script>
    <script type="text/javascript" src="../libraries/joyride/modernizr.mq.js"></script>
    <script type="text/javascript" src="../libraries/joyride/jquery.joyride-2.1.js"></script>
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
	<!-- <div class="fright m-top10" id="accounts">
		<a class="link fright" href="edit-account.php?user_id=<?php echo $userid; ?>&f=0"><?php echo _("My Account"); ?></a>
	</div> -->
	<div class="clear"></div>
	<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $sub->getFirstName(); ?></span>!</h1>
	<p><?php echo _("This is your Dashboard. In this page, you can manage your students information."); ?>
	<!-- <p><br/><?php echo _("Total allowed student accounts: " . $sub->getStudents() . ""); ?></p> -->
	<div class="wrap-container">
		<div id="wrap">
			<div class="sub-headers">
				<h1><?php echo _('List of Students'); ?></h1>
				<p class="fleft"> * <?php echo _('Click the column title to filter it Ascending or Descending.'); ?></li></p>
				<div class="fright">
					<a href="view-modules.php" class="link" style="display: inline-block;"><?php echo _('View Modules'); ?></a> |
					<a href="statistics.php" class="link" style="display: inline-block;"><?php echo _('Statistics'); ?></a> |
					<a href="unassigned-students.php" class="link" style="display: inline-block;"><?php echo _('Unassigned Students'); ?></a> |
					<a href="index.php" class="link" style="display: inline-block;"><?php echo _('Manage Sub-Admin'); ?></a> |					
					<a href="floating-accounts.php" class="link" style="display: inline-block;"><?php echo _('Floating Accounts'); ?></a>
				</div>
			</div>		
			<div class="clear"></div>

			<script>
				/*var opts = {
				    errorCell: function(res,stat,err)
				    {
						jQuery.jgrid.info_dialog(jQuery.jgrid.errors.errcap,
							'<div class=\"ui-state-error\">'+ res.responseText +'</div>', 
								jQuery.jgrid.edit.bClose,
									{buttonalign:'right'}
						);		    	
				    }
				};	*/
			</script>

			<div style="margin:10px 0">
				<?php echo $main_view; ?>
			</div>
		</div>
	</div>	
		<!-- Tip Content -->
	    <ol id="joyRideTipContent">
			<li data-id="jqgh_list1_username" data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
				<p><?php echo _('To update information, you can do any of the following:'); ?></p>
				<p>1. <?php echo _('Double click on a cell to update the information then press Enter'); ?></p>
			</li>
			<li data-class="ui-custom-icon" data-text="<?php echo _('Next'); ?>" data-options="tipLocation:right;tipAnimation:fade">
				<p>2. <?php echo _('Click the pencil icon <span class="ui-icon ui-icon-pencil"></span> in the <strong>Actions</strong> column to update all cells then press Enter; or'); ?></p>
			</li>
			<li data-class="cbox" data-text="<?php echo _('Next'); ?>" data-options="tipLocation:left;tipAnimation:fade">
				<p>3. <?php echo _('Click the checkbox in the first column of any row then click the pencil icon <span class="ui-icon ui-icon-pencil "></span> at the bottom left of the table.'); ?></p>
			</li>
			<li data-id="cb_list1" data-text="<?php echo _('Next'); ?>" data-options="tipLocation:left;tipAnimation:fade">
				<p>4. <?php echo _('To update a column for multiple students (same information in the same column for multiple students), click the checkbox of multiple rows and click the <strong>Bulk Edit</strong> button at the bottom of the table. A pop up will show. Update only the field/s that you want to update and it will be applied to the students you selected.'); ?></p>
			</li>
			<li data-class="ui-icon-search" data-text="<?php echo _('Next'); ?>" data-options="tipLocation:left;tipAnimation:fade">
				<p><?php echo _('To search for a record, click the magnifying glass icon <span class="ui-icon ui-icon-search"></span> at the bottom of the table.'); ?></p>
			</li>
			<li data-class="ui-icon-extlink" data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
				<p><?php echo _('To export/save the student list to an Excel file, click the <strong>Excel</strong> button at the bottom of the table.'); ?></p>
			</li>
			<li data-id="next_list1_pager" data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
				<p><?php echo _('Go to the next set of students by clicking the left and right arrows; or'); ?></p>
			</li>
			<li data-class="ui-pg-input" data-text="<?php echo _('Next'); ?>" data-options="tipLocation:left;tipAnimation:fade">
				<p><?php echo _('Type in the page number and press Enter.'); ?></p>
			</li>
			<li data-class="ui-pg-selbox" data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
				<p><?php echo _('You can also modify the number of accounts you want to show in a page.'); ?></p>
			</li>
			<li data-class="c-link" data-text="<?php echo _('Close'); ?>" data-options="tipLocation:left;tipAnimation:fade">
				<p><?php echo _('You may also view the portfolio of student.'); ?></p>
			</li>
	    </ol>
	</div> <!-- End of content -->

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
		var cdl = confirm("Are you sure you want to delete this student account?");
		if(!cdl){
			event.stopPropagation();
		}
	}
	</script>
</body>
</html>
