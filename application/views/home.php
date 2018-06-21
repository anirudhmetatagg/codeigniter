<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('header'); ?>

<!--Billboard-->
<section class="billboard">
    <div id="mainslider" class="owl-carousel homeslider">            
        <div class="item">
           <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 left typewriter">
                    <h3 class="wow fadeIn" data-wow-duration="2s" data-wow-delay=".4s">What is Lorem Ipsum?</h3>
                    <h1 class="wow fadeIn" data-wow-duration="2s" data-wow-delay=".2s">Lorem Ipsum is <br> simply dummy text.</h1> 
                    <div class="btns">
                        <a href="#1" class="cc_btn wow zoomIn" data-wow-duration="1s" data-wow-delay=".4s">Learn More<i class="fa fa-caret-right"></i></a> 
                    </div>
                    </div>
                </div>
            </div>
           </div> 
           <div class="item">
           <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 left typewriter">
                    <h3 class="wow fadeIn" data-wow-duration="2s" data-wow-delay=".4s">Why do we use it?</h3>
                    <h1 class="wow fadeIn" data-wow-duration="2s" data-wow-delay=".2s">It is a long <br> established fact.</h1> 
                    <div class="btns">
                        <a href="#1" class="cc_btn wow zoomIn" data-wow-duration="1s" data-wow-delay=".4s">Learn More <i class="fa fa-caret-right"></i></a> 
                    </div>
                    </div>
                </div>
            </div>
           </div> 
    </div> 
</section>
<!--/Billboard--> 

<!--Our Products-->
<section class="sections">
    <div class="container">
        <div class="sections-title">
            <h2 class="wow fadeUp" data-wow-duration="1s" data-wow-delay=".4s">Our Products</h2>
        </div>
        <div class="row products_top">
            <div class="col-lg-12 col-md-8">
                <div class="row pro_listing">
                    <?php 
                          if (!empty($our_products)){
                            foreach($our_products as $our_product){
                    ?>
                    <div class="col-lg-6 pro_block">
                        <div class="pro_holder">
                            <div class="pro_img"><img src="<?php echo base_url().'assets/upload/'.$our_product->product_logo; ?>" alt=""></div>
                            <div class="pro_right">
                                <h4><?php echo $our_product->product_name; ?></h4>
                                <p><?php echo character_limiter($our_product->product_description,60); ?></p>
                                <div class="price_buy">
                                    <a class="buybtn" href="<?php echo base_url().'product/'.$our_product->product_slug ?>">View More</a>    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                    <a href="<?php echo base_url().'product/'?>" class="cc_btn our_products_btn mt-4">All Products <i class="fa fa-caret-right"></i></a>
                </div>
            </div>
        </div> 
    </div>
</section>
<!--/Our Products-->

<!--Our Blogs-->
<section class="sections">
    <div class="container">
        <div class="sections-title">
            <h2 class="wow fadeUp" data-wow-duration="1s" data-wow-delay=".4s">Our Blog</h2>
        </div>
        <div class="row">
            <?php 
            if (!empty($our_blogs)){
                  foreach($our_blogs as $our_blog){
            ?>
            <div class="col-md-4 col-sm-6 collections_holder">
                <div class="coin_box">
                   <div class="coin">
                       <img src="<?php echo base_url().'assets/upload/blogimage/'.$our_blog->blog_image; ?>" alt="<?php echo $our_blog->blog_title; ?>">
                   </div>
                    <h3><?php echo $our_blog->blog_title; ?></h3>
                    <p><?php echo character_limiter($our_blog->blog_content,40); ?></p>
                    <a class="cc_btn" href="<?php echo base_url();?>blog/<?php echo $our_blog->blog_slug; ?>"> View More <i class="fa fa-caret-right"></i> </a>
                </div>
            </div>
            
            <?php } } ?>
             <a href="<?php echo base_url().'blog/'?>" class="cc_btn our_products_btn mt-4">All Blogs <i class="fa fa-caret-right"></i></a>
        </div> 
    </div>
</section>
<!--/Our Blogs-->
<?php $this->load->view('footer'); ?>
