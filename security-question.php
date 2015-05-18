<?php
    include_once('controller/User.Controller.php'); 
    include_once('controller/Subscriber.Controller.php');
    include_once('controller/Security.Controller.php');
    include_once('php/auto-generate.php');

    $uc = new UserController();
    $sc = new SubscriberController();
    $sec = new SecurityController();
    $questions = $sec->getAllQuestions();
//check email
    if(isset($_POST['email'])){
        $email = $_POST['email'];

        $exists = $sc->checkEmailExistsSubscribe($email);

        if($exists){    
            $sid = $sc->getIdByEmail($email);
            $uid = $sc->getUserIdbySubId($sid[0]['id']);
            $secid = $sec->getSecurityRecord($uid[0]["user_ID"]);
            
            if (isset($secid[0]['question_id']))
            {
                foreach ($questions as $question) {
                    if($secid[0]['question_id'] == $question['question_id']) 
                        $sQuestion = $question["question"]; 
                }
                $data['success'] = true;
                $data['message'] = $sQuestion;
                $data['id'] = $uid[0]["user_ID"];
                $data['email'] = $email;
            } else {
                $data['success'] = false;
                $data['message'] = 'Sorry, no security question found.';
            }

        } else { 
            $data['success'] = false;
            $data['message'] = 'Sorry, the email you have entered is not registered.';
        } 
    }

//check student or teacher
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $type = $_POST['type'];
        if($type=="teacher") {
            $exists = $uc->checkNameExistsTeacher($username, 0);
        } else {
            $exists = $uc->checkNameExistsStudent($username, 2);
        }

        if($exists){

            $uid = $uc->getUserByUsername($username);
            $secid = $sec->getSecurityRecord($uid[0]["user_ID"]);
            
            if (isset($secid[0]['question_id']))
            {
                foreach ($questions as $question) {
                    if($secid[0]['question_id'] == $question['question_id']) 
                        $sQuestion = $question["question"]; 
                }
                $data['success'] = true;
                $data['message'] = $sQuestion;
                $data['id'] = $uid[0]["user_ID"];
            } else {
                $data['success'] = false;
                $data['message'] = 'Sorry, no security question found.';
            }

        } else { 
            $data['success'] = false;
            $data['message'] = 'Sorry, the username that you have entered is not registered.';
        } 
    }

//security check for username
    if(isset($_POST['sqAnswer'])){
        $userAnswer = $_POST['sqAnswer'];
        $uid = $_POST['id'];
        $secid = $sec->getSecurityRecord($uid);
        $secAnswer = $secid[0]['answer'];
      
        if($userAnswer == $secAnswer){
            $new_pass = generatePassword();
            $uc->updateUserPassword($uid, $new_pass); 

            $data['success'] = true;
            $data['message'] = "Your new password is: ".$new_pass;
        } else {
            $data['success'] = false;
            $data['message'] = "Sorry, your answer is incorrect.";
        }
    }

//security check for email
    if(isset($_POST['esqAnswer'])){
        $email = $_POST['email2'];
        $userAnswer = $_POST['esqAnswer'];
        $uid = $_POST['eid'];
        $secid = $sec->getSecurityRecord($uid);
        $secAnswer = $secid[0]['answer'];
      
        if($userAnswer == $secAnswer){

            // $sid = $sc->getIdByEmail($email);
            // $userid = $sid[0]['id'];
            $new_pass = generatePassword();
            $uc->updateUserPassword($uid, $new_pass); 

            $to         = $email;
            $from       = 'nexgen@nexgenready.com';
            $subject    = 'Your New Password (NexGenReady)';

            $message = '<html><body>';
            $message .= '<div style="width: 70%; margin: 0 auto;">';
            $message .= '<div style="background: #083B91; padding: 10px 0;">' . '<img src="http://nexgenready.com/img/logo/logo2.png" />';
            $message .= '</div>';
            $message .= '<div style="margin-top: 10px; padding: 15px 0 10px 0;">';
            $message .= '<p>Hi '. $email .'!</p>' . '</br>';
            $message .= '<p>Your New Password is: '. $new_pass .'</p>';
            $message .= '<p style="margin-bottom: 0;">Best Regards,</p>';
            $message .= '<p style="margin: 0;">NexGenReady Team</p>';
            $message .= '</div>';
            $message .= '<div style="background: #272626; color: white; padding: 5px; text-align: center;">';
            $message .= '<p sytle="color: white;">&copy; 2014 Interactive Learning Online, LLC. ALL Rights Reserved. <a style="color: #f79539;" href="http://nexgenready.com/privacy-policy">Privacy Policy</a> | <a style="color: #f79539;" href="http://nexgenready.com/terms-of-service">Terms of Service</a></p>';
            $message .= '</div>';
            $message .= '</div>';
            $message .= '<body></html>';

            // To send HTML mail, the Content-type header must be set
            $headers = "From: ".'NexGenReady'. '<webmaster@nexgenready.com>'. "\r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            $mail = @mail($to, $subject, $message, $headers);

            $data['success'] = true;
            $data['message'] = "Your new password has been sent to your email ".$email.".";

        } else {
            $data['success'] = false;
            $data['message'] = "Sorry, your answer is incorrect.";
        }
    }

    echo json_encode($data);
?>