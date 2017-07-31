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

      <?php foreach($scheduled as $pansch):?>
      <div class="box box-success">
        <div class="box-header with-border">
          <div>
            <small>
            <font color="green"> Scheduled</font><br>
              <?php echo 'On '.date('D d, F Y',strtotime($pansch->ds_date)).' At '.date('H.i',strtotime($pansch->ds_time)).' WITA, ';?>
              <?php switch($pansch->ds_room){
                  case '1': echo 'GK1-206';
                  break;
                  case '2': echo 'GK1-207';
                  break;
                  case '1': echo 'GK2-Demo Lab.';
                  break;
              }?>
            </small>
          </div>
          <div class="box-tools pull-right">
            <small>Submitted by <strong><?php echo $pansch->stud_fullname;?></strong></small>
            <small>Advised by <strong><?php echo ($pansch->ts_gender=="M"?"Mr. ":"Mrs./Ms./Miss "); echo $pansch->ts_fullname;?></strong></small>
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
          <h3 class="box-title"><?php echo $pansch->at_title;?></h3>
          <u><i><?php echo $pansch->at_topic;?></i></u>
        </div>
        <div class="box-body">
          <p><?php echo $pansch->at_desc;?></p>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <?php if ($_SESSION['sess_role'] != 4):?>
        <div class="pull-right">
          <?php if($pansch->ds_scoring_sess==0):?>
          <h4><font color="orange"></font>Scoring Session is not opened yet.</h4>
          <?php elseif($pansch->ds_scoring_sess==1):?>
          <a class="btn btn-warning btn-flat btn-sm" href="<?php echo site_url('lecturer/research_project/scoring_form?tid=').$pansch->at_id;?>"> >> Go To Scoring Form!</a>
        <?php else:?>
          <h3><font color="green">Done!</font></h3>
        <?php endif;?>
        </div>
        <?php endif;?>
        </div>
        <!-- /.box-footer-->
      </div>
      <?php endforeach;?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php $this->load->view('foot');?>
