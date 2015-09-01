 <?php 
	require_once '../session.php';
	require_once '../locale.php';
	include_once '../controller/User.Controller.php'; 
	require_once '../controller/StudentGroup.Controller.php';
	include_once '../controller/DiagnosticTest.Controller.php';
	include_once '../controller/TeacherModule.Controller.php';
	include_once '../controller/Module.Controller.php';
	include_once '../controller/Language.Controller.php';
	
	$ufl = $user->getFirstLogin();
	$ut = $user->getType();
	if($ufl == 1 && $ut == 2){ header("Location: ../account-update.php?ut=2");}
	$uc = new UserController();
	$userid = $user->getUserid();

	$sgc 		= new StudentGroupController();
	$groups		= $sgc->getGroups($userid);

	$groupHolder = $sgc->getGroups($userid);
	$groupID = $groupHolder[0]['group_id'];
	$groupNameHolder = $sgc->getGroupName($groupID);


	// $group_name = $groupNameHolder[0]["group_name"];
	$group 			= new StudentGroupController();
	$checkGroup		= $group->getGroups($userID);
	echo $checkGroup[0]["group_name"];

	//$usertype			= $user->getType();
	$demoid				= $user->getSubheadid();
	$create_date		= date('Y-m-d G:i:s');
	$current_date		= date('Y-m-d G:i:s');
	$expire_date		= date('Y-m-d G:i:s', strtotime("+30 days"));
	$updated_at 		= date('Y-m-d H:i:s');

	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);


// $result = mysql_query("SELECT * FROM users WHERE teacher_id = $userid AND type = 2"); 
// $num_rows = mysql_num_rows($result);

// include db config
include_once("config.php");

// set up DB
mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

// include and create object
include(PHPGRID_LIBPATH."inc/jqgrid_dist2.php");

/** Excel View Grid Table **/
$grid2 = new jqgrid();

$opt2["scroll"] = true; // by default 20
$opt2["caption"] = "Student Information (Excel View)"; // caption of grid
$opt2["autowidth"] = true; // expand grid to screen width
$opt2["export"] = array("filename"=>"my-file", "sheetname"=>"test"); // export to excel parameters
$opt2["hiddengrid"] = true;
// $opt2["pgbuttons"] = true;
// $opt2["viewrecords"] = true;

// excel visual params
$opt2["cellEdit"] = true; // inline cell editing, like spreadsheet
$opt2["rownumbers"] = true;
$opt["rownumWidth"] = 30;

$grid2->set_options($opt2);

$grid2->set_actions(array(	
						"add"=>false, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>false, // allow/disallow delete
						"export"=>true, // show/hide export to excel option
						//"autofilter" => false, // show/hide autofilter for search
					) 
				);

$grid2->select_command = "SELECT user_ID, username, password, first_name, last_name, gender, grade_level FROM users WHERE teacher_ID = $userid AND type = 2";

// this db table will be used for add,edit,delete
$grid2->table = "users";

// generate grid output, with unique grid name as 'list2'
$excel_view = $grid2->render("list2");

$username = _('Username');
$password = _('Password');
$first_name = _('First Name');
$last_name = _('Last Name');
$gender = _('Gender');
$grade_level = _('Grade Level');
// $student_portfolio = _('Student Portfolio');
$student_information = _('Student Information');
// $view_portfolio = _('View Portfolio');
// $actions = _('Actions');

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
$col["editable"] = true;
$col["align"] = "center";
$col["export"] = true; // this column will not be exported
// $col["formoptions"] = array("elmsuffix"=>'<font color=red> *</font>');
$cols[] = $col;

/*
$col = array();
$col["title"] = $password;
$col["name"] = "password";
$col["width"] = "30";
$col["search"] = true;
$col["editable"] = true;
$col["align"] = "center";
$col["export"] = true; // this column will not be exported
// $col["formoptions"] = array("elmsuffix"=>'<font color=red> *</font>');
$cols[] = $col;
*/

$col = array();
$col["title"] = "Type";
$col["name"]  = "type";
$col["editable"] = true;
$col["width"] = "10";
$col["editoptions"] = array("defaultValue"=>"2","readonly"=>"readonly", "style"=>"border:0");
$col["viewable"] = false;
$col["hidden"] = true;
$col["editrules"] = array("edithidden"=>false); 
$cols[] = $col;

$col = array();
$col["title"] = $first_name;
$col["name"] = "first_name";
$col["width"] = "28";
$col["search"] = true;
$col["editable"] = true;
$col["align"] = "center";
$col["export"] = true; 
$cols[] = $col;

$col = array();
$col["title"] = $last_name;
$col["name"] = "last_name";
$col["width"] = "28";
$col["search"] = true;
$col["editable"] = true;
$col["align"] = "center";
$col["export"] = true; 
$cols[] = $col;

$col = array();
$col["title"] = $gender;
$col["name"] = "gender";
$col["width"] = "12";
$col["search"] = true;
$col["editable"] = true;
$col["align"] = "center";
$col["export"] = true;
$col["edittype"] = "select";
$col["editoptions"] = array("value"=>'M:M;F:F');
$cols[] = $col;

$col = array();
$col["title"] = $grade_level; // caption of column
$col["name"] = "grade_level"; 
$col["width"] = "17";
$col["editable"] = true;
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "Teacher ID";
$col["name"]  = "teacher_id";
$col["editable"] = true;
$col["width"] = "10";
$col["editoptions"] = array("defaultValue"=>"$userid","readonly"=>"readonly", "style"=>"border:0");
$col["viewable"] = false;
$col["hidden"] = true;
$col["editrules"] = array("edithidden"=>false); 
$cols[] = $col;

$col = array();
$col["title"] = "Trial User ID";
$col["name"]  = "demo_id";
$col["editable"] = true;
$col["editoptions"] = array("defaultValue"=>"$demoid","readonly"=>"readonly", "style"=>"border:0");
$col["viewable"] = false;
$col["hidden"] = true;
$col["editrules"] = array("edithidden"=>false); 
$cols[] = $col;

// $col = array();
// $col["title"] = $student_portfolio;
// $col["name"] = "view_more";
// $col["width"] = "25";
// $col["align"] = "center";
// $col["search"] = false;
// $col["sortable"] = false;
// $col["link"] = "../view-portfolio.php?user_id={user_ID}"; // e.g. http://domain.com?id={id} given that, there is a column with $col["name"] = "id" exist
// $col["linkoptions"] = "target='_blank'"; // extra params with <a> tag
// $col["default"] = $view_portfolio; // default link text
// $cols[] = $col;

$col = array();
$col["title"] = "Create Date";
$col["name"] = "create_date"; 
$col["width"] = "150";
$col["editable"] = false; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["editrules"] = array("required"=>false, "edithidden"=>true); // and is required
# format as date
// $col["formatter"] = "date"; 
# opts array can have these options: http://api.jqueryui.com/datepicker/
$col["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'d.m.Y', "opts" => array("changeYear" => false));
$col["editoptions"] = array("defaultValue"=>"$create_date","readonly"=>"readonly", "style"=>"border:0");
$col["hidden"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "Current Date";
$col["name"] = "cur_date"; 
$col["width"] = "150";
$col["editable"] = false;
$col["editoptions"] = array("size"=>20);
$col["editrules"] = array("required"=>false, "edithidden"=>true);
$col["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'d.m.Y', "opts" => array("changeYear" => false));
$col["editoptions"] = array("defaultValue"=>"$current_date","readonly"=>"readonly", "style"=>"border:0");
$col["hidden"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "Expire Date";
$col["name"] = "expire_date"; 
$col["width"] = "150";
$col["editable"] = false;
$col["editoptions"] = array("size"=>20);
$col["editrules"] = array("required"=>false, "edithidden"=>true);
$col["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'d.m.Y', "opts" => array("changeYear" => false));
$col["editoptions"] = array("defaultValue"=>"$expire_date","readonly"=>"readonly", "style"=>"border:0");
$col["hidden"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "Updated At";
$col["name"] = "updated_at"; 
$col["width"] = "150";
$col["editable"] = false;
$col["editoptions"] = array("size"=>20);
$col["editrules"] = array("required"=>false, "edithidden"=>true);
$col["formatoptions"] = array("srcformat"=>'Y-m-d H:i:s',"newformat"=>'d.m.Y H:i:s', "opts" => array("changeYear" => false));
$col["editoptions"] = array("defaultValue"=>"$updated_at","readonly"=>"readonly", "style"=>"border:0");
$col["hidden"] = true;
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
$grid->debug = 0;
$grid->error_msg = "Username Already Exists.";
$grid->set_actions(array(
			"add"=>false, // allow/disallow add
			"edit"=>true, // allow/disallow edit
			"delete"=>false, // allow/disallow delete
			"bulkedit"=>true, // allow/disallow edit
			"export_excel"=>true, // export excel button
			//"export_pdf"=>true, // export pdf button
			//"export_csv"=>true, // export csv button
			//"autofilter" => true, // show/hide autofilter for search
			// "rowactions"=>true, // show/hide row wise edit/del/save option
			// "showhidecolumns" => true,
			//"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
	));

$grid->select_command = "SELECT * FROM users WHERE teacher_ID = $userid AND type=2";

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
	
	<link rel="stylesheet" type="text/css" media="screen" href="lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="lib/js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<link rel="stylesheet" type="text/css" href="../lgs.css" />
	<link rel="stylesheet" href="../libraries/joyride/joyride-2.1.css">
	<style>
		.ui-search-toolbar { display: none; }
		.fleft { margin-top: -16px; }
		.tguide { float: left; margin-top: 0px; }
		.guide {
			padding: 5px;
			background-color: orange;
			border-radius: 5px;
			margin-right: 1px;
			margin-left: 1px;
			border: none;
			font-size: 10px;
			color: #000;
			cursor: pointer;
		}
		.guide:hover {
			background-color: orange;
		}
		.ui-icon {
		  display: inline-block !important;
		}
		<?php if($language == "ar_EG") { ?>
		.tguide { float: right; }
		<?php } ?>

		/*Custom joyride*/
		.joyride-tip-guide:nth-child(8){
			margin-top: 20px !important;
		}
		.joyride-tip-guide:nth-child(10){
			margin-top: 20px !important;
		    margin-left: -30px !important;
		}
		.joyride-tip-guide:nth-child(11){
		    margin-left: -30px !important;
		}
		.joyride-tip-guide:nth-child(12){
		    margin-top: 5px !important;
		    margin-left: -20px !important;
		}
		.joyride-tip-guide:nth-child(13){
		    margin-left: -20px !important;
		}
		.joyride-tip-guide:nth-child(14){
			margin-top: 5px !important;
		    margin-left: -23px !important;
		}
		.joyride-tip-guide:nth-child(15){
			margin-top: 5px !important;
		    margin-left: -23px !important;
		}
		.joyride-tip-guide:nth-child(16){
			margin-top: 3px !important;
		    margin-left: -25px !important;
		}
		/*End custom joyride*/
		<?php
		$user_agent = getenv("HTTP_USER_AGENT");
		if(strpos($user_agent, "Win") !== FALSE) { ?>
			.next {
			    padding: 3.5px 20px !important;
			}
		<?php } ?>
	</style>

	<script src="lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

	<!-- Run the plugin -->
    <script type="text/javascript" src="../libraries/joyride/jquery.cookie.js"></script>
    <script type="text/javascript" src="../libraries/joyride/modernizr.mq.js"></script>
    <script type="text/javascript" src="../libraries/joyride/jquery.joyride-2.1.js"></script>

</head>

<body>
	<div id="header">

		<a href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>

	</div>

	<div id="content"><br>

	<?php if (isset($user)) { ?>
		<div class="fright" id="logged-in">
			<?php echo _("You are currently logged in as"); ?> <span class="upper bold"><?php echo $user->getUsername(); ?></span>. <a class="link" href="../logout.php"><?php echo _("Logout?"); ?></a>
		</div>
	<?php } ?>
	<div id="dbguide"><button class="uppercase guide tguide" onClick="guide()">Guide Me</button></div>
	<div class='lgs-container'>
	<form action="../update-group-student.php" method="post" >
		<div class="center"><br/>
	 		<h1 class="lgs-text">Let's Get Started</h1>
			<p class="lgs-text-sub heading-input step step2">Step 2: Your Students</p>
			<p class="lgs-text-sub heading-input">Student Group</p>
			<p class="lgs-text-sub note">We have set up a default group for your students. You can rename this group below.</p>
			<p class="input-label" align="left">Default group name</p>
			<p align="left"><input class="inputText" id="group" name="group" type="text" maxlength="60" value="<?php echo $group_name; ?>"/></p>
			
			<p class="lgs-text-sub heading-input">Student List</p>
			<p class="lgs-text-sub note">Your student accounts are listed below. You can enter your students' information now or have your students enter their information when they first log in.<br/><br/>(Note: This student spreadsheet can be accessed and updated anytime by clicking the "Student Accounts" button at the top right of the dashboard)</p>

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

			<div>
				<?php echo $main_view; ?>
			</div>
			<input name="Submit" class="nbtn next" type="submit" value="Next" />
			<a class="nbtn skip" href="../modules.php" id="btnm">Skip</a>
			<a class="nbtn back" href="../account-update.php">Back</a>
		</div>
	</form>
	</div>	

	</div>
	<!-- Tip Content -->
    <ol id="joyRideTipContent">
		<li data-id="group" 			data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>We created a default student group for you named <strong>"Default Group"</strong>. You can change the name of this group or leave it as it is. All student accounts created for you are included in this group.</p>
		</li>
		<li data-id="jqgh_list1_username" 			data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>To update information, you can do any of the following:</p>
			<p>1. Double click on a cell to update the information then click Enter</p>
		</li>
		<li data-class="ui-custom-icon" 			data-text="Next" data-options="tipLocation:right;tipAnimation:fade">
			<p>2. Click the pencil icon <span class="ui-icon ui-icon-pencil"></span> in the <strong>Actions</strong> column to update all cells then click Enter; or</p>
		</li>
		<li data-class="cbox" 			data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>3. Click the checkbox in the first column of any row then click the pencil icon <span class="ui-icon ui-icon-pencil "></span> at the bottom left of the table.</p>
		</li>
		<li data-id="cb_list1" 			data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>4. To update a column for multiple students (same information in the same column for multiple students), click the checkbox of multiple rows and click the <strong>Bulk Edit</strong> button at the bottom of the table. A pop up will show. Update only the field/s that you want to update and it will be applied to the students you selected.</p>
		</li>
		<li data-id="search_list1" 			data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>To search for a record, click the magnifying glass icon <span class="ui-icon ui-icon-search"></span> at the bottom of the table.</p>
		</li>
		<li data-class="ui-icon-extlink" 			data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>To export/save the student list to an Excel file, click the <strong>Excel</strong> button at the bottom of the table.</p>
		</li>
		<li data-id="next_list1_pager" 			data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Go to the next set of students by clicking the left and right arrows; or</p>
		</li>
		<li data-class="ui-pg-input" 			data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Type in the page number and press Enter.</p>
		</li>
		<li data-class="ui-pg-selbox" 			data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>You can also modify the number of students you want to show in a page.</p>
		</li>
		<li data-id="btnm" 			data-text="Close" data-options="tipLocation:left;tipAnimation:fade">
			<p>Click the <strong>Skip</strong> button if you have no changes. Click <strong>Next</strong> to save your changes and go to the next page.</p>
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
	});

	function guide() {
	  	$('#joyRideTipContent').joyride({
	      autoStart : true,
	      postStepCallback : function (index, tip) {
	      if (index == 10) {
	        $(this).joyride('set_li', false, 1);
	      }
	    },
	    // modal:true,
	    // expose: true
	    });
	  }
	</script>
</body>
</html>
