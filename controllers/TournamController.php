<?php

namespace app\controllers;

use app\models\Results;
use yii\rest\ActiveController;
use yii\rest\Controller;

//class TournamController extends ActiveController

class TournamController extends Controller
{

//    public $modelClass = 'app\models\Result';

    public function actionResults($tour = null)
    {
        return Results::find()->filterWhere(['tour'=>$tour])->all();
    }

    public function actionTable($tour = null)
    {
        return (new Results())->tabletour($tour);
    }
}
