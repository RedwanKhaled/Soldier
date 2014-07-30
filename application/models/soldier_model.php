<?php
class Soldier_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    
    public function get_all_soldiers($order=0)
    {
        if($order!=0)
        {
            $this->db->order_by('first_name','asc');
        }
        
        return $this->db->select('*')
                    ->from('soldiers_info')
                    ->get();
    }
    
    public function get_soldier_info($id)
    {
//        $this->db->where('id',$id);
//        
//        return $this->db->select('*')
//                    ->from($this->tables['soldier_info'])
//                    ->get();
    
        return $this->db->get_where('soldiers_info',array('id' => $id));
    }
    
    public function add_soldier($data)
    {
        
        $this->db->insert('soldiers_info',$data);
        
        $id = $this->db->insert_id();
        
        return isset($id)?$id:FALSE;
        //echo $this->db->affected_rows();
    }
    
    public function update_soldier_info($id,$data)
    {
        
        $this->db->update('soldiers_info',$data,array('id'=> $id));
        
        if($this->db->affected_rows()==0)
        {
            return FALSE;
        }
        
        return TRUE;
    }
    
    public function remove_soldier_info($id)
    {
        $this->db->where('id',$id);
        
        $this->db->delete($this->tables['soldiers_info']);
        
        
        if($this->affected_rows()==0)
        {
            return FALSE;
        }
        
        return TRUE;
    }
    
    public function get_all_remarks($id=0)
    {
        $this->db->where('soldier_id',$id);
        
        return $this->db->select('*')
                    ->from('remarks')
                    ->get();
    }
    
    public function add_soldier_remark($data)
    {
        $this->db->insert('remarks',$data);
        
        $id = $this->db->insert_id();
        
        return isset($id)?$id:FALSE;
    }
    
}