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
      <?php if ($_SESSION['sess_role'] == 2):?>
      <?php foreach($unscheduled as $unsch_content):?>
      <div class="box box-warning">
        <div class="box-header with-border">
          <div>
            <font color="orange"> <small> Not Scheduled</small></font>
          </div>
          <div class="box-tools pull-right">
            <small>Submitted by <strong><?php echo $unsch_content->stud_fullname;?></strong></small>
            <small>Advised by <strong><?php echo ($unsch_content->ts_gender=="M"?"Mr. ":"Mrs./Ms./Miss "); echo $unsch_content->ts_fullname;?></strong></small>
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
          <h3 class="box-title"><?php echo $unsch_content->at_title;?></h3>
          <u><i><?php echo $unsch_content->at_topic;?></i></u>
        </div>
        <div class="box-body">
          <p><?php echo $unsch_content->at_desc;?></p>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <div class="pull-left">
        </div>
        <div class="pull-left">
        </div>

        <div class="pull-right">
          <button class="btn btn-primary btn-flat btn-sm" onclick="schedule_it('<?php echo $unsch_content->at_id;?>','<?php echo $unsch_content->at_title;?>','<?php echo $unsch_content->stud_fullname;?>','<?php echo $unsch_content->ts_fullname;?>');">Schedule it</button>
        </div>
        </div>
        <!-- /.box-footer-->
      </div>
      <?php endforeach;?>
      <?php endif;?>
      <?php foreach($scheduled as $sch_content):?>
      <div class="box box-success">
        <div class="box-header with-border">
          <div>
            <small>
            <font color="green"> Scheduled</font><br>
              <?php echo 'On '.date('D d, F Y',strtotime($sch_content->ds_date)).' At '.date('H.i',strtotime($sch_content->ds_time)).' WITA, ';?>
              <?php switch($sch_content->ds_room){
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
            <small>Submitted by <strong><?php echo $sch_content->stud_fullname;?></strong></small>
            <small>Advised by <strong><?php echo ($sch_content->ts_gender=="M"?"Mr. ":"Mrs./Ms./Miss "); echo $sch_content->ts_fullname;?></strong></small>
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
          <h3 class="box-title"><?php echo $sch_content->at_title;?></h3>
          <u><i><?php echo $sch_content->at_topic;?></i></u>
        </div>
        <div class="box-body">
          <p><?php echo $sch_content->at_desc;?></p>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <?php if ($_SESSION['sess_role'] == 1):?>
        <div class="pull-right">
          <?php if($sch_content->ds_scoring_sess==0):?>
          <button class="btn btn-primary btn-flat btn-sm" onclick="scoring_session('<?= $sch_content->ds_id;?>','<?= $sch_content->at_title;?>','1');"> Open Scoring Session</button>
          <?php elseif($sch_content->ds_scoring_sess==1):?>
          <button class="btn btn-warning btn-flat btn-sm" onclick="scoring_session('<?= $sch_content->ds_id;?>','<?= $sch_content->at_title;?>','0');"> Close Scoring Session</button>
        <?php else:?>
          <h3><font color="green">Done!</font></h2>
        <?php endif;?>
        </div>
        <?php endif;?>
        <div class="pull-left">
          <small>
            <?php $this->load->model('M_hop');$approved_pan = $this->M_hop->get_the_pan($sch_content->at_id);foreach ($approved_pan as $value) {?>
            <?php if($value->pan_type==1){ echo 'Panelist 1: '.($value->ts_gender=='M'?'Mr. ':'Mrs./Ms./Miss ').$value->ts_lastname.', '.$value->ts_firstname.'<br>';}?>
            <?php if($value->pan_type==2){ echo 'Panelist 2: '.($value->ts_gender=='M'?'Mr. ':'Mrs./Ms./Miss ').$value->ts_lastname.', '.$value->ts_firstname.'<br>';}?>
            <?php }?>
          </small>

        </div>
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

  function schedule_it(id,title,conby,advby)
  {
     $('#at_title').html(title);
     $('#conby').html(conby);
     $('#advby').html(advby);

     $('#form_add_up')[0].reset();
     $('#form_add_up').get(0).setAttribute('action', 'defense_schedule?action=create&atid=' + id);
     $('#modal_create_cs').modal('show');
     // show boostudtrap modal
     $('#submit').html("Create").prop('class','btn btn-primary btn-flat');
     $('.modal-title').text("Creating Schedule");
     authfield();
  }

  function scoring_session(id,title,type)
  {
       var alrt ='';
       if (type == 1) {
         alrt +="Are you sure want to open the scoring session for ";
       }else if (type == 0) {
         alrt +="Are you sure want to close the scoring session for ";
       }
       $('#modal_score').modal('show');
       $('.modal-title').text("Scoring Session");
       $('#confirm').attr('href', 'scoring_session?type='+type+'&id='+id);
       $('#alert').html('<center>'+ alrt + '<strong>' + title + '</strong> ?</center>');
  }
</script>

<div class="modal fade" id="modal_score" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <a id="confirm" class="btn btn-default btn-flat">Yes</a>
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
                    <div>
                      <i><p id="at_title"></p></i>
                      <small>
                        Conducted by <b id="conby">Patrick Sangian</b>
                        Advised by <b id="advby"></b><br>
                        <p>
                      </small>
                    </div>
                    <form id="form_add_up" role="form" action="" method="post">
                        <div class="form-group">
                          <label>Date</label>
                          <input type="text" class="form-control" onchange="authfield();" id="ds_date" name="ds_date" placeholder="Input the date" required>
                        </div>
                        <div class="form-group">
                          <label>Time</label>
                            <select class="form-control" id="ds_time" onchange="authfield();" name="ds_time">
                              <option value="0">-- Select --</option>
                              <option value="07.00">07.00 WITA</option>
                              <option value="08.00">08.00 WITA</option>
                              <option value="09.00">09.00 WITA</option>
                              <option value="10.00">10.00 WITA</option>
                              <option value="11.00">11.00 WITA</option>
                              <option value="12.00">12.00 WITA</option>
                              <option value="13.00">13.00 WITA</option>
                              <option value="14.00">14.00 WITA</option>
                              <option value="15.00">15.00 WITA</option>
                              <option value="16.00">16.00 WITA</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label>Room</label>
                          <select class="form-control" id="ds_room" onchange="authfield();" name="ds_room">
                              <option value="0">-- Select --</option>
                              <option value="1">GK1-206</option>
                              <option value="2">GK1-207 </option>
                              <option value="3">GK2-Demo Lab.</option>
                            </select>
                        </div>
                        <div class="form-group" id="div_pan1">
                          <label>Panelist 1</label>
                          <select class="form-control" id="ds_panelist1" name="ds_panelist1" onchange="check_pan(this,1);" disabled>
                            <option value="0">-- Select --</option>
                            <?php foreach($panelists as $panelist1) :?>
                            <option value="<?php echo $panelist1->ts_nip;?>"><?php echo ($panelist1->ts_gender=='M'?'Mr. ':'Mrs./Ms./Miss ').$panelist1->ts_lastname.', '.$panelist1->ts_firstname;?></option>
                            <?php endforeach;?>
                          </select>
                        </div>
                        <div class="form-group" id="div_pan2">
                          <label>Panelist 2</label>
                          <select class="form-control" id="ds_panelist2" name="ds_panelist2" onchange="check_pan(this,2);" disabled>
                            <option value="0">-- Select --</option>
                            <?php foreach($panelists as $panelist1) :?>
                            <option value="<?php echo $panelist1->ts_nip;?>"><?php echo ($panelist1->ts_gender=='M'?'Mr. ':'Mrs./Ms./Miss ').$panelist1->ts_lastname.', '.$panelist1->ts_firstname;?></option>
                            <?php endforeach;?>
                          </select>
                        </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
                <button type="submit" id="submit" class="btn btn-primary btn-flat" disabled></button>
                  </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

  <script type="text/javascript">
  $('#ds_date').datepicker({
      autoclose: true,
      startDate: '+1d',
      format: 'yyyy-mm-dd'
  });

  function authfield(){
    var date = $('#ds_date').val().length;
    var time = $('#ds_time').val();
    var room = $('#ds_room').val();
    var pan1 = $('#ds_panelist1').val();
    var pan2 = $('#ds_panelist2').val();
    var error_field = $('.has-error').length;

    if (date==0 || time==0 || room==0) {
      $('select').not('#ds_time,#ds_room').prop('disabled','disabled').val('0');
    }else{
      $('select').prop('disabled',false);
      if ((date>0 && time!=0 && room!=0 && pan1!=0 && pan2!=0) && error_field==0) {
          $('#submit').prop('disabled', false);
      };
    };



  }

  function check_pan(pan,type)
      {
        var date = $('#ds_date').val();
        var time = $('#ds_time').val();


                $.ajax({
                url: "<?php echo site_url('lecturer/research_project/check_panelist');?>",
                data: {
                        pan: pan.value,
                        date: date,
                        time: time

                      },
                type: "POST",
                dataType: 'json',
                  success:function(data){
                    if (type == 1) {

                        if (data['status']===1) {

                          $('#div_pan1').addClass('has-error');
                            if($('#div_pan1  span').length==0){
                              $('#div_pan1').append('<span class="help-block">This person is listed as panelist. You should try another.</span>');
                            }
                            //$('#acc_number').val('');
                            $('#ds_panelist1').focus();
                            //$('#submit').prop('disabled',true);



                        }else if(data['status']===0){
                          //$('#submit').prop('disabled',false);
                          if($('#div_pan1').hasClass('has-error')){
                            $('#div_pan1').removeClass('has-error');
                            $('#div_pan1 span').remove();
                          };
                          alert("Available");
                        };
                    }else if(type == 2){
                        if (data['status']===1) {
                          $('#div_pan2').addClass('has-error');
                            if($('#div_pan2  span').length==0){
                              $('#div_pan2').append('<span class="help-block">This person is listed as panelist. You should try another.</span>');
                            }
                            //$('#acc_number').val('');
                            $('#ds_panelist2').focus();
                            //$('#submit').prop('disabled',true);



                        }else if(data['status']===0){
                          //$('#submit').prop('disabled',false);
                          if($('#div_pan2').hasClass('has-error')){
                            $('#div_pan2').removeClass('has-error');
                            $('#div_pan2 span').remove();
                          };
                          alert("Available");
                        };
                    };
                    authfield();


                  },
                  error: function(ts) { alert(ts.responseText) }
          });
      }
</script>
