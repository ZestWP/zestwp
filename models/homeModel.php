<?php

class Home_Model extends dbZest
{
	
	public function __construct() 
	{
		parent::__construct();
		
    }

	public function getVisitors() 
	{
		$table = _TABLE_PAGE_TRACK;
		$sql = "SELECT COUNT(id) as cnt, created, properties FROM TABLE_NAME WHERE `name`='{$table}' GROUP BY MONTH(created) ORDER BY MONTH(created) DESC LIMIT 0, 16 ";
		$ret =  $this->execQuery($sql);
		$m = array();
		if(sizeof($ret))
		foreach($ret as $r){
			$d = date('M-y', strtotime($r->created));
			$m[$d] = $r->cnt;
			
		}
		return $m;
    }

	public function getLeads() 
	{
		$table = _TABLE_LEAD;
		$sql = "SELECT COUNT(id) as cnt, created, properties FROM TABLE_NAME WHERE `name`='{$table}' GROUP BY MONTH(created) ORDER BY MONTH(created) DESC LIMIT 0, 16 ";
		$ret =  $this->execQuery($sql);
		$m = array();
		if(sizeof($ret))
		foreach($ret as $r){
			$d = date('M-y', strtotime($r->created));
			$m[$d] = $r->cnt;
			
		}
		return $m;
    }
	
	public function sentMails() 
	{
		$table = _TABLE_MAIL_LOG;
		$sql = "SELECT properties FROM TABLE_NAME WHERE `name`='{$table}' ";
		$ret =  $this->execQuery($sql);
		$total = $fail = 0;
		if(sizeof($ret))
		foreach($ret as $r){
			$r->properties = unserialize($r->properties);
			$total += $r->properties['count'];			
			$fail += $r->properties['fail'];			
		}
		return array('total'=> $total, 'fail'=>$fail);
    }
	
	public function openMails() 
	{
		$table = _TABLE_MAIL_TRACK;
		$sql = "SELECT properties FROM TABLE_NAME WHERE `name`='{$table}' ";
		$ret =  $this->execQuery($sql);
		$email = $browser = 0;
		if(sizeof($ret))
		foreach($ret as $r){
			$r->properties = unserialize($r->properties);
			if($r->properties['source'] == 'browser') $browser++;
			else if($r->properties['source'] == 'email') $email++;
		}
		return array('email'=> $email, 'browser'=>$browser);
    }
	
	public function getTasks(){
		$tasks =  $this->allRecord(_TABLE_TASK);
		$ret = array();
		if(sizeof($tasks)>0){
			foreach($tasks as $task){
				$prop = unserialize($task->properties);
				$prop['id'] = $task->id;
				$d = date('M Y', $prop['date']);
				$ret[$d][] = $prop;
			}	
			//$ret = array_reverse($ret);
		}
		
		return $ret;
	}
}