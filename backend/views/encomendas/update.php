<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Encomendas */

$this->title = 'Update Encomendas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Encomendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="encomendas-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
