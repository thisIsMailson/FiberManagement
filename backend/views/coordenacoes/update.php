<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Coordenacoes */

$this->title = 'Update Coordenacoes: ' . $model->id_coordenacao;
$this->params['breadcrumbs'][] = ['label' => 'Coordenacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_coordenacao, 'url' => ['view', 'id' => $model->id_coordenacao]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="coordenacoes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
