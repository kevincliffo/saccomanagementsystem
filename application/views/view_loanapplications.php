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

    <a class="navbar-brand mr-1" href="index.html">Start Bootstrap</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
      <li class="nav-item active">
           <?php 
            $obj = array('class' => 'nav-link');
           echo anchor('admin/dashboard', '<i class="fas fa-fw fa-tachometer-alt"></i><span> Dasboard</span>', $obj);
           ?>
      </li>
      <li class="nav-item">
           <?php 
            $obj = array('class' => 'nav-link');
           echo anchor('admin/users', '<i class="fas fa-fw fa-users"></i><span> Users</span>', $obj);
           ?>
      </li>      
      <li class="nav-item">
           <?php 
            $obj = array('class' => 'nav-link');
           echo anchor('admin/members', '<i class="fas fa-fw fa-users"></i><span> Members</span>', $obj);
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
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Loan Applications</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Loan Applications</div>
          <div class="card-body">
            <div class="table-responsive">
                  <?php
                  $template = array(
                      'table_open'            => '<table border="0" cellpadding="0" class="table table-bordered">',
                      
                      'id'=>'dataTable',
                      'width'=>'100%',
                      'cellspacing'=>'0'
                  );
                    
                    $this->table->set_heading('Id','Member No','Loan Amount','Payment Period','ID Number','Basic Salary', 'Application Date','Guarantor Member No.','Approved','Approve Loan');
                    foreach ($loanapplications as $member)
                    {
                        $data = array(
                                'name'          => $member['Confirmed'],
                                'id'            => 'newsletter',
                                'disabled'=>'disabled',
                                'checked'       => $member['Confirmed'],
                                'style'         => 'margin:10px'
                        );                        
                        $this->table->add_row($member['LoanApplicationId'], $member['MemberNo'], number_format($member['LoanAmount'],2), $member['MonthsPaymentPeriod'], $member['IDNumber'], number_format($member['BasicSalary'], 2), $member['ApplicationDate'], $member['GuarantorMemberNo'],form_checkbox($data),anchor('admin/launchloanapproval/'.$member['LoanApplicationId'], 'View'));
                    }
                    $this->table->set_template($template);
                    echo $this->table->generate();
                    ?>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

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
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>js/sb-admin.min.js"></script>

</body>

</html>