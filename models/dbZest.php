<?php

class dbZest
{
	private $db;
	private $table;
	
	public function __construct() 
	{
		global $wpdb;
		$this->db = $wpdb;
		$this->table = $wpdb->prefix._DATABASE;
    }
    
	public function insert($name, $data)
	{
		try{
			$insert = array(
				'name' => $name,
				'properties' => serialize($data),
				'created' => date('Y-m-d H:i:s')
			);
			$this->db->insert($this->table, $insert);
		
			return $this->db->insert_id;
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return false;
	}
	
	public function all($name, $p, $s)
	{
		try{
			$items = 20;
			$offset = ($p*$items)-$items;
			$s = $s!="" ? " AND properties LIKE '%{$s}%' " : "";
			$results = $this->db->get_results( 
				"SELECT id, properties, created
					FROM {$this->table}
					WHERE name = '{$name}' {$s}
					ORDER BY created DESC
				 LIMIT {$offset}, {$items}
				"
			);
			return $results;
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return false;
	}
	
	public function recordCount($name)
	{
		try{
			$items = 20;
			$offset = ($p*$items)-$items;
			$count = $this->db->get_var( "SELECT COUNT(id) FROM {$this->table} WHERE name = '{$name}'" );
			
			return $count;
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return false;
	}
	
	public function getById($id = 0){
		try{
			$row = $this->db->get_row( "SELECT * FROM {$this->table} WHERE id = '{$id}'" );
			if(isset($row->properties)) $row->properties = unserialize($row->properties);
			return $row;
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return false;
	}
	
	public function update($name, $data, $id)
	{
		try{
			$update = array(
				'properties' => serialize($data),
				'modified' => date('Y-m-d H:i:s')
			);
			$where['id'] = $id;
			return $this->db->update($this->table, $update, $where);
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return false;
	}
	
	public function delete($id)
	{
		try{
			$where['id'] = $id;
			return $this->db->delete($this->table, $where);
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return false;
	}
	
	public function allRecord($name)
	{
		try{
			$results = $this->db->get_results( 
				"SELECT id, properties, created
					FROM {$this->table}
					WHERE name = '{$name}'
					ORDER BY created DESC
				"
			);
			return $results;
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return false;
	}
	
	public function execQuery($sql)
	{
		try{
			$sql = str_replace("TABLE_NAME", $this->table, $sql);
			$results = $this->db->get_results( 
				$sql
			);
			return $results;
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return false;
	}
}