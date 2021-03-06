<?php
class StaffModel extends CI_Model {

	public function __construct(){
		$this->load->database();
    }
    
    public function get_all($id = NULL){
        $this->db->select('perumahan.*, user.*');
        $this->db->join('user','perumahan.username = user.username','right');
        $this->db->from('perumahan');
        
		if ($id != NULL){
			$this->db->where('user.username',$id);
		} else {
            $this->db->where('user.pangkat','staff');
        }
		$query = $this->db->get();
		return $query->result_array();
	}
		
	public function get_staff(){
		$this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		return $query->result_array();
	}

    public function insert($data){
        $this->db->insert('user', $data);
        if ($this->db->affected_rows() > 0 ) {
			$return_message = 'success';
		}else{
			$return_message = 'failed';
		}
		return $return_message;
	}
	
	public function delete($id){
		$this->db->where('username', $id);
		$this->db->delete('user');
		if ($this->db->affected_rows() > 0 ) {
			$return_message = 'success';
		}else{
			$return_message = 'failed';
		}
		return $return_message;
	}

	public function update($where, $data){
		$this->db->where($where);
        $this->db->update('user', $data);
	}

	public function get_user_pdf($id){
		$this->db->select('u.nama_user');
		$this->db->from('user u');
		$this->db->join('perumahan p','p.username = u.username', 'left');
		$this->db->join('cluster c','p.IDPerumahan = c.IDPerumahan', 'left');
		$this->db->join('blok b','b.IDCluster = c.IDCluster', 'right');
		$this->db->join('customer o','o.IDCustomer = b.IDCustomer', 'left');
		$this->db->where('b.IDBlok',$id);

		$query = $this->db->get();
		return $query->result_array();
    }



}
?>