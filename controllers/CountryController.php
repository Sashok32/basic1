<?php

namespace app\controllers;

use app\models\Country;
use yii\web\Controller;
use yii\data\Pagination;

class CountryController extends Controller
{
   public function actionIndex()
   {
       $query = Country::find();

       $pagination = new Pagination([
           'defaultPageSize' => 3,
           'totalCount' => $query->count(),
       ]);

       $countries = $query->orderBy('name')
           ->offset($pagination->offset)
           ->limit($pagination->limit)
           ->all();

       return $this->render('index', [
           'countries' => $countries,
           'pagination' => $pagination,
       ]);
//       echo '<pre>';
//       print_r(\Yii::$app->user);
//       die();
   }
}
