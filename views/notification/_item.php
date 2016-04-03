<?php

use app\models\Notification;
use yii\bootstrap\Html;

/* @var $model Notification */

?>
<button type="button" class="close">&times;</button>
<h4><?= Html::encode($model->subject) ?></h4>
<h6>(<?= Yii::$app->formatter->asDatetime($model->created_at) ?>)</h6>
<?= Html::encode($model->body) ?>

