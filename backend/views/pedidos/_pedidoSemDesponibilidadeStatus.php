<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\OfertaAntiga;
use backend\models\StatusPedidoProjetos;
/* @var $this yii\web\View */
/* @var $model backend\models\Pedidos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedidos-form">

    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'validateOnBlur' => false, 'options'=> ['enctype' => 'multipart/form-data']]); ?>

    <div class="panel-group">
                      
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <?= $form->field($model, 'cod_pedido')->textInput(['readonly'=>true]) ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'status_id_status')->dropDownList(
                                    ArrayHelper::map(StatusPedidoProjetos::find()->where(['dominio'=>'SEM DISPONIBILIDADE'])->all(), 'id_status', 'designacao_estado'),['prompt'=>'Selecione um estado']
                                ); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?= $form->field($historicoPedido, 'observacao')->textarea(['rows' => 1]) ?>
                        </div>
                    </div>

    <!-- <!?= $form->field($model, 'projetos_id_projeto')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
