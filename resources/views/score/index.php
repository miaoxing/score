<?php $view->layout('plugin:layouts/jqm.php') ?>

<?= $block('css') ?>
<link rel="stylesheet" href="<?= $asset('plugins/score/css/score.css') ?>"/>
<?= $block->end() ?>

<div data-role="content">
  <div class="person-info clearfix">
    <div class="score-index">
      <span class="score-title">
        当前<?= $setting('score.title', '积分') ?>:
      </span>
      <span class="score-num">
        <?= wei()->score->getScore() ?>
      </span>
    </div>
  </div>

  <div class="score-list">
    <ul data-role="listview" class="common-list">
      <?php if ($scoreList) : ?>
        <?php foreach ($scoreList as $key => $value) : ?>
          <li data-icon="false">
            <div class="score-body">
              <div>
                <?php if ($value['score'] > 0) : ?>
                  <span><img src="<?= $asset('assets/images/score_add.png') ?>"/></span>
                <?php else : ?>
                  <span><img src="<?= $asset('assets/images/score_minus.png') ?>"/></span>
                <?php endif; ?>
              </div>
              <div class="score-body-t">
                <?php if ($value['score'] > 0) : ?>
                  赠送<span class="score-add-c"><?= $value['score'] ?></span>
                <?php else : ?>
                  消耗<span class="score-minus-c"><?= abs($value['score']) ?></span>
                <?php endif; ?>
              </div>
              <div class="score-footer-t">
                <span><?= substr($value['createTime'], 0, 10) ?></span>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      <?php else : ?>
        <li>暂无记录</li>
      <?php endif; ?>
    </ul>
  </div>
</div>
