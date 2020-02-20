<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Regioes */

$this->title = $model->id_regiao;
$this->params['breadcrumbs'][] = ['label' => 'Regioes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="regioes-view">
<!-- 
    <p>
        <!?= Html::a('Update', ['update', 'id' => $model->id_regiao], ['class' => 'btn btn-primary']) ?>
        <@?= Html::a('Delete', ['delete', 'id' => $model->id_regiao], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            'coordenacaoIdCoordenacao.nome',
        ],
    ]) ?>

</div>
