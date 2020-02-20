<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HistoricoPedidos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historico-pedidos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pedidos_id_pedido')->textInput() ?>

    <?= $form->field($model, 'user_id_user')->textInput() ?>

    <?= $form->field($model, 'status_pedido_projeto_id_status')->textInput() ?>

    <?= $form->field($model, 'data_alteracao')->textInput() ?>

    <?= $form->field($model, 'observacao')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
