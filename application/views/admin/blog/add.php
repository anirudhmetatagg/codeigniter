
 <?php $this->load->view('admin/includes/header'); 
$user_id = $this->session->userdata('user_id');
$admin_name = $this->session->userdata('admin_name');
//echo '<pre>'; print_r($this->session->userdata());?>
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Blog</li>
      </ol>
    
     <?php if($this->session->flashdata('success_message')){?>
          <div class="alert alert-success-mas"> <span><?php echo $this->session->flashdata('success_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
      <?php } elseif($this->session->flashdata('unsuccess_message')){?>
        <div class="alert alert-unsuccess-mas"> <span><?php echo $this->session->flashdata('unsuccess_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
       <?php }?>
    
    <div class="card mx-auto">
      <div class="card-body">
        <?php echo form_open_multipart('admin/blog/add'); ?>
          <div class="form-group">
            <div class="form-row">
               <?php echo form_label('Blog Title <span class="star_label">*</span>');
                     $data = array('name' => 'blog_title','id'=> 'blog_title','class'=> 'form-control','placeholder' => 'Enter blog title');
                      echo form_input($data); ?>
                <div class="alert form-control-error"><?php echo form_error('blog_title');?></div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">  
                <label for="exampleInputEmail1">Blog Image <span class="star_label">*</span></label>
                <input class="form-control" id="blog_img" name="blog_img" type="file" aria-describedby="emailHelp">
                <div class="alert form-control-error"><?php echo form_error('blog_img');?></div>  
              </div>    
          </div>
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Blog Content'); ?>
                <?php $textarea_data = array(
                        'name'        => 'blog_content',
                        'id'          => 'blog_content',
                        'rows'        => '4',
                        'cols'        => '4',
                        'class'       => 'form-control'
                    );
                    echo form_textarea($textarea_data); ?>
              </div>
               
          </div>
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Author'); 
                $options = array($user_id => $admin_name);
                echo form_dropdown('author_id', $options, '','class="form-control"')
                ?>
            </div>
          </div>  
          <div class="text-center">
              <?php  echo form_submit('submit', 'Add Blog', 'class="btn-success btn"'); ?>
          </div>        
          <?php echo form_fieldset_close();  echo form_close(); ?>
      </div>
    </div>
  
     
    </div>
 <?php $this->load->view('admin/includes/footer');  ?>    