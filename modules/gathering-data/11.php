<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(11, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'gathering-data-qc4-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Gathering Data"); ?></title> <!-- Change module title here -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" type="text/css" href="styles/svgcomponent.css" />

<script src="scripts/jquery.min.js"></script>

<script src="scripts/jquery-ui.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/svgmodernizr.custom.js"></script>
<script src="scripts/jquery.jsPlumb-1.4.1-all-min.js"></script>
<script src="scripts/jquery.ui.touch-punch.min.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
.wrap { border-left: 1px dashed #d8e2a9; border-right: 1px dashed #d8e2a9; }
body { overflow: hidden; }
/**#containerId { margin-top: 20px; }
 #containerId > div:nth-child(8), #containerId > div:nth-child(13) {top: 399px !important;}
#containerId > div:nth-child(4), #containerId > div:nth-child(9) {top: 239px !important;}
#containerId > div:nth-child(5), #containerId > div:nth-child(10) {top:279px !important;}
#containerId > div:nth-child(6), #containerId > div:nth-child(11) {top:319px !important;}
#containerId > div:nth-child(7), #containerId > div:nth-child(12) {top:359px !important;}**/
.bg { background: url('images/9/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
#answer p { text-align: center; }
#answer img { height: 30px; }
/* #question section { height: 300px; } */
img.next-toggle { display: none; }

.ac-custom label.r1::before { color: red; margin-top: -28px }
.ac-custom label::before { color: #F4938C; background: #F4938C; }
.ac-circle label::before { width: 20px; height: 20px; margin-top: -10px; left: 4px; }
.ac-circle svg { width: 35px; margin-top: -25px; left: 1px;color: #F4938C; }

.ac-custom input[type="radio"]:checked + label { color: orange }
#choices1a { padding: 0; cursor: pointer; }
#choices1a div, #choices1b div { background-color: white; border-radius: 5px; margin: 10px 0 0 0; }
#choices1a div li, #choices1b div li { font-size: 24px; list-style-type: none; padding-left: 10px;}
#choices1a { float: left; width:45%; }
#choices1b { float: right; width:45%; }
.trigger { cursor: pointer; }

.box {
}
#col2 ul li:nth-child(2) {
font-size: 22px;
}
#col2 ul li:nth-child(4){font-size:20px;}
.lBox { background-color: #FFD47F;  height: 30px; width: 300px; border-radius: 5px; margin-top:10px; padding-left: 20px;}
.rBox { background-color: #4FCBC7; height: 30px; width: 370px; border-radius: 5px; margin-top:10px; padding-left: 20px;}
.rBox span { width: 150px; background-color: white; }
/**#col1 { float: left; }
#col2 { float: right; }**/
#col1 { position: absolute; top: 30px; left: 20px; }
#col2 { position: absolute; top: 30px; right: 10px; }
.bg ul li { list-style-type: none; font-size: 24px;}
#reset { background: white; padding: 5px 10px; border-radius: 5px; border: solid white; margin-top: -10px; float: right; margin-right: 30px; }
#reset:hover { border: solid #4FCBC7; cursor: pointer; }
.ansImg {width: 30px; position: absolute; left: 2px; }
#question1 {height:245px; position: relative; margin-bottom: 10px;}
#cover { height: 236px; width: 852px; background: transparent; display: none; position: absolute; z-index: 9999; }
.topper {width: 80%;}
/* .instruc {color:#8D3FB3;} */
#question2 h2 {float: left;}
.ac-custom ul { float: left; }
<?php if($language == "es_ES") { ?>
	.bg ul li { font-size: 18px; }
	#col2 ul li:nth-child(2) { font-size: 17px; }
	#col2 ul li:nth-child(4) { font-size: 16px; }
	#reset { margin-top:0; }
	h2 { font-size: 22px; }
	.ac-custom label { font-size: 22px; }
	#question1 { margin-bottom: 0; }
<?php } ?>

<?php if($language == "zh_CN") { ?>
	.ac-custom ul { clear: both; }
<?php } ?>

html[dir="rtl"] #question2 h2 { float: right; }
html[dir="rtl"] .ac-custom ul { float: right; margin-right: 145px; }
html[dir="rtl"] .ac-circle input[type="checkbox"], .ac-circle input[type="radio"], .ac-circle label::before { right: 10px; }
html[dir="rtl"] .ac-custom label { padding: 0 40px 0 0; }
html[dir="rtl"] .ac-circle svg { right: 8px; }
html[dir="rtl"] .rBox { padding-right: 20px; }
html[dir="rtl"] .lBox { padding:0; font-size: 17px; }
html[dir="rtl"] .ansImg { left: -33px; }
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1 class="add-text"><?php echo _('Quick Check #4'); ?></h1>
				<h2><?php echo _('Question A. If we want to make quantitative observations to gather data, we make measurements. Connect each unit of measurement on the left to the situation on the right by dragging any of the circles at the left column to another circle in the right column. <span class="instruc">Click the "Start Over" button to remove the lines and connect again.</span>'); ?></h2>
				<section id="question1">
					<div id="cover"></div>
					<div id="containerId">
						<div class="clear"><span id="reset"> <?php echo _('Start Over'); ?> </span></div>
						<div id="col1">
							<ul>
							    <li><div class='rBox' id="c1"><?php echo _('Kilograms or pounds'); ?></div></li>
							    <li><div class='rBox' id="c2"><?php echo _('Liquid ounce or milliliter'); ?></div></li>
							    <li><div class='rBox' id="c3"><?php echo _('Kilometers or miles'); ?></div></li>
							    <li><div class='rBox' id="c4"><?php echo _('Inches or centimeters'); ?></div></li>
							    <li><div class='rBox' id="c5"><?php echo _('Seconds or minutes'); ?></div></li>
						    </ul>
							
						 </div>
						<div id="col2">
							<ul>
							    <li><div class='lBox' id="A"><?php echo _('Length of a bridge'); ?></div></li>
							    <li><div class='lBox' id="B"><?php echo _('Amount of water in a squirt gun'); ?></div></li>
							    <li><div class='lBox' id="C"><?php echo _('How much you weigh'); ?></div></li>
							    <li><div class='lBox' id="D"><?php echo _('How long you can stay under water'); ?></div></li>
							    <li><div class='lBox' id="E"><?php echo _('The width of your TV screen'); ?></div></li>
						    </ul>
						 </div>
						  
					</div>
 				
				</section>
				<section id="question2">
					<form class="ac-custom ac-radio ac-circle" autocomplete="off">

						<h2><?php echo _('Question B. Which of the following would probably be measured in liters or milliliters?'); ?></h2>
						<ul id="choices2">
							<li><input id="ra" name="r2" type="radio" value="A"><label for="ra"><?php echo _('The area of your classroom.'); ?></label></li>
							<li><input id="rb" name="r2" type="radio" value="B"><label for="rb"><?php echo _('The length of your book.'); ?></label></li>
							<li><input id="rc" name="r2" type="radio" value="C"><label for="rc"><?php echo _('The volume of your water bottle.'); ?></label></li>
							<li><input id="rd" name="r2" type="radio" value="D"><label for="rd"><?php echo _('The weight of your book bag.'); ?></label></li>
						</ul>
						
					</form>
				</section>
			</div>
			<div id="answer">
				<div class="answer-item"> 	

					<h2><?php echo _('Question B. Which of the following would probably be measured in liters or milliliters?'); ?></h2>
					<p><?php echo _('You answered...'); ?></p>
					<p><span id="selected_answer2"> </span></p>
					<p class="topper"><img id="answericon2"><span id="feedback2"> </span></p>
				</div>
			</div>

				
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _("Check Answer"); ?>"></a>
		<a href="12.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Ready for your last quick check?'); ?></strong></section></section>
	<script>
		var source="";
		var target="";
		var choices="";
		var ans1, ans2, ans3, ans4, ans5;
		var answered = <?php echo $answered; ?>;
		var feedback ='';
		var feedback2 ='';
		var studentAnswer1='';
		var studentAnswer2='';
		var selected_answer1='';
		var selected_answer2='';
		var nullAnswer= false;
		var answered = 0;
		var answer=0;
		var checked={};
		var str ='';
		var textstr =''
		var answer = $('#answer'),
			back = $('img.back-toggle'),
			next = $('img.next-toggle'),
			check = $('img.check-toggle'),
			question = $('#question');


	$(document).ready(function() {

		jsPlumb.bind("ready", function() {
	
			var startpointOptions = { isSource:true,container:$('#containerId'), anchors:["Right"], connector:[ "Straight" ] };
			var endpointOptions = { isTarget:true,container:$('#containerId'), connector:["Straight"], anchors:["Left"] };
			var startpoint = jsPlumb.addEndpoint($('.rBox'), startpointOptions);
			var endpoint = jsPlumb.addEndpoint($('.lBox'), endpointOptions);
	
		  //get answers
				jsPlumb.bind("jsPlumbConnection", function (conn) {
				     if (conn.sourceId=='c1'){
				    	 ans1 = conn.targetId;
				     }else if (conn.sourceId=='c2'){
				    	 ans2 = conn.targetId;
				     }else if (conn.sourceId=='c3'){
				    	 ans3 = conn.targetId;
				     }else if (conn.sourceId=='c4'){
				    	 ans4 = conn.targetId;
				     }else if (conn.sourceId=='c5'){
				    	 ans5 = conn.targetId;
				     }
				     //resets all connections
				     $('#reset').click(function(){
				        jsPlumb.detach(conn);
				    });
				    
				    $('img.back-toggle').click(function() {
				    	if ($('#answer').is(':visible')) {
				    	    jsPlumb.detach(conn);
				    	}
				    });
				    
				});
			
		});

		$('img.back-toggle').click(function() {
			if($('#question2').is(':visible')) {
				document.location.href = "10.php"; // change to the previous page's last screen e.g. 8.html#screen4
			} else if ($('#answer').is(':visible')) {
				$('img.next-toggle').fadeOut(function() { $('img.check-toggle').fadeIn(); });
				$('#cover').css('display', 'none');
				$('#question1').fadeOut();
				$("li img").remove();
				$('#answer').fadeOut(function() {
					$('#col1').css('top', '30px');
					$('#col2').css('top', '30px');
					$('#question').fadeIn();
					$('#question1').fadeIn();
					$('#question2').fadeIn();
					$('#reset').fadeIn();
					jsPlumb.repaint($('.lBox , .rBox'));
					$('#feedback2').removeClass('green');
					$('#feedback2').removeClass('red');
					$('#question').append($('#tbl1'));	
					$('.choices').draggable('enable');
					studentAnswer2 = '';
					str = '';
					answer = 0;
				});
			}
		});
		
		$('img.check-toggle').click(function(e){
		checkNull();
		if(nullAnswer == true) {
			e.preventDefault();
			window.location.hash='';
			alert("<?php echo _("Please select your answers."); ?>");
			nullAnswer = false;
			$('#question2').append($('#tbl1'));
			studentAnswer2 = '';
			str = '';
			answer = 0;
			$('#feedback2').removeClass('green');
			$('#feedback2').removeClass('red');
		} else {
				$('img.check-toggle').fadeOut(function(){
					//$('#question').fadeOut();
					//$('#containerId').fadeIn();
					$('img.next-toggle').fadeIn();
				});
				$('#cover').css('display', 'block');
				$('#reset').fadeOut();
				$('#question2').fadeOut(function(){
					$('.add-text').text('<?php echo _("Quick Check #4"); ?> - <?php echo _("How did I do?"); ?>');
					checkAnswer();
					$('#containerId').fadeIn();
					$('#answer').fadeIn();
					window.location.hash = "answer";
					$('#col1').css('top', '3px');
					$('#col2').css('top', '3px');
					jsPlumb.repaint($('.lBox , .rBox'));
					save();
				});
			}
		});
	});

	function checkAnswer(){
		//check answer for question A
		
		if( ans1 == 'C'){
			$('#c1').parent().prepend('<img class="ansImg" src="images/others/correct.png"/>');
		} else {
			$('#c1').parent().prepend('<img class="ansImg" src="images/others/wrong.png"/>'); }
		if( ans2 == 'B'){
			$('#c2').parent().prepend('<img class="ansImg" src="images/others/correct.png"/>');
		} else {
			$('#c2').parent().prepend('<img class="ansImg" src="images/others/wrong.png"/>'); }
		if( ans3 == 'A'){
			$('#c3').parent().prepend('<img class="ansImg" src="images/others/correct.png"/>');
		} else {
			$('#c3').parent().prepend('<img class="ansImg" src="images/others/wrong.png"/>'); }
		if( ans4 == 'E'){
			$('#c4').parent().prepend('<img class="ansImg" src="images/others/correct.png"/>');
		} else {
			$('#c4').parent().prepend('<img class="ansImg" src="images/others/wrong.png"/>'); }
		if( ans5 == 'D'){
			$('#c5').parent().prepend('<img class="ansImg" src="images/others/correct.png"/>');
		} else {
			$('#c5').parent().prepend('<img class="ansImg" src="images/others/wrong.png"/>'); }
		//end question A check
		
		studentAnswer2 = $("input[name='r2']:checked").val();
		//alert(studentAnswer2);
		if (studentAnswer2 == "C"){
			$("#selected_answer2").text("<?php echo _('The volume of your water bottle.'); ?>");
			textstr = "<?php echo _('Correct! The volume of a container for a liquid, such as a water bottle, is usually measured in liters or milliliters in the metric system.'); ?>";
			$("#answericon2").attr("src", "images/others/correct.png");
			$("#feedback2").addClass('green');
		} else {
			if (studentAnswer2 == "A") {
				$("#selected_answer2").text("<?php echo _('The area of your classroom.'); ?>");
				textstr = " <?php echo _('Nope! The area of your classroom would be measured in square feet or meters.'); ?>";
			} else if (studentAnswer2 == "B"){
				$("#selected_answer2").text("<?php echo _('The length of your book.'); ?>");
				textstr = " <?php echo _('Nope! The length of your book would be measured in inches or centimeters.'); ?>";	
			} else if (studentAnswer2 == "D"){
				$("#selected_answer2").text("<?php echo _('The weight of your book bag.'); ?>");
				textstr = " <?php echo _('Nope! The weight of your book bag would be measured in kilos or pounds.'); ?>";
			}
				$("#answericon2").attr("src", "images/others/wrong.png");
				$("#feedback2").addClass('red');
		}
		$("#feedback2").text(textstr);
		
	}
	
	function save(){
		if(answered == 0) {
			saveAnswer('gathering-data-qc4-a', ans1);
			saveAnswer('gathering-data-qc4-b', ans2);
			saveAnswer('gathering-data-qc4-c', ans3);
			saveAnswer('gathering-data-qc4-d', ans4);
			saveAnswer('gathering-data-qc4-e', ans5);
			saveAnswer('gathering-data-qc4-f', studentAnswer2);
			answered = 1;
		}
				
	}
	
	function checkNull(){
		if(studentAnswer1 ==null){
			nullAnswer = true;
		}
		if (!$("div[elid='c1']").hasClass("_jsPlumb_endpoint_connected")){
			nullAnswer = true;
		}
		if (!$("div[elid='c2']").hasClass("_jsPlumb_endpoint_connected")){
			nullAnswer = true;
		}
		if (!$("div[elid='c3']").hasClass("_jsPlumb_endpoint_connected")){
			nullAnswer = true;
		}
		if (!$("div[elid='c4']").hasClass("_jsPlumb_endpoint_connected")){
			nullAnswer = true;
		}
		if (!$("div[elid='c5']").hasClass("_jsPlumb_endpoint_connected")){
			nullAnswer = true;
		}
	}
	</script>
	
	<script src="scripts/svgcheckbx.js"></script>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
