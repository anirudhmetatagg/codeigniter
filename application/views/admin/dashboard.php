<?php $this->load->view('admin/includes/header');  ?>
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
     <h1>Hello, <?php echo $this->session->userdata()['admin_name']; ?></h1>
    </div>

<?php $this->load->view('admin/includes/footer');  ?>    