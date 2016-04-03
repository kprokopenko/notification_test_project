<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Уведомления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin([
        'options' => [
            'id' => 'notification-container'
        ]
    ]); ?>    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
    ]) ?>
<?php Pjax::end(); ?></div>
