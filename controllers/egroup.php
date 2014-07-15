<?php

class Egroup
{
	
	private $_pluginName = _PLUGIN_NAME;
	private $_shortName = _SHORT_NAME;
	private $model;
	private $msg = '';
	private $error = '';
	private $title = _MENU_EMAIL_GROUP_TITLE;
	
	public function __construct() 
	{
		require_once(__ZEST_PATH."/models/egroupModel.php");
		$this->model = new Egroup_Model();
    }
    
	public function group(){
		if(isset($_POST['id'])){
			$this->postGroup();
		}
		else if(isset($_POST['multidelete'])){
			$del = $this->model->multiDelete($_POST);
			
			if(!$del) $this->error = "Delete error";
			else $this->msg = "List Deleted";
		
			$this->allRecord();
		}
		else if(isset($_GET['id'])){
			if(isset($_GET['action']) && $_GET['action'] == 'delete'){
				$del = $this->model->deleteGroup($_GET['id']);
				
				if(!$del) $this->error = "Delete error";
				else $this->msg = "List Deleted";
				
				$this->allRecord();
			}
			else $this->editGroup();
		}
		else {
			$this->allRecord();
		}
	}
	
	protected function editGroup(){
		$desc = '';
		$id = $_GET['id'];
		$group = $this->model->getGroup($id);
		
		wp_enqueue_script('lightbox', zest_url().'assets/lightbox.js');
		
		require(__ZEST_PATH.'/views/edit-email-group.php');
	}

	protected function allRecord(){
		$_GET['p'] = $_GET['p'] ? $_GET['p'] : 1;
		$_REQUEST['s'] = $_REQUEST['s'] ? $_REQUEST['s'] : "";
		
		$msg = $this->msg;
		$error = $this->error;
		
		$groups = $this->model->listGroup();
		$count = $this->model->listCount();
		
		$pages = ceil($count/20);
		$pager = new Pager('admin.php?page='.$_GET['page'].'&s='.$_GET['s']);
		
		require(__ZEST_PATH.'/views/email-groups.php');
	}
	
	protected function postGroup(){
		$edit = $this->model->insertGroup($_POST);
		if(!$edit) $this->error = "Update error";
		else $this->msg = "List updated";
		$this->allRecord();
	}
}