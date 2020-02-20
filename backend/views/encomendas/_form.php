<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\Parametrizacao;
use yii\helpers\ArrayHelper;
use backend\models\Pedidos;
/* @var $this yii\web\View */
/* @var $model backend\models\Encomendas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encomendas-form">

    <?php $form = ActiveForm::begin(['validateOnBlur' => false]); ?>

        <div class="panel-group">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">

                        <?php
                            $pedido = Pedidos::findOne($model->pedidos_id_pedido);
                            echo $form->field($model, 'pedidos_id_pedido')->textInput(['value'=>$pedido->cod_pedido]) ?>
                    </div>
                    <div class="col-md-6">
                        <?php 
                            $model->tp_encomenda = $model->tp_encomenda;
                            echo $form->field($model, 'tp_encomenda')->dropDownList(
                                ArrayHelper::map(Parametrizacao::find()->where(['categoria'=>'Tipo Encomenda'])->all(), 'id', 'designacao'),['prompt'=>'Selecione uma opção']
                            ); 
                        ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'n_encomenda')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'data_encomenda')->widget(
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

                    <div class="col-md-6">
                        <?php 
                            $model->estado_encomenda = $model->estado_encomenda;
                            echo $form->field($model, 'estado_encomenda')->dropDownList(
                                ArrayHelper::map(Parametrizacao::find()->where(['categoria'=>'Estado Encomenda'])->all(), 'id', 'designacao'),['prompt'=>'Selecione uma opção', 'id'=>'estado_encomenda']
                            ); 
                        ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'data_ot')->widget(
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

                    <div class="col-md-6">
                        <?= $form->field($model, 'ot')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'observacao')->textarea(['rows' => 3]) ?>
                    </div>

                    <div class="form-group col-md-12">
                        <?php echo Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-success', 'onclick'=>'
                            estadoEncomenda = $("#estado_encomenda").val();
                                if (estadoEncomenda == 17) {
                                    if (confirm("Deseja cancelar o pedido relacionado a esta encomenda?")) {
                                            $.ajax({
                                                    method: "POST",
                                                    url: "index.php?r=encomendas/pedidoestado&idPedido='.$model->pedidos_id_pedido.'+&tipoEstado=3",
                                                    invokedata: {
                                                        callingSelect: $(this)
                                                    }
                                                })
                                                .done(function( data ) {
                                                    var data = $.parseJSON(data);
                                                    if (data !== null) {

                                                        //if yes fill the form fields
                                                        $("#priceField").attr(id);

                                                        this.invokedata.callingSelect.parent().parent().next().find("input").val(data.preco);    

                                                    } else {
                                                        alert("Were sorry but we couldnt load the location data!"); 
                                                    }
                                                    $("select#models-contact" ).html(data);
                                                });
                                        
                                    } else {
                                        alert("Não foi alterado o estado do pedido");
                                    }
                                } else if (estadoEncomenda == 18) {
                                    if (confirm("Deseja concluir o pedido relacionado a esta encomenda?")) {
                                            $.ajax({
                                                    method: "POST",
                                                    url: "index.php?r=encomendas/pedidoestado&idPedido='.$model->pedidos_id_pedido.'+&tipoEstado=2",
                                                    invokedata: {
                                                        callingSelect: $(this)
                                                    }
                                                })
                                                .done(function( data ) {
                                                    var data = $.parseJSON(data);
                                                    if (data !== null) {

                                                        //if yes fill the form fields
                                                        $("#priceField").attr(id);

                                                        this.invokedata.callingSelect.parent().parent().next().find("input").val(data.preco);    

                                                    } else {
                                                        alert("Were sorry but we couldnt load the location data!"); 
                                                    }
                                                    $("select#models-contact" ).html(data);
                                                });
                                        
                                    } else {
                                        alert("Não foi alterado o estado do pedido");
                                    }
                                }
                            ']) ?>
                    </div>
                </div>

            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
