<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php 
        if(isset($page_title)){ ?>
    <title> <?php echo $page_title; ?> </title>
        <?php } else { ?>
    <title> Web Shopee </title>
        <?php } ?>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">

    <!-- Main Style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!--Preloader-->
<!--<div class="page-loader">
    <div class="loader">Loading...</div>
</div>-->
<!--/Preloader-->

<!--Wrapper-->
<div id="top" class="grid_1200">
    <!--Header-->
    <header class="header"> 
        <div class="container-fluid clearfix">
        <h1 class="logo">
                    <a href="<?php echo base_url();?>">
                        Web Shopee
                    </a>
                </h1>
        <div class="header_right">
           <div class="header_right_top">
          <div class="header_no"><a href="tel:1234567890"> <i class="fa fa-phone"></i>123-456-7890</a></div>
          </div>
           <div class="mainmenu">
                <ul class="slimmenu">                    
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><a href="<?php echo base_url();?>product">Products</a></li>
                    <li><a href="<?php echo base_url();?>blog"> Blog </a></li>
                    <?php if(!$this->session->userdata('front_is_logged_in')) { ?>
                    <li><a href="<?php echo base_url();?>login"> Login </a></li>
                    <?php } else { ?>
                    <li><a href="<?php echo base_url();?>login/logout"> Logout </a></li>
                    <?php } ?>
                    <li class="mo_no"><a href="tel:1234567890"> Call: 123-456-7890 </a></li>
                </ul>  
            </div>
            
        </div>
    </div>
</header>
 

<div class="clearfix"></div>
<!--/Header-->

<!--<div class="typewriter"><h1>The cat and the hat.</h1></div>-->
