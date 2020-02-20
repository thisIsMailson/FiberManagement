<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HistoricoPedidos */

$this->title = 'Update Historico Pedidos: ' . $model->id_historico_pedido;
$this->params['breadcrumbs'][] = ['label' => 'Historico Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_historico_pedido, 'url' => ['view', 'id' => $model->id_historico_pedido]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="historico-pedidos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
