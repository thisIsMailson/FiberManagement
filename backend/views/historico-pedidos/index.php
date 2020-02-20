<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HistoricoPedidosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Historico Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-pedidos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Historico Pedidos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_historico_pedido',
            'pedidos_id_pedido',
            'user_id_user',
            'status_pedido_projeto_id_status',
            'data_alteracao',
            //'observacao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
