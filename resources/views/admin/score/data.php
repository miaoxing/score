<?php $view->layout() ?>

<div class="page-header">
  <h1>
    积分管理
  </h1>
</div>
<!-- /.page-header -->

<div class="well form-well">
  <form class="form-inline" id="search-form">
    <div class="form-group">
      &nbsp;&nbsp;
      <label class="control-label" for="startTime">时间范围</label>
      <input type="text" class="form-control text-center" id="startTime" name="startTime" style="width: 150px" value="<?= $req['startTime'] ?>">
      ~
      <input type="text" class="form-control text-center" id="endTime" name="endTime" style="width: 150px" value="<?= $req['endTime'] ?>">
    </div>
    <div class="form-group">
      <a class="btn btn-primary" id="score-query" href="javascript:;">查询</a>
    </div>
  </form>
</div>
<div id="auth_check"></div>
<div id="dayCount"></div>
<div id="dayCount"></div>

<?= $block('js') ?>
<script>
  require(['highcharts', 'assets/dateTimePicker'], function () {
    var x = [];
    x.push('+的总积分');
    x.push('-的总积分');
    x.push('可用的总积分');
    var authSeriesData = [];
    authSeriesData.push(<?=$addTotal?>);
    authSeriesData.push(<?=$cutTotal?>);
    authSeriesData.push(<?=$addTotal - $cutTotal?>);
    var xAuthSeries = [{
      name: "分",
      marker: {
        symbol: 'square'
      },
      data: authSeriesData
    }];
    drawColumn("auth_check", 800, 300, "积分增加消耗情况", x, xAuthSeries);

    var X = <?=json_encode($date)?>;
    var Y = [
      {name: '增加积分', data: <?=json_encode($addArray)?>},
      {name: '消耗积分', data: <?=json_encode($cutArray)?>}
    ];
    drawLine('dayCount', X, Y);

    $('#startTime, #endTime').rangeDateTimePicker({
      showSecond: true,
      dateFormat: 'yy-mm-dd',
      timeFormat: 'HH:mm:ss'
    });

    $('#score-query').click(function () {
      window.location.href = $.url('admin/score/data?startTime=' + $('#startTime').val() + '&endTime=' + $('#endTime').val());
    });
  });
</script>
<?= $block->end() ?>
