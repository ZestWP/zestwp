<?php


class Crm
{
	
	private $_pluginName = _PLUGIN_NAME;
	private $_shortName = _SHORT_NAME;
	private $model;
	private $msg = '';
	private $error = '';
	
	public function __construct() 
	{
		require_once(__ZEST_PATH."/models/crmModel.php");
		$this->model = new Crm_Model();
    }
	public function leads(){
		if(isset($_GET['id'])){
			if(isset($_GET['action']) && $_GET['action'] == 'delete'){
				$del = $this->model->deleteCrm($_GET['id']);
				
				if(!$del) $this->error = "Delete error";
				else $this->msg = "User Deleted";
				
				$this->allRecord();
			}
			else $this->viewCrm();
		}
		else if(isset($_POST['multidelete'])){
			$del = $this->model->multiDelete($_POST);
			
			if(!$del) $this->error = "Delete error";
			else $this->msg = "Users Deleted";
		
			$this->allRecord();
		}
		else if(isset($_POST['convert'])){
			$this->convertUser();
		}
		else {
			$this->allRecord();
		}
	}
	
	protected function viewCrm(){
		$desc = '';
		$ID = $id = $_GET['id'];
		$crm = $this->model->getCrm($id);
		if(sizeof($crm)>0) {
			$s = $crm->properties['source'];
			parse_str($s);
			$source = $this->model->getSource($type, $id);
		}
		
		
		require(__ZEST_PATH.'/views/view-leads.php');
	}

	protected function allRecord(){
		$_GET['p'] = $_GET['p'] ? $_GET['p'] : 1;
		$_REQUEST['s'] = $_REQUEST['s'] ? $_REQUEST['s'] : "";
		
		$msg = $this->msg;
		$error = $this->error;
		
		$crms = $this->model->listCrm();
		$count = $this->model->listCount();
		
		$pages = ceil($count/20);
		$pager = new Pager('admin.php?page='.$_GET['page'].'&s='.$_GET['s']);
		
		require(__ZEST_PATH.'/views/crm-leads.php');
	}
	
	
	protected function convertUser(){
		$edit = $this->model->convertUser($_POST);
		if(!$edit) $this->error = "Updated as user error";
		else $this->msg = "Updated as user";
		$this->allRecord();
	}
	
	
	public function users(){
		if(isset($_POST['id'])){
			$this->postUser();
		}
		else if(isset($_POST['multidelete'])){
			$del = $this->model->multiDelete($_POST);
			
			if(!$del) $this->error = "Delete error";
			else $this->msg = "Users Deleted";
		
			$this->allUser();
		}
		else if(isset($_GET['id'])){
			if(isset($_GET['action']) && $_GET['action'] == 'delete'){
				$del = $this->model->deleteUser($_GET['id']);
				
				if(!$del) $this->error = "Delete error";
				else $this->msg = "User Deleted";
				
				$this->allUser();
			}
			else $this->editUser();
		}
		else if(isset($_REQUEST['import'])){
			if(isset($_GET['import'])){
				$this->importUsers();
			}
			else if(isset($_POST['import'])){
				$this->model->importUsers();
				$this->allUser();
			}
		}
		else if(isset($_REQUEST['export'])){
			$this->model->exportUsers();
			$this->allUser();
		}
		else {
			$this->allUser();
		}
	}
	
	protected function editUser(){
		$desc = '';
		$id = $_GET['id'];
		$user = $this->model->getUser($id);
		
		wp_enqueue_style('datepicker', zest_url().'assets/ui.min.css');
		wp_enqueue_script('datepicker', zest_url().'assets/ui.min.js');
		
		require(__ZEST_PATH.'/views/edit-users.php');
	}

	protected function allUser(){
		$_GET['p'] = $_GET['p'] ? $_GET['p'] : 1;
		$_REQUEST['s'] = $_REQUEST['s'] ? $_REQUEST['s'] : "";
		
		$msg = $this->msg;
		$error = $this->error;
		
		$users = $this->model->listUser();
		$count = $this->model->listCountUser();
		
		$pages = ceil($count/20);
		$pager = new Pager('admin.php?page='.$_GET['page'].'&s='.$_GET['s']);
		
		require(__ZEST_PATH.'/views/users.php');
	}
	
	protected function postUser(){
		$edit = $this->model->insertUser($_POST);
		if(!$edit) $this->error = "Update error";
		else $this->msg = "User updated";
		$this->allUser();
	}

	protected function importUsers(){
		wp_enqueue_script('lightbox', zest_url().'assets/lightbox.js');
		require(__ZEST_PATH.'/views/import-users.php');
	}
}