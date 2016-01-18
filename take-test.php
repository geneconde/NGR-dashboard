<?php 
	ini_set('display_errors', '1');
	require_once 'session.php';
	require_once 'controller/Module.Controller.php';
	require_once 'controller/Events.Controller.php';
	
	$ev = new EventsController();
	ob_start();
	$moduleid = $_GET['m'];

	$userid 	= $user->getUserid();
	$username 	= $user->getUsername();
	$temp = str_replace("-", " ", $moduleid);
	$mname = ucwords($temp);
	
	$mc = new ModuleController();
	$module = $mc->loadModule($moduleid);
?>
<h1><?php echo $module->getModule_name(); ?></h1>
<p><?php echo $module->getModule_desc(); ?></p>
</br></br>
<?php 
	if (isset($_GET['smid'])) {
		$_SESSION['smid']= $_GET['smid']; 
		$lastscreen = $_GET['s'];
	} else {
		$ev->takes_module($userid, $username, $mname);
		$redirect = "modules/".$moduleid."/".$lastscreen.".php";
		$redirect = "start-module.php?m=".$moduleid;
	}
	
	header("location:".$redirect);
?>