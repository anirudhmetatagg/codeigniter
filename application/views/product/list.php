 <?php $this->load->view('header');  ?>

<!--Billboard-->
<section class="billboard internal_page">
     <div class="container">
     	<h1>Products</h1>
     </div>
</section>
<!--/Billboard--> 


<!--Internal Page-->
<section class="sections internal_page product_list_page">
	<div class="container">
    	<div class="row">
        	    <?php 
                    if (!empty($page_products)){
                          foreach($page_products as $page_product){
                ?>
            	<div class="blog-post col-md-4">
                    <div class="card mt-4">
                        <div class="fitimg">
                            <a href="<?php echo base_url().'product/'.$page_product->product_slug ?>"><img src="<?php echo base_url().'assets/upload/'.$page_product->product_logo; ?>" alt="Blog Image"></a>
                        </div>
                        <div class="card-body">
                             <h3><a href="<?php echo base_url().'product/'.$page_product->product_slug ?>"><?php echo $page_product->product_name; ?></a></h3>
                             <h4><?php echo '$'.$page_product->product_price; ?></h4>
                             <p><?php echo character_limiter($page_product->product_description,100); ?><a class="sts_btn" href="<?php echo base_url().'product/'.$page_product->product_slug ?>">Read More</a></p> 
                        </div>
                    </div>    
                </div>
                <?php } }?>
                                
                <nav class="navigation pagination col-lg-12 mt-3" role="navigation">
                   <div class="nav-links">
                        <?php echo $pagination; ?>
                   </div>
                </nav>
        </div>
    </div>
</section>
<!--/Internal Page-->
 
 
<?php $this->load->view('footer');  ?> 