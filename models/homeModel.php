<?php

class Home_Model extends dbZest
{
	private $leads;
	private $mails;
	public function __construct() 
	{
		parent::__construct();
		
    }

	public function getVisitors() 
	{
		$table = _TABLE_PAGE_TRACK;
		$sql = "SELECT id, created,properties FROM TABLE_NAME WHERE `name`='{$table}' ORDER BY created";
		$ret =  $this->execQuery($sql);
		$check = $m = array();
		
		if(sizeof($ret))
		foreach($ret as $r){
			$d = strtotime($r->created);
			$p = unserialize($r->properties);
			if(!empty($check[date('d m y',$d)]) && in_array($p['REMOTE_ADDR'], $check[date('d m y',$d)])) continue;
			$check[date('d m y',$d)][] = $p['REMOTE_ADDR'];
			
			$m[$d]++;
			
		}
		return $m;
    }

	public function getLeads() 
	{
		$table = _TABLE_LEAD;
		$sql = "SELECT id, created, properties FROM TABLE_NAME WHERE `name`='{$table}' ORDER BY created";
		$ret =  $this->execQuery($sql);
		$m = array();
		if(sizeof($ret))
		foreach($ret as $r){
			$d = strtotime($r->created);
			$m[$d]++;
			
		}
		$this->leads = $ret;
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
		$this->mails = $ret;
		return array('email'=> $email, 'browser'=>$browser);
    }
	
	public function getTasks(){
		$tasks =  $this->allRecord(_TABLE_TASK);
		$ret = array();
		if(sizeof($tasks)>0){
			foreach($tasks as $task){
				$prop = unserialize($task->properties);
				if($prop['done'] && $prop['done']==1)continue;
				$prop['id'] = $task->id;
				$d = date('M Y', $prop['date']);
				$ret[$d][] = $prop;
			}	
			//$ret = array_reverse($ret);
		}
		
		return $ret;
	}
	
	public function getForms() 
	{	
		$m = array();
		
		if(sizeof($this->leads)>0){
			$r = array();
			foreach($this->leads as $lead){
				$prop = unserialize($lead->properties);
				if($prop['form']) $r[$prop['form']]++;
			}
			asort($r);
			$r = array_slice($r, -5, 5, true);
		
			$ser = implode(',',array_keys($r));
			
		
		$s = ($ser !="") ? " AND id IN({$ser}) " : "";
		
		$table = _TABLE_FORM;
		$sql = "SELECT id, properties FROM TABLE_NAME WHERE `name`='{$table}' {$s}";
		$ret =  $this->execQuery($sql);

			if(sizeof($ret))
			foreach($ret as $rs){
				$p = unserialize($rs->properties);
				$m[$rs->id]['name'] = $p['name'];
				$m[$rs->id]['lead'] = $r[$rs->id];
				$m[$rs->id]['count'] = $this->additional($rs->id);
			}
		}
		
		if(sizeof($m)<5){
			$s = ($ser !="") ? " AND id NOT IN({$ser}) " : "";
			$limit = 5- sizeof($m);
			$sql = "SELECT id, properties FROM TABLE_NAME WHERE `name`='{$table}' {$s} ORDER BY created DESC LIMIT 0, {$limit}";
			$ret =  $this->execQuery($sql);
		
			if(sizeof($ret))
			foreach($ret as $rs){
				$p = unserialize($rs->properties);
				$m[$rs->id]['name'] = $p['name'];
				$m[$rs->id]['lead'] = 0;
				$m[$rs->id]['count'] = $this->additional($rs->id);
			}
		
		}		
		
		return $m;
    }
	
	private function additional($id= 0){
		global $wpdb;
		$count = 0;
		$page = _TABLE_PAGE_FORM;
		$form = 'form-page';
		$ser = serialize($form).serialize($id);
		$metaSer = serialize($page).serialize($id);	
		$per = $this->execQuery( 
				"SELECT COUNT(meta_key) as tot
					FROM {$wpdb->postmeta}
					WHERE `meta_key` = '{$page}' && `meta_value` LIKE '%{$metaSer}%'
				"
			);
		if(sizeof($per)>0)
			$count += $per[0]->tot;	
			
		$per = $this->execQuery( 
					"SELECT COUNT(id) as tot
						FROM {$table}
						WHERE name='{$email}'
						AND properties LIKE '%{$ser}%'
						
						ORDER BY created DESC
					"
				);
		if(sizeof($per)>0)
			$count += $per[0]->tot;	
		return $count;
	}
	
	public function getCampaigns(){
		$cmp = array();
		$m = array();
		if(sizeof($this->mails)>0){
			foreach($this->mails as $mail){
				$cmp[$mail->properties['campaign']]++;
			}
		}
		if(sizeof($cmp)>0){
			$table = _TABLE_CAMPAIGN;
			if(sizeof($cmp)>0) $ser = implode(',',array_keys($cmp));
			$s = ($ser !="") ? " AND id IN({$ser}) " : "";;
			$sql = "SELECT id, properties FROM TABLE_NAME WHERE `name`='{$table}' {$s}";
			$ret =  $this->execQuery($sql);

				if(sizeof($ret))
				foreach($ret as $rs){
					$p = unserialize($rs->properties);
					$m[$rs->id]['name'] = $p['name'];
					$m[$rs->id]['count'] = $cmp[$rs->id];
				}
		}
		
		if(sizeof($cmp)<5){
			if(sizeof($cmp)>0) $ser = implode(',',array_keys($cmp));
			$s = ($ser !="") ? " AND id NOT IN({$ser}) " : "";;
			$table = _TABLE_CAMPAIGN;
			$limit = 5- sizeof($m);
			$sql = "SELECT id, properties FROM TABLE_NAME WHERE `name`='{$table}' {$s} ORDER BY created DESC LIMIT 0, {$limit}";
			$ret =  $this->execQuery($sql);
		
			if(sizeof($ret))
			foreach($ret as $rs){
				$p = unserialize($rs->properties);
				$m[$rs->id]['name'] = $p['name'];
				$m[$rs->id]['count'] = 0;
			}
		
		}		
		if(sizeof($this->leads)>0){
			$r = array();
			foreach($this->leads as $lead){
				$prop = unserialize($lead->properties);
				if(!empty($prop['campaign']))
				foreach($prop['campaign'] as $p){
					if(!empty($m[$p])) $m[$p]['lead']++;
				}
			}
		}
		return $m;
	}
}