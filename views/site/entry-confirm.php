<?php
/* @var $this yii\web\View */
/* @var $model app\models\EntryForm */

use yii\helpers\Html;
?>
<p>Вы ввели следующую информацию:</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Email</label>: <?= Html::encode($model->email) ?></li>
    <li><label>File download</label>: <?= Html::encode($model->imgFile->name) ?></li>
</ul>

<?= Yii::$app->formatter->asImage('@web/uploads/'.$model->imgFile->name, ['width'=>'20%', 'alt'=>'Downloaded file']) ?>
