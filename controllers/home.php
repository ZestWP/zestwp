<?php
require_once(__ZEST_PATH."/models/homeModel.php");
class Home
{
	
	private $_pluginName = _PLUGIN_NAME;
	private $_shortName = _SHORT_NAME;
	private $model;
	
	public function __construct() 
	{
		$this->model = new Home_Model();
    }
    
	public function dashboard()
	{
		$visitors = $this->model->getVisitors();
		$mails = $this->model->sentMails();
		$rate = $this->model->OpenMails();
		$leads = $this->model->getLeads();
		$tasks = $this->model->getTasks();
		//echo '<pre>';print_r($tasks);exit;
		wp_enqueue_script('highcharts', zest_url().'assets/highcharts.js');
		wp_enqueue_script('chart_data', zest_url().'assets/chart_data.js');
		wp_enqueue_script('jContent', zest_url().'assets/jcontent.js');
		wp_enqueue_script('mambo', zest_url().'assets/mambo.js');
		wp_enqueue_script('easing', zest_url().'assets/easing.js');
		wp_enqueue_style('jcontent', zest_url().'assets/jcontent.css');
		
		
		
		require(__ZEST_PATH.'/views/dashboard.php');
	}

}