<?php
	/* Comment out line 4 and uncomment lines (5, 6, 7 and 10) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";

	//if($user->getType() == 2) $uf->updateStudentLastscreen(8, $_SESSION['smid']);
?>

<!DOCTYPE html>
<html <?php if ($language == 'ar_EG') echo 'dir="rtl"'; ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo _("Gravity in Action"); ?></title>

	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/locale.css">
	<link rel="stylesheet" href="css/jpreloader.css">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<?php if ($language == 'ar_EG') : ?>
		<link rel="stylesheet" href="css/grid_rtl.css">
	<?php else : ?>
		<link rel="stylesheet" href="css/grid.css">
	<?php endif; ?>

	<style>
		h1 { color: #EBE49A; }
		p { color: #fff; }
			
		.wrap { border-color: #5cb7da; }
		.bg { background-image: url(assets/8/bg.jpg); background-size: cover !important; }

		#screen1 p img { float: right; margin-left: 20px; width: 50%;  }
		<?php if($language == 'es_ES'){ ?>
			#screen1 p{ font-size:  22px;}
		<?php } ?>
		html[dir=rtl] #screen1 p img { float: left; margin-right: 20px; }

		#screen2 { display: none; }

		#buttons a.next { display: none; }
		
		.sc1-pic { text-align: center; }
		.sc1-pic img {  width: 33%; }
		@media screen and (max-width: 1250px) { 
			#screen1 p, #screen2 p{  font-size: 20px;}
			 .bg{
			  background-size:  100% calc(100% - 65px)!important;
			  background-position: 0 34px; }
			}
		@media screen and (max-width: 960px){
			#screen1 h1{font-size:28px;}
			#screen1 p,#screen2 p{font-size: 20px; margin: 5px 0;}
		}
		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) {
			h1 { margin-left: 0 !important; }
		}
		<?php if($language == "es_ES") { ?>
			p {font-size: 23px;   margin: 0px 0;}
		<?php } ?>

	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_12">

					<div id="screen1" class="screen">
						<h1 class="grid_12"><?php echo _("More big ideas about... gravity in action"); ?></h1>

						<p class="grid_12"><!--<img src="assets/8/s1a.jpg">--><?php echo _("Because we live on Earth, most people experience (or observe) the phenomena of gravity as things \"falling to Earth\". But if all things that went up truly fell back to Earth, devices such as cell phones and TVs would not work as they do today. That's because such devices depend upon connections with a communication <span class='key'>satellite</span> that is rocketed up to a distance where the earth's gravity is much weaker. If we were able to turn off Earth's gravity, the satellite boosted into space would keep going. But we can't turn off gravity. It follows that the satellite begins to fall back to earth. But rather than falling straight back, the satellite begins to \"curve\" back to Earth until it enters a stable orbit around the planet. A stable orbit requires a balance of enough speed to keep the object from falling completely back to Earth but not so much speed that it shoots off into space."); ?></p>
						<div class="sc1-pic">	
							<img src="assets/8/8a.png" alt="">
							<img src="assets/8/8b.png" alt="">
						</div>

						<div class="clear"></div>
					</div>

					<div id="screen2" class="screen grid_12">
						<p><?php echo _("Much like the example with the satellite above, the Moon can be described as Earth's satellite. Indeed, a moon is defined as both a celestial body and a natural satellite. It is a <span class='key'>celestial body</span> because it is an object found in space and it is a <span class='key'>natural satellite</span> because the moon orbits the earth. Like the communication satellites revolving around Earth, the moon is in a perfect balance of motion. If the moon had any more <span class='key'>velocity</span>, it would fly off into space. But if the moon had any less velocity, it would spiral toward Earth until it crashed into Earth's surface. Thus, the Earth-Moon system is another example of a satellite system--a perfect balance of motion and gravity."); ?></p>
						<div class="sc1-pic">	
							<img src="assets/8/8c.png" alt="">
							<img src="assets/8/8d.png" alt="">
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="#" class="readmore" title="<?php echo _("Read More"); ?>"><i class="fa fa-comment"></i></a>
		<a href="9.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Stabilizing speed..."); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>

	<script>
		var hash = window.location.hash.slice(1);

		if (hash != "") {
			$('.screen').hide();
			$('#screen2').show();

			$('.back').fadeOut();

			$('.readmore').fadeOut(function() { 
				$('.next').fadeIn(); 
				$('.back').fadeIn(); 
			});
		}
		
		$('.back').click(function() {
			if ($('#screen1').is(':visible')) {
				document.location.href = "7.php";
			} else if ($('#screen2').is(':visible')) {

				$('.back').fadeOut();

				$('.next').fadeOut(function() { 
					$('.readmore').fadeIn(); 
					$('.back').fadeIn(); 
				});

				$('#screen2').fadeOut(function () {
					$('#screen1').fadeIn();

					window.location.hash = '';
				});
			} 
		});

		$('.readmore').click(function(){
			if ($('#screen1').is(':visible')) {

				$('.back').fadeOut();

				$('.readmore').fadeOut(function() { 
					$('.next').fadeIn(); 
					$('.back').fadeIn(); 
				});

				$('#screen1').fadeOut(function() {
					$('#screen2').fadeIn();

					window.location.hash = '#screen2';
				});
			}
		});
	</script>

	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
