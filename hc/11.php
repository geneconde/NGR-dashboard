<?php 
	/*require_once "../../session.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(11, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'heating-and-cooling-qc4-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo _("Heating and Cooling"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="initial-scale=1">

	<link rel="stylesheet" href="css/locale.css" />
	<link rel="stylesheet" href="css/fonts.css" />
	<link rel="stylesheet" href="css/jpreloader.css" />
	<link rel="stylesheet" href="css/video.css" />
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<style>
		html, body {overflow: hidden;}
		#buttons .next { display: none; }

		.images { text-align: center; }
		.images img { display: inline-block; }
	
		.bg { background-image: url('images/11/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		.bg ul { text-align: center; }

		.feedback { text-align: center; }

		#answers { display: none; }
		#question2 .images { margin-top: 10px; }
		#question2 img { width: 90%; }

		#question1, #question2, #answer1, #answer2 { background-color: rgba(135, 206, 250, .3); margin: 0 auto; -webkit-border-radius:10px; -moz-border-radius:10px; border-radius:10px;	margin-bottom: 10px; padding: 0 10px; width: 100%; }
	
		#question1, #question2, #answer1, #answer2 { width:48%; float: left; margin-right: 2%; padding-bottom: 7px; }

  	#question1 ul { 
			margin: auto;
			padding-left: 10px;
		}

		#question1 li {
			text-align: center;
			float: left;
			width: 189px;
			margin: 0 17px 0 0;
		}
    

    #question1 label { padding-left: 0 !important; } 

		#question1 img { cursor: pointer; margin-bottom: -5px; }
		#question1 li.nrm { margin-right: 0; }
		#question1 li span { display: block; text-align: center; }
    #question1 li input[type=radio] { display: none; }
   
		label { padding-left: 10px !important; cursor: pointer; }

		input[type="radio"] { display: none; }
		
		input[type="radio"] + label span {
			vertical-align: middle;
			display:inline-block;
			width:30px;
			height:30px;
			background:url('images/misc/water.png') no-repeat;
			cursor:pointer;
			margin-right: 5px;
		}

		input[type="radio"]:checked + label span { background:url('images/misc/fire.png') no-repeat; }

    img.bordered { border: 4px solid #236994; }
    img.trans-border { border: 4px solid transparent; }
    
    th, td { width: 125px; background: rgba(255, 255, 255, 0.7); border-radius: 5px; text-align: center;}
    #questions table {position: relative; z-index: 5;}
   #question1 table img { height: 65px; margin: 0 25px; border-radius: 10px; }
    .drag1, .drag2, .drag3, .drag4, .drag5, .drag6 { width: 125px; height: 75px; }
    .drag1, .drag2 img { width: 85px; }
	.grab { cursor: move; cursor: -moz-grab; cursor: -webkit-grab; }
	.grabbing { cursor: move; cursor: -moz-grabbing; cursor: -webkit-grabbing; }
    
	#answer1 td { height: 70px; }
	#answer1 td img { margin: 0 27px; }
	.feedback img { width: 22px; border: none;  }
	#dp_swf_engine { display: none; }

	
		@media only screen and (max-width: 1024px) {
			h2, p, li {font-size:20px !important;}
			#question1 table img {height:58px;}
			#answer1 td {height: 65%;}
		}
		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
			#question1 table img {height:50px;}	
		}

		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) and (-webkit-min-device-pixel-ratio: 1) {
			#question1 table img {height:75px;}	
		}

		@media only screen and (min-width: 600px) and (max-width: 1250px)  and (orientation : landscape)  and (-webkit-min-device-pixel-ratio: 1){
			h2, p, li {font-size:20px !important; padding:0px 0px;}
			#question1 table img {height:50px;}	
			#answer1 td {height: 65%;}
		}
		td.q1f img {
		    width: 75px !important;
		    height: 65px !important;
		}
		img#drag6 {
		    width: 75px !important;
		    height: 65px !important;
		}
		#answer1 td#a1f1 img {
		    height: 60px !important;
		    width: 70px !important;
		}
		#answer1 td#a1f2 img {
		    height: 60px !important;
		    width: 70px !important;
		}

		@media only screen and (max-width: 1250px){
			img#drag6 {
			    width: 58px !important;
			    height: 50px !important;
			}
		}



/*		@media only screen and (max-width: 960px){
			td.q1f img {
			    width: 58px !important;
			    height: 50px !important;
			}
			img#drag6 {
			    width: 58px !important;
			    height: 50px !important;
			}
			#answer1 td#a1f1 img {
			    width: 58px !important;
			    height: 50px !important;
			}
			#answer1 td#a1f2 img {
			    width: 58px !important;
			    height: 50px !important;
			}
		}*/

		@media only screen and (max-width: 960px){
			#answer1 td#a1a1 img { height: 50px !important; width: 60px !important; }
			#answer1 td#a1a2 img { height: 50px !important; width: 60px !important; }
			#answer1 td#a1b1 img { height: 50px !important; width: 60px !important; }
			#answer1 td#a1b2 img { height: 50px !important; width: 60px !important; }
			#answer1 td#a1c1 img { height: 50px !important; width: 60px !important; }
			#answer1 td#a1c2 img { height: 50px !important; width: 60px !important; }
			#answer1 td#a1d1 img { height: 50px !important; width: 60px !important; }
			#answer1 td#a1d2 img { height: 50px !important; width: 60px !important; }
			#answer1 td#a1e1 img { height: 50px !important; width: 60px !important; }
			#answer1 td#a1e2 img { height: 50px !important; width: 60px !important; }
			#answer1 td#a1f1 img { height: 50px !important; width: 60px !important; }
			#answer1 td#a1f2 img { height: 50px !important; width: 60px !important; }
		}
	</style>

</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div id="questions">
				<h1><?php echo _("Quick Check #4"); ?></h1>

				<div id="question1">
					<h2><?php echo _("Question A. Drag each item into the column that best describes how it acts—as a conductor of heat or as an insulator."); ?></h2>
   					<table>
						<tr>
							<th><?php echo _("Item"); ?></th>
							<th><?php echo _("Insulator"); ?></th>
							<th><?php echo _("Conductor"); ?></th>
						</tr>
	
						<tr>
							<td class="q1a"><img id="drag1" class="drag" src="images/11/mittens.jpg" alt='<?php echo _("Mittens"); ?>'></td>
							<td id="q1a1"></td>
							<td id="q1a2"></td>
						</tr>
						
						<tr>
							<td class="q1b"><img id="drag2" class="drag" src="images/11/silverware.jpg" alt="<?php echo _("Silverware"); ?>"></td>
							<td id="q1b1"></td>
							<td id="q1b2"></td>
						</tr>
						
						<tr>
							<td class="q1c"><img id="drag3" class="drag" src="images/11/ladle.jpg" alt="<?php echo _("Metal soup ladle"); ?>"></td>
							<td id="q1c1"></td>
							<td id="q1c2"></td>
						</tr>
						
						<tr>
							<td class="q1d"><img id="drag4" class="drag" src="images/11/spoon.jpg" alt="<?php echo _("Wooden spoon"); ?>"></td>
							<td id="q1d1"></td>
							<td id="q1d2"></td>
						</tr>
						
						<tr>
							<td class="q1e"><img id="drag5" class="drag" src="images/11/papercup.jpg" alt="<?php echo _("Paper cup"); ?>"></td>
							<td id="q1e1"></td>
							<td id="q1e2"></td>
						</tr>
						
						<tr>
							<td class="q1f"><img id="drag6" class="drag" src="images/11/fish.jpg" alt="<?php echo _("Aluminum foil"); ?>"></td>
							<td id="q1f1"></td>
							<td id="q1f2"></td>
						</tr>
						
					</table>
				</div>

				<div id="question2">
					<h2><?php echo _("Question B. Choose the answer that correctly names 1 and 2."); ?></h2>

					<div class="images">
						<img src="images/11/pan.jpg" alt="<?php echo _("Frying pan with wooden handle"); ?>">
					</div>

					<ul>
						<li>
							<input type="radio" name="q2" id="a2" value="A">
							<label for="a2"><span></span><?php echo _("A. 1 - Conductor, 2 - Insulator"); ?></label>
						</li>
						<li>
							<input type="radio" name="q2" id="b2" value="B">
							<label for="b2"><span></span><?php echo _("B. 1 - Conductor, 2 - Conductor"); ?></label>
						</li>
						<li>
							<input type="radio" name="q2" id="c2" value="C">
							<label for="c2"><span></span><?php echo _("C. 1 - Insulator, 2 - Conductor"); ?></label>
						</li>
						<li>
							<input type="radio" name="q2" id="d2" value="D">
							<label for="d2"><span></span><?php echo _("D. 1 - Insulator, 2 - Insulator"); ?></label>
						</li>
					</ul>
				</div>
			</div>
			<div id="answers">
				<h1><?php echo _("Quick Check #4"); ?> - <?php echo _("How did I do?"); ?></h1>

				<div id="answer1">
					<h2><?php echo _("Question A. Drag each item into the column that best describes how it acts—as a conductor of heat or as an insulator."); ?></h2>
					<table>
						<tr>
							<th></th>
							<th><?php echo _("Insulator"); ?></th>
							<th><?php echo _("Conductor"); ?></th>
						</tr>
					
						<tr class="q1a">
							<td class="feedback"></td>			
							<td id="a1a1"></td>
							<td id="a1a2"></td>				
						</tr>
						
						<tr class="q1b">
							<td class="feedback"></td>			
							<td id="a1b1"></td>
							<td id="a1b2"></td>				
						</tr>
						
						<tr class="q1c">
							<td class="feedback"></td>			
							<td id="a1c1"></td>
							<td id="a1c2"></td>				
						</tr>
						
						<tr class="q1d">
							<td class="feedback"></td>			
							<td id="a1d1"></td>
							<td id="a1d2"></td>				
						</tr>
						
						<tr class="q1e">
							<td class="feedback"></td>			
							<td id="a1e1"></td>
							<td id="a1e2"></td>				
						</tr>
						
						<tr class="q1f">
							<td class="feedback"></td>			
							<td id="a1f1"></td>
							<td id="a1f2"></td>				
						</tr>
					</table>

				</div>

				<div id="answer2">
					<h2><?php echo _("Question B. Choose the answer that correctly names 1 and 2."); ?></h2>
					<p class="center"><?php echo _("You answered..."); ?></p>
					<div class="images"><img height="80px" src="images/11/pan.jpg" alt="Frying pan with wooden handle"></div>
					<div class="image answer"></div>
					<p class="feedback"></p>
				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="12.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader">
		<section class="selected">
			<strong><?php echo _("Hot, hot, hot!"); ?></strong>
		</section>
	</section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/qtip.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/jquery-ui.js"></script>
	<script src="scripts/jquery.ui.touch-punch.min.js"></script>
	<script src="scripts/saveanswer.js"></script>
	
	<script>
	var answered = 0,
		
	aa1 = '', 
	aa2 = '', 
	aa3 = '',
	aa4 = '',
	aa5 = '',
	aa6 = '',
	
    ans1 = '',
    ans2 = '',
    questions = $('#questions'),
    answers = $('#answers'),
    question1 = $('#question1'),
    question2 = $('#question2'),
    q1 = $('#question1').find('input[type=radio]'),
    q2 = $('#question2').find('input[type=radio]'),
    answer1 = $('#answer1'),
    answer2 = $('#answer2'),
    check = $('a.checkanswer'),
    back = $('a.back'),
    next = $('a.next'),
    a = $('#a'),
		b = $('#b'),
		c = $('#c'),
		d = $('#d');
	
    q1.on('click', function() {
    });
    	


							
	if ($('td.q1a').find('div').html() == '' && $('td.q1b').find('div').html() == '' && $('td.q1c').find('div').html() == '' && $('td.q1d').find('div').html() == '' && $('td.q1e').find('div').html() == '' && $('td.q1f').find('div').html() == ''){
		
	}

	q2.on('click', function() {
			var radio = $(this).val();
      
      if (radio == 'A') {
				answer2.find('.answer').html('<p><?php echo _("A. 1 - Conductor, 2 - Insulator"); ?></p>');
        answer2.find('.feedback').html('<img src="images/misc/correct.png" alt="Correct" /> <?php echo _("Correct. The metal (1) is a conductor, and the wooden handle (2) is an insulator."); ?>').removeClass('red').addClass('green');

        ans2 = 'A';
			}

			if (radio == 'B') {
				answer2.find('.answer').html('<p><?php echo _("B. 1 - Conductor, 2 - Conductor"); ?></p>');
        answer2.find('.feedback').html('<img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. Only the metal (1) is a conductor, the wooden handle (2) is an insulator."); ?>').removeClass('green').addClass('red');

        ans2 = 'B';
			}

			if (radio == 'C') {
				answer2.find('.answer').html('<p><?php echo _("C. 1 - Insulator, 2 - Conductor"); ?></p>');
        answer2.find('.feedback').html('<img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. Just the opposite. The metal (1) is a conductor and the wooden handle (2) an insulator."); ?>').removeClass('green').addClass('red');

        ans2 = 'C';
			}

			if (radio == 'D') {
				answer2.find('.answer').html('<p><?php echo _("D. 1 - Insulator, 2 - Insulator"); ?></p>');
        answer2.find('.feedback').html('<img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No, The wooden handle (2) is an insulator, but the metal (1) is a conductor."); ?>').removeClass('green').addClass('red');

        ans2 = 'D';
			}
		});
//$('td.q1a').find('div').html() == '' && $('td.q1b').find('div').html() == '' && $('td.q1c').find('div').html() == '' && $('td.q1d').find('div').html() == '' && $('td.q1e').find('div').html() == '' && $('td.q1f').find('div').html() == ''
		check.on('click', function() {
			if ($('td.q1a').html() == '' && $('td.q1b').html() == '' && $('td.q1c').html() == '' && $('td.q1d').html() == '' && $('td.q1e').html() == '' && $('td.q1f').html() == '' && ans2 != '') {
				questions.fadeOut(function() {
					answers.fadeIn();
					window.location.hash = '#answers';
				});

				check.fadeOut(function() {
					next.fadeIn();
					back.fadeIn();
				});
				save();
			} else {
				alert('<?php echo _("Please select your answers."); ?>');
			}
		});

		back.on('click', function() {
			if (questions.is(':visible')) {
				document.location.href = "10.php";
			}
			else {
				answers.fadeOut(function() {
					questions.fadeIn();
				});
				next.fadeOut(function() {
					check.fadeIn();
				});
			}
		});

		function save() {
		
			// Question 1 check
			if ($('#q1a1').html() != '') {
				aa1 = 'insulator';
				
				$('tr.q1a').find('.feedback').html('<img src="images/misc/correct.png" alt="wrong" class="no-border">');
				
				answer1.find('#a1a1').html('<img src="images/11/mittens.jpg" width="70">');
				answer1.find('#a1a2').html('');
			} else if ($('#q1a2').html() != '') { 
				aa1 = 'conductor';
				
				$('tr.q1a').find('.feedback').html('<img src="images/misc/wrong.png" alt="wrong" class="no-border">'); 
				answer1.find('#a1a1').html('');
				answer1.find('#a1a2').html('<img src="images/11/mittens.jpg" width="70">');
			}
			
			if ($('#q1b1').html() != '') {
				aa2 = 'insulator';
				
				$('tr.q1b').find('.feedback').html('<img src="images/misc/wrong.png" alt="wrong" class="no-border">');
		
				answer1.find('#a1b1').html('<img src="images/11/silverware.jpg" width="70">');
				answer1.find('#a1b2').html('');
			} else if ($('#q1b2').html() != '') { 
				aa2 = 'conductor';
				
				$('tr.q1b').find('.feedback').html('<img src="images/misc/correct.png" alt="wrong" class="no-border">'); 
				answer1.find('#a1b1').html('');
				answer1.find('#a1b2').html('<img src="images/11/silverware.jpg" width="70">');
			}
			
			if ($('#q1c1').html() != '') {
				aa3 = 'insulator';
				
				$('tr.q1c').find('.feedback').html('<img src="images/misc/wrong.png" alt="wrong" class="no-border">');
		
				answer1.find('#a1c1').html('<img src="images/11/ladle.jpg" width="70">');
				answer1.find('#a1c2').html('');
			} else if ($('#q1c2').html() != '') { 
				aa3 = 'conductor';
				
				$('tr.q1c').find('.feedback').html('<img src="images/misc/correct.png" alt="wrong" class="no-border">'); 
				answer1.find('#a1c1').html('');
				answer1.find('#a1c2').html('<img src="images/11/ladle.jpg" width="70">');
			}
			
			if ($('#q1d1').html() != '') {
				aa4 = 'insulator';
				
				$('tr.q1d').find('.feedback').html('<img src="images/misc/correct.png" alt="wrong" class="no-border">');
		
				answer1.find('#a1d1').html('<img src="images/11/spoon.jpg" width="70">');
				answer1.find('#a1d2').html('');
			} else if ($('#q1d2').html() != '') { 
				aa4 = 'conductor';
				
				$('tr.q1d').find('.feedback').html('<img src="images/misc/wrong.png" alt="wrong" class="no-border">'); 
				answer1.find('#a1d1').html('');
				answer1.find('#a1d2').html('<img src="images/11/spoon.jpg" width="70">');
			}
			
			if ($('#q1e1').html() != '') {
				aa5 = 'insulator';
				
				$('tr.q1e').find('.feedback').html('<img src="images/misc/correct.png" alt="wrong" class="no-border">');
		
				answer1.find('#a1e1').html('<img src="images/11/papercup.jpg" width="70">');
				answer1.find('#a1e2').html('');
			} else if ($('#q1e2').html() != '') { 
				aa5 = 'conductor';
				
				$('tr.q1e').find('.feedback').html('<img src="images/misc/wrong.png" alt="wrong" class="no-border">'); 
				answer1.find('#a1e1').html('');
				answer1.find('#a1e2').html('<img src="images/11/papercup.jpg" width="70">');
			}
			
			if ($('#q1f1').html() != '') {
				aa6 = 'insulator';
				
				$('tr.q1f').find('.feedback').html('<img src="images/misc/wrong.png" alt="wrong" class="no-border">');
		
				answer1.find('#a1f1').html('<img src="images/11/fish.jpg" width="70">');
				answer1.find('#a1f2').html('');
			} else if ($('#q1f2').html() != '') { 
				aa6 = 'conductor';
				
				$('tr.q1f').find('.feedback').html('<img src="images/misc/correct.png" alt="wrong" class="no-border">');
				 
				answer1.find('#a1f1').html('');
				answer1.find('#a1f2').html('<img src="images/11/fish.jpg" width="70">');
			}
			
			ans1 = aa1 + ',' + aa2 + ',' + aa3 + ',' + aa4 + ',' + aa5 + ',' + aa6;
			if (answered == 0) {
				console.log(ans1);
				saveAnswer('heating-and-cooling-qc4-a', aa1);
				saveAnswer('heating-and-cooling-qc4-b', aa2);
				saveAnswer('heating-and-cooling-qc4-c', aa3);
				saveAnswer('heating-and-cooling-qc4-d', aa4);
				saveAnswer('heating-and-cooling-qc4-e', aa5);
				saveAnswer('heating-and-cooling-qc4-f', aa6);
				saveAnswer('heating-and-cooling-qc4-g', ans2);

				answered = 1;
			}
		}
		
		function allowDrop(e) {
			e.preventDefault(); 
		}

		function drag(e) {
			e.dataTransfer.setData("Text", e.target.id); 
		}

		function drop(e) {

			var eleid = e.dataTransfer.getData("Text");
			var el = e.target;

			if ( $(el).hasClass(eleid) ) {
				el.appendChild(document.getElementById(eleid));
			}

			e.preventDefault();

		}

		$('#question1 img').draggable({ revert: 'invalid' });
		
		$('#question1 img').each(function() {
			var image = $(this);
			var p = $(this).parent().parent().children(':not(:first-child)');
			var drop1 = $(this).parent().parent().children(':nth-child(2)');
			var drop2 = $(this).parent().parent().children(':nth-child(3)');
			
			image.mousedown(function() { image.removeClass('grab'); image.addClass('grabbing'); image.css('opacity', '0.7'); });
			image.mouseup(function() { image.removeClass('grabbing'); image.addClass('grab'); image.css('opacity', '1'); });
			
			drop1.droppable ({
				accept: image,
				drop: function (event, ui) { image.detach().css({top: 0,left: 0}).appendTo(drop1); }
			});
			
			drop2.droppable ({
				accept: image,
				drop: function (event, ui) { image.detach().css({top: 0,left: 0}).appendTo(drop2); }
			});
		});
		
		$('.bg img').qtip({
			content: $(this).attr('alt'),
			position: {
				corner: {
					tooltip: 'bottomLeft',
					target: 'topRight'
				}
			},
			style: {
				border: {
					radius: 5
				},
				tip: true,
				name: 'cream'
			}
		});
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
