<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('header'); ?>

<!--Billboard-->
<section class="sections">
           <div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mx-auto mt-3">
                     <?php if(isset($message_error) && $message_error){ ?>
                    <div class="alert alert-login-errormsg"> <span>You Entered Username or Password Incorrect.</span> <a class="close" data-dismiss="alert">×</a></div>
                    <?php }?>
                    <div class="card rounded-0">
                         <?php if(!$this->session->userdata('front_is_logged_in')) { ?>
                        <div class="card-header">
                            <h3 class="mb-0">Login</h3>
                        </div>
                        <?php } ?>
                        <div class="card-body">
                            <?php if(!$this->session->userdata('front_is_logged_in')) { ?>
                            <?php echo form_open_multipart('login/login_check/'); ?>
                                <div class="form-group">
                                   <?php echo form_label('Email address');   ?>
                                        <?php $email_data = array('type' => 'email','name' => 'user_name','id'=> 'user_name','class'=> 'form-control','placeholder' => 'Enter email');
                                          echo form_input($email_data); ?>
                                        <div class="alert form-control-error"><?php echo form_error('user_name');?></div> 
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Password');  
                                      $password_data = array('name' => 'password','id'=> 'password','class'=> 'form-control','placeholder' => 'Password');
                                      echo form_password($password_data);?>
                                    <div class="alert form-control-error"><?php echo form_error('password');?></div> 
                                </div>
                               <?php  echo form_submit('submit', 'Login', 'class="cc_btn"'); ?>
                          <?php echo form_fieldset_close();  echo form_close(); ?>
                            <?php } else { ?>
                            <h4>You are now logged in as <?php echo $this->session->userdata('front_user_name'); ?> <a href="<?php echo base_url();?>login/logout"> Logout </a></h4>
                            <?php } ?>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->

                </div>


            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<!--/container-->
</section>
<!--/Billboard--> 

<?php $this->load->view('footer'); ?>
