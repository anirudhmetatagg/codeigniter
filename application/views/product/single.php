 <?php $this->load->view('header'); ?>

<!--Billboard-->
<section class="billboard internal_page">
     <div class="container">
     	<h1>Product</h1>
     </div>
</section>
<!--/Billboard--> 


<!--Internal Page-->
<section class="sections internal_page product_single_page">
	<div class="container">
    	<div class="row">
        		    <div class="fitimg col-lg-6">
                    	<img src="<?php echo base_url().'assets/upload/'.$single_product['0']->product_logo; ?>" alt="Blog Image">
                        <?php $product_gallerys = $single_product['0']->product_gallery;
                         $product_gallerys = explode(',', $product_gallerys);
                        ?>
                    	<div id="mainslider" class="owl-carousel single_product_gallery">  
                         <?php foreach($product_gallerys as $product_gallery){ 
                            if($product_gallery){
                            ?>            
                                <div class="item">
                                   <div class="container">
                                        <div class="row align-items-center">
                                            <div class="col-lg-5 col-md-4 gallery_img wow pulse" data-wow-duration="2s" data-wow-delay="0.5s"><img src="<?php echo base_url().'assets/upload/photo/'.$product_gallery; ?>" alt=""></div> 
                                        </div>
                                    </div>
                               </div> 
                         <?php } } ?>    
                        </div> 
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="blog-cont">
                         <h3><?php echo $single_product['0']->product_name; ?></h3>
                         <h4><?php echo '$'.$single_product['0']->product_price; ?></h4>    
                         <p><?php echo $single_product['0']->product_description; ?></p> 
                        </div> 
                        
                    </div>
                   
            
        </div>
    </div>
</section>
<!--/Internal Page-->
 
 
<?php $this->load->view('footer');  ?> 