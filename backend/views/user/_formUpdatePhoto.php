<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\CorPerfil;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\EncUtilizadores */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Alterar Foto';
?>

<div class="cor-user-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

     <div class="row">

      <div class="col-md-4" >  
            <?php
            echo $form->field($model, 'photo')->label('')->widget(FileInput::classname(), [
                'pluginOptions' => [
                    'showCaption' => false,
                    'showRemove' => FALSE,
                    'showUpload' => FALSE,
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' => 'Selecione uma foto',
                    'initialPreview' => [
                        Html::img($model->photo, ['class' => 'file-preview-image', 'alt' => 'Foto de perfil', 'title' => 'Foto', 'width'=>'200px;','height'=>'250px;']),
                    ],
                    'overwriteInitial' => TRUE
                ],
                'options' => ['accept' => 'image/*'],
            ]);
            ?>   

            <div class="row" style="margin-right: 0px;">
                <div class="form-group center-block mx-auto" style="margin-left:15px;">
                     <?= Html::submitButton('Alterar', ['class' => 'btn btn-primary btn-block ']) ?>
                </div>
            </div> 
    </div>  


   

    <?php ActiveForm::end(); ?>

</div>
