<?php
require_once 'controller/StudentGroup.Controller.php';
if(isset($_POST['gsave']))
{
	$sgc 		= new StudentGroupController();
	$group_name = $_POST['gname'];
	$id = $_POST['gid'];
	if($group_name == "")
	{
		header("Location: edit-group-name.php?group_id=" . $id . "&err=1");
	}
	else 
	{
		$sgc->updateGroupName($id, $group_name);
		header("Location: edit-group-name.php?group_id=" . $id . "&msg=1");
	}
}
?>