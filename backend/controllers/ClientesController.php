<?php

namespace backend\controllers;

use Yii;
use backend\models\Clientes;
use backend\models\Zonas;
use backend\models\HistoricoPedidos;
use backend\models\Pedidos;
use backend\models\ClientesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * ClientesController implements the CRUD actions for Clientes model.
 */
class ClientesController extends Controller
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
     * Lists all Clientes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clientes model.
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
     * Creates a new Clientes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clientes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Cliente inserido com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }
    public function actionPedido($id)
    {
        $model = new Pedidos();
        $historicoPedido = new HistoricoPedidos();
        $user_id = \Yii::$app->user->identity->id;
        $cliente = $this->findModel($id);
        $zona = new Zonas();
        $zonas = $zona::getZonas();
        $user_id = \Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) ) {
            $model->clientes_id_cliente =$cliente->id_cliente;
            $model->user_id_user  = $user_id;
            $oferta_nova = $_POST['Pedidos']['oferta_nova'];
            
            $model->anexo=UploadedFile::getInstance($model,'anexo');
            if($model->anexo != NULL){
                $model->anexo->saveAs( 'uploads/'.$model->anexo->baseName.'.'.$model->anexo->extension);
                $model->anexo = 'uploads/'.$model->anexo->baseName.'.'.$model->anexo->extension;
            }

            $model->save();

            $historicoPedido->pedidos_id_pedido = $model->id;
            $historicoPedido->user_id_user = $user_id;
            $historicoPedido->status_pedido_projeto_id_status = $model->status_id_status;
            $historicoPedido->data_alteracao = date('Y-m-d');
            $historicoPedido->observacao =$historicoPedido->observacao;
            $historicoPedido->save();
            
            $codigoPedido = "PF_".$model->id;
            $model->cod_pedido = $codigoPedido;
            $model->save();

            Yii::$app->session->setFlash('success', 'Pedido inserido com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('_pedidosForm', [
            'model' => $model, 'value'=>[], 'zonas'=>$zonas
        ]);
    }

    /**
     * Updates an existing Clientes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Cliente atualizado com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Clientes model.
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
     * Finds the Clientes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clientes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clientes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
