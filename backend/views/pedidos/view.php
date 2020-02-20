<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\models\Pedidos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pedidos-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'clientesIdCliente.cod_cliente',
            'clientesIdCliente.nome_cliente',
            'clientesIdCliente.tipoCliente.descricao',
            'cod_pedido',
            'projetosIdProjeto.cod_projeto',
            'acao',
            'ofertasAntiga.oferta',
            'ofertasNova.oferta',
            'data_rececao',
            'canal.designacao',
            'statusIdStatus.designacao_estado',
            'zonasIdZona.nome',
            'morada_complementar',
            'ref_geog_latitude',
            'ref_geog_longitude',
            'userIdUser.name',
            'observacao:ntext',
             [
                'attribute'=>'anexo',
                  'format' => 'raw',
                'value'=>function ($model) {
                    return Html::a($model->anexo,['pedidos/opendocumento', 'doc' => $model->anexo],['title'=>'Ver','target' => '_blank']);
                },
            ],
        ],
    ]) ?>

    <div class="box box-info" style="padding-left: 5px;padding-right: 5px;">   
        <legend style="margin-bottom:5px;padding-left: 8px">Encomendas do Pedido</legend>
        <div class="panel-body">
            <?= GridView::widget([
            'dataProvider' => $provider,

            'columns' => [
                [
                    'attribute' => 'tp_encomenda',
                    'value' => 'tpEncomenda.designacao'
                ],
                'n_encomenda',
                'data_encomenda',
                [
                    'attribute'=>'estado_encomenda',
                    'value' => 'estadoEncomenda.designacao'
                ],
                'observacao',
            ],

            ]); ?>
        </div> 

    </div>

</div>
