<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjetosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projetos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_projeto') ?>

    <?= $form->field($model, 'cod_projeto') ?>

    <?= $form->field($model, 'designacao') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'observacao') ?>

    <?php // echo $form->field($model, 'status_pedido_projetos_Id_status') ?>

    <?php // echo $form->field($model, 'user_id_user') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
