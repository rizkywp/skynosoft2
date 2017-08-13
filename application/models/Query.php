<?php
class Query extends Ci_Model{

	function datamember($id){
		if($id<>''){$this->db->where('id',$id);}
		$Q = $this->db->get('member');
			return $Q->result();      		  
	}
	function tambahmember(){
		$data = array( 
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'language' => $this->input->post('language'),
			'upload' => $this->input->post('file'),
			);
		$this->db->insert('member', $data);	
	}
	function editmember($id,$data){
		$this->db->where('id', $id);
		$this->db->update('member', $data);
	}
	function hapusmember($id){
		$this->db->where('id',$id);	
		$this->db->delete('member');	
	}
	

}
?>