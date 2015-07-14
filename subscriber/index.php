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
	$uc = new UserController();
	$sub = $sc->loadSubscriber($user->getSubscriber());

	$ufl = $user->getFirstLogin();
	if($ufl == 1){ header("Location: account-update.php"); }
	//add parameter for is_deleted and is_archived later on method is under userController
	$teacher_count = $uc->countUserType($user->getSubscriber(), 0);

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

	$difference = $sub->getTeachers() - $teacher_count;

	if(isset($_POST['addmultiple'])){
		if($_POST['teacher_num'] != "") {
			generateTeachers($_POST['teacher_num'], $sub->getID());
			header("Location: index.php?msg=1");

		} else {
			header("Location: index.php?err=2");
		}			
	}

	// include db config
	include_once("../phpgrid/config.php");

	// set up DB
	mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
	mysql_select_db(PHPGRID_DBNAME);

	// include and create object
	include(PHPGRID_LIBPATH."inc/jqgrid_dist.php");
	$grid = new jqgrid();

	/** Main Grid Table **/
	$username = _('Username');
	$password = _('Password');
	$first_name = _('First Name');
	$last_name = _('Last Name');
	$gender = _('Gender');
	$grade_level = _('Grade Level');
	$accounts = _('Accounts');
	$view_tier = _('View Accounts');

	/** Main Grid Table **/
	$col = array();
	$col["title"] = "User ID";
	$col["name"] = "user_id";
	$col["editable"] = false;
	$col["export"] = false;
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
	$col["export"] = true;
	$cols[] = $col;

	$col = array();
	$col["title"] = "Type";
	$col["name"]  = "type";
	$col["editable"] = true;
	$col["width"] = "10";
	$col["edittype"] = "select";
	$col["editoptions"] = array("value"=>'4:Sub-Admin;0:Teacher;2:Student');
	/*if(isset($_GET['user_id']) && isset($_GET['type']))
	{
		if($_GET['type'] == 0)
		{
			$col["editoptions"] = array("value"=>'0:Teacher');

		} elseif($_GET['type'] == 2)
		{
			$col["editoptions"] = array("value"=>'2:Student');
		}elseif($_GET['type'] == 4)
		{
			$col["editoptions"] = array("value"=>'4:Sub-Admin');
		} 
	} else {
			$col["editoptions"] = array("value"=>'4:Sub-Admin;0:Teacher;2:Student');
		}*/


	$col["viewable"] = false;
	$col["editrules"] = array("edithidden"=>hidden); 
	$col["export"] = false; // this column will not be exported
	$col["on_data_display"] = array("getUserType","");
	$col["align"] = "center";

	function getUserType($data)
	{
		$type = $data["type"];
		$val = "";
		
		switch($type)
		{
			case '0':
				$val = "Teacher";
			break;

			case '1':
				$val = "Parent";
			break;

			case '2':
				$val = "Student";
			break;

			case '3':
				$val = "Subscriber";
			break;

			case '4':
				$val = "Sub-Admin";
			break;

			default:				
				$val = "None";
			break;
		}

		return $val;	
	}
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
	$col["title"] = "Subscriber ID";
	$col["name"]  = "subscriber_id";
	$col["editable"] = true;
	if(isset($_GET['user_id']))
	{
		$col["editoptions"] = array("defaultValue"=>"$userid","readonly"=>"readonly", "style"=>"border:0");
	} else {
		$col["editoptions"] = array("defaultValue"=>$sub->getID(),"readonly"=>"readonly", "style"=>"border:0");
	}
		

	$col["viewable"] = false;
	$col["hidden"] = true;
	$col["editrules"] = array("edithidden"=>false); 
	$col["export"] = false; // this column will not be exported
	$cols[] = $col;

	if( isset($_GET['type']) && $_GET['type'] == 0 ) 
	{
		$col = array();
		$col["title"] = $grade_level; // caption of column
		$col["name"] = "grade_level";
		$col["width"] = "15";
		$col["editable"] = true;
		$col["align"] = "center";
		$cols[] = $col;
	}


	if(isset($_GET['user_id']) && $_GET['type'] != 0)
	{
		$col = array();
		$col["title"] = "Sub Head";
		$col["name"] = "subhead_id";
		$col["width"] = "30";
		$col["search"] = true;
		$col["editable"] = true;
		$col["align"] = "center";
		$col["export"] = true; 
		$col["editoptions"] = array("defaultValue"=>$_GET['user_id'],"readonly"=>"readonly", "style"=>"border:0");
		$cols[] = $col;

	} 

	if( !isset($_GET['type']) || $_GET['type'] != 0 ) 
	{		
		$col = array();
		$col["title"] = "Accounts";
		$col["name"] = "view_more";
		$col["width"] = "25";
		$col["align"] = "center";
		$col["search"] = false;
		$col["sortable"] = false;
		$col["default"] = $view_tier; // default link text
		if(isset($_GET['user_id']))
		{
			$col["link"] = "index.php?lang=en_US&user_id={user_ID}&type={type}&sid={subhead_id}";
		} else {
			$col["link"] = "index.php?lang=en_US&user_id={user_ID}&type={type}";
		}
		$cols[] = $col;
	
	}

	if(isset($_GET['type']) && $_GET['type'] == 0)
	{
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
		$str = $grid->get_dropdown_values("SELECT distinct user_ID AS k, concat(first_name, ' ',last_name) AS v FROM users WHERE subhead_id ='". $_GET['sid']. "' AND type=0");
		$col["editoptions"] = array("value"=>$str); 
		$col["formatter"] = "select"; // display label, not value
		$cols[] = $col;

		$col = array();
		$col["title"] = "Reset Student password";
		$col["name"] = "reset_pword";
		$col["width"] = "30";
		$col["align"] = "center";
		$col["search"] = false;
		$col["sortable"] = false;
		$col["link"] = "../reset-password.php?user_id={user_ID}"; // e.g. http://domain.com?id={id} given that, there is a column with $col["name"] = "id" exist
		$col["default"] = "Reset password"; // default link text
		$col["export"] = false; // this column will not be exported
		$cols[] = $col;
	}

	//Export filename
	$filename = "";
	
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
				//$student_account = true;
			}

			if( $_GET['type'] == 4 )
			{	
				$q = "SELECT * FROM users WHERE subhead_id =". $_GET['user_id'];			
				$grid->select_command = $q;
				$result = mysql_query($q);
				$count = mysql_num_rows($result);				
				

				if ($count != 0) 
				{
					$grid->select_command = $q;
				}

			}
		}


	} else {

		if($usertype == 4 && $subhead_id == null)
		{			
			$q = $uc->getUserLevel($userid);
			$grid->select_command =$q;

			//if there are no subhead get teachers
			$result = mysql_query($q);
			$count = mysql_num_rows($result);
			
			if($count == 0)
			{
				$q = "SELECT * FROM users WHERE user_id =" . $userid  . " AND type = 0";
				$grid->select_command = $q;

			} 
			$filename = "Subhead Accounts";

		} 
		elseif($usertype == 4 && $subhead_id != null) 
		{
			$q1 = "SELECT * FROM users WHERE subhead_id =". $userid;
			$grid->select_command = $q1;
			$result1 = mysql_query($q1);
			$count1 = mysql_num_rows($result1);
			
			$filename = "Teacher Accounts";
			if ($count1 != 0) 
			{
				$grid->select_command = $q1;
			}
		}
		
		elseif ($usertype == 3) 
		{
			/*$q = "SELECT * FROM users WHERE subscriber_id =". $subid . " AND type = 4 AND subhead_id IS NULL AND teacher_id = 0";*/
			$q = "SELECT * FROM users WHERE subscriber_id =". $subid . " AND subhead_id IS NULL AND (type != 2 AND type != 3)";
			$grid->select_command = $q;	
			$filename = "Subhead Accounts";
			
			$result = mysql_query($q);
			$count = mysql_num_rows($result);
			if($count == 0)
			{
				$q2 = "SELECT * FROM users WHERE subscriber_id =" . $subid  . " AND type = 0";
				$grid->select_command = $q2;
				$filename = "Teacher Accounts";
			} 	
		}		
	}
		//For exporting
		$opt["caption"] = $accounts;
		$opt["height"] = "";
		$opt["autowidth"] = true; // expand grid to screen width
		$opt["multiselect"] = true; // allow you to multi-select through checkboxes
		$opt["hiddengrid"] = false;
		$opt["reloadedit"] = true;

		if($filename == null)
		{
			$filename = "Accounts";
		}
		$opt["export"] = array("filename"=>$filename, "heading"=>$filename, "orientation"=>"landscape", "paper"=>"a4");
		$opt["export"]["sheetname"] = $filename;
		$opt["export"]["range"] = "filtered";

		$grid->set_options($opt);

	$grid->set_actions(array(
		"add"=>true,
		"edit"=>true, 
		"delete"=>true, 
		"bulkedit"=>true, 
		"export_excel"=>true,
		"search" => "advance"
	));

	$grid->table = "users";

	$grid->set_columns($cols); 

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

	<script src="../phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="../phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

	<style>
	.ui-search-toolbar { display: none; }
	.fleft { margin-top: -16px; }
	.guide {
		padding: 5px;
		background-color: orange;
		border-radius: 5px;
		border: none;
		font-size: 10px;
		color: #000;
		cursor: pointer;
	}
	.tguide { font-family: inherit; }
	.guide:hover {
		background-color: orange;
	}
	.joytest2 ~ div a:nth-child(3){
	    display: none;
	}
	.joyride-tip-guide:nth-child(12){
	    margin-top: 15px !important;
	}
	.ui-icon {
	  display: inline-block !important;
	}
	<?php if($language == "ar_EG") { ?>
	.tguide { float: right; }
	<?php } ?>

	/*End custom joyride*/
	#dbguide {margin-top: 10px; float: left;}
	#accounts {margin-top: 3px;}
	.first-timer {
		background-color: #D6E3BC;
		border-radius: 25px;
		width: 95%;
		margin: 0 auto;
		margin-bottom: 10px;
	}
	.first-timer p{
		padding: 15px;
		line-height: 1.4rem;
		font: 18px;
	}
	.first-timer button{
		padding: 5px;
	}
	a.ngss_link:hover {
		text-decoration: none;
		background-color: #FAEBD7;
	}
	.mright10 {
		margin-right: 10px;
	}
	</style>

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

		<a href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>

	</div>
	
	<!-- error and messages -->
	<?php if(isset($_GET['err'])) : ?>
		<?php if($_GET['err'] == 1) : ?>
			<div class="error-msg"><p><?php echo _('Error! you are only allowed to create'); ?> <?php echo $sub->getTeachers(); ?> <?php echo _('teachers'); ?></p></div>
		<?php endif; ?>
		<?php if($_GET['err'] == 2) : ?>
			<div class="error-msg"><p><?php echo _('Please input a valid teacher value.'); ?></p></div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if(isset($_GET['msg'])) : ?>
		<?php if($_GET['msg'] == 1) : ?>
			<div class="success-msg" style="background-color: green; padding: 5px; text-align: center;"><p style="color: white;"><?php echo _('Successfully created teachers.'); ?></p></div>

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
	<div id="dbguide">
		<button class="uppercase guide tguide" onClick="guide()">Guide Me</button>
	</div>
	<a class="uppercase fright manage-box" href="edit-account.php?user_id=<?php echo $userid; ?>"/><?php echo _("Manage My Account"); ?></a>
	<a class="uppercase fright manage-box mright10" href="../../marketing/ngss.php"/><?php echo _("See the NGSS Alignment"); ?></a>
	
	
	<div class="clear"></div>

	<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstName(); ?></span>!</h1>
	<?php
	if(isset($_GET["ft"])):
		if($_GET["ft"]==1): ?>
			<div class="first-timer">
				<p>It looks like this is your first time to visit your dashboard...<br/>
				Here at NexGenReady, we place great emphasis on making our interface easy for you to use. To help you learn how to get the most out of all the features of our site, you can click on the <button class="uppercase guide" onClick="guide()">Guide Me</button>button on each page. This will help you navigate and utilize all the things you can do in each section.</p>
			</div>
		<?php
		endif;
	endif;
	?>
	<p><?php echo _("This is your Dashboard. In this page, You can manage all accounts under you."); ?>

	<div class="wrap-container">
		<div id="wrap">
			
			<div class="sub-headers">
				<h1>List of Accounts</h1>
				
				<p class="fleft"><?php echo _(' * Click the column title to filter it Ascending or Descending.'); ?></p><br><br>
				<div class="fright">
					<!-- <a href="import-csv.php" class="link" style="display: inline-block;">Import Teachers</a> | -->
					<a href="view-modules.php" class="link" style="display: inline-block;">View Modules</a> |					
					<a href="manage-students.php" class="link" style="display: inline-block;">Manage All Students</a>
				</div>
			<div class="clear"></div>
				<div class="fleft">
					<?php if(isset($_GET['user_id'])) : ?>
						<a href="index.php" class="link" style="display: inline-block;">Home</a> |					
						<a href="javascript:history.back(1)" class="link" style="display: inline-block;">Back</a>
					<?php endif; ?>
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

			<div style="margin:10px 0">					
				<?php echo $main_view; ?>
			</div>
		</div>
	</div>

	<!-- Tip Content -->
    <ol id="joyRideTipContent">
		<li data-id="jqgh_list1_username" data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>To update information, you can do any of the following:</p>
			<p>1. Double click on a cell to update the information then click Enter</p>
		</li>
		<li data-class="ui-custom-icon" data-text="Next" data-options="tipLocation:right;tipAnimation:fade">
			<p>2. Click the pencil icon <span class="ui-icon ui-icon-pencil"></span> in the <strong>Actions</strong> column to update all cells then click Enter; or</p>
		</li>
		<li data-class="cbox" data-text="Next" data-options="tipLocation:left;tipAnimation:fade">
			<p>3. Click the checkbox in the first column of any row then click the pencil icon <span class="ui-icon ui-icon-pencil "></span> at the bottom left of the table.</p>
		</li>
		<li data-id="cb_list1" data-text="Next" data-options="tipLocation:left;tipAnimation:fade">
			<p>4. To update a column for multiple accounts (same information in the same column for multiple accounts), click the checkbox of multiple rows and click the <strong>Bulk Edit</strong> button at the bottom of the table. A pop up will show. Update only the field/s that you want to update and it will be applied to the accounts you selected.</p>
		</li>
		<li data-id="search_list1" data-text="Next" data-options="tipLocation:left;tipAnimation:fade">
			<p>To search for a record, click the magnifying glass icon <span class="ui-icon ui-icon-search"></span> at the bottom of the table.</p>
		</li>
		<li data-class="ui-icon-extlink" data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>To export/save the student list to an Excel file, click the <strong>Excel</strong> button at the bottom of the table.</p>
		</li>
		<li data-id="next_list1_pager" data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Go to the next set of accounts by clicking the left and right arrows; or</p>
		</li>
		<li data-class="ui-pg-input" data-text="Next" data-options="tipLocation:left;tipAnimation:fade">
			<p>Type in the page number and press Enter.</p>
		</li>
		<li data-class="ui-pg-selbox" data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>You can also modify the number of accounts you want to show in a page.</p>
		</li>
		<li data-id="jqgh_list1_view_more" data-text="Close" data-options="tipLocation:top;tipAnimation:fade">
			<p>You may also view the accounts under you.</p>
		</li>
    </ol>

	<!-- simple form, used to add a new row -->
    <div id="multipleaddform">
        <div class="row">
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="add_multiple_form">
				<?php $diff = $sub->getTeachers() - $teacher_count; ?>
				<!-- <p><?php echo _('You have already created') ?> <?php echo $teacher_count . '/' . $sub->getTeachers(); ?> <?php echo _('teachers'); ?></p><br/> -->
				<label><?php echo _('Teacher'); ?></label>:
				<input type="text" value="" name="teacher_num" placeholder="Input number of teachers you want to add" class="validate[required,custom[integer]]"><br/>
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
	
	<!-- jQuery Validation Engine -->
	<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
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
