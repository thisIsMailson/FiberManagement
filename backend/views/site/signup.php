<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\Coordination;
use yii\helpers\ArrayHelper;

?>
<div >
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Preencha os campos abaixo para registar um utilizador:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options'=> ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'displayName')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'username')->textInput() ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'photo')->fileInput() ?>
               
                <?= $form->field($model, 'coordination_id')->dropDownList(
                            ArrayHelper::map(Coordination::find()->all(), 'id', 'coordination_name'),['prompt'=>'--Selecione uma Coordenação--']
                );?>
                <div class="form-group">
                    <?= Html::submitButton('registar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
