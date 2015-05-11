<?php
    include_once '../dashboard/controller/Subscriber.Controller.php';
    include_once '../dashboard/php/auto-generate.php';
?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 3.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest (the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title><?php echo _("NexGenReady - Subscribe"); ?></title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">
  <meta http-equiv="cleartype" content="on">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="favicon.ico">

  <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Pathway+Gothic+One|PT+Sans+Narrow:400+700|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"> 
  <!-- Fonts END -->

  <!-- Global styles BEGIN -->
  <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="plugins/slider-revolution-slider/rs-plugin/css/settings.css" rel="stylesheet">
  <!-- Global styles END -->
   
  <!-- Page level plugin styles BEGIN -->
  <link href="plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles BEGIN -->
  <link href="css/components.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <link href="css/themes/ngr.css" rel="stylesheet" id="style-color">
  <link href="css/custom.css" rel="stylesheet">

  <!-- Theme styles END -->
  <script src="scripts/jquery-1.11.0.min.js" type="text/javascript"></script>
</head>
<body>
  <!-- Header BEGIN -->
  <div class="header header-mobi-ext header-inner">
    <div class="container">
      <div class="row">
        <!-- Logo BEGIN -->
        <div class="col-md-2 col-sm-2">
          <a class="scroll site-logo" href="http://localhost/ngr/"><img src="img/logo/logo2.png" height="40px" alt="NexGenReady"></a>
        </div>
        <!-- Logo END -->

        <div class="res-menu">
          <a href="javascript:void(0);" class="mobi-toggler">
            <i class="fa fa-bars"></i>
            <span><?php echo _("Menu"); ?></span>
          </a>
        </div>

        <!-- Navigation BEGIN -->
        <div class="col-md-10 pull-right">
          <ul class="header-navigation">
            <li><a href="http://localhost/ngr/welcome"><?php echo _("Home"); ?></a></li>
            <li><a href="http://localhost/ngr/about"><?php echo _("About"); ?></a></li>
            <!--<li><a href="#services">Features</a></li>-->
            <li><a href="http://localhost/ngr/#benefits"><?php echo _("Features"); ?></a></li>
            <li><a href="http://localhost/ngr/modules"><?php echo _("Modules"); ?></a></li>
            <li class="current"><a href="http://localhost/ngr/subscribe"><?php echo _("Subscriptions"); ?></a></li>
            <li><a href="http://localhost/ngr/authors"><?php echo _("Authors"); ?></a></li>
            <li><a href="http://localhost/ngr/contact"><?php echo _("Contact Us"); ?></a></li>
          </ul>
        </div>
        <!-- Navigation END -->
      </div>
    </div>
  </div>
  <!-- Header END -->
  
  <!-- Prices block BEGIN -->
  <div class="prices-block content content-center" id="prices">
    <div class="container">
    <br/><br/><br/>
      <h2 class="margin-bottom-50"><strong><?php echo _("Subscriptions"); ?></strong></h2>
    	
    <div class="title-bg">
       <!--  <img src="img/title-bg.png" /> -->
        <h3><?php echo _("Up to <span class='key'>50</span> modules will be added to the library as they are developed during the school year."); ?></h3>
      </div>
    </div>
  </div>
  <!-- Prices block END -->
  
  <!-- Subscribe block BEGIN -->
  <div class="portfolio-block content content-center" id="subscribe">
    <div class='subscribe-info container'>
      <h4><?php echo _("Fill out the form below to subscribe. An invoice will be sent to your email. If you want to send a purchase order, fill out the form below, and send your purchase order to"); ?> <a href="#">invoice@nexgenready.com</a>.</h4>

		<?php

		if (isset($_POST['submit'])) {

			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$district = $_POST['school'];
			$numTeacher = $_POST['numteachers'];
			$numStudent = $_POST['students'];
			$location = $_POST['location'];
			$email = $_POST['email'];
			$subscription = $_POST['subscription'];
			$notes = $_POST['notes'];
			$agree = $_POST['agree'];
			$name = $fname . ' ' . $lname;
			$totalStudent = $numStudent * $numTeacher;

			$sc 		= new SubscriberController();
			$exists 	= $sc->checkEmailExistsSubscribe($email);

			if($exists != 1) {
			
				if ($subscription == 1) {
					$subscription_option = 1.99;
				} else {
					$subscription_option = 2.99;
				}

				$bill = $numStudent * $subscription_option;

				
				$values = array(
					'fname'       => $fname,
					'lname'		  => $lname,
					'school'      => $district,
					'state'       => $location,
					'email'       => $email,
					'teachers'    => $numTeacher,
					'students'    => $numStudent,
					'subscribe'   => $subscription,
					'notes'       => $notes
				);

				$sid = $sc->addSubscriber($values);

				// $users = generateUsers($name, $district, $numTeacher, $numStudent, $sid);

				//echo $users;

				$pdfdoc = generateUsers($fname, $lname, $district, $numTeacher, $numStudent, $subscription, $sid);

				$attachment = chunk_split(base64_encode($pdfdoc));

				$option = ($subscription == 1) ? 'Option 1 ($1.99/student, 1 year)' : 'Option 2 ($2.99/student, 2 years)';

				$separator = md5(time());

				// // carriage return type (we use a PHP end of line constant)
				$eol = PHP_EOL;

				// // attachment name
				$filename = "UserAccounts.pdf";

				// email stuff (change data below)
				$to = $email;
				$from = "invoice@nexgenready.com"; 
				$subject = 'Your NexGenReady Subscription';

				$headers  = "From: ".'NexGenReady'. '<webmaster@nexgenready.com>' .$eol;
				$headers .= "MIME-Version: 1.0".$eol; 
				$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

				// //Email to Client
				$message = '<html><body>';
				$message .= '<div style="width: 70%; margin: 0 auto;">';
				$message .= '<div style="background: #083B91; padding: 10px 0;">' . '<img src="http://localhost/ngr/img/logo/logo2.png" />';
				$message .= '</div>';
				$message .= '<div style="margin-top: 10px; padding: 15px 0 10px 0;">';
				$message .= '<p>Hi '. $name .'!</p>' . '</br>';
				$message .= '<p style="margin-bottom: 0;">Thank you for subscribing to NexGenReady!</p>'.'<br/>';
				$message .= '<p>We received the following information from you: </p>';
				$message .= '<label>Name: '. $name .'</label>' . '<br/>';
				$message .= '<label>School/Institution Name: '. $district .'</label>' . '<br/>';
				$message .= '<label>Total Number of Teachers : '. $numTeacher .'</label>' . '<br/>';
				$message .= '<label>Total Number of Students : '. $totalStudent .'</label>' . '<br/>';
				$message .= '<label>Town, State: '. $location .'</label>' . '<br/>';
				$message .= '<label>E-mail Address: '. $email .'</label>' . '<br/>';

				// for($i = 1; $i <= $numTeacher; $i++) {
				// 	$t = $i - 1;
				// 	$message .= '<label>Teacher ' . $i . '  : '. $number_of_students[$t] . ' Students' .'</label>' . '<br/>';
				// }

				$message .= '<label>You are subscribing to : ' . $option . '</label>' . '<br/>';
				$message .= '<label>Notes : ' . $notes . '</label>' . '<br/>'; 
				$message .= '<p>An invoice will be sent to you within 24 hours. Attached is the list of teacher and student usernames and passwords that you can now use to access the <a href="http://localhost/ngr/dashboard/">dashboard.</a></p>' . '</br>';
				$message .= '<p>Thank you for choosing NexGenReady. Please feel free to provide any feedback that could help us improve your overall experience. For assistance in using the Dashboard or any other concerns, please email us at <a href="mailto:info@nexgenready.com">info@nexgenready.com</a>.</p>' . '<br/>';
				$message .= '<p>For your reference, you can access our user\'s guide in this link: <a href="http://localhost/ngr/help">User Support</a>.</p>' . '<br/>';
				$message .= '<p style="margin-bottom: 0;">Best Regards,</p>';
				$message .= '<p style="margin: 0;">NexGenReady Team</p>';
				$message .= '</div>';
				$message .= '<div style="background: #272626; color: white; padding: 5px; text-align: center;">';
				$message .= '<p sytle="color: white;">&copy; 2014 Interactive Learning Online, LLC. ALL Rights Reserved. <a style="color: #f79539;" href="http://localhost/ngr/privacy-policy">Privacy Policy</a> | <a style="color: #f79539;" href="http://localhost/ngr/terms-of-service">Terms of Service</a></p>';
				// // $message .= '<p>This website is best viewed in modern browsers such as <a href="https://www.google.com/chrome/browser/">Google Chrome</a> and <a href="https://www.mozilla.org/en-US/">Firefox</a>.</p>';
				$message .= '</div>';
				$message .= '</div>';
				$message .= '<body></html>';

				// // message
				// $messageMail = "--".$separator.$eol;
				// $messageMail .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
				// $messageMail .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
				// $messageMail .= $message.$eol;

				// // attachment
				// $messageMail .= "--".$separator.$eol;
				// $messageMail .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
				// $messageMail .= "Content-Transfer-Encoding: base64".$eol;
				// $messageMail .= "Content-Disposition: attachment".$eol.$eol;
				// $messageMail .= $attachment.$eol;
				// $messageMail .= "--".$separator."--";

				// //Email to invoice@nexgenready.com
				// $to2 = 'invoice@nexgenready.com';
				// $from2 = "invoice@nexgenready.com"; 
				// $subject2 = 'New Subscriber from Website';

				// $headers2  = "From: ".$from2.$eol;
				// $headers2 .= "MIME-Version: 1.0".$eol; 
				// $headers2 .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

				// $message2 = '<html><body>';
				// $message2 .= '<div style="width: 70%; margin: 0 auto;">';
				// $message2 .= '<div style="background: #083B91; padding: 10px 0;">' . '<img src="http://localhost/ngr/img/logo/logo2.png" />' . '</div>';
				// $message2 .= '<p>Hi,</p>' . '</br>';
				// $message2 .= '<p>A new subscriber needs your attention. Please create an invoice for this.</p>';
				// $message2 .= '<p>We received the following information: </p>';
				// $message2 .= '<label>Name: '. $name .'</label>' . '<br/>';
				// $message2 .= '<label>School/Institution Name: '. $school .'</label>' . '<br/>';
				// $message2 .= '<label>School District Enrollment G3-8 (# of student) : '. $students .'</label>' . '<br/>';
				// $message2 .= '<label>Town, State: '. $location .'</label>' . '<br/>';
				// $message2 .= '<label>E-mail Address: '. $email .'</label>' . '<br/>';
				// $message2 .= '<label>No. of teachers : '. $teachers .'</label>' . '<br/>';

				// for($i = 1; $i <= $teachers; $i++) {
				// 	$t = $i - 1;
				// 	$message2 .= '<label>Teacher ' . $i . '  : '. $number_of_students[$t] . ' Students' .'</label>' . '<br/>';
				// }

				// $message2 .= '<label>You are subscribing to : ' . $option . '</label>' . '<br/>'; 
				// $message2 .= '<label>Notes : ' . $notes . '</label>' . '<br/>';
				// $message2 .= '<p>Total Bill: $' . $bill . '</br>';
				// $message2 .= '<p>Thanks,</p>';
				// $message2 .= '<p>NexGenReady Webmaster</p>';
				// $message2 .= '<div style="background: #272626; color: white; padding: 5px; text-align: center;">';
				// $message2 .= '<p sytle="color: white;">&copy; 2014 Interactive Learning Online, LLC. ALL Rights Reserved. <a style="color: #f79539;" href="http://localhost/ngr/privacy-policy">Privacy Policy</a> | <a style="color: #f79539;" href="http://localhost/ngr/terms-of-service">Terms of Service</a></p>';
				// $message2 .= '</div>';
				// $message2 .= '</div>';
				// $message2 .= '<body></html>';

				// // message 2
				// $messageMail2 = "--".$separator.$eol;
				// $messageMail2 .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
				// $messageMail2 .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
				// $messageMail2 .= $message2.$eol;

				// // attachment 2
				// $messageMail2 .= "--".$separator.$eol;
				// $messageMail2 .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
				// $messageMail2 .= "Content-Transfer-Encoding: base64".$eol;
				// $messageMail2 .= "Content-Disposition: attachment".$eol.$eol;
				// $messageMail2 .= $attachment.$eol;
				// $messageMail2 .= "--".$separator."--";

				$mail = @mail("$to", "$subject", "$messageMail", "$headers");
				// $mail2 = @mail("$to2", "$subject2", "$messageMail2", "$headers2");
				// $mail3 = @mail("webmaster@nexgenready.com", "$subject2", "messageMail2", "headers2");

				if ($mail/* && $mail2 && $mail3*/) {
					// die ("<script>location.href = 'http://localhost/ngr/thank-you'</script>");
				}

			} else { ?>
				<script>
            		$(function(){
             			$('#myModal2').modal('show');
            		});
            	</script>
		<?php }
		}	

		?>

		<div class="form-container">
			<form method="post" action="" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="name" class="col-sm-4 control-label"><?php echo _("First Name"); ?></label>

					<div class="col-sm-6">
						<input type="text" class="form-control" id="fname" name="fname" placeholder="<?php echo _('Enter your first name...'); ?>" required>
					</div>
				</div>

				<div class="form-group">
					<label for="name" class="col-sm-4 control-label"><?php echo _("Last Name"); ?></label>

					<div class="col-sm-6">
						<input type="text" class="form-control" id="lname" name="lname" placeholder="<?php echo _('Enter your last name...'); ?>" required>
					</div>
				</div>

				<div class="form-group">
					<label for="school" class="col-sm-4 control-label"><?php echo _("School District Name"); ?></label>

					<div class="col-sm-6">
						<input type="text" class="form-control" id="school" name="school" placeholder="<?php echo _('Enter the school district name...'); ?>" required>
					</div>
				</div>

				<div class="form-group">
					<label for="students" class="col-sm-4 control-label"><?php echo _("School District Enrollment G3-8 (Number of Teachers)"); ?></label>

					<div class="col-sm-6">
						<input type="number" class="form-control" id="teachers" name="numteachers" min="1" placeholder="<?php echo _('Enter the number of teachers...'); ?>" required>
					</div>
				</div>

				<div class="form-group">
					<label for="students" class="col-sm-4 control-label"><?php echo _("School District Enrollment G3-8 (Number of Students)"); ?></label>

					<div class="col-sm-6">
						<input type="number" class="form-control" id="students" name="students" min="1" placeholder="<?php echo _('Enter the number of students...'); ?>" required>
					</div>
				</div>

				<div class="form-group">
					<label for="subToSt" class="col-sm-4 control-label"><?php echo _("Town, State"); ?></label>

					<div class="col-sm-6">
						<input type="text" autocomplete="on" class="form-control" id="subToSt" name="location" placeholder="<?php echo _('Enter your location...'); ?>" required>
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="col-sm-4 control-label"><?php echo _("Contact Email Address"); ?></label>

					<div class="col-sm-6">
						<div class="input-group">
						  <div class="input-group-addon">@</div>
						  <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo _('Enter your email address...'); ?>" required>
						</div>
					</div>
				</div>

				<!-- <div class="form-group">
					<div id="sheepItForm">
					 
					  <div id="sheepItForm_template">
						<label for="teacher_#index#" class="col-sm-4 control-label"><?php echo _("Teacher"); ?> <span id="sheepItForm_label"></span></label>

						<div class="col-sm-6">
							<div class="input-group">
								<input id="teacher_#index#" class="form-control teacher" name="teacher[#index#]" type="number" min="1" placeholder="Please enter how many students for this teacher." required>
								<div class="input-group-addon"><a id="sheepItForm_remove_current"><img class="delete" src="img/cross.png" width="16" height="16" border="0"></a></div>
							</div>
						</div>
					  </div>
					   
					  <div id="sheepItForm_noforms_template"></div>
					   
					</div>
				</div> -->

				<!-- <div class="form-group">
					  <div id="sheepItForm_controls">
						<a id="sheepItForm_add" class="btn btn-default"><span><?php echo _("Add teacher"); ?></span></a>
					  </div>
				</div> -->

				<div class="form-group">
					<label for="subscription" class="col-sm-4 control-label"><?php echo _("Subscription"); ?></label>

					<div class="col-sm-6">
						<select class="form-control" name="subscription" id="subscription" required>
						  <option value="1"><?php echo _("Option 1 ($1.99/student, 1 year)"); ?></option>
						  <option value="2"><?php echo _("Option 2 ($2.99/student, 2 years)"); ?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="notes" class="col-sm-4 control-label"><?php echo _("Notes"); ?></label>

					<div class="col-sm-6">
						<textarea class="form-control" id="notes" name="notes"></textarea>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-5 col-sm-offset-4">
						<div class="checkbox">
							<label for="agree">
							  <input type="checkbox" id="agree" name="agree" required> <?php echo _("I have read and I agree to the Legal Agreement indicated below."); ?>
							</label>
						</div>
					</div>
				</div>

				<div class="form-group"><!--{{{-->
					<div class="col-sm-10 col-sm-offset-1">
						<textarea class="form-control" rows="10" disabled>
<?php echo _("The legal agreement set out below covers your use of the Interactive Learning Online, LLC and the NexGenReady modules, website, products, and services. To agree to these terms, click the agree button. If you do not agree to these terms, do not click the agree button, and do not use the products and services provided by Interactive Learning Online, LLC.\n"); ?>

<?php echo _("You agree that you will pay for all of the products and services you purchased through this website, and that we may charge your payment method for any products purchased for any additional amounts including taxes and late fees that may be accrued by or in connection with your purchase. All sales are final. If technical problems prevent or unreasonably delayed delivery of your product, your exclusive and sole remedy is replacement or refund of the price paid.\n"); ?>

<?php echo _("Your use of the services includes the ability to enter into agreements and/or to make transactions electronically. You acknowledge that your electronic submissions constitute your agreement and intent to be bound by and pay for such agreements and transactions. Your agreement and intent to be bound by electronic submissions applies to all records relating to all transactions you entered into on this site, including notices of cancellation, policies, contracts, and products and services.\n"); ?>

<?php echo _("Interactive Learning Online, LLC is the owner and provider of the NexGenReady Modules and all products, materials and services, logos in this website and provided by this website.\n"); ?>

<?php echo _("NexGenReady materials are intended for individual student use, accessible by user identifications and passwords purchased with subscription. Other uses are strictly prohibited and may result to immediate cancellation of all user identifications and passwords purchased.\n"); ?>

<?php echo _("Every effort has been made by the Interactive Learning Online, LLC to locate each owner of the copyrighted material reprinted and to secure the necessary permissions.  If there are any questions regarding the use of these materials, we will take appropriate corrective measures to acknowledge ownership in future publications. You agree that all products and services provided by Interactive Learning Online, LLC or contained on its website contain proprietary information and material that is owned by us and/or our agents or affiliates and is protected by applicable intellectual property and other laws, including but not limited to copyright. You agree that you will not use such proprietary information or materials in anyway whatsoever except for use of the services in compliance with this agreement. No portion of the modules, web content or any other proprietary information may be reproduced in any form or by any means, except as expressly permitted in these terms. You may not modify, rent, lease, loan, sell, distribute, or create derivative works based on the products and services we own, or disseminate or provide to third parties in any manner. All copyrights in and to the services and related software are owned by Interactive Learning Online, LLC, and/or its agents or affiliates, who reserve all rights in law and equity.\n"); ?>

<?php echo _("If you fail, or if Interactive Learning Online, LLC suspects that you have failed, to comply with any of the provisions of this agreement we, at our sole discretion, without any notice to you may i) terminate this agreement and for your account, and you will remain liable for all amounts due under your account up to and including the date of termination, and/or ii) preclude access to any of the services or products we offer. Interactive Learning Online, LLC reserves the right to modify, suspend, or discontinue any service or product, or any part or content thereof, or to impose new or additional terms or conditions on your use, at any time with or without notice to you, and we will not be liable to you or to any third-party should we exercise that right.\n"); ?>

<?php echo _("Any private information you provide which is obtained by Interactive Learning Online, LLC shall not be disseminated to third parties in any manner."); ?>
<?php echo _("This agreement constitutes the entire agreement between you and Interactive Learning Online, LLC and governs your use of our products, services and website. If any part of this agreement is held invalid or unenforceable, that portion shall be construed in a manner consistent with applicable law to reflect, as nearly as possible, the original intentions of the parties, and the remaining portion shall remain in full force and effect.\n"); ?>
						</textarea>
					</div>
				</div><!--}}}-->

				<button type="submit" id="submit" name="submit" class="btn btn-primary"><?php echo _("Submit"); ?></button>
			</form>
		</div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><!--{{{-->
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo _("Close"); ?></span></button>
				<h4 class="modal-title" id="myModalLabel"><?php echo _("Error"); ?></h4>
			  </div>
			  <div class="modal-body">
				<?php echo _("The total number of students under teachers should be equal to the number of students entered in the input field labeled as School District Enrollment G3-8 (Number of Students)."); ?>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo _("Try Again"); ?></button>
			  </div>
			</div>
		  </div>
		</div><!--}}}-->

		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><!--{{{-->
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo _("Close"); ?></span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo _("Error"); ?></h4>
            </div>
            <div class="modal-body">
            <?php echo _("Sorry, the email address you have entered is already registered."); ?>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo _("Try Again"); ?></button>
            </div>
          </div>
        </div>
      </div><!--}}}-->
		<div class="row">
        <!-- Pricing item BEGIN -->
        <div class="col-sm-6 col-xs-12">
          <div class="pricing-item">
            <div class="pricing-head">
              <h3><?php echo _("Option 1"); ?></h3>
              <!--<p></p>-->
            </div>
            <div class="pricing-content">
              <div class="pi-price">
                <strong><?php echo _("$<em>1.99</em>"); ?></strong>
                <p><?php echo _("Per Student"); ?></p>
              </div>
            <ul class="list-unstyled">
        <li><!-- <i class="fa fa-circle"></i> --> <?php echo _("One-year subscription"); ?></li>
        <li><!-- <i class="fa fa-circle"></i> --> <?php echo _("Library of 30+ modules"); ?></li>
        <li><!-- <i class="fa fa-circle"></i> --> <?php echo _("Minimum order required"); ?></li>
            </ul>
            </div>
            <div class="pricing-footer">
              <a class="btn btn-default scroll" href="#subscribe"><?php echo _("Subscribe Now!"); ?></a>
            </div>
          </div>
        </div>
        <!-- Pricing item END -->
        <!-- Pricing item BEGIN -->
        <div class="col-sm-6 col-xs-12">
          <div class="pricing-item">
            <div class="pricing-head">
              <h3><?php echo _("Option 2"); ?></h3>
              <!--<p></p>-->
            </div>
            <div class="pricing-content">
              <div class="pi-price">
                <strong><?php echo _("$<em>2.99</em>"); ?></strong>
                <p><?php echo _("Per Student"); ?></p>
              </div>
            <ul class="list-unstyled">
        <li><!-- <i class="fa fa-circle"></i> --> <?php echo _("Two-year subscription"); ?></li>
        <li><!-- <i class="fa fa-circle"></i> --> <?php echo _("Library of 30+ modules"); ?></li>
        <li><!-- <i class="fa fa-circle"></i> --> <?php echo _("Minimum order required"); ?></li>
            </ul>
            </div>
            <div class="pricing-footer">
              <a class="btn btn-default scroll" href="#subscribe"><?php echo _("Subscribe Now!"); ?></a>
            </div>
          </div>
        </div>
        <!-- Pricing item END -->
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>

  <a href="#prices" class="go2top scroll"><i class="fa fa-arrow-up"></i></a>

  <script src="scripts/jquery.sheepItPlugin-1.1.1.min.js"></script>

  <script>

	// var sheepItForm = $('#sheepItForm').sheepIt({
	// 	separator: '',
	// 	allowRemoveLast: true,
	// 	allowRemoveCurrent: true,
	// 	allowAdd: true,
	// 	allowAddN: true,
	// 	maxFormsCount: 100,
	// 	minFormsCount: 1,
	// 	iniFormsCount: 1
	// });

	$('#submit').click(function() {

		// var students = Number($('#students').val()),
		// 	number_of_students = 0;
		
		// $('input.teacher').each(function() {
		// 	number_of_students += Number($(this).val());
		// });

		// if (students == number_of_students) {
		// 	return true;
		// } else {
		// 	$('#myModal').modal('show');

		// 	return false;
		// }

	});

  </script>
