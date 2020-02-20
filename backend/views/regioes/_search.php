<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RegioesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regioes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'globalSearch', [
            'template' => '
            <div class="input-group col-md-4 pull-right">
                {input}
                <span class="input-group-btn">' .
                Html::submitButton('GO', ['class' => 'btn btn-default']) .
            '</span></div>',
        ])->textInput(['placeholder' => 'Search']);
    ?>
    
    <?php ActiveForm::end(); ?>

</div>
