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

	$grid = new jqgrid();

	/** Main Grid Table **/
	$col = array();
	$col["title"] = "Module";
	$col["name"] = "module_id";
	$col["width"] = "20";
	$col["search"] = false;	
	$col["editable"] = false;
	$col["sortable"] = false;
	$col["export"] = false;
	$cols[] = $col;

	$col = array();
	$col["title"] = "Question";
	$col["name"] = "question";
	$col["search"] = false;
	$col["sortable"] = false;
	$col["export"] = false;
	$col["editable"] = false;
	$cols[] = $col;

	$opt["caption"] = "Questions";
	$opt["height"] = "";
	$opt["autowidth"] = true; // expand grid to screen width
	$opt["multiselect"] = false; // allow you to multi-select through checkboxes
	$opt["hiddengrid"] = false;
	$opt["reloadedit"] = true;

	//Export Options
	$opt["export"] = array("filename"=>"Student Information", "heading"=>"Student Information", "orientation"=>"landscape", "paper"=>"a4");
	$opt["export"]["sheetname"] = "Student Information";
	$opt["export"]["range"] = "filtered";

	$grid->set_options($opt);
	$grid->debug = 0;

	$grid->set_actions(array(
			"add"=>true, // allow/disallow add
			"edit"=>true, // allow/disallow edit
			"delete"=>true, // allow/disallow delete
			"bulkedit"=>true, // allow/disallow edit
			"export_excel"=>true, // export excel button
			"rowactions"=>true,
			"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
	));
	$grid->table = "dt_pool";

	$grid->set_columns($cols); // pass the cooked columns to grid

	$main_view = $grid->render("list1");

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
	<style>
		.ui-search-toolbar { display: none; }
		.fleft { margin-top: -16px; }
		.tguide { float: left; margin-top: -15px; }
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
		.joytest2 ~ div a:nth-child(3){
		    display: none;
		}
		.ui-icon {
		  display: inline-block !important;
		}
		<?php if($language == "ar_EG") { ?>
		.tguide { float: right; }
		<?php } ?>

	</style>

	<script src="../phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="../phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

	<!-- Run the plugin -->
    <script type="text/javascript" src="../libraries/joyride/jquery.cookie.js"></script>
    <script type="text/javascript" src="../libraries/joyride/modernizr.mq.js"></script>
    <script type="text/javascript" src="../libraries/joyride/jquery.joyride-2.1.js"></script>
	
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
	<br/>
	<div id="dbguide"><button class="uppercase guide tguide" onClick="guide()">Guide Me</button></div>
	<br/>
	<div class="clear"></div>

	<a class="link" href="../teacher.php">&laquo; <?php echo _("Go Back to Dashboard"); ?></a>


	<div class="clear"></div>
	<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstName(); ?></span>!</h1>
	<p><?php echo _("This is your Dashboard. In this page, you can view all the questions in every modules."); ?>
  
		<div class="wrap-container">
			<div id="wrap">
				
				<div class="sub-headers">
					<h1><?php echo _('List of Questions'); ?></h1>				
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
