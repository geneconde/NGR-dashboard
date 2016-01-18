<?php
	/* Comment out line 4 and uncomment lines (5, 6, 7 and 10 to 15) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'module';
	//require_once '../../verify.php';
	require_once "locale.php";

	/*if ($user->getType() == 2) {
		$uf->updateStudentLastscreen(12, $_SESSION['smid']);
		$problem = $uf->getModuleProblem('gravity-in-action');
		$sa = $uf->getProblemAnswer2($_SESSION['smid'], $problem['meta_ID']);
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;*/
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
	<link rel="stylesheet" href="css/responsiveslides.css">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<?php if ($language == 'ar_EG') : ?>
		<link rel="stylesheet" href="css/grid_rtl.css">
	<?php else : ?>
		<link rel="stylesheet" href="css/grid.css">
	<?php endif; ?>

	<style>
		h1 { color: #96FFEE; font-size: 28px; }
		h2 { text-align: center; color: #D0ABFF; margin-bottom: 0; }
		p { color: #fff; }

		.wrap { border-color: #8781bd; }
		.bg { background-image: url(assets/12/bg.jpg); }

		.slider img { height: auto; }

		textarea { width: 100%; border: 1px solid #8781bd; margin: 10px 0; max-height: 300px; min-height: 300px; padding: 12px; }

		#task { display: none; }
		@media screen and (max-width: 1250px){
		
			.bg{ background-size:  100% calc(100% - 65px)!important; background-position: 0 34px; }
		}

		@media all and (max-width: 960px) {
			h1 { font-size: 28px; }
			#task h2 { margin-top: 45px; }
		}

		@media all and (min-device-width: 768px) and (max-device-width: 1024px) {
			h1 { font-size: 28px; }
			#task h2 { margin-top: 45px; }
		}

		#buttons .next { display: none; }
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_12">

					<div id="scenario">
						<h1 class="grid_12"><?php echo _("Using what you now know about... gravity in action... to solve a problem"); ?></h1>
						<h2 class="grid_12"><?php echo _("The Scenario"); ?></h2>

						<p class="grid_12"><?php echo _("Astronauts need to be able to communicate with Earth on their new voyages to the moon and planet Mars. You are an engineer, part of NASA’s new mission to send satellites to orbit where astronauts are - the moon and Mars."); ?></p>

						<div class="grid_8 prefix_2">
							<ul class="rslides slider">
								<li><img src="assets/12/s1a.jpg"></li>
								<li><img src="assets/12/s1b.jpg"></li>
								<li><img src="assets/12/s1c.jpg"></li>
							</ul>
						</div>
					</div>

					<div id="task">
						<h2 class="grid_12"><?php echo _("The Task"); ?></h2>
						<p class="grid_12"><?php echo _("What would you have to consider to figure out where and how to set the artificial satellite into orbit? Using what you know about how satellites orbit the earth, what would you need to know to solve this problem? You can use the internet to find the facts you need."); ?></p>

						<div class="grid_8 prefix_2">
							<textarea placeholder="<?php echo _("Click here to start typing your answer..."); ?>"></textarea>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="13.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="readmore" title="<?php echo _("Read More"); ?>"><i class="fa fa-comment"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Preparing for new mission..."); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/responsiveslides.js"></script>

	<script>
		var answered = 1; /* Change 1 to <?php echo $answered; ?> when ported in the modules folder */

		$('.next').click(function() {
			if ($('textarea').val() == '') {
				alert("<?php echo _("Please type your answer."); ?>");
				return false;
			} else {
				if (answered == 0) {
					saveMeta('gravity-in-action', $('textarea').val());
					answered = 1;
				}

				document.location.href = "13.php";
			}
		});

		$('.back').click(function(){
			if ($('#scenario').is(':visible')) {
				document.location.href= "11.php";
			} else if ($('#task').is(':visible')) {

				$('.back').fadeOut();

				$('.next').fadeOut(function() { 
					$('.readmore').fadeIn(); 
					$('.back').fadeIn();
				});

				$('#task').fadeOut(function() { $('#scenario').fadeIn(); });
			}
		});

		$('.readmore').click(function() {

			$('.back').fadeOut();

			$('.readmore').fadeOut(function() { 
				$('.next').fadeIn(); 
				$('.back').fadeIn();
			});

			$('#scenario').fadeOut(function() {
				$('#task').fadeIn();

				window.location.hash = '#task';
			});
		});

		$(".slider").responsiveSlides({
			auto: true,
			pager: false,
			nav: false,
			speed: 400
		});
	</script>

	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
