<?php

class Email_Model extends dbZest
{
	private $name;
	
	public function __construct() 
	{
		$this->name = _TABLE_EMAIL;
		parent::__construct();
    }
	public function insertEmail($post){
		if(isset($post['title']) ){
			$data['title'] = $post['title'];
			$data['subject'] = $post['subject'];
			$data['content'] = $post['content'];
			$data['campaign'] = $post['campaign'];
			$data['signature'] = $post['signature'];
			$data['template'] = $post['template'];
			$data['form-page'] = $post['form-page'];
			
			if(isset($post['id']) && $post['id']>0){
				return $this->update($this->name, $data, $post['id']);
			}
			else return $this->insert($this->name, $data);
		}
		else return false;
	}
	
	public function listEmail(){
		$pageCount = $_GET['p'] ? $_GET['p'] : 1;
		$s= $_REQUEST['s'] ? $_REQUEST['s'] : "";
		$list = $this->all($this->name, $pageCount, $s);
		return $list;
	}
	
	public function listCount(){
		
		$count = $this->recordCount($this->name);
		return $count;
	}
	
	public function getEmail($id = 0){
		$row = $this->getById($id);
		return $row;
	}
	
	public function deleteEmail($id = 0){
		return $this->delete($id);
	}
	
	public function multiDelete($post){
		if( (sizeof($post)>0) && sizeof($post['delete_list'])>0 ){
			foreach($post['delete_list'] as $id){
				$this->delete($id);
			}
			return true;
		}
		
		else return false;
		
	}
	
	public function toPreview($post){
		if(isset($post['title']) ){
			$data['title'] = $post['title'];
			$data['subject'] = $post['subject'];
			$data['content'] = $post['content'];
			$data['campaign'] = $post['campaign'];
			$data['form-page'] = $post['form-page'];
			$data['template'] = $post['template'];
			
			return $this->insert(_TABLE_EMAIL_PREVIEW, $data);
		}
		else return false;
	}
	
	public function triggerEmail($post){
			
		require_once(__ZEST_PATH."/core/class.phpmailer.php");
		require_once(__ZEST_PATH."/core/class.smtp.php");
		$this->MailerModel = new Mailer_Model();
		
		$email = $this->getById($post['id']);
		$subject = $email->properties['subject'];
		$content = $email->properties['content'];
		$body = $this->MailerModel->contentClean($content);
		
		$postMail = explode("\n",$post['testMail']);
		if(sizeof($postMail)>0){
			$postMail = array_slice($postMail, 0, 10);
		foreach($postMail as $k=>$v){
			$return = $this->MailerModel->emailSend($subject, $body, $v, 'Test Mail');
		}
		}
	}
	
	public function track($details = array(), $source = ''){
		if(sizeof($details)>0){
			$data['campaign'] = $details['a'];
			$data['email'] = $details['b'];
			$data['mailId'] = $details['c'];
			$data['name'] = $details['d'].' '.$details['e'];
			$data['source'] = $source;
			
			$table = _TABLE_MAIL_TRACK;
			return $this->insert($table, $data);
		}
	}
	public function pageTrack(){
			$data = $_SERVER;
			$table = _TABLE_PAGE_TRACK;
			return $this->insert($table, $data);
	}
	
	public function getAllForm(){
		return array_merge($this->allRecord(_TABLE_FORM_DEFAULT), $this->allRecord(_TABLE_FORM));
	}
	
	public function getEmails(){
		return $this->allRecord($this->name);
	}
	
	
	public function getStatic(){
		$row =  $this->allRecord(_TABLE_STATIC);
		if(isset($row[0]->properties))
			$row[0]->properties = unserialize($row[0]->properties);
		if(!empty($row[0]))
		return $row[0];
	}
}