<?php

class VH2Zeya4eve_Emails {
    private $html = '';

    public function sendMail($toEmail, $subject, $html = '') : bool
    {
        if(empty($html) && empty($this->html)) {
            return false;
        }

        if(empty($this->html)) {
            $this->html = $html;
        }

        $header  = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset: utf8\r\n";

        return wp_mail($toEmail, $subject, $this->html, $header);
    }

    public function setHtmlByTemplate ($templateName, $data = []) : void
    {
        ob_start();
        require_once VH2ZEYA4EVE_DIR_PATH . 'emails/'.$templateName.'.php';
        $html = ob_get_contents();
        ob_get_clean();
        $this->html = $html;
    }

    public function sendEmailAboutNewInvitationCode($claim_reason, $lovestar_count, $invitation_code, $email) : bool
    {
        $this->setHtmlByTemplate('email_after_completed_order', [
            'lovestar_reason' => $claim_reason, // __('buy', VH2ZEYA4EVE_TEXTDOMAIN) . ' antimask certificate'
            'lovestar_count' => $lovestar_count, // 3
            'invitation_code' => $invitation_code, // SWQ-SAQ-SFA
        ]);
        return $this->sendMail($email, __('You got the Lovestars!', VH2ZEYA4EVE_TEXTDOMAIN));
    }
}