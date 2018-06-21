 <?php $this->load->view('admin/includes/header');  ?>

 <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Categories</li>
      </ol>
     <div id="cat_delete_msg"></div>
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
                  <?php echo form_open('admin/category/category_search'); 
                       $data = array('name' => 'category_sname','id'=> 'category_sname','class'=> 'form-control');
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
                  <th>Category Name</th>
                  <th>Category Description</th>
                  <th>Count</th>    
                  <th>Edit</th>    
                  <th>Trash</th>    
                </tr>
              </thead>
              
              <tbody>
                   <?php 
                  if (!empty($categories)){
                  foreach($categories as $category){
                  $cat_count = $this->comman_model->get_category_count_by_id($category->category_id);
                      //echo '<pre>'; print_r($cat_count);
                  ?>
                      <tr>
                        <input type="hidden" value="<?php echo $category->category_id;?>" class="curcategoryid">  
                        <td><?php echo $category->category_name; ?></td>
                        <td><?php echo character_limiter($category->category_description,20); ?></td>
                        <td><?php echo $cat_count; ?></td>  
                        <td><a href="<?php echo base_url().'admin/category/update/'.$category->category_id;?>"><i class="fa fa-pencil btn btn-primary btn-block" aria-hidden="true"></i></a></td>    
                        <td><i class="fa fa-trash-o btn btn-primary btn-block deletecategory pointer"></i></td>  
                      </tr>
                  <?php } } 
                  else { ?>
                      <tr>
                          <td colspan="5"> No Category Found !</td>
                      </tr>
                    <?php } ?>    
              </tbody>
            </table>
             </div>
         <div class="row">
                 <div class="col-sm-12 col-md-5">
                     <?php echo $categories_result; ?> 
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