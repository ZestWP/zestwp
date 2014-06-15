<?php

class Campaign_Model extends dbZest
{
	private $name;
	private $pageCampaign;
	
	public function __construct() 
	{
		$this->name = _TABLE_CAMPAIGN;
		$this->pageCampaign = _TABLE_PAGE_CAMPAIGN;
		parent::__construct();
    }
	public function insertCampaign($post){
		if(isset($post['name']) && isset($post['description']) ){
			$data['name'] = $post['name'];
			$data['description'] = $post['description'];
			$data['startDate'] = strtotime($post['startDate']);
			$data['endDate'] = strtotime($post['endDate']);
			if(isset($post['id']) && $post['id']>0){
				return $this->update($this->name, $data, $post['id']);
			}
			else return $this->insert($this->name, $data);
		}
		else return false;
	}
	
	public function listCampaign(){
		$pageCount = $_GET['p'] ? $_GET['p'] : 1;
		$s= $_REQUEST['s'] ? $_REQUEST['s'] : "";
		$list = $this->all($this->name, $pageCount, $s);
		return $list;
	}
	
	public function listCount(){
		
		$count = $this->recordCount($this->name);
		return $count;
	}
	
	public function getCampaign($id = 0){
		$row = $this->getById($id);
		return $row;
	}
	
	public function deleteCampaign($id = 0){
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
	
	public function getCampaigns(){
		return $this->allRecord($this->name);
	}
	
	public function pageCampaign($post, $object_id){
		if(sizeof($post)>0){
			$data['campaign'] = $post;
			delete_post_meta( $object_id, $this->pageCampaign );
			add_post_meta( $object_id, $this->pageCampaign, $data );
		}
	}
	
	public function formPage($post, $object_id){
		if(sizeof($post)>0){
			$data[_TABLE_PAGE_FORM] = $post;
			delete_post_meta( $object_id, _TABLE_PAGE_FORM);
			add_post_meta( $object_id, _TABLE_PAGE_FORM, $data );
		}
	}
	public function pageType($post, $object_id){
		if(sizeof($post)>0){
			$data[_TABLE_PAGE_TYPE] = $post;
			delete_post_meta( $object_id, _TABLE_PAGE_TYPE);
			add_post_meta( $object_id, _TABLE_PAGE_TYPE, $data );
		}
	}
	public function getAllForm(){
		return array_merge($this->allRecord(_TABLE_FORM_DEFAULT), $this->allRecord(_TABLE_FORM));
	}
	
	public function storeLead($details = array()){
		return $this->insert(_TABLE_LEAD, $details);
	}
	
	public function getEmails($id = 0){
		$cmp = _TABLE_CAMPAIGN;
		$table = _TABLE_EMAIL;
		$ser = serialize($cmp).serialize((string)$id);
		$s = ($ser !="") ? " AND properties LIKE '%{$ser}%' " : "";;
		$sql = "SELECT id, properties FROM TABLE_NAME WHERE `name`='{$table}' {$s} ";
		$ret =  $this->execQuery($sql);
		$m = array();
		if(sizeof($ret))
			foreach($ret as $rs){
				$p = unserialize($rs->properties);
				$m[$rs->id] = $p['title'];
			}
			
		return $m;
	}
	
	public function getPosts($id = 0){
		global $wpdb;
		$page = _TABLE_PAGE_CAMPAIGN;
		$metaSer = serialize((string) $id);
		$per = $this->execQuery( 
				"SELECT post_id as pid
					FROM {$wpdb->postmeta}
					WHERE `meta_key` = '{$page}' && `meta_value` LIKE '%{$metaSer}%'
				"
			);
		$m = array();
		if(sizeof($per))
		foreach($per as $p){
			$page = get_post($p->pid);
			$m[$p->pid] = ($page->post_name);
		}
		return $m;
	}
}