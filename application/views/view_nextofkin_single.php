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
                <li class="breadcrumb-item active">Members</li>
                <li class="breadcrumb-item active">Next of Kin</li>
            </ol>

            <!-- Default form register -->
            <div class="text-center border border-light p-5">
                <H1>Next of Kin - <?php echo $nextofkin['MemberNo'];?></H1>
                <?php 
                    echo form_open('admin/confirmedit');
                        $nextofkinid = array('class' => 'form-control',
                                          'id'=>'fullName',
                                          'name'=>'fullName',
                                          'type' => 'text',
                                          'title' => 'Next of Kin Id',
                                          'style'=>'text-align:center',
                                          'readonly' => 'readonly','required' =>'required',
                                          'value'=>$nextofkin['NextOfKinId']
                        );
                        echo '<div class="form-row mb-4">'.form_input($nextofkinid).'</div>';                    
                        $memberNo = array('class' => 'form-control',
                                          'id'=>'memberNo',
                                          'name'=>'memberNo',
                                          'type' => 'text',
                                          'title' => 'Member No.',
                                          'readonly' => 'readonly','required' =>'required',
                                          'autofocus'=>'autofocus',
                                          'value'=>$nextofkin['MemberNo']
                        );

                        $idNo = array('class' => 'form-control',
                                      'id'=>'idNumber',
                                      'name'=>'idNumber',
                                      'type' => 'text',
                                      'title' => 'ID Number',
                                      'readonly' => 'readonly','required' =>'required',
                                      'value'=>$nextofkin['IDNumber']
                        );                  
                        echo '<div class="form-row mb-4"><div class="col">'.form_input($memberNo).'</div><div class="col">'.form_input($idNo).'</div></div>';

                        $fullname = array('class' => 'form-control',
                                          'id'=>'fullName',
                                          'name'=>'fullName',
                                          'type' => 'text',
                                          'title' => 'Full Name',
                                          'readonly' => 'readonly','required' =>'required',
                                          'value'=>$nextofkin['FullName']
                        );
                        echo '<div class="form-row mb-4">'.form_input($fullname).'</div>';

                        $address = array('class' => 'form-control',
                                        'id'=>'address',
                                        'name'=>'address',
                                        'type' => 'text',
                                        'title' => 'Address',
                                        'readonly' => 'readonly','required' =>'required',
                                        'value'=>$nextofkin['Address']
                        );

                        $mobileno = array('class' => 'form-control',
                                          'id'=>'mobileNo',
                                          'name'=>'mobileNo',
                                          'type' => 'text',
                                          'title' => 'Mobile No',
                                          'readonly' => 'readonly','required' =>'required',
                                          'value'=>$nextofkin['MobileNo']
                        );                  
                        echo '<div class="form-row mb-4"><div class="col">'.form_input($address).'</div><div class="col">'.form_input($mobileno).'</div></div>';

                        $email = array('class' => 'form-control',
                                        'id'=>'email',
                                        'name'=>'email',
                                        'type' => 'email',
                                        'title' => 'Email',
                                        'readonly' => 'readonly','required' =>'required',
                                        'value'=>$nextofkin['Email']
                        );
                        echo '<div class="form-row mb-4">'.form_input($email).'</div>';

                        $birthdate= array('class' => 'form-control',
                                        'id'=>'birthDate',
                                        'name'=>'birthDate',
                                        'type' => 'text',
                                        'title' => 'Birth Date',
                                        'readonly' => 'readonly','required' =>'required',
                                        'value'=>$nextofkin['BirthDate']
                        );

                        $relationship = array('class' => 'form-control',
                                        'id'=>'regDate',
                                        'name'=>'regDate',
                                        'type' => 'text',
                                        'title' => 'Reg Date',
                                        'readonly' => 'readonly',
                                        'required' =>'required',
                                        'value'=>$nextofkin['Relationship']
                        );                  
                        echo '<div class="form-row mb-4"><div class="col">'.form_input($birthdate).'</div><div class="col">'.form_input($relationship).'</div></div>';
                        echo '<hr>';                

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

    </body>

</html>