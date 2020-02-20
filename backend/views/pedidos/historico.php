<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\HistoricoPedidos */

$this->title = "Historico";
$this->params['breadcrumbs'][] = ['label' => 'Historico Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="historico-pedidos-view">

    <?= GridView::widget([
        'dataProvider' => $provider,
         'columns' => [
            
            [
                'attribute'=>'data_alteracao',
            ],
            [
                'attribute'=>'status_pedido_projeto_id_status',
                'value' => 'statusPedidoProjetoIdStatus.designacao_estado',
            ],
            [
                'attribute'=>'user_id_user',
                'value' => 'userIdUser.name',
            ],
        ],
    ]) ?>

</div>