<?php $this->load->view('admin/includes/header');  ?>

<?php $last = $this->uri->total_segments();
      $id = $this->uri->segment($last);
?>


<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Edit Profile</li>
      </ol>
    <div id="gallert_delete_msg"></div>
     <?php if($this->session->flashdata('success_message')){?>
          <div class="alert alert-success-mas"> <span><?php echo $this->session->flashdata('success_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
      <?php } elseif($this->session->flashdata('unsuccess_message')){?>
        <div class="alert alert-unsuccess-mas"> <span><?php echo $this->session->flashdata('unsuccess_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
       <?php }?>
    
    <div class="card mx-auto mb-3">
      <div class="card-body">
        <?php echo form_open_multipart('admin/myprofile/index/'.$id.''); ?>
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('First Name'); 
                $first_name = $myprofile[0]->first_name;
                $data = array('name' => 'user_fname','id'=> 'user_fname','class'=> 'form-control','placeholder' => 'Enter first name','value' => "$first_name");
                 echo form_input($data);
                ?>
               <div class="alert form-control-error"><?php echo form_error('user_fname');?></div> 
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Last Name'); 
                $last_name = $myprofile[0]->last_name;
                $lastdata = array('name' => 'user_lname','id'=> 'user_lname','class'=> 'form-control','placeholder' => 'Enter last name','value' => "$last_name");
                 echo form_input($lastdata);
                ?>
               <div class="alert form-control-error"><?php echo form_error('user_lname');?></div>   
            </div>
          </div>
          
           <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Email'); 
                $email = $myprofile[0]->admin_email;
                $emaildata = array('type' => 'email','name' => 'user_email','id'=> 'user_email','class'=> 'form-control','placeholder' => 'Enter email name','value' => "$email");
                 echo form_input($emaildata);
                ?>
                <div class="alert form-control-error"><?php echo form_error('user_email');?></div> 
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Phone Number'); 
                $phone_num = $myprofile[0]->phone_num;
                $phonedata = array('type' => 'tel','name' => 'phone_num','id'=> 'phone_num','class'=> 'form-control','placeholder' => 'Enter phone number','value' => "$phone_num");
                 echo form_input($phonedata);
                ?>
                
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Role'); 
                $role = $myprofile[0]->role;
                $roledata = array('name' => 'user_role','id'=> 'user_role','class'=> 'form-control','value' => "$role",'readonly'=>'true');
                 echo form_input($roledata);
                ?>
            </div>
          </div>
          
          <div class="form-group">
            <div class="row">                 
                <div class="col-md-12"><label for="exampleInputEmail1">Profile Picture</label></div>
                <div class="col-md">
                <input class="form-control" id="profile_pic" name="profile_pic" type="file">
                </div>    
                <input type="hidden" name="hidden_profile_pic" value="<?php echo $myprofile[0]->profile_pic;?>" />
                <?php if($myprofile[0]->profile_pic != '') { ?>
                    <div class="col-md">
                    <img src="<?php echo base_url().'assets/upload/profile/'.$myprofile[0]->profile_pic;?>" width="50" style="height:40px;" /> 
                    </div>
                <?php } ?>
            </div> 
          </div>
          
          <div class="text-center">
              <?php  echo form_submit('submit', 'Update Profile', 'class="btn-success btn"'); ?>
          </div>        
          <?php echo form_fieldset_close(); echo form_close(); ?>
      </div>
    </div>
  
     
    </div>


<?php $this->load->view('admin/includes/footer');  ?>    