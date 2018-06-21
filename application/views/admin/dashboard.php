<?php $this->load->view('admin/includes/header'); ?>
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
     <div class="dash_username mb-3"><h1>Hello, <span><?php echo $user_data['0']->first_name; ?></span></h1></div>
        
        
     <!-- Icon Cards-->
      <div class="row latestStuffs">
        
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-rss"></i>
              </div>
              <div class="mr-5"><?php echo $totalblogs;?> Total Blogs!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url();?>admin/blog">
              <span class="float-left">View All Blogs</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>   
        <?php if($this->session->userdata('user_role') == 'superadmin'){ ?>      
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-bag"></i>
              </div>
              <div class="mr-5"><?php echo $totalproducts;?> Total Products!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url();?>admin/product">
              <span class="float-left">View All Products</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user"></i>
              </div>
              <div class="mr-5"><?php echo $totalusers;?> Total Users!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url();?>admin/users">
              <span class="float-left">View All Users</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>        
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comment"></i>
              </div>
              <div class="mr-5"><?php echo $totalcomments;?> Total Comments!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url();?>admin/comment">
              <span class="float-left">View All Comments</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <?php } ?>  
      </div>
         
        
        
        
        
    </div>

<?php $this->load->view('admin/includes/footer');  ?>    