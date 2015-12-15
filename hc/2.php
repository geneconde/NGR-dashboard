<?php 
	require_once "../tempsession.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once "locale.php";	
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo _("Heating and Cooling"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="initial-scale=1">

	<link rel="stylesheet" href="css/locale.css" />
	<link rel="stylesheet" href="css/fonts.css" />
	<link rel="stylesheet" href="css/jpreloader.css" />
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<style>
		html, body {overflow: hidden;}
		h1 { color: #f4d9b7; }
		.wrap { border-left: 1px dashed #6f4b33; border-right: 1px dashed #6f4b33; }
		.bg { background-image: url('images/2/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		.bg section { background-color: rgba(143, 106, 80, .8); width: 92.5%; padding: 10px; position: absolute; bottom: 20px; left: 2.5%; border-radius: 14px; }
		.bg .smoke { position: absolute; width: 250px; height: 250px; background: url('images/2/smoke-texture.png') no-repeat; bottom: 280px; margin-left: 260px; }
		#dp_swf_engine { display: none; }

	@media only screen and (max-width: 1250px) {
		h1 {padding-top:15px !important;}
		.bg section { bottom: 50px !important;}

	}	

	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<section>

				<h1><?php echo _("Thinking about... heating and cooling"); ?></h1>
				<p id = "p_adjust"><?php echo _("What if someone told you that heating something like a pizza or cup of soup and cooling something like a soft drink or a dessert are sort of the same thing? You would probably say that sounds crazy!  But after you complete this review you will see that this is not such a crazy idea after all."); ?></p>
			</section>
		</div>
	</div>
	<div id="buttons">
		<a href="1.php" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="3.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>	


	<section id="preloader"><section class="selected"><strong><?php echo _("Are you ready, QATEST "); ?> </strong></section></section>
	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/easing.js"></script>
	<script src="scripts/rightclick.js"></script>
	<script>

	$(function(){
	if(!$.browser.msie){
		var a=0;for(;a<15;a+=1){setTimeout(function b(){var a=Math.random()*1e3+5e3,c=$("<div />",{"class":"smoke",css:{opacity:0,left:Math.random()*200+80}});$(c).appendTo(".bg");$.when($(c).animate({opacity:1},{duration:a/4,easing:"linear",queue:false,complete:function(){$(c).animate({opacity:0},{duration:a/3,easing:"linear",queue:false})}}),$(c).animate({bottom:$(".bg").height()},{duration:a,easing:"linear",queue:false})).then(function(){$(c).remove();b()})},Math.random()*3e3)}
	}else{		
	"use strict";var a=0;for(;a<15;a+=1){setTimeout(function b(){var a=Math.random()*1e3+5e3,c=$("<div />",{"class":"smoke",css:{left:Math.random()*200+80}});$(c).appendTo(".bg");$.when($(c).animate({},{duration:a/4,easing:"linear",queue:false,complete:function(){$(c).animate({},{duration:a/3,easing:"linear",queue:false})}}),$(c).animate({bottom:$(".bg").height()},{duration:a,easing:"linear",queue:false})).then(function(){$(c).remove();b()})},Math.random()*3e3)}}}())
	</script>

	<?php include("temp-setlocale.php"); ?>
</body>
</html>
