<?php

namespace app\controllers;

use app\models\Credit;
use Yii;
use app\models\Articles;
use app\models\ArticlesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CreditController implements the create and read actions for Credit model.
 */
class CreditController extends Controller
{
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**
     * Creates a new Credit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Credit();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $unique_id = strtotime($model->start_date) . $model->body_sum . $model->month . $model->rate;
            $unique_id = md5($unique_id);
            if (Credit::findOne(['unique_id' => $unique_id])) {
                return $this->redirect('credit/view?unid='.$unique_id);
            }
            $model->params = $model->calculate();
            $model->unique_id = $unique_id;
            if ($model->save()) {
                return $this->redirect('credit/view?unid='.$unique_id);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Credit model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($unid)
    {
        return $this->render('view', [
            'model' => $this->findModel($unid),
        ]);
    }

    /**
     * @param integer $unid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($unid)
    {
        if (($model = Credit::findOne(['unique_id' => $unid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
