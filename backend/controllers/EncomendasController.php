<?php

namespace backend\controllers;

use Yii;
use backend\models\Encomendas;
use backend\models\EncomendasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Pedidos;
use backend\models\HistoricoPedidos;
use backend\models\HistoricoProjetos;
/**
 * EncomendasController implements the CRUD actions for Encomendas model.
 */
class EncomendasController extends Controller
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
     * Lists all Encomendas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EncomendasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Encomendas model.
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

    /**
     * Creates a new Encomendas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Encomendas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Encomenda inserido com sucesso!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Encomendas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
           
            $pedido = Pedidos::find()->where(['cod_pedido'=> $model->pedidos_id_pedido])->all(); 
            $model->pedidos_id_pedido = $pedido[0]->id;
            $model->save();

            Yii::$app->session->setFlash('success', 'Encomenda atualizado com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    } 
    public function actionPedidoestado($idPedido, $tipoEstado)
    {
        $pedido = Pedidos::findOne($idPedido);

        $historicoPedido = new HistoricoPedidos();
        $historicoPeojeto = new HistoricoProjetos();
        $user_id = \Yii::$app->user->identity->id;
        
        if ($tipoEstado == 3) { // 3 para cancelar o pedidoe todas as suas encomendas
            $pedido->status_id_status = 16;
            $pedido->save(false);
            $pedido->changeEncomendaStatus($idPedido, 17);

            $historicoPedido->pedidos_id_pedido = $pedido->id;
            $historicoPedido->user_id_user = $user_id;
            $historicoPedido->status_pedido_projeto_id_status = $pedido->status_id_status;
            $historicoPedido->data_alteracao = date('Y-m-d');
            $historicoPedido->save(false);
        } else if ($tipoEstado == 2) { // 2 para concluir o pedido e todas as suas encomendas
            $pedido->status_id_status = 15;
            $pedido->save(false);
            $pedido->changeEncomendaStatus($idPedido, 18);

            $historicoPedido->pedidos_id_pedido = $pedido->id;
            $historicoPedido->user_id_user = $user_id;
            $historicoPedido->status_pedido_projeto_id_status = $pedido->status_id_status;
            $historicoPedido->data_alteracao = date('Y-m-d');
            $historicoPedido->save(false);
        }
        
    }
    /**
     * Deletes an existing Encomendas model.
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
     * Finds the Encomendas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Encomendas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Encomendas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
