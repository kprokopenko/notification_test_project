<?php

use app\models\NotificationTemplate;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationTemplate */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны уведомлений', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-template-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'event_code',
            'from',
            [
                'attribute' => 'to',
                'value' => NotificationTemplate::toTypes()[$model->to],
            ],
            'subject',
            'body:ntext',
            [
                'attribute' => 'type',
                'value' => implode(PHP_EOL, $model->type),
                'format' => 'ntext',
            ]
        ],
    ]) ?>

</div>
