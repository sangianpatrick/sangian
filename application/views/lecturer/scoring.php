<?php $this->load->view('head');?>
<?php foreach($cntnt as $content):?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $page;?> <small> for Panelist <?php echo $content->pan_type;?></small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $content->at_title;?></h3>
        <u><i><?php echo $content->at_topic;?></i></u>

        <div class="box-tools pull-right">
          <small>Submitted by <strong><?php echo $content->stud_fullname;?></strong></small>
          <small>Advised by <strong><?php echo ($content->ts_gender=="M"?"Mr. ":"Mrs./Ms./Miss "); echo $content->ts_fullname;?></strong></small>
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <form id="scoring_form" role="form" action="<?php echo site_url('lecturer/research_project/calculate?acceptance=1&tid=').$content->at_id.'&pantype='.$content->pan_type;?>" method="post">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Criteria</th>
              <th>1</th>
              <th>2</th>
              <th>3</th>
              <th>4</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>Judul Penelitian</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="jp" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="jp" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="jp" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="jp" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>2</td>
              <td>Latarbelakang Masalah</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="lb" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="lb" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="lb" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="lb" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>3</td>
              <td>Rumusan Masalah</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="rm" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="rm" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="rm" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="rm" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>4</td>
              <td>Tujuan Penelitian</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="tp" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="tp" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="tp" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="tp" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>5</td>
              <td>Manfaat Penelitian</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="mp" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="mp" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="mp" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="mp" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>6</td>
              <td>Tinjauan Pustaka</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="tip" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="tip" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="tip" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="tip" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>7</td>
              <td>Kerangka Konsep</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="kk" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="kk" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="kk" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="kk" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>8</td>
              <td>Hipotesis</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="hi" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="hi" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="hi" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="hi" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>9</td>
              <td>Metode Penelitian</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="mep" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="mep" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="mep" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="mep" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>10</td>
              <td>Penulisan Daftar Pustaka</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="pdp" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="pdp" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="pdp" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="pdp" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>11</td>
              <td>Presentasi</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="pre" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="pre" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="pre" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="pre" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>12</td>
              <td>Penguasaan Materi</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="pm" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="pm" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="pm" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="pm" value="4" required></td>
              </div>
            </tr>

            <tr>
              <td>13</td>
              <td>Format Penulisan</td>
              <div class="form-group">
              <td><input onclick="empty();" type="radio" name="fp" value="1" required checked></td>
              <td><input onclick="empty();" type="radio" name="fp" value="2" required></td>
              <td><input onclick="empty();" type="radio" name="fp" value="3" required></td>
              <td><input onclick="empty();" type="radio" name="fp" value="4" required></td>
              </div>
            </tr>

            </tbody>
        </table>
        <br>
        <div class="form-group">
          <label> Keterangan</label>
          <input class="form-control" type="text" name="ket" required>
        </div>
        <div class="form-group">
          <label> Rekomendasi</label><br>
          <input onclick="terima();" type="radio" name="reko" value="1" required> Diterima Tanpa Revisi<br>
          <input onclick="terima();" type="radio" name="reko" value="2" required> Diterima Dengan Revisi Minor<br>
          <input onclick="terima();" type="radio" name="reko" value="3" required> Diterima Dengan Revisi Major
        </div>
        <div class="form-group">
          <label> Usulan Perbaikan</label>
          <textarea class="form-control" name="up"></textarea>
        </div>
        <div class="pull-right">
          <a type="button" href="<?php echo site_url('lecturer/research_project/calculate?acceptance=0&tid=').$content->at_id.'&pantype='.$content->pan_type;?>" class="btn btn-danger btn-flat"> Reject</a>
          <button type="submit"  class="btn btn-primary btn-flat"> Submit</button>
        </div>
      </form>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">

      </div>
      <!-- /.box-footer-->
    </div>
    <?php endforeach;?>
  </section>
  <!-- /.content -->
</div>
<?php $this->load->view('foot');?>

<script>
  function empty(){
    $('input[name="reko"]').removeAttr('checked');
  }
  function terima(){
    var jp = $("input[name='jp']:checked").val();
    var jp_int = parseInt(jp);
    var lb = $("input[name='lb']:checked").val();
    var lb_int = parseInt(lb);
    var rm = $("input[name='rm']:checked").val();
    var rm_int = parseInt(rm);
    var tp = $("input[name='tp']:checked").val();
    var tp_int = parseInt(tp);
    var mp = $("input[name='mp']:checked").val();
    var mp_int = parseInt(mp);
    var tip = $("input[name='tip']:checked").val();
    var tip_int = parseInt(tip);
    var kk = $("input[name='kk']:checked").val();
    var kk_int = parseInt(kk);
    var hi = $("input[name='hi']:checked").val();
    var hi_int = parseInt(hi);
    var mep = $("input[name='mep']:checked").val();
    var mep_int = parseInt(mep);
    var pdp = $("input[name='pdp']:checked").val();
    var pdp_int = parseInt(pdp);
    var pre = $("input[name='pre']:checked").val();
    var pre_int = parseInt(pre);
    var pm = $("input[name='pm']:checked").val();
    var pm_int = parseInt(pm);
    var fp = $("input[name='fp']:checked").val();
    var fp_int = parseInt(fp);

    var jml = jp_int+lb_int+rm_int+tp_int+mp_int+tip_int+kk_int+hi_int+mep_int+pdp_int+pre_int+pm_int+fp_int;
    if (jml <= 23) {
      alert("The research is not passed. The points in not good enough. It's must be greater than 23.");
      $('input[name="reko"]').removeAttr('checked');
    }
  }
</script>
