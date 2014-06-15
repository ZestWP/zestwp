<?php

class Mailer_Model extends dbZest
{
	private $name;
	private $smtp;
	private $secret_key;
	private $secret_iv;
	private $encrypt_method;
	
	public function __construct() 
	{
		$this->name = _TABLE_CAMPAIGN;
		$this->smtp = _TABLE_SMTP;
		$this->secret_key = '58zaeik';
		$this->secret_iv = '58zaeikt';
		$this->encrypt_method = 'AES-256-CBC';
		parent::__construct();
    }

	public function getList($tableName){
		$list = $this->allRecord($tableName);
		return $list;
	}
	
	public function triggerEmail($post){
			
		$type = $post['sendmail'];
		
		if($type == 'smtp'){
			require_once(__ZEST_PATH."/core/class.phpmailer.php");
			require_once(__ZEST_PATH."/core/class.smtp.php");
		}
		
		$list = $this->getById($post['list']);
		$email = $this->getById($post['email']);
		$campaign = $this->getById($post['campaign']);
		$subject = $email->properties['subject'];
		$content = $email->properties['content'];
		$signature = nl2br($email->properties['signature']);

		$data = array(_TABLE_CAMPAIGN =>$campaign->id, _TABLE_EMAIL =>$email->id, 'type' =>$type);
		

		$toSendList = $post['emailList'][$post['list']];
		if($type == 'sendmail' && sizeof($toSendList)>10) $toSendList = array_slice($toSendList, 0, 10);
		
		$list = array_intersect_key($list->properties['email'], $toSendList);
		
		foreach($toSendList as $k=>$v){
			$mailer = array('a' =>$campaign->id, 'b' =>$email->id, 'c'=>$k);
			$body = $this->contentClean($content, $list[$k], $signature, $mailer);
			
			$return = ($type == 'smtp') ? $this->emailSend($subject, $body, $k, $v) : $this->emailSendMail($subject, $body, $k, $v);
			$data[$k][] = array('mailId'=> $k, 'mailInfo' => $return);
			if($return == 1) { $logs['success'][$k] = 1; $data['count']++;}
			else { $logs['error'][$k]=$return; $data['fail']++;}
			
		}
		
		$this->insert(_TABLE_MAIL_LOG, $data, 0);
			
		return $logs;
	}
	
	public function contentClean($content = '', $list = array(), $signature = '', $mailer = array()){
		$content = str_replace(array('&nbsp;'), array(''), $content);
		$content = nl2br($content);
		
		if(sizeof($list)>0){
		$content = str_replace(array('{FNAME}', '{LNAME}', '{SIGNATURE}'), array($list['fname'], $list['lname'], $signature), $content);
		$oth = array('d'=>$list['fname'], 'e'=>$list['lname']);
		if(sizeof($list['custom'])>0)
		foreach($list['custom'] as $k=>$v){
			$oth[$k] = $v;
			$content = preg_replace( "/{{$k}}/", $v, $content);
		}
		}
		
		if($mailer && $oth){
			$enc = json_encode(array_merge($mailer, $oth));
			$track = $link = $this->encrypt($enc);
			$id = $mailer['b'];
			$email = $this->getById($id);
			if($email->properties[_TABLE_PAGE_FORM]) $form = $this->getById($email->properties[_TABLE_PAGE_FORM]);
			else $form = $mailer->getByName(_TABLE_FORM_DEFAULT);
			$campaign = $email->properties[_TABLE_CAMPAIGN];
			$source = "type=email&id=".$id;
		}
		
		$content = preg_replace( '/{[^}]+}/', '', $content);
		
		$static = $this->getStatic();
		$logo = $static->properties['img'];
		unset($static);
		
		ob_start();        
		include(__ZEST_PATH."/views/email_template.php");
		$body = ob_get_contents();
        ob_end_clean();
		
		return $body;
	
	}
	
	public function emailSend($subject='', $body='', $to, $toName = ''){
		
		$smtp = $this->getSmtp()->properties;
		
		$fromAddress = ($_POST['fromAddress'] != '' ) ? $_POST['fromAddress'] : $smtp['fromAddress'];
		$fromName = ($_POST['fromName'] != '' ) ? $_POST['fromName'] : $smtp['fromName'];
		$replyToAddress = ($_POST['replyToAddress'] != '' ) ? $_POST['replyToAddress'] : $smtp['replyToAddress'];
		$replyToName = ($_POST['replyToName'] != '' ) ? $_POST['replyToName'] : $smtp['replyToName'];
		try{
		
		ob_start();  
		$mail = new PHPMailer(); 
		$mail->IsSMTP(); 
		$mail->SMTPDebug = 1; 
		$mail->SMTPAuth = true; 
		$mail->SMTPSecure =$smtp['secure']; 
		$mail->Host = $smtp['host'];
		$mail->Port = $smtp['port'];
		$mail->IsHTML(true);
		$mail->Username =  $smtp['username'];
		$mail->Password = $smtp['password'];
		$mail->SetFrom($fromAddress, $fromName);
		if(!empty($replyToAddress)) $mail->AddReplyTo($replyToAddress, $replyToName); 
		$mail->Subject = $subject;
		
		
		$mail->Body = $body;
		$mail->AddAddress($to, $toName);

		$send = $mail->Send();
		ob_end_clean();
		
		if(!$send){
			return $mail->ErrorInfo;
		}
		else{
			return 1;
		}
		}catch(Exception $e){
			print_r($e);exit;
		}
		
	}
	
	protected function emailSendMail($subject='', $body='', $to, $toName = ''){
		
		$smtp = $this->getSmtp()->properties;
		
		$fromAddress = ($_POST['fromAddress'] != '' ) ? $_POST['fromAddress'] : $smtp['fromAddress'];
		$fromName = ($_POST['fromName'] != '' ) ? $_POST['fromName'] : $smtp['fromName'];
		
		$headers[] = "From: {$fromName} <{$fromAddress}>";

		$mail = wp_mail( $toName."<{$to}>", $subject, $body, $headers );
		
		if (!$mail) {
			global $ts_mail_errors;
			global $phpmailer;
			if (!isset($ts_mail_errors)) $ts_mail_errors = array();
			if (isset($phpmailer)) {
				$error = $phpmailer->ErrorInfo;
			}
			
			return $error;
		}
		
		return 1;
	}
	
	public function getSmtp(){
		//$table = _TABLE_SMTP;
		$row =  $this->allRecord($this->smtp);	
		if(isset($row[0]->properties)) $row[0]->properties = unserialize($row[0]->properties);
		
		return $row[0];
	}
	
	public function saveSMTP($post){
		if(isset($post['id']) && $post['id']>0){
			return $this->update($this->name, $post, $post['id']);
		}
		else return $this->insert($this->smtp, $post);
		
	}

	public function encrypt($string) {
		$output = false;

		$key = hash('sha256', $this->secret_key);
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $this->secret_iv), 0, 16);

		$output = openssl_encrypt($string, $this->encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);

		return $output;
	}
	
	public function decrypt($string) {
		$output = false;
		// hash
		$key = hash('sha256', $this->secret_key);
		
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $this->secret_iv), 0, 16);
		
		$output = openssl_decrypt(base64_decode($string), $this->encrypt_method, $key, 0, $iv);

		return $output;
	}
	
	public function getStatic(){
		$table = _TABLE_STATIC;
		$row =  $this->allRecord($table);
		if(isset($row[0]->properties)) $row[0]->properties = unserialize($row[0]->properties);
		
		return $row[0];
	}
	
	public function getByName($name = ''){
		if($name == '') return;
		$row =  $this->allRecord($name);
		if(isset($row[0]->properties)) $row[0]->properties = unserialize($row[0]->properties);
		
		return $row[0];
	}
}