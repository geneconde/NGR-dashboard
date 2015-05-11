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

	$userid 			= $user->getUserid();
	$usertype			= $user->getType();
	$subid				= $user->getSubscriber();
	$create_date		= date('Y-m-d');
	$current_date		= date('Y-m-d');
	$expire_date		= date('Y-m-d', strtotime("+30 days"));
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
include(PHPGRID_LIBPATH."inc/jqgrid_dist.php");

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
$col["title"] = "Username";
$col["name"] = "username";
$col["width"] = "30";
$col["search"] = true;
$col["editable"] = true;
$col["align"] = "center";
$col["export"] = true; // this column will not be exported
// $col["formoptions"] = array("elmsuffix"=>'<font color=red> *</font>');
$cols[] = $col;

$col = array();
$col["title"] = "Password";
$col["name"] = "password";
$col["width"] = "30";
$col["search"] = true;
$col["editable"] = true;
$col["align"] = "center";
$col["export"] = true; // this column will not be exported
// $col["formoptions"] = array("elmsuffix"=>'<font color=red> *</font>');
$cols[] = $col;

$col = array();
$col["title"] = "Type";
$col["name"]  = "type";
$col["editable"] = false;
$col["width"] = "10";
$col["editoptions"] = array("defaultValue"=>"2","readonly"=>"readonly", "style"=>"border:0");
$col["viewable"] = true;
$col["hidden"] = true;
$col["editrules"] = array("edithidden"=>true); 
$col["export"] = false; // this column will not be exported
$cols[] = $col;

$col = array();
$col["title"] = "First Name";
$col["name"] = "first_name";
$col["width"] = "30";
$col["search"] = true;
$col["editable"] = true;
$col["align"] = "center";
$col["export"] = true; 
$cols[] = $col;

$col = array();
$col["title"] = "Last Name";
$col["name"] = "last_name";
$col["width"] = "30";
$col["search"] = true;
$col["editable"] = true;
$col["align"] = "center";
$col["export"] = true; 
$cols[] = $col;

$col = array();
$col["title"] = "Gender";
$col["name"] = "gender";
$col["width"] = "10";
$col["search"] = true;
$col["editable"] = true;
$col["align"] = "center";
$col["export"] = true;
$col["edittype"] = "select";
$col["editoptions"] = array("value"=>'M:M;F:F');
$cols[] = $col;

$col = array();
$col["title"] = "Teacher ID";
$col["name"]  = "teacher_id";
$col["editable"] = false;
$col["width"] = "10";
$col["editoptions"] = array("defaultValue"=>"$userid","readonly"=>"readonly", "style"=>"border:0");
$col["viewable"] = true;
$col["hidden"] = true;
$col["editrules"] = array("edithidden"=>true); 
$col["export"] = false; // this column will not be exported
$cols[] = $col;

$col = array();
$col["title"] = "Subscriber ID";
$col["name"]  = "subscriber_id";
$col["editable"] = false;
$col["editoptions"] = array("defaultValue"=>"$subid","readonly"=>"readonly", "style"=>"border:0");
$col["viewable"] = true;
$col["hidden"] = true;
$col["editrules"] = array("edithidden"=>true); 
$col["export"] = false; // this column will not be exported
$cols[] = $col;

$col = array();
$col["title"] = "Grade Level"; // caption of column
$col["name"] = "grade_level"; 
$col["width"] = "15";
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
$col["title"] = "Student Portfolio";
$col["name"] = "view_more";
$col["width"] = "25";
$col["align"] = "center";
$col["search"] = false;
$col["sortable"] = false;
$col["link"] = "../view-portfolio.php?user_id={user_ID}"; // e.g. http://domain.com?id={id} given that, there is a column with $col["name"] = "id" exist
$col["linkoptions"] = "target='_blank'"; // extra params with <a> tag
$col["default"] = "View Portfolio"; // default link text
$col["export"] = false; // this column will not be exported
$cols[] = $col;

$grid = new jqgrid();

$opt["caption"] = "Student Information";
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
			"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
	));

$grid->select_command = "SELECT * FROM users WHERE teacher_ID = $userid AND type=2";

$grid->table = "users";

$grid->set_columns($cols); // pass the cooked columns to grid

$main_view = $grid->render("list1");
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>

<head>
	<title>NextGenReady</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link rel="stylesheet" type="text/css" media="screen" href="lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="lib/js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<link rel="stylesheet" type="text/css" href="../style.css" />

	<script src="lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
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
	<div class="clear"></div>

	<a class="link" href="../teacher.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a><br/><br/>

	<div class="wrap-container">
		<div id="wrap">
			<div class="sub-headers">
				<h1>List of Students</h1>
				<p><?php echo _(' * Click the column title to filter it Ascending or Descending.'); ?></li></p>
			</div>
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
			<div style="margin:10px 0">
				<?php echo $main_view; ?>
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
