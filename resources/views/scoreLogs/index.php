<?php

use Miaoxing\Score\Service\ScoreLogRecord;

$view->layout();
?>

<?= $block->css() ?>
<link rel="stylesheet" href="<?= $asset('plugins/score/css/scores.css') ?>">
<?= $block->end() ?>

<div class="bg-light border-bottom p-4 text-center mb-2">
  <i class="score-icon ni ni-coins bg-primary mr-2"> </i>
  当前<?= $setting('score.title', '积分') ?>
  <span class="score-num text-primary ml-2"><?= wei()->score->getScore() ?></span>
</div>

<ul class="js-score-log-list list list-indented">
</ul>

<script type="text/html" class="js-score-log-item-tpl">
  <li class="list-item">
    <h4 class="list-heading">
      <%= description %>
      <span class="pull-right">
        <span class="text-<%= action == <?= ScoreLogRecord::ACTION_ADD ?> ? 'success' : 'danger' %>">
          <%= action == <?= ScoreLogRecord::ACTION_ADD ?> ? '+' : '-' %><%= score %>
        </span>
      </span>
    </h4>
    <div class="list-body">
      <%= created_at.substr(0, 16) %>
    </div>
  </li>
</script>

<?= $block->js() ?>
<script>
  require(['comps/artTemplate/template.min'], function () {
    template.helper('$', $);

    var list = $('.js-score-log-list').list({
      url: '<?= $url->query('score-logs.json') ?>',
      template: template.compile($('.js-score-log-item-tpl').html()),
      localData: <?= json_encode($ret) ?>
    });
  });
</script>
<?= $block->end() ?>
