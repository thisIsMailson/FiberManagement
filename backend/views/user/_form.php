<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use lo\widgets\Toggle;
use backend\models\Coordenacoes;
use backend\models\Regioes;
use backend\models\Roles;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->title = '';
?>
<div class="user-form">

    <?php $form = ActiveForm::begin(['validateOnBlur' => false, 'options'=>['enctype'=>'multipart/form-data']]); ?>

     <div class="row">

         <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'form-control'])?>
         </div>
           
          <div class='col-md-6'>
              <?= $form->field($model, 'username')->textInput(['maxlength' => true,'class'=>'form-control '])?>
          </div>


          <div class="col-md-6">
             <?= $form->field($model, 'email')->textInput(['maxlength' => true,'class'=>'form-control'])?>
         </div>

        <div class="col-md-6">
            <?= $form->field($model, 'role_id')->dropDownList(
                    ArrayHelper::map(Roles::find()->all(), 'id', 'nome'),['prompt'=>'Selecione um perfil']);
            ?>
        </div> 
        <div class="col-md-6">
            <?= $form->field($model, 'coordenacao_id')->dropDownList(
                            ArrayHelper::map(Coordenacoes::find()->all(), 'id_coordenacao', 'nome'),['prompt'=>'Selecione uma Coordenação',
                            'onchange'=>'
                                $.get("index.php?r=coordenacoes/regions&id='.'"+$(this).val(), function( data ){
                                    $("select#regioes-drop").html(data);
                                });
                            ', ]);
            ?>
         </div>
         
            <div class="col-md-6">
               <?php
                    echo $form->field($userRegiao,'regiao_id_regiao')->dropDownList(
                            ArrayHelper::map(Regioes::find()->all(), 'id_regiao', 'nome'),['prompt'=>'Selecione uma região', 'id'=>'regioes-drop']);
            ?>
           </div>

        

       <!--  <div class="col-md-6">
          <!?= $form->field($model,'profile')->widget(Select2::classname(),[
                'data' => $profile,
                'value'=>$value,
                'class'=>'form-control',
                'maintainOrder' => true,
                'toggleAllSettings' => [
                    'selectOptions' => ['class' => 'text-success'],
                    'unselectOptions' => ['class' => 'text-danger'],
                ],
                'options' => ['placeholder' => 'Associar Perfil', 'multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                    'maximumInputLength' => 100
                ]
            ]); 
          ?>
        </div> -->

         <div class="col-md-6">
            <?php
                $imagepath = $model->photo;    
                $model->photo = UploadedFile::getInstance($model, 'photo');
                if ($model->photo) {
                    echo $form->field($model, 'photo')->fileInput(['value'=>  $imagepath]);
                } else {
                    $model->photo = $imagepath;
                }
                echo $form->field($model, 'photo')->fileInput();
            ?>
         </div>

     </div>

   <div class="row" style="margin-right: 0px;">
     <div class="ln_solid"></div>
        <div class="col-md-6">
          <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

