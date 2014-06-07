<?php

class Form_Model extends dbZest
{
	private $name;
	private $pageform;
	
	public function __construct() 
	{
		$this->name = _TABLE_FORM;
		$this->formDefault = _TABLE_FORM_DEFAULT;
		$this->tableStatic = _TABLE_STATIC;
		parent::__construct();
    }
	public function insertForm($post){
		//echo '<pre>';print_r($post);exit;
		if(isset($post['name'])){
			$data = $post;
			if(isset($post['default']) && $post['default']){
				$this->execQuery("UPDATE TABLE_NAME set name='{$this->name}' WHERE name='{$this->formDefault}'");
				$table_name = $this->formDefault;
			}
			else $table_name = $this->name;
			if(isset($post['id']) && $post['id']>0){
				$this->execQuery("UPDATE TABLE_NAME set name='{$this->formDefault}' WHERE id='{$post['id']}'");
				return $this->update($table_name, $data, $post['id']);
			}
			else return $this->insert($table_name, $data);
		}
		else return false;
	}
	
	public function listForm(){
		$pageCount = $_GET['p'] ? $_GET['p'] : 1;
		$s= $_REQUEST['s'] ? $_REQUEST['s'] : "";
		$list = $this->all($this->name, $pageCount, $s);
		return $list;
	}
	
	public function listCount(){
		
		$count = $this->recordCount($this->name);
		return $count;
	}
	
	public function getForm($id = 0){
		$row = $this->getById($id);
		return $row;
	}
	
	public function deleteForm($id = 0){
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
	
	public function getForms(){
		return $this->allRecord($this->name);
	}
	
	public function defaultForm(){
		$list = $this->all($this->formDefault, 1, '');
		return $list;
	}

	public function getStatic(){
		//$table = _TABLE_SMTP;
		$row =  $this->allRecord($this->tableStatic);
		if(isset($row[0]->properties)) $row[0]->properties = unserialize($row[0]->properties);
		
		return $row[0];
	}
	
	public function saveStatic($post){
		
		if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
				$handle = file_get_contents($_FILES['logo']['tmp_name'], "r");
				$img = base64_encode($handle);    
				
				$post['img'] = $img;
			}
	
		if(isset($post['id']) && $post['id']>0){
			$static = $this->getStatic();
			if($static->properties['img']) $post['img'] = $static->properties['img'];
			return $this->update($this->tableStatic, $post, $post['id']);
		}
		else return $this->insert($this->tableStatic, $post);
		
	}
}