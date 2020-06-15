<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Credit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-form">

    <?php $form = ActiveForm::begin(['method'=>'POST']); ?>

    <?= $form->field($model, 'start_date')->input('date')->label() ?>

    <?= $form->field($model, 'body_sum')->input('number')->label() ?>

    <?= $form->field($model, 'month')->input('number', ['min'=>1])->label() ?>

    <?= $form->field($model, 'rate')->input('number', ['min'=>1, 'max'=>99])->label() ?>

    <div class="form-group">
        <?= Html::submitButton('Рассчитать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
