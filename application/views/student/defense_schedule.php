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
    <?php if(!$check_sub){?>
    <div class="alert alert-warning">
      <h4> Not yet!</h4>
      Please go to <a href="<?php echo site_url('student/rp_submission');?>">Topic's Submission</a> for submitting your topic, title, and description about your research.
    </div>
    <?php }else{?>
      <?php if($check_sub->tt_approval==0){?>
      <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-info"></i>Waiting for approval</h4>
          The submission was delivered. Wait until the commitee inform the result.

      </div>
      <?php }?>

      <?php if($check_sub->tt_approval==1 && $check_sub->tt_correct==1){?>
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-info"></i> Need some correction</h4>
          There are some ineptness on your submission or has been conducted by another students. You are required to correct or issue another topic by go to <a href="<?php echo site_url('student/rp_submission');?>">Topic's Submission</a>.

      </div>
      <?php }?>

      <?php if($check_sub->tt_approval==1 && $check_sub->tt_correct==0){?>
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-info"></i> Waiting for approval</h4>
          The re-submission was delivered. Wait until the commitee inform the result.
      </div>
      <?php }?>
      <!-- Default box -->
      <?php if($check_sub->tt_approval==2){?>
      <?php if(!$schedule){?>
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-info"></i> Not Scheduled</h4>
          The defense schedule is not yet set for your research project.
      </div>
      <?php }else{?>
      <div class="box box-success">
        <div class="box-header with-border">
          <div>
            <small>
            <font color="green"> Scheduled</font><br>
              <?php echo 'On '.date('D d, F Y',strtotime($schedule->ds_date)).' At '.date('h.i',strtotime($schedule->ds_time)).' WITA, ';?>
              <?php switch($schedule->ds_room){
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
            <small>Advised by <strong><?php echo ($schedule->ts_gender=="M"?"Mr. ":"Mrs./Ms./Miss "); echo $schedule->ts_fullname;?></strong></small>
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
          <h3 class="box-title"><?php echo $schedule->at_title;?></h3>
          <u><i><?php echo $schedule->at_topic;?></i></u>
        </div>
        <div class="box-body">
          <p><?php echo $schedule->at_desc;?></p>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <div class="pull-left">
          <small>
            <?php $this->load->model('M_hop');$approved_pan = $this->M_hop->get_the_pan($schedule->at_id);foreach ($approved_pan as $value) {?>
            <?php if($value->pan_type==1){ echo 'Panelist 1: '.($value->ts_gender=='M'?'Mr. ':'Mrs./Ms./Miss ').$value->ts_lastname.', '.$value->ts_firstname.'<br>';}?>
            <?php if($value->pan_type==2){ echo 'Panelist 2: '.($value->ts_gender=='M'?'Mr. ':'Mrs./Ms./Miss ').$value->ts_lastname.', '.$value->ts_firstname.'<br>';}?>
            <?php }?>
          </small>
                    
        </div>
        </div>
        <!-- /.box-footer-->
      </div>
      <?php }?>
      <?php }?>
      <!-- /.box -->
    <?php }?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php $this->load->view('foot');?>