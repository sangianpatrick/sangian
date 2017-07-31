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
      <?php if($this->session->flashdata('ts')==='succ_add'){?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Done!</h4>
          A person has been successfuly added as Lecturer/Staff.
      </div>
      <?php }?>
      <?php if($this->session->flashdata('ts')==='succ_updt'){?>
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Done!</h4>
          The information of a Lecturer/Staff has been successfuly updated.
      </div>
      <?php }?>
      <?php if($this->session->flashdata('ts')==='succ_inactv'){?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Done!</h4>
          A person has been successfuly inactivated from Lecturer/Staff list.
      </div>
      <?php }?>
      <?php if($this->session->flashdata('ts')==='succ_actv'){?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Done!</h4>
          A person has been successfuly activated as Lecturer/Staff.
      </div>
      <?php }?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">All Lecturer & Staff</h3><br><br>
          <button class="btn btn-primary btn-flat" onclick="add_ls();">Add Person</button>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID Number</th>
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Level/Role</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($ts_list as $value){?>
                <tr>
                  <!-- <td align="center"><label><p style="display: none"><?php echo $value->ts_id;?></p><input id="check" type="checkbox" class=""></label></td> -->
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo $value->ts_nip;?></font></td>
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo $value->ts_lastname.', '.$value->ts_firstname;?></font></td>
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo ($value->ts_gender=='M'?'Male':'Female');?></font></td>
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo (
                                                                                                   ($value->ts_role == 1) ? "Dean/Lecturer" :
                                                                                                    (($value->ts_role == 2) ? "HoP/Lecturer" :
                                                                                                     (($value->ts_role == 3) ? "Lecturer" :
                                                                                                      (($value->ts_role == 4) ? "Secretary" : "-")))
                                                                                                   );?></font></td>
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo $value->ts_phone;?></font></td>
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo $value->ts_email;?></font></td>
                  <td><font <?php if($value->user_status == 0){echo 'color="red"';} ?>><?php echo $value->ts_address;?></font></td>
                  <td align="center">
                      <button onclick="update_ts('<?php echo $value->ts_nip;?>','<?php echo $value->ts_firstname;?>','<?php echo $value->ts_lastname;?>','<?php echo $value->ts_gender;?>','<?php echo $value->ts_role;?>','<?php echo $value->ts_phone;?>','<?php echo $value->ts_email;?>','<?php echo $value->ts_address;?>');" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i></button>
                      <?php if($value->user_status == 1){?>
                      <button onclick="inactivate_ts('<?php echo $value->ts_nip;?>','<?php echo $value->ts_firstname;?>','<?php echo $value->ts_lastname;?>');" class="btn btn-success btn-flat"><i class="fa fa-toggle-on"></i></button>
                      <?php }elseif($value->user_status == 0){?>
                      <button onclick="activate_ts('<?php echo $value->ts_nip;?>','<?php echo $value->ts_firstname;?>','<?php echo $value->ts_lastname;?>');" class="btn btn-danger btn-flat"><i class="fa fa-toggle-off"></i></button>
                      <?php }?>
                  </td>
                </tr>
                <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID Number</th>
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Level/Role</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
                </tfoot>
            </table>
            <br>
            *<small><font color="red"> Red-printed </font>row means an inactive Lecturer/Staff</small><br>
            *<small><font color="orange"> Orange button </font>serves to update current information of a Lecturer/Staff</small><br>
            *<small><font color="green"> Green</font> and <font color="red"> Red</font> toggle serves for the activation of a Lecturer/Staff</small>

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

    function add_ls()
      {
         $('#form_add_up')[0].reset();
         if ($('#div_acc').length === 0) {
            $('#form_add_up > .box-body').prepend('<div id="div_acc" class="form-group"><label>ID Number</label><input type="number" onkeyup="check_acc(this);" class="form-control" id="ts_nip" name="ts_nip" placeholder="Enter ID number" maxlength="20" required></div>');
         };
         if($('#div_acc').hasClass('has-error')){
                        $('#div_acc').removeClass('has-error');
                        $('#div_acc span').remove();
          };
         $('#form_add_up').get(0).setAttribute('action', 'manage_lecturer_staff/add');
         $('#modal_create_cs').modal('show'); // show bootstrap modal
         $('.modal-title').text("Adding Lecturer/Staff");
         $('#submit').html('Add').prop('disabled',true);
      }

    function check_acc(acc)
      {
                
                $.ajax({
                url: "<?php echo site_url('admin/manage_lecturer_staff/check_acc')?>",
                data: {acc: acc.value},
                type: "POST",
                dataType: 'json',
                  success:function(data){
                    if (data['status']===1) {
                        $('#div_acc').addClass('has-error');
                        if($('#div_acc  span').length==0){
                          $('#div_acc').append('<span class="help-block">This ID Number is belonged to a registered person. You should try another.</span>');
                        }
                        //$('#acc_number').val('');
                        $('#acc_number').focus();
                        $('#submit').prop('disabled',true);



                    }else if(data['status']===0){
                      $('#submit').prop('disabled',false);
                      if($('#div_acc').hasClass('has-error')){
                        $('#div_acc').removeClass('has-error');
                        $('#div_acc span').remove();
                      };
                    };

                  },
                  error: function (){
                      alert('Unsuccesfull checking account number.');
                  }
          });
      }

      function update_ts(nip,firstname,lastname,gender,role,phone,email,address)
      {
         $('#submit').prop('disabled',false);
         $('#div_acc').remove();
         $('#form_add_up')[0].reset();
         $('#form_add_up').get(0).setAttribute('action', 'manage_lecturer_staff/update?nip=' + nip);
         $('#modal_create_cs').modal('show'); // show bootstrap modal
         $('.modal-title').text("Updating The Information of a Lecturer/Staff");
         $('#ts_nip').val(nip); 
         $('#ts_firstname').val(firstname);
         $('#ts_lastname').val(lastname);
         $('#ts_gender').val(gender);
         $('#ts_role').val(role);
         $('#ts_phone').val(phone);
         $('#ts_email').val(email);
         $('#ts_address').val(address);
         $('#submit').html('Update');
      }

      function inactivate_ts(nip,firstname,lastname)
      {
         var name = lastname + ', ' + firstname;
         $('#modal_rm_cs').modal('show'); // show bootstrap modal
         $('.modal-title').text("Inactivating Confirmation"); 
         $('#confirm').attr('href', 'manage_lecturer_staff/inactivate?nip='+nip);
         $('#alert').html('<center>Are you sure want to inactivate <strong>' + name + '</strong> from Lecturer/Staff list ?</center>');
      }

      function activate_ts(nip,firstname,lastname)
      {
         var name = lastname + ', ' + firstname;
         $('#modal_rm_cs').modal('show'); // show bootstrap modal
         $('.modal-title').text("Activating Confirmation"); 
         $('#confirm').attr('href', 'manage_lecturer_staff/activate?nip='+nip);
         $('#alert').html('<center>Are you sure want to activate <strong>' + name + '</strong> as a Lecturer/Staff ?</center>');
      }
</script>

<div class="modal fade" id="modal_rm_cs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                  <p id="alert"></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <a id="confirm" class="btn btn-default btn-flat">Yes, I am</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<div class="modal fade" id="modal_create_cs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                <form id="form_add_up" role="form" action="" method="post">
                  <div class="box-body">
                    <div id="div_acc" class="form-group">
                      <label>ID Number</label>
                      <input type="number" onkeyup="check_acc(this);" class="form-control" id="ts_nip" name="ts_nip" placeholder="Enter ID number" maxlength="20" required>
                    </div>
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" class="form-control" id="ts_firstname" name="ts_firstname" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" id="ts_lastname" name="ts_lastname" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control" id="ts_gender" name="ts_gender" required>
                          <option value="M">Male</option>
                          <option value="F">Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Role</label>
                      <select class="form-control" id="ts_role" name="ts_role" required>
                          <option value="1">Dean/Lecturer</option>
                          <option value="2">HoP/Lecturer</option>
                          <option value="3">Lecturer</option>
                          <option value="4">Secretary</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Phone</label>
                      <input type="text" class="form-control" id="ts_phone" name="ts_phone" placeholder="Enter phone number" required>
                    </div>

                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" id="ts_email" name="ts_email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                      <textarea type="text" class="form-control" id="ts_address" name="ts_address" placeholder="Enter address" required></textarea>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
                <button type="submit" id="submit" class="btn btn-primary btn-flat"></button>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

