<?php
	if(isset($_SESSION['cmodule'])) {
		if(!in_array($_SESSION['cmodule'], $_SESSION['modules'])){
			header("Location: ../../index.php");
		}
	}