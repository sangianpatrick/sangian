<?php $this->load->view('head');?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page;?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if($this->session->flashdata('stud')==='succ_add'){?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Done!</h4>
          A student has been successfuly added as Student.
      </div>
      <?php }?>
      <?php if($this->session->flashdata('stud')==='succ_updt'){?>
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Done!</h4>
          The information of a Student has been successfuly updated.
      </div>
      <?php }?>
      <?php if($this->session->flashdata('stud')==='succ_inactv'){?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Done!</h4>
          A student has been successfuly inactivated from Student list.
      </div>
      <?php }?>
      <?php if($this->session->flashdata('stud')==='succ_actv'){?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Done!</h4>
          A student has been successfuly activated as Student.
      </div>
      <?php }?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">All Student</h3>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID Number</th>
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($stud_list as $value){?>
                <tr>
                  <!-- <td align="center"><label><p style="display: none"><?php echo $value->stud_id;?></p><input id="check" type="checkbox" class="minimal"></label></td> -->
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo $value->stud_nim;?></font></td>
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo $value->stud_lastname.', '.$value->stud_firstname;?></font></td>
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo ($value->stud_gender=='M'?'Male':'Female');?></font></td>
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo $value->stud_phone;?></font></td>
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo $value->stud_email;?></font></td>
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo $value->stud_address;?></font></td></tr>
                <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID Number</th>
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                </tr>
                </tfoot>
            </table>
            <br>
            *<small><font color="red"> Red-printed </font>row means an inactive Student</small><br>

        </div> 
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('foot');?>
<script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
</script>