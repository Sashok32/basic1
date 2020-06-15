<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $countries \app\models\Country */
/* @var $pagination \yii\data\Pagination */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Country';
$this->params['breadcrumbs'][] = $this->title;
//echo \yii\helpers\Url::to(['articles/index', 'id' => 100, '#' => 'content'], 'https');  // example

?>
<h1>Countries</h1>

<ul>
    <?php foreach ($countries as $country): ?>
        <li>
            <?= Html::encode("{$country->code} {$country->name}") ?>:
            <?= $country->population ?>
        </li>
    <?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]);