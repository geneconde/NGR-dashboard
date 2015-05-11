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
	include_once('../controller/Subscriber.Controller.php');
	include_once 'php/auto-generate.php';
	
	$sc = new SubscriberController();
	$sub = $sc->loadSubscriber($user->getSubscriber());

	//add parameter for is_deleted and is_archived later on method is under userController
	$student_count = $uc->countUserType($user->getSubscriber(), 2);

	$userid 			= $_GET['user_id'];
	$usertype			= $user->getType();
	$subid				= $user->getSubscriber();

	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

	$difference = $sub->getStudents() - $student_count;

	// include db config
	include_once("../phpgrid/config.php");

	// set up DB
	mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
	mysql_select_db(PHPGRID_DBNAME);

	// include and create object
	include(PHPGRID_LIBPATH."inc/jqgrid_dist.php");

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
	$col["editable"] = true;
	$col["width"] = "10";
	$col["editoptions"] = array("defaultValue"=>"2","readonly"=>"readonly", "style"=>"border:0");
	$col["viewable"] = true;
	$col["hidden"] = true;
	$col["editrules"] = array("edithidden"=>false); 
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

	// $col = array();
	// $col["title"] = "Teacher ID";
	// $col["name"]  = "teacher_id";
	// $col["editable"] = true;
	// $col["width"] = "20";
	// $col["editoptions"] = array("defaultValue"=>"","readonly"=>"readonly", "style"=>"border:0");
	// $col["viewable"] = true;
	// $col["hidden"] = true;
	// $col["editrules"] = array("edithidden"=>false); 
	// $col["export"] = false; // this column will not be exported
	// $cols[] = $col;

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
	$col["title"] = "Grade Level"; // caption of column
	$col["name"] = "grade_level"; 
	$col["width"] = "15";
	$col["editable"] = true;
	$col["align"] = "center";
	$cols[] = $col;

	$col = array();
	$col["title"] = "Teacher";
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
	$col["editoptions"] = array("value"=>":;".$str); 
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

	// $e["on_insert"] = array("add_client", null, false);
	// $grid->set_events($e);

	// function add_client($data)
	// {
	// 	$check_sql = "SELECT count(*) as c from users where subscriber_id = $subid AND type = 2";
		
	// 	$rs = mysql_fetch_assoc(mysql_query($check_sql));

	// 	if ($rs["c"] >= $sub->getStudents())
	// 		phpgrid_error("You have reached the maximum number of students.");

	// 	mysql_query("INSERT INTO clients VALUES (null,'{$data["params"]["user_ID"]}','{$data["params"]["username"]}','{$data["params"]["password"]}','{$data["params"]["type"]}','{$data["params"]["first_name"]}','{$data["params"]["last_name"]}','{$data["params"]["gender"]}','{$data["params"]["teacher_id"]}','{$data["params"]["subscriber_id"]}','{$data["params"]["grade_level"]}','{$data["params"]["is_deleted"]}')");
	// }

	$grid->debug = 0;
	$grid->error_msg = "Username Already Exists.";
	// if($sub->getStudents() != $student_count && $sub->getStudents() > $student_count) :
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
	// else :
	// 	$grid->set_actions(array(
	// 			"add"=>false, // allow/disallow add
	// 			"edit"=>true, // allow/disallow edit
	// 			"delete"=>true, // allow/disallow delete
	// 			"bulkedit"=>true, // allow/disallow edit
	// 			"export_excel"=>true, // export excel button
	// 			//"export_pdf"=>true, // export pdf button
	// 			//"export_csv"=>true, // export csv button
	// 			//"autofilter" => true, // show/hide autofilter for search
	// 			// "rowactions"=>true, // show/hide row wise edit/del/save option
	// 			// "showhidecolumns" => true,
	// 			"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
	// 	));
	// endif;

	$grid->select_command = "SELECT * FROM users WHERE subscriber_id = $subid AND type = 2 AND teacher_id = $userid";

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
	
	<link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<link rel="stylesheet" type="text/css" href="../style.css" />

	<script src="../phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="../phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
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
		<select id="language-menu">
			<?php
				if(!empty($teacher_languages)) :
					foreach($teacher_languages as $tl) : 
						$lang = $lc->getLanguage($tl['language_id']);
			?>
						<option value="<?php echo $lang->getLanguage_code(); ?>" <?php if($language == $lang->getLanguage_code()) { ?> selected <?php } ?>><?php echo $lang->getLanguage(); ?></option>
			<?php 
					endforeach; 
				else :
			?>
				<option value="en_US" <?php if($language == "en_US") { ?> selected <?php } ?>><?php echo _("English"); ?></option>
			<?php endif; ?>
		</select>
		<a href="edit-languages.php" class="link"><?php echo _("Edit Languages"); ?></a>
	</div>
	<div class="fright m-top10" id="accounts">
		<a class="link fright" href="edit-account.php?user_id=<?php echo $userid; ?>&f=0"><?php echo _("My Account"); ?></a>
	</div>
	<div class="clear"></div>
	<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $sub->getFirstName(); ?></span>!</h1>
	<p><?php echo _("This is your Dashboard. In this page, you can manage your teachers and students information"); ?>
	<p><?php echo _("You are only allowed to create " . $sub->getTeachers() . " teachers and " . $sub->getStudents() . " students"); ?>

	<div class="wrap-container">
		<div id="wrap">
			<div class="sub-headers">
				<h1>List of Students</h1>
				<p class="fleft"><?php echo _(' * Click the column title to filter it Ascending or Descending.'); ?></li></p>
				<div class="fright">
					<a href="index.php" class="link" style="display: inline-block;">Manage Teachers</a>
				</div>
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
