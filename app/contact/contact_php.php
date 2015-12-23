<?php
require_once "$_SERVER[DOCUMENT_ROOT]/vendor/autoload.php";
require_once "$_SERVER[DOCUMENT_ROOT]/app/config/Mail.php";
require_once "$_SERVER[DOCUMENT_ROOT]/app/functions/sanitise.php";

 // IF JS is disabled - backup php
    if ($_POST) {
        
        $name = clean_input('name');
        $email = clean_input('email');
        $message = clean_input('message');

        $errors = "";
        $response['send_failed'] = $response['send_success'] = "";


        // Name
        if (empty($name)){
            $errors['name'] = 'Name field is required';
        }
        else if (strlen($name) < 2) {
            $errors['name'] = "A name must have 2 or more characters";
        }
        else if(strlen($name) > 50) {
            $errors['name'] = "A name must have 50 or less characters";
        }

        // Email
        if (empty($email)){
            $errors['email'] = 'Email field is required';
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = "A valid email address is required";
        }

        // Message
        if (empty($message)){
            $errors['message'] = 'Message field is required';
        }
        else if (strlen($message) < 10)
        {
            $errors['message'] = "A message must have 10 or more characters";
        }
        else if (strlen($message) > 500)
        {
            $errors['message'] = "A message must have 500 or less characters";
        }

        // Validate Failed
        if(empty($errors)){
            // Send Mail
            $mail->IsHTML(true);
            $mail->CharSet = "text/html; charset=UTF-8;";

            $mail->From = 'testing1234op@gmail.com';
            $mail->FromName = null; // Change to 'NAME';
            $mail->addAddress('testing1234op@gmail.com'); // To
     
            $mail->Subject = 'Contact Us';
            $mail->Body = "Name: ".$name."<br>"."Email: ".$email."<br>"."Message: ".$message; // HTML
            $mail->AltBody = "Name: ".$name."\r\n"."Email: ".$email."\r\n"."Message: ".$message; // PLAIN TEXT

            if(!$mail->send()) {
                // Failed Message
                echo $response['failed'] = "Failed to send message. Please try again";
            } 
            else 
            {
                // Success Message
                echo $response['success'] = "Thank you for contacting us! We will get back to you shortly.";
            } 
        }
    }
?>