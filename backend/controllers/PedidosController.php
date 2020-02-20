<?php

namespace backend\controllers;

use Yii;
use backend\models\Pedidos;
use backend\models\Regioes;
use backend\models\Encomendas;
use backend\models\User;
use backend\models\PedidosSearch;
use backend\models\HistoricoPedidos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Zonas;
use backend\models\Clientes;
use backend\models\StatusPedidoProjetos;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Projetos;
use backend\models\UserRegioes;
use backend\models\TipoCliente;
use yii\data\ArrayDataProvider;
use kartik\dynagrid\DynaGrid;
use yii\web\UploadedFile;
/**
 * PedidosController implements the CRUD actions for Pedidos model.
 */
class PedidosController extends Controller
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
     * Lists all Pedidos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $userType = 1; // To get all pedidos
        $searchModel = new PedidosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $userType);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionValidacao()
    {
        $peiddoType = 2; // To get the pedidos status por validar
        $searchModel = new PedidosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $peiddoType);

        return $this->render('index_validacao', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSemdisponibilidade()
    {
        $peiddoType = 3; // To get the pedidos status sem disponibilidade
        $searchModel = new PedidosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $peiddoType);

        return $this->render('index_pedidoSemDisponibilidade', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSemaprovacao()
    {
        $peiddoType = 4; // To get the pedidos status sem disponibilidade
        $searchModel = new PedidosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $peiddoType);

        return $this->render('index_pedidoSemAprovacao', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionEncomenda($id)
    {

        $modelPedido = $this->findModel($id);
        $model = new Encomendas();
        $user_id = \Yii::$app->user->identity->id;
        $historicoPedido = new HistoricoPedidos();

        if ($model->load(Yii::$app->request->post())) {
            $model->pedidos_id_pedido = $modelPedido->id;
            $model->users_id_user = \Yii::$app->user->identity->id;
            $model->save();
            if ($model->save()) {
                $modelPedido->status_id_status = 14;
                $modelPedido->save(false);

                $historicoPedido->pedidos_id_pedido = $modelPedido->id;
                $historicoPedido->user_id_user = $user_id;
                $historicoPedido->status_pedido_projeto_id_status = $modelPedido->status_id_status;
                $historicoPedido->data_alteracao = date('Y-m-d');
                $historicoPedido->save(false);
            }
            Yii::$app->session->setFlash('success', 'Encomenda associado com sucesso!');
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('encomenda_form', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Pedidos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $pedidoEncomendas = Encomendas::find()->where(['pedidos_id_pedido'=>$id])->all();

        $provider = new ArrayDataProvider([
                'allModels' => $pedidoEncomendas,
                'sort' => [
                    'attributes' => ['tp_encomenda', 'n_encomenda','data_encomenda','estado_encomenda','observacao','tipo'],
                ],
                'pagination' => [
                    'pageSize' => 5,
                ], 
        ]);


         return $this->renderAjax('view', [
          'model' => $this->findModel($id),
          'provider' => $provider,
        ]);
    }

    /**
     * Creates a new Pedidos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pedidos();
        $user_id = \Yii::$app->user->identity->id;
        $zona = new Zonas();
        $zonas = $zona::getZonas();
        $historicoPedido = new HistoricoPedidos();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->user_id_user  = $user_id;
            $model->status_id_status = 1;
            $model->zonas_id_zona = 1;
            
            $model->save();

            if ($model->save()) {

                $historicoPedido->pedidos_id_pedido = $model->id;
                $historicoPedido->user_id_user = $user_id;
                $historicoPedido->status_pedido_projeto_id_status = $model->status_id_status;
                $historicoPedido->data_alteracao = date('Y-m-d');
                $historicoPedido->save(false);
            }

            $codigoPedido = "PF_".$model->id;
            $model->cod_pedido = $codigoPedido;
            $model->save();

            Yii::$app->session->setFlash('success', 'Pedido inserido com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model, 'value'=>[], 'zonas'=>$zonas
        ]);
    }

    public function actionProjeto($id) {
        $model = $this->findModel($id);
        $projeto = new Projetos();
        $projetos = $projeto::getProjetos();
        $historicoPedido = new HistoricoPedidos();
        $user_id = \Yii::$app->user->identity->id;


        if ($model->load(Yii::$app->request->post()) ) {

            $proj = Projetos::findOne($model->projetos_id_projeto);
            $model->status_id_status = $proj->status_pedido_projetos_Id_status;
            $model->save(false);

            $historicoPedido->pedidos_id_pedido = $model->id;
            $historicoPedido->user_id_user = $user_id;
            $historicoPedido->status_pedido_projeto_id_status = $model->status_id_status;
            $historicoPedido->data_alteracao = date('Y-m-d');
            $historicoPedido->save(false);

            Yii::$app->session->setFlash('success', 'Projeto associado com sucesso!');
            return $this->redirect(['index']);
        }
        return $this->renderAjax('_pedidoProjetoForm', [
            'model' => $model,
            'value'=>[],
            'projetos'=>$projetos
        ]);
    }
    public function actionStatus($id) {
        $historicoPedido = new HistoricoPedidos();
        $model = $this->findModel($id);
        $user_id = \Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) ) {
            $model->save(false);
            if ($historicoPedido->load(Yii::$app->request->post()) ) {
                $historicoPedido->pedidos_id_pedido = $model->id;
                $historicoPedido->user_id_user = $user_id;
                $historicoPedido->status_pedido_projeto_id_status = $model->status_id_status;
                $historicoPedido->data_alteracao = date('Y-m-d');
                $historicoPedido->observacao =$historicoPedido->observacao; 
                $historicoPedido->save();
            }
            
            Yii::$app->session->setFlash('success', 'Estado atualizado com sucesso!');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->renderAjax('_pedidoStatusForm', [
            'model' => $model,
            'historicoPedido'=>$historicoPedido,
        ]);
    }
    public function actionStatussemdesponibilidade($id) {
        $historicoPedido = new HistoricoPedidos();
        $model = $this->findModel($id);
        $user_id = \Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) ) {
            $model->save(false);
            if ($historicoPedido->load(Yii::$app->request->post()) ) {
                $historicoPedido->pedidos_id_pedido = $model->id;
                $historicoPedido->user_id_user = $user_id;
                $historicoPedido->status_pedido_projeto_id_status = $model->status_id_status;
                $historicoPedido->data_alteracao = date('Y-m-d');
                $historicoPedido->observacao =$historicoPedido->observacao; 
                $historicoPedido->save();
            }
            
            Yii::$app->session->setFlash('success', 'Estado atualizado com sucesso!');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->renderAjax('_pedidoSemDesponibilidadeStatus', [
            'model' => $model,
            'historicoPedido'=>$historicoPedido,
        ]);
    }

    public function actionHistorico($id)
    {
        $modelhistfatura = HistoricoPedidos::find()->where(['pedidos_id_pedido'=>$id])->orderBy('data_alteracao')->all();

        $historic = array();

        $provider = new ArrayDataProvider([
            'allModels' =>  $modelhistfatura,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);


        return $this->renderAjax('historico', [
            'model' => $this->findModel($id),
            'provider' => $provider,
        ]);
    }

    public function actionListpedidos($date)
    {
        $user_id = \Yii::$app->user->identity->id;
        
        $filterYear = $date;

        $pedidosDataSet = [0, 0];

        $pedidosCount = (new \yii\db\Query())
                ->select('count(id) as val, MONTHNAME(data_rececao) as label')
                ->from('pedidos')
                ->where('user_id_user = ' . $user_id .' AND YEAR(data_rececao) = ' . $filterYear)
                ->distinct()
                ->orderby('data_rececao')
                ->groupby('MONTHNAME(data_rececao)')->count();

        if ($pedidosCount > 0) {
            $pedidosDataSet = (new \yii\db\Query())
                ->select('count(id) as val, MONTHNAME(data_rececao) as label')
                ->from('pedidos')
                ->where('user_id_user = ' . $user_id .' AND YEAR(data_rececao) = ' . $filterYear)
                ->distinct()
                ->orderby('data_rececao')
                ->groupby('MONTHNAME(data_rececao)') 
                ->all();
        } else {
            $pedidosDataSet = (new \yii\db\Query())
                ->select('count(id) as val, MONTHNAME(data_rececao) as label')
                ->from('pedidos')
                ->where('user_id_user = ' . $user_id .' AND YEAR(data_rececao) = ' . $filterYear)
                ->distinct()
                ->orderby('data_rececao')
                ->all();
        }

        $peidosOutput = [["Pedido", "Total"]];
        foreach($pedidosDataSet as $row) {
            $peidosOutput[] = [$row['label'], intval($row['val'])];
        }

        return json_encode($peidosOutput);
    }

    public function actionListpedidoscoordininterval($startDate, $endDate) { // Pediodos por coordenação
        
        if ($endDate < $startDate) {
            $temp = $endDate;
            $endDate = $startDate;
            $startDate = $temp;
        }
        //SELECT * FROM `pedidos` WHERE YEAR(data_rececao) = 2020 AND MONTH(data_rececao) = 02

        $pedidosCoordIntervalDataSet = [0, 0];

        if ($startDate == $endDate) {
            $pedidosCoordIntervalDataSet = (new \yii\db\Query())
                ->select('count(id) as val, coordenacoes.nome as label')
                ->from('pedidos, zonas, regioes, coordenacoes')
                ->where('pedidos.zonas_id_zona = zonas.id_zona AND zonas.regiao_id_regiao = regioes.id_regiao AND regioes.coordenacao_id_coordenacao = coordenacoes.id_coordenacao AND DATE(pedidos.data_rececao) = '. $startDate)
                ->distinct()
                ->groupby('coordenacoes.nome') 
                ->all();
                 //dd($pedidosCoordIntervalDataSet);
        } else {
            $pedidosCoordIntervalDataSet = (new \yii\db\Query())
                ->select('count(id) as val, coordenacoes.nome as label')
                ->from('pedidos, zonas, regioes, coordenacoes')
                ->where('pedidos.zonas_id_zona = zonas.id_zona AND zonas.regiao_id_regiao = regioes.id_regiao AND regioes.coordenacao_id_coordenacao = coordenacoes.id_coordenacao  AND DATE(pedidos.data_rececao) BETWEEN '. $startDate .' AND ' . $endDate)
                ->distinct()
                ->groupby('coordenacoes.nome') 
                ->all();
        }
       
        $peidosCoordIntervalOutput = [["Pedido", "Total"]];
        foreach($pedidosCoordIntervalDataSet as $row) {
            $peidosCoordIntervalOutput[] = [$row['label'], intval($row['val'])];
        }

        return json_encode($peidosCoordIntervalOutput);

    }

    public function actionListpedidosilhaininterval($startDate, $endDate) { // Pediodos por Ilha
        if ($endDate < $startDate) {
            $temp = $endDate;
            $endDate = $startDate;
            $startDate = $temp;
        }
        $startMonth = date("m", strtotime($startDate));
        $startYear = date("yy", strtotime($startDate));

        $endMonth = date("m", strtotime($endDate));
        $endYear = date("yy", strtotime($endDate));

        

        $pedidosIlhaIntervalDataSet = [0, 0];
        $pedidosIlhaIntervalDataSet = (new \yii\db\Query())
                ->select('count(pedidos.id) as val, parametrizacao.designacao as label')
                ->from('pedidos, zonas, regioes, parametrizacao')
                ->where('pedidos.zonas_id_zona = zonas.id_zona AND zonas.regiao_id_regiao = regioes.id_regiao AND regioes.ilha = parametrizacao.id  AND DATE(pedidos.data_rececao) BETWEEN '. $startDate .' AND ' . $endDate)
                ->distinct()
                ->groupby('parametrizacao.designacao') 
                ->all();

        $peidosIlhaIntervalOutput = [["Pedido", "Total"]];
        foreach($pedidosIlhaIntervalDataSet as $row) {
            $peidosIlhaIntervalOutput[] = [$row['label'], intval($row['val'])];
        }

        return json_encode($peidosIlhaIntervalOutput);

    }

    public function actionListpedidosstatus($island, $date) { // Pediodos por Ilha

        $peidoStatusDataSet = [0, 0];
        $peidoStatusDataSet = (new \yii\db\Query())
                        ->select('COUNT(pedidos.id) as val, status_pedido_projetos.designacao_estado as label ')
                        ->from('pedidos, status_pedido_projetos, zonas, regioes, parametrizacao')
                        ->where('pedidos.zonas_id_zona = zonas.id_zona AND zonas.regiao_id_regiao = regioes.id_regiao AND regioes.ilha = parametrizacao.id AND  parametrizacao.id = '. $island .' AND pedidos.status_id_status = status_pedido_projetos.id_status  AND DATE(pedidos.data_rececao) = '. $date)
                        ->distinct()
                        ->groupby('status_pedido_projetos.designacao_estado') 
                        ->all();

        $peidoStatusOutput = [["Pedido", "Total"]];
        foreach($peidoStatusDataSet as $row) {
            $peidoStatusOutput[] = [$row['label'], intval($row['val'])];
        }

        return json_encode($peidoStatusOutput);

    }

    public function actionRegions($id) {
        $countRegs = Regioes::find()
        ->where(['id_regiao'=>$id])
        ->count();

        $zonas = Zonas::find()
        ->where(['regiao_id_regiao'=>$id])
        ->all();

        if ($countRegs > 0) {
             foreach ($zonas as $zona ) {
                 echo "<option value='".$zona->id_zona ."'>".$zona->nome."</option>";
             }
          } else {
            echo "<option>-</option>";
          }  
    }

    public function actionFilters($id) {
        $user_id = \Yii::$app->user->identity->id;

        switch ($id) {
            case 1: // Cod Cliente
                $countClientes = Clientes::find()->count();
                $clientes = Clientes::find()->all();

                if ($countClientes > 0) {
                    echo "<option value='0'>Código do cliente</option>";
                    foreach ($clientes as $cliente) {
                        echo "<option value='". $cliente->id_cliente ."'>". $cliente->cod_cliente ."</option>";
                    }
                } else {
                    echo "<option>-</option>";
                }
                break;
            
            case 2: // Nome Cliente
                $countClientes = Clientes::find()->count();
                $clientes = Clientes::find()->all();

                if ($countClientes > 0) {
                    echo "<option value='0'>Nome do cliente</option>";
                    foreach ($clientes as $cliente) {
                        echo "<option value='". $cliente->id_cliente ."'>". $cliente->nome_cliente ."</option>";
                    }
                } else {
                    echo "<option>-</option>";
                }
                break;
            
            case 3: // Filtro por Tipo do cliente
                $countTipoClientes = TipoCliente::find()->count();
                $tipoClientes = TipoCliente::find()->all();

                if ($countTipoClientes > 0) {
                    echo "<option value='0'>Tipo do cliente</option>";
                    foreach ($tipoClientes as $tipoCliente) {
                        echo "<option value='". $tipoCliente->id ."'>". $tipoCliente->descricao ."</option>";
                    }
                } else {
                    echo "<option>-</option>";
                }
                break;
            
            case 4: // Filtro por Zonas
               
                $userLoged = \Yii::$app->user->identity;
                $userRegioes = UserRegioes::find()
                ->where(['user_id_user'=> $userLoged->id])->all();

                echo "<option value='0'>Nome da zona</option>";
                foreach ($userRegioes as $value) {
                    $zonas = Zonas::find()
                    ->where(['regiao_id_regiao'=>$value->regiao_id_regiao ])->all();
                    foreach ($zonas as $zona ) {
                         echo "<option value='".$zona->id_zona ."'>".$zona->nome."</option>";
                     }
                }

                     
                break;
            
            case 5: // Filtro por Codigo do pedido
                $countPedidos = Pedidos::find()->count();
                $pedidos = pedidos::find()->all();

                if ($countPedidos > 0) {
                    echo "<option value='0'>Código do pedido</option>";
                    foreach ($pedidos as $pedido) {
                        echo "<option value='". $pedido->id ."'>". $pedido->cod_pedido ."</option>";
                    }
                } else {
                    echo "<option>-</option>";
                }
                break;

            case 6: // Filtro por Estado do pedido
                $countStatus = StatusPedidoProjetos::find()->count();
                $status = StatusPedidoProjetos::find()->all();

                if ($countStatus > 0) {
                    echo "<option value='0'>Estado do pedido</option>";
                    foreach ($status as $estado) {
                        echo "<option value='". $estado->id_status ."'>". $estado->designacao_estado ."</option>";
                    }
                } else {
                    echo "<option>-</option>";
                }
                break;
            
            default:
                # code...
                break;
        } 
    }

    public function actionList($idTipoFiltro, $id) {
        // Recebe-se aqui dois parâmetros, o tipo de filtro e um id que representa o item selecionado para filtrar

        $searchModel = new PedidosSearch();

        switch ($idTipoFiltro) {
            case 1: // Filtro por Codigo do Cliente
                $dataProvider = $searchModel->search_(Yii::$app->request->queryParams, 1, $id);
                $model = Projetos::findOne(1);
                break;
            
            case 2: // Filtro por Nome do cliente
                $dataProvider = $searchModel->search_(Yii::$app->request->queryParams, 2, $id);
                $model = Projetos::findOne(1);
                break;
            
            case 3: // Filtro por Tipo do cliente
                $dataProvider = $searchModel->search_(Yii::$app->request->queryParams, 3, $id);
                $model = Projetos::findOne(1);
                break;
            
            case 4: // Filtro por Zonas
                $dataProvider = $searchModel->search_(Yii::$app->request->queryParams, 4, $id);
                $model = Projetos::findOne(1);
                break;

            case 5: // Filtro por Codigo do pedido
                $dataProvider = $searchModel->search_(Yii::$app->request->queryParams, 5, $id);
                $model = Projetos::findOne(1);
                break;

            case 6: // Filtro por Estado do pedido
                $dataProvider = $searchModel->search_(Yii::$app->request->queryParams, 6, $id);
                $model = Projetos::findOne(1);
                break;
        }
        

        if($dataProvider->getCount()){
            return DynaGrid::widget([
                'storage'=>DynaGrid::TYPE_COOKIE,
                'theme'=>'panel-default',
                'showPersonalize'=>true,
                'storage'=>'cookie',
                'gridOptions'=>[
                    'dataProvider'=>$dataProvider,
                   // 'filterModel'=>$searchModel,
                    'rowOptions'=>function($model){
                        if ($model->status_id_status == 1) {
                            return ['class'=>'danger'];
                        }  else {

                        return ['class'=>'success'];
                        }
                    },
                    'showPageSummary'=>false,
                    'floatHeader'=>true,
                    'pjax'=>true,
                    'panel'=>[
                        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Pedidos </h3>',
                        'after' => false
                    ],        
                    'toolbar' =>  [
                        /*['content'=>
                            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Adicionar', 'class'=>'btn btn-success', 
                                         'data-keyboard'=>'false','data-backdrop'=>'static','data-toggle'=>'modal','data-target'=>".bs-modal-contacto-tp",'href'=>"index.php?r=sgm-pr-contacto-tp/create"]) . ' '.
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Atualiar Tabela'])
                        ],*/
                        '{export}',
                        '{toggleData}',
                        ['content' => '{dynagrid}']
                    ]
                ],
                'options'=>['id'=>'dynagrid-contacto-tp'], // a unique identifier is important
                'columns' => [
                    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
                    [
                            'attribute'=>'cod_cliente',
                            'value'=>'clientesIdCliente.cod_cliente', 
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'10px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'clientes_id_cliente', 
                            'value' => 'clientesIdCliente.nome_cliente',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'cod_pedido',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'10px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'zonas_id_zona', 
                            'value'=>'zonasIdZona.nome',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'ilha', 
                            'value'=>'zonasIdZona.regiaoIdRegiao.ilha0.designacao',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'id_pacote', 
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'oferta_antiga', 
                            'value'=>'ofertasAntiga.oferta',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'oferta_nova', 
                            'value'=>'ofertasNova.oferta',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                    
                        [
                            'attribute'=>'status_id_status', 
                            'value'=>'statusIdStatus.designacao_estado',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'data_rececao',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                        [
                            'attribute'=>'user_id_user',
                            'value'=>'userIdUser.name',
                            'hAlign'=>'left', 
                            'vAlign'=>'middle',
                            'width'=>'150px',
                            'pageSummary'=>true
                        ],
                    ['class'=>'kartik\grid\ActionColumn','template'=> '{view}{update}{encomenda}{historico}',
                            'buttons' => [
                                    'view' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', FALSE, 
                                     ['value' => $url, 'onclick' => 'js:openPopUpVerPdd(this);', 'title' => 'Ver']);
                                    },

                                    'update' => function ($url, $model) {

                                        $userLoged = \Yii::$app->user->identity;
                                        $userRole = $userLoged->role_id;
                                        return $userRole == 2 || $userRole == 1  ? Html::a('<span class="glyphicon glyphicon-pencil" style="padding-left: 10px;"></span>', FALSE, ['value' => $url, 'onclick' => 'js:openPopUpEditar(this);', 'title' => 'Editar']) : '';
                                    },
                                    'encomenda' => function ($url, $model) {
                                        $userLoged = \Yii::$app->user->identity;
                                        $userRole = $userLoged->role_id;
                                        return ($model->status_id_status == 2 || $model->status_id_status == 14) && $userRole == 2 ? Html::a('<span class="glyphicon glyphicon-gift" style="padding-left: 10px;"></span>', FALSE, ['value' => $url, 'onclick' => 'js:openPopUpEncomenda(this);', 'title' => 'Associar Encomenda']) : '';
                                    },
                                    'historico' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-time" style="padding-left: 10px;"></span>', FALSE, 
                                     ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'Historico']);
                                    },

                                
                                
                            ],'header'=>'', 'contentOptions' => ['style' => 'width:90px;'],
                            'dropdown'=>false,'order'=>DynaGrid::ORDER_FIX_RIGHT],
                    ],
            ]);
        } else { 
            echo '<div class="col-lg-6">Nenhum resultado encontrado.</div>';
        }
        
    }

    /**
     * Updates an existing Pedidos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user_id = \Yii::$app->user->identity->id;
        $zona = new Zonas();
        $zonas = $zona::getZonas();



        if ($model->load(Yii::$app->request->post())) {

            $model->anexo=UploadedFile::getInstance($model,'anexo');
            if($model->anexo != NULL){
                $model->anexo->saveAs( 'uploads/'.$model->anexo->baseName.'.'.$model->anexo->extension);
                $model->anexo = 'uploads/'.$model->anexo->baseName.'.'.$model->anexo->extension;
            }


            $model->save();
            Yii::$app->session->setFlash('success', 'Pedido atualizado com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model, 'zonas' => $zonas, 'value'=>[],
        ]);
    }
    public function actionOpendocumento($doc) {
       $this->layout = 'documentoLayout';
       $doca = 'uploads/Mapa.png';
       return $this->render("documento_reader", [
           'documento' => $doca
       ]);
    }

    /**
     * Deletes an existing Pedidos model.
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

    public function actionMap() {

        return $this->renderAjax('map');
        
    }
    public function actionAddmarker() {

        return $this->renderAjax('addMarker');
        
    }

    /**
     * Finds the Pedidos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pedidos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedidos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
