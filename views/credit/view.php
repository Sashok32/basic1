<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Credit */

$params = json_decode($model->params, true);
?>
<h2>Информация о займе:</h2>
<?php if (!empty($model)): ?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Дата займа</th>
        <th scope="col">Сумма займа</th>
        <th scope="col">Месяцы</th>
        <th scope="col">Процентная ставка за год</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=$model->start_date?></td>
            <td><?=$model->body_sum?></td>
            <td><?=$model->month?></td>
            <td><?=$model->rate?></td>
        </tr>
    </tbody>
</table>
<?php endif;?>


<table class="table table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">№</th>
        <th scope="col">Дата платежа</th>
        <th scope="col">Сумма платежа</th>
        <th scope="col">Проценты</th>
        <th scope="col">Основной долг</th>
        <th scope="col">Остаток долга</th>
    </tr>
    </thead>

    <?php if (!empty($params)): ?>
    <tbody>
        <?php foreach ($params as $cred): ?>
            <tr>
                <th scope="row"><?=$cred['num']?></th>
                <td><?=$cred['date']?></td>
                <td><?=$cred['month_base']?></td>
                <td><?=$cred['month_percent']?></td>
                <td><?=$cred['month_body']?></td>
                <td><?=$cred['leave_body']?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <?php endif;?>
</table>