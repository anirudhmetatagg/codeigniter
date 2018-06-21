<!--Footer-->
<footer class="footer">
    <div class="container">
        <div class="row"> 
          <div class="col-lg-4 col-md-5 footer_block">
              <h4>Address </h4>
              <p>Lorem Ipsum is simply, <br>dummy text of the printing</p>
              <p>Phone:  <a href="tel:1234567890"> 123-456-7890 </a><br>
                Email:   <a href="mailto:test@gmail.com"> test@gmail.com </a></p> 
          </div>
          <div class="col-lg-5 col-md-4 footer_block">
            <h4> Main Link  </h4>
              <ul>
                  <li><a href="<?php echo base_url();?>">Home</a></li>
                  <li><a href="<?php echo base_url();?>blog">Blog</a></li>
                  <li><a href="<?php echo base_url();?>product">Products</a></li>
                  <?php if(!$this->session->userdata('front_is_logged_in')) { ?>
                  <li><a href="<?php echo base_url();?>login">Login</a></li>
                  <?php } else { ?>
                  <li><a href="<?php echo base_url();?>login/logout"> Logout </a></li>
                  <?php } ?>
              </ul> 
          </div>
          <div class="col-lg-3 col-md-3 footer_block"> 
              <h4>Get Social</h4>
              <div class="social_footer">
            <a href="#1"><i class="fa fa-facebook-square"></i></a>
            <a href="#1"><i class="fa fa-twitter-square"></i></a>
            <a href="#1"><i class="fa fa-linkedin-square"></i></a>
            <a href="#1"><i class="fa fa-google-plus-square"></i></a>
            </div> 
          </div>
      </div>  
        
        <div class="copyright">  
            Copyright © <?php echo date('Y'); ?> Web Shopee. All rights reserved.
        </div>
    </div>
    
<div class="go-up wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
        <a href="#top" class="section-scroll"><i class="fa fa-chevron-up"></i></a>
        </div>
</footer>
<!--/Footer-->


</div>
<!--/Wrapper-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.sticky.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.slimmenu.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/SmoothScroll.js"></script>
    <script src="<?php echo base_url();?>assets/js/jarallax.js"></script>
    <script src="<?php echo base_url();?>assets/js/wow.min.js"></script>  
    <script src="<?php echo base_url();?>assets/js/owl.carousel.js"></script>
<script type="text/javascript"> 
        var baseUrl = "<?php print base_url(); ?>";
    </script>
    <script>
        $('.slimmenu').slimmenu({
            resizeWidth: '991',
            collapserTitle: '',
            animSpeed:'medium',
            indentChildren: true,
            childrenIndenter: '<i class="fa fa-angle-right"></i>'
        });
        // Close Effect Menu
        $(function() {
            $('.collapse-button').click(function() {
                $('.collapse-button').toggleClass('close-menu');
            });
        });     
    </script>
    <script>
        $('#mainslider').owlCarousel({
              singleItem : true,
              loop: true,
              navigation : true,
              addClassActive : true,
              pagination: false
            }); 
        $('#testimonials').owlCarousel({
            singleItem : true,
            margin:0, 
            navigation : false,
            autoHeight : true, 
            pagination: true,
        });
    </script>
 <script>
     $(".nav-links a").click(function(){
         var value = $(this).attr('href');
         if(value==baseUrl+"product/index")
         {
            $(this).attr('href', baseUrl+"product/");
         }
     });
    </script> 

    <script src="<?php echo base_url();?>assets/js/custom.js"></script> 
</body>
</html>