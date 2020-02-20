<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Regioes;
use backend\models\Zonas;
use backend\models\Projetos;
/* @var $this yii\web\View */
/* @var $model backend\models\Pedidos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedidosProjetos-form">

    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'validateOnBlur' => false, 'options'=> ['enctype' => 'multipart/form-data']]); ?>
      <div class="panel-body">
       
       <div class="form-row col-md-12">
            <div class="form-group col-md-2">
                <?= $form->field($model, 'cod_pedido')->textInput(['readonly'=>true]) ?>
            </div>
            <div class="form-group col-md-6">
               <?php
                    echo $form->field($model,'projetos_id_projeto')->widget(Select2::classname(),[
                                                'data' => $projetos,
                                                'value'=>$value,
                                                'class'=>'form-control col-md-7 col-xs-12',
                                                'maintainOrder' => true,
                                                'toggleAllSettings' => [
                                                    'selectOptions' => ['class' => 'text-success'],
                                                    'unselectOptions' => ['class' => 'text-danger'],
                                                ],
                                                'options' => ['placeholder' => 'Escolhe um projeto...', 'multiple' => false],
                                                'pluginOptions' => [
                                                    'tags' => true,
                                                    'maximumInputLength' => 100
                                                ]
                                            ]); 
                ?>
            </div>

            <div class="form-group col-md-6">
                <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-success']) ?>
            </div>

        </div>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
