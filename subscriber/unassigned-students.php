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

	$uc = new UserController();

	//add parameter for is_deleted and is_archived later on method is under userController
	$student_count = $uc->countUserType($user->getSubscriber(), 2);

	$userid 			= $user->getUserid();
	$usertype			= $user->getType();
	$subid				= $user->getSubscriber();

	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

	$difference = $sub->getStudents() - $student_count;

	$teach = 0;
	// include db config
	include_once("../phpgrid/config.php");

	// set up DB
	mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
	mysql_select_db(PHPGRID_DBNAME);

	// include and create object
	include(PHPGRID_LIBPATH."inc/jqgrid_dist.php");

	$username = _('Username');
	$first_name = _('First Name');
	$last_name = _('Last Name');
	$teacher = _('Teacher');
	$type = _('Type');
	$unassigned = _('Unassigned Students');

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
	$col["searchoptions"] = array("attr"=>array("placeholder"=>'Search Username...')); 
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
	$col["title"] = $type;
	$col["name"]  = "type";
	$col["editable"] = false;
	$col["search"] = false;
	$col["width"] = "20";
	$col["viewable"] = true;
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
				$val = _("Teacher");
				$teach = 1;
			break;

			case '1':
				$val = "Parent";
			break;

			case '2':
				$val = _("Student");
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
	$col["title"] = $teacher;
	$col["name"] = "teacher_id";
	$col["dbname"] = "users.teacher_id"; // this is required as we need to search in name field, not id
	$col["width"] = "30";
	$col["align"] = "center";
	$col["edittype"] = "select"; // render as select
	$col["search"] = false;
	$col["export"] = false;
	$col["editable"] = true;
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

	$opt["caption"] = $unassigned;
	$opt["height"] = "";
	$opt["autowidth"] = true; // expand grid to screen width
	$opt["multiselect"] = true; // allow you to multi-select through checkboxes
	$opt["hiddengrid"] = false;
	$opt["reloadedit"] = true;

	//Export Options
	$opt["export"] = array("filename"=>"Student Information", "heading"=>"Student Information", "orientation"=>"landscape", "paper"=>"a4");
	$opt["export"]["sheetname"] = "Student Information";
	$opt["export"]["range"] = "filtered";
	$opt["reloadedit"] = true;
	$grid->set_options($opt);

	$e["on_update"] = array("update_student", null, true);
	$grid->set_events($e);

	function update_student($data)
	{
		$thisId = $data['params']['user_ID'];
		$tid = $data['params']['teacher_id'];
		$query = "SELECT * from users where user_ID=".$tid;
    	$rs = mysql_fetch_assoc(mysql_query($query));
    	$sid = $rs['subhead_id'];
		$data['params']['type'] = 2;
		$data["params"]["subhead_id"] = $sid;
		$data["params"]["username"] = trim($data["params"]["username"]);
	}

	$grid->debug = 0;
	$grid->error_msg = "Username Already Exists.";
	/*echo '<h1>'. $sub->getStudents() . '</h1>';*/

	if($sub->getStudents() <= $student_count) :
		
		$grid->set_actions(array(
				"add"=>false,
				"edit"=>true,
				"delete"=>true,
				"bulkedit"=>false,
				"export_excel"=>true,
				"search" => "advance"
			));

	else :			
		$grid->set_actions(array(
				"add"=>false,
				"edit"=>true,
				"delete"=>true,
				"bulkedit"=>false,
				"export_excel"=>true,
				"search" => "advance"
		));

	endif;

	if($usertype==3)
		$grid->select_command = "SELECT * FROM users WHERE subscriber_id=$subid AND type=2 AND (teacher_id = 0 or teacher_id not in (SELECT user_id FROM users))";
	else{
		$subadmin_list = array();
		$subadmin_list = getUsers($userid);
		$subheads = '(subhead_id='.$userid;
		foreach ($subadmin_list as $string) {
			$subheads .= ' or subhead_id='.$string;
		}
		$subheads .= ")";
		$grid->select_command = "SELECT * FROM users WHERE subscriber_id = $subid AND $subheads AND type = 2 AND (teacher_id = 0 or teacher_id not in (SELECT user_id FROM users))";
	}

	function getUsers($subhead_id){
		$subadmin_list = array();
		$query = "SELECT * FROM users WHERE type=4 and subhead_id=".$subhead_id;
		$users = UserController::select_custom($query);
		if(!empty($users)) {
			foreach ($users as $user) {
				$query = "SELECT * FROM users WHERE type=4 and subhead_id=".$user['user_ID'];
				$users2 = UserController::select_custom($query);
				if(!empty($users2)){
					$res = getUsers($user['user_ID']);
					foreach ($res as $value) {
						array_push($subadmin_list, $value);
					}
				} else {
					array_push($subadmin_list, $user['user_ID']);
				}
			}
		} else {
			array_push($subadmin_list, $subhead_id);
		}
		return $subadmin_list;
	}

	$grid->table = "users";

	$grid->set_columns($cols); // pass the cooked columns to grid

	$main_view = $grid->render("list1");

?>
<?php require_once 'header.php'; ?>

	<style>
		.ui-icon { display: inline-block !important; }
		#delmodlist1 { width: auto !important; min-width: 240px; }
		a.current { color: gray; cursor: default; }
	</style>

<div class="top-buttons">
	<div class="wrap">
		<?php $active = 'dashboard'; ?>
		<?php include "menu.php"; ?>
	</div>
</div>

<div id="content">
<div class='wrap'>

	<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $sub->getFirstName(); ?></span>!</h1>
	<p><?php echo _("In this Account Management page, you can manage all unassigned students. Unassigned students are accounts that were taken out of the student spreadsheet due to transfer, move or drop out within the school year."); ?>
	<div class="wrap-container">
		<div id="wrap">
			<div class="sub-headers">
				<h1><?php echo _('List of Unassigned Students'); ?></h1>
				
				<p class="fleft"> * <?php echo _('Click the column title to filter it Ascending or Descending.'); ?></p><br>
				<p class="fleft"> * <?php echo _('Refresh your browser to fix the table.'); ?></p>
				<br><br>
				<div class="fright">
					<a href="index.php" class="link" style="display: inline-block;"><?php echo _('Manage Accounts'); ?></a> | 
					<a href="manage-students.php" class="link" style="display: inline-block;"><?php echo _('Manage Students'); ?></a> | 
					<a href="unassigned-students.php" class="link current" style="display: inline-block;"><?php echo _('Unassigned Students'); ?></a> | 
					<a href="floating-accounts.php" class="link" style="display: inline-block;"><?php echo _('Floating Accounts'); ?></a>
				</div>
			</div>		
			<div class="clear"></div>

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
	  <li class="tlypageguide_top" data-tourtarget=".ui-custom-icon">
	    <p>2. <?php echo _('Click the pencil icon <small class="ui-icon ui-icon-pencil"></small> in the <strong>Actions</strong> column to update all cells then press Enter; or'); ?></p>
	  </li>
	  <li class="tlypageguide_bottom" data-tourtarget="tr.jqgrow td .cbox">
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
	</ul>
	
	</div> <!-- End of content -->

	<script>
	var language;
	$(document).ready(function() {
		$('#language-menu').change(function() {
			language = $('#language-menu option:selected').val();
			document.location.href = "<?php echo $_SERVER['PHP_SELF'];?>?lang=" + language;
		});

		$("a.current").click(function(){
			event.preventDefault();
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

	function cdl(event, element){
		var cdl = confirm("Are you sure you want to delete this student account?");
		if(!cdl){
			event.stopPropagation();
		}
	}
	</script>
<?php require_once "footer.php"; ?>