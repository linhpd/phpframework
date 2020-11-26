<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of email
 *
 * @author Inspiron 7559
 */
class Email {

    //put your code here
    public static function sendCode($vkey, $email) {
        $to = $email;
        $body = 'Thank you for joining us your code :' . $vkey .
                ' ' . 'Now You Can Go <a href="http://localhost:8080/phpframework/users/confirm/' . $vkey . '">Confirm Now</a>';
        $subject = 'confirm';
        
        mail($to, $subject, $body);
    }

}
