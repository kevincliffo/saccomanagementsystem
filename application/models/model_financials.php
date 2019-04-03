<?php

class Model_Financials extends CI_Model {  
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

    function dodeductiontask()
    {
        $this->db->select('MemberNo, FullName, Salary, Deduction'); 
        $this->db->order_by('FinancialId', 'ASC');
        $query = $this->db->get('financials');
        
        if ($query->num_rows() > 0)
        {
            $financials = $query->result_array();
            foreach ($financials as $financial) 
            {
                $data = array(
                    'MemberNo' => $financial['MemberNo'],
                    'FullName' => $financial['FullName'],
                    'Salary' => $financial['Salary'],			
                    'Deduction' => $financial['Deduction']
                );
                $this->db->set('PaymentDate', "NOW()", FALSE);
                $this->db->insert('deductions', $data);
            }
        } 
    }      
    
    function docontributiontask()
    {
        $this->db->select('MemberNo, FullName, Salary, Contribution'); 
        $this->db->order_by('FinancialId', 'ASC');
        $query = $this->db->get('financials');
        
        if ($query->num_rows() > 0)
        {
            $financials = $query->result_array();
            foreach ($financials as $financial) 
            {
                $data = array(
                    'MemberNo' => $financial['MemberNo'],
                    'FullName' => $financial['FullName'],
                    'Salary' => $financial['Salary'],			
                    'Contribution' => $financial['Contribution']
                );
                $this->db->set('PaymentDate', "NOW()", FALSE);
                $this->db->insert('contributions', $data);
            }
        } 
    }     
    
    public function getallcontributions()
    {
        $this->db->select('*'); 
        $this->db->order_by('ContributionId', 'ASC');
        $query = $this->db->get('contributions');
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }  
    
    public function getalldeductions()
    {
        $this->db->select('*'); 
        $this->db->order_by('DeductionId', 'ASC');
        $query = $this->db->get('deductions');
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }    
}