<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Coordenacoes */

$this->title = $model->id_coordenacao;
$this->params['breadcrumbs'][] = ['label' => 'Coordenacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="coordenacoes-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            'discricao',
        ],
    ]) ?>

</div>
