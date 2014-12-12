<?php
/**
 * Email class file.
 * 
 * @author Jonah Turnquist <poppitypop@gmail.com>
 * @link http://php-thoughts.cubedwater.com/
 * @version 1.0
 */
class Email extends CApplicationComponent {
	/**
	 * @var string Type of email.  Options include "text/html" and "text/plain"
	 */
	public $type = 'text/html';
	/**
	 * @var string Receiver, or receivers of the mail.
	 */
	public $to = null;
	
	/**
	 * @var string Email subject
	 */
	public $subject = '';
	
	/**
	 * @var string from address
	 */
	public $from = null;
	
	/**
	 * @var string Reply-to address
	 */
	public $replyTo = null;
	
	/**
	 * @var string Return-path address
	 */
	public $returnPath = null;
	
	/**
	 * @var string Carbon Copy
	 *
	 * List of email's that should receive a copy of the email.
	 * The Recipient WILL be able to see this list
	 */
	public $cc = null;

	/**
	 * @var string Blind Carbon Copy
	 *
	 * List of email's that should receive a copy of the email.
	 * The Recipient WILL NOT be able to see this list
	 */
	public $bcc = null;
	
	/**
	 * @var string Main content
	 */
	public $message = '';
	
	/**
	 * @var string Delivery type.  If set to 'php' it will use php's mail() function, and if set to 'debug'
	 * it will not actually send it but output it to the screen
	 */
	public $delivery = 'php';
	
	/**
	 * @var string language to encode the message in (eg "Japanese", "ja", "English", "en" and "uni" (UTF-8))
	 */
	public $language= 'uni';
	
	/**
	 * @var string the content-type of the email
	 */
	public $contentType= 'utf-8';
	
	/**
	 * @var string The view to use as the content of the email, as an alternative to setting $this->message.
	 * Must be located in application.views.email directory.  This email object is availiable within the view
	 * through $email, thus letting you define things such as the subject within the view (helps maintain 
	 * seperation of logic and output).
	 */
	public $view = null;
	
	/**
	 * @var array Variable to be sent to the view.
	 */
	public $viewVars = null;	
	
	/**
	 * @var string The layout for the view to be imbedded in. Must be located in
	 * application.views.email.layouts directory.  Not required even if you are using a view
	 */
	public $layout = null;
	
	/**
	 * @var integer line length of email as per RFC2822 Section 2.1.1
	 */
	public $lineLength = 70;
	
	public function __construct() {
		Yii::setPathOfAlias('email', dirname(__FILE__).'/views');
	}
	
	/**
	 * Sends email.
	 * @param mixed the content of the email, or variables to be sent to the view.
	 * If not set, it will use $this->message instead for the content of the email
	 */
	public function send($arg1=null) {
		if ($this->view !== null) {
			if ($arg1 == null)
				$vars = $this->viewVars;
			else
				$vars = $arg1;
			
			$view = Yii::app()->controller->renderPartial('application.views.email.'.$this->view, array_merge($vars, array('email'=>$this)), true);
			if ($this->layout === null) {
				$message = $view;
			} else {
				$message = Yii::app()->controller->renderPartial('application.views.email.layouts.'.$this->layout, array('content'=>$view), true);
			}
		} else {
			if ($arg1 === null) {
				$message = $this->message;
			} else {
				$message = $arg1;
			}
		}

		//process 'to' attribute
		$to = $this->processAddresses($this->to);
		return $this->mail($to, $this->subject, $message);
	}
	
	private function mail($to, $subject, $message) {
		switch ($this->delivery) {
			case 'php':
				$message = wordwrap($message, $this->lineLength);
				mb_language($this->language);
				return mb_send_mail($to, $subject, $message, implode("\r\n", $this->createHeaders()));
			case 'debug':
				$debug = Yii::app()->controller->renderPartial('email.debug',
						array_merge(compact('to', 'subject', 'message'), array('headers'=>$this->createHeaders())),
						true);
				Yii::app()->user->setFlash('email', $debug);
				break;
		}
	}
	private function createHeaders() {
		$headers = array();
		
		//maps class variable names to header names
		$map = array(
			'from' => 'From',
			'cc' => 'Cc',
			'bcc' => 'Bcc',
			'replyTo' => 'Reply-To',
			'returnPath' => 'Return-Path',
		);
		foreach ($map as $key => $value) {
			if (isset($this->$key))
				$headers[] = "$value: {$this->processAddresses($this->$key)}";
		}
		$headers[] = "Content-Type: {$this->type}; charset=".$this->contentType;
		$headers[] = "MIME-Version: 1.0";
		
		return $headers;
	}
	private function processAddresses($addresses) {
		return (is_array($addresses)) ? implode(', ', $addresses) : $addresses;
	}
}