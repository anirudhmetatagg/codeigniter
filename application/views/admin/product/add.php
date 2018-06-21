
 <?php $this->load->view('admin/includes/header');  ?>
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Product</li>
      </ol>
    
     <?php if($this->session->flashdata('success_message')){?>
          <div class="alert alert-success-mas"> <span><?php echo $this->session->flashdata('success_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
      <?php } elseif($this->session->flashdata('unsuccess_message')){?>
        <div class="alert alert-unsuccess-mas"> <span><?php echo $this->session->flashdata('unsuccess_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
       <?php }?>
    
    <div class="card mx-auto mb-3">
      <div class="card-body">
        <?php echo form_open_multipart('admin/product/add'); ?>
          <div class="form-group">
            <div class="form-row">
               <?php echo form_label('Product Name <span class="star_label">*</span>');
                     $data = array('name' => 'product_name','id'=> 'product_name','class'=> 'form-control','placeholder' => 'Enter product name');
                      echo form_input($data); ?>
                <div class="alert form-control-error"><?php echo form_error('product_name');?></div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
               <?php echo form_label('Product Price <span class="star_label">*</span>');
                     $data = array('name' => 'product_price','id'=> 'product_price','class'=> 'form-control','placeholder' => 'Enter product price');
                      echo form_input($data); ?>
                <div class="alert form-control-error"><?php echo form_error('product_price');?></div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">  
                <label for="exampleInputEmail1">Product Logo <span class="star_label">*</span></label>
                <input class="form-control" id="product_logo" name="product_logo" type="file" aria-describedby="emailHelp">
                <div class="alert form-control-error"><?php echo form_error('product_logo');?></div>  
              </div>    
          </div>
          
          
          <div class="form-group">
            <div class="input_fields_wrap">  
                <div class="row">
                <div class="col-md-12"><label for="exampleInputEmail1">Product Gallery</label></div>
               
                <div class="col-md">
                <input class="form-control" id="product_gallery" name="product_gallery[]" type="file">
                </div>    
                <div class="col-md">
                    <div class="col-md">   
                        <a class="btn btn-primary btn-block add_field_button"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>  
                </div>    
                </div>    
            </div> 
          </div>
          
        
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Product Description'); ?>
                <?php $textarea_data = array(
                        'name'        => 'product_description',
                        'id'          => 'product_description',
                        'rows'        => '2',
                        'cols'        => '2',
                        'class'       => 'form-control'
                    );
                    echo form_textarea($textarea_data); ?>
              </div>
               
          </div>
          <div class="text-center">
              <?php  echo form_submit('submit', 'Add Product', 'class="btn-success btn"'); ?>
        </div>        
          <?php echo form_fieldset_close();  echo form_close(); ?>
      </div>
    </div>
  
     
    </div>
 <?php $this->load->view('admin/includes/footer');  ?>    