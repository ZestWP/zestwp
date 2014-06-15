<?php

class Form
{
	
	private $_pluginName = _PLUGIN_NAME;
	private $_shortName = _SHORT_NAME;
	private $model;
	private $msg = '';
	private $error = '';
	
	public function __construct() 
	{
		require_once(__ZEST_PATH."/models/formModel.php");
		$this->model = new Form_Model();
    }

	public function  dashboard(){
		
		$forms = $this->model->getForms();
		$default = $this->model->defaultForm();
		
		require(__ZEST_PATH.'/views/form-dashboard.php');
    }
	
	public function setup(){
		if(isset($_POST['id'])){
			$this->postform();
		}
		else if(isset($_POST['multidelete'])){
			$del = $this->model->multiDelete($_POST);
			
			if(!$del) $this->error = "Delete error";
			else $this->msg = "forms Deleted";
		
			$this->allRecord();
		}
		else if(isset($_GET['id'])){
			if(isset($_GET['action']) && $_GET['action'] == 'delete'){
				$del = $this->model->deleteform($_GET['id']);
				
				if(!$del) $this->error = "Delete error";
				else $this->msg = "form Deleted";
				
				$this->allRecord();
			}
			else $this->editform();
		}
		else {
			$this->allRecord();
		}
	}
	
	protected function editForm(){
		$desc = '';
		$id = $_GET['id'];
		$form = $this->model->getForm($id);
		
		wp_enqueue_style('datepicker', zest_url().'assets/ui.min.css');
		wp_enqueue_script('datepicker', zest_url().'assets/ui.min.js');

		require(__ZEST_PATH.'/views/edit-form.php');
	}

	protected function allRecord(){
		$_GET['p'] = $_GET['p'] ? $_GET['p'] : 1;
		$_REQUEST['s'] = $_REQUEST['s'] ? $_REQUEST['s'] : "";
		
		$msg = $this->msg;
		$error = $this->error;
		
		$forms = $this->model->listForm();
		$count = $this->model->listCount();
		$default = $this->model->defaultForm();
		$forms = array_merge($default, $forms);
		
		$pages = ceil($count/20);
		$pager = new Pager('admin.php?page='.$_GET['page'].'&s='.$_GET['s']);
		
		require(__ZEST_PATH.'/views/forms.php');
	}
	
	protected function postForm(){
		$edit = $this->model->insertForm($_POST);
		if(!$edit) $this->error = "Update error";
		else $this->msg = "Form updated";
		$this->allRecord();
	}

	public function staticAdmin(){
		if(isset($_POST['save'])){
			$yes = $this->model->saveStatic($_POST, 'scripts');
			if(!$yes) $error = "Update error";
			else $msg = "Updated successfully";
		}
		$static = $this->model->getStatic();
		
		require_once(__ZEST_PATH."/views/static.php");
	}
	
	public function google(){
		if(isset($_POST['save'])){
			$yes = $this->model->saveStatic($_POST, 'google');
			if(!$yes) $error = "Update error";
			else $msg = "Updated successfully";
		}
		$static = $this->model->getStatic();
		
		require_once(__ZEST_PATH."/views/google.php");
	}
}