<?php


class Campaign
{
	
	private $_pluginName = _PLUGIN_NAME;
	private $_shortName = _SHORT_NAME;
	private $model;
	private $msg = '';
	private $error = '';
	
	public function __construct() 
	{
		require_once(__ZEST_PATH."/models/campaignModel.php");
		$this->model = new Campaign_Model();
    }
	public function  dashboard(){
		
		$campaigns = $this->model->getCampaigns();
		
		require(__ZEST_PATH.'/views/campaign-dashboard.php');
    }
    public function  getAllCampaign(){
		return $this->model->getCampaigns();
    }
	public function campaign(){
		if(isset($_POST['id'])){
			$this->postCampaign();
		}
		else if(isset($_POST['multidelete'])){
			$del = $this->model->multiDelete($_POST);
			
			if(!$del) $this->error = "Delete error";
			else $this->msg = "Campaigns Deleted";
		
			$this->allRecord();
		}
		else if(isset($_GET['id'])){
			if(isset($_GET['action']) && $_GET['action'] == 'delete'){
				$del = $this->model->deleteCampaign($_GET['id']);
				
				if(!$del) $this->error = "Delete error";
				else $this->msg = "Campaign Deleted";
				
				$this->allRecord();
			}
			else $this->editCampaign();
		}
		else {
			$this->allRecord();
		}
	}
	
	protected function editCampaign(){
		$desc = '';
		$id = $_GET['id'];
		$campaign = $this->model->getCampaign($id);
		
		if($id > 0){
			$emails = $this->model->getEmails($id);
			$posts = $this->model->getPosts($id);
		
		}
		
		wp_enqueue_style('datepicker', zest_url().'assets/ui.min.css');
		wp_enqueue_script('datepicker', zest_url().'assets/ui.min.js');
		
		require(__ZEST_PATH.'/views/edit-campaigns.php');
	}

	protected function allRecord(){
		$_GET['p'] = $_GET['p'] ? $_GET['p'] : 1;
		$_REQUEST['s'] = $_REQUEST['s'] ? $_REQUEST['s'] : "";
		
		$msg = $this->msg;
		$error = $this->error;
		
		$campaigns = $this->model->listCampaign();
		$count = $this->model->listCount();
		
		$pages = ceil($count/20);
		$pager = new Pager('admin.php?page='.$_GET['page'].'&s='.$_GET['s']);
		
		require(__ZEST_PATH.'/views/campaigns.php');
	}
	
	protected function postCampaign(){
		$edit = $this->model->insertCampaign($_POST);
		if(!$edit) $this->error = "Update error";
		else $this->msg = "Campaign updated";
		$this->allRecord();
	}
	
	public function addMetaBox($post_type)
    {
        if (isset($post_type) && $post_type == _MENU_LANDINGPAGE_MENU)
        {
            add_meta_box( 
                'campaign-assignment',
                __( 'Assign to Campaign' ),
                array($this, 'displayMeta'),
                $post_type,
                'side',
                'core'
            );
			
			add_meta_box('form-assignment', __( 'Assign Form' ), array($this, 'formData'), $post_type, 'side', 'core');
			add_meta_box('page-assignment', __( 'Assign Landing page' ), array($this, 'pageData'), $post_type, 'side', 'core');
        }
    }
	
	
	public function displayMeta($data)
    {
        global $post;
        $campaigns = $this->getAllCampaign();
        $post_type = get_post_type();
        $id = isset($post) ? $post->ID : $_REQUEST['id'];
        $meta = get_post_meta( $id, _TABLE_PAGE_CAMPAIGN );
		$sel = $meta[0]['campaign'] ? $meta[0]['campaign'] : array();
		
        require(__ZEST_PATH.'/views/assign-campaign.php');
    }
	
	public function formData($data)
    {
        global $post;
        $forms = $this->model->getAllForm();
        $post_type = get_post_type();
        $id = isset($post) ? $post->ID : $_REQUEST['id'];
        $meta = get_post_meta( $id, _TABLE_PAGE_FORM );
		$sel = $meta[0][_TABLE_PAGE_FORM] ? $meta[0][_TABLE_PAGE_FORM] : array();
		
        require(__ZEST_PATH.'/views/assign-form.php');
    }
	
	public function pageData($data)
    {
        global $post;
        $forms = $this->model->getAllForm();
        $post_type = get_post_type();
        $id = isset($post) ? $post->ID : $_REQUEST['id'];
        $meta = get_post_meta( $id, _TABLE_PAGE_TYPE );
		$sel = $meta[0][_TABLE_PAGE_TYPE] ? $meta[0][_TABLE_PAGE_TYPE] : array();
		
        require(__ZEST_PATH.'/views/assign-page.php');
    }
	
	public function saveCampaign(){
		if(isset($_POST['campaigns'])){
			$this->model->pageCampaign($_POST['campaigns'], $_POST['object_id']);
		}
		if(isset($_POST['form-page'])){
			$this->model->formPage($_POST['form-page'], $_POST['object_id']);
		}
		if(isset($_POST[_TABLE_PAGE_TYPE])){
			$this->model->pageType($_POST[_TABLE_PAGE_TYPE], $_POST['object_id']);
		}
	}
	
	public function lead(){
		if(isset($_GET['lead']) && $_GET['lead']){
			$this->model->storeLead($_REQUEST);
			header("Location: ".site_url());
			exit;
		}
	}
}