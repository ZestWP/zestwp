<?php

class Crm_Model extends dbZest
{
	private $name;
	//private $pageCrm;
	
	public function __construct() 
	{
		$this->name = _TABLE_LEAD;
		$this->user = _TABLE_CRM_USER;
		//$this->pageCrm = _TABLE_PAGE_CAMPAIGN;
		parent::__construct();
    }
	public function insertCrm($post){
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
	
	public function listCrm(){
		$pageCount = $_GET['p'] ? $_GET['p'] : 1;
		$s= $_REQUEST['s'] ? $_REQUEST['s'] : "";
		$list = $this->all($this->name, $pageCount, $s);
		return $list;
	}
	
	public function listCount(){
		
		$count = $this->recordCount($this->name);
		return $count;
	}
	
	public function getSource($type = '', $id = 0){
		if($type == 'page'){
			$page = get_post( $id);
			return $page;
		}
		else{
			$row = $this->getById($id);
			return $row;
		}
	}
	
	public function getCrm($id = 0){
		$row = $this->getById($id);
		return $row;
	}
	
	public function deleteCrm($id = 0){
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
	
	public function getCrms(){
		return $this->allRecord($this->name);
	}
	


	public function convertUser($post){
		$crm = $this->getCrm($post['id']);
		$crm->properties['converted'] = 1;
		$this->update($this->name, $crm->properties, $post['id']);
		return $this->insert($this->user, $post);
	}
	
	
	public function insertUser($post){
		if(isset($post['fname']) ){
			$data = $post;
			if(isset($post['id']) && $post['id']>0){
				return $this->update($this->user, $data, $post['id']);
			}
			else return $this->insert($this->user, $data);
		}
		else return false;
	}
	
	public function listUser(){
		$pageCount = $_GET['p'] ? $_GET['p'] : 1;
		$s= $_REQUEST['s'] ? $_REQUEST['s'] : "";
		$list = $this->all($this->user, $pageCount, $s);
		return $list;
	}
	
	public function listCountUser(){
		
		$count = $this->recordCount($this->user);
		return $count;
	}
	
	public function getUser($id = 0){
		$row = $this->getById($id);
		return $row;
	}
	
	public function deleteUser($id = 0){
		return $this->delete($id);
	}
	
	public function getUsers(){
		return $this->allRecord($this->user);
	}
	
	public function importUsers(){
		if (is_uploaded_file($_FILES['file']['tmp_name'])) {
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			$emails = array();
			while (($csv = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$i = count($csv);
				$data['fname'] =  $csv[0];
				$data['lname'] =  $csv[1];
				$data['email'] =  $csv[2];
				$data['contact'] =  $csv[3];
				$data['address'] =  $csv[4];
				
				
				$this->insertCheck($data);
			}
			return true;
		}
	}
	
	public function insertCheck($data){
		$s = serialize('email').serialize($data['email']);
		$rec = $this->all($this->user, 1, $s);
		if(sizeof($rec)>0) return;
		
		return $this->insert($this->user, $data);
	}
	
	public function exportUsers(){
		
	}
	
	public function getPages(){
		return new WP_Query( array( 'post_type' => _MENU_LANDINGPAGE_MENU, 'posts_per_page' => 10000 ) );	
	}
}