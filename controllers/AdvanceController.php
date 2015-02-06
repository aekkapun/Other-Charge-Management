<?php

namespace app\controllers;

use Yii;
use app\models\Advance;
use app\models\SearchAdvance;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdvanceController implements the CRUD actions for Advance model.
 */
class AdvanceController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Advance models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( Yii::$app->user->can("admin")){
        $searchModel = new SearchAdvance();
        $searchModel->year = $this->yr();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
        else{
        throw new \yii\web\ForbiddenHttpException("You are not allowed to perform this action.");
    }
    }

    public function actionUserindex()
    {
        $searchModel = new SearchAdvance();
         $searchModel->year = $this->yr();
         $searchModel->dep_id = Yii::$app->user->identity->id;
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 

        return $this->render('userindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Advance model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Advance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Advance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Advance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Advance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Advance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Advance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
              protected function yr(){
            $mon = date("m");
            if($mon < 04){
                $pyr = date("Y");
                $pyr = $pyr-1;
                $cyr = date("y");
                $year = $pyr.'-'.$cyr;
                return $year;
                //echo $year;
            }
            else{
                $pyr = date("Y");
                $cyr = date("y");
                $cyr = $cyr +1;
                $year = $pyr.'-'.$cyr;
                return $year;
                //echo $year;

            }
          }
}
