<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once 'locale.php';
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Gathering Data"); ?></title> <!-- Change module title here -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<style>
.wrap {border-left:1px dashed #f19892; border-right:1px dashed #f19892;}
.bg { background: url('images/6/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#screen2, #screen3 { display: none; }
img.next-toggle { display:none; }
#screen3 ul { padding: 0; margin: 0; font-size: 24px; }
#screen3 ul li { margin-left: 2%;color: #f8fbaa; }
h1 {color:#fef3a6;}
.fl {width:57%;}
#screen1 img {float:right;width:315px; margin-right: 20px; margin-top: 10px; border-radius: 5px;}
#screen2, #screen3 {padding-top:10px;}
.sc2-images {margin-top:20px; text-align: center;}
.sc2-images img {border-radius: 5px; width: 200px; display: inline-block; height: 176px;}
.sc2-images img:last-child { margin-right: 0; }
#screen3 ul {list-style:none;display:block;margin:0 auto;width:22%;}
.numbers {text-align:center;color:#f8fbaa;font-size:36px;padding:0;}
.key2 {color:#FFC5C5;font-size:48px;}
.box7{
    position:relative;
	/*background: -webkit-gradient(linear, 0% 20%, 0% 92%, from(#f06969), to(#AC4747), color-stop(.1,#DA6565)); -moz-gradient(linear, 0% 20%, 0% 92%, from(#f06969), to(#AC4747), color-stop(.1,#DA6565)); gradient(linear, 0% 20%, 0% 92%, from(#f06969), to(#AC4747), color-stop(.1,#DA6565)); -webkit-box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.2) ; */
    border-radius: 5px;
	background: #f06969; /* Old browsers */
	background: -moz-linear-gradient(top,  #f06969 0%, #ac4747 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f06969), color-stop(100%,#ac4747)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #f06969 0%,#ac4747 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #f06969 0%,#ac4747 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #f06969 0%,#ac4747 100%); /* IE10+ */
	background: linear-gradient(to bottom,  #f06969 0%,#ac4747 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f06969', endColorstr='#ac4747',GradientType=0 ); /* IE6-9 */
}
p:last-child{font-size:22px;}
html[dir="rtl"] #screen3 ul li { text-align: center; }
html[dir="rtl"] p.numbers.box7 { text-align: center; }
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="screen1" class="screens">
				<h1><?php echo _("More big ideas... about gathering data"); ?></h1>
					<div class="fl">
					<p><?php echo _("To gather data sometimes it is not necessary to make measurements with special instruments. Sometimes an <span class='key'>estimate</span> of the measurement will do. An estimate is a measurement that is close to the actual measurement but isn't exact. For example, if you know your foot is about 12 inches long, you might estimate the length of fallen tree by walking heel-to-toe on the tree and counting how many \"feet\" it is. It is not an exact way to gather data, but often scientist use estimations before using instruments."); ?> </p>
				</div>
				<img src="images/6/6a.jpg" alt="" />
			</div>
			<div id="screen2" class="screens">
				<p><?php echo _("When scientists use instruments, they do not always get the same value or number every time they use the instrument. So measurements are never exact—there is always some amount of <span class='key'>error</span> in any measurement. For example, the scales at the supermarket that weigh fruits and vegetables are usually only <span class='key'>accurate</span> to the nearest pound. That means when you buy 2 pounds of grapes you may have actually be paying for a little more or a little less than the 2 pounds of grapes."); ?>
				</p>
				<div class="sc2-images">
					<img src="images/6/6ba.jpg" alt="" />
					<img src="images/6/6bc.jpg" alt="" />
					<img src="images/6/6bb.jpg" alt="" />
				</div>
			</div>
			<div id="screen3" class="screens">
				<p><?php echo _("One way to reduce the error in measuring something is to make more than one measurement and <span class='key'>average</span> them.  You can find an average by adding the measurements together and dividing by the number of measurements made. For example, if you wanted to know how long it takes for the school bus to get from your stop to school, you could time the trip for 5 days and average them."); ?>
				</p>
				<p><?php echo _("After gathering your data for days you want to figure out how long it normally takes to get to school."); ?></p>
					<ul class="box7">
						<li><?php echo _("Day"); ?> 1 - 15 <?php echo _("minutes"); ?></li>
						<li><?php echo _("Day"); ?> 2 - 20 <?php echo _("minutes"); ?></li>
						<li><?php echo _("Day"); ?> 3 - 18 <?php echo _("minutes"); ?></li>
						<li><?php echo _("Day"); ?> 4 - 22 <?php echo _("minutes"); ?></li>
						<li><?php echo _("Day"); ?> 5 - 15 <?php echo _("minutes"); ?></li>
					</ul>
					<!-- 15+ 20 +18+22+15 = 90. Then divide the total by the number of days you gathered the data, 90 ÷5 =18. -->
				<p><?php echo _("So you figure out the average by adding up the time spent each day on the bus:"); ?> </p> 
					<p class="numbers box7">15 + 20 + 18 + 22 + 15 = 90</p>
				<p><?php echo _("Then divide the total by the number of days you gathered the data:"); ?> </p>
					<p class="numbers box7">90 ÷ 5 = <span class="key2">18</span></p>	
				<p><?php echo _("So 18 is the average number of minutes it takes the school bus to get from your stop to school."); ?></p> 
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="readmore-toggle" src="images/buttons/readmore.png" title="<?php echo _("Read More"); ?>"></a>
		<a href="7.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Counting the steps to the bus stop..."); ?></strong></section></section>
	<script>
	/* This template is set to 3 screens */
	var hash = window.location.hash.slice(1); // gets the hash when refreshed
	var screenCount = 3; // set number of screens here
	$(document).ready(function() {
		if(hash != "") { // if there is a set hash
			//$('.screens').hide();
			$('#'+hash).show(function () {
				var screen = hash[hash.length -1]; // gets the screen number
				if(screen < screenCount) {
					$('img.readmore-toggle').parent().attr('href','#screen' + screen);
				} else {
					$('img.readmore-toggle').fadeOut(function(){ $('img.next-toggle').fadeIn(); }); // if last screen, removes read more and shows next
				}
			});
		}

		/* Back Transition - change to the corresponding number of screens */
		$('img.back-toggle').click(function(){
			if($('#screen1').is(':visible')) {
				document.location.href = "5.php";
				//$('.bg').css('background-image', "url('images/6/bg.jpg')");
			} else if($('#screen2').is(':visible')) {
				$('.bg').css('background-image', "url('images/6/bg.jpg')");
				$('#screen2').fadeOut(function (){
					$('#screen1').fadeIn();
					window.location.hash = '';
				});
			} else if($('#screen3').is(':visible')) {
				$('.bg').css('background-image', "url('images/6/bg.jpg')");
				$('img.next-toggle').fadeOut(function() { $('img.readmore-toggle').fadeIn(); });
				$('#screen3').fadeOut(function (){
					$('#screen2').fadeIn();
					window.location.hash = '#screen2';
				});
			}
		});

		/* Read More Screen Transition */
		$('img.readmore-toggle').click(function(){
			if($('#screen1').is(':visible')) {
				$('#screen1').fadeOut(function(){
					$('#screen2').fadeIn();
					window.location.hash = '#screen2';
				});
			} else if ($('#screen2').is(':visible')) {
				$('img.readmore-toggle').fadeOut(function() { $('img.next-toggle').fadeIn(); });
				$('#screen2').fadeOut(function(){
					$('#screen3').fadeIn();
					$('.bg').css('background-image', "url('images/6/bg2.jpg')");
					window.location.hash = '#screen3';
				});
			} else if ($('#screen3').is(':visible')){
				$('img.readmore-toggle').fadeOut(function() { $('img.next-toggle').fadeIn(); });
				document.location.href = "6.php#screen3";
			}
		});
		
		var curURL = window.location.toString();
		var oldURL = document.referrer;
		var hash = "";

		if (curURL.indexOf("#screen3") != -1 || oldURL.indexOf("7.php") != -1) {
			$('#screen1').fadeOut(function() { 
				$('#screen2').fadeOut;
				$('#screen3').fadeIn(); 
				$('.bg').css('background-image', 'url(images/6/bg2.jpg)');
			});

			$('img.readmore-toggle').fadeOut(function() { $('img.next-toggle').fadeIn(); });
			addHash('#screen3');
		}

	});
	</script>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
