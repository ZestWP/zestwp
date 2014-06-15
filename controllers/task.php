<?php


class Task
{
	
	private $_pluginName = _PLUGIN_NAME;
	private $_shortName = _SHORT_NAME;
	private $model;
	private $msg = '';
	private $error = '';
	
	public function __construct() 
	{
		require_once(__ZEST_PATH."/models/taskModel.php");
		$this->model = new Task_Model();
    }
	
	public function tasks(){
		if(isset($_POST['id'])){
			$this->postTask();
		}
		else if(isset($_GET['id'])){
			if(isset($_GET['action']) && $_GET['action'] == 'delete'){
				$del = $this->model->deleteTask($_GET['id']);
				
				if(!$del) $this->error = "Delete error";
				else $this->msg = "Task Deleted";
				
				$this->view();
			}
			else $this->editTask();
		}
		else $this->view();
		
	}
	
	protected function view(){
		$m  = $_GET['m'] ? $_GET['m'] : date('m') ;
		$y  = $_GET['y'] ? $_GET['y'] : date('Y') ;
		
		$tasks = $this->model->getTasks();
			
		$unixmonth = mktime(0, 0 , 0, $m, 1, $y);
		$daysinmonth = intval(date('t', $unixmonth));
		$start_day =  calendar_week_mod(date('w', mktime(0, 0 , 0, $m, 1, $y)));
		$next_month = strtotime( '+1 month', $unixmonth );
		$prev_month = strtotime( '-1 month', $unixmonth );
			
			
		wp_enqueue_script('lightbox', zest_url().'assets/lightbox.js');
		wp_enqueue_style('datepicker', zest_url().'assets/ui.min.css');
		wp_enqueue_script('datepicker', zest_url().'assets/ui.min.js');
		
		require(__ZEST_PATH.'/views/tasks.php');
	
	}
	
	protected function editTask(){
		$desc = '';
		$id = $_GET['id'];
		$task = $this->model->getTask($id);
		
		wp_enqueue_style('datepicker', zest_url().'assets/ui.min.css');
		wp_enqueue_script('datepicker', zest_url().'assets/ui.min.js');
		
		require(__ZEST_PATH.'/views/edit-tasks.php');
	}
	
	protected function postTask(){
		$edit = $this->model->insertTask($_POST);
		if(!$edit) $this->error = "Update error";
		else $this->msg = "Campaign updated";
		$this->view();
	}
}