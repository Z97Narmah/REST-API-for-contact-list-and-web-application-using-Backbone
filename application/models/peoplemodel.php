<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class peoplemodel extends CI_Model {

	public function getPeoples()
	{
		$this->db->select("*");
		$this->db->from('person');
		
		$query = $this->db->get();
		
		return $query->result();
		
		$num_data_returned = $query->num_rows;
		
		if ($num_data_returned < 1) {
			
			echo "There is no data in the database";
			exit(); }
	}
	
	public function insertPerson($name, $surname, $email, $telephone, $tag) {
		
		$this->db->set('name', $name);
		$this->db->set('surname', $surname);
		$this->db->set('email', $email);
		$this->db->set('telephone', $telephone);
		$this->db->set('tag', $tag);
		$this->db->insert('person');
	}
	
	public function deletePerson($personID) {
		$this->db->where('personID', $personID);
		$this->db->delete('person');
	}
	
	public function getPerson($personID) {
         
		 $this->db->where('personID', $personID);
		 $query = $this->db->get('person');
		 
		 if($query->result()) {
		
		$result = $query->result();
		
		foreach ($result as $row) {
			
			$users[$row->personID] = array($row->name, $row->surname, $row->email, $row->telephone, $row->tag);	
		}
		return $users;	 
		 }
		 
	}
	
	
		public function updatePerson($personID, $name, $surname, $email, $telephone, $tag) {
		
		$this->db->where('personID', $personID);
		$this->db->set('name', $name);
		$this->db->set('surname', $surname);
		$this->db->set('email', $email);
		$this->db->set('telephone', $telephone);
		$this->db->set('tag', $tag);
		$this->db->update('person');
	}
	
	
}