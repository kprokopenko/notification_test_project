<?php

use app\models\NotificationTemplate;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationTemplate */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('var bodyHints = ' . Json::encode($model->bodyTemplateHints()), View::POS_HEAD);
?>

<div class="notification-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_code')->dropDownList(NotificationTemplate::eventCodes(), [
        'prompt' => 'Выберите код события',
    ]) ?>

    <?= $form->field($model, 'from')->textInput() ?>

    <?= $form->field($model, 'to')->dropDownList(NotificationTemplate::toTypes()) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')
        ->textarea(['rows' => 6])
    ?>

    <?= $form->field($model, 'type')->listBox(NotificationTemplate::eventTypes(), ['multiple' => 'true']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
