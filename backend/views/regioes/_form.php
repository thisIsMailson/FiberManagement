<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Coordenacoes;
use backend\models\Parametrizacao;

/* @var $this yii\web\View */
/* @var $model backend\models\Regioes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regioes-form">

    <?php $form = ActiveForm::begin(['validateOnBlur' => false]); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coordenacao_id_coordenacao')->dropDownList(
                                ArrayHelper::map(Coordenacoes::find()->all(), 'id_coordenacao', 'nome'),['prompt'=>'Selecione uma coordenação']
                            );?>
    <?= $form->field($model, 'ilha')->dropDownList(
                                ArrayHelper::map(Parametrizacao::find()->where(['categoria'=>'ilha'])->all(), 'id', 'designacao'),['prompt'=>'Selecione uma ilha']
                            );?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
