<?php $this->load->view('admin/includes/header');  ?>

<div class="container">
   <div class="card-login mx-auto">
    <?php if(isset($message_error) && $message_error){ ?>
        <div class="alert alert-login-errormsg"> <span>You Entered Username or Password Incorrect.</span> <a class="close" data-dismiss="alert">×</a></div>
        <?php }?>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
         <?php echo form_open_multipart('admin/login/login_check'); ?>
          <div class="form-group">
            <?php echo form_label('Email address');   ?>
            <?php $email_data = array('type' => 'email','name' => 'user_name','id'=> 'user_name','class'=> 'form-control','placeholder' => 'Enter email');
              echo form_input($email_data); ?>
            <div class="alert form-control-error"><?php echo form_error('user_name');?></div> 
          </div>
          <div class="form-group">
            <?php echo form_label('Password');  
              $password_data = array('name' => 'password','id'=> 'password','class'=> 'form-control','placeholder' => 'Password');
              echo form_password($password_data);
              ?>
          </div>
          <div class="text-center">
              <?php  echo form_submit('submit', 'Login', 'class="btn-success btn"'); ?>
          </div>   
         <?php echo form_fieldset_close(); ?> <?php echo form_close(); ?>
      </div>
    </div>
    </div>    
  </div>

<?php $this->load->view('admin/includes/footer');  ?>   
