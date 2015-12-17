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
	include_once('../controller/User.Controller.php');
	include_once 'php/auto-generate.php';
	
	$sc = new SubscriberController();
	$uc = new UserController();
	$sub = $sc->loadSubscriber($user->getSubscriber());

	if(isset($_GET['unassign']) && $_GET['unassign'] == 1){
		$uc->updateStudentTeacher($_GET['user_id']);
		header("Location: $_SERVER[HTTP_REFERER]");
	}
	if(isset($_GET['user_id'])) {
		$q = "Select * from users where user_ID=".$_GET['user_id'];
		$current_user_details = $uc->select_custom($q);
		$current_username = $current_user_details[0]['username'];
	}

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
	$reset_student_password = _('Reset Student password');
	$reset_password = _('Reset password');
	$teacher = _('Teacher');
	$action = _('Action');
	$type = _('Type');

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
	$col["searchoptions"] = array("attr"=>array("placeholder"=>'Search Username...')); 
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true;
	$col["editrules"] = array("required"=>true, "readonly"=>false);
	$cols[] = $col;

	$col = array();
	$col["title"] = $type;
	$col["name"]  = "type";
	$col["editable"] = true;
	$col["search"] = true;
	$col["stype"] = "select";
	$col["searchoptions"] = array("value"=>'0:'.$teacher.';4:Sub-Admin');
	$col["width"] = "10";
	$col["edittype"] = "select";
	
	if( isset($_GET['type']))
	{
		if($_GET['type'] == 4)
		{
			$col["editoptions"] = array("value"=>'4:Sub-Admin;0:Teacher');
		
		} elseif($_GET['type'] == 0)
		{
			$col["editoptions"] = array("value"=>'2:Student');
		} 
	} else {
		$col["editoptions"] = array("value"=>'4:Sub-Admin;0:Teacher');
	}
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
	$col["show"] = array("list"=>true, "add"=>true, "edit"=>false, "view"=>true); // disable editing of type in edit form
	$col["editrules"]["readonly"] = true; // the column is not editable inline but available on add form 
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
				$val = _('Teacher');
			break;

			case '1':
				$val = "Parent";
			break;

			case '2':
				$val = _('Student');
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
	$col["searchoptions"] = array("attr"=>array("placeholder"=>'Search First Name...')); 
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true; 
	$col["editrules"] = array("required"=>true, "readonly"=>false);
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
	$col["editrules"] = array("required"=>true, "readonly"=>false);
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
	$col["editoptions"] = array("defaultValue"=>$sub->getID(),"readonly"=>"readonly", "style"=>"border:0");
	/*if(isset($_GET['user_id']))
	{
		$col["editoptions"] = array("defaultValue"=>"$userid","readonly"=>"readonly", "style"=>"border:0");
	} else {
		$col["editoptions"] = array("defaultValue"=>$sub->getID(),"readonly"=>"readonly", "style"=>"border:0");
	}*/
		

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
		$col["hidden"] = true;
		$col["editoptions"] = array("defaultValue"=>$_GET['user_id'],"readonly"=>"readonly", "style"=>"border:0");
		$cols[] = $col;

	} else if(($usertype == 4 && !isset($_GET['type'])) || (isset($_GET['type']) && $_GET['type'] != 0) ) {
		$col = array();
		$col["title"] = "Sub Head";
		$col["name"] = "subhead_id";
		$col["width"] = "30";
		$col["search"] = true;
		$col["editable"] = true;
		$col["align"] = "center";
		$col["export"] = true;
		$col["hidden"] = true;
		$col["editoptions"] = array("defaultValue"=>$userid,"readonly"=>"readonly", "style"=>"border:0");
		$cols[] = $col;
	}

	if( !isset($_GET['type']) || $_GET['type'] != 0 ) 
	{
		$col = array();
		$col["title"] = $accounts;
		$col["name"] = "view_more";
		$col["width"] = "25";
		$col["align"] = "center";
		$col["search"] = false;
		$col["sortable"] = false;
		$col["default"] = $view_tier; // default link text
		if(isset($_GET['user_id']))
		{
			$col["link"] = "index.php?user_id={user_ID}&type={type}&sid={subhead_id}";
		} else {
			$col["link"] = "index.php?user_id={user_ID}&type={type}";
		}
		$cols[] = $col;
	
	}

	if(isset($_GET['type']) && $_GET['type'] == 0)
	{
		$col = array();
		$col["title"] = "Sub Head";
		$col["name"] = "subhead_id";
		$col["width"] = "30";
		$col["search"] = true;
		$col["editable"] = true;
		$col["align"] = "center";
		$col["export"] = true;
		$col["hidden"] = true;
		if(isset($_GET['sid']))
			$col["editoptions"] = array("defaultValue"=>$_GET['sid'],"readonly"=>"readonly", "style"=>"border:0");
		else
			$col["editoptions"] = array("defaultValue"=>$userid,"readonly"=>"readonly", "style"=>"border:0");
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
		if(isset($_GET['sid']))
		{
			$str = $grid->get_dropdown_values("SELECT distinct user_ID AS k, concat(first_name, ' ',last_name) AS v FROM users WHERE subhead_id ='". $_GET['sid']. "' AND type=0");
		} else {
			$str = $grid->get_dropdown_values("SELECT distinct user_ID AS k, concat(first_name, ' ',last_name) AS v FROM users WHERE user_id ='". $_GET['user_id']. "' AND type=0");
		}
		$col["editoptions"] = array("value"=>$str); 
		$col["formatter"] = "select"; // display label, not value
		$cols[] = $col;

		// $col = array();
		// $col["title"] = $reset_student_password;
		// $col["name"] = "reset_pword";
		// $col["width"] = "30";
		// $col["align"] = "center";
		// $col["search"] = false;
		// $col["sortable"] = false;
		// $col["link"] = "../reset-password.php?user_id={user_ID}"; // e.g. http://domain.com?id={id} given that, there is a column with $col["name"] = "id" exist
		// $col["default"] = $reset_password; // default link text
		// $col["export"] = false; // this column will not be exported
		// $cols[] = $col;

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
		if(conf==true) window.location = "index.php?user_id={user_ID}&unassign=1";';
		$col["default"] = "unassign";
		$col["export"] = false;
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

			if($_GET['type'] == 4 )
			{
				$q = "SELECT * FROM users WHERE subhead_id =". $_GET['user_id']." AND type <> 2";
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
				$q = "SELECT * FROM users WHERE user_id =" . $userid  . " AND type = 0 AND type <> 2";
				$grid->select_command = $q;

			} 
			$filename = "Subhead Accounts";

		}
		elseif($usertype == 4 && $subhead_id != null) 
		{
			$q1 = "SELECT * FROM users WHERE subhead_id =". $userid." AND type <> 2";
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

	$e["on_insert"] = array("create_account", null, true);
	$e["on_update"] = array("update_client", null, true);
	$e["on_delete"] = array("delete_client", null, true);
	$grid->set_events($e);

	function create_account($data) 
	{
		$data["params"]["username"] = trim($data["params"]["username"]);
		// phpgrid_error(print_r($data["params"]));
	}
	function update_client($data) 
	{
		$data['params']['teacher_id'] = 0;
		$data["params"]["username"] = trim($data["params"]["username"]);
		$sid = $data['params']['subhead_id'];
		$thisId = $data['params']['user_ID'];
		$query = "UPDATE users SET subhead_id = ". $sid ." where type=2 and teacher_id = ".$thisId;
		mysql_query($query);
	}
	function delete_client($data) 
	{
		$thisId = $data['user_ID'];
		$query = "SELECT * from users where user_ID=".$thisId;
    	$rs = mysql_fetch_assoc(mysql_query($query));
    	$parent = $rs['subhead_id'];
    	if(empty($parent)) $parent = 'null';
    	$query = "UPDATE users SET is_floating = ".$parent." where subhead_id = ".$thisId;
		mysql_query($query);
		// phpgrid_error($parent);
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

	$grid->debug = 0;
	$grid->error_msg = "Please change the username as this is already used.";

	$grid->table = "users";

	$grid->set_columns($cols); 

	$main_view = $grid->render("list1");

	if(isset($_POST['addmultiple'])){
		if($_POST['student_num'] != "") {
			if($_POST['student_num'] > $difference){
				header("Location: index.php?err=1");
			} else {
				generateStudents($_POST['student_num'], $user->getSubscriber(), $user->getUserid());
				header("Location: index.php?msg=1");
			}
		} else {
			header("Location: index.php?err=2");
		}
	}

?>
<?php require_once 'header.php'; ?>

<style>
	.ui-icon { display: inline-block !important; }

	#delmodlist1 { width: auto !important; min-width: 240px; }
	tr td:nth-child(13) a {
	  background: rgb(66, 151, 215);
	  color: #fff;
	  padding: 3px 5px;
	  border-radius: 3px;
	}
	tr td:nth-child(13) a:hover, tr td:nth-child(13) a:link, tr td:nth-child(13) a:visited, tr td:nth-child(13) a:focus {
	    color: #fff;
	}
	#list1_act { width: auto !important; }
	#list1_act > #jqgh_list1_act { margin-bottom: -15px; }
	tr input { width: 90% !important; }
	.ui-jqgrid .ui-search-input input { width: 100% !important; }
	.ui-pg-input { width: auto !important; }
	.DataTD input { width: 88% !important; }
	a.current { color: gray; cursor: default; }
</style>

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

<div class="top-buttons">
	<div class="wrap">
		<?php $active = 'dashboard'; ?>
		<?php include "menu.php"; ?>
	</div>
</div>

<div id="content">
<div class='wrap'>

	<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstName(); ?></span>!</h1>
	<?php
	if(isset($_GET["ft"])):
		if($_GET["ft"]==1): ?>
			<div class="first-timer">
				<p><?php echo _("It looks like this is your first time to visit your dashboard..."); ?><br/>
				<?php echo _('Here at NexGenReady, we place great emphasis on making our interface easy for you to use. To help you learn how to get the most out of all the features of our site, you can click on the <button class="uppercase guide" onClick="guide()">Guide Me</button>button on each page. This will help you navigate and utilize all the things you can do in each section.'); ?></p>
			</div>
		<?php
		endif;
	endif;
	?>
	<p><?php echo _("This is the Account Management page, where you can manage all teachers, sub-admins and students accounts under you."); ?>

	<div class="wrap-container">
		<div id="wrap">
			<div class="sub-headers">
				<?php if(isset($_GET['user_id'])) { ?>
				<h1><?php echo _('List of Accounts Under ') . $current_username; ?></h1>
				<?php } else { ?>
				<h1><?php echo _('List of Accounts'); ?></h1>
				<?php } ?>
				
				<p class="fleft"> * <?php echo _('Click the column title to filter it Ascending or Descending.'); ?></p><br>
				<p class="fleft"> * <?php echo _('Refresh your browser to fix the table.'); ?></p>
				<br><br>
				<div class="fright">
					<a href="index.php" class="link current" style="display: inline-block;"><?php echo _('Manage Accounts'); ?></a> | 
					<a href="manage-students.php" class="link" style="display: inline-block;"><?php echo _('Manage Students'); ?></a> | 
					<a href="unassigned-students.php" class="link" style="display: inline-block;"><?php echo _('Unassigned Students'); ?></a> | 
					<a href="floating-accounts.php" class="link" style="display: inline-block;"><?php echo _('Floating Accounts'); ?></a>
				</div>
			<div class="clear"></div>
				<div class="fleft">
					<?php if(isset($_GET['user_id'])) : ?>
						<a href="index.php" class="link" style="display: inline-block;"><?php echo _('Home'); ?></a> |					
						<a href="javascript:history.back(1)" class="link" style="display: inline-block;"><?php echo _('Back'); ?></a>
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

			<div style="margin:10px 0" class="phpgrid">					
				<?php echo $main_view; ?>
			</div>
		</div>
	</div>

	<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
	  <li class="tlypageguide_top" data-tourtarget="#jqgh_list1_username">
		<p><?php echo _('To update information, you can do any of the following:'); ?></p>
		<p>1. <?php echo _('Double click on a cell to update the information then press Enter'); ?></p>
	  </li>
	  <li class="tlypageguide_left" data-tourtarget=".ui-custom-icon">
		<p>2. <?php echo _('Click the pencil icon <span class="ui-icon ui-icon-pencil"></span> in the <strong>Actions</strong> column to update all cells then press Enter; or'); ?></p>
	  </li>
	  <li class="tlypageguide_left" data-tourtarget="tr.jqgrow td .cbox">
		<p>3. <?php echo _('Click the checkbox in the first column of any row then click the pencil icon <span class="ui-icon ui-icon-pencil "></span> at the bottom left of the table.'); ?></p>
	  </li>
	  <li class="tlypageguide_left" data-tourtarget="#cb_list1">
		<p>4. <?php echo _('To update a column for multiple accounts (same information in the same column for multiple accounts), click the checkbox of multiple rows and click the <strong>Bulk Edit</strong> button at the bottom of the table. A pop up will show. Update only the field/s that you want to update and it will be applied to the accounts you selected.'); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget="#search_list1">
		<p><?php echo _('To search for a record, click the magnifying glass icon <span class="ui-icon ui-icon-search"></span> at the bottom of the table.'); ?></p>
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
		<p><?php echo _('You can also modify the number of accounts you want to show in a page.'); ?></p>
	  </li>
	  <li class="tlypageguide_top" data-tourtarget="#jqgh_list1_view_more">
		<p><?php echo _('You may also view the accounts under you.'); ?></p>
	  </li>
	</ul>

	<!-- simple form, used to add a new row -->
    <div id="multipleaddform">
        <div class="row">
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="add_multiple_form">
				<?php $diff = $sub->getTeachers() - $teacher_count; ?>
				<!-- <p><?php echo _('You have already created') ?> <?php echo $teacher_count . '/' . $sub->getTeachers(); ?> <?php echo _('teachers'); ?></p><br/> -->
				<label><?php echo _('Teacher'); ?></label>:
				<input type="text" value="" name="teacher_num" placeholder="<?php echo _('Input number of teachers you want to add'); ?>" class="validate[required,custom[integer]]"><br/>
		        <input type="submit" id="addmultiplebutton" class="button" name="addmultiple" value="Submit">
		        <a id="cancelbutton2" class="button"><?php echo _('Cancel'); ?></a>
		    </form>
        </div>
    </div>	
	</div>

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
			// jQuery("#add_multiple_form").validationEngine();

			var type = "<?php echo $_GET['type']; ?>";
			if(type == '0') {
				$("tr th:nth-child(12)").each(function() {
				    var t = $(this);
				    var n = t.next();
				    t.html(t.html() + n.html());
				    n.remove();
				});
			}

			$("a.current").click(function(){
				event.preventDefault();
			});
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

		function cdl(event, element){
			var type = "<?=$_GET['type']?>";
			if(type=='0'){
				var cdl = confirm("Are you sure you want to delete this student account?");
				if(!cdl){ event.stopPropagation(); }
			} else { return true; }
		}
	</script>
<?php require_once "footer.php"; ?>