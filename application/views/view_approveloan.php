<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $title; ?></title>

        <!-- Custom fonts for this template-->
        <link href="<?php echo base_url(); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

        <!-- Page level plugin CSS-->
        <link href="<?php echo base_url(); ?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="<?php echo base_url(); ?>css/sb-admin.css" rel="stylesheet">
    </head>

    <body id="page-top">
        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
            <a class="navbar-brand mr-1" href="index.html"></a>
            <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Navbar Search -->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
              <div class="input-group">
                  <input type="text" class="form-control" title="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                      <i class="fas fa-search"></i>
                  </button>
                  </div>
              </div>
            </form>

            <!-- Navbar -->
            <ul class="navbar-nav ml-auto ml-md-0">
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <?php 
                    $obj = array('class' => 'dropdown-item', 
                                 'data-toggle'=>'modal',
                                 'data-target'=>'#logoutModal');
                   echo anchor('admin', 'Logout', $obj);
                   ?>
                  <div class="dropdown-divider"></div>
                </div>
              </li>
            </ul>
        </nav>

        <div id="wrapper">

        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item">
                <?php 
                    $obj = array('class' => 'nav-link');
                    echo anchor('admin/dashboard', '<i class="fas fa-fw fa-tachometer-alt"></i><span> Dashboard</span>', $obj);
                ?>
            </li>
            <li class="nav-item">
                <?php 
                    $obj = array('class' => 'nav-link');
                    echo anchor('admin/users', '<i class="fas fa-fw fa-users"></i><span> Users</span>', $obj);
                ?>
            </li>
            <li class="nav-item active">
                <?php 
                    $obj = array('class' => 'nav-link');
                    echo anchor('admin/members', '<i class="fas fa-fw fa-users"></i><span> Members</span>', $obj);
                ?>
            </li>
            <li class="nav-item">
                <?php 
                    $obj = array('class' => 'nav-link');
                    echo anchor('admin/loanapplications', '<i class="fas fa-fw fa-table"></i><span> Loan Applications</span>', $obj);
                ?>
            </li>
            <li class="nav-item">
                 <?php 
                  $obj = array('class' => 'nav-link');
                 echo anchor('admin/errorneousdeductions', '<i class="fas fa-fw fa-table"></i><span> Errorneous Deductions</span>', $obj);
                 ?>
            </li>    
            <li class="nav-item">
                 <?php 
                  $obj = array('class' => 'nav-link');
                 echo anchor('admin/nextofkin', '<i class="fas fa-fw fa-users"></i><span> Next of Kin</span>', $obj);
                 ?>
            </li>
            <li class="nav-item">
                 <?php 
                  $obj = array('class' => 'nav-link');
                 echo anchor('admin/financials', '<i class="fas fa-fw fa-money-bill-alt"></i><span> Financials</span>', $obj);
                 ?>
            </li>
            <li class="nav-item">
                 <?php 
                  $obj = array('class' => 'nav-link');
                 echo anchor('admin/settings', '<i class="fas fa-fw fa-cogs"></i><span> Settings</span>', $obj);
                 ?>
            </li>
            <li class="nav-item">
                 <?php 
                  $obj = array('class' => 'nav-link');
                 echo anchor('admin/deductions', '<i class="fas fa-fw fa-money-bill-alt"></i><span> Deductions</span>', $obj);
                 ?>
            </li>
            <li class="nav-item">
                 <?php 
                  $obj = array('class' => 'nav-link');
                 echo anchor('admin/contributions', '<i class="fas fa-fw fa-money-bill-alt"></i><span> Contributions</span>', $obj);
                 ?>
            </li>            
        </ul>

        <div id="content-wrapper">
            <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Loan Applications</li>
            </ol>

            <!-- Default form register -->
            <div class="text-center border border-light p-5">
                <H1>Loan Approval</H1>
                <?php 
                    echo form_open('admin/confirmloanapproval');
                        echo form_hidden('LoanApplicationIdhidden', $member['LoanApplicationId']);
                        $memberNo = array('class' => 'form-control',
                                          'id'=>'memberNo',
                                          'name'=>'memberNo',
                                          'type' => 'text',
                                          'title' => 'Member No.',
                                          'readonly' => 'readonly','required' =>'required',
                                          'autofocus'=>'autofocus',
                                          'value'=>$member['MemberNo']
                        );

                        $idNo = array('class' => 'form-control',
                                      'id'=>'idNumber',
                                      'name'=>'idNumber',
                                      'type' => 'text',
                                        'style'=>'text-align:right',
                                      'title' => 'ID Number',
                                      'readonly' => 'readonly','required' =>'required',
                                      'value'=>$member['IDNumber']
                        );                  
                        echo '<div class="form-row mb-4"><div class="col">'.form_input($memberNo).'</div><div class="col">'.form_input($idNo).'</div></div>';

                        $loanAmount = array('class' => 'form-control',
                                        'id'=>'loanAmount',
                                        'name'=>'loanAmount',
                                        'type' => 'email',
                                        'style'=>'text-align:right',
                                        'title' => 'Loan Amount',
                                        'readonly' => 'readonly','required' =>'required',
                                        'value'=>number_format($member['LoanAmount'],2)
                        );
                        echo '<div class="form-row mb-4">'.form_input($loanAmount).'</div>';

                        $monthspaymentperiod = array('class' => 'form-control',
                                        'id'=>'monthsPaymentPeriod',
                                        'name'=>'monthsPaymentPeriod',
                                        'type' => 'text',
                                        'title' => 'Payment Period',
                                        'style'=>'text-align:right',
                                        'readonly' => 'readonly',
                                        'required' =>'required',
                                        'value'=>$member['MonthsPaymentPeriod']
                        );
                        
                        $basicsalary = array('class' => 'form-control',
                                        'id'=>'basicSalary',
                                        'name'=>'basicSalary',
                                        'type' => 'text',
                                        'style'=>'text-align:right',
                                        'title' => 'Basic Salary',
                                        'readonly' => 'readonly','required' =>'required',
                                        'value'=> number_format($member['BasicSalary'],2)
                        );
                        
                        echo '<div class="form-row mb-4"><div class="col">'.form_input($monthspaymentperiod).'</div><div class="col">'.form_input($basicsalary).'</div></div>';

                        $guarantormemberno= array('class' => 'form-control',
                                        'id'=>'guarantorMemberNo',
                                        'name'=>'guarantorMemberNo',
                                        'type' => 'text',
                                        'title' => 'Guarantor Member No',
                                        'readonly' => 'readonly','required' =>'required',
                                        'value'=>$member['GuarantorMemberNo']
                        );

                        $applicationdate= array('class' => 'form-control',
                                        'id'=>'applicationDate',
                                        'name'=>'applicationDate',
                                        'type' => 'text',
                                        'title' => 'Application Date',
                                        'readonly' => 'readonly','required' =>'required',
                                        'value'=>$member['ApplicationDate']
                        );
                  
                        echo '<div class="form-row mb-4"><div class="col">'.form_input($guarantormemberno).'</div><div class="col">'.form_input($applicationdate).'</div></div>';


                        $rbapprove = array(
                            'onclick'=>'javascript:yesnoCheck()',
                            'id' => 'approveLoan',
                            'name' => 'approveLoan',
                            'value' => 1,
                            'checked' => TRUE,
                        );

                        $rbreject = array(
                            'onclick'=>'javascript:yesnoCheck()',
                            'id' => 'rejectLoan',
                            'name' => 'approveLoan',
                            'value' => 0,
                        );
                        echo form_radio($rbapprove).''.('Approve').' ';
                        echo form_radio($rbreject).''.form_label('Reject');                       
                        
                        $rejectionreason = array('class' => 'form-control',
                                        'id'=>'loanRejectionReason',
                                        'name'=>'loanRejectionReason',
                                        'type' => 'text',
                                        'value' => 'Loan Rejection Reason',
                                        'rows'=>'3',
                                        'cols' => '10',
                                        'placeholder' => 'Loan Rejection Reason',
                                        'required' =>'required'
                        );
                        echo '<div id="ifYes" style="visibility:hidden" class="form-row mb-4">'.form_textarea($rejectionreason).'</div>';                        
                        
                        $btn = array('class' => 'btn btn-info my-4 btn-block',
                                    'value' => 'Confirm',
                                    'name' => 'submit',
                                    'type' => 'submit');
                        echo '<div class="col"><div class="form-group">'.form_submit($btn).'</div></div>';
                    echo form_close();
                ?>             
            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Your Website 2019</span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="<?php echo base_url(); ?>vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="<?php echo base_url(); ?>js/demo/datatables-demo.js"></script>

    <script type="text/javascript">
        function yesnoCheck() {
            if (document.getElementById('rejectLoan').checked) {
                document.getElementById('ifYes').style.visibility = 'visible';
            }
            else document.getElementById('ifYes').style.visibility = 'hidden';

        }
    </script>    
    </body>

</html>