<?php

use app\models\Notification;
use yii\bootstrap\Html;

/* @var $model Notification */

?>
<button type="button" class="close" data-id="<?= $model->id ?>">&times;</button>
<h4><?= Html::encode($model->subject) ?></h4>
<h6>[<?= Yii::$app->formatter->asDatetime($model->created_at) ?>] от <?= Html::encode($model->from) ?></h6>
<?= Html::encode($model->body) ?>

