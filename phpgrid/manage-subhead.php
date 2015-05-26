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
	$uc = new UserController();
	$sub = $sc->loadSubscriber($user->getSubscriber());

	//add parameter for is_deleted and is_archived later on method is under userController
	//$student_count = $uc->countUserType($user->getSubscriber(), 2);
	
	$userid 			= $user->getUserid();
	$usertype			= $user->getType();
	$subid				= $user->getSubscriber();
	$subhead_id			= $user->getSubheadid();
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

    $url = $_SERVER['REQUEST_URI'];

	$username = _('Username');
	$password = _('Password');
	$first_name = _('First Name');
	$last_name = _('Last Name');
	$gender = _('Gender');
	$grade_level = _('Grade Level');
	$student_information = _('Sub head');
	$view_tier = _('View Level');

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
	$col["title"] = "Tiers";
	$col["name"] = "view_more";
	$col["width"] = "25";
	$col["align"] = "center";
	$col["search"] = false;
	$col["sortable"] = false;
	$col["link"] = "manage-subhead.php?lang=en_US&user_id={user_ID}&type={type}"; // e.g. http://domain.com?id={id} given that, there is a column with $col["name"] = "id" exist
	// $col["linkoptions"] = "target='_blank'"; // extra params with <a> tag
	$col["default"] = $view_tier; // default link text
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

$manage = "";
$subhead = false;
	if(isset($_GET['user_id']))
	{
		$query = $uc->getUserLevel($_GET['user_id']);
		$grid->select_command = $query;
		$result = mysql_query($uc->getUserLevel($_GET['user_id']));
		$count = mysql_num_rows($result);

		if(isset($_GET['type']))
		{
			if( $_GET['type'] == 0 )
			{				
				$q = "SELECT * FROM users WHERE subscriber_id =". $subid . " AND type = 2 AND teacher_id=".$_GET['user_id'];
				$grid->select_command = $q;
			}
		}


	} else {
		
		if($usertype == 4)
		{
			$q = "SELECT * FROM users WHERE subscriber_id =". $subid . " AND user_id=".$userid." AND type = 4 AND subhead_id IS NULL AND teacher_id = 0";
			$grid->select_command = $q;

			//if there are no subhead get teachers
			$result = mysql_query($q);
			$count = mysql_num_rows($result);
			
			if($count == 0)
			{
				$q = "SELECT * FROM users WHERE user_id =" . $userid  . " AND type = 0";
				$grid->select_command = $q;
			} 

			//Check if it has a subhead get their levels
			$q1 = "SELECT * FROM users WHERE subscriber_id =". $subid . " AND user_id=".$userid." AND type = 4 AND teacher_id = 0";
			$result1 = mysql_query($q1);
			$count1 = mysql_num_rows($result1);

			if ($count1 != 0) 
			{
				$grid->select_command = $q1;
			}
		}
		
		elseif ($usertype == 3) 
		{
			$q = "SELECT * FROM users WHERE subscriber_id =". $subid . " AND type = 4 AND subhead_id IS NULL AND teacher_id = 0";
			$grid->select_command = $q;	

			$result = mysql_query($q);
			$count = mysql_num_rows($result);
			$subhead = true;
			if($count == 0)
			{
				$q2 = "SELECT * FROM users WHERE subscriber_id =" . $subid  . " AND type = 0";
				$grid->select_command = $q2;
				$manage = "teachers";
				$subhead = false;
			} 	
		}		
	}
		

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
			<div class="error-msg"><p><?php echo _('Error! you are only allowed to create'); ?> <?php echo $student_limit; ?> <?php echo _('students'); ?></p></div>
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

	<div id="content">
	<br>
	<?php if (isset($user)) { ?>
	<div class="fright" id="logged-in">
		<?php echo _("You are currently logged in as"); ?> <span class="upper bold"><?php echo $user->getUsername(); ?></span>. <a class="link" href="../logout.php"><?php echo _("Logout?"); ?></a>
	</div>
	<?php } ?>
	<div class="clear"></div>

	<a class="link" href="../teacher.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>

	<div class="clear"></div>
	
	<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstName(); ?></span>!</h1>
	<?php if($usertype == 3 && $subhead == true) : ?>
		<p><?php echo _("This is your Dashboard. In this page, you can manage your sub heads"); ?>
	<?php elseif($usertype == 3 && $subhead == false) : ?>
		<p><?php echo _("This is your Dashboard. In this page, you can manage your students"); ?>
	<?php elseif($usertype == 4) : ?>
		<p><?php echo _("This is your Dashboard. In this page, you can manage your teachers"); ?>
	<?php endif; ?>
	<div class="wrap-container">
		<div id="wrap">
			
			<div class="sub-headers">
				<h1><?php echo _('List of Sub head'); ?></h1>				
				<p> * <?php echo _('Click the column title to filter it Ascending or Descending.'); ?></li></p>
				
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
		
			<div style="margin:10px 0">	
				<!-- <?php if(isset($_GET['user_id'])) : ?>				
					<h1><?php echo $uc->getUserLevel($_GET['user_id']); ?></h1>
				<?php endif; ?> -->				
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

	
	</script>

</body>
</html>
