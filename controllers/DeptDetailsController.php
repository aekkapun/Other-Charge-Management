<?php

namespace app\controllers;

use Yii;
use app\models\DeptDetails;
use app\models\DeptDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DeptDetailsController implements the CRUD actions for DeptDetails model.
 */
class DeptDetailsController extends Controller
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
     * Lists all DeptDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeptDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionUserindex()
    {
        
       $searchModel = new DeptDetailsSearch();
       $searchModel->dept_id = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('userindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    

    /**
     * Displays a single DeptDetails model.
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
     * Creates a new DeptDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DeptDetails();
        $names = Yii::$app->user->identity->id;
        $model->dept_id = Yii::$app->user->identity->id;
        $model->dep_email = Yii::$app->user->identity->email;
        $model->ip = Yii::$app->request->userIP;
        $rowf=(new \yii\db\Query())
            ->select('*')
            ->from('profile') 
            ->where(['user_id'=>Yii::$app->user->identity->id])
            ->all();
        $model->dep_name = $rowf[0]['full_name'];
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $rowe=(new \yii\db\Query())
                    ->select('*')
                    ->from('dept_details') 
                    ->where(['dep_name'=>$model->dep_name])
                    ->all(); 
                if($rowe){
                     Yii::$app->session->setFlash('contactFormSubmitted');
                     return $this->refresh();
                }
            else{

            $model->dep_hod_photo = UploadedFile::getInstance($model, 'dep_hod_photo');
            $model->dep_hod_photo->saveAs('uploads/'.'hod'.$names.'.'.$model->dep_hod_photo->extension);
            $model->dep_hod_photo = 'uploads/'.'hod'.$names.'.'.$model->dep_hod_photo->extension;
           
            
            $model->dep_logo = UploadedFile::getInstance($model, 'dep_logo');
            $model->dep_logo->saveAs('uploads/'.'logo'.$names.'.'.$model->dep_logo->extension);
            $model->dep_logo = 'uploads/'.'logo'.$names.'.'.$model->dep_logo->extension; 
           
         
            $model->dep_bulletin = UploadedFile::getInstance($model, 'dep_bulletin');
            $model->dep_bulletin->saveAs('uploads/'.'bull'.$names.'.'.$model->dep_bulletin->extension);
            $model->dep_bulletin = 'uploads/'.'bull'.$names.'.'.$model->dep_bulletin->extension;
            
            $model->save();
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        } 
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        }
    
    

    /**
     * Updates an existing DeptDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id);
        $names = Yii::$app->user->identity->id;
        $logo = $model->dep_logo;
        $photo = $model->dep_hod_photo;
        $bull = $model->dep_bulletin;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->dep_hod_photo = UploadedFile::getInstance($model, 'dep_hod_photo');
            if(empty($model->dep_hod_photo)){
                $model->dep_hod_photo =  $photo;
                // var_dump($model);die;
            }
            else{
           
            $model->dep_hod_photo->saveAs('uploads/'.'hod'.$names.'.'.$model->dep_hod_photo->extension);
            $model->dep_hod_photo = 'uploads/'.'hod'.$names.'.'.$model->dep_hod_photo->extension;
            // var_dump($model->dep_hod_photo);die;
            }
            
            $model->dep_logo = UploadedFile::getInstance($model, 'dep_logo');
            if(empty($model->dep_logo)){
                $model->dep_logo =  $logo;
                // var_dump($model);die;
            }
            else{
            $model->dep_logo->saveAs('uploads/'.'logo'.$names.'.'.$model->dep_logo->extension);
            $model->dep_logo = 'uploads/'.'logo'.$names.'.'.$model->dep_logo->extension; 
            }
         
            $model->dep_bulletin = UploadedFile::getInstance($model, 'dep_bulletin');
            if(empty($model->dep_bulletin)){
                $model->dep_bulletin =  $bull;
                // var_dump($model);die;
            }
            else{
            $model->dep_bulletin->saveAs('uploads/'.'bull'.$names.'.'.$model->dep_bulletin->extension);
            $model->dep_bulletin = 'uploads/'.'bull'.$names.'.'.$model->dep_bulletin->extension;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DeptDetails model.
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
     * Finds the DeptDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DeptDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DeptDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
