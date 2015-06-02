<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(8, $_SESSION['smid']);
?>

<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Solar Power"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" type="text/css" href="styles/solar-system.css" />
<link rel="stylesheet" type="text/css" href="styles/night-day.css" />
<link rel="stylesheet" type="text/css" href="styles/flexslider.css" />
<link rel="stylesheet" href="styles/font-awesome.min.css">

<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/prefixfree.min.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<script src="scripts/jquery.color.js"></script>
<style>
/*
html { overflow-y: hidden; overflow-x: hidden;}
.wrap { overflow: hidden; }
*/
	html, body {overflow: hidden;} 
#screen1 h6 { position: absolute; z-index: 100; color: #f1e263; font-size: 35px; text-align: left; left: 20px; top: 10px; font-size: bold; margin: 0; padding: 0; }
#screen1 p { color: #fff; }
#s1text, #s2text { width: 95%; position: absolute; z-index: 100; top: 50px; left: 22px; }
#s2text { top: 40px; width: 60%; }
#s2text p {  }
.bg { width: 100%; height: 100%; position: relative; }
.bg > div { width: 100%; }
#screen2, #screen3, #screen4 { display: none; }
#buttons .next { display:none; }
#controls { position: absolute; top: 40%; left: 30px; }
.buttons, .buttons-back { z-index: 100; }
.text-color { color: #94FF8B !important; -webkit-transition: all 30s ease; }
.flex-container { width: 300px; z-index: 100; float: right; padding-top: 50px; margin-right: 15px; }
.flex-next, .flex-prev { z-index: 999; }
.flexslider { z-index: 99; }
#s3text { z-index: 99; position: absolute; width: 95%; left: 22px; color: #000; }
#saturn .ring { margin-top:-58px; margin-left: -57px;}
.flexslider .slides img { width: 280px; height: 187px; }
html[dir="rtl"] #data a { font-size:13px; } 
html[dir="rtl"] #controls { left:100px; }
html[dir="rtl"] .view-2D #controls label.set-view:before { margin-left:0;margin-right:80px; }
html[dir="rtl"] #controls label:before { margin-top:2px; }
html[dir="rtl"] .view-3D #controls .set-view input:after { margin-left:0;margin-right:82px; }
html[dir="rtl"] .view-3D #controls label.set-view:before { margin-right:5px; }

<?php if($language == "zh_CN") { ?>
		p { font-size:22px; }
<?php } ?>
<?php if($language == "ar_EG") { ?>
	#screen1 h6 {text-align: right !important;   width: 95%;}
	@media only screen and (max-width: 1250px) {
		h6 { font-size:28px !important; }
		#data a {padding: 15px 7px !important;}
	}
	@media only screen and (max-width: 978px) {
		html[dir="rtl"] #data a { font-size:11px !important; } 
	}
<?php } ?>

.data-open #data, .data-close #data {left:190px; width:70%;}

@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	#screen1 h6 { padding-top: 35px; }
	#s1text { top: 85px; }
	#s2text { width: 54%; }
	.flex-container, .flexslider { z-index: 4; }
	html[dir="rtl"] #s1text { top: 125px; }
	.data-open #data, .data-close #data {width:86% !important; top:89% !important; left:5% !important;}
}	

@media only screen and (max-width: 1250px) {
	#screen1 h6, p { padding-top: 35px;}
	#screen1 h6 {font-size: 30px;}
	#screen2 p {padding-top: 0px;}
	#s2text {width:44%;}
	#data a {/*padding:86px 15px; z-index:5;*/ display:inline-block;   text-align: center;  font-size:18px; padding:15px 14px;}
	.data-open #data, .data-close #data {width:87%; top:80%; left:5% ;   right: 5%; text-align: center;}
	#controls {top:53%;}
	p {font-size: 20px;}
}

@media only screen and (max-width: 978px) {
	#screen2 p {padding-top: 0px;}
	#screen2 p {font-size: 18px !important;}
	#data a { font-size:13px !important;}
	.data-open #data, .data-close #data {width:89%; top:80%; left:4%; height: 7%;   right: 4%;  text-align: center;}
}

@media only screen and (max-width: 767px) {
	#screen2 p {font-size: 18px !important;}
}	


</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="screen1" class="screens opening hide-UI view-2D zoom-large data-close">
				<h6><?php echo _("More big ideas... about solar power"); ?></h6>
				<div id="s1text">
					<p><?php echo _("A cycle, like the water cycle we reviewed, can be defined as a series of events that continually repeats. Another cycle that depends on the sun is the day and night cycle. The sun rising and setting signals us to begin and end our day with work and rest. This cycle is related to the way the earth moves. The earth rotates around itself at the same time it orbits around the sun. It takes earth 24 hours to completely rotate one time. As it rotates, one half of the earth faces the sun and has sunlight, and the other half faces away from the sun and experiences night."); ?></p>
				</div>
				<div id="controls">
					<label class="set-view">
						<input type="checkbox" id="ss-view">
					</label>
				</div>
				<div id="data">
				  <a class="sun" title="<?php echo _("sun"); ?>" href="#sunspeed"><?php echo _("Sun"); ?></a>
				  <a class="mercury" title="<?php echo _("mercury"); ?>" href="#mercuryspeed"><?php echo _("Mercury"); ?></a>
				  <a class="venus" title="<?php echo _("venus"); ?>" href="#venusspeed"><?php echo _("Venus"); ?></a>
				  <a class="earth active" title="<?php echo _("earth"); ?>" href="#earthspeed"><?php echo _("Earth"); ?></a>
				  <a class="mars" title="<?php echo _("mars"); ?>" href="#marsspeed"><?php echo _("Mars"); ?></a>
				  <a class="jupiter" title="<?php echo _("jupiter"); ?>" href="#jupiterspeed"><?php echo _("Jupiter"); ?></a>
				  <a class="saturn" title="<?php echo _("saturn"); ?>" href="#saturnspeed"><?php echo _("Saturn"); ?></a>
				  <a class="uranus" title="<?php echo _("uranus"); ?>" href="#uranusspeed"><?php echo _("Uranus"); ?></a>
				  <a class="neptune" title="<?php echo _("neptune"); ?>" href="#neptunespeed"><?php echo _("Neptune"); ?></a>
				</div>
				<div id="universe" class="scale-stretched">
				  <div id="galaxy">
					<div id="solar-system" class="earth">
					  <div id="mercury" class="orbit">
						<div class="pos">
						  <div class="planet">
							<dl class="infos">
							  <dt><?php echo _("Mercury"); ?></dt>
							  <dd><span></span></dd>
							</dl>
						  </div>
						</div>
					  </div>
					  <div id="venus" class="orbit">
						<div class="pos">
						  <div class="planet">
							<dl class="infos">
							  <dt><?php echo _("Venus"); ?></dt>
							  <dd><span></span></dd>
							</dl>
						  </div>
						</div>
					  </div>
					  <div id="earth" class="orbit">
						<div class="pos">
						  <div class="orbit">
							<div class="pos">
							  <div class="moon"></div>
							</div>
						  </div>
						  <div class="planet">
							<dl class="infos">
							  <dt><?php echo _("Earth"); ?></dt>
							  <dd><span></span></dd>
							</dl>
						  </div>
						</div>
					  </div>
					  <div id="mars" class="orbit">
						<div class="pos">
						  <div class="planet">
							<dl class="infos">
							  <dt><?php echo _("Mars"); ?></dt>
							  <dd><span></span></dd>
							</dl>
						  </div>
						</div>
					  </div>
					  <div id="jupiter" class="orbit">
						<div class="pos">
						  <div class="planet">
							<dl class="infos">
							  <dt><?php echo _("Jupiter"); ?></dt>
							  <dd><span></span></dd>
							</dl>
						  </div>
						</div>
					  </div>
					  <div id="saturn" class="orbit">
						<div class="pos">
						  <div class="planet">
							<div class="ring"></div>
							<dl class="infos">
							  <dt><?php echo _("Saturn"); ?></dt>
							  <dd><span></span></dd>
							</dl>
						  </div>
						</div>
					  </div>
					  <div id="uranus" class="orbit">
						<div class="pos">
						  <div class="planet">
							<dl class="infos">
							  <dt><?php echo _("Uranus"); ?></dt>
							  <dd><span></span></dd>
							</dl>
						  </div>
						</div>
					  </div>
					  <div id="neptune" class="orbit">
						<div class="pos">
						  <div class="planet">
							<dl class="infos">
							  <dt><?php echo _("Neptune"); ?></dt>
							  <dd><span></span></dd>
							</dl>
						  </div>
						</div>
					  </div>
					  <div id="sun">
						<dl class="infos">
						  <dt><?php echo _("Sun"); ?></dt>
						  <dd><span></span></dd>
						</dl>
					  </div>
					</div>
				  </div>
				</div>
			</div>
			<div id="screen2" class="screens">
				<div id="night-day">
					<div id="sky"></div>
					<div id="sun_yellow"></div>
					<div id="sun_red"></div>
					<div id="clouds"></div>
					<div id="ground"></div>
					<div id="night"></div>
					<div id="stars"></div>        
					<div id="sstar"></div>
					<div id="moon"></div>
				</div>
				
				<div id="s2text">
					<p><?php echo _("The rising and setting of the sun has another effect we see everyday - shadows that change as the sun moves across our sky. Shadows change during the day as the sun appears to move. The lower the sun the longer the shadow - the higher the sun the shorter the shadow. The length of a shadow can change dramatically through a day. At sunrise the shadow of the object blocking the sun will be longer than in the middle of the day. Similarly, at sunset the shadow will be longer than in the middle of the day, although the shadow will form in the opposite direction to the shadow at sunrise."); ?></p>
					<p><?php echo _("The size of the shadow depends on a variety of factors including the time of the day, the size of the object blocking the light and the position of the sun at the time the shadow is created."); ?></p>
				</div>
				<div class="flex-container">
					<div class="flexslider">
						<ul class="slides">
							<li><img src="images/8/s3a.jpg"></li>
							<li><img src="images/8/s3b.jpg"></li>
							<li><img src="images/8/s3c.jpg"></li>
							<li><img src="images/8/s3d.jpg"></li>
							<li><img src="images/8/s3e.jpg"></li>
							<li><img src="images/8/s3f.jpg"></li>
						</ul>
					</div>
				</div>
			</div>
			<div id="screen3" class="screens">
				
				<div id="s3text">
				</div>
			</div>
		</div>
	</div>
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="#" class="readmore readmore-toggle" title="<?php echo _("Read More"); ?>"><i class="fa fa-comment"></i></a>
		<a href="9.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Round and round it goes..."); ?></strong></section></section>
	<script src="scripts/jquery.flexslider-min.js"></script>
	<script>
	var hash = window.location.hash.slice(1);
	var screenCount = 2;
	$(document).ready(function() {
		if(hash != "") {
			$('.screens').hide();
			$('#'+hash).show(function () {
				var screen = hash[hash.length -1]; // gets the screen number
				$('h1').fadeOut();
				
				if(screen == screenCount) {
					$('#s2text p').addClass('text-color');
					$('a.readmore-toggle').fadeOut(function(){ $('a.next-toggle').fadeIn(); });
					animateScreen2();
				}
			});
		}
		
		/* Back Transition - change to the corresponding number of screens */
		$('a.back-toggle').click(function(){
			if($('#screen1').is(':visible')) {
				document.location.href = "7.php";
			} else if($('#screen2').is(':visible')) {
				$('#screen2').fadeOut(function (){
					$('h1').fadeIn();
					$('#screen1').fadeIn();
					window.location.hash = '';
				});
				$('a.next-toggle').fadeOut(function() { $('a.readmore-toggle').fadeIn(); });
			}
		});

		/* Read More Screen Transition */
		$('a.readmore-toggle').click(function(){
			$('#screen1').fadeOut( function(){
				$('h1').fadeOut();
				$('#screen2').fadeIn();
				 animateScreen2(function(){
				 });
				window.location.hash = '#screen2';
			});
			$('a.readmore-toggle').fadeOut(function(){ $('a.next-toggle').fadeIn(); });
		});
		
		$('.flexslider').flexslider({
            animation: 'fade',
            controlsContainer: '.flexslider',
			controlNav: false
        });
		
		if($.browser.mozilla) {
			$('#controls').css('display','none');
		}
	});
	
	$(window).load(function(){
		var body = $("#screen1"),
			universe = $("#universe"),
			solarsys = $("#solar-system");

		var init = function() {
			body.removeClass('view-2D opening').addClass("view-3D").delay(2000).queue(function() {
			  $(this).removeClass('hide-UI').addClass("set-speed");
			  $(this).dequeue();
			});
		};

		var setView = function(view) { universe.removeClass().addClass(view); };

		$("#data a").click(function(e) {
			var ref = $(this).attr("class");
			solarsys.removeClass().addClass(ref);
			$(this).parent().find('a').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		});

		$(".set-view").click(function() {
			if($('#ss-view').is(':checked')) {
				$('#saturn .ring').css('margin-top','-130px');
				$('#saturn .ring').css('margin-left','-140px');
			} else {
				$('#saturn .ring').css('margin-top','-58px');
				$('#saturn .ring').css('margin-left','-57px');
			}
			body.toggleClass("view-3D view-2D"); 
		});
		init();
		
		$("#data a").click(function(e) {
			var ref = $(this).attr("class");
			solarsys.removeClass().addClass(ref);
			$(this).parent().find('a').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		});
		
		body.toggleClass("view-3D view-2D");
	});
	
	function animateScreen2() {
		$('#sun_yellow').animate({'top':'96%','opacity':0.4}, 12000,function(){
			$('#stars').animate({'opacity':1}, 5000,function(){
				$('#moon').animate({'top':'30%','opacity':1}, 5000, function(){
					$('#sstar').animate({'opacity':1}, 300);
					$('#sstar').animate({
						'backgroundPosition':'0px 0px','top':'15%', 'opacity':0
					}, 500,function(){
						$('#title').animate({'opacity':1}, 1000);
						$('#back').animate({'opacity':1}, 3000);
					});
				});
			});
		});
		$('#sun_red').animate({'top':'96%','opacity':0.8}, 12000);
		$('#sky').animate({'backgroundColor':'#4F0030'}, 18000);
		$('#clouds').animate({'backgroundPosition':'1000px 0px','opacity':0}, 30000);
		$('#night').animate({'opacity':0.8}, 20000);
		$('#s2text p').addClass('text-color');
	}
	
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
