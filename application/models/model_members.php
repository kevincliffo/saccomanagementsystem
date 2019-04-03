<?php
class Model_Members extends CI_Model {
    function memberExists($email, $idnumber){
        $this->db->where("Email",$email)->or_where("IDNumber",$idnumber);
        $query = $this->db->get('users');
        if($query->num_rows == 1)
        {
            return true;
        }

        return false;
    }
    
    function getfinancialdetails()
    {
        $this->db->select('*'); 
        $this->db->order_by('FinancialId', 'ASC');
        $query = $this->db->get('financials');
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }        
    }
    
    function validate()
    {
        $this->db->where('UserName', $this->input->post('username'));
        $this->db->where('PasswordHash', md5($this->input->post('password')));
        $query = $this->db->get('users');

        if($query->num_rows == 1)
        {
            return true;
        }
    }

    function create_member()
    {
        $new_member_insert_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email_address' => $this->input->post('email_address'),			
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))						
        );

        $insert = $this->db->insert('membership', $new_member_insert_data);
        return $insert;
    }

    function gethighestmemberid()
    {
        $sql = 'SELECT MAX(MemberId) AS MAX_MemberId FROM members';
        $result = $this->db->query($sql);

        if($result->num_rows() > 0)
        {
            $memberid = (int)$result->result()[0]->MAX_MemberId ;
        }
        else
        {
            $memberid = 0;
        }

        $memberid = $memberid + 1;

        return $memberid;
    }
    
    function getmemberscount()
    {
        $sql = 'SELECT COUNT(*) AS MEM_Count FROM members';
        $result = $this->db->query($sql);

        if($result->num_rows() > 0)
        {
            $count = (int)$result->result()[0]->MEM_Count ;
        }
        else
        {
            $count = 0;
        }

        return $count;
    }      
    
    function authorizemember($memberid,
                             $memberno)
    {
        $this->db->set('MemberNo', $memberno); //value that used to update column  
        $this->db->set('Confirmed', 1);
        $this->db->where('MemberId', $memberid); 
        $this->db->update('members');
        
        $this->addfinancialfornewmember($memberno,
                                        $memberid);
    }

    function addfinancialfornewmember($memborno,
                                      $memberid)
    {
        $member = $this->getmemberoverid($memberid);
        
        $data = array('MemberNo'=>$memborno,
                'FullName'=>$member['FullName'],
                'MobileNo'=>$member['MobileNo'],
                'IDNumber'=>$member['IDNumber'],
                'Salary'=>$member['Salary'], 
                'Deduction'=>$member['Salary'] * 0.01, 
                'Contribution'=>$member['Salary'] * 0.05,
                'PendingLoans'=>0        
        );
        
        $this->db->insert('financials',$data);
    }
    
    function getnextofkinovermemberno($memberno)
    {
        $this->db->select('*');
        $this->db->from('nextofkin');
        $this->db->where('MemberNo', $memberno);
        $result = $this->db->get();

        if($result)
        {
            $nextofkin['NextOfKinId'] = $result->result()[0]->NextOfKinId;
            $nextofkin['MemberNo'] = $result->result()[0]->MemberNo;
            $nextofkin['FullName'] = $result->result()[0]->FullName;
            $nextofkin['Email'] = $result->result()[0]->Email;
            $nextofkin['MobileNo'] = $result->result()[0]->MobileNo;
            $nextofkin['IDNumber'] = $result->result()[0]->IDNumber;
            $nextofkin['Relationship'] = $result->result()[0]->Relationship;
            $nextofkin['Address'] = $result->result()[0]->Address;
            $nextofkin['BirthDate'] = $result->result()[0]->BirthDate;
            
            return $nextofkin;
        }

        return array();
    }
    
    function getmobilenoovermemberno($memberno)
    {
        $this->db->select('MobileNo');
        $this->db->from('members');
        $this->db->where('MemberNo', $memberno);
        $result = $this->db->get();

        if($result)
        {
            $mobileno = $result->result()[0]->MobileNo;
            return $mobileno;
        }

        return "";
    }    
    
    function getmemberoverid($memberid)
    {
        $this->db->select('*');
        $this->db->from('members');
        $this->db->where('MemberId', $memberid);
        $result = $this->db->get();

        if($result)
        {
            $member['MemberId'] = $result->result()[0]->MemberId;
            $member['MemberNo'] = $result->result()[0]->MemberNo;
            $member['FullName'] = $result->result()[0]->FullName;
            $member['Email'] = $result->result()[0]->Email;
            $member['MobileNo'] = $result->result()[0]->MobileNo;
            $member['IDNumber'] = $result->result()[0]->IDNumber;
            $member['Confirmed'] = $result->result()[0]->Confirmed;
            $member['Address'] = $result->result()[0]->Address;
            $member['Salary'] = $result->result()[0]->Salary;
            $member['CreatedDate'] = $result->result()[0]->CreatedDate;
            $member['BirthDate'] = $result->result()[0]->BirthDate;
            
            return $member;
        }

        return array();
    }

    public function getallmembers()
    {
        $this->db->select('*'); 
        $this->db->order_by('MemberId', 'ASC');
        $query = $this->db->get('members');
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    } 

    public function getallnextofkins()
    {
        $this->db->select('*'); 
        $this->db->order_by('NextOfKinId', 'ASC');
        $query = $this->db->get('nextofkin');
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }    
}