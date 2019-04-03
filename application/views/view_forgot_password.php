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

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mb-4">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>
        <form>
          <div class="form-group">
            <div class="form-label-group">
                <?php 
                        echo form_open('admin/sendmail');
                        $email = array('class' => 'form-control',
                                       'id'=>'inputEmail',
                                       'name'=>'inputEmail',
                                       'type' => 'email',
                                       'placeholder' => 'Enter email address',
                                       'required' =>'required',
                                       'autofocus'=>'autofocus'
                                      );
                        
                        echo form_input($email);
                        $elbl = array('for' => 'inputEmail');
                        echo form_label('Email Address', '', $elbl);                       
                ?>
            </div>
          </div>
            <?php
                $btn = array('class' => 'btn btn-primary btn-block',
                             'value' => 'Reset Password',
                             'name' => 'submit',
                             'type' => 'submit');
                echo form_submit($btn);
                echo form_close();                        
            ?>
        </form>
        <div class="text-center">
            <?php
                $reg = array('class' => 'd-block small mt-3');
                echo anchor('admin/register', 'Register an Account', $reg);
                
                $login = array('class' => 'd-block small');
                echo anchor('admin', 'Login Page', $login);
            ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
