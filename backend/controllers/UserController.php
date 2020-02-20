<?php

namespace backend\controllers;


use Yii;
use common\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AuthItem;
use backend\models\Regioes;
use backend\models\UserRegioes;
use backend\models\AuthAssignment;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/**
 * UserController implements the CRUD actions for user model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all user models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = User::find();
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model, 
        ]);
    }

    /**
     * Displays a single user model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpdatephoto($id) {

        $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {

                $model->photo=UploadedFile::getInstance($model,'photo');
                if($model->photo != NULL){
                    $model->photo->saveAs( 'uploads/'.$model->photo->baseName.'.'.$model->photo->extension);
                    $model->photo = 'uploads/'.$model->photo->baseName.'.'.$model->photo->extension;
                }
            $model->save(False);
            Yii::$app->session->setFlash('success', 'Foto Atualizada com sucesso!');
            return $this->redirect(['index']);

        }
        return $this->render('updatePhoto', [
                'model' => $model,

            ]);
    }
    /**
     * Creates a new user model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $regioes = new Regioes();
        $regiao = $regioes->getRegioes();
        $userRegiao = new UserRegioes();

        $user_id = \Yii::$app->user->identity->id;
       
        if ($model->load(Yii::$app->request->post())) { 

            $userName = $_POST['User']['username'];
            $name = $_POST['User']['name'];
            $email = $_POST['User']['email'];
            $papel = $_POST['User']['role_id'];
           
            $coordenacao = $_POST['User']['coordenacao_id'];
            if ($papel != 1 || $coordenacao != 3) {
                $regions = $_POST['UserRegioes']['regiao_id_regiao'];
            }
            $model->username = $userName;
            $model->name = $name;
            $model->email = $email;
            $model->role_id = $papel;
            $model->coordenacao_id = $coordenacao;

            
            if ($model->photo){
                $imageName = date('Y-m-d s');
                $model->photo = UploadedFIle::getInstance($model, 'photo');   
                $model->photo->saveAs('image/'. $imageName . '.' . $model->photo->extension);

                $model->photo = 'image/'. $imageName . '.' . $model->photo->extension;

            } else {
                $model->photo = 'image/avatar.png';
            }
            $model->save(false);


            $userRegiao->regiao_id_regiao = $regions;
            $userRegiao->user_id_user = $model->id;
            $userRegiao->save();

            // foreach ($prof as $value) {
            //     if(AuthItem::findOne($value)!=null){
            //          $role=\Yii::$app->authManager->getRole($value);
            //          \Yii::$app->authManager->assign($role,$model->id);
            //      }
            // }
            
            Yii::$app->session->setFlash('success', 'Utilizador registado com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,'value'=>[], 'region'=> $regiao, 'userRegiao'=>$userRegiao
        ]);
    }

    /**
     * Updates an existing user model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);        
        $regioes = new Regioes();
        $regiao = $regioes->getRegioes();
        $userRegiao = new UserRegioes();
        

        if ($model->load(Yii::$app->request->post())) {
           
            $userName = $_POST['User']['username'];
            $name = $_POST['User']['name'];
            $email = $_POST['User']['email'];
            $papel = $_POST['User']['role_id'];
            $regions = $_POST['UserRegioes']['regiao_id_regiao'];
            $coordenacao = $_POST['User']['coordenacao_id'];

            $model->username = $userName;
            $model->name = $name;
            $model->email = $email;
            $model->role_id = $papel;
            $model->coordenacao_id = $coordenacao;

            if (!$model->photo) {
                $model->photo=UploadedFile::getInstance($model,'photo');
                $model->photo->saveAs( 'uploads/'.$model->photo->baseName.'.'.$model->photo->extension);
                $model->photo = 'uploads/'.$model->photo->baseName.'.'.$model->photo->extension;
            }

            $model->save(false);
           
            if ($model->coordenacao_id != 3) {

                $userRegiao->regiao_id_regiao = $regions;
                $userRegiao->user_id_user = $model->id;
                $userRegiao->save();

            }
            Yii::$app->session->setFlash('success', 'Utilizador atualizado com sucesso!');
            return $this->redirect(['index']);

        }
        $model->password_hash='';

        return $this->renderAjax('update', [
            'model' => $model,
            'value'=>[], 
            'region'=> $regiao, 
            'userRegiao'=>$userRegiao
        ]);
    }

    /**
     * Deletes an existing user model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Utilizador apagado com sucesso com sucesso!');
        return $this->redirect(['index']);
    }

    /**
     * Finds the user model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return user the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = user::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
