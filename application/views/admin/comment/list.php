 <?php $this->load->view('admin/includes/header');  ?>

 <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Comments</li>
      </ol>
     <div id="status_change_msg"></div>
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
                  <?php echo form_open('admin/comment/comment_search'); 
                       $data = array('name' => 'comment_sname','id'=> 'comment_sname','class'=> 'form-control');
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
                  <th>Author Name</th>
                  <th>Comment</th>
                  <th>Post Name</th>        
                  <th>Submitted Date</th>
                  <th>Edit</th>    
                  <th>Status</th>    
                </tr>
              </thead>
              
              <tbody>
                   <?php 
                  if (!empty($comments)){
                  foreach($comments as $comment){ ?>
                      <tr>
                        <input type="hidden" value="<?php echo $comment->comment_id;?>" class="curcommentid">  
                        <td><?php echo $comment->comment_author; ?></td>
                        <td><?php echo $comment->comment_content; ?></td>
                        <?php $bolg_details = $this->blog_model->get_blog_by_id($comment->comment_post_id);
                         // echo '<pre>'; print_r($bolg_details);
                          ?>  
                        <td><a href="<?php echo base_url().'admin/blog/update/'.$bolg_details['0']->blog_id;?>"><?php echo $bolg_details['0']->blog_title; ?></a></td>  
                        <td><?php echo $comment->comment_date; ?></td>
                        <td><a href="<?php echo base_url().'admin/comment/update/'.$comment->comment_id;?>"><i class="fa fa-pencil btn btn-primary btn-block" aria-hidden="true"></i></a></td>    
                        <?php if($comment->comment_approved == '1'){ ?>
                          <td><input type="hidden" value="0" class="commentstatus"> 
                          <i class="fa fa-thumbs-up btn btn-primary btn-block comment_status pointer"></i></td> 
                        <?php } else if($comment->comment_approved == '0'){ ?> 
                          <td> <input type="hidden" value="1" class="commentstatus"><i class="fa fa-thumbs-down btn btn-primary btn-block comment_status pointer"></i></td> 
                        <?php } ?>  
                         
                      </tr>
                  <?php } } 
                  else { ?>
                      <tr>
                          <td colspan="6"> No Comment Found !</td>
                      </tr>
                    <?php } ?>    
              </tbody>
            </table>
             </div>
         <div class="row">
                 <div class="col-sm-12 col-md-5">
                     <?php echo $comments_result; ?> 
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