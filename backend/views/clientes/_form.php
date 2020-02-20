<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\TipoCliente;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">

    <?php $form = ActiveForm::begin(['validateOnBlur' => false]); ?>

    <?= $form->field($model, 'cod_cliente')->textInput() ?>

    <?= $form->field($model, 'nome_cliente')->textInput(['maxlength' => true]) ?>
    <!-- <!?= $form->field($model, 'tipo_cliente')            
         ->dropDownList($model->tipo_cliente,
         [
          'multiple'=>'multiple',
          'class'=>'chosen-select input-md required',              
         ]             
        )->label("Add Categories"); ?>
 -->
    <?= $form->field($model, 'tipo_cliente')->dropDownList(
                                ArrayHelper::map(TipoCliente::find()->all(), 'id', 'descricao'),['prompt'=>'Selecione o tipo de cliente']
                            );?>

    <?= $form->field($model, 'contato')->textInput(['type'=>'number', 'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
