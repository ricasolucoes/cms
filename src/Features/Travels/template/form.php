<?php 
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {
    
    // require a name from user
    if(trim($_POST['contactname']) === '') {
        $nameError =  'Forgot your name!'; 
        $hasError = true;
    } else {
        $name = trim($_POST['contactname']);
    }
    
    // need valid email
    if(trim($_POST['email']) === '') {
        $emailError = 'Forgot to enter in your e-mail address.';
        $hasError = true;
    } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
        $emailError = 'You entered an invalid email address.';
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }
    
    // require a submit from subject
    if(trim($_POST['lastname']) === '') {
        $lastnameError =  'Forgot your subject!'; 
        $hasError = true;
    } else {
        $lastname = trim($_POST['lastname']);
    }
    
    // require a submit from subject
    if(trim($_POST['subjectb']) === '') {
        $subjectbError =  'Forgot your subject!'; 
        $hasError = true;
    } else {
        $subjectb = trim($_POST['subjectb']);
    }
    
    
    // we need at least some content
    if(trim($_POST['comments']) === '') {
        $commentError = 'You forgot to enter a message!';
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
        } else {
            $comments = trim($_POST['comments']);
        }
    }
    
        
    // upon no failure errors let's email now!
    if(!isset($hasError)) {
        
        $emailTo = 'support@psdslicer.com';
        $name = ' '.$name;
        $sendCopy = trim($_POST['sendCopy']);
        $body = "First Name: $name \n\nLast Name: $lastname \n\nEmail: $email \n\nSubject: $subjectb \n\nComments: $comments";
        $headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

        mail($emailTo, $name, $body, $headers);
        
        // set our boolean completion value to TRUE
        $emailSent = true;
    }
}
?>
