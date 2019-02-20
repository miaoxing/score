<?php

$view->layout();
?>

<?= $block->css() ?>
<link rel="stylesheet" href="<?= $asset('assets/admin/stat.css') ?>">
<?= $block->end() ?>

<?= $block('header-actions') ?>
<a class="btn btn-default" href="<?= $url('admin/sources') ?>">返回列表</a>
<?= $block->end() ?>

<div class="row">
  <div class="col-12">

    <div class="well well-sm">
      <form class="js-chart-form form-inline">
        <div class="form-group">
          <label class="control-label" for="start-date">月份范围</label>
          <input type="text" class="js-start-month form-control text-center" id="start-date" name="start_date"
            value="<?= $startMonth ?>">
          ~
          <input type="text" class="js-end-month form-control text-center" name="end_date" value="<?= $endMonth ?>">
        </div>
      </form>
    </div>

    <h5 class="stat-title">趋势图</h5>

    <ul class="js-chart-tabs nav tab-underline">
      <li role="presentation" class="nav-item">
        <a class="nav-link active" href="#score" aria-controls="score" role="tab" data-toggle="tab">积分变动</a>
      </li>
    </ul>
    <div class="tab-content mt-3 border-0">
      <div role="tabpanel" class="js-chart-pane tab-pane text-center active" id="score">
        加载中...
      </div>
    </div>

    <hr>

    <h5 class="stat-title">详细数据</h5>

    <table class="js-stat-table table table-center table-head-bordered">
      <thead>
      <tr>
        <th>月份</th>
        <th>增加积分</th>
        <th>减少积分</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

  </div>
  <!-- /col -->
</div>
<!-- /row -->

<?= $block->js() ?>
<script>
  require([
    'plugins/stat/js/stat',
    'plugins/stat/js/highcharts',
    'form',
    'jquery-unparam',
    'plugins/admin/js/data-table',
    'comps/bootstrap-datepicker/js/bootstrap-datepicker.min',
    'css!comps/bootstrap-datepicker/css/bootstrap-datepicker3.min'
  ], function (stat) {
    require(['comps/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min'], function () {
      // 渲染底部表格
      var $statTable = $('.js-stat-table').dataTable({
        dom: 't',
        ajax: null,
        processing: false,
        serverSide: false,
        displayLength: 99999,
        columnDefs: [{
          targets: ['_all'],
          sortable: true
        }],
        columns: [
          {
            data: 'stat_month'
          },
          {
            data: 'add_score'
          },
          {
            data: 'sub_score'
          }
        ]
      });

      // 所有图表的配置
      var charts = [
        {
          id: 'score',
          series: [
            {
              name: '增加积分',
              dataSource: 'add_score'
            },
            {
              name: '减少积分',
              dataSource: 'sub_score'
            }
          ],
          xAxis: {
            categoriesSource: 'stat_month'
          }
        }
      ];

      var $form = $('.js-chart-form');

      function render() {
        $.ajax({
          url: $.queryUrl('admin/score-monthly-stats.json'),
          dataType: 'json',
          data: $form.serializeArray(),
          success: function (ret) {
            if (ret.code !== 1) {
              $.msg(ret);
              return;
            }

            stat.renderChart({
              charts: charts,
              data: ret.data
            });
            $statTable.fnClearTable();
            $statTable.fnAddData(ret.data);
          }
        });
      }

      render();

      // 更新表单时,重新渲染
      $form.update(function () {
        render();
      });

      // 月份范围选择
      var startDate = new Date();
      var endDate = new Date();

      $('.js-start-month').datepicker({
        autoclose: true,
        minViewMode: 'months',
        format: 'yyyy-mm',
        language: 'zh-CN'
      }).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.js-end-month').datepicker('setStartDate', startDate);
      });

      $('.js-end-month').datepicker({
        autoclose: true,
        minViewMode: 'months',
        format: 'yyyy-mm',
        language: 'zh-CN'
      }).on('changeDate', function(selected){
        endDate = new Date(selected.date.valueOf());
        endDate.setDate(endDate.getDate(new Date(selected.date.valueOf())));
        $('.js-start-month').datepicker('setEndDate', endDate);
      });
    });
  });
</script>
<?= $block->end() ?>
