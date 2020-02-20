<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HistoricoPedidosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historico-pedidos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_historico_pedido') ?>

    <?= $form->field($model, 'pedidos_id_pedido') ?>

    <?= $form->field($model, 'user_id_user') ?>

    <?= $form->field($model, 'status_pedido_projeto_id_status') ?>

    <?= $form->field($model, 'data_alteracao') ?>

    <?php // echo $form->field($model, 'observacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
