<?php
class PHP_Email_Form
{
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $message;
    public $headers;
    public $smtp;

    public function add_message($message, $field_name = '', $size = 0)
    {
        if ($size != 0) {
            $message = substr($message, 0, $size);
        }
        $this->message .= strlen($field_name) ? $field_name . ": $message\n" : $message . "\n";
    }

    public function send()
    {
        $this->headers = "From: $this->from_name <$this->from_email>\r\n";
        $this->headers .= "Reply-To: $this->from_email\r\n";

        if (isset($this->smtp)) {
            $this->headers .= "MIME-Version: 1.0\r\n";
            $this->headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $this->headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
        }

        return mail($this->to, $this->subject, $this->message, $this->headers);
    }
}
?>
