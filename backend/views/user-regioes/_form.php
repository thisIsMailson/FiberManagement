<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserRegioes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-regioes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id_user')->textInput() ?>

    <?= $form->field($model, 'regiao_id_regiao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
