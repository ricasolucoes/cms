<?php 
//error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

require_once 'recaptchalib.php';
require_once 'mandrill.php';

$privatekey = "6LfrDv8SAAAAACJyR2jSSqwnpyKoQ4o0FiY4yy5S";
/*$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["g-recaptcha-response"]
                                //$_POST["recaptcha_response_field"]
                                );
*/
$full_url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $privatekey . '&response=' . $_POST["g-recaptcha-response"] . '&remoteip=' . $_SERVER["REMOTE_ADDR"] . '';
$resp = json_decode(file_get_contents($full_url));
print_r($resp);
                                
//$mandrill = new Mandrill('f2FiFWnE5L_Ze0GkE3EZKQ');

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
        $lastnameError =  'Forgot your last name!'; 
        $hasError = true;
    } else {
        $lastname = trim($_POST['lastname']);
    }
    
    // require a submit from subject
    if(trim($_POST['viagem']) === '') {
        $viagemError =  'Forgot your trip!'; 
        $hasError = true;
    } else {
        $viagem = trim($_POST['viagem']);
    }
    
    //pessoas
    if(trim($_POST['pessoas']) === '') {
        $pessoasError =  'Forgot to say how many of you!'; 
        $hasError = true;
    } else {
        $pessoas = trim($_POST['pessoas']);
    }
    
    //CEP
    $cep = trim($_POST['cep']);
    $comments = trim($_POST['comments']);
    
    
    
    
    // we need at least some content
    // if(trim($_POST['comments']) === '') {
    //     $commentError = 'You forgot to enter a message!';
    //     $hasError = true;
    // } else {
    //     if(function_exists('stripslashes')) {
    //         $comments = stripslashes(trim($_POST['comments']));
    //     } else {
    //         $comments = trim($_POST['comments']);
    //     }
    // }
    
        
    // upon no failure errors let's email now!
    if(!isset($hasError)) {
        if(isset($resp->success) && $resp->success == true) {
            // Your code here to handle a successful verification
          
            $emailTo = 'info@snowevo.com';
            $nameTo = 'Snow Evolution';
            $name = ' '.$name;
            //$sendCopy = trim($_POST['sendCopy']);
            $body = "First Name: $name \n\nLast Name: $lastname \n\nEmail: $email \n\nViagem: $viagem \n\nPessoas: $pessoas \n\nCEP: $cep \n\nComments: $comments";
            //$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

            $full_name = ' '.$name . ' ' . $lastname;

            sendReservation($email, $full_name, $emailTo, $nameTo, $viagem, $body);
            //mail($emailTo, $name, $body, $headers);
            
            // set our boolean completion value to TRUE
            $emailSent = true; 
        }
        else {
            /*
            If $resp->is_valid is false then the user failed to provide the correct captcha text and you should redisplay the form to allow them another attempt. In this case $resp->error will be an error code that can be provided to recaptcha_get_html. Passing the error code makes the reCAPTCHA control display a message explaining that the user entered the text incorrectly and should try again.
            Notice that this code is asking for the private key, which should not be confused with the public key. You get that from the same page as the public key.
            */
            // What happens when the CAPTCHA was entered incorrectly
            die(
                "The reCAPTCHA wasn't entered correctly. Go back and try it again." .
                "(reCAPTCHA said: " . $resp->error . ")"
            );
        } 
    }
}
?>
