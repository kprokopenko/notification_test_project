<?php

use app\models\Notification;
use yii\bootstrap\Html;

/* @var $model Notification */

?>
<div class="alert <?= $model->reviewed ? 'alert-info' : 'alert-success' ?>">
    <?php if (!$model->reviewed) { ?>
        <button type="button" class="close notification-review" data-id="<?= $model->id ?>">&times;</button>
    <?php } ?>

    <h4><?= Html::encode($model->subject) ?></h4>
    <h6>[<?= Yii::$app->formatter->asDatetime($model->created_at) ?>] от <?= Html::encode($model->from) ?></h6>
    <?= Html::encode($model->body) ?>
</div>
