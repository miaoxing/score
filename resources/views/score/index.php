<?php $view->layout('plugin:layouts/jqm.php') ?>

<?php require $view->getFile('@order/mall/asset-jqm.php') ?>

    <div data-role="content">

        <div class="person-info clearfix">
            <div style="height:50px;line-height:50px;overflow:hidden; margin-left:30px;">
                <span style="font-size:18px;">当前<?= $setting('score.title', '积分') ?>: </span>
                <span style="font-weight:bold;font-size:22px;color:#E54B17;"><?= wei()->score->getScore() ?></span>
            </div>
        </div>
        <div style="margin-top: 15px;" id="scorelist">
            <ul data-role="listview" class="common-list">
                <?php if ($scoreList) :?>
                <?php foreach ($scoreList as $key => $value) :?>
                <li data-icon="false">
                    <div style="position: relative;">
                        <div>
                            <?php if ($value['score'] > 0) :?>
                            <span><img src="<?= $asset('assets/images/score_add.png')?>"/></span>
                            <?php else :?>
                            <span><img src="<?= $asset('assets/images/score_minus.png')?>"/></span>
                            <?php endif;?>
                        </div>
                        <div style="position:absolute; top: 5px; left: 35px;font-size:16px;">
                        <?php if ($value['score'] > 0) :?>
                            赠送<span style="color:#8FD4A8;"><?= $value['score']?></span>
                        <?php else :?>
                        消耗<span style="color:#E54B17;;"><?= abs($value['score'])?></span>
                        <?php endif;?>
                        </div>
                        <div style="position:absolute; top: 5px; right: 25px;font-size:12px;font-weight:normal">
                            <span><?= substr($value['createTime'], 0, 10)?></span>
                        </div>
                    </div>
                </li>
                <?php endforeach;?>
                <?php else :?>
                <li>暂无记录</li>
                <?php endif;?>
            </ul>
        </div>
    </div>
