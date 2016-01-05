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
	$group_name = $groupNameHolder[0]["group_name"];

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
$col["title"] = "Subscriber ID";
$col["name"]  = "subscriber_id";
$col["editable"] = true;
$col["editoptions"] = array("defaultValue"=>"$userid","readonly"=>"readonly", "style"=>"border:0");
$col["viewable"] = false;
$col["hidden"] = true;
$col["editrules"] = array("edithidden"=>false); 
$cols[] = $col;

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

$e["on_update"] = array("update_student", null, true);
$grid->set_events($e);

function update_student($data)
{
	$data["params"]["username"] = trim($data["params"]["username"]);
}

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
	
	<link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/themes/custom/jquery-ui.custom.css"></link>
	<link rel="stylesheet" type="text/css" media="screen" href="lib/js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<link rel="stylesheet" type="text/css" href="../lgs.css" />

	<?php if($language == "ar_EG") : ?>
		<link rel="stylesheet" href="../styles/pageguide.min-ar.css" />
	<?php else : ?>
		<link rel="stylesheet" href="../styles/pageguide.min.css" />
	<?php endif; ?>

	<style>
		.ui-search-toolbar { display: none; }
		.ui-icon { display: inline-block !important; }
		.ui-pg-input { width: 25px !important; }
		.phpgrid input.editable { width: 90% !important; }
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
	<div class="wrap">
		<a class="logo fleft" href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>
		<div class="fright" id="logged-in">
			<div><span class="note"><?php echo _("Welcome"); ?></span>, <span class="upper bold"><?php echo $user->getUsername(); ?></span>! <a class="link" id="logout" href="../logout.php"><?php echo _("Logout?"); ?></a>
			</div>
			<div class="languages">
				<?php if(!empty($teacher_languages)) :
					foreach($teacher_languages as $tl) : 
						$lang = $lc->getLanguage($tl['language_id']); ?>
						<a class="uppercase manage-box" href="?lang=<?php echo $lang->getLanguage_code(); ?>"/><?php echo $lang->getShortcode(); ?></a>
				<?php  endforeach;
				else : ?>
					<a class="uppercase manage-box" href="?lang=en_US"/><?php echo _("EN"); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<div id="content">
<div class="wrap">
	<form action="../update-group-student.php" method="post" >
		<div class="center"><br/>
	 		<h1 class="lgs-text"><?php echo _("Let's Get Started"); ?></h1>
			<p class="lgs-text-sub heading-input step step2"><?php echo _("Step 2: Your Students"); ?></p>
			<p class="lgs-text-sub heading-input"><?php echo _("Student Group"); ?></p>
			<p class="lgs-text-sub note"><?php echo _("We have set up a default group for your students. You can rename this group below."); ?></p>
			<p class="input-label" align="left"><?php echo _("Default group name"); ?></p>
			<p align="left"><input class="inputText" id="group" name="group" type="text" maxlength="60" value="<?php echo $group_name; ?>"/></p>
			<p class="lgs-text-sub heading-input"><?php echo _("Student List"); ?></p>
			<p class="lgs-text-sub note"><?php echo _("Your student accounts are listed below. You can enter your students' information now or have your students enter their information when they first log in."); ?><br/><br/><?php echo _('(Note: This student spreadsheet can be accessed and updated anytime by clicking the "Student Accounts" button at the top right of the dashboard)'); ?></p>

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

			<div class="phpgrid">
				<?php echo $main_view; ?>
			</div>
			<input name="Submit" class="nbtn next" type="submit" value="<?php echo _('Next'); ?>" />
			<a class="nbtn back" href="../account-update.php"><?php echo _('Back'); ?></a>
		</div>
	</form>
	</div>	

	</div>

	<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
	  <li class="tlypageguide_right" data-tourtarget="#group">
		<p><?php echo _('We created a default student group for you named <strong>"Default Group"</strong>. You can change the name of this group or leave it as it is. All student accounts created for you are included in this group.'); ?></p>
	  </li>
	  <li class="tlypageguide_top" data-tourtarget="#jqgh_list1_username">
		<p><?php echo _('To update information, you can do any of the following:'); ?></p>
		<p>1. <?php echo _('Double click on a cell to update the information then press Enter'); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget=".ui-custom-icon">
	    <p>2. <?php echo _('Click the pencil icon <small class="ui-icon ui-icon-pencil"></small> in the <strong>Actions</strong> column to update all cells then press Enter; or'); ?></p>
	  </li>
	  <li class="tlypageguide_left" data-tourtarget="tr.jqgrow td .cbox">
	    <p>3. <?php echo _('Click the checkbox in the first column of any row then click the pencil icon <small class="ui-icon ui-icon-pencil "></small> at the bottom left of the table.'); ?></p>
	  </li>
	  <li class="tlypageguide_left" data-tourtarget="#cb_list1">
	    <p>4. <?php echo _('To update a column for multiple students (same information in the same column for multiple students), click the checkbox of multiple rows and click the <strong>Bulk Edit</strong> button at the bottom of the table. A pop up will show. Update only the field/s that you want to update and it will be applied to the students you selected.'); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget="search_list1">
	    <p><?php echo _('To search for a record, click the magnifying glass icon <small class="ui-icon ui-icon-search"></small> at the bottom of the table.'); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget=".ui-icon-extlink">
	    <p><?php echo _('To export/save the student list to an Excel file, click the <strong>Excel</strong> button at the bottom of the table.'); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget="#next_list1_pager">
	    <p><?php echo _('Go to the next set of students by clicking the left and right arrows; or'); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget=".ui-pg-input">
	    <p><?php echo _('Type in the page number and press Enter.'); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget=".ui-pg-selbox">
	    <p><?php echo _('You can also modify the number of students you want to show in a page.'); ?></p>
	  </li>
	  <li class="tlypageguide_left" data-tourtarget=".next">
	    <p><?php echo _('Click <strong>Next</strong> to save your changes and go to the next page.'); ?></p>
	  </li>
	</ul>

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

	<?php if($language == "ar_EG") : ?>
		<script src="../scripts/pageguide.min-ar.js"></script>
	<?php else : ?>
		<script src="../scripts/pageguide.min.js"></script>
	<?php endif; ?>

	<script>
		jQuery(document).ready(function() {
	        var pageguide = tl.pg.init();
	    });

		var language;
		$(document).ready(function() {
			$('#language-menu').change(function() {
				language = $('#language-menu option:selected').val();
				document.location.href = "<?php echo $_SERVER['PHP_SELF'];?>?lang=" + language;
			});
		});
	</script>
</body>
</html>
