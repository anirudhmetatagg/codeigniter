<?php $this->load->view('admin/includes/header');  ?>
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add User</li>
      </ol>
    
     <?php if($this->session->flashdata('success_message')){?>
          <div class="alert alert-success-mas"> <span><?php echo $this->session->flashdata('success_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
      <?php } elseif($this->session->flashdata('unsuccess_message')){?>
        <div class="alert alert-unsuccess-mas"> <span><?php echo $this->session->flashdata('unsuccess_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
       <?php }?>
    
    <div class="card mx-auto mb-3">
      <div class="card-body">
        <?php echo form_open_multipart('admin/users/add'); ?>
          
          <div class="form-group">
            <div class="form-row">
               <?php echo form_label('First Name <span class="star_label">*</span>');
                     $fnamedata = array('name' => 'user_fname','id'=> 'user_fname','class'=> 'form-control','placeholder' => 'Enter first name');
                      echo form_input($fnamedata); ?>
                  <div class="alert form-control-error"><?php echo form_error('user_fname');?></div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
               <?php echo form_label('Last Name <span class="star_label">*</span>');
                     $lnamedata = array('name' => 'user_lname','id'=> 'user_lname','class'=> 'form-control','placeholder' => 'Enter last name');
                      echo form_input($lnamedata); ?>
                 <div class="alert form-control-error"><?php echo form_error('user_lname');?></div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
               <?php echo form_label('Email <span class="star_label">*</span>');
                     $emaildata = array('type' => 'email','name' => 'user_email','id'=> 'user_email','class'=> 'form-control','placeholder' => 'Enter email id');
                      echo form_input($emaildata); ?>
                <div class="alert form-control-error"><?php echo form_error('user_email');?></div>
            </div>
          </div>
          
           <div class="form-group">
            <div class="form-row">
               <?php echo form_label('Phone Number');
                     $phonedata = array('type' => 'tel','name' => 'phone_num','id'=> 'phone_num','class'=> 'form-control','placeholder' => 'Enter phone number');
                      echo form_input($phonedata); ?>
            </div>
          </div>
          
          <div class="form-group">
             <div class="form-row">  
                <?php echo form_label('Password');  
                  $password_data = array('name' => 'password','id'=> 'password','class'=> 'form-control','placeholder' => 'Password');
                  echo form_password($password_data);
                ?>
                <div class="alert form-control-error"><?php echo form_error('password');?></div> 
              </div>
          </div>
          
          <div class="form-group">
             <div class="form-row">  
                <?php echo form_label('Confirm password');  
                  $repassword_data = array('name' => 'confirm_password','id'=> 'confirm_password','class'=> 'form-control','placeholder' => 'Confirm Password');
                  echo form_password($repassword_data);
                ?>
                 <div class="alert form-control-error"><?php echo form_error('confirm_password');?></div> 
              </div>
          </div>
        
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('User Role <span class="star_label">*</span>'); 
                $options = array(
                    ''         => 'Role',
                    'superadmin'         => 'Super Admin',
                    'basic'           => 'Basic',
                );
               echo form_dropdown('user_role', $options, '', 'class="form-control"')
                ?>
                 <div class="alert form-control-error"><?php echo form_error('user_role');?></div>
              </div>
               
          </div>
          <div class="text-center">
              <?php  echo form_submit('submit', 'Add User', 'class="btn-success btn"'); ?>
        </div>        
          <?php echo form_fieldset_close();  echo form_close(); ?>
      </div>
    </div>
  
     
    </div>
 <?php $this->load->view('admin/includes/footer');  ?>    