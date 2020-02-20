<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Cadastros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cadastros-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="panel-group">
        <div class="panel panel-info">
          <div class="panel-heading"> Referência OT </div>
          <div class="panel-body">
              
            <div class="form-row">
                <div class="form-group col-md-6">
                    
                    <?= $form->field($model, 'referencia_ot')->textInput(['maxlength' => true]) ?>
                
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">IDs Serviço </div>
          <div class="panel-body">
              
            <div class="form-row">
                <div class="form-group col-md-3">
                    
                    <?= $form->field($model, 'LACETE')->textInput(['maxlength' => true]) ?>
                
                </div>
                <div class="form-group col-md-3">
                    
                    <?= $form->field($model, 'ADSL')->textInput(['maxlength' => true]) ?>

                </div>

                <div class="form-group col-md-3">
                    
                    <?= $form->field($model, 'VOIP')->textInput(['maxlength' => true]) ?>

                </div>
                
                <div class="form-group col-md-3">

                    <?= $form->field($model, 'IPTV')->textInput(['maxlength' => true]) ?>
                    
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-info">
          <div class="panel-heading"> OLT </div>
          <div class="panel-body">
              
            <div class="form-row">
                <div class="form-group col-md-3">
                    
                    <?= $form->field($model, 'OLT_NOME')->textInput(['maxlength' => true]) ?>
                
                </div>
                <div class="form-group col-md-3">

                     <?= $form->field($model, 'OLT_PON_ONUID')->textInput(['maxlength' => true]) ?>

                </div>

            </div>
          </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading"> BSP </div>
          <div class="panel-body">
              
            <div class="form-row">
                <div class="form-group col-md-3">                    
                    <?= $form->field($model, 'BSP_PON_Painel_Porto')->textInput(['maxlength' => true]) ?>                
                </div>
                <div class="form-group col-md-3">
                    <?= $form->field($model, 'BSP_modulo')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="form-group col-md-3">
                    <?= $form->field($model, 'BSP_modulo_splitter')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="form-group col-md-3">
                    <?= $form->field($model, 'BSP_modulo_porto')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="form-group col-md-3">
                    <?= $form->field($model, 'BSP_Porto_In')->textInput(['maxlength' => true]) ?>

                </div>
                
                <div class="form-group col-md-3">
                    <?= $form->field($model, 'BSP_Porto_Out')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="form-group col-md-3">
                    
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-info">
          <div class="panel-heading"> ODF </div>
          <div class="panel-body">
              
            <div class="form-row">
                <div class="form-group col-md-3">                                    
                    <?= $form->field($model, 'ODF_modulo')->textInput(['maxlength' => true]) ?>
    
                </div>
                <div class="form-group col-md-3">
                    <?= $form->field($model, 'ODF_porto')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading"> SRO/JSO </div>
          <div class="panel-body">
              
            <div class="form-row">
                <div class="form-group col-md-3">                  
                    <?= $form->field($model, 'PRIMARIO_modulo')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-3">
                    <?= $form->field($model, 'PRIMARIO_porto')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="form-group col-md-3">
                     <?= $form->field($model, 'SPLITTERS_modulo')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="form-group col-md-3">
                    <?= $form->field($model, 'SPLITTERS_splitter')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group col-md-3">
                    <?= $form->field($model, 'SPLITTERS_Porto_In')->textInput(['maxlength' => true]) ?>                
                </div>
                <div class="form-group col-md-3">
                    <?= $form->field($model, 'SPLITTERS_Porto_Out')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="form-group col-md-3">
                    <?= $form->field($model, 'SECUNDARIO_modulo')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="form-group col-md-3">
                    <?= $form->field($model, 'SECUNDARIO_PDO')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="form-group col-md-3">
                    <?= $form->field($model, 'SECUNDARIO_par')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-info">
          <div class="panel-heading"> Referência OT </div>
          <div class="panel-body">
              
            <div class="form-row">
                <div class="form-group col-md-6">
                    <?= $form->field($model, 'PDOs_pdo')->textInput(['maxlength' => true]) ?>                
                </div>
                <div class="form-group col-md-6">                    
                    <?= $form->field($model, 'PDOs_par')->textInput(['maxlength' => true]) ?>                
                </div>
            </div>
          </div>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
