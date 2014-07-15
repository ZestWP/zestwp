<?php
require_once(__ZEST_PATH."/models/emailModel.php");

class Email
{
	
	private $_pluginName = _PLUGIN_NAME;
	private $_shortName = _SHORT_NAME;
	private $model;
	private $msg = '';
	private $error = '';
	private $title = _MENU_EMAIL_TITLE;
	
	public function __construct() 
	{
		require_once(__ZEST_PATH."/models/egroupModel.php");
		$this->model = new Email_Model();
    }
    
	public function  dashboard(){
		
		$emails = $this->model->getEmails();
		
		$Home = new Home_Model();
		$mails = $Home->sentMails();
		$rate = $Home->OpenMails();

		require(__ZEST_PATH.'/views/email-dashboard.php');
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
		$forms = $this->model->getAllForm($id);
		
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
		wp_redirect(home_url()."?mailer=true&id={$edit}&nonce={$nonce}&preview=true",301);
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
		$mailer = new Mailer_Model();
		$mail = $_GET['mailer'] ? $_GET['mailer'] : false;
		if($mail && $_GET['id'] > 0){
			if(isset($_GET['q'])){
				$q = $_GET['q'];
				$array = (array)json_decode($mailer->decrypt($q));
			}
			$email = $this->model->getEmail($_GET['id']);
			if(sizeof($email)>0){
				if(sizeof($array)>0){
					$this->model->track($array, 'browser');
					$content = $email->properties['content'];
					$content = str_replace(array('&nbsp;'), array(''), $content);
					$content = nl2br($content);
					
					$content = str_replace(array('{FNAME}', '{LNAME}'), array($array['d'], $array['e']), $content);
					unset($array['a']);unset($array['b']);unset($array['c']);unset($array['d']);unset($array['e']);
					foreach($array as $k=>$v){
						$content = preg_replace( "/{{$k}}/", $v, $content);
						
					}
					$content = preg_replace( '/{[^}]+}/', '', $content);
				}else{
					$content = $email->properties['content'];
					$content = str_replace(array('&nbsp;'), array(''), $content);
					$content = nl2br($content);
					if($email->properties[_TABLE_PAGE_FORM]) $form = $this->model->getEmail($email->properties[_TABLE_PAGE_FORM]);
					else $form = $mailer->getByName(_TABLE_FORM_DEFAULT);
				}
				
				$static = $mailer->getStatic();
				$logo = $static->properties['img'];
				unset($static);
				
				$template = $email->properties['template'] ? $email->properties['template'] : 'default';
				
				require(__ZEST_PATH."/theme/email/{$template}.php");
				exit;
			}
			
		}return;
	}
	public function landing_page()
	{   $page = array();
		if( (isset($_GET['post_type']) && $_GET['post_type'] == _MENU_LANDINGPAGE_MENU) || 
			isset($_GET[_MENU_LANDINGPAGE_MENU])){
			$p = $_GET['p'] ? $_GET['p'] : 0;
			if( $p > 0){
				$page = get_post( $p);
			}
			else if($_GET[_MENU_LANDINGPAGE_MENU] != '' ){
				$page = get_page_by_path($_GET[_MENU_LANDINGPAGE_MENU],OBJECT,_MENU_LANDINGPAGE_MENU);
			}
			
			if(!$_GET['preview']){
				$this->model->pageTrack();
			}
			
		}
		if(sizeof($page)>0){
			setup_postdata( $page ); 
			$meta = get_post_meta( $page->ID, _TABLE_PAGE_FORM );
			$campaigns = get_post_meta( $page->ID, _TABLE_PAGE_CAMPAIGN );
			$sel = $meta[0][_TABLE_PAGE_FORM] ? $meta[0][_TABLE_PAGE_FORM] : array();
			$mailer = new Mailer_Model();
			if($sel) $form = $this->model->getEmail($sel);
			else $form = $mailer->getByName(_TABLE_FORM_DEFAULT);
			
			$source = "type=page&id=".$page->ID;
			
			
			$static = $this->model->getStatic();
			$pageType = get_post_meta( $page->ID, _TABLE_PAGE_TYPE );
			if(isset($pageType[0][_TABLE_PAGE_TYPE]) && $pageType[0][_TABLE_PAGE_TYPE] == 'lead')
				require(__ZEST_PATH.'/views/track-landing.php');
			else
				require(__ZEST_PATH.'/views/landing_page.php');
			exit;
		}return;
	}
	
	public function logo()
	{   
	
		if (isset($_GET['logo']) && $_GET['logo']){
			$mailer = new Mailer_Model();
			$static = $mailer->getStatic();
			$logo = $static->properties['img'];
			unset($static);
			
			$logo = base64_decode($logo);

			$im = imagecreatefromstring($logo);
			header('Content-Type: image/png');
			imagepng($im);
			
			exit;
		}
		return;
	}
	
	public function track()
	{   
	
		if (isset($_GET['track']) && $_GET['track']){
			
			if(isset($_GET['q'])){
				$mailer = new Mailer_Model();
				$q = $_GET['q'];
				$array = (array)json_decode($mailer->decrypt($q));
				$this->model->track($array, 'email');
			}
			
			$im = imagecreatetruecolor(1, 1);

			imagefilledrectangle($im, 0, 0, 99, 99, 0xFFF);
			header('Content-Type: image/gif');

			imagegif($im);
			imagedestroy($im);
			
		}
		return;
	}
}