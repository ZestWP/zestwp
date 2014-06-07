<?php

class Task_Model extends dbZest
{
	private $name;
	private $pageCampaign;
	
	public function __construct() 
	{
		$this->name = _TABLE_TASK;
		parent::__construct();
    }
	
	public function getTasks(){
		$tasks =  $this->allRecord($this->name);
		$ret = array();
		if(sizeof($tasks)>0){
			foreach($tasks as $task){
				$prop = unserialize($task->properties);
				$prop['id'] = $task->id;
				$ret[$prop['date']][] = $prop;
			}	
		}
		return $ret;
	}
	
	public function getTask($id = 0){
		$row = $this->getById($id);
		return $row;
	}
	
	public function deleteTask($id = 0){
		return $this->delete($id);
	}
	
	public function insertTask($post){
		if(isset($post['name']) && isset($post['description']) ){
			$data['name'] = $post['name'];
			$data['description'] = $post['description'];
			$data['date'] = strtotime($post['date']);
			if(isset($post['id']) && $post['id']>0){
				return $this->update($this->name, $data, $post['id']);
			}
			else return $this->insert($this->name, $data);
		}
		else return false;
	}
}