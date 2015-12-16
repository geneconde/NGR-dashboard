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
	
	$userid 			= $user->getUserid();
	$usertype			= $user->getType();
	$subid				= $user->getSubscriber();
	$create_date		= date('Y-m-d G:i:s');
	$current_date		= date('Y-m-d G:i:s');
	$expire_date		= date('Y-m-d G:i:s', strtotime("+30 days"));
	$updated_at 		= date('Y-m-d H:i:s');

	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

	$uc = new UserController();

	if(isset($_GET['unassign']) && $_GET['unassign'] == 1){
		$uc->updateStudentTeacher($_GET['user_id']);
		header("Location: manage-students.php");
	}

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
	$col["title"] = "id"; // caption of column
	$col["name"] = "qid";
	$col["editable"] = false;
	$col["export"] = false; // this column will not be exported
	$col["width"] = "10";
	$col["hidden"] = true;
	$cols[] = $col;

	$col = array();
	$col["title"] = "Module";
	$col["name"] = "module_id";	
	$col["dbname"] = "dt_pool.module_id";
	$col["width"] = "20";
	$col["search"] = true;	
	$col["editable"] = true;
	$col["sortable"] = false;
	$col["export"] = false;
	$str = $grid->get_dropdown_values("select distinct module_id as k, module_id as v from dt_pool"); 
	//$str = str_replace("-", " ", $_str);

	$col["stype"] = "select"; 
	$col["searchoptions"] = array("value" => ":;". $str); 
	$col["edittype"] = "select"; 
	$col["editoptions"] = array("value"=> $str); 
	$col["on_data_display"] = array("getModuleName","");

	function getModuleName($data)
	{
		$module = $data["module_id"];

		$_data = str_replace("-", " ", $module);

		$data = ucwords($_data);

		return $data;	
	}
	$cols[] = $col;

	$col = array();
	$col["title"] = "Question";
	$col["name"] = "question";
	$col["search"] = false;
	$col["sortable"] = false;
	$col["export"] = false;
	$col["editable"] = true;

	$cols[] = $col;

	$opt["caption"] = "Questions";
	$opt["height"] = "";
	$opt["autowidth"] = true; // expand grid to screen width
	$opt["multiselect"] = true; // allow you to multi-select through checkboxes
	$opt["hiddengrid"] = false;
	$opt["reloadedit"] = true;

	//Export Options
	$opt["export"] = array("filename"=>"Question", "heading"=>"Question", "orientation"=>"landscape", "paper"=>"a4");
	$opt["export"]["sheetname"] = "Module Questions";
	$opt["export"]["range"] = "filtered";

	$grid->set_options($opt);
	$grid->debug = 0;

	$grid->set_actions(array(
			"add"=>false, // allow/disallow add
			"edit"=>true, // allow/disallow edit
			"delete"=>false, // allow/disallow delete
			"bulkedit"=>false, // allow/disallow edit
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
		.joytest2 ~ div a:nth-child(3){ display: none; }
		.ui-icon { display: inline-block !important; }
		#delmodlist1 { width: auto !important; }
		#search { height: 19px; width: auto; background: #FF5B5B; color: #FFFFFF; border: none; padding: 0 5px; cursor: pointer; }
		form { height: 20px; margin-bottom: 5px; float: right; }
		fieldset { border: none; }

	</style>

	<script src="../phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en-students.js" type="text/javascript"></script>
	<script src="../phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="../phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

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
		<div class="wrap">
			<a class="logo fleft" href="<?php echo $link; ?>"><img src="../images/logo2.png"></a>
			<div class="fright" id="logged-in">
				<div><span class="note"><?php echo _("Welcome"); ?></span>, <span class="upper bold"><?php echo $user->getUsername(); ?></span>! <a class="link" href="../edit-account.php?user_id=<?php echo $userid; ?>"/><?php echo _("Manage My Account"); ?></a> | <a class="link" id="logout" href="../logout.php"><?php echo _("Logout?"); ?></a>
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
					<a href="../teacher-languages.php" class="link"><?php echo _("Edit Languages"); ?></a>
				</div>
			</div>
		</div>
	</div>

	<div class="top-buttons">
		<div class="wrap">
			<div class="buttons">
				<a class="uppercase fright manage-box active" href="phpgrid/question-library.php"><?php echo _("Test Questions Library"); ?></a>
				<a class="uppercase fright manage-box" target="_blank" href="../../marketing/ngss.php"/><?php echo _("See the NGSS Alignment"); ?></a>
				<a class="uppercase fright manage-box" href="manage-students.php" id="student-accounts"/><?php echo _("Student Accounts"); ?></a>
				<a class="uppercase fright manage-box" href="../student-accounts.php" id="student-groups"/><?php echo _("Student Groups"); ?></a>
				<a class="uppercase fright manage-box" href="../ct-test.php" id="cumulative-test"><?php echo _("Cumulative Test"); ?></a>
				<a class="uppercase fright manage-box" href="../dt-test.php" id="diagnostic-test"><?php echo _("Diagnostic Test"); ?></a>
				<a class="uppercase fright manage-box" href="../teacher.php" id="dashboard"><?php echo _("Dashboard"); ?></a>
			</div>
			<a class="link back" href="../teacher.php">&laquo; <?php echo _("Go Back"); ?></a>
		</div>
	</div>
	
	<div id="content">
		<div class="wrap">

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
						<fieldset> 
					        <form id="form_search"> 
					        Search: <input type="text" id="filter"/> 
					        <!-- <input type="submit" id="search" value="Search" class="manage-box">  -->
					        </form> 
					    </fieldset>
						<?php echo $main_view; ?>				
					</div>
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
		
		$('#filter').keyup(function () { 
			grid = jQuery("#list1"); 

	        var searchFiler = jQuery("#filter").val(), f; 

	        if (searchFiler.length === 0) { 
	            grid[0].p.search = false; 
	            jQuery.extend(grid[0].p.postData,{filters:""}); 
	        } 
	        f = {groupOp:"OR",rules:[]}; 

	        // initialize search, 'name' field equal to (eq) 'Client 1' 
	        // operators: ['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc'] 

	        f.rules.push({field:"module_id",op:"cn",data:searchFiler}); 

	        grid[0].p.search = true; 
	        jQuery.extend(grid[0].p.postData,{filters:JSON.stringify(f)}); 

	        grid.trigger("reloadGrid",[{jqgrid_page:1,current:true}]); 

	        return false; 
		});

	});

	</script>


</body>
</html>
