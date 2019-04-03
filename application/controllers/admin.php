<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('AfricasTalkingGateway.php');
class Admin extends CI_Controller {
    public function index()
    {
        $this->load->model('model_users');
        $data['title'] = 'Sacco Login';
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['main_content'] = 'view_login';
        $this->load->view('includes/template', $data);
    }

    function deductions()
    {
        $this->load->model('model_financials');
        $data['title'] = 'Deductions';
        $deductions = $this->model_financials->getalldeductions();
        $data['deductions'] = $deductions;        
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $this->load->view('view_deductions', $data);     
    } 

    function dodeductiontask()
    {
        $this->load->model('model_financials');
        $this->model_financials->dodeductiontask();
        $this->deductions();
    }
    
    function contributions()
    {
        $this->load->model('model_financials');
        $data['title'] = 'Contributions';
        $contributions = $this->model_financials->getallcontributions();
        $data['contributions'] = $contributions;
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $this->load->view('view_contributions', $data);     
    }     
    
    function docontributiontask()
    {
        $this->load->model('model_financials');
        $this->model_financials->docontributiontask();
        $this->contributions();        
    }
    
    function settings()
    {
        $this->load->model('model_members');
        $data['title'] = 'Settings';
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $this->load->view('view_settings', $data);     
    }    
    
    function financials()
    {    
        $this->load->library('calendar');
        
        $this->load->model('model_members');
        $data['title'] = 'Financials';
        $financials = $this->model_members->getfinancialdetails();
        $data['financials'] = $financials;
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $this->load->view('view_financials', $data);     
    }
    
    function userexists()
    {
        $email = $this->input->post('inputEmail');
        echo $email;
        die();
    }
    
    function validate()
    {
        $this->load->model('model_users');
        $query = $this->model_users->validate();

        if($query)
        {
            $data = array(
                    'username' => $this->input->post('UserName'),
                    'is_logged_in' => TRUE
            );
                        
            $this->session->set_userdata($data);
            redirect('admin/dashboard');
        }
        else // incorrect username or password
        {
             echo "<script>alert('Wrong Login Details')</script>";
             redirect('admin');
        }
    }

    function dashboard()
    {
        $this->load->model('model_users');
        $this->load->model('model_loanapplications');
        $this->load->model('model_members');
        
        $userscount = $this->model_users->getuserscount();
        $loanapplicationscount = $this->model_loanapplications->getloanapplicationscount();
        $memberscount = $this->model_members->getmemberscount();
        
        $data['title'] = 'Dashboard';
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['main_content'] = 'view_dashboard';
        $data['userscount'] = $userscount;
        $data['loanapplicationscount'] = $loanapplicationscount;
        $data['memberscount'] = $memberscount;
        $this->load->view('view_dashboard', $data);
    }

    function members()
    {
        $this->load->model('model_members');
        $data['title'] = 'Members';
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $members = $this->model_members->getallmembers();
        $data['members'] = $members;        
        $this->load->view('view_members', $data);
    }  
    
    function users()
    {
        $this->load->model('model_users');
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['title'] = 'Users';
        $users = $this->model_users->getallusers();
        $data['users'] = $users;        
        $this->load->view('view_users', $data);
    }        

    function loanapplications()
    {
        $this->load->model('model_loanapplications');
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['title'] = 'Loan Applications';
        $loanapplications = $this->model_loanapplications->getallmembersloans();
        $data['loanapplications'] = $loanapplications;        
        $this->load->view('view_loanapplications', $data);        
    }
    
    function register()
    {
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['title'] = 'Register';
        $this->load->view('view_register', $data);
    }

    function forgotpassword()
    {
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['title'] = 'Forgot Password';
        $this->load->view('view_forgot_password', $data);            
    }
    
    function generatememberno($memberid)
    {
    	$this->load->model('model_members');

    	$prefix = 'MSTS';
		$currentyear = date("Y");
		
		$memberno = $prefix 
		          . '-'
		          . $currentyear 
		          . '-'
		          . str_pad($memberid, 6, "0", STR_PAD_LEFT);

      	return $memberno;
    }

    function confirmerrordeduction()
    {
        $this->load->model('model_loanapplications');
        $this->load->model('model_members');
        
        $errorneousDeductionid = $this->input->post('errorneousDeductionId');
        $memberNo = $this->input->post('memberNo');
        $reason = $this->input->post('rejectionReason');
        $approve = $this->input->post('approveErrorDeduction');
        
        switch ($approve)
        {
            case 0:
                $response = 'Your Erroneous Deduction has been Accepted '.$reason;
                break;
            case 1:
                $response = 'Your Erroneous Deduction has been rejected '.$reason;
            
                break;            
        }
        $mobileno = $this->model_members->getmobilenoovermemberno($memberNo);
        $this->model_loanapplications->updateErrorneousDeduction($errorneousDeductionid,
                                                                 $memberNo,
                                                                 $approve,
                                                                 $reason);
        $response = $this->sendSMS($response, $mobileno);
//        echo $response;
//        die();
        echo "<script>alert('".$response."')</script>";
        redirect('admin/errorneousdeductions');         
    }
    
    function launcherrordeduction()
    {    
    	$this->load->model('model_loanapplications');
    	$errordeductionid = $this->uri->segment(3);
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['title'] = 'Confirm Errorneous Deductions';

        $errorneousdeduction = $this->model_loanapplications->geterrordeductionoverid($errordeductionid);
	$data['errorneousdeduction'] = $errorneousdeduction;

    	$this->load->view('view_confirmerrordeduction', $data); 
    }    
    
    function confirmmember()
    {
    	$this->load->model('model_members');
    	$memberid = $this->uri->segment(3);
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['title'] = 'Confirm Member';

        $member = $this->model_members->getmemberoverid($memberid);
	$data['member'] = $member;

    	$this->load->view('view_confirmmember', $data); 
    }

    function nextofkin_single()
    {
    	$this->load->model('model_members');
    	$memberno = $this->uri->segment(3);
        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['title'] = 'Next of Kin - '. $memberno;

        $nextofkin = $this->model_members->getnextofkinovermemberno($memberno);
	$data['nextofkin'] = $nextofkin;

    	$this->load->view('view_nextofkin_single', $data); 
    }
    
    function launchfinancialupdate()
    {
        $this->load->model('model_loanapplications');
        $financialid = $this->uri->segment(3);

        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['title'] = 'Financials Update';

        $financial = $this->model_loanapplications->getmemberfinancialinfooverid($financialid);
        $data['financial'] = $financial;

        $this->load->view('view_updatefinancial', $data);
    }    
    
    function launchloanapproval()
    {
        $this->load->model('model_loanapplications');
        $loanapplicationid = $this->uri->segment(3);

        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['title'] = 'Loan Approval';

        $member = $this->model_loanapplications->getmemberloanapplicationoverid($loanapplicationid);
        $data['member'] = $member;

        $this->load->view('view_approveloan', $data);
    }

    function confirmfinancialupdate()
    {
        $this->load->model('model_loanapplications');
        
    	$financialid = $this->input->post('financialID');
        $salary = $this->input->post('salary');
    	$pendingLoans = $this->input->post('pendingLoans');
        $deduction = $this->input->post('deduction');
        $contribution = $this->input->post('contribution');
        
        $data = array(
                      "FinancialId"=> $financialid,
                      "Salary"=> $salary,
                      "PendingLoans"=> $pendingLoans,
                      "Deduction"=> $deduction,
                      "Contribution"=> $contribution,
        );
        
        $result = $this->model_loanapplications->updatefinancial($data);
        
    	redirect('admin/financials');
    }    
    
    function confirmedit()
    {
    	$memberid = $this->input->post('memberidhidden');
    	$checked = $this->input->post('confirm');
    	$email = $this->input->post('email');
        $idNumber = $this->input->post('idNumber');
        $fullName = $this->input->post('fullName');
        $mobileNo = $this->input->post('mobileNo');
        
    	$approve = (int)$checked;

    	if($approve)
    	{
            $memberno = $this->generatememberno($memberid);

            $this->model_members->authorizemember($memberid, $memberno);
            $message = 'Dear '.$fullName. ' of ID Number '.$idNumber.'. You have been authorized to use the Magereza'
                     . ' Transaction System. Your login User Id is '.$memberno
                     . '. Use the same password you used during registration to Login';
            $response = $this->sendSMS($message, $mobileNo); 
            echo "<script>alert('".$response."')</script>";
    	}

    	redirect('admin/members');
    }

    function confirmloanapproval()
    {
        $this->load->model('model_loanapplications');
        $this->load->model('model_members');
        
        $loanapplicationid = $this->input->post('LoanApplicationIdhidden');
        $memberNo = $this->input->post('memberNo');
        $idNumber = $this->input->post('idNumber');
        $mobileNo = $this->model_members->getmobilenoovermemberno($memberNo);
        
        $approveLoan = $this->input->post('approveLoan');

        switch ($approveLoan)
        {
            case 0:
                $header = 'Dear '.$this->input->post('fullName'). ' of Member No '.$memberNo.' and ID Number '.$idNumber.'. Your Loan request has been rejected.\n ';
                $message = $this->input->post('loanRejectionReason');
                $message = $header.$message;
                $response = $this->sendSMS($message, $mobileNo); 
                break;
            case 1:
                $message = 'Dear '.$this->input->post('fullName'). ' of Member No '.$memberNo.' and ID Number '.$idNumber.'. Your Loan Application has been approved! '
                         . ' The money has been deposited into your account';
                $response = $this->sendSMS($message, $mobileNo);                
                break;            
        }

        echo "<script>alert('".$response."')</script>";
        redirect('admin/loanapplications');    
    }

    function registeruser()
    {
        $this->load->model('model_users');
        $firstname = $this->input->post('firstName');
        $lastname = $this->input->post('lastName');
        $email = $this->input->post('inputEmail');
        $password = $this->input->post('inputPassword');
        $confirmpassword = $this->input->post('confirmPassword');
        
        while(true)
        {
            if($password != $confirmpassword)
            {
                echo "<script>alert('Passwords do not match!')</script>";
                $this->register();
                break;
            }
            
            $userexists = $this->model_users->userExists($email);

            if($userexists)
            {
                echo "<script>alert('User already Exists!')</script>";
                $this->register();
                break;
            }
            
            $userdata = array(
                'FirstName' => $firstname,
                'LastName' => $lastname,
                'Email' => $email,			
                'Password' => md5($password)						
            );        

            $query = $this->model_users->createUser($userdata);
            if($query)
            {
                redirect('admin');
            }
            break;
        }
    }

    function sendSMS($message, $recepientMobileNo)
    {
        $username   = "mash12ben";
        $apikey     = "05808eae764b4309c9d4ae3494aa043dc9a088e72b99ba0b35952cfed3d87294";
        $recipients = $recepientMobileNo;

        $gateway    = new AfricasTalkingGateway($username, $apikey);

        try 
        { 
          $results = $gateway->sendMessage($recipients, $message);
          $response = 'SMS Sent successfully to '.$recepientMobileNo;
//          foreach($results as $result) {
//            echo " Number: " .$result->number;
//            echo " Status: " .$result->status;
//            echo " StatusCode: " .$result->statusCode;
//            echo " MessageId: " .$result->messageId;
//            echo " Cost: "   .$result->cost."\n";
//          }
        }
        catch ( AfricasTalkingGatewayException $e )
        {
          $response = "Encountered an error while sending: ".$e->getMessage();
        }
        return $response;
    }    
    
    function errorneousdeductions()
    {
        $this->load->model('model_loanapplications');

        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['title'] = 'Errorneous Deductions';

        $errorneousdeductions = $this->model_loanapplications->getallerrorneousdeductions();
        $data['errorneousdeductions'] = $errorneousdeductions;

        $this->load->view('view_errorneousdeductions', $data);        
    }
    
    function nextofkin()
    {
        $this->load->model('model_members');

        $data['faviconpartpath'] = base_url().'img/favicon.ico';
        $data['title'] = 'Next of Kin';

        $errorneousdeductions = $this->model_members->getallnextofkins();
        $data['nextofkins'] = $errorneousdeductions;

        $this->load->view('view_nextofkin', $data);        
    }    
}