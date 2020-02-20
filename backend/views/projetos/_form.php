<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\StatusPedidoProjetos;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Projetos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projetos-form">

    <?php $form = ActiveForm::begin(['validateOnBlur' => false]); ?>

    <?= $form->field($model, 'cod_projeto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'status_pedido_projetos_Id_status')->dropDownList(
                            ArrayHelper::map(StatusPedidoProjetos::find()->where(['dominio'=>'DEI'])->all(), 'id_status', 'designacao_estado'),['prompt'=>'Selecione um estado']
                );?>

    <?= $form->field($model, 'observacao')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
