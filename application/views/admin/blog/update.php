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
        <li class="breadcrumb-item active">Edit Blog</li>
      </ol>
    <div id="gallert_delete_msg"></div>
     <?php if($this->session->flashdata('success_message')){?>
          <div class="alert alert-success-mas"> <span><?php echo $this->session->flashdata('success_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
      <?php } elseif($this->session->flashdata('unsuccess_message')){?>
        <div class="alert alert-unsuccess-mas"> <span><?php echo $this->session->flashdata('unsuccess_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
       <?php }?>
    
    <div class="card mx-auto mb-3">
      <div class="card-body">
        <?php echo form_open_multipart('admin/blog/update/'.$id.''); ?>
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Blog Title'); 
                $blog_title = $blog[0]->blog_title;
                $data = array('name' => 'blog_title','id'=> 'blog_title','class'=> 'form-control','placeholder' => 'Enter blog title','value' => "$blog_title");
                 echo form_input($data);
                ?>
               <div class="alert form-control-error"><?php echo form_error('blog_title');?></div> 
            </div>
          </div>
          
         <div class="form-group">
            <div class="row">                 
                <div class="col-md-12"><label for="exampleInputEmail1">Blog Image</label></div>
                <div class="col-md">
                <input class="form-control" id="blog_img" name="blog_img" type="file">
                </div>    
                <input type="hidden" name="hidden_blog_img" value="<?php echo $blog[0]->blog_image;?>" />
                <div class="col-md">
                <img src="<?php echo base_url().'assets/upload/blogimage/'.$blog[0]->blog_image;?>" width="50" style="height:40px;" /> 
                </div>                 
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
                        'class'       => 'form-control',
                        'value'       => $blog[0]->blog_content
                    );
                    echo form_textarea($textarea_data); ?>
              </div>
               
          </div>
          
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Category'); 
                $select = $blog[0]->blog_category_id;
                echo form_dropdown('blog_category_id',  $categorylist, $select,'class="form-control"')
                ?>
            </div>
          </div> 
          
          
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Author'); 
                $user_data = $this->comman_model->get_userdata_by_id($blog[0]->author_id);
                $admin_name = $user_data['0']->first_name;
                $user_id = $user_data['0']->id;
                $options = array($user_id => $admin_name);
                echo form_dropdown('author_id', $options, '','class="form-control"')
                ?>
            </div>
          </div> 
          
           
                <div class="text-right">
                    <p>Published on: <?php  echo date("d/m/Y", strtotime($blog[0]->publish_date));
                      ?></p>
                </div>    
           
          <div class="text-center">
              <?php  echo form_submit('submit', 'Update Blog', 'class="btn-success btn"'); ?>
          </div>        
          <?php echo form_fieldset_close(); echo form_close(); ?>
      </div>
    </div>
  
     
    </div>


<?php $this->load->view('admin/includes/footer');  ?>    