<?php

namespace backend\controllers;

use Yii;
use backend\models\Projetos;
use backend\models\ProjetosSearch;
use backend\models\PedidosSearch;
use backend\models\Pedidos;
use backend\models\HistoricoPedidos;
use backend\models\HistoricoProjetos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * ProjetosController implements the CRUD actions for Projetos model.
 */
class ProjetosController extends Controller
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
     * Lists all Projetos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjetosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projetos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $pedidos = Pedidos::find()->where(['projetos_id_projeto'=>$id])->all();
        $provider = new ArrayDataProvider([
                'allModels' => $pedidos,
                'sort' => [
                    'attributes' => ['cod_pedido', 'status_id_status','zonas_id_zona'],
                ],
                'pagination' => [
                    'pageSize' => 5,
                ],
                'key' => 'id',

        ]);
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'provider' => $provider,
        ]);
    }

    /**
     * Creates a new Projetos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projetos();
        $user_id = \Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post())) {

            $model->user_id_user  = $user_id;

            $model->save();

            Yii::$app->session->setFlash('success', 'Projeto inserido com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }
    public function actionPedido()
    {   
        $userType = 2;
        $searchModel = new PedidosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $userType);

        return $this->render('_pedidoProjetoForm', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDesassociar($id)
    {  
        $pedido = Pedidos::find()->where(['id'=>$id])->all();
        $pedido[0]->projetos_id_projeto = null;
        $pedido[0]->save(false);
        
        Yii::$app->session->setFlash('success', 'Peidido desasociado do projeto com sucesso!');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionHistorico($id)
    {
        $modelhist = HistoricoProjetos::find()->where(['projetos_id_projetos'=>$id])->orderBy('data_alteracao')->all();
        
        $provider = new ArrayDataProvider([
            'allModels' =>  $modelhist,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);


        return $this->renderAjax('historico', [
            'model' => $this->findModel($id),
            'provider' => $provider,
        ]);
    }

    /**
     * Updates an existing Projetos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $historicoPedido = new HistoricoPedidos();
        $historicoProjeto = new HistoricoProjetos();
        $user_id = \Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post())) {
            $pedidos = Pedidos::find()->where(['projetos_id_projeto'=>$id])->count();
            $pedido = Pedidos::find()->where(['projetos_id_projeto'=>$id])->all();
            for ($i = 0; $i < $pedidos; $i++) {
                
                $pedido[$i]->status_id_status = $model->status_pedido_projetos_Id_status;
                $pedido[$i]->save(false);

                $historicoPedido->pedidos_id_pedido = $pedido[$i]->id;
                $historicoPedido->user_id_user = $user_id;
                $historicoPedido->status_pedido_projeto_id_status = $pedido[$i]->status_id_status;
                $historicoPedido->data_alteracao = date('Y-m-d');
                $historicoPedido->save(false);

                $historicoProjeto->projetos_id_projetos = $model->id_projeto;
                $historicoProjeto->user_id_user = $user_id;
                $historicoProjeto->status_id_status = $model->status_pedido_projetos_Id_status;
                $historicoProjeto->data_alteracao = date('Y-m-d');
                $historicoProjeto->save(false);

            }
            $model->save();
            Yii::$app->session->setFlash('success', 'Projeto atualizado com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Projetos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Projetos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projetos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projetos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
