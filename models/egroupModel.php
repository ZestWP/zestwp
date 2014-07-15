<?php

class Egroup_Model extends dbZest
{
	private $name;
	
	public function __construct() 
	{
		$this->name = _TABLE_EGROUP;
		parent::__construct();
    }
	public function insertGroup($post){
		if(isset($post['name']) ){
			
			$emails = array();
			$data = array();
			
			$c = count($post['email']);
			foreach($post['email'] as $e=>$k ){
				
				$e= $post['email'][$e];
				$emails[$e]['email'] = $e; 
				$emails[$e]['fname'] = ($post['fname'][$e] ? $post['fname'][$e] : '') ; 
				$emails[$e]['lname'] = ($post['lname'][$e] ? $post['lname'][$e] : '') ; 
			    $k = $e;
				if(isset($post['cfield'][$k]) && sizeof($post['cfield'][$k])>0 && isset($post['cvalue'][$k]) && sizeof($post['cvalue'][$k])>0){
					$arr = array_combine($post['cfield'][$k],$post['cvalue'][$k]);
					$emails[$e]['custom'] = $arr;
				}
			}

			$data['name'] = $post['name'];
			$data['email'] = $emails;

			if (is_uploaded_file($_FILES['file']['tmp_name'])) {
				$handle = fopen($_FILES['file']['tmp_name'], "r");
				$emails = array();
				while (($csv = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$i = count($csv);
					$emails[$csv[2]]['email'] = $csv[2];
					$emails[$csv[2]]['fname'] = $csv[0];
					$emails[$csv[2]]['lname'] = $csv[1];
					for( $k = 3; $k < $i; $k=$k+2 ){
						$emails[$csv[2]]['custom'][$csv[$k]] = $csv[($k+1)];
					}
				}
				$data['email'] = array_merge($data['email'], $emails);
			}
			//echo '<pre>';print_r($post);exit;
			if(isset($post['id']) && $post['id']>0){
				return $this->update($this->name, $data, $post['id']);
			}
			else return $this->insert($this->name, $data);
		}
		else return false;
	}
	
	public function listGroup(){
		$pageCount = $_GET['p'] ? $_GET['p'] : 1;
		$s= $_REQUEST['s'] ? $_REQUEST['s'] : "";
		$list = $this->all($this->name, $pageCount, $s);
		return $list;
	}
	
	public function listCount(){
		
		$count = $this->recordCount($this->name);
		return $count;
	}
	
	public function getGroup($id = 0){
		$row = $this->getById($id);
		return $row;
	}
	
	public function deleteGroup($id = 0){
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

}