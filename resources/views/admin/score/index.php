<?php $view->layout() ?>

<div class="page-header">
  <h1>
    积分管理
  </h1>
</div>
<!-- /.page-header -->

<div class="row">

  <div class="col-12">
    <!-- PAGE detail BEGINS -->
    <form id="score-form" class="form-horizontal" method="post" role="form" action="<?= $url('admin/score/send') ?>">


      <div class="form-group">
        <label class="col-lg-2 control-label" for="score">
          <span class="text-warning">*</span>
          分数值
        </label>

        <div class="col-lg-4">
          <input type="text" class="form-control" name="score" id="score">
        </div>
      </div>


      <div class="form-group">
        <label class="col-lg-2 control-label" for="remark">
          备注
        </label>

        <div class="col-lg-4">
          <input type="text" class="form-control" name="remark" id="remark">
        </div>
      </div>

      <input type="hidden" class="form-control" name="userlist" id="userlist" value="<?= $req['userlist'] ?>">

      <div class="clearfix form-actions form-group">
        <div class="offset-lg-2">
          <button class="btn btn-primary" type="submit">
            <i class="fa fa-check bigger-110"></i>
            提交
          </button>
          &nbsp; &nbsp; &nbsp;
          <a class="btn btn-secondary" href="<?= $url('admin/user/index') ?>">
            <i class="fa fa-undo bigger-110"></i>
            返回列表
          </a>
        </div>
      </div>

    </form>
  </div>
  <!-- PAGE detail ENDS -->
</div><!-- /.col -->
<!-- /.row -->

<?= $block->js() ?>
<script>
  require(['form', 'ueditor'], function () {
    $('#score-form')
      .ajaxForm({
        dataType: 'json',
        success: function (result) {
          $.msg(result, function () {
            if (result.code > 0) {
              window.location = $.url('admin/user/index');
            }
          });
        }
      });
  });
</script>
<?= $block->end() ?>
