<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */

$this->title = 'Gestão de Perfil';
$this->params['breadcrumbs'][] = ['label' => 'Detalhes de perfil', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Perfil <small>Informações de perfil: <b><?= $model->name?></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'description:ntext',
                    ],
                ]) ?>
            </div>
             <p>
                <?= Html::a('<i class="fa fa-plus"></i>'.' Novo Registo', ['create'], ['class' => 'btn btn-primary left']) ?>

                <?= Html::a('<i class="fa fa-pencil"></i>'.' Editar', ['update', 'id' => $model->name], ['class' => 'btn btn-warning left']) ?>

                <?= Html::a('<i class="fa fa-trash"></i>'.' Eliminar', ['delete', 'id' => $model->name], [
                    'class' => 'btn btn-danger left',
                    'data' => [
                        'confirm' => 'Deseja realmente eliminar este item?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('<i class="fa fa-list"></i>'.' Ir para lista de perfil', ['index'], ['class' => 'btn btn-default']) ?>
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Informações sobre as permissões</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php 
                \yii\widgets\Pjax::begin(['timeout'=>5000,]);
                ?>
                
                <!-- Lista de Permissoes a adicionar -->
                <div class="col-lg-6">
                    <div class="alert alert-info">Permissões</div>
                    <?php if($dataProvider2->getCount()){?>
                    <?php
                        echo Html::beginForm('','POST',['data-pjax'=>0,]);
                        echo Html::hiddenInput('flag', '2');
                         echo yii\grid\GridView::widget([
                                'dataProvider' => $dataProvider2,
                                'filterModel' => $searchModel,
                                'summaryOptions'=>['class'=>'col-lg-12','style'=>'padding-bottom:20px;'],
                                'columns' => [
                                    [
                                    'class' => 'yii\grid\CheckBoxColumn',
                                    'headerOptions'=>['width'=>20,],
                                    ],
                                    [
                                        'attribute'=>'name',
                                        'headerOptions'=>['width'=>100,],
                                    ],
                                    [
                                        'attribute'=>'description',
                                        'headerOptions'=>['width'=>100,],
                                    ]
                                ],
                            ]); 
                        echo '<p>'.Html::submitButton('Adicionar', ['class'=>'btn btn-default']).'</p>';
                        echo Html::endForm();
                        ?>
                   <?php }else{
                        echo '<div class="col-lg-6">Nenhum resultado encontrado.</div>';
                   }?>
                </div>
                
                <!-- Lista de permissoes que ja foram adicionados -->
                <div class="col-lg-6">
                    <div class="alert alert-info">Remover permissões</div>
                    <?php if($dataProvider1->getCount()){?>
                    <?php
                     echo Html::beginForm('','POST',['data-pjax'=>0,]);
                     echo Html::hiddenInput('flag', '1');
                     echo yii\grid\GridView::widget([
                            'dataProvider' => $dataProvider1,
                            'filterModel' => $searchModel,
                            'columns' => [
                                [
                                'class' => 'yii\grid\CheckBoxColumn',
                                'headerOptions'=>['width'=>20,],
                                ],
                                [
                                    'attribute'=>'name',
                                    'headerOptions'=>['width'=>100,],
                                ],
                                [
                                    'attribute'=>'description',
                                    'headerOptions'=>['width'=>100,],
                                ]
                            ],
                        ]); 
                        
                    echo '<p>'.Html::submitButton('Remover', ['class'=>'btn btn-default']).'</p>';
                    echo Html::endForm();
                    ?>
                   <?php }else{
                        echo '<div class="col-lg-6">Nenhum resultado encontrado.</div>';
                   }?>

                </div>
                <?php \yii\widgets\Pjax::end();?>
            </div>
        </div>
    </div>
</div>