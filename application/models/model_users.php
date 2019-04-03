<?php

class Model_Users extends CI_Model {
    function userExists($email){
        $this->db->where('Email', $email);
        $query = $this->db->get('users');
        
        if($query->num_rows() > 0)
        {
            return true;
        }

        return false;
    }
    
    function validate()
    {
        $this->db->where('Email', $this->input->post('inputEmail'));
        $this->db->where('Password', md5($this->input->post('inputPassword')));
        $query = $this->db->get('users');

        //echo 'Password '.$this->input->post('inputPassword');
        //echo 'Encrypted Password '.md5($this->input->post('inputPassword'));
        //echo $this->db->last_query();
        //die();
        if($query->num_rows() == 1)
        {
            return true;
        }

        return false;
    }

    function getuserscount()
    {
        $sql = 'SELECT COUNT(*) AS US_Count FROM users';
        $result = $this->db->query($sql);

        if($result->num_rows() > 0)
        {
            $count = (int)$result->result()[0]->US_Count ;
        }
        else
        {
            $count = 0;
        }

        return $count;
    }      
    
    function createUser($userdata)
    {
        $newuser = array(
            'FirstName' => $userdata['FirstName'],
            'LastName' => $userdata['LastName'],
            'Email' => $userdata['Email'],			
            'Password' => $userdata['Password']					
        );

        $insert = $this->db->insert('users', $newuser);
        return $insert;
    }
    
    public function getallusers()
    {
        $this->db->select('*'); 
        $this->db->order_by('UserId', 'ASC');
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }    
}