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
        <li class="breadcrumb-item active">Edit Comment</li>
      </ol>
    <div id="gallert_delete_msg"></div>
     <?php if($this->session->flashdata('success_message')){?>
          <div class="alert alert-success-mas"> <span><?php echo $this->session->flashdata('success_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
      <?php } elseif($this->session->flashdata('unsuccess_message')){?>
        <div class="alert alert-unsuccess-mas"> <span><?php echo $this->session->flashdata('unsuccess_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
       <?php }?>
    
    <div class="card mx-auto mb-3">
      <div class="card-body">
        <?php echo form_open_multipart('admin/comment/update/'.$id.''); ?>
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Author Name'); 
                $comment_author = $comment[0]->comment_author;
                $data = array('name' => 'comment_author','id'=> 'comment_author','class'=> 'form-control','placeholder' => 'Enter author name','value' => "$comment_author");
                 echo form_input($data);
                ?>
            </div>
          </div>
          
           <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Author Email'); 
                $email = $comment[0]->comment_author_email;
                $emaildata = array('type' => 'email','name' => 'comment_author_email','id'=> 'comment_author_email','class'=> 'form-control','placeholder' => 'Enter email id','value' => "$email");
                 echo form_input($emaildata);
                ?>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Comment'); ?>
                <?php $textarea_data = array(
                        'name'        => 'comment_content',
                        'id'          => 'comment_content',
                        'class'       => 'form-control',
                        'value'       => $comment[0]->comment_content
                    );
                    echo form_textarea($textarea_data); ?>
              </div>
               
          </div>
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Status'); 
                $options = array(
                    ''         => 'Status',
                    '0'         => 'Pendding',
                    '1'           => 'Approved',
                );
                $selected_role = $comment[0]->comment_approved;
               echo form_dropdown('comment_approved', $options, $selected_role, 'class="form-control"')
                ?>
          </div>
          </div>  
        
          <div class="text-center">
              <?php  echo form_submit('submit', 'Update Comment', 'class="btn-success btn"'); ?>
          </div>        
          <?php echo form_fieldset_close(); echo form_close(); ?>
          </div>
      </div>
    </div>
  
     

<?php $this->load->view('admin/includes/footer');  ?>    