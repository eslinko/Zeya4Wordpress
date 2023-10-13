<?php

class VH2Zeya4eve_Emails {

    static function sendMail($toEmail, $subject, $html) : bool
    {
        $headers = [];
//        $headers = 'From: ' . self::$email_settings['eventify_me_email_from_name'] . ' <' . self::$email_settings['eventify_me_email_from_address'] . '>' . "\r\n" .
//            'Content-Type: text/html';
//        $html = self::changeAlignClassesToStylesInImage($html);
        return wp_mail($toEmail, $subject, $html);
    }

    static function sendEmailAfterOrderComplete($orderData) : bool
    {
//        $html = apply_filters('replaceEmailTemplateVarsWithData', self::$email_settings['eventify_me_email_to_user_text'], $bookingData, true);
//        $subject = apply_filters('replaceEmailTemplateVarsWithData', self::$email_settings['eventify_me_email_to_user_subject'], $bookingData, false);
//        return self::sendMail($bookingData['email'], $subject, $html);
        return true;
    }
}