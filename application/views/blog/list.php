 <?php $this->load->view('header');  ?>

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
                <?php 
                    if (!empty($page_blogs)){
                          foreach($page_blogs as $page_blog){
                ?>
            	<div class="blog-post">
                	<div class="fitimg">
                    	<a href="<?php echo base_url().'blog/'.$page_blog->blog_slug ?>"><img src="<?php echo base_url().'assets/upload/blogimage/'.$page_blog->blog_image; ?>" alt="Blog Image"></a>
                    </div>
                    <div class="blog-cont">
                         <div class="cat">
                             <?php $blog_date = $page_blog->publish_date; ?>
                         	<span><i class="fa fa-calendar"></i> <?php  echo date("d F, Y", strtotime($blog_date)); ?></span>
                         	<!--<span><i class="fa fa-comment-o"></i> No comment</span>-->
                         	
                         </div>
                         <h3><a href="<?php echo base_url().'blog/'.$page_blog->blog_slug ?>"><?php echo $page_blog->blog_title; ?></a></h3>
                         <p><?php echo character_limiter($page_blog->blog_content,100); ?><a class="sts_btn" href="<?php echo base_url().'blog/'.$page_blog->blog_slug ?>">Read More</a></p> 
                    </div>
                </div>
                <?php } }?>
                                
                <nav class="navigation pagination" role="navigation">
                   <div class="nav-links">
                        <?php echo $pagination; ?>
                   </div>
                </nav>
                

                                
            </div>
        </div>
    </div>
</section>
<!--/Internal Page-->
 
 
<?php $this->load->view('footer');  ?> 