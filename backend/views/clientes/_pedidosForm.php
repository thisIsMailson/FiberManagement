<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Ofertas;
use backend\models\Parametrizacao;
use yii\bootstrap\Modal;
use yii\helpers\URL;
/* @var $this yii\web\View */
/* @var $model backend\models\Pedidos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedidos-form">

    <?php
        Modal::begin([
         'id'=>'modal-map',
         'header' => '<h1>Map</h1>',
         'size'=>'modal-lg',
            ]);
        echo "<div id='modalMap'></div>";
        Modal::end()
    ?> 

    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'validateOnBlur' => false, 'options'=> ['enctype' => 'multipart/form-data']]); ?>

        <div class="panel-group">
            <div class="panel-body">
                  
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?= $form->field($model, 'acao')->dropDownList(['Adesão' => 'Adesão', 'Migração'=> 'Migração', 'Alteração'=> 'Alteração'], ['prompt'=>'Escolha uma opção']) ?>
                    </div>
                    <div class="form-group col-md-4">
                        <?= $form->field($model, 'id_pacote')->textInput()?>
                    </div>
                </div>
                <div class="form-row">                   
                    <div class="form-group col-md-4">
                        <?= $form->field($model, 'oferta_antiga')->dropDownList(
                                ArrayHelper::map(Ofertas::find()->where(['tipo'=>'antigo'])->all(), 'id', 'oferta'),['prompt'=>'Selecione uma opção']
                            ); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <?php 
                            $model->oferta_nova = $model->oferta_nova;
                            echo $form->field($model, 'oferta_nova')->dropDownList(
                                ArrayHelper::map(Ofertas::find()->where(['tipo'=>'novo'])->all(), 'id', 'oferta'),['prompt'=>'Selecione uma opção']
                            ); 
                        ?>
                    </div>
                </div>
                <div class="form-row">                    
                    <div class="form-group col-md-4">
                        <?= $form->field($model, 'data_rececao')->widget(
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
                    <div class="form-group col-md-4">
                        <?= $form->field($model, 'data_conclusao_pedido')->widget(
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
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php 
                            $model->canal_pedido = $model->canal_pedido;
                            echo $form->field($model, 'canal_pedido')->dropDownList(
                                ArrayHelper::map(Parametrizacao::find()->where(['categoria'=>'canal'])->all(), 'id', 'designacao'),['prompt'=>'Selecione uma opção']
                            ); 
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php  
                                 $model->zonas_id_zona = json_decode($model->zonas_id_zona);
                                 echo '<label class="control-label">Zona</label>';
                                 echo $form->field($model,'zonas_id_zona')->widget(Select2::classname(),[
                                    'data' => $zonas,
                                    'value'=>$value,
                                    'class'=>'form-control col-md-7 col-xs-12',
                                    'maintainOrder' => true,
                                    'toggleAllSettings' => [
                                        'selectOptions' => ['class' => 'text-success'],
                                        'unselectOptions' => ['class' => 'text-danger'],
                                    ],
                                    'options' => ['placeholder' => 'Escolhe uma zona...', 'multiple' => false],
                                    'pluginOptions' => [
                                        'tags' => true,
                                        'maximumInputLength' => 100
                                    ]
                                ])->label(false); 
                            ?>
                    </div>
                         <div class="form-group col-md-4">
                        <?= $form->field($model, 'morada_complementar')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?= $form->field($model, 'ref_geog_latitude')->textInput(['id'=>'ref_geog_latitude_id', 'readonly'=>true,]) ?>
                    </div>
                    <div class="form-group col-md-4">
                        <?= $form->field($model, 'ref_geog_longitude')->textInput(['id'=>'ref_geog_longitude_id', 'readonly'=>true]) ?>
                    </div>
                    <div class="form-group col-md-4">

                        <?= Html::button('Adicionar', ['value'=>URL::to('index.php?r=clientes/create'), 'style'=>'margin-top: 24px', 'class' => 'btn btn-primary', 'id'=>'RefButton', 'onclick'=>'alert("some shii")']) ?>
                            
                    </div>
                </div>
                <div class="form-row col-md-12">

                    <div class="form-group col-md-4">
                        <?= $form->field($model, 'anexo')->fileInput() ?>
                    </div>
                    <div class="form-group col-md-8">
                        <?= $form->field($model, 'observacao')->textarea(['rows' => 3]) ?>
                    </div>  
                </div>

                <div class="form-group col-md-12">
                    <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-success']) ?>
                </div>

            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
 