<?php
class Model_LoanApplications extends CI_Model {
    function memberExists($email, $idnumber){
        $this->db->where("Email",$email)->or_where("IDNumber",$idnumber);
        $query = $this->db->get('users');
        if($query->num_rows == 1)
        {
            return true;
        }

        return false;
    }

    function getemailovermemberno($memberno)
    {
        $sql = "SELECT Email FROM members WHERE MemberNo = '".$memberno."'";
        $result = $this->db->query($sql);

        if($result->num_rows() > 0)
        {
            $email = $result->result()[0]->Email ;
        }
        else
        {
            $email = '';
        }

        return $email;
    }
    
    function approveloan($loanapplicationid,
                         $memberno)
    { 
        $this->db->set('Confirmed', 1);
        $this->db->where('LoanApplicationId', $loanapplicationid);
        $this->db->where('MemberNo', $memberno); 
        $this->db->update('loanApplications');
    }    
    
    function getloanapplicationscount()
    {
        $sql = 'SELECT COUNT(*) AS LA_Count FROM loanapplications';
        $result = $this->db->query($sql);

        if($result->num_rows() > 0)
        {
            $count = (int)$result->result()[0]->LA_Count ;
        }
        else
        {
            $count = 0;
        }

        return $count;
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

    function getmemberfinancialinfooverid($financialid)
    {
        $this->db->select('*');
        $this->db->from('financials');
        $this->db->where('FinancialId', $financialid);
        $result = $this->db->get();

        if($result)
        {
            $financial['FinancialId'] = $result->result()[0]->FinancialId;
            $financial['MemberNo'] = $result->result()[0]->MemberNo;
            $financial['FullName'] = $result->result()[0]->FullName;
            $financial['Contribution'] = $result->result()[0]->Contribution;
            $financial['PendingLoans'] = $result->result()[0]->PendingLoans;
            $financial['MobileNo'] = $result->result()[0]->MobileNo;
            $financial['IDNumber'] = $result->result()[0]->IDNumber;
            $financial['Salary'] = $result->result()[0]->Salary;
            $financial['Deduction'] = $result->result()[0]->Deduction;
            
            return $financial;
        }

        return array();
    }    
    
    function updatefinancial($data)
    {
        $this->db->set('Salary', $data['Salary']);
        $this->db->set('PendingLoans', $data['PendingLoans']);
        $this->db->set('Contribution', $data['Contribution']);
        $this->db->set('Deduction', $data['Deduction']);        
        $this->db->where('FinancialId', $data['FinancialId']); 
        
        $result = $this->db->update('financials');
        
        return $result;
    }
    
    function getmemberloanapplicationoverid($loanapplicationid)
    {
        $this->db->select('*');
        $this->db->from('loanapplications');
        $this->db->where('LoanApplicationId', $loanapplicationid);
        $result = $this->db->get();

        if($result)
        {
            $member['LoanApplicationId'] = $result->result()[0]->LoanApplicationId;
            $member['MemberNo'] = $result->result()[0]->MemberNo;
            $member['LoanAmount'] = $result->result()[0]->LoanAmount;
            $member['MonthsPaymentPeriod'] = $result->result()[0]->MonthsPaymentPeriod;
            $member['IDNumber'] = $result->result()[0]->IDNumber;
            $member['BasicSalary'] = $result->result()[0]->BasicSalary;
            $member['ApplicationDate'] = $result->result()[0]->ApplicationDate;
            $member['GuarantorMemberNo'] = $result->result()[0]->GuarantorMemberNo;
            $member['Confirmed'] = $result->result()[0]->Confirmed;
            
            return $member;
        }

        return array();
    }

    function updateErrorneousDeduction($errorDedeductionId,
                                       $memberNo,
                                       $approve,
                                       $reason)
    {
        $value = array('Corrected'=>$approve,
                       'Reason'=>$reason);
        $this->db->where('ErrorneousDeductionId',$errorDedeductionId);
        $this->db->where('MemberNo',$memberNo);
        $this->db->update('errorneousdeductions',$value);       
    }
    
    function geterrordeductionoverid($errordeductionid)
    {
        $this->db->select('*');
        $this->db->from('errorneousdeductions');
        $this->db->where('ErrorneousDeductionId', $errordeductionid);
        $result = $this->db->get();

        if($result)
        {
            $errorneousdeduction['ErrorneousDeductionId'] = $result->result()[0]->ErrorneousDeductionId;
            $errorneousdeduction['MemberNo'] = $result->result()[0]->MemberNo;
            $errorneousdeduction['FullName'] = $result->result()[0]->FullName;
            $errorneousdeduction['Amount'] = $result->result()[0]->Amount;
            $errorneousdeduction['DeductionDate'] = $result->result()[0]->DeductionDate;
            $errorneousdeduction['CreatedDate'] = $result->result()[0]->CreatedDate;
            $errorneousdeduction['Corrected'] = $result->result()[0]->Corrected;
            
            return $errorneousdeduction;
        }

        return array();
    }    
    
    function getmemberloanapplication($memberno)
    {
        $this->db->select('*');
        $this->db->from('loanapplications');
        $this->db->where('MemberNo', $memberno);
        $result = $this->db->get();

        if($result)
        {
            $member['LoanApplicationId'] = $result->result()[0]->LoanApplicationId;
            $member['MemberNo'] = $result->result()[0]->MemberNo;
            $member['FullName'] = $result->result()[0]->FullName;
            $member['LoanAmount'] = $result->result()[0]->LoanAmount;
            $member['LoanType'] = $result->result()[0]->LoanType;
            $member['MonthsPaymentPeriod'] = $result->result()[0]->MonthsPaymentPeriod;
            $member['LoanPurpose'] = $result->result()[0]->LoanPurpose;
            $member['OutstandingLoans'] = $result->result()[0]->OutstandingLoans;
            $member['MobileNo'] = $result->result()[0]->MobileNo;
            $member['IDNumber'] = $result->result()[0]->IDNumber;
            $member['Age'] = $result->result()[0]->Age;
            $member['County'] = $result->result()[0]->County;
            $member['Division'] = $result->result()[0]->Division;
            $member['Rank'] = $result->result()[0]->Rank;
            $member['Address'] = $result->result()[0]->Address;
            $member['BasicSalary'] = $result->result()[0]->BasicSalary;
            $member['ApplicationDate'] = $result->result()[0]->ApplicationDate;
            $member['Security'] = $result->result()[0]->Security;
            $member['GuarantorMemberNo'] = $result->result()[0]->GuarantorMemberNo;
            $member['GuarantorMemberName'] = $result->result()[0]->GuarantorMemberName;
            $member['Confirmed'] = $result->result()[0]->Confirmed;
            
            return $member;
        }

        return array();
    }

    public function getallmembersloans()
    {
        $this->db->select('*'); 
        $this->db->order_by('LoanApplicationId', 'ASC');
        $query = $this->db->get('loanapplications');
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }   
    
    public function getallerrorneousdeductions()
    {
        $this->db->select('*'); 
        $this->db->order_by('ErrorneousDeductionId', 'ASC');
        $query = $this->db->get('errorneousdeductions');
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }     
}