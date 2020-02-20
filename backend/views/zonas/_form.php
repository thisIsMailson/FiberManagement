<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Regioes;

/* @var $this yii\web\View */
/* @var $model backend\models\Zonas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zonas-form">

    <?php $form = ActiveForm::begin(['validateOnBlur' => false]); ?>

    <?= $form->field($model, 'nome')->textInput() ?>

    <?= $form->field($model, 'regiao_id_regiao')->dropDownList(
                                ArrayHelper::map(Regioes::find()->all(), 'id_regiao', 'nome'),['prompt'=>'Selecione uma região']
                            );?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
