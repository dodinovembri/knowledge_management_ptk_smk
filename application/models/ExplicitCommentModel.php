<?php

class ExplicitCommentModel extends CI_Model
{
    private $_table = "explicit_comment";

    public function get()
    {
    	return $this->db->get($this->_table);
    }

    public function insert($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function getById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table);
    }      

    public function getByWhere($id)
    {
        return $this->db->query("select explicit_comment.*, users.name as name, users.image as image from explicit_comment JOIN users ON explicit_comment.creator_id = users.id where explicit_knowledge_id = $id");
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->_table, $data);
    }    

    public function destroy($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    } 
}