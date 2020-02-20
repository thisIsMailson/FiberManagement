<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Clientes */

$this->title = 'Update Clientes: ' . $model->id_cliente;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cliente, 'url' => ['view', 'id' => $model->id_cliente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clientes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
