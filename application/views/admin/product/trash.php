 <?php $this->load->view('admin/includes/header');  ?>

 <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Trash Products</li>
      </ol>
     <div id="delete_error_msg"></div>
      <?php if($this->session->flashdata('product_delete_succmsg')){?>
          <div class="alert alert-success-mas"> <span><?php echo $this->session->flashdata('product_delete_succmsg')?></span> <a class="close" data-dismiss="alert">×</a></div>
      <?php } elseif($this->session->flashdata('product_delete_errormsg')){?>
        <div class="alert alert-unsuccess-mas"> <span><?php echo $this->session->flashdata('product_delete_errormsg')?></span> <a class="close" data-dismiss="alert">×</a></div>
       <?php }?>
      <div class="card mb-3 card-body">
        <div class="table-responsive">  
       <div id="dataTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">      
         <div class="row">
             <div class="col-sm-12 col-md-6">
             </div>
             <div class="col-sm-12 col-md-6">
                 <div id="dataTable_filter" class="dataTables_filter">
                  <?php echo form_open('admin/product/trash_search'); 
                       $data = array('name' => 'product_sname','id'=> 'product_sname','class'=> 'form-control');
                      echo form_input($data); ?>
                <?php echo form_submit('submit', 'Search', 'class="btn-success btn"'); 
                      echo form_fieldset_close(); echo form_close(); ?>
                 </div>
             </div>
           </div>
          
         <div class="row">
            <table class="table table-bordered product-list" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Product Logo</th>
                  <th>Product Description</th>
                  <th>Restore</th>    
                  <th>Delete</th>    
                </tr>
              </thead>
              
              <tbody>
                   <?php 
                  if (!empty($products)){
                  foreach($products as $product){ ?>
                      <tr>
                        <input type="hidden" value="<?php echo $product->product_id;?>" class="curproductid">    
                        <td><?php echo $product->product_name; ?></td>
                        <td><img src="<?php echo base_url().'assets/upload/'.$product->product_logo;?>" width="50" style="height='40px'" /></td>
                        <td><?php echo character_limiter($product->product_description,20); ?></td>
                        <td><a href="<?php echo base_url().'admin/product/restore/'.$product->product_id;?>"><i class="fa fa-repeat btn btn-primary btn-block" aria-hidden="true"></i></a></td>    
                        <!--<td><a onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-primary btn-block" href="<?php //echo base_url().'admin/product/delete/'.$product->product_id;?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>-->  
                        <td><i class="fa fa-trash-o btn btn-primary btn-block deleteproduct"></i></td>   
                      </tr>
                  <?php } } 
                  else { ?>
                      <tr>
                          <td colspan="5"> No Product Found !</td>
                      </tr>
                    <?php } ?>    
              </tbody>
            </table>
             </div>
         <div class="row">
                 <div class="col-sm-12 col-md-5">
                     <?php echo $products_result; ?> 
                 </div>  
                 <div class="col-sm-12 col-md-7">
                     <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="dataTables_paginate paging_simple_numbers">
                                <?php echo $pagination; ?>
                         </div>    
                     </div>  
                 </div>
             </div>     
          
          </div>   
     </div>
      </div>
    </div>


<?php $this->load->view('admin/includes/footer');  ?> 
<script>
 $(document).ready(function(){

    // Number of rows selection
    $("#num_rows").change(function(){
        // Submitting form
        $("#form_entries").submit();

    });
});
    </script>
