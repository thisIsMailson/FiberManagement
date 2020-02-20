<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Zonas */

$this->title = $model->id_zona;
$this->params['breadcrumbs'][] = ['label' => 'Zonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="zonas-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            'regiaoIdRegiao.nome',
        ],
    ]) ?>

</div>
