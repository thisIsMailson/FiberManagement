<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
            <div class="x_content">
                <div class="x_title">
                    <h2>Permissão <small><?= ($model->isNewRecord ? 'Registar':'Atualizar'). ' Permissão' ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <br />
                <?php $form = ActiveForm::begin([
                            'options' => [
                                'class' => 'form-horizontal form-label-left'
                             ]
                            ]); ?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Código <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">                       
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'form-control col-md-7 col-xs-12'])->label(false) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Descrição <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $form->field($model, 'description')->textInput(['class'=>'form-control col-md-7 col-xs-12'])->label(false) ?>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-0">
                      <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-primary']) ?>              
                     <?= Html::a('<i class="fa fa-list"></i>'.' Ir para lista de permissão', ['index'], ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?> 
            </div>
        </div>
    </div>
</div>
    