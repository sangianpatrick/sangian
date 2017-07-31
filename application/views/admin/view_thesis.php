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
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">All Thesis</h3><br><br>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Thesis Title</th>
                  <th>Conducted by</th>
                  <th>Desc. on Def</th>
                  <th width="">To Correct</th>
                  <th>Points</th>
                  <th>Letter</th>
                  <th>Document</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($all_thesis as $thesis){?>
                <tr>
                  <!-- <td align="center"><label><p style="display: none"><?php echo $value->stud_id;?></p><input id="check" type="checkbox" class="minimal"></label></td> -->
                  <td><i><small><?php echo $thesis->at_topic;?><br></small></i><?php echo $thesis->at_title;?></td>
                  <td><?php echo $thesis->stud_fullname;?></td>
                  <td><?php echo $thesis->dr_desc;?></td>
                  <td width=""><?php echo $thesis->dr_tc;?></td>
                  <td><?php echo (int)$thesis->total/2;?></td>
                  <td>
                  <?php
                    $total = (int)$thesis->total/2;
                    if ($total >= 48 && $total <= 52) {
                      echo "A";
                    }elseif ($total >= 44 && $total <= 47) {
                      echo "A-";
                    }elseif ($total >= 40 && $total <= 43) {
                      echo "B+";
                    }elseif ($total >= 36 && $total <= 39) {
                      echo "B";
                    }elseif ($total >= 32 && $total <= 35) {
                      echo "B-";
                    }elseif ($total >= 28 && $total <= 31) {
                      echo "C+";
                    }elseif ($total >= 24 && $total <= 27) {
                      echo "C";
                    }else{
                      echo "F";
                    }
                  ?>
                  </td>
                  <td><font color="red">Not Yet!</font></td>
                  <td><button class="btn btn-default btn-sm"><i class="fa fa-upload"></i> Upload</button></td>

                </tr>
                <?php }?>
                </tbody>
            </table>

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
