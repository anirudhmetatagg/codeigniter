 <?php $this->load->view('admin/includes/header');  ?>

 <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">All Users</li>
      </ol>
     <div id="user_delete_msg"></div>
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
                  <?php echo form_open('admin/users/users_search'); 
                       $data = array('name' => 'user_name','id'=> 'user_name','class'=> 'form-control');
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Date Created</th>                        
                  <th>Edit</th>    
                  <th>Delete</th>    
                </tr>
              </thead>
              
              <tbody>
                   <?php 
                  if (!empty($users)){
                  foreach($users as $user){ ?>
                      <tr>
                        <input type="hidden" class="curuserid" value="<?php echo $user->id; ?>" />
                        <td><?php echo $user->first_name; ?></td>
                        <td><?php echo $user->admin_email; ?></td>
                        <td><?php echo $user->role; ?></td>
                        <td><?php echo $user->created_on; ?></td>  
                        <td><a href="<?php echo base_url().'admin/users/update/'.$user->id;?>"><i class="fa fa-pencil btn btn-primary btn-block" aria-hidden="true"></i></a></td>    
                        <td><i class="fa fa-trash-o btn btn-primary btn-block deleteuser pointer"></i></td>  
                      </tr>
                  <?php } } 
                  else { ?>
                      <tr>
                          <td colspan="6"> No User Found !</td>
                      </tr>
                    <?php } ?>    
              </tbody>
            </table>
             </div>
         <div class="row">
                 <div class="col-sm-12 col-md-5">
                     <?php echo $users_result; ?> 
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