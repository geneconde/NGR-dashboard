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
	include_once('../controller/Subscriber.Controller.php');
	include_once '../php/auto-generate-students.php';
	
	$sc = new SubscriberController();
	$sub = $sc->loadSubscriber($user->getSubscriber());

	//add parameter for is_deleted and is_archived later on method is under userController
	//$student_count = $uc->countUserType($user->getSubscriber(), 2);
	
	$userid 			= $user->getUserid();
	$usertype			= $user->getType();
	$subid				= $user->getSubscriber();
	$create_date		= date('Y-m-d');
	$current_date		= date('Y-m-d');
	$expire_date		= date('Y-m-d', strtotime("+30 days"));
	$updated_at 		= date('Y-m-d H:i:s');

	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

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
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true; // this column will not be exported
	// $col["formoptions"] = array("elmsuffix"=>'<font color=red> *</font>');
	$cols[] = $col;

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
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true; 
	$cols[] = $col;

	$col = array();
	$col["title"] = $last_name;
	$col["name"] = "last_name";
	$col["width"] = "30";
	$col["search"] = true;
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true; 
	$cols[] = $col;

	$col = array();
	$col["title"] = $gender;
	$col["name"] = "gender";
	$col["width"] = "10";
	$col["search"] = true;
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
	$col["title"] = $student_portfolio;
	$col["name"] = "view_more";
	$col["width"] = "25";
	$col["align"] = "center";
	$col["search"] = false;
	$col["sortable"] = false;
	$col["link"] = "../view-portfolio.php?user_id={user_ID}"; // e.g. http://domain.com?id={id} given that, there is a column with $col["name"] = "id" exist
	// $col["linkoptions"] = "target='_blank'"; // extra params with <a> tag
	$col["default"] = $view_portfolio; // default link text
	$col["export"] = false; // this column will not be exported
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
				"delete"=>true, // allow/disallow delete
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
	 				"delete"=>true, // allow/disallow delete
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
	<!-- <div class="grey"></div> -->
	<div id="header">

		<a href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>

	</div>
	
	<!-- error and messages -->
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

	<!-- <div class="forgot-password mod-desc">
		<div>
			<legend>Forgot Password</legend>
			<label for="email-add">Enter your email address: </label>
			<input type="password" name="password">
		</div>
		<span class="close-btn"><?php echo _("Close!"); ?></span>
	</div> -->

	<div id="content">
	<br>
	<?php if (isset($user)) { ?>
	<div class="fright" id="logged-in">
		<?php echo _("You are currently logged in as"); ?> <span class="upper bold"><?php echo $user->getUsername(); ?></span>. <a class="link" href="../logout.php"><?php echo _("Logout?"); ?></a>
	</div>
	<?php } ?>
	<div class="clear"></div>

	<a class="link" href="../teacher.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>

	<!-- <div class="fleft" id="language">
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
	</div> -->
	<div class="fright m-top10" id="accounts">
		<!-- <a class="link fright" href="edit-account.php?user_id=<?php echo $userid; ?>"><?php echo _("My Account"); ?></a> -->
	</div>
	<div class="clear"></div>
	<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstName(); ?></span>!</h1>
	<p><?php echo _("This is your Dashboard. In this page, you can manage your students information"); ?>
	<!-- <p><?php echo _("You are only allowed to create " . $student_limit . " students"); ?> -->
  
	<div class="wrap-container">
		<div id="wrap">
			
			<div class="sub-headers">
				<h1><?php echo _('List of Students'); ?></h1>
				<a onclick="showMultipleAddForm()" id="showmutiplebutton" class="link"><?php echo _('Add Students'); ?></a><br/><br/>
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
			<div style="margin:10px 0">
				<?php echo $main_view; ?>
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
				<input type="text" value="" name="student_num" placeholder="Input number of students you want to add" class="validate[required,custom[integer]]"><br/>
		        <input type="submit" id="addmultiplebutton" class="button" name="addmultiple" value="Submit">
		        <a id="cancelbutton2" class="button">Cancel</a>
		    </form>
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
</body>
</html>
