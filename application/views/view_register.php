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
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">
          <center>
              <H3>Magereza Sacco Transaction System</H3>
              <h2>Register an Account</h2>
          </center>
      </div>
      <div class="card-body">
        <?php 
            echo form_open('admin/registeruser');
        ?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                <?php 
                    $fname = array('class' => 'form-control',
                                   'id'=>'firstName',
                                   'name'=>'firstName',
                                   'type' => 'text',
                                   'placeholder' => 'First Name',
                                   'required' =>'required',
                                   'autofocus'=>'autofocus'
                                  );

                    echo form_input($fname);
                    $lbl = array('for' => 'firstName');
                    echo form_label('First name', '', $lbl);                       
                ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                <?php 
                    $lname = array('class' => 'form-control',
                                   'id'=>'lastName',
                                   'name'=>'lastName',
                                   'type' => 'text',
                                   'placeholder' => 'Last Name',
                                   'required' =>'required'
                                  );

                    echo form_input($lname);
                    $lbl = array('for' => 'lastName');
                    echo form_label('Last name', '', $lbl);                       
                ?>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
                <?php 
                    $email = array('class' => 'form-control',
                                   'id'=>'inputEmail',
                                   'name'=>'inputEmail',
                                   'type' => 'email',
                                   'placeholder' => 'Email address',
                                   'required' =>'required'
                                  );

                    echo form_input($email);
                    $lbl = array('for' => 'inputEmail');
                    echo form_label('Email address', '', $lbl);                       
                ?>                
<!--              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required">
              <label for="inputEmail">Email address</label>-->
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                <?php 
                    $pwd = array('class' => 'form-control',
                                   'id'=>'inputPassword',
                                   'name'=>'inputPassword',
                                   'type' => 'password',
                                   'placeholder' => 'Password',
                                   'required' =>'required'
                                  );

                    echo form_input($pwd);
                    $lblpwd = array('for' => 'inputPassword');
                    echo form_label('Password', '', $lblpwd);                       
                ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                <?php 
                    $cpwd = array('class' => 'form-control',
                                   'id'=>'confirmPassword',
                                   'name'=>'confirmPassword',
                                   'type' => 'password',
                                   'placeholder' => 'Confirm Password',
                                   'required' =>'required'
                                  );

                    echo form_input($cpwd);
                    $lblcpwd = array('for' => 'confirmPassword');
                    echo form_label('Confirm Password', '', $lblcpwd);                       
                ?>
                </div>
              </div>
            </div>
          </div>
        <?php
            $btn = array('class' => 'btn btn-primary btn-block',
                         'value' => 'Register',
                         'name' => 'submit',
                         'type' => 'submit');
            echo form_submit($btn);        
            echo form_close();
        ?>
        <div class="text-center">
            <?php
                $login = array('class' => 'd-block small mt-3');
                echo anchor('admin', 'Login Page', $login);
                
                $fpw = array('class' => 'd-block small');
                echo anchor('admin/forgotpassword', 'Forgot Password?', $fpw);
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
