 <?php $this->load->view('admin/includes/header'); ?>

 <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Blogs</li>
      </ol>
     <div id="user_blog_msg"></div>
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
                  <?php echo form_open('admin/blog/blog_search'); 
                       $data = array('name' => 'blog_sname','id'=> 'blog_sname','class'=> 'form-control');
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
                  <th>Blog Title</th>
                  <th>Blog Category</th>
                  <th>Author Name</th>
                  <th>Date</th>    
                  <th>Edit</th>    
                  <th>Delete</th>    
                </tr>
              </thead>
              
              <tbody>
                   <?php 
                  if (!empty($blogs)){
                  foreach($blogs as $blog){ 
                  $user_data = $this->comman_model->get_userdata_by_id($blog->author_id);
                  $category_data = $this->comman_model->get_categorydata_by_id($blog->blog_category_id); 
                  //echo '<pre>'; print_r($category_data);
                  //exit;
                  ?>
                      <tr>
                        <input type="hidden" value="<?php echo $blog->blog_id;?>" class="curblogid">  
                        <td><?php echo $blog->blog_title; ?></td>
                        <?php if(!empty($category_data)){ ?>  
                        <td><?php echo $category_data['0']->category_name; ?></td>
                        <?php } else { ?>
                          <td></td>  
                        <?php } ?>  
                        <td><?php echo $user_data['0']->first_name; ?></td>
                        <td>Published<br><?php echo date("d/m/Y", strtotime($blog->publish_date)); ?></td>  
                        <td><a href="<?php echo base_url().'admin/blog/update/'.$blog->blog_id;?>"><i class="fa fa-pencil btn btn-primary btn-block" aria-hidden="true"></i></a></td>    
                        <td><i class="fa fa-trash-o btn btn-primary btn-block deleteblog pointer"></i></td>  
                      </tr>
                  <?php } } 
                  else { ?>
                      <tr>
                          <td colspan="6"> No Blog Found !</td>
                      </tr>
                    <?php } ?>    
              </tbody>
            </table>
             </div>
         <div class="row">
                 <div class="col-sm-12 col-md-5">
                     <?php echo $blog_result; ?> 
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