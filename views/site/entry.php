<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\EntryForm */

use yii\widgets\ActiveForm;
use \yii\helpers\Html;

$this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, framework, php, test']);  // just for example
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->label('Ваше имя'); ?>
    <?= $form->field($model, 'email')->label('Ваша почта'); ?>
    <?= $form->field($model, 'imgFile')->fileInput()->label('Загрузите файл'); ?>


    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']); ?>
    </div>

<?php ActiveForm::end(); ?>
