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
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
   
    <link href="<?php echo base_url();?>assets/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <link href="<?php echo base_url();?>assets/admin/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/custom.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo base_url(); ?>admin/">Web Shopee</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php if($this->session->userdata('is_logged_in')){ ?>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo base_url(); ?>admin/dashboard">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
      
           
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Blog">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseBlogPages" data-parent="#exampleAccordion">
           <i class="fa fa-rss" aria-hidden="true"></i>
            <span class="nav-link-text">Blog</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseBlogPages">
            <li>
              <a href="<?php echo base_url(); ?>admin/blog/">All Blogs</a>
            </li>
             <li>
              <a href="<?php echo base_url(); ?>admin/blog/add">Add Blog</a>
            </li>  
            <li>
              <a href="<?php echo base_url(); ?>admin/category/">All Categories</a>
            </li>  
            <li>
              <a href="<?php echo base_url(); ?>admin/category/add">Add Category</a>
            </li>    
          </ul>
        </li>
            
      <?php if($this->session->userdata('user_role') == 'superadmin'){ ?>      
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Products">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-shopping-bag"></i>
            <span class="nav-link-text">Product</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="<?php echo base_url(); ?>admin/product/">All Products</a>
            </li>  
            <li>
              <a href="<?php echo base_url(); ?>admin/product/add">Add Product</a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>admin/product/trash">Trash Products</a>
            </li>  
              
            
          </ul>
        </li>
       
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="nav-link-text">Users</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="<?php echo base_url(); ?>admin/users/">All Users</a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>admin/users/add">Add User</a>
            </li>
          </ul>
        </li>
          
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Comment">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCommentPages" data-parent="#exampleAccordion">
            <i class="fa fa-comment" aria-hidden="true"></i>
            <span class="nav-link-text">Comments</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseCommentPages">
            <li>
              <a href="<?php echo base_url(); ?>admin/Comment/">All Comments</a>
            </li>
           
          </ul>
        </li>      
      <?php } 
            if($this->session->userdata('user_role') == 'basic'){
          ?>    
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProfilepage" data-parent="#exampleAccordion">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="nav-link-text">Profile</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseProfilepage">
            <li>
              <a href="<?php echo base_url(); ?>admin/myprofile/">My Profile</a>
            </li>
           
          </ul>
        </li>          
       <?php } ?>      
        </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
           <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="fa fa-clock-o" aria-hidden="true"></i>
          </a>
          <div class="dropdown-menu last-login" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">Last Login:</h6>
            <div class="dropdown-divider"></div>
              
              <div class="dropdown-item">
              <?php
                date_default_timezone_set('Asia/Kolkata');
                $inTwoMonths = 60 * 60 * 24 * 60 + time();
                setcookie('lastVisit', date('h:i A - m/d/Y'), $inTwoMonths);
                if(isset($_COOKIE['lastVisit']))
                  {
                        $visit = $_COOKIE['lastVisit'];
                        echo '<div class="dropdown-message small">'. $visit.'</div>';
                      //echo "Your last visit was - ". $visit;
                  }
               
                ?>      
             </div>
            <div class="dropdown-divider"></div>
          </div>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>admin/login/logout">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
    <?php } ?>
  </nav>
    
    
     <div class="content-wrapper">