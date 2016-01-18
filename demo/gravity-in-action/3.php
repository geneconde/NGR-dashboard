<?php
	/* Comment out line 4 and uncomment lines (5, 6, 7 and 10) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";

	//if($user->getType() == 2) $uf->updateStudentLastscreen(3, $_SESSION['smid']);
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
		<link rel="stylesheet" href="css/ac_rtl.css">
	<?php else : ?>
		<link rel="stylesheet" href="css/grid.css">
		<link rel="stylesheet" href="css/ac.css">
	<?php endif; ?>

	<style>
		h1 { color: #f36d90; }

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) { h1 { font-size: 27px; } }

		.wrap { border-color: #abdefa; }
		.bg { background-image: url(assets/3/bg.jpg); }
		<?php if($language == 'es_ES'){ ?> #question{ font-size: 22px;} .rslides img {  margin: 30px 0;} <?php } ?>
		
		.ac-custom li { padding: 9px 0; }

		.ac-custom input[type="checkbox"]:checked + label { color: #f36d90; }
		.ac-custom label { color: #000; padding-left: 49px; }
		.ac-custom label::before { border: 2px solid #f36d90; height: 34px; width: 34px; margin-top: -18px; }
		.ac-custom svg path { stroke: #f36d90; }
		.ac-custom svg { height: 20px; width: 20px; left: 9px; margin-top: -10px; }
	

		html[dir=rtl] .ac-custom label { padding-right: 49px; }
		html[dir=rtl] .ac-custom label::after { border: 2px solid #f36d90; height: 34px; width: 34px; margin-top: -18px; }
		html[dir=rtl] .ac-custom svg { right: 9px; left: 98%; }

		#answer { display: none; }
		#answer p { text-align: left; padding: 5px 10px; background: rgba(255, 255, 255, .9); border-radius: 5px; }

		html[dir=rtl] #answer p { text-align: right; }

		#buttons .next { display: none; }
		.img_float{
			float: right;	

		}
		@media screen and (max-width: 1250px){
			.bg{ background-size:  100% calc(100% - 65px)!important; background-position: 0 34px; }
			#question { font-size:  21px; margin: 5px 0;}
			
		}
		@media screen and (max-width: 875px){
			#question h1{ font-size:  26px;}
			#question { font-size:  19px; margin: 5px 0;}
		}
    <?php if ($language == 'ar_EG') : ?>
		div#question {
		    line-height: 25px;
		    margin-top: 12px;
		}

		@media only screen and (max-width: 1250px){
			div#choice_1 {
			    position: absolute;
			    top: 55%;
			    right: 27%;
			}
		}
    <?php endif; ?>

    <?php if ($language == 'es_ES') : ?>
		@media only screen and (max-width: 1250px){
			p.grid_9 {
			    line-height: 20px;
			}
		}
	<?php } ?>
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_12">

					<div id="question">
						<h1 class="grid_12"><?php echo _("Checking what you already know about... gravity in action"); ?></h1>

						<div class="grid_12">
							<p <?php if($language == 'es_ES'){?> class ="grid_9" <?php } ?>><?php echo _("You may have heard that all objects exert a gravitational force on other objects. You may also have wondered, then, why you don't feel this force. Although the force between most paired objects cannot be felt, you can indeed feel the force between the earth and you. ");?>
							<div id="img_1" class="img_float grid_3">
									<ul class="rslides">
										<li><img src="assets/3/s1a.jpg"></li>
										<li><img src="assets/3/s1b.jpg"></li>
										<li><img src="assets/3/s1c.jpg"></li>
									</ul>
							</div>
							<?php if($language == 'zh_CN' || $language == 'en_US'){ ?>
							<p><?php echo _(" It is felt as your weight. If you jump up in the air, you can count on being pulled back toearth. But what do you think would happen if you jumped up and there was no such thing as gravity? Think about your experience with gravity, for example, jumping to grab an apple from a tree or watching rain falling from a dark cloud. Based on your experience, how would you describe gravity's force?"); ?></p>	
							<?php } ?>
						</div>

							

						<div class="clear"></div>

						<div id="choice_1" class="grid_12">
							<form id="chkbox" class="ac-custom ac-checkbox ac-diagonal" autocomplete="off">
								<ol>
									<li><input id="a" type="checkbox"><label for="a"><span><?php echo _("Gravity is a force that pushes objects in opposite directions."); ?></span></label></li>
									<li><input id="b" type="checkbox"><label for="b"><span><?php echo _("Gravity is a force that pulls objects toward each other."); ?></span></label></li>
									<li><input id="c" type="checkbox"><label for="c"><span><?php echo _("Gravity is a force that can both push and pull on objects."); ?></span></label></li>
									<li><input id="d" type="checkbox"><label for="d"><span><?php echo _("Gravity is a force that acts when objects touch each other."); ?></span></label></li>
								<ol>
							</form>
						</div>
					</div>

					<div id="answer" class="grid_12">
						<p><?php echo _("Gravity definitely is a force that acts between any two or more objects. But there are some special ways that gravity acts that might surprise you. Learn more about how gravity acts in this module."); ?></p>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="4.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Jumping up in the air..."); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/responsiveslides.js"></script>
	<script src="js/svgcheckbx.js"></script>

	<script>
		$(".rslides").responsiveSlides({
			auto: true,
			pager: false,
			nav: false,
			speed: 400
		});

		var hash = window.location.hash.slice(1),
			screenCount = 2;
		
		if (hash != "") {
			$('#' + hash).show(function() {
				var screen = hash[hash.length -1];

				if (screen = screenCount) {
					$('.bg').css('background-image', 'url(assets/3/bg2.jpg)');
					$('.wrap').css('border-color', '#79989b');

					$('#question').fadeOut(100, function() { $('#answer').fadeIn(); });

					$('.back').fadeOut();

					$('.checkanswer').fadeOut(function() { 
						$('.next').fadeIn(); 
						$('.back').fadeIn();
					});
				} else {
					$('.bg').css('background-image', 'url(assets/3/bg.jpg)');
					$('.wrap').css('border-color', '#abdefa');

					$('#question').fadeIn();

					$('.back').fadeOut();

					$('.next').fadeOut(function() { 
						$('.checkanswer').fadeIn(); 
						$('.back').fadeIn();
					});
				}
			});
		}

		$('.checkanswer').click(function() {
			var checkAnswer = $('input:checkbox:checked').length;
			if (checkAnswer < 1 ) {
				alert("<?php echo _("Please select your answers."); ?>");
				
			} else {
				
			$('#question').fadeOut(function() {
				$('.bg').css('background-image', 'url(assets/3/bg2.jpg)');
				$('.wrap').css('border-color', '#79989b');

				$('#answer').fadeIn();

				$('.back').fadeOut();

				$('.checkanswer').fadeOut(function() { 
					$('.next').fadeIn(); 
					$('.back').fadeIn();
				});

				window.location.hash = '#answer';
			});
			}
		});
		

		$('.back').click(function() {
			if ($('#answer').is(':visible')) {
				$('#answer').fadeOut( function() {
					$('.bg').css('background-image', 'url(assets/3/bg.jpg)');
					$('.wrap').css('border-color', '#abdefa');

					$('#question').fadeIn();

					$('.back').fadeOut();

					$('.next').fadeOut(function() { 
						$('.checkanswer').fadeIn(); 
						$('.back').fadeIn();
					});

					window.location.hash = '';
				});
			} else { $('.back').attr('href', '2.php'); }
		});
	</script>

	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
