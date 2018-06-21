 <?php $this->load->view('header'); 
    $last = $this->uri->total_segments();
    $blog_slug = $this->uri->segment($last);
    $single_blogdata = $this->blog_model->get_blog_by_slug($blog_slug);
    $author_name = $this->comman_model->get_author_by_id($single_blogdata['0']->author_id);
     
?>

<!--Billboard-->
<section class="billboard internal_page">
     <div class="container">
     	<h1>Blog</h1>
     </div>
</section>
<!--/Billboard--> 


<!--Internal Page-->
<section class="sections internal_page">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12">
            	<div class="blog-post">
                	<div class="fitimg">
                    	<img src="<?php echo base_url().'assets/upload/blogimage/'.$single_blogdata['0']->blog_image; ?>" alt="Blog Image">
                    </div>
                    <div class="blog-cont">
                         <div class="cat">
                             <?php $blog_date = $single_blogdata['0']->publish_date; ?>
                         	<span><i class="fa fa-calendar"></i> <?php  echo date("d F, Y", strtotime($blog_date)); ?></span>
                         	<!--<span><i class="fa fa-comment-o"></i> No comment</span>-->
                             <span><i class="fa fa-user" aria-hidden="true"></i> By  <?php echo $author_name['0']->first_name; ?></span>
                         	
                         </div>
                         <h3><?php echo $single_blogdata['0']->blog_title; ?></h3>
                         <p><?php echo $single_blogdata['0']->blog_content; ?></p> 
                    </div>
                </div>
                <?php //} }
                
                if(!empty($blog_comments))
                {
                 foreach($blog_comments as $blog_comment)   {
                 $comment_author = $this->comman_model->get_author_by_id($blog_comment->user_id);
                ?>
                <div class="card-body small bg-faded comments_box">
                <div class="media">
                  <img class="d-flex mr-3 author_img" src="<?php echo base_url().'assets/upload/profile/'.$comment_author['0']->profile_pic; ?>" alt=""> 
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"><span class="author_name"><?php echo $comment_author['0']->first_name; ?></span></h6>
                    <div class="comment_date"><?php echo date('F d, Y', strtotime($blog_comment->comment_date)); ?></div>  
                    <p class="comment_content"><?php echo $blog_comment->comment_content; ?></p> 
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a href="<?php echo base_url().'blog/'.$blog_slug.'/?replytocom='.$blog_comment->comment_id.'#respond';  ?>">Reply</a>
                      </li>
                    </ul>
                    <?php 
                     //if($blog_comment->comment_parent) {
                      $comment_parents = $this->blog_model->get_parent_blog_comment($blog_comment->comment_post_id,$blog_comment->comment_id);
                        foreach($comment_parents as $comment_parent)
                        {
                        $comment_authors = $this->comman_model->get_author_by_id($comment_parent->user_id);
                      ?>  
                    <div class="media mt-3">
                      <a class="d-flex pr-3" href="#">
                        <img src="<?php echo base_url().'assets/upload/profile/'.$comment_authors['0']->profile_pic; ?>" alt="" class="author_img">
                      </a>
                      <div class="media-body">
                        <h6 class="mt-0 mb-1"><span class="author_name"><?php echo $comment_authors['0']->first_name; ?></span></h6>
                        <div class="comment_date"><?php echo date('F d, Y', strtotime($comment_parent->comment_date)); ?></div>  
                        <p class="comment_content"><?php echo $comment_parent->comment_content; ?></p>   
                        <!--<ul class="list-inline mb-0">
                          <li class="list-inline-item">
                            <a href="<?php echo base_url().'blog/'.$blog_slug.'/?replytocom='.$comment_parent->comment_id.'#respond';  ?>">Reply</a>
                          </li>
                        </ul>-->
                      </div>
                    </div>
                    <?php } ?>  
                  </div>
                </div>
              </div>
                <?php } }?>              
            </div>
            <?php if($this->session->userdata('front_is_logged_in')) { ?>
                <div class="col-lg-12" id="respond">
                <?php if($this->session->flashdata('success_message')){?>
                             <div class="alert alert-success-mas"> <span><?php echo $this->session->flashdata('success_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
                 <?php } elseif($this->session->flashdata('unsuccess_message')){?>
                            <div class="alert alert-unsuccess-mas"> <span><?php echo $this->session->flashdata('unsuccess_message')?></span> <a class="close" data-dismiss="alert">×</a></div>
                <?php }?>    
                    
                    
                <?php echo form_open_multipart('blog/comment_post/'.$blog_slug); ?>
                <?php echo form_hidden('hidden_cpost_id',$single_blogdata['0']->blog_id);
                      echo form_hidden('hidden_user_id',$this->session->userdata('front_user_id'));
                      $comment_id = $this->input->get('replytocom', TRUE);
                      echo form_hidden('hidden_comment_parentid',$comment_id);                                                    
                
                ?>
                  <div class="form-group">
                        <div class="form-row">
                            <?php echo form_label('Comment'); ?>
                            <?php $textarea_data = array(
                                    'name'        => 'comment_msg',
                                    'id'          => 'comment_msg',
                                    'rows'        => '4',
                                    'cols'        => '4',
                                    'class'       => 'form-control'
                                );
                                echo form_textarea($textarea_data); ?>
                             <div class="alert form-control-error"><?php echo form_error('comment_msg');?></div>
                        </div>
                 </div>
                <div class="text-left">
                    <?php  echo form_submit('submit', 'Post Comment', 'class="cc_btn"'); ?>
                </div>
                
                  <?php echo form_fieldset_close();  echo form_close(); ?>
                
            </div>    
            <?php } ?>
            <?php ?>
        </div>
    </div>
</section>
<!--/Internal Page-->
 
 
<?php $this->load->view('footer');  ?> 