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
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-info"></i>Not yet!</h4>
          You have not submitted the any topics for your Research Project yet. Click the "Compose" button for submission.

      </div>
      <button class="btn btn-info btn-flat" onclick="rp_submission_form();"> Compose</button>
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
          There are some ineptness on your submission or has been conducted by another students. You are required to correct or issue another topic by click  the "Re-compose" button.

      </div>
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Reason of Rejection</h3>
        </div>
        <div class="box-body">
          <p><?php echo $check_sub->tt_comment;?></p>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <div class="pull-right">
          <button class="btn btn-warning btn-flat" onclick="resend_submission('<?php echo $check_sub->tt_id;?>','<?php echo $check_sub->tt_topic;?>','<?php echo $check_sub->tt_title;?>');"> Re-compose</button>
        </div>
        </div>
        <!-- /.box-footer-->
      </div>

      <?php }?>

      <?php if($check_sub->tt_approval==1 && $check_sub->tt_correct==0){?>
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-info"></i> Waiting for approval</h4>
          The re-submission was delivered. Wait until the commitee inform the result.

      </div>
      <?php }?>

      <?php if($check_sub->tt_approval==2){?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i>Approved</h4>
          Your submission has been approved. Contact your advisor to begin the research. We are looking forward to your progress. 

      </div>
      <?php }?>
      <?php }?>

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php $this->load->view('foot');?>

<script>
function rp_submission_form()
  {
     $('#form_add_up')[0].reset();
     $('#form_add_up').get(0).setAttribute('action', 'rp_submission/send');
     $('#modal_create_cs').modal('show'); // show boostudtrap modal
     $('#submit').html("Send");
     $('.modal-title').text("Submission Form");
  }

  function resend_submission(id,topic,title)
  {
     $('#form_add_up')[0].reset();
     $('#form_add_up').get(0).setAttribute('action', 'rp_submission/resend?id=' + id);
     $('#modal_create_cs').modal('show'); // show boostudtrap modal
     $('#submit').html("Resend");
     $('.modal-title').text("Submission Form");
     $('#tt_topic').val(topic);
     $('#tt_title').val(title);
     $('#tt_advisoryl,#tt_advisory').remove();

  }
</script>

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
                        <div class="form-group">
                          <label>Topic</label>
                          <input type="text" class="form-control" id="tt_topic" name="tt_topic" placeholder="Enter the topic" required>
                        </div>
                          <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="tt_title" name="tt_title" placeholder="Enter the title" required>
                          </div>
                          <div class="form-group">
                            <label>Desc.</label>
                            <textarea type="text" class="form-control" id="tt_desc" name="tt_desc" placeholder="Enter the description" required></textarea>
                          </div>
                          <div class="form-group">
                            <label id="tt_advisoryl">Advisor</label>
                            <select class="form-control" id="tt_advisory" name="tt_advisory" required>
                                <?php foreach($lecturer as $advisor){?>
                                <option value="<?php echo $advisor->ts_nip; ?>"> <?php echo($advisor->ts_gender=='M'?'Mr. ':'Mrs/Ms. '); echo $advisor->ts_lastname.', '.$advisor->ts_firstname; ?></option>
                                <?php }?>
                            </select>
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
