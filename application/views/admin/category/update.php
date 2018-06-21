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
        <li class="breadcrumb-item active">Edit Category</li>
      </ol>
    <div id="gallert_delete_msg"></div>
     <?php if($this->session->flashdata('success_message')){?>
          <div class="alert alert-success-mas"> <span><?php echo $this->session->flashdata('success_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
      <?php } elseif($this->session->flashdata('unsuccess_message')){?>
        <div class="alert alert-unsuccess-mas"> <span><?php echo $this->session->flashdata('unsuccess_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
       <?php }?>
    
    <div class="card mx-auto mb-3">
      <div class="card-body">
        <?php echo form_open_multipart('admin/category/update/'.$id.''); ?>
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Category Name'); 
                $category_name = $category[0]->category_name;
                $data = array('name' => 'category_name','id'=> 'category_name','class'=> 'form-control','placeholder' => 'Enter category name','value' => "$category_name");
                 echo form_input($data);?>
                <div class="alert form-control-error"><?php echo form_error('category_name');?></div>
            </div>
          </div>
          
           
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Category Parent'); 
                $select = $category[0]->category_parent;
                echo form_dropdown('category_parent',  array('' => 'None') + $categoryparent,$select,'class="form-control"')
                ?>
            </div>
          </div> 
          
          
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Category Description'); ?>
                <?php $textarea_data = array(
                        'name'        => 'category_description',
                        'id'          => 'category_description',
                        //'rows'        => '2',
                        //'cols'        => '2',
                        'class'       => 'form-control',
                        'value'       => $category[0]->category_description
                    );
                    echo form_textarea($textarea_data); ?>
              </div>
               
          </div>
          
          <div class="text-center">
              <?php  echo form_submit('submit', 'Update Category', 'class="btn-success btn"'); ?>
          </div>        
          <?php echo form_fieldset_close(); echo form_close(); ?>
      </div>
    </div>
  
     
    </div>


<?php $this->load->view('admin/includes/footer');  ?>    