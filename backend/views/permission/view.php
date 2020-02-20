<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */

$this->title = 'Gestão de Permissão';
$this->params['breadcrumbs'][] = ['label' => 'Detalhes de permissão', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Permissão <small>Informações de permissão: <b><?= $model->name?></small></h2>
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
                        'created_at',
                        'updated_at',
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