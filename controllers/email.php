<?php
require_once(__ZEST_PATH."/models/emailModel.php");

class Email
{
	
	private $_pluginName = _PLUGIN_NAME;
	private $_shortName = _SHORT_NAME;
	private $model;
	private $msg = '';
	private $error = '';
	
	public function __construct() 
	{
		require_once(__ZEST_PATH."/models/egroupModel.php");
		$this->model = new Email_Model();
    }
    
	public function email(){
		if(isset($_POST['test_mail'])){
			$this->testMail();
		}
		else if(isset($_POST['preview'])){
			$this->toPreview();
		}
		else if(isset($_POST['id'])){
			$this->postEmail();
		}
		else if(isset($_POST['multidelete'])){
			$del = $this->model->multiDelete($_POST);
			
			if(!$del) $this->error = "Delete error";
			else $this->msg = "Emails Deleted";
		
			$this->allRecord();
		}
		else if(isset($_GET['id'])){
			if(isset($_GET['action']) && $_GET['action'] == 'delete'){
				$del = $this->model->deleteEmail($_GET['id']);
				
				if(!$del) $this->error = "Delete error";
				else $this->msg = "Email Deleted";
				
				$this->allRecord();
			}
			else $this->editEmail();
		}
		else {
			$this->allRecord();
		}
	}
	
	protected function editEmail(){
		$desc = '';
		$id = $_GET['id'];
		$email = $this->model->getEmail($id);
		
		$msg = $this->msg;
		$error = $this->error;
		
		require(__ZEST_PATH.'/views/edit-email.php');
	}

	protected function allRecord(){
		$_GET['p'] = $_GET['p'] ? $_GET['p'] : 1;
		$_REQUEST['s'] = $_REQUEST['s'] ? $_REQUEST['s'] : "";
		
		$msg = $this->msg;
		$error = $this->error;
		
		$emails = $this->model->listEmail();
		$count = $this->model->listCount();
		
		$pages = ceil($count/20);
		$pager = new Pager('admin.php?page='.$_GET['page'].'&s='.$_GET['s']);
		
		require(__ZEST_PATH.'/views/emails.php');
	}
	
	protected function postEmail(){
		$edit = $this->model->insertEmail($_POST);
		if(!$edit) $this->error = "Update error";
		else $this->msg = "Email updated";
		$this->allRecord();
	}
	
	
	protected function toPreview(){
		$edit = $this->model->toPreview($_POST);
		$nonce = wp_create_nonce('mailer');
		wp_redirect(home_url()."?mailer=true&id={$edit}&nonce={$nonce}",301);
		exit;
	}
	
	protected function testMail(){
		$this->model->insertEmail($_POST);
		$this->model->triggerEmail($_POST);
		$this->msg = "Test mail sent";
		$_GET['id'] = $_POST['id'] ? $_POST['id'] : 0;
		$this->editEmail();
	}
	
	public function preview_page()
	{
		$mail = $_GET['mailer'] ? $_GET['mailer'] : false;
		if($mail && $_GET['id'] > 0){
			
			$email = $this->model->getEmail($_GET['id']);
			if(sizeof($email)>0){
				require(__ZEST_PATH.'/views/email_preview.php');
				exit;
			}
			
		}
	}
	public function landing_page()
	{
		$page = array();
		if( (isset($_GET['post_type']) && $_GET['post_type'] == _MENU_LANDINGPAGE_MENU) || 
			isset($_GET[_MENU_LANDINGPAGE_MENU])){
			$p = $_GET['p'] ? $_GET['p'] : 0;
			if( $p > 0){
				$page = get_post( $p);
			}
			else if($_GET[_MENU_LANDINGPAGE_MENU] != '' ){
				$page = get_page_by_path($_GET[_MENU_LANDINGPAGE_MENU],OBJECT,_MENU_LANDINGPAGE_MENU);
			}
		}
		if(sizeof($page)>0){
			setup_postdata( $page ); 
			require(__ZEST_PATH.'/views/landing_page.php');
			exit;
		}
	}
}