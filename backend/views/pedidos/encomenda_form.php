<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\Parametrizacao;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Encomendas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encomendas-form">

    <?php $form = ActiveForm::begin(['validateOnBlur' => false]); ?>

        <div class="panel-group">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php 
                            $model->tp_encomenda = $model->tp_encomenda;
                            echo $form->field($model, 'tp_encomenda')->dropDownList(
                                ArrayHelper::map(Parametrizacao::find()->where(['categoria'=>'Tipo Encomenda'])->all(), 'id', 'designacao'),['prompt'=>'Selecione uma opção']
                            ); 
                        ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'n_encomenda')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'data_encomenda')->widget(
                                        DatePicker::className(), [
                                        // inline too, not bad
                                         'inline' => false, 
                                         // modify template for custom rendering
                                       // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-m-d',
                                            'todayHighlight' => true
                                        ]
                        ]);?>
                    </div>

                    <div class="col-md-6">
                        <?php 
                            $model->estado_encomenda = $model->estado_encomenda;
                            echo $form->field($model, 'estado_encomenda')->dropDownList(
                                ArrayHelper::map(Parametrizacao::find()->where(['categoria'=>'Estado Encomenda'])->all(), 'id', 'designacao'),['prompt'=>'Selecione uma opção']
                            ); 
                        ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'data_ot')->widget(
                                        DatePicker::className(), [
                                        // inline too, not bad
                                         'inline' => false, 
                                         // modify template for custom rendering
                                       // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-m-d',
                                            'todayHighlight' => true
                                        ]
                        ]);?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'ot')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'observacao')->textarea(['rows' => 3]) ?>
                    </div>


                    <div class="form-group col-md-12">
                        <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-success']) ?>
                    </div>
                </div>

            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
