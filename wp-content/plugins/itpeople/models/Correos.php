<?php
	
	/**
	* Maneja los correos
	*/
	class Correos
	{
		
		public 	$to,
				$subject,
				$message,
				$headers,
				$attachments
		;

		function __construct($from = null, $to = null, $subject = null, $attachments = null)
		{

			$from = $from ? 'From: '. $from . "\r\n" : 'From: '. get_option('admin_email') . "\r\n";

			$this->to          = $to;
			$this->subject     = $subject;
			// $this->message     = $message;
			$this->headers     = array($from, 'Content-Type: text/html; charset=UTF-8');
			$this->attachments = $attachments;
		}

		public function get_template($template, $variables=array(), $return = false)
		{
			if ($return) {
				ob_start();
			}
			extract($variables);
			include_once (plugin_dir_path( __FILE__ ).'../views/emails/'.$template.'.php');
			if ($return) {
				$resp = ob_get_contents();
				ob_end_clean();
				return $resp;
			}
		}

		public function send($body, $titulo)
		{
			$emailBody = self::get_template('email-header', array('email_heading' => $titulo), true);
			$emailBody.= $body;
			$emailBody.= self::get_template('email-footer', array(), true);
			wp_mail($this->to,$this->subject,$emailBody,$this->headers,$this->attachments);
		}
	}

?>