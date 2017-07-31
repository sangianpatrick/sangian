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

      <?php foreach($submission as $content):?>
      <?php if($content->tt_approval == 1) {?>
      <div class="box box-danger">
      <?php }?>
      <?php if($content->tt_approval == 0) {?>
      <div class="box box-primary">
      <?php }?>
        <div class="box-header with-border">
          <?php if($content->tt_approval == 1 && $content->tt_correct==1){?>
          <div class="">
            <font color="red"><small>Need correction</small></font>
          </div>
          <?php } elseif($content->tt_approval == 1 && $content->tt_correct==0){?>
          <div class="">
            <font color="green"><small>Has been corrected </small></font>
          </div>
          <?php }?>
          <h3 class="box-title"><?php echo $content->tt_title;?></h3>
          <u><i><?php echo $content->tt_topic;?></i></u>

          <div class="box-tools pull-right">
            <small>Submitted by <strong><?php echo $content->stud_fullname;?></strong></small>
            <small>Advised by <strong><?php echo ($content->ts_gender=="M"?"Mr. ":"Mrs./Ms./Miss "); echo $content->ts_fullname;?></strong></small>
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">

          <p><?php echo $content->tt_desc;?></p>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <?php if($content->tt_approval == 1 && $content->tt_correct==1){?>
        <div class="pull-left">
          <small><b><u>Reason of rejection:</u></b></small>
          <small><p><?php echo $content->tt_comment;?></p></small>
        </div>
        <?php } elseif($content->tt_approval == 1 && $content->tt_correct==0){?>
        <div class="pull-left">
          <small><b><u>Reason of rejection:</u></b></small>
          <small><p><?php echo $content->tt_comment;?></p></small>
        </div>
        <?php }?>
        <?php if($content->tt_correct==0){?>
        <div class="pull-right">
          <button class="btn btn-danger btn-flat btn-sm" onclick="decline('<?= $content->tt_id;?>','<?= $content->tt_title;?>','<?= $content->stud_fullname;?>','1');"">Reject</button> <button class="btn btn-primary btn-flat btn-sm" onclick="approve('<?= $content->tt_id;?>','<?= $content->tt_title;?>','<?= $content->stud_fullname;?>','2');">Approve</button>
        </div>
        <?php }?>
        </div>
        <!-- /.box-footer-->
      </div>
      <?php endforeach;?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php $this->load->view('foot');?>

<script type="text/javascript">
  function decline(id,title,by,act)
  {
     $('#form_add_up')[0].reset();
     $('#form_add_up').get(0).setAttribute('action', 'submission?id=' + id + '&action=' + act);
     $('#modal_create_cs').modal('show'); 
     $('#title').html('Are you sure want to decline a submission with title <strong>"'+ title +'"</strong> ?');
     // show boostudtrap modal
     $('#submit').html("Yes").prop('class','btn btn-danger btn-flat');
     $('.modal-title').text("Confirmation");
  }

  function approve(id,title,by,act)
  {
     $('#form_add_up')[0].reset();
     $('#form_add_up').get(0).setAttribute('action', 'submission?id=' + id + '&action=' + act);
     $('#modal_create_cs').modal('show'); 
     $('#title').html('Are you sure want to approve a submission with title <strong>"'+ title +'"</strong> ?');
     // show boostudtrap modal
     $('#submit').html("Yes").prop('class','btn btn-primary btn-flat');
     $('.modal-title').text("Confirmation");
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
                    <p id="title"></p>
                    <form id="form_add_up" role="form" action="" method="post">
                        <div class="form-group">
                          <label>Comment</label>
                          <textarea type="text" class="form-control" id="tt_comment" name="tt_comment" placeholder="Give a comment" required></textarea>
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