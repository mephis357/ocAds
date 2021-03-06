<?php if ( ! defined('APP_DIR')) exit('Your request not allowed!');

/**
 * PHPMailer Helper
 */
if ( !function_exists('mailSend'))
{
    /**
     * 
     * @param array $from
     * @param array $to
     * @param array $replyTo Default is NULL
     * @param string $subject
     * @param string $body
     * @return boolean
     */
    function mailSend($from, $to, $replyTo = NULL, $subject = NULL, $body = NULL)
    {
        require_once APP_DIR.'/libs/PHPMailer/PHPMailerAutoload.php';
        
        $mail = new PHPMailer;
        
        $mail->From = $from['email'];
        $mail->FromName = $from['name'];
        $mail->addAddress($to);
        
        $addresses = explode(',', $to);
        foreach ($addresses as $address)
        {
            $mail->addAddress($address);
        }
        
        if ($replyTo)
        {
            $mail->addReplyTo($replyTo['email'], $replyTo['name']);
        }
        
        $mail->WordWrap = 50;
        $mail->isHTML(FALSE);
        
        if ($subject)
        {
            $mail->Subject = $subject;
        }
        
        if ($body)
        {
            $mail->Body = $body;
        }
        
        if ($mail->send())
        {
           return TRUE;
        }
        
        return FALSE;
    }
}