<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Nuclearmail  {
	
	protected $message='';
	protected $stmp='';
	protected $port=465;
	protected $secure='ssl';
	protected $user='';
	protected $pass='';
	protected $from='';
	protected $from_name='';
	protected $to='';
	protected $subject='';
	protected $attach=array();
	
	public function __construct () {
		$this->ci =& get_instance();
		$this->ci->config->load('project');
		$this->stmp        = $this->ci->config->item('email_smtp');
		$this->port        = $this->ci->config->item('email_port');
		$this->secure      = $this->ci->config->item('email_secure');
		$this->user        = $this->ci->config->item('email_user');
		$this->pass        = $this->ci->config->item('email_pass');
		$this->from        = $this->ci->config->item('email_from');
		$this->from_name   = $this->ci->config->item('email_fromname');
		$this->to          = $this->ci->config->item('email_to');
		$this->subject     = $this->ci->config->item('email_subject');
	}
	
	public function set_subject($txt='') {
		$this->subject=$txt;
	}
	
	
	public function set_to($txt='') {
		$this->to=$txt;
	}
	
	public function set_msg($txt='') {
			$this->message=$txt;
	}
	public function add_file($path, $file,$type='image/jpg')
	{
		$this->attach[$path]['file']=$file;
		$this->attach[$path]['type']=$type;

	}
	public function change_subject($sub='')
	{
		$this->subject=$sub;
	}
	
	public function send() {
		 
		require FCPATH.'third_party/PHPMailer/PHPMailerAutoload.php';
		$message=$this->message;
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPDebug   = 0;
		$mail->Debugoutput = 'html';
		$mail->Host        = $this->stmp;
		$mail->Port        = $this->port;
		$mail->SMTPSecure  = $this->secure;
		$mail->SMTPAuth    = true;
		$mail->Username = $this->user;
		$mail->Password = $this->pass;
		$mail->setFrom($this->from, $this->from_name);
		$mail->addAddress($this->to);
		$mail->Subject = $this->subject;
		$mail->CharSet = 'UTF-8';
		$mail->Body = str_replace("\n","<br/>",$this->message);
		$mail->AltBody = $this->message;
		$mail->IsHTML(true);
		//Attach an image file
		if(count($this->attach)>0)
		{
			foreach($this->attach as $key=>$val)
			{

				
				$mail->addAttachment($key,$val['file'],'base64',$val['type']);
			}
		}
		//
		//$mail->addAttachment(APPPATH.'images/anexo1.png');
		//$mail->addAttachment(APPPATH.'images/anexo2.png');
		//send the message, check for errors
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "<script>alert('Obrigado pelo seu contacto')</script>";
		}
	}
}
