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
        
      <div class="card-header">
          <center>
              <H3>Magereza Sacco Transaction System</H3>
              <h2>Login</h2>
          </center>          
      </div>
      <div class="card-body">
        <?php 
                echo form_open('admin/validate');
                $email = array('class' => 'form-control',
                               'id'=>'inputEmail',
                               'name'=>'inputEmail',
                               'type' => 'email',
                               'placeholder' => 'Email address',
                               'required' =>'required',
                               'autofocus'=>'autofocus'
                              );
                $elbl = array('for' => 'inputEmail');                
                echo '<div class="input-group form-group"><div class="form-label-group">'.form_input($email);
                echo form_label('Email Address', '', $elbl).'</div></div>';

                $pw = array('class' => 'form-control',
                            'id'=>'inputPassword',
                            'name'=>'inputPassword',
                            'type' => 'password',
                            'placeholder' => 'Password',
                            'required' =>'required'
                              );
                $pwlbl = array('for' => 'inputPassword');                
                echo '<div class="input-group form-group"><div class="form-label-group">'
                                                    .form_input($pw);
                echo form_label('Password', '', $pwlbl).'</div></div>';
                
                $btn = array('class' => 'btn btn-primary btn-block',
                             'value' => 'Login',
                             'name' => 'submit',
                             'type' => 'submit');
        	echo '<div class="form-group">'.form_submit($btn).'</div>';
            echo form_close();
        ?>
        <div class="text-center">
            <?php
                $link = array('class' => 'd-block small mt-3');
                echo anchor('admin/register', 'Register an Account', $link);
                
                $fpwd = array('class' => 'd-block small');
                echo anchor('admin/forgotpassword', 'Forgot Password?', $fpwd);
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
