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
        <li class="breadcrumb-item active">Edit Product</li>
      </ol>
    <div id="gallert_delete_msg"></div>
     <?php if($this->session->flashdata('success_message')){?>
          <div class="alert alert-success-mas"> <span><?php echo $this->session->flashdata('success_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
      <?php } elseif($this->session->flashdata('unsuccess_message')){?>
        <div class="alert alert-unsuccess-mas"> <span><?php echo $this->session->flashdata('unsuccess_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
       <?php }?>
    
    <div class="card mx-auto mb-3">
      <div class="card-body">
        <?php echo form_open_multipart('admin/product/update/'.$id.''); ?>
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Product Name'); 
                $product_name = $product[0]->product_name;
                $data = array('name' => 'product_name','id'=> 'product_name','class'=> 'form-control','placeholder' => 'Enter product name','value' => "$product_name");
                 echo form_input($data);
                ?>
               <div class="alert form-control-error"><?php echo form_error('product_name');?></div> 
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
                <?php echo form_label('Product Price'); 
                $product_price = $product[0]->product_price;
                $pricedata = array('name' => 'product_price','id'=> 'product_price','class'=> 'form-control','placeholder' => 'Enter product price','value' => "$product_price");
                 echo form_input($pricedata);
                ?>
            </div>
          </div>
          
          <div class="form-group">
            <div class="row">                 
                <div class="col-md-12"><label for="exampleInputEmail1">Product Logo</label></div>
                <div class="col-md">
                <input class="form-control" id="product_logo" name="product_logo" type="file">
                </div>    
                <input type="hidden" name="hidden_product_logo" value="<?php echo $product[0]->product_logo;?>" />
                <div class="col-md">
                <img src="<?php echo base_url().'assets/upload/'.$product[0]->product_logo;?>" width="50" style="height:40px;" /> 
                </div>                 
            </div> 
          </div>
          
          <div class="form-group">
            <div class="input_fields_wrap">  
                <div class="row">
                <div class="col-md-12"><label for="exampleInputEmail1">Product Gallery</label></div>
               
                <div class="col-md-12">
                <?php if($product[0]->product_gallery!=''){ ?>
                            <div class="row product_gallerys">
                                <?php $photo = explode(',',$product[0]->product_gallery);
                                  for($i=0;$i<count($photo);$i++)
                                      {
                                ?>
                                <input type="hidden" value="<?php echo $id;?>" class="curproductid">
                                <input type="hidden" value="<?php echo $photo[$i];?>" class="curphotoid">  
                                 <input type="hidden" name="hidden_product_gallery" value="<?php echo $photo[$i];?>" />    
                                <div class="col-md-6 gallery-img mt-2">
                                  <img class="d-block" src="<?php echo base_url().'assets/upload/photo/'.$photo[$i];?>">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <a class="pro_del_img btn btn-primary btn-block" href="<?php echo base_url().'admin/restaurants/deletephoto/'.$photo[$i].'/'.$id;?>" photo_id="<?php echo $photo[$i]; ?>"><i class="fa fa-trash-o btn trashproduct pointer"></i></a>
                                </div>    
                                <?php }  ?> 
                            </div>    
                    
                    <?php } ?>    
                    
                </div>    
                
               
                    <div class="col-md mt-3">
                    <input class="form-control" id="product_gallery" name="product_gallery[]" type="file">
                    </div>   
                    <div class="col-md mt-3">   
                        <a class="btn btn-primary btn-block add_field_button"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                        'class'       => 'form-control',
                        'value'       => $product[0]->product_description
                    );
                    echo form_textarea($textarea_data); ?>
              </div>
               
          </div>
          <div class="text-center">
              <?php  echo form_submit('submit', 'Update Product', 'class="btn-success btn"'); ?>
          </div>        
          <?php echo form_fieldset_close(); echo form_close(); ?>
      </div>
    </div>
  
     
    </div>


<?php $this->load->view('admin/includes/footer');  ?>    