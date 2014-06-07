<?php

class ZestMail
{
	
	private $_pluginName = _PLUGIN_NAME;
	private $_shortName = _SHORT_NAME;
	private $model;
	private $msg = '';
	private $error = '';
	
	public function __construct() 
	{
		require_once(__ZEST_PATH."/models/mailerModel.php");
		$this->model = new Mailer_Model();
    }
   
	public function email(){
		$logs = array();
		if(isset($_POST['send'])){
			$logs = $this->model->triggerEmail($_POST);
		}
		
		$this->email_send($logs);
		
	}
	
	protected function email_send($logs = array()){
		
		$lists = $this->model->getList(_TABLE_EGROUP);
		require_once(__ZEST_PATH."/views/sendmail.php");
	}
	
	public function smtp(){
		if(isset($_POST['save'])){
			$yes = $this->model->saveSMTP($_POST);
			if(!$yes) $error = "Update error";
			else $msg = "Updated successfully";
		}
		$smtp = $this->model->getSmtp();
		
		require_once(__ZEST_PATH."/views/smtp.php");
	}
}