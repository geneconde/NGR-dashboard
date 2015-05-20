<?php 
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.5.2
 * @license: see license.txt included in package
 */
 
// include db config
include_once("config.php");

ini_set('display_errors', 1);
	require_once '../session.php';
	require_once '../locale.php';
	include_once '../controller/Language.Controller.php';
	include_once('../controller/Subscriber.Controller.php');
	
// set up DB
mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

// include and create object
include(PHPGRID_LIBPATH."inc/jqgrid_dist.php");

	$sc = new SubscriberController();
	$sub = $sc->loadSubscriber($user->getSubscriber());

	$userid 			= $user->getUserid();
	$usertype			= $user->getType();
	$subid				= $user->getSubscriber();
	$create_date		= date('Y-m-d');
	$current_date		= date('Y-m-d');
	$expire_date		= date('Y-m-d', strtotime("+30 days"));
	$updated_at 		= date('Y-m-d H:i:s');

	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

$g = new jqgrid();

// passed from parent grid
$c_id = $_REQUEST["rowid"];
if (empty($c_id)) $c_id = 0;

	$username = _('Username');
	$password = _('Password');
	$first_name = _('First Name');
	$last_name = _('Last Name');
	$gender = _('Gender');
	$grade_level = _('Grade Level');
	//$student_portfolio = _('Student Portfolio');
	$teacher_information = _('Teacher Information');
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
	$cols[] = $col;

	$col = array();
	$col["title"] = $password;
	$col["name"] = "password";
	$col["width"] = "30";
	$col["search"] = true;
	$col["editable"] = true;
	$col["align"] = "center";
	$col["export"] = true; // this column will not be exported
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
	$col["title"] = "Teacher ID"; // caption of column
	$col["name"] = "teacher_id";
	$col["editable"] = false;
	$col["export"] = false; // this column will not be exported	
	$col["width"] = "10";
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

	$grid["sortname"] = 'user_ID'; // by default sort grid by this field
	$grid["sortorder"] = "desc"; // ASC or DESC
	$grid["height"] = ""; // autofit height of subgrid
	$grid["caption"] = "Tier 1 Data"; // caption of grid
	$grid["autowidth"] = true; // expand grid to screen width
	$grid["multiselect"] = true; // allow you to multi-select through checkboxes
	$grid["export"] = array("filename"=>"my-file", "sheetname"=>"test"); // export to excel parameters

	$grid["subGrid"] = true;
	$grid["subgridurl"] = "subgrid_sub_detail.php";
	
	//Export Options
/*	$opt["export"] = array("filename"=>"Student Information", "heading"=>"Student Information", "orientation"=>"landscape", "paper"=>"a4");
	$opt["export"]["sheetname"] = "Student Information";
	$opt["export"]["range"] = "filtered";*/


	$g->select_command = "SELECT * FROM users WHERE subhead_id = $userid";

	$g->table = "users";

	$g->set_columns($cols); // pass the cooked columns to grid
	$e["js_on_select_row"] = "grid_select";
	$g->set_events($e);

	//$main_view = $grid->render("list1");

/*	if(isset($_POST['addmultiple'])){
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
*/
	$g->set_options($grid);
	$g->set_actions(array(	
			"add"=>true, // allow/disallow add
			"edit"=>true, // allow/disallow edit
			"delete"=>true, // allow/disallow delete
			"rowactions"=>true, // show/hide row wise edit/del/save option
			"export"=>true, // show/hide export to excel option
			"autofilter" => true, // show/hide autofilter for search
			"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
		) 
	);

	$g->set_group_header( array(
		   "useColSpanStyle"=>true,
		   "groupHeaders"=>array(
		       array(
		           "startColumnName"=>'invdate', // group starts from this column
		           "numberOfColumns"=>2, // group span to next 2 columns
		           "titleText"=>'Student Details' // caption of group header
		       )
		   )
		)
	);
$out = $g->render("sub1");
echo $out;
?>
<script>
	jQuery(document).ready(function(){
		jQuery('#<?php echo $g->id?>').jqGrid('navButtonAdd', '#<?php echo $g->id?>_pager', 
		{
			'caption'      : 'Custom Button', 
			'buttonicon'   : 'ui-icon-pencil', 
			'onClickButton': function()
			{
				// your custom JS code ...
				window.open("http://google.com");
			},
			'position': 'last'
		});
	});
</script>
