<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Projetos */

$this->title = $model->id_projeto;
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="projetos-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cod_projeto',
            'designacao',
            'descricao',
            'observacao:ntext',
            'statusPedidoProjetosIdStatus.designacao_estado',
            'userIdUser.name',
        ],
    ]) ?>

    <div class="box box-info" style="padding-left: 5px;padding-right: 5px;">   
        <legend style="margin-bottom:5px;padding-left: 8px">Pedidos do projeto</legend>
        <div class="panel-body">
            <?= GridView::widget([
            'dataProvider' => $provider,

            'columns' => [

                ['class' => 'yii\grid\SerialColumn'],
                'cod_pedido', 
                'statusIdStatus.designacao_estado',
                'zonasIdZona.nome',
                ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions',
                      'headerOptions' => ['style' => 'color:#337ab7'],
                      'template' => '{desassociar}',
                      'buttons' => [
                        'desassociar' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-remove" style="padding-left: 10px; color:red"></span>', $url, [
                                        'title' => Yii::t('app', 'Desassociar Pedido'),
                            ]);
                            },
                        ],
                 ],

            ]
            ]); ?>
        </div> 

    </div>

</div>
